<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	const METHOD_GET  = 0xac01;
	const METHOD_POST = 0xac02;
	const METHOD_JSON = 0xac02;

	private $get_method = self::METHOD_POST;
	private $encrypt = TRUE;
	protected $json;

	function __construct($no_json = FALSE)
	{
		parent::__construct();
		$this->lang->load('user', 'chinese');
		if($no_json) return; // 选项no_json则不需要json
		switch ($this->get_method) {
			case self::METHOD_GET:
				$this->json = $this->input->get();
				break;

			case self::METHOD_POST:
				$this->json = $this->input->post();
				break;

			case self::METHOD_JSON:
				$input_json = file_get_contents('php://input');
				if($this->encrypt) // 解密
				{
					$input_json = $this->_decrypt_input($input_json);
				}
				$this->_parse_json($input_json);
				$this->_check_time();
				break;
			
			default:
				throw new Exception("Error get method", 1);
				break;
		}
	}

	/**
	 * 解密字符串
	 * @param  string $str
	 * @return string
	 */
	protected function _decrypt_input($str)
	{
		if(! isset($this->rsautils))
			$this->load->library('RSAUtils');
		$input_json = $this->rsautils->decrypt($str);
		if(empty($input_json))
			exit($this->_error(100));
		return $input_json;
	}

	/**
	 * 解析json字符串
	 * @param string $input_json
	 */
	protected function _parse_json($input_json)
	{
		$this->json = json_decode($input_json, TRUE);
		if( empty($this->json) )
			exit($this->_error(101));
	}

	/**
	 * 验证时间戳
	 */
	protected function _check_time()
	{
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
		echo json_encode($json);
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

	protected function _get($key, $default='')
	{
		if(isset($this->json[$key]))
			return $this->json[$key];
		return $default;
	}
	
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */