<?php
class SellReplyModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 获取产品对应的评论
	 * @param unknown_type $companyName
	 * @return NULL
	 */
	public function getByItemid($itemid){
		if($itemid!=null){
			$this->db->where("itemid",$itemid);
			$this->db->order_by("date", "asc");
			$query=$this->db->get('tdj_sell_reply');
			return $query->result_array();
		}
		return null;
	}
	
	/**
	 * 插入一条评论
	 * @param unknown_type $array
	 */
	public function insert($array){
		if($array!=null){
			$this->db->set($array);
			$this->db->insert('tdj_sell_reply');
		}
	}

}