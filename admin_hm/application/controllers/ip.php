<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ip extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		parent::check_permission('base');
	}

	public function index()
	{
		$this->ip_list();
	}

	function ip_list()
	{
		$this->out_data['ip_list'] = $this->db->query("select id,ip from {$this->db->dbprefix('ipban')}")->result_array();
		$this->out_data['con_page'] = 'ip_list';
		$this->load->view('default', $this->out_data);
	}

	function ip_del($id)
	{
		$id = (int)$id;
		$this->db->delete('ipban', array('id' => $id));
	}

	function ip_save()
	{
		$ip = trim($this->input->post('ip'));
		if($ip != '')
		{
			$tb_ipban = $this->db->dbprefix('ipban');
			if($this->db->query("select count(1) as num from {$tb_ipban} where ip='{$ip}' limit 1")->row()->num == 0)
			{
				$this->db->insert($tb_ipban, array('ip' => $ip));
			}
		}
		header("Location:".base_url()."ip/ip_list");
	}

}