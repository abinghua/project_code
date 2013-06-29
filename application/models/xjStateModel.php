<?php
class XjStateModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 按主键查找
	 * @param unknown_type 
	 * @return NULL
	 */
	public function getByPk($state_id){
		if($state_id!=null){
			$this->db->where("state_id",$state_id);
			$query=$this->db->get('tdj_xj_state');
			return $query->row_array();
		}
		return null;
	}
	public function getAll(){
			$query=$this->db->get('tdj_xj_state');
			return $query->result_array();
	}
	
	//获取询价状态
	public function getAllXjState(){
		$this->db->where("type",0);
		$query=$this->db->get('tdj_xj_state');
		return $query->result_array();
	}
	
	
	
	
	
	public function getAnswer(){
		$this->db->where('state_id',3);
		$this->db->or_where('state_id',4);
		$this->db->or_where('state_id',5);
		$this->db->or_where('state_id',6);
		$query = $this->db->get('tdj_xj_state');
		return $query->result_array();
	}

}