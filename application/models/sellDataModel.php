<?php
class SellDataModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 产品详细
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