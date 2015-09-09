<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		// $this->load->database();
	}

	public function index()
	{
		show_404();
	}

	/*会员中心页面*/
	function info()
	{
		$this->_check_member_login();

		$this->out_data['info'] = $this->db->query("select gid,tid,name,re_time,login_time,ip from {$this->db->dbprefix('member')} where id={$this->session->userdata('mid')} limit 1")->row_array();
		$this->out_data['info']['gname'] = $this->db->query("select name from {$this->db->dbprefix('group')} where id={$this->out_data['info']['gid']} limit 1")->row()->name;
		if($this->out_data['info']['tid'] != 0)
		{
			$this->out_data['info']['tname'] = $this->db->query("select name from {$this->db->dbprefix('teacher')} where id={$this->out_data['info']['tid']} limit 1")->row()->name;
		}
		else
		{
			$this->out_data['info']['tname'] = '无';
		}

		$this->out_data['sidebar_current'] = 'info';
		$this->out_data['con_page'] = 'info';

		$tpl = $this->session->userdata('tpl');
		if( ! $tpl ) $tpl = 'default';
		$this->out_data['tpl'] = 'skin/'.$tpl.'/';
		$this->load->view("{$tpl}/member/default", $this->out_data);
	}

	/*会员中心修改密码页面*/
	function password()
	{
		$this->_check_member_login();

		$this->out_data['sidebar_current'] = 'password';
		$this->out_data['con_page'] = 'password';

		$tpl = $this->session->userdata('tpl');
		if( ! $tpl ) $tpl = 'default';
		$this->out_data['tpl'] = 'skin/'.$tpl.'/';
		$this->load->view("{$tpl}/member/default", $this->out_data);
	}

	/*修改密码动作*/
	function update_password()
	{
		$this->_check_member_login();

		$old_password = md5($this->input->post('old_password'));
		$password = md5($this->input->post('password'));

		$tb_member = $this->db->dbprefix("member");
		$result = array('status' => false, 'msg' => '');
		$mid = $this->session->userdata('mid');
		if($this->db->query("select 1 from {$tb_member} where id={$mid} and password='{$old_password}' limit 1")->num_rows() == 0)
		{
			$result['msg'] = "原密码输入错误，请确认";
		}
		else
		{
			$this->db->query("update {$tb_member} set password='{$password}' where id={$mid} limit 1");
			$result['status'] = true;
		}
		echo json_encode($result);
	}

	/*会员注册*/
	function register()
	{
		$result = array('status' => false, 'msg' => '');
		$tb_member = $this->db->dbprefix('member');

		/*先判断会员名是否合法，以及是否存在*/
		$name = trim($this->input->post('name'));
		$validate = $this->_validate_name($name);
		if( ! $validate['status'])
		{
			$result['msg'] = $validate['msg'];
			echo json_encode($result);
			exit;
		}
		if($this->db->query("select count(1) as num from {$tb_member} where name='{$name}' limit 1")->row()->num > 0 OR $this->db->query("select count(1) as num from {$this->db->dbprefix('dummy')} where name='{$name}' limit 1")->row()->num > 0)
		{
			$result['msg'] = '该会员名已存在，请重新填写';
			echo json_encode($result);
			exit;
		}

		/*会员名没问题，来验证手机号和对应的短信验证码吧*/
		$phone = trim($this->input->post('phone'));
		$sns = trim($this->input->post('sns'));
		if($phone == $this->session->userdata('phone') AND $sns == $this->session->userdata('sns'))
		{
			$this->session->unset_userdata('phone');
			$this->session->unset_userdata('sns');
		}
		else
		{
			$result['msg'] = '手机号和验证码不对应';
			echo json_encode($result);
			exit;
		}
		
		/*会员名和手机验证都没问题，都就OK了，可以注册*/
		$info = array('gid' => 2, 'name' => $name, 'password' => md5($this->input->post('pwd')), 'phone' => sha1($phone), 're_time' => date('Y-m-d H:i:s'), 'ip' => parent::get_ip());
		$this->db->insert('member', $info);
		$this->_insert_hujiao($phone, $name); /*进入呼叫系统*/

		$result['status'] = true;
		echo json_encode($result);
	}

	/*会员登录*/
	function login()
	{
		$result = array('status' => false, 'msg' => '');

		/*先判断验证码是否正确*/
		$captcha = strtolower($this->input->post('captcha'));
		if($captcha != $this->session->userdata('captcha'))
		{
			$result['msg'] = '验证码不正确，请重新输入';
			echo json_encode($result);
			exit;
		}

		/*再来判断账号是否存在*/
		$user = $this->input->post('user');
		$encrypt_user = sha1($user);
		$member = $this->db->query("select id,gid,name,password from {$this->db->dbprefix('member')} where name='{$user}' OR phone='{$encrypt_user}' limit 1");
		if($member->num_rows() == 0)
		{
			$result['msg'] = '您输入的账号不存在，请确认账号';
			echo json_encode($result);
			exit;
		}

		/*账号存在，来判断密码吧*/
		$pwd = $this->input->post('pwd');
		$member = $member->row_array();
		if(md5($pwd) != $member['password'])
		{
			$result['msg'] = '您的密码不正确，请重新输入';
			echo json_encode($result);
			exit;
		}

		/*好，所有一切都没问题，那就设置登录信息*/
		$this->session->set_userdata('is_login', 1);
		$this->session->set_userdata('name', $member['name']);
		$this->session->set_userdata('gid', $member['gid']);
		$ip = parent::get_ip();
		$this->session->set_userdata('ip', $ip);
		$this->session->set_userdata('mid', $member['id']);

		/*将他的最后登陆时间以及现在IP更新进数据库*/
		$this->db->update('member', array('ip' => $ip, 'login_time' => date('Y-m-d H:i:s')), array('id' => $member['id']));

		/*再将他的在线情况存入redis(mid,gid,name)，同时设置过期时间70S*/
		$redis = parent::redis_conn();
		$redis->setex( "member_list_{$this->session->userdata('rid')}_1_{$member['id']}_{$member['gid']}", 70, json_encode( array('mid' => $member['id'], 'gid' => $member['gid'], 'name' => $member['name'] ) ) );
		unset($redis);

		$result['status'] = true;
		echo json_encode($result);
	}
	

	/*退出会员登录*/
	function logout()
	{
		/*先从redis中删除他的信息*/
		$redis = parent::redis_conn();
		$mid = $this->session->userdata('mid');
		$gid = $this->session->userdata('gid');
		$rid = $this->session->userdata('rid');
		$redis->del("member_list_{$rid}_1_{$mid}_{$gid}");

		$this->session->sess_destroy();
		header("Location:".base_url()."room/{$rid}");
	}

	/*投左上角那个看涨看平看空的票*/
	function stock_vote()
	{
		$result = array('status' => false, 'msg' => '');
		/*先看有没有登录，必须登录才能投票*/
		if( ! $this->session->userdata('is_login') )
		{
			$result['msg'] = '请登录后再投票';
			echo json_encode($result);
			exit;
		}

		/*再看他是否已经投过票了*/
		$mid = $this->session->userdata('mid');
		$tb_vote = $this->db->dbprefix('stock_vote');
		$is_vote = $this->db->query("select count(1) as num from {$tb_vote} where mid={$mid} limit 1 ")->row()->num;
		if($is_vote > 0)
		{
			$result['msg'] = '你已经投过票了';
			echo json_encode($result);
			exit;
		}

		/*让他投票*/
		$vote = (int)$this->input->post('vote');
		$this->db->insert($tb_vote, array('mid' => $mid, 'vote' => $vote));
		$result['status'] = true;
		$this->db->cache_delete_all();
		echo json_encode($result);
	}

	/*名师榜中给专家投票*/
	function specialist_vote()
	{
		$result = array('status' => false, 'msg' => '');
		/*先看有没有登录，必须登录才能投票*/
		if( ! $this->session->userdata('is_login') )
		{
			$result['msg'] = '请登录后再投票';
			echo json_encode($result);
			exit;
		}

		/*再看他今天是否已经投过票了*/
		$mid = $this->session->userdata('mid');
		$tb_vote = $this->db->dbprefix('specialist_vote');
		$is_vote = $this->db->query("select count(1) as num from {$tb_vote} where mid={$mid} and DATE_FORMAT(NOW(),'%Y-%m-%d') = DATE_FORMAT(date,'%Y-%m-%d') limit 1 ")->row()->num;
		if($is_vote > 0)
		{
			$result['msg'] = '您今天已经给老师投过票了，请记得明天继续支持老师哦';
			echo json_encode($result);
			exit;
		}

		/*让他投票*/
		$sid = (int)$this->input->post('id');
		$this->db->insert($tb_vote, array('mid' => $mid, 'sid' => $sid, 'date' => date("Y-m-d")));
		$result['status'] = true;
		echo json_encode($result);
	}


/*-----------------------------------------以下为私有方法---------------------------------------------------*/

	/*验证用户名的合法性，3到15的长度，只能由字母，数字和下划线的组合*/
	private function _validate_name($name)
	{
		$result = array('status' => false, 'msg' => '');
		$len = mb_strlen($name);
		if($len < 3 OR $len > 20)
		{
			$result['msg'] = "用户名的长度为3到20之间";
		}
		elseif( ! preg_match('/^[A-Za-z0-9_\x7f-\xff]+$/', $name))
		{
			$result['msg'] = '用户名只能由汉字，大小写字母，数字和下划线组成';
		}
		else
		{
			$result['status'] = true;
		}
		return $result;
	}

	private function _insert_hujiao($phone, $name)
	{
		$title = '直播室会员注册';
		$province = $this->_get_province(parent::get_ip());
		$time = date("Y-m-d H:i:s");
		$info = array('name' => $name, 'time' => $time, 'title' => $title, 'phone' => $phone, 'province' => $province, 'STRINGFIELD4' => '');
		$this->load->library('lib_hujiao');
		return $this->lib_hujiao->insert($info);
	}

	private function _get_province($ip)
	{
		$result = json_decode( file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip={$ip}"), true );
		if($result['code'] == 0)
		{
			return $result['data']['region'];
		}
		else
		{
			return '';
		}
	}

	/*检查登录情况*/
	private function _check_member_login()
	{
		if( ! $this->session->userdata('is_login') )
		{
			show_404();
			exit;
		}
	}
}