<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chat extends MY_Controller {

	private $redis;
	private $rid;
	function __construct()
	{
		parent::__construct();
		$this->redis = parent::redis_conn();
		$this->rid = $this->input->post('rid');
		if(!$this->rid) $this->rid = $this->session->userdata('rid');
		if(!$this->rid) exit;
	}

	public function index()
	{
		show_404();
	}

	/*获取真实的在线用户列表*/
	function get_online_list()
	{
		echo json_encode(parent::get_online_list($this->rid, 1));
	}

	/*发送我的心跳，说明我还活着*/
	function send_heart()
	{
		$mid = $this->session->userdata('mid');
		$gid = $this->session->userdata('gid');
		$this->redis->setex( "member_list_{$this->rid}_1_{$mid}_{$gid}", 70, json_encode( array('mid' => $mid, 'gid' => $gid, 'name' => $this->session->userdata('name') ) ) );
	}

	/*发送聊天信息*/
	function send_msg()
	{
        //存放未审核的集合
		$key = 'examine_record_'.$this->rid; /*这是将要发送信息到redis中的key*/
		$is_auto_examine = false; /*是否是自动审核的信息*/

		/*看这间房的聊天是否需要审核，当然，如果我的IP是在公司，那肯定不需要审核了*/
		$ip = parent::get_ip();
		// if($this->redis->get('room_examine_'.$this->rid) )
		if($ip == '140.207.79.210' OR $ip == '58.247.75.154' OR $ip == '58.247.75.150' OR $this->redis->get('room_examine_'.$this->rid) )
		{
            //存放已审核的集合
			$key = 'room_'.$this->rid;
			$is_auto_examine =  true;
		}
		/*下面开始发送信息了*/
		$mid = $this->session->userdata('mid');
		$gid = $this->session->userdata('gid');
		if($gid === false) $this->_set_visitor_info($this->rid);
        //聊天记录存入redis,如14421945222304: "{"rid":"001","gid":1,"time":"2015-09-14 09:35:22","content":"hwsthjesrht","name":"\u6e38\u5ba2pOCRqi"}"
		$info = array('rid' => $this->rid, 'gid' => $this->session->userdata('gid'), 'time' => date('Y-m-d H:i:s'), 'content' => $this->security->xss_clean(strip_tags($this->input->post('content'), '<img>')), 'name' => $this->session->userdata('name'));

		$score = str_pad(str_replace('.', '', microtime(true)),14,0);
        /*
         * 将score和聊天内容存放到集合中
         * 有已审核  和  未审核  2种情况
         * */
		$this->redis->zadd($key, $score, json_encode($info));
		/*如果是自动审核的记录，还需同时记入数据库*/
		if($is_auto_examine)
		{
			//添加审核字段，便于后台统计
			$info['types'] = '1';
			$this->db->insert('chat_list', $info);
		}
	}

	/**
	 * 获取聊天数据
	 */
	function get_msg_data()
	{
		// set_time_limit(17);
		$score = $this->input->post('score');
		if( ! $score ) show_404();
		$msg_list = array();
		$msg_list['score'] = $score;
		$msg_list['data_list'] = array();

		for($i = 0; $i < 13; $i++)
		{
            /*
             * ZRANGEBYSCORE key min max [WITHSCORES] [LIMIT offset count]
             *返回有序集key中，所有score值介于min和max之间(包括等于min或max)的成员。有序集成员按score值递增(从小到大)次序排列
             * min和max可以是-inf和+inf，这样一来，你就可以在不知道有序集的最低和最高score值的情况下，使用ZRANGEBYSCORE这类命令
             * */
			$list = $this->redis->zRangeByScore('room_'.$this->rid, '('.$score, '+inf', array('withscores' => TRUE));
			foreach($list as $k => $v)
			{
				$name = json_decode($k, TRUE);
				if($name['name'] != $this->session->userdata('name'))
				{
					/*如果是自己的，就没必要再放进去显示了，因为已经提前显示了*/
					$msg_list['data_list'][] = $k;
				}
				/*每次都取最大的score*/
				$msg_list['score'] = $msg_list['score'] > $v ? $msg_list['score'] : $v;
			}
			if( ! empty($msg_list['data_list']) )
			{
				/*判断有没有数据，有，输出，没有，继续循环*/
				// ksort($msg_list['data_list']);
	 			echo json_encode($msg_list);
				ob_flush();
				flush();
				break;
			}
			sleep(2);
			clearstatcache();
		}
		exit();
	}

	/**
	 * 在session中设置当前访问者的各项信息[is_login,name,gid,ip,mid,tpl]
	 * @param [string] $rid [房间ID]
	 */
	private function _set_visitor_info($rid)
	{
		$ip = parent::get_ip();
		if( ! $this->session->userdata('name'))
		{
			/*只有当session不存在的时候，才会设置信息*/
			$this->session->set_userdata('is_login', 0);
			$this->session->set_userdata('rid', $rid);
			$this->load->helper('string');
			$this->session->set_userdata('name', '游客'.random_string('alnum', 6));
			$this->session->set_userdata('gid', 1);
			$this->session->set_userdata('ip', $ip);

			$tb_visitor = $this->db->dbprefix('visitor');
			$name = $this->session->userdata('name');
			$this->db->insert($tb_visitor, array('name' => $name, 'ip' => $ip));
			$mid = $this->db->insert_id();
			$this->session->set_userdata('mid', $mid);
		}
	}

	function __destruct()
	{
		unset($this->redis);
	}

}