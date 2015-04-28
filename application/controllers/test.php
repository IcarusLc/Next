<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	protected $json;

	public function index($input_json)
	{
		$this->lang->load('user', 'chinese');
		$this->load->library('RSAUtils');

		// $input_json = file_get_contents('php://input');
		$input_json = $this->rsautils->decrypt($input_json);
		if(empty($input_json))
			exit('{"code":100,"msg":"'.$this->lang->line('error_100').'"}');
		
		$this->json = json_decode($input_json, true);
		if( empty($this->json) )
			exit('{"code":101,"msg":"'.$this->lang->line('error_101').'"}');

		echo '<pre>'.print_r($this->json,true).'</pre>';
	}

}
