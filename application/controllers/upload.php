<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MY_Controller {

    function __construct()
    {
        parent::__construct(TRUE);
    }

    public function pic()
    {
        $path = './uploads/2015';
        $config = array(
                'upload_path' => $path,
                'allowed_types' => 'gif|png|jpg|jpeg',
                'encrypt_name' => TRUE
            );
        $this->load->library('upload', $config);
        if($this->upload->do_upload('pic'))
        {
            $file = $path . '/' . $this->upload->data()['file_name'];
            $this->_display_json(
                0,
                $this->lang->line('succ_upload'),
                array('fileName' => substr($file, 1))
            );
        }
        else
            $this->_error(308, array('error' => $this->upload->display_errors()));
    }

    public function pic2() {
        $content = file_get_contents('php://input');
        $path = './uploads/2015';

        $this->load->helper('string');
        $fileName = random_string('alnum', 16) . '.jpg';
        $file = $path . '/' . $fileName;

        $pic = fopen($file, 'w');
        fwrite($pic, $content);
        fclose($pic);
        $this->_display_json(
            0,
            $this->lang->line('succ_upload'),
            array('fileName' => substr($file, 1))
        );
    }
    
}

/* End of file upload.php */
/* Location: ./application/controllers/upload.php */