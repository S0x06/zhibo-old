<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class lib_hujiao {

	public function __construct()
	{

	}

	/*array('name' => $name, 'phone' => $phone, 'title' => $title, 'time' => $time, 'province' => $province, 'STRINGFIELD4' => $STRINGFIELD4)*/
	function insert($arr)
	{
		$CI =& get_instance();
		$ProjectID = 10000009;
		$OutCallID = '10000254';
		$arr['out_call_id'] = $OutCallID;
		$arr['source'] = 'zbzy1_'.date('Ymd');
		$str = $CI->load->view('tpl_hujiao', $arr, true);
		$str = str_replace('<\?', '<?', $str);
		$str = $this->_encrypt($str);
		$result = file_get_contents("http://140.207.79.210/web/YWInterface.asmx/GetInformationlist?ProjectID={$ProjectID}&OutCallID={$OutCallID}&xml={$str}");
		// if($this->_is_success($result))
		// {
		// 	return true;
		// }
		// else
		// {
		// 	return false;
		// }
	}

	private function _is_success($xml_string)
	{
		$result = simplexml_load_string($xml_string);
		$result = @json_decode(@json_encode($result),1);
		$result = simplexml_load_string($result[0]);
		$result = @json_decode(@json_encode($result),1);
		if((int)$result['info']['Succeed'] == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	private function _encrypt($str)
	{	$str = mb_convert_encoding($str, 'GBK', 'UTF-8');
		preg_match_all("/./", $str, $arr);
		$result = '';
		foreach($arr[0] as $v)
		{
			$v = ord($v);
			$i = $v < 0 ? $v+256 : $v;
			$s = (int)($i/26);
			$y = $i%26;
			$result .= (string)($s.($y < 10 ? '0'.$y : $y));
		}
		return $result;
	}
}