<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * this is the base controller
	 * all the controller must extends base controller
	 */
	protected $out_data;
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$ip = self::get_ip();
		if($this->db->query("select count(1) as num from {$this->db->dbprefix('ipban')} where ip='{$ip}' limit 1")->row()->num > 0)
		{
			show_404();
			exit;
		}
	}

	/*连接redis*/
	protected function redis_conn()
	{
		$redis = new Redis();
		$redis->connect('127.0.0.1', 6379);
		return $redis;
	}

	/*获取真实IP*/
	protected function get_ip()
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '')
		{
			$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$ip = $ip[0];
		}
		return $ip;
	}

	/**
	 * 获取在线列表
	 * @param  integer $is_member [是获取真实访客还是假人呢？]
	 * @param  string $rid [房间ID]
	 * @return [array]     [以group_id为索引分类的二维列表数组]
	 */
	protected function get_online_list($rid, $is_member = 1)
	{
		$redis = self::redis_conn();
		$online_list = $redis->keys("member_list_{$rid}_{$is_member}_*");
		$online_list = $redis->mget($online_list);
		$result = array();
		if(is_array($online_list))
		{
			foreach($online_list as $v)
			{
				$v = json_decode($v, true);
				if( ! isset($result[$v['gid']]) ) $result[$v['gid']] = array();

				$result[$v['gid']][] = $v;
			}
		}
		return $result;
	}
}