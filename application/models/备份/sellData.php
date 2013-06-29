<?php
class SellData extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * ²úÆ·ÏêÏ¸
	 * @param unknown_type $companyName
	 * @return NULL
	 */
	public function getByItemid($itemid){
		if($itemid!=null){
			$this->db->where("itemid",$itemid);
			$query=$this->db->get('tdj_sell_data');
			return $query->result_array();
		}
		return null;
	}

}