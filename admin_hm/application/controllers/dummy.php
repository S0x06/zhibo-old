<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dummy extends MY_Controller {

	private $redis;
	function __construct()
	{
		parent::__construct();
		parent::check_permission('member');
		$this->redis = parent::redis_conn();
	}

	public function index()
	{
		$this->dummy_list();
	}

	function dummy_list($rid = '', $page = 1)
	{
		$tb_group = $this->db->dbprefix('group');
		$tb_dummy = $this->db->dbprefix('dummy');
		$this->out_data['group_list'] = $this->db->query("select id,name from {$tb_group}")->result_array();
		$this->out_data['room_list'] = $this->db->query("select id,name from {$this->db->dbprefix('room')}")->result_array();
		if($rid == '') $rid = $this->out_data['room_list'][0]['id'];

		$limit = 20;
		$start = ($page - 1)*$limit;
		$this->out_data['dummy_list'] = $this->db->query("select d.id,d.gid,d.name,g.name as gname from {$tb_dummy} as d inner join {$tb_group} as g on g.id=d.gid limit {$start},{$limit}")->result_array();
		/*查看这些假人在该房间都是否有上线啊*/
		foreach($this->out_data['dummy_list'] as $k => $v)
		{
			if($this->redis->exists("member_list_{$rid}_0_{$v['id']}_{$v['gid']}")) $this->out_data['dummy_list'][$k]['is_online'] = true;
			else $this->out_data['dummy_list'][$k]['is_online'] = false;
		}

		/*假人分页*/
		$count = $this->db->query("select count(1) as num from {$tb_dummy}")->row()->num;
		$this->out_data['pagin'] = parent::get_pagin(base_url()."dummy/dummy_list/{$rid}/", $count, $limit, 4);

		$this->out_data['room_id'] = $rid;
		$this->out_data['con_page'] = 'dummy_list';
		$this->load->view('default', $this->out_data);
	}

	function save_dummy()
	{
		$info = array('name' => $this->input->post('name'),
			'gid' => $this->input->post('gid'));
		$result = array('status' => false, 'msg' => '');
		$tb_member = $this->db->dbprefix('member');
		$tb_dummy = $this->db->dbprefix('dummy');
		if($this->db->query("select count(1) as num from {$tb_member} where name='".$info['name']."' limit 1")->row()->num > 0 OR $this->db->query("select count(1) as num from {$tb_dummy} where name='".$info['name']."' limit 1")->row()->num > 0 )
		{
			$result['msg'] = '该用户名称已存在，请重新输入';
		}
		else
		{
			$this->db->insert($tb_dummy, $info);
			$result['status'] = true;
		}
		echo json_encode($result);
	}

	function del_dummy()
	{
		$id = $this->input->post('id');
		$gid = $this->input->post('gid');
		$room_list = $this->db->query("select id,name from {$this->db->dbprefix('room')}")->result_array();
		foreach($room_list as $v)
		{
			/*要从各个房间删除假人*/
			$this->redis->del("member_list_{$v['id']}_0_{$id}_{$gid}");
		}
		$this->db->delete("dummy", array('id' => $id));
	}

	function dummy_online()
	{
		$ids = $this->input->post('ids');
		$gids = $this->input->post('gids');
		$rid = $this->input->post('rid');
		$tb_dummy = $this->db->dbprefix('dummy');
		foreach($ids as $k => $v)
		{
			$info = $this->db->query("select id,gid,name from {$tb_dummy} where id={$ids[$k]} limit 1")->row_array();
			$this->redis->set("member_list_{$rid}_0_{$ids[$k]}_{$gids[$k]}", json_encode($info));
		}
	}

	function dummy_offline()
	{
		$ids = $this->input->post('ids');
		$gids = $this->input->post('gids');
		$rid = $this->input->post('rid');
		$tb_dummy = $this->db->dbprefix('dummy');
		foreach($ids as $k => $v)
		{
			$this->redis->del("member_list_{$rid}_0_{$ids[$k]}_{$gids[$k]}");
		}
	}
}