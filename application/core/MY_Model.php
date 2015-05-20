<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	protected function _insert($table, $data)
	{
		if($this->db->insert($table, $data))
		{
			return $this->db->insert_id();
		}
		return FALSE;
	} 

	/**
	 * 获取某字段值
	 * @param  string $table
	 * @param  string $field
	 * @param  array  $where
	 * @return mix    字段值
	 */
	protected function _select_field($table, $field, $where)
	{
		$this->db->select($field);
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();
			$query->free_result();
			return $result[$field];
		}
		else
		{
			$query->free_result();
			return '';
		}
	}

	protected function _select_all($table, $select = '')
	{
		if(! empty($select))
			$this->db->select($select);
		$query = $this->db->get($table);
		$result = $query->result_array();
		$query->free_result();
		return $result;
	}
}


/* End of file login_model.php */
/* Location: ./application/model/login_model.php */