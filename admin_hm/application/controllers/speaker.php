<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class speaker extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		parent::check_permission('speaker');
	}
	public function index()
	{
		$this->out_data['con_page'] = 'speaker';
		$this->load->view('default',$this->out_data);

	}

	private function _get_rid_list()
	{
		return explode(',', $this->session->userdata('rid'));
	}

	function get_check_data()
	{
		$score = $this->input->post('score');
		if( ! $score ) $score = date("Y-m-d H:i:s");
		$this->out_data['check_list'] = array();
		$this->out_data['check_list']['score'] = $score;
		$this->out_data['check_list']['data_list'] = array();
		
		$room = $this->session->userdata('rid');
		$room = "'".str_replace(',', "','", $room)."'";
		
		for($i = 0; $i < 10; $i++)
		{
			
			$this->out_data['check_list']['data_list'] = $this->db->query("select rid,name,time,content from {$this->db->dbprefix('chat_list')} where rid in($room) and types = 0 and time > '{$score}' order by time asc")->result_array();
			if(count($this->out_data['check_list']['data_list']) > 0)
			{
				$time = end($this->out_data['check_list']['data_list']);
				$this->out_data['check_list']['score'] = $time['time'];
			
				/*判断有没有数据，有，输出，没有，继续循环*/
	 			echo json_encode($this->out_data['check_list']);
				ob_flush();
				flush();
				break;
			}

			sleep(3);
			clearstatcache();
		}
		exit();
	}
}