<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info_Model extends MY_Model{
	function __construct()
	{
		$this->load->database();
	}

	public function get_category()
	{
		return $this->_select_all(
				'b_category',
				'category_id as id,c_name as name'
			);
	}

	public function get_college()
	{
		return $this->_select_all(
				'u_college',
				'college_id as id,cl_name as name'
			);
	}

	public function get_major($college_id)
	{
		$this->db->select('major_id as id,mj_name as name');
		$this->db->where('college_id', $college_id);
		$query = $this->db->get('u_major');
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}
}


/* End of file info_model.php */
/* Location: ./application/model/info_model.php */