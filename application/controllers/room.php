<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 继承MY_Controller类，
 * 位置 core/
 * */
class room extends MY_Controller {

	private $is_mobile = false;
	function __construct()
	{
		parent::__construct();
		$this->is_mobile = is_mobile();
	}

	public function index($rid = 0)
	{
		/*先确定好直播室模板先，如果是手机访问，肯定要wap模板无疑*/
		$tpl = $this->session->userdata('tpl');
		if( ! $tpl ) $tpl = 'silver';
        //房间号
		$rid = $rid ? $rid : '';
		if($this->is_mobile)
		{
			/*移动端访问，若没有tpl参数，加上，以区分链接*/
			if(!$this->input->get('tpl')) header("Location:".base_url().'room/'.$rid.'?tpl=wap');
			$tpl = 'wap';
		}
		else
		{
			/*电脑端访问，若有tpl参数，去掉，以区分链接*/
			if($this->input->get('tpl')) header("Location:".base_url().'room/'.$rid);
		}
		// if($this->input->get('tpl')) $tpl = $this->input->get('tpl');
		$this->out_data['tpl'] = 'skin/'.$tpl.'/';

        /*开启CI自带缓存cache_on()
         * 缓存目录配置，在config/database.php中
         * 关闭缓存cache_off()
         * */
		$this->db->cache_on();
		$room_list = $this->db->query("select id,pwd from {$this->db->dbprefix('room')}")->result_array();
		$this->db->cache_off();
		if(!$rid) $rid = $room_list[0]['id'];

		/*查看输入的房间ID是否存在 ，并且是否需要密码进入房间*/
		$is_room_exist = false;
		foreach($room_list as $v)
		{
			if($rid == $v['id'])
			{
				$is_room_exist = true; /*房间存在*/

				/*判断密码*/
				if($v['pwd'] != '' AND $this->input->get('pwd') != $v['pwd'])
				{
					$this->_get_me_pwd($rid);
					return;
				}
				break;
			}
		}
		if( ! $is_room_exist) show_404();

		/*----------------------------------------------能进入页面了，下面正式开始-----------------------------------------------------*/
		
		$this->_set_visitor_info($rid);

		/*----------------------取各部分的数据了------------------*/

		/*取会员组列表并排序*/
		$this->out_data['group_list'] = $this->db->query("select id,name from {$this->db->dbprefix('group')} order by sort desc")->result_array();

		/*取假人在线列表，在线人数列表由Ajax异步调取*/
		// $this->out_data['dummy_list'] = parent::get_online_list($rid, 0);

		/*默认显示的一部分聊天记录从mysql数据库中读取*/
		$this->out_data['chat_list'] = $this->db->query("select name,time,content,gid from {$this->db->dbprefix('chat_list')} where rid='{$rid}' order by time desc limit 20")->result_array();
		krsort($this->out_data['chat_list']);

		/*最新消息列表，实际也就是后台的升级通告*/
		$this->db->cache_on();
		$this->out_data['upgrade_list'] = $this->db->query("select u.name,u.gid,g.name as gname from {$this->db->dbprefix('upgrade')} as u inner join {$this->db->dbprefix('group')} as g on g.id=u.gid")->result_array();
		$this->db->cache_off();

		/*课程表*/
		$this->db->cache_on();
		$this->out_data['curriculum_list'] = $this->db->query("select start_time,end_time,curr_name,monday,tuesday,wednesday,thursday,friday from {$this->db->dbprefix('curriculum')} where rid='{$rid}' order by id")->result_array();
		$teacher_list = $this->db->query("select id,name from {$this->db->dbprefix('teacher')}")->result_array();
		$this->db->cache_off();
		$key_teacher_list = array();
		foreach($teacher_list as $k => $v)
		{
			$key_teacher_list[$v['id']] = $v['name'];
		}
		foreach($this->out_data['curriculum_list'] as $k => $v)
		{
			if(isset($key_teacher_list[$v['monday']]))$this->out_data['curriculum_list'][$k]['monday'] = $key_teacher_list[$v['monday']];
			if(isset($key_teacher_list[$v['tuesday']])) $this->out_data['curriculum_list'][$k]['tuesday'] = $key_teacher_list[$v['tuesday']];
			if(isset($key_teacher_list[$v['wednesday']])) $this->out_data['curriculum_list'][$k]['wednesday'] = $key_teacher_list[$v['wednesday']];
			if(isset($key_teacher_list[$v['thursday']])) $this->out_data['curriculum_list'][$k]['thursday'] = $key_teacher_list[$v['thursday']];
			if(isset($key_teacher_list[$v['friday']])) $this->out_data['curriculum_list'][$k]['friday'] = $key_teacher_list[$v['friday']];
		}
		/*----------------------------右下角--------------------------*/
		$this->db->cache_on();
		// $youxia1 = $this->db->query("select title,content from {$this->db->dbprefix('single_page')} where find_in_set('youxia1_{$rid}', flag) limit 1");
		// $youxia1_data = array('title' => '', 'content' => '');
		// if($youxia1->num_rows() > 0) $youxia1_data = $youxia1->row_array();
		// $this->out_data['youxia1'] = $youxia1_data;

		$youxia3 = $this->db->query("select title,content from {$this->db->dbprefix('single_page')} where find_in_set('youxia3_{$rid}', flag) limit 1");
		$youxia3_data = array('title' => '', 'content' => '');
		if($youxia3->num_rows() > 0) $youxia3_data = $youxia3->row_array();
		$this->out_data['youxia3'] = $youxia3_data;
		$this->db->cache_off();
		/*----------------------------右下角--------------------------*/

		/*金牌策略*/
		$this->db->cache_on();
		$strategy_list = $this->db->query("select id,name,time,gid,tid from {$this->db->dbprefix('strategy')} where rid='{$rid}'")->result_array();
		$this->db->cache_off();
		foreach($strategy_list as $k => $v)
		{
			if($v['tid'] != 0)
			{
				/*该策略属于老师策略，不在乎等级*/
				$strategy_list[$k]['level'] = $key_teacher_list[$v['tid']];
			}
			else
			{
				/*该策略是会员等级策略*/
				foreach($this->out_data['group_list'] as $gv)
				{
					if($v['gid'] == $gv['id'])
					{
						$strategy_list[$k]['level'] = $gv['name'];
					}
				}
			}
		}
		$this->out_data['strategy_list'] = $strategy_list;

		/*股票看涨看平看空投票数据*/
		// $this->db->cache_on();
		// $stock_vote = $this->db->query("select count(id) as num from {$this->db->dbprefix('stock_vote')} group by vote")->result_array();
		// $this->db->cache_off();
		// $rise_vote = isset($stock_vote[0]['num']) ? $stock_vote[0]['num'] : 0;
		// $tie_vote = isset($stock_vote[1]['num']) ? $stock_vote[1]['num'] : 0;
		// $fall_vote = isset($stock_vote[2]['num']) ? $stock_vote[2]['num'] : 0;
		// $sum_vote = $tie_vote + $rise_vote + $fall_vote;
		// $this->out_data['stock_vote']['rise'] = round(($rise_vote/$sum_vote)*100);
		// $this->out_data['stock_vote']['tie'] = round(($tie_vote/$sum_vote)*100);
		// $this->out_data['stock_vote']['fall'] = round(($fall_vote/$sum_vote)*100);

		/*专家团队和名师榜*/
		$this->db->cache_on();
		$specialist = $this->db->query("select id,name,content,avatar from {$this->db->dbprefix('specialist')} where rid='{$rid}'")->result_array();
		$this->db->cache_off();
		$specialist_vote = $this->db->query("select sid,date from {$this->db->dbprefix('specialist_vote')} where DATE_FORMAT(NOW(), '%Y-%m') = DATE_FORMAT(date,'%Y-%m')")->result_array();
		$today = date("Y-m-d");
		$specialist_vote_sum = 0;
		$this->out_data['specialist'] = array();
		foreach($specialist as $v)
		{
			$v['month'] = 0;
			$v['today'] = 0;
			$this->out_data['specialist'][$v['id']] = $v;
		}
		foreach($specialist_vote as $v)
		{
			if(isset($this->out_data['specialist'][$v['sid']]))
			{
				$this->out_data['specialist'][$v['sid']]['month']++;
				if($v['date'] == $today)
				{
					$this->out_data['specialist'][$v['sid']]['today']++;
					$specialist_vote_sum++;
				}
			}
		}
		$specialist_vote_sum = $specialist_vote_sum == 0 ? 1 : $specialist_vote_sum; /*计算时分母不能为0*/
		$this->out_data['specialist_vote_sum'] = $specialist_vote_sum;

		/*房间相关信息*/
		$this->db->cache_on();
		$this->out_data['room'] = $this->db->query("select title,keywords,description,video,statistics,qq,qq_code from {$this->db->dbprefix('room')} where id='{$rid}' limit 1")->row_array();
		$this->db->cache_off();

		$this->out_data['rid'] = $rid;
		$this->load->view("{$tpl}/room", $this->out_data);
	}

/*-----------------------------------------以下为私有方法---------------------------------------------------*/

	private function _get_me_pwd($rid)
	{
		$this->load->view('get_pwd', array('rid' => $rid));
	}

	/**
	 * 在session中设置当前访问者的各项信息[is_login,name,gid,ip,mid,tpl]
	 * @param [string] $rid [房间ID]
	 */
	private function _set_visitor_info($rid)
	{
        //获取外网ip
		$ip = parent::get_ip();
		if( ! $this->session->userdata('name'))
		{
			/*只有当session不存在的时候，才会设置信息*/
			$this->session->set_userdata('is_login', 0);
			$this->session->set_userdata('rid', $rid);
            //引入字符串辅助函数,下面调用random_string
			$this->load->helper('string');
			$flag = $this->is_mobile ? 'm' : 'p';
			$this->session->set_userdata('name', '游客'.$flag.random_string('alnum', 5));
			$this->session->set_userdata('gid', 1);
			$this->session->set_userdata('ip', $ip);
		}

		/*无论是会员还是游客，都要向数据库中更新数据*/
		if($this->session->userdata('is_login'))
		{
			$this->db->update('member', array('login_time' => date("Y-m-d H:i:s"), 'ip' => $ip), array('id' => $this->session->userdata('mid')));
		}
		else
		{
			$tb_visitor = $this->db->dbprefix('visitor');
			$name = $this->session->userdata('name');
            //查询visitor表中是否存在此游客的名字
			$visitor_id = $this->db->query("select id from {$tb_visitor} where name = '{$name}' limit 1");
			if($visitor_id->num_rows() == 0)
			{
                //不存在就插入
				$this->db->insert($tb_visitor, array('name' => $name, 'ip' => $ip));
                //游客表中的id就等于会员id
				$mid = $this->db->insert_id();
				$this->session->set_userdata('mid', $mid);
			}
			else
			{
                //存在就更新对应id的ip
				$visitor_id = $visitor_id->row()->id;
				$this->db->update($tb_visitor, array('ip' => $ip), array('id' => $visitor_id));
			}
		}

		$redis = parent::redis_conn();
		$this->session->set_userdata('tpl', $redis->get('room_tpl_'.$rid));
		/*将他的在线情况存入redis(mid,gid,name)，同时设置过期时间70S*/
		$redis->setex( "member_list_{$this->session->userdata('rid')}_1_{$this->session->userdata('mid')}_{$this->session->userdata('gid')}", 70, json_encode( array('mid' => $this->session->userdata('mid'), 'gid' => $this->session->userdata('gid'), 'name' => $this->session->userdata('name') ) ) );
		unset($redis);
	}

}