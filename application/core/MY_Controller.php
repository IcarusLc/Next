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
		if($this->encrypt) // 开启加密
		{
			$this->load->library('RSAUtils');
			$input_json = $this->rsautils->decrypt($input_json);
			if(empty($input_json))
				exit('{"code":100,"msg":"'.$this->lang->line('error_100').'"}');
		}
		$this->json = json_decode($input_json, true);
		if( empty($this->json) )
			exit('{"code":101,"msg":"'.$this->lang->line('error_101').'"}');
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
	
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */