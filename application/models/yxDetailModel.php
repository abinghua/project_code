<?php
class yxDetailModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 按用户查找应询单据
	 * @param unknown_type $detailId
	 * @return NULL
	 */
	 
	//用于更新yx_detail
	public function getForUpdate($xj_detail_id,$yx_id,$userid){
		$this->db->where('xj_detail_id',$xj_detail_id);
		$this->db->where('yx_id',$yx_id);
		$this->db->where('user_id',$userid);
		$query = $this->db->get('tdj_yx_detail');
		return $query->row_array();
	}
	public function getByYx_idUser_idXj_detialid($yx_id,$userid,$xj_detail_id){
		$this->db->where('yx_id',$yx_id);
		$this->db->where('user_id',$userid);
		$this->db->where('xj_detail_id',$xj_detail_id);
		$query = $this->db->get('tdj_yx_detail');
		return $query->row_array();
	}
	public function getByXjDetail($xjDetailid){
		$this->db->where('xj_detail_id',$xjDetailid);
		$query = $this->db->get('tdj_yx_detail');
		return $query->result_array();
	}
	public function getByYx_idXj_detailid($yx_id,$xj_detail_id){
		$this->db->where('yx_id',$yx_id);
		$this->db->where('xj_detail_id',$xj_detail_id);
		$query = $this->db->get('tdj_yx_detail');
		return $query->result_array();
	}
	/**
	 * 添加一条应询记录
	 * @param unknown_type $array
	 */
	public function insert($array){
		if($array!=null){
			$this->db->set($array);
			$this->db->insert('tdj_yx_detail');
			return $this->db->insert_id();
		}
	}
	public function getByPk($id){
		$this->db->where('detail_id',$id);
		$query = $this->db->get('tdj_yx_detail');
		return $query->row_array();
	}
	public function getByYxId($yx_id){
		$this->db->where('yx_id',$yx_id);
		$query = $this->db->get('tdj_yx_detail');
		return $query->result_array();
	}
	public function update($param){
		$this->db->where('user_id',$param['user_id']);
		$this->db->where('xj_detail_id',$param['xj_detail_id']);
		//$this->db->where('detail_id',$param['detail_id']);
		$this->db->update('tdj_yx_detail',$param);
	}
	

}