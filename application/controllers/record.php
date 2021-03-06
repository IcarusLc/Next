<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Record extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('record_model');
	}
	/**
	 * 发布记录
	 */
	public function add()
	{
		$data = array(
				'b_isbn' => $this->json['isbn'],
				'b_title' => $this->json['title'],
				'b_publisher' => $this->_get('publisher'),
				'b_author' => $this->_get('author'),
				'b_translator' => $this->_get('translator'),
				'b_img' => $this->_get('img'),
				'b_summary' => $this->_get('summary'),
				'category_id' => $this->json['categoryid']
			);
		$book_id = $this->record_model->insert_book($data); // 添加书籍
		if($book_id === FALSE)
			return $this->_error(301); // 添加失败

		$data = array(
				'sender_uid' => $this->json['userid'],
				'book_id' => $book_id,
				'dr_explain' => $this->json['explain']
			);
		if($id = $this->record_model->insert_record($data)) // 添加纪录
			return $this->_display_json(
					0,
					$this->lang->line('succ_add'),
					array('recordId' => $id)
				);
		$this->_error(301); // 添加失败
	}
	/**
	 * 获取发布记录详情
	 */
	public function detail()
	{
		if(!isset($this->json['record']))
			return $this->_error(102);
		$row = $this->record_model->get_record($this->json['record']);
		if(! $row)
			return $this->_error(302); // 没有信息
		$this->_display_json(0, '', $row);
	}
	/**
	 * 获取发布记录列表
	 */
	public function recordlist()
	{
		$rows = $this->record_model->get_record_list(
				$this->_get('page', 0),
				$this->_get('num', 10),
				$this->_get('categoryid', 0)
			);
		if(empty($rows))
			return $this->_error(302, array('list'=>$rows));
		$this->_display_json(0, '', array('list'=>$rows));
	}
	/**
	 * 回复评论
	 */
	public function reply()
	{
		$data = array(
				'record_id' => $this->json['record'],
				'sender_id' => $this->json['sender'],
				'replied_id' => $this->_get('replied', 0),
				'rp_content' => $this->json['content']
			);
		$reply_id = $this->record_model->add_reply($data); // 添加回复
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
		$rows = $this->record_model->get_reply_list($this->json['record']);
		$return_array = array(
				'num' => count($rows),
				'list' => $rows
			);
		$this->_display_json(0, '', $return_array);
	}
	/**
	 * 用户竞标
	 */
	public function iwant()
	{
		if(!(isset($this->json['record']) && isset($this->json['userid'])))
			return $this->_error(102);
		$succ = $this->record_model->add_bid($this->json['record'],
			$this->json['userid']);
		switch ($succ)
		{
			case 0:
				return $this->_display_json(0, $this->lang->line('succ_add'));
			case 1:
				return $this->_error(303); // 已经存在
			default:
				return $this->_error(304); // 更新失败
		}
	}
	/**
	 * 书籍送出
	 */
	public function giveyou()
	{
		if(!(isset($this->json['record']) && isset($this->json['recipient'])))
			return $this->_error(102);
		$succ = $this->record_model->set_recipient($this->json['record'],
			$this->json['recipient']);
		switch ($succ)
		{
			case 0:
				return $this->_display_json(0, $this->lang->line('succ_set'));
			case 1:
				return $this->_error(306); // 用户没有竞标
			default:
				return $this->_error(305);
		}
	}
	/**
	 * 谁想要
	 */
	public function whowant()
	{
		if(!isset($this->json['record']))
			return $this->_error(102);
		$bidder = $this->record_model->get_bid($this->json['record']);
		$this->_display_json(0, '', array('bidders' => $bidder));
	}
	
}

/* End of file record.php */
/* Location: ./application/controllers/record.php */