<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	private $encrypt = true;
	protected $json;

	function __construct($no_json = false)
	{
		parent::__construct();
		$this->lang->load('user', 'chinese');
		if($no_json) return; // 选项no_json则不需要json
		$input_json = file_get_contents('php://input');
		if($this->encrypt) // 解密
		{
			$this->load->library('RSAUtils');
			$input_json = $this->rsautils->decrypt($input_json);
			if(empty($input_json))
				exit($this->_error(100));
		}
		// 解析json字符串
		$this->json = json_decode($input_json, true);
		if( empty($this->json) )
			exit($this->_error(101));
		// 验证时间戳
		if(!isset($this->json['time']) || abs($this->json['time'] - time()) > 300)
			exit($this->_error(107));
	}

	protected function _display_json($code, $msg, $extra=array())
	{
		if(! is_array($extra))
			throw new Exception("Extra information must be an array.", 400);
			
		$json = array('code'=>$code, 'msg'=>$msg);
		if(! empty($extra))
			$json = array_merge($json, $extra);
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
		return NULL;
	}

	protected function _error($code, $extra=array())
	{
		return $this->_display_json(
			$code,
			$this->lang->line('error_' . $code),
			$extra
		);
	}
	
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */