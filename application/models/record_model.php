<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Record_Model extends MY_Model{
	function __construct()
	{
		$this->load->database();
	}

	public function insert_book($data)
	{
		return $this->_insert('b_book', $data);
	}

	public function insert_record($data)
	{
		return $this->_insert('r_deal_record', $data); 
	}

	public function add_reply($data)
	{
		return $this->_insert('r_reply', $data);
	}
	/**
	 * 获取记录信息
	 * @param  integer $id 记录id
	 * @return array/false
	 */
	public function get_record($id)
	{
		$id = intval($id);
		$this->db->select('sender_uid,dr_explain AS `explain`,dr_time AS time,
			b_title AS title,b_publisher AS publisher,b_author AS author,
			b_translator AS translator,b_img AS image,b_summary AS summary,
			category_id');
		$this->db->where('record_id', $id);
		$query = $this->db->get('v_record');
		if($query->num_rows() <= 0)
			return FALSE;
		
		$result = $query->row_array();
		// 获取姓名
		$result['sender_name'] = $this->_select_field(
			'u_user',
			'u_name',
			array('user_id' => $result['sender_uid']));
		return $result;
	}
	/**
	 * 获取记录列表
	 * @param  integer $page 页数(从0开始)
	 * @param  integer $num  每页条数
	 * @return array         记录列表
	 */
	public function get_record_list($page, $num)
	{
		$page = intval($page);
		$num = intval($num);
		$this->db->select('b_title AS title,b_img AS image,dr_time AS time');
		$this->db->limit($num, $page * $num);
		$this->db->order_by('dr_time', 'desc');
		$result = $this->db->get('v_record');
		if($result->num_rows() == 0)
			return array(); // 没有查询结果
		$rows = $result->result_array();
		$result->free_result();
		return $rows;
	}
	/**
	 * 添加竞争者
	 * @param  integer $record_id 记录id
	 * @param  integer $bidder_id 竞标者用户id
	 * @return integer 0 1 2
	 */
	public function add_bid($record_id, $bidder_id)
	{
		$record_id = intval($record_id);
		$bidder_id = intval($bidder_id);
		$where = array('record_id' => $record_id);
		$bidder = $this->_select_field('r_deal_record', 'dr_bid_uid', $where);
		if(in_array($bidder_id, explode(',', $bidder)))
			return 1; // 已经存在
		if(empty($bidder))
			$update_data = array('dr_bid_uid' => $bidder_id);
		else
			$update_data = array('dr_bid_uid' => $bidder . ',' . $bidder_id);
		$this->db->where($where);
		if($this->db->update('r_deal_record', $update_data))
			return 0; // 更新成功
		return 2; // 更新失败
	}
	/**
	 * 设置送书接受者
	 * @param  integer  $record_id    记录id
	 * @param  integer  $recipient_id 接受者用户id
	 * @return integer  0 1 2
	 */
	public function set_recipient($record_id, $recipient_id)
	{
		$record_id = intval($record_id);
		$recipient_id = intval($recipient_id);
		$where = array('record_id' => $record_id);
		// 判断是否竞标过
		$bidder = $this->_select_field('r_deal_record', 'dr_bid_uid', $where);
		if(! in_array($recipient_id, explode(',', $bidder)))
			return 1; // 并没有竞标

		// 更新接受者字段
		$this->db->where($where);
		$succ = $this->db->update('r_deal_record', array(
				'recipient_uid' => $recipient_id
			));
		if($succ)
			return 0; // 更新成功
		return 2; // 更新失败
	}
	/**
	 * 获取评论列表
	 * @param  integer $record_id 记录id
	 * @return array              评论数组
	 */
	public function get_reply_list($record_id)
	{
		$this->db->select('reply_id AS replyId, sender_id AS senderId,
			u_name AS senderName, replied_id AS repliedId,
			rp_content AS content, rp_time AS time');
		$this->db->join('u_user', 'u_user.user_id=r_reply.sender_id');
		$this->db->where(array('record_id' => intval($record_id)));
		$this->db->order_by('rp_time', 'desc');
		$result = $this->db->get('r_reply');

		$reply_list = $result->result_array();
		$result->free_result();
		return $reply_list;
	}
}


/* End of file record_model.php */
/* Location: ./application/model/record_model.php */