<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exp_Model extends MY_Model{
    function __construct()
    {
        $this->load->database();
    }

    public function insert_record($data)
    {
        return $this->_insert('r_experience_record', $data); 
    }

    public function add_reply($data)
    {
        return $this->_insert('r_experience_reply', $data);
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
        $this->db->select('record_id AS id,er_explain AS `explain`,
            er_time AS time,sender_uid AS senderId,u_name AS senderName,
            u_sex AS sex,v_exp_record.college_id AS collegeId,
            u_major.major_id AS majorId,mj_name AS majorName,
            u_specialty AS specialty,u_logo AS image');
        $this->db->join('u_major', 'u_major.major_id=v_exp_record.major_id');
        $this->db->limit($num, $page * $num);
        $this->db->order_by('er_time', 'desc');
        $result = $this->db->get('v_exp_record');
        if($result->num_rows() == 0)
            return array(); // 没有查询结果
        $rows = $result->result_array();
        $result->free_result();
        return $rows;
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
        $this->db->join('u_user', 'u_user.user_id=r_experience_reply.sender_id');
        $this->db->where(array('record_id' => intval($record_id)));
        $this->db->order_by('rp_time', 'desc');
        $result = $this->db->get('r_experience_reply');

        $reply_list = $result->result_array();
        $result->free_result();
        return $reply_list;
    }

}


/* End of file exp_model.php */
/* Location: ./application/model/exp_model.php */