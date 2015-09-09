<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		parent::check_permission('member');
		$this->out_data['current_function'] = 'member';
	}

	public function index()
	{
		$this->group();
	}

	function group()
	{
		$this->out_data['group'] = $this->db->query("select id,name,sort from {$this->db->dbprefix('group')} order by sort desc")->result_array();
		$this->out_data['con_page'] = 'group';
		$this->load->view('default', $this->out_data);
	}

	function group_edit($id = -1)
	{
		$id = (int)$id;
		$info = $this->db->query("select id,name,sort from {$this->db->dbprefix('group')} where id={$id} limit 1");
		if($info->num_rows() > 0)
		{
			$info = $info->row_array();
		}
		else
		{
			$info = array('id' => -1, 'name' => '', 'sort' => 0);
		}
		$this->load->library('lib_elements');
		$info['icon'] = $this->lib_elements->get_file_element(array('title' => '会员组勋章', 'name' => 'icon', 'img' => '../images/level/level'.$info['id'].'.png'));

		$this->out_data['info'] = $info;
		$this->out_data['con_page'] = 'group_edit';
		$this->load->view('default', $this->out_data);
	}

	function group_update()
	{
		$id = (int)$this->input->post('id');
		$name = $this->input->post('name');
		$icon = $this->input->post('icon');
		$sort = $this->input->post('sort');

		if($id == -1)
		{
			$this->db->insert('group', array('name' => $name, 'sort' => $sort));
			$id = $this->db->insert_id();
		}
		else
		{
			$this->db->update('group', array('name' => $name, 'sort' => $sort), array('id' => $id));
		}
		$this->load->library('lib_elements');
		$this->lib_elements->move_img($icon, '../images/level/level'.$id.'.png');
	}

	function member_list()
	{
		$page = $this->input->get('per_page') ? $this->input->get('per_page') : 1;
		$search = $this->input->get('search');
		$encrypt_search = sha1($search);
		$query_search = '';
		if($search) $query_search = " AND (m.name LIKE '%{$search}%' OR m.phone = '{$encrypt_search}') ";

		$tb_member = $this->db->dbprefix('member');
		$tb_group = $this->db->dbprefix('group');
		$tb_teacher = $this->db->dbprefix('teacher');
		$limit = 20;
		$start = ($page - 1)*$limit;
		$query_memeber_list = "select m.id,m.name,m.re_time,m.login_time,g.name as gname,t.name as tname from {$tb_member} as m left join {$tb_group} as g on m.gid=g.id left join {$tb_teacher} as t on m.tid=t.id where 1 = 1 {$query_search} order by re_time desc limit {$start},{$limit}";
		$this->out_data['member_list'] = $this->db->query($query_memeber_list)->result_array();

		$query_count = "select count(1) as num from {$tb_member} as m where 1 = 1 {$query_search}";
		$count = $this->db->query($query_count)->row()->num;
		$base_url = base_url().'member/member_list/?';
		if($query_search) $base_url .= "search=".$search;
		$this->out_data['pagin'] = parent::get_pagin($base_url, $count, $limit, 3,  true);

		$this->out_data['search'] = $search;
		$this->out_data['con_page'] = 'member_list';
		$this->load->view('default', $this->out_data);
	}

	function member_del($id)
	{
		$this->db->delete('member', array('id' => $id));
	}

	function member_edit($id = 0)
	{
		$this->out_data['group_list'] = $this->db->query("select * from {$this->db->dbprefix('group')}")->result_array();
		$this->out_data['teacher_list'] = $this->db->query("select * from {$this->db->dbprefix('teacher')}")->result_array();
		$this->out_data['member_info'] = $this->db->query("select id,gid,tid,name,phone from {$this->db->dbprefix('member')} where id={$id} limit 1")->row_array();
		if( ! $this->out_data['member_info'])
		{
			$this->out_data['member_info']['id'] = 0;
		}

		$this->out_data['con_page'] = 'member_edit';
		$this->load->view('default', $this->out_data);
	}

	function member_update()
	{
		$phone = $this->input->post('password');
		if(strlen($phone) < 15) $phone = sha1($phone); /*加密手机号*/
		$info = array('name' => $this->input->post('name'),
			'gid' => $this->input->post('gid'),
			'tid' => $this->input->post('tid'),
			'phone' => $phone);
		$password = $this->input->post('password');
		if($password) $info['password'] = md5($password);
		$id = $this->input->post('id');

		$result = array('status' => false, 'msg' => '');

		/*先判断会员名的有合法性比较好*/
		$validate = $this->_validate_name($info['name']);
		if( ! $validate['status'])
		{
			$result['msg'] = $validate['msg'];
			echo json_encode($result);
			exit;
		}

		$tb_member = $this->db->dbprefix('member');
		if($this->db->query("select count(1) as num from {$tb_member} where name='".$info['name']."' and id <> {$id} limit 1")->row()->num > 0 OR $this->db->query("select count(1) as num from {$this->db->dbprefix('dummy')} where name='".$info['name']."'")->row()->num > 0 )
		{
			$result['msg'] = '该会员名称已存在，请重新输入';
		}
		else
		{
			if($id == 0)
			{
				$info['re_time'] = date('Y-m-d H:i:s');
				$this->db->insert($tb_member, $info);
			}
			else
			{
				$this->db->update($tb_member, $info, array('id' => $id));
			}
			$result['status'] = true;
		}
		echo json_encode($result);
	}

	private function _validate_name($name)
	{
		$result = array('status' => false, 'msg' => '');
		if(mb_strlen($name) < 3 OR mb_strlen($name) > 20)
		{
			$result['msg'] = '用户名的长度为3到20之间';
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

}