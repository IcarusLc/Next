<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	/**
	 * 登陆
	 */
	public function login()
	{
		if(!(isset($this->json['user']) && isset($this->json['pass'])))
			return $this->_display_json(102, $this->lang->line('error_102'));
		
		$user = $this->json['user'];
		$user_password = $this->user_model->get_password($user);
		if(! $user_password)
			return $this->_display_json(103, $this->lang->line('error_103'));

		$password = md5( $this->json['pass'] );
		if($password == $user_password)
			return $this->_display_json(0, $this->lang->line('succ_login'));
		else
			return $this->_display_json(104, $this->lang->line('error_104'));
	}
	/**
	 * 注册
	 */
	public function register()
	{
		if(!(isset($this->json['user']) && isset($this->json['pass'])))
			return $this->_display_json(102, $this->lang->line('error_102'));
		if(!is_numeric($this->json['college'])
			|| !is_numeric($this->json['major']))
			return $this->_display_json(106, $this->lang->line('error_106'));
		$succ = $this->user_model->register(
				$this->json['user'],
				$this->json['pass'],
				$this->json['sex'],
				$this->json['college'],
				$this->json['major'],
				$this->json['specialty']
			);
		if($succ)
			return $this->_display_json(0, $this->lang->line('succ_register'));
		return $this->_display_json(105, $this->lang->line('error_105'));
	}
	/**
	 * 获取账户信息
	 */
	public function info()
	{

	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */