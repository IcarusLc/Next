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
			return $this->_error(102);
		
		$user = $this->json['user'];
		$user_password = $this->user_model->get_password($user);
		if(! $user_password)
			return $this->_error(103);

		$password = md5( $this->json['pass'] );
		if($password == $user_password)
			$this->_display_json(0, $this->lang->line('succ_login'));
		else
			$this->_error(104);
	}
	/**
	 * 注册
	 */
	public function register()
	{
		if(!(isset($this->json['user']) && isset($this->json['pass'])))
			return $this->_error(102);
		if(!is_numeric($this->json['major']))
			return $this->_error(106);

		$succ = $this->user_model->register(
				$this->json['user'],
				$this->json['pass'],
				$this->_get('name'),
				$this->_get('sex'),
				$this->json['major'],
				$this->_get('specialty'),
				$this->_get('img')
			);
		if(!$succ)
			return $this->_error(105);
		if($succ == -1)
			return $this->_error(108);
		$this->_display_json(
			0,
			$this->lang->line('succ_register'),
			array('userid' => $succ)
		);
	}
	/**
	 * 获取账户信息
	 */
	public function info()
	{
		if(!isset($this->json['userid']))
			return $this->_error(102);

		$info = $this->user_model->user_information($this->json['userid']);
		if($info === NULL)
			return $this->_error(103);
		switch ($info['sex']) {
			case 1:
				$info['sex'] = '男';
				break;
			case 2:
				$info['sex'] = '女';
				break;
			default:
				$info['sex'] = '';
				break;
		}
		$this->_display_json(0, '', $info);
	}
	/**
	 * 修改用户资料 
	 */
	public function modify()	
	{
		if(!is_numeric($this->json['major']))
			return $this->_error(106);
		$succ = $this->user_model->modify(
				$this->json['user'],
				$this->json['pass'],
				$this->_get('sex'),
				$this->_get('name'),
				$this->json['major'],
				$this->_get('specialty'),
				$this->_get('img')
			);

		if(!$succ)
			return $this->_error(109);
		if($succ == -1)
			return $this->_error(103);
		$this->_display_json(
			0,
			$this->lang->line('succ_modify')
		);
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */