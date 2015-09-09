<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class book extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		show_404();
	}

	function get_book()
	{
		if($_SERVER['REQUEST_METHOD' ] !== 'POST') show_404();
		$result = array('status' => false, 'msg' => '');

		$book = array('qiankun' => array('pwd' => 'yiyin852addf', 'file' => 'qiankun.pdf'),
			'diancang' => array('pwd' => 'yiyin945dsfg', 'file' => 'diancang.pdf'),
			'shengjing' => array('pwd' => 'yiyin798hdjy', 'file' => 'shengjing.rar'),
			'huangbai' => array('pwd' => 'yiyin564ddse', 'file' => 'huangbai.pdf'),
			'oil' => array('pwd' => 'yiyin753dian', 'file' => 'oil.pdf'),
			'baiyin' => array('pwd' => 'yiyin159bacc', 'file' => 'baiyin.pdf')
			);
		// $book = array('baihu' => array('pwd' => 'yiyin124trtc', 'file' => 'baihu.pdf'),
		// 	'canghai' => array('pwd' => 'yiyin852addf', 'file' => 'canghai.pdf'),
		// 	'longxing' => array('pwd' => 'yiyin945dsfg', 'file' => 'longxing.pdf'),
		// 	'yuyue' => array('pwd' => 'yiyin798hdjy', 'file' => 'yuyue.rar'),
		// 	'zhuque' => array('pwd' => 'yiyin564ddse', 'file' => 'zhuque.pdf'),
		// 	'oil' => array('pwd' => 'yiyin753dian', 'file' => 'oil.pdf'),
		// 	'baiyin' => array('pwd' => 'yiyin159bacc', 'file' => 'baiyin.pdf')
		// 	);
		$name = $this->input->post('name');
		$pwd = trim($this->input->post('pwd'));
		if(isset($book[$name]) AND $book[$name]['pwd'] == $pwd)
		{
			$result['status'] = true;
			$result['msg'] = $book[$name]['file'];
		}
		else
		{
			$result['msg'] = '您的密码错误，您可以点击下方客服QQ获取正确密码';
		}
		echo json_encode($result);
	}

	function download()
	{
		$file = $this->input->get('file');
		$file_array = array('qiankun.pdf', 'diancang.pdf', 'shengjing.rar', 'huangbai.pdf', 'oil.pdf', 'baiyin.pdf');
		// $file_array = array('baihu.pdf', 'canghai.pdf', 'longxing.pdf', 'yuyue.pdf', 'zhuque.pdf', 'oil.pdf', 'baiyin.pdf');
		if(in_array($file, $file_array))
		{
			$this->_download_book("http://soft.gdyy99.com/upload/zhibo/{$file}");
		}
	}

	private function _download_book($file)
	{
		header('Content-Description: File Download');
		header('Content-type: application.octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */