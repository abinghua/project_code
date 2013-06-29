<?php
class CompanyDataModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * ²úÆ·ÏêÏ¸
	 * @param unknown_type $companyName
	 * @return NULL
	 */
	public function getByPk($id){
		if($id!=null){
			$this->db->where("userid",$id);
			$query=$this->db->get('tdj_company_data');
			return $query->result_array();
		}
		return null;
	}

}