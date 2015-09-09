<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		show_404();
	}

	function img()
	{
		if($_SERVER['REQUEST_METHOD' ] !== 'POST') show_404();

		$result = array('status' => false, 'msg' => '');

		if( ! $this->session->userdata('is_login'))
		{
			/*都没登录，不用查也知道没权限上传图片*/
			$result['msg'] = "请登录后再发送图片";
			echo json_encode($result);
			exit;
		}

		$allowed = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/bmp', 'image/png', 'image/jpg');
		if (in_array(strtolower($_FILES['upload_img']['type']), $allowed))
		{
			if ($_FILES["upload_img"]["error"] === 0)
			{
				$ext = pathinfo($_FILES["upload_img"]["name"], PATHINFO_EXTENSION);
				$img = time().rand(100,999).'.'.$ext;
				$floder = 'upload/chat/'.date("Y-m-d").'/';
				if(!file_exists($floder)) mkdir($floder);

				move_uploaded_file($_FILES["upload_img"]["tmp_name"], $floder.$img);
				$result['status'] = true;
				$result['img'] = $floder.$img;
			}
			else
			{
				$result['msg'] = $_FILES["upload_img"]["error"];
			}
		}
		else
		{
			$result['msg'] = '不支持的图片格式';
		}

		echo json_encode($result);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */