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
	 * @param  string 	$phone     
	 * @param  string 	$password  
	 * @param  integer  $sex       
	 * @param  string 	$name      
	 * @param  integer 	$major     
	 * @param  string 	$specialty 
	 * @return integer 已存在-1 失败0 用户id>0
	 */
	public function register($phone, $password, $name,
		$sex, $major, $specialty, $img)
	{
		$sex = intval($sex);
		$major = intval($major);
		if($sex != 1 && $sex != 2)
			$sex = 0;
		if(!is_numeric($major))
			return 0;
		if($this->_select_field('u_user','user_id',array('u_phone'=>$phone)))
			return -1;
		$data = array(
				'u_phone' => $phone,
				'u_password' => MD5($password),
				'u_name' => $name,
				'u_sex' => $sex,
				'major_id' => $major,
				'u_specialty' => $specialty,
				'u_logo' => $img
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
		$this->db->select('user_id AS id,u_phone AS phone,u_name AS name,u_sex AS sex,
			u_user.college_id AS collegeId,u_college.cl_name AS collegeName,
			u_user.major_id AS majorId,u_major.mj_name AS majorName,
			u_specialty AS specialty');
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
			
	/**
	 * 修改用户资料
	 * @param  string   $user 电话号码
	 * @param  string 	$password  
	 * @param  integer  $sex       
	 * @param  string 	$name      
	 * @param  integer 	$major     
	 * @param  string 	$specialty 
	 * @param  string 	$img 
	 * @return integer 未存在-1 失败0 成功1
	 */
	public function modify($user, $pass, $sex, $name,
		$major, $specialty, $img)
	{
		$sex = intval($sex);
		$major = intval($major);
		if($sex != 1 && $sex != 2)
			$sex = 0;
		if(!is_numeric($major))
			return 0;

		if(! $this->_select_field('u_user','user_id',array('u_phone'=>$user)))
			return -1;
		$data = array(
				'u_password' => MD5($pass),
				'u_name' => $name,
				'u_sex' => $sex,
				'major_id' => $major,
				'u_specialty' => $specialty,
				'u_logo' => $img
			);
		$bool = $this->db->update('u_user',$data,array('u_phone'=>$user));
		return intval($bool);
	}
}


/* End of file user_model.php */
/* Location: ./application/model/user_model.php */