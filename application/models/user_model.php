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
	 * @return integer 已存在-1 失败0 用户id>0
	 */
	public function register($phone, $password, $sex,
		$college, $major, $specialty)
	{
		$sex = intval($sex);
		$college = intval($college);
		$major = intval($major);
		if($sex != 1 && $sex != 2)
			$sex = 0;
		if(!is_numeric($college) || !is_numeric($major))
			return 0;
		if($this->_select_field('u_user','user_id',array('u_phone'=>$phone)))
			return -1;
		$data = array(
				'u_phone' => $phone,
				'u_password' => MD5($password),
				'u_sex' => $sex,
				'college_id' => $college,
				'major_id' => $major,
				'u_specialty' => $specialty
			);
		return $this->_insert('u_user', $data);
	}
	/**
	 * 获取用户信息
	 * @param  integer $id 用户id
	 * @return NULL/array
	 */
	public function user_information($id)
	{
		$id = intval($id);
		$this->db->select('user_id as id,u_phone as phone,u_sex as sex,
			u_user.college_id, u_college.cl_name,
			u_user.major_id,   u_major.mj_name,
			u_specialty as specialty');
		$this->db->from('u_user');
		$this->db->join('u_college', 'u_user.college_id=u_college.college_id', 'left');
		$this->db->join('u_major', 'u_user.major_id=u_major.major_id', 'left');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return NULL;
		}
	}
	
}


/* End of file user_model.php */
/* Location: ./application/model/user_model.php */