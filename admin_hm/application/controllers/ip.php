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
        //判断是ip还是姓名
        $flag = count(explode('.', $ip));
        if($flag != 4)
        {
            //如果不是ip,看是会员还是游客
            $tb_vis = $this->db->dbprefix('visitor');
            $tb_mem = $this->db->dbprefix('member');
            $vis_ip = $this->db->query("select ip from {$tb_vis} where name='{$ip}' limit 1")->row()->ip;
            $mem_ip = $this->db->query("select ip from {$tb_mem} where name='{$ip}' limit 1")->row()->ip;
            if($vis_ip)
            {
                $ip = $vis_ip;
            }
            else if($mem_ip)
            {
                $ip = $mem_ip;
            }

        }
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

    function ip_search()
    {
        $all_ip = array();
        $name = trim($this->input->post('name'));
        if($name != '')
        {
            $tb_vis = $this->db->dbprefix('visitor');
            $tb_mem = $this->db->dbprefix('member');
            $vis = $this->db->query("select ip from {$tb_vis} where name='{$name}'")->result_array();
            $mem = $this->db->query("select ip from {$tb_mem} where name='{$name}'")->result_array();
            $all_ip = array_merge($vis, $mem);
        }
        echo json_encode($all_ip);
    }

}