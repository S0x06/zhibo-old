<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class single extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		parent::check_permission('base');
	}

	public function index()
	{
		$this->page_list();
	}

	function page_list()
	{
		$this->out_data['con_page'] = 'page_list';
		$this->load->model('md_single');
		$this->out_data['page_list'] = $this->md_single->get_page_list();
		$this->load->view('default', $this->out_data);
	}

	function edit_page($page_id = 0)
	{
		$page_id = (int)$page_id;

		$this->load->model('md_single');
		$page_info = $this->md_single->get_page($page_id);

		$this->out_data['page_info'] = $page_info;
		$this->out_data['con_page'] = 'page_edit';
		$this->load->view('default', $this->out_data);
	}

	function del_page()
	{
		$id = (int)$this->input->post('id');
		$this->load->model('md_single');
		$this->md_single->del_page($id);
		$this->db->cache_delete_all();
	}

	function save_page()
	{
		$info = array(
		'title' => $this->input->post('title'),
		'content' => $this->input->post('content'),
		'flag' => $this->input->post('flag'),
		'url' => $this->input->post('url'));
		$id = (int)$this->input->post('id');
		$this->load->model('md_single');
		echo json_encode($this->md_single->save_page($id, $info));
		$this->db->cache_delete_all();
	}
}