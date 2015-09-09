<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class examine extends MY_Controller {

	private $redis;
	function __construct()
	{
		parent::__construct();
		parent::check_permission('examine');
		$this->redis = parent::redis_conn();
	}

	private function _get_rid_list()
	{
		return explode(',', $this->session->userdata('rid'));
	}

	public function index()
	{
		$this->out_data['rid_list'] = $this->_get_rid_list();
		$this->out_data['chat_list'] = array(); /*未审核的聊天记录*/

		// foreach($rid_list as $v)
		// {
		// 	$list = $this->redis->zrange('examine_record_'.$v, 0, -1,true);
		// 	foreach($list as $k => $lv)
		// 	{
		// 		$this->out_data['chat_list'][$lv] = $k;
		// 	}
		// }
		
		/*会员中的巡管列表*/
		$this->out_data['member_admin'] = $this->db->query("select name from {$this->db->dbprefix('member')} where gid=0")->result_array();


		$this->out_data['con_page'] = 'examine';
		$this->load->view('default', $this->out_data);
	}
	
	public function get_online_peo()
	{
		//获取在线人数
		$online_arr = $this->redis->keys('member_list_*');
		$online_peo = count($online_arr);
		echo $online_peo;
	}

	/**
	 * 删除聊天记录
	 */
	function del()
	{
		$id = $this->input->post('id');
		if( ! is_array($id) ) $ids[] = $id;
		else $ids = $id;

		$rid = $this->input->post('rid');
		if( ! is_array($rid) ) $rids[] = $rid;
		else $rids = $rid;

		foreach($ids as $k => $v)
		{
			$rids[$k] = str_replace("'", '', $rids[$k]);
			$this->redis->zremrangebyscore('examine_record_'.$rids[$k], $v, $v);
		}
	}

	/*发布聊天记录*/
	function release()
	{
		$id = $this->input->post('id');
		if( ! is_array($id) ) $ids[] = $id;
		else $ids = $id;

		$rid = $this->input->post('rid');
		if( ! is_array($rid) ) $rids[] = $rid;
		else $rids = $rid;

		$room = array(); /*房间，里面是各个房间的数据*/
		$sql_data = array(); /*最终要插入到数据库中的数据*/
		foreach($ids as $k => $v)
		{
			$rid = $rids[$k];
			$score = $ids[$k];
			$rid = str_replace("'", '', $rid);
			$record = $this->redis->zrangebyscore('examine_record_'.$rid, $score, $score);
			if( ! empty($record) )
			{
				/*得到了这一条数据*/
				$record = $record[0];

				$sql_record = json_decode($record, TRUE);
				$sql_record['time'] = date('Y-m-d H:i:s');
				$sql_data[] = $sql_record;
				if( ! isset($room[$rid]) ) $room[$rid] = array();
				$room[$rid][$score] = $record;
				/*内容已取出，从未审核中删掉这条数据*/
				$this->redis->zremrangebyscore('examine_record_'.$rid, $score, $score);
			}
		}

		/*所有需要数据已取出，现在需要发布这些数据*/
		foreach($room as $k => $v)
		{
			/*向各个房间频道发送数据*/
			$msg = array();
			foreach($v as $score => $sv)
			{
				/*发布时要重新改下时间，不然如果没按顺序发布，会显示时间乱掉的*/
				$sv = json_decode($sv, TRUE);
				$sv['time'] = date("Y-m-d H:i:s");
				$sv = json_encode($sv);
				$this->redis->zadd('room_'.$k, str_pad(str_replace('.', '', microtime(true)),14,0), $sv);
			}
		}
		/*再将这些数据存入mysql数据库*/
		if( ! empty($sql_data) ) $this->db->insert_batch('chat_list', $sql_data);
	}

	/**
	 * 获取聊天数据
	 */
	function get_chat_data()
	{
		// set_time_limit(20);
		$score = $this->input->post('score');
		if( ! $score ) $score = 0;
		$room = $this->_get_rid_list();
		$this->out_data['chat_list'] = array(); /*未审核的聊天记录*/
		$this->out_data['chat_list']['score'] = $score;
		$this->out_data['chat_list']['data_list'] = array();

		for($i = 0; $i < 13; $i++)
		{
			foreach($room as $v)
			{
				$list = $this->redis->zRangeByScore('examine_record_'.$v, '('.$score, '+inf', array('withscores' => TRUE));
				foreach($list as $k => $lv)
				{
					$this->out_data['chat_list']['data_list'][$lv] = $k;
					/*每次都取最大的score*/
					$this->out_data['chat_list']['score'] = $this->out_data['chat_list']['score'] > $lv ? $this->out_data['chat_list']['score'] : $lv;
				}
			}
			if( ! empty($this->out_data['chat_list']['data_list']) )
			{
				/*判断有没有数据，有，输出，没有，继续循环*/
	 			echo json_encode($this->out_data['chat_list']);
				ob_flush();
				flush();
				break;
			}
			sleep(2);
			clearstatcache();
		}
		exit();
	}

	function ip_ban()
	{
		$name = $this->input->post('name');
		$ip = '';
		$ip = $this->db->query("select ip from {$this->db->dbprefix('visitor')} where name='{$name}' limit 1");
		if($ip->num_rows() > 0)
		{
			$ip = $ip->row()->ip;
		}
		else
		{
			$ip = $this->db->query("select ip from {$this->db->dbprefix('member')} where name='{$name}' limit 1");
			if($ip->num_rows() > 0)
			{
				$ip = $ip->row()->ip;
			}
		}
		if($ip != '')
		{
			if($this->db->query("select count(1) as num from {$this->db->dbprefix('ipban')} where ip='{$ip}' limit 1")->row()->num == 0)
			{
				$this->db->insert('ipban', array('ip' => $ip));
			}
		}
	}

	function send_member_notice()
	{
		$rid = $this->input->post('rid');
		$key = 'room_'.$rid;

		/*下面开始发送信息了*/
		$info = array('rid' => $rid, 'gid' => 0, 'time' => date('Y-m-d H:i:s'), 'content' => $this->security->xss_clean($this->input->post('content')), 'name' => $this->input->post('send'));

		$score = str_pad(str_replace('.', '', microtime(true)),14,0);
		$this->redis->zadd($key, $score, json_encode($info));

		//添加审核字段，便于后台统计
		$info['types'] = '1';
		$this->db->insert('chat_list', $info);
	}

	function __destruct()
	{
		unset($this->redis);
	}

}