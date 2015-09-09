<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class strategy extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		show_404();
	}

	function get_strategy()
	{
		if($_SERVER['REQUEST_METHOD' ] !== 'POST') show_404();
		$this->load->database();
		$result = array('status' => false, 'msg' => '');

		if( ! $this->session->userdata('is_login'))
		{
			/*都没登录，不用查也知道没权限*/
			echo json_encode($result);
			exit;
		}

		$id = (int)$this->input->post('id');
		$mid = $this->session->userdata('mid');
		$strategy = $this->db->query("select tid,gid,title,position,profit,stop,reason from {$this->db->dbprefix('strategy')} where id={$id} limit 1")->row_array();
		if($strategy['tid'] != 0)
		{
			/*该策略是老师策略*/
			$tid = $this->db->query("select tid from {$this->db->dbprefix('member')} where id={$mid} limit 1")->row()->tid;
			if($tid == $strategy['tid'])
			{
				$result['status'] = true;
				$result['msg'] = $strategy;
			}
		}
		else if($strategy['gid'] == $this->session->userdata('gid'))
		{
			$result['status'] = true;
			$result['msg'] = $strategy;
		}
		echo json_encode($result);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */