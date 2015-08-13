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

	public function json()
	{
		$url = 'http://localhost/next/record/add/';
		$arr = array('userid'=>'2','isbn'=>'123456','title'=>'ceshishu',
		'publisher'=>'mc','author'=>'wu','translator'=>'wo','summary'=>'meiyou',
		'categoryid'=>1,'explain'=>'meiyoushuoming','img'=>"\/uploads\/2015\/05\/2b19b06578f3363aedc8684c2e30873c.jpg");

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
				CURLOPT_URL => $url,
				CURLOPT_POSTFIELDS => $data,
				CURLOPT_HTTPHEADER => $header
			));
		$ret = curl_exec($curl);
		echo '<div style="border: solid 1px red;">' . $ret . '</div><br>';
		$ret = json_decode($ret, true);
		echo '<pre>'.print_r($ret,true).'</pre>';
	}

	public function post()
	{
		$url = 'http://localhost/next/record/recordlist/';
		$arr = array('page'=>0,'num'=>2);

		$arr['time'] = time();
		$data = '';
		foreach ($arr as $key => $value) {
			$data .= $key . '=' . $value . '&';
		}
		$curl = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_POST => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_URL => $url . '?' . $data,
				CURLOPT_POSTFIELDS => $data
			));
		$ret = curl_exec($curl);
		echo '<div style="border: solid 1px red;">' . $ret . '</div><br>';
		$ret = json_decode($ret, true);
		echo '<pre>'.print_r($ret,true).'</pre>';
	}

	public function upload()
	{
		$this->load->helper('url');
		$this->load->view('upload_test');
	}

}