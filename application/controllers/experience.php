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
        if(!isset($this->json['page']))
            $this->json['page'] = 0;
        if(!isset($this->json['num']))
            $this->json['num'] = 10;
        $rows = $this->exp_model->get_record_list($this->json['page'],
            $this->json['num']);
        if(empty($rows))
            return $this->_error(302, array('list'=>$rows));
        $this->_display_json(0, '', array('list'=>$rows));
    }
    
}

/* End of file experience.php */
/* Location: ./application/controllers/experience.php */