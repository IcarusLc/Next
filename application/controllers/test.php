<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	protected $json;
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('user', 'chinese');
		$this->load->library('RSAUtils');
	}

	public function show($input_json = "")
	{
		// $input_json = file_get_contents('php://input');
		$input_json = $this->rsautils->decrypt($input_json);
		if(empty($input_json))
			exit('{"code":100,"msg":"'.$this->lang->line('error_100').'"}');
		
		$this->json = json_decode($input_json, true);
		if( empty($this->json) )
			exit('{"code":101,"msg":"'.$this->lang->line('error_101').'"}');

		print_r($this->json);
	}

	public function fuck()
	{
		$url = 'http://localhost/next/record/replylist/';
		$arr = array('record'=>1);

		$arr['time'] = time();
		$data = json_encode($arr);
		$header = array(
				'Content-type: application/json'
			);
		$rsa = new RSAUtils(false);
		$data = $rsa->encrypt($data);
		$curl = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_POST => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_URL => $url.$data,
				CURLOPT_POSTFIELDS => $data,
				CURLOPT_HTTPHEADER => $header
			));
		$ret = curl_exec($curl);
		echo '<div style="border: solid 1px red;">' . $ret . '</div><br>';
		$ret = json_decode($ret, true);
		echo '<pre>'.print_r($ret,true).'</pre>';
	}

}