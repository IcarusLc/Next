<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends MY_Model{
	function __construct()
	{
		$this->load->database();
	}
	
	/**
	 * 获取密码
	 * @param  string $user 电话号码
	 * @return string       密码MD5
	 */
	public function get_password($user)
	{
		return $this->_select_field(
				'u_user',
				'u_password',
				array('u_phone'=>$user)
			);
	}

	/**
	 * 注册用户
	 * @param  string $phone     
	 * @param  string $password  
	 * @param  int    $sex       
	 * @param  int    $college   
	 * @param  string $major     
	 * @param  string $specialty 
	 * @return boolean           
	 */
	public function register($phone, $password, $sex,
		$college, $major, $specialty)
	{
		if($sex != 1 || $sex != 2)
			$sex = 0;
		if(!is_numeric($college) || !is_numeric($major))
			return false;
		$data = array(
				'u_phone' => $phone,
				'u_password' => MD5($password),
				'u_sex' => $sex,
				'college_id' => $college,
				'major_id' => $major_id,
				'u_specialty' => $specialty
			);
		$this->db->insert('u_user', $data);
		if($this->db->affected_rows() > 0)
			return true;
		return false;
	}
	
}


/* End of file user_model.php */
/* Location: ./application/model/user_model.php */