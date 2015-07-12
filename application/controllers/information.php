<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Information extends MY_Controller {
	function __construct()
	{
		parent::__construct(TRUE);
		$this->load->model('info_model');
	}

	public function book($isbn)
	{
		if(empty($isbn))
			return $this->_display_json(201, $this->lang->line('error_201'));

		$url = 'https://api.douban.com/v2/book/isbn/' . $isbn;
		$book_info = json_decode(file_get_contents($url), true);
		unset($book_info['catalog']);
		unset($book_info['rating']);
		unset($book_info['url']);
		return $this->_display_json(0, '', $book_info);
	}

	public function bookcategory()
	{
		$category = array('category' => $this->info_model->get_category());
		return $this->_display_json(0, '', $category);
	}

	public function college()
	{
		$college = array('college' => $this->info_model->get_college());
		return $this->_display_json(0, '', $college);
	}

	public function major($college_id)
	{
		if(empty($college_id) || !is_numeric($college_id))
			return $this->_display_json(202, $this->lang->line('error_202'));

		$major =  array('major' => $this->info_model->get_major($college_id));
		return $this->_display_json(0, '', $major);
	}

}

/* End of file information.php */
/* Location: ./application/controllers/information.php */