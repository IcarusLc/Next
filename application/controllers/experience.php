<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Experience extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('exp_model');
    }
    /**
     * 发布记录
     */
    public function add()
    {
        $data = array(
                'sender_uid' => $this->json['userid'],
                'er_explain' => $this->json['explain']
            );
        if($id = $this->exp_model->insert_record($data)) // 添加纪录
            return $this->_display_json(
                    0,
                    $this->lang->line('succ_add'),
                    array('recordId' => $id)
                );
        $this->_error(301); // 添加失败
    }
    /**
     * 获取发布记录列表
     */
    public function recordlist()
    {
        $rows = $this->exp_model->get_record_list(
                $this->_get('page', 0),
                $this->_get('num', 10)
            );
        if(empty($rows))
            return $this->_error(302, array('list'=>$rows));
        $this->_display_json(0, '', array('list'=>$rows));
    }
    /**
     * 发布评论
     */
    public function reply()
    {
         $data = array(
                'record_id' => $this->json['record'],
                'sender_id' => $this->json['sender'],
                'replied_id' => $this->_get('replied', 0),
                'rp_content' => $this->json['content']
            );
        $reply_id = $this->exp_model->add_reply($data); // 添加回复
        if($reply_id === FALSE)
            return $this->_error(307); // 回复失败
        $this->_display_json(
                0,
                $this->lang->line('succ_reply'),
                array('replyId' => $reply_id)
            );
    }
    /**
     * 评论列表
     */
    public function replylist()
    {
        if(! isset($this->json['record']))
            return $this->_error(102);
        $rows = $this->exp_model->get_reply_list($this->json['record']);
        $return_array = array(
                'num' => count($rows),
                'list' => $rows
            );
        $this->_display_json(0, '', $return_array);
    }
}

/* End of file experience.php */
/* Location: ./application/controllers/experience.php */