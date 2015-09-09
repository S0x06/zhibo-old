<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sns extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($_SERVER['REQUEST_METHOD' ] !== 'POST') show_404();
		$this->load->database();
	}

	public function index()
	{
		$this->send_captcha();
	}

	function send_captcha()
	{
		$result = array('status' => false, 'msg' => '');
		$phone = $this->input->post('phone');

		/*先判断手机号是否合法*/
		if( ! preg_match("/1[34578]{1}\d{9}$/",$phone) )
		{
			$result['msg'] = '请输入正确的手机号码';
			echo json_encode($result);
			exit;
		}

		/*再判断手机号码有没有注册过*/
		if($this->db->query("select count(1) as num from {$this->db->dbprefix('member')} where phone = '".sha1($phone)."' limit 1")->row()->num > 0)
		{
			$result['msg'] = '该手机号已注册过会员';
			echo json_encode($result);
			exit;
		}

		/*既合法，又没有注册过，SO，可以发送短信验证码了*/
		$target = "http://www.jianzhou.sh.cn/JianzhouSMSWSServer/http/sendBatchMessage";
		$this->load->helper('string');
		$sns = random_string('numeric', 4);
		$post_data = "account=sdk_yiyin&password=62509730&destmobile={$phone}&msgText=您的验证码是：{$sns}。请不要把验证码泄露给其他人。【壹银财富】";
		$gets =  $this->_post($post_data, $target);
		if($gets > 0)
		{
			$result['status'] = true;
			$this->session->set_userdata('phone', $phone);
			$this->session->set_userdata('sns', $sns);
		}
		else
		{
			$result['msg'] = '短信发送失败，请稍候重试';
		}

		echo json_encode($result);
	}

	private function _post($curlPost,$url)
	{
		$header [] = "content-type: application/x-www-form-urlencoded;charset=UTF-8";
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_HEADER, false);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST" );
	    curl_setopt($curl, CURLOPT_NOBODY, true);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, $header );
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
	    $return_str = curl_exec($curl);
	    curl_close($curl);
	    return $return_str;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */