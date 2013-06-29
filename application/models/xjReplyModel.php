<?php
class XjReplyModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 按用户查找应询单据
	 * @param unknown_type $detailId
	 * @return NULL
	 */
	public function getByUser($userid){
		if($userid!=null){
			$this->db->where("user_id",$userid);
			$query=$this->db->get('tdj_xj_reply');
			return $query->result_array();
		}
		return null;
	}
	
	
	/**
	 * 添加一条应询记录
	 * @param unknown_type $array
	 */
	public function insert($array){
		if($array!=null){
			$this->db->set($array);
			$this->db->insert('tdj_xj_reply');
		}
	}
	
	//通过userid  detail_id获取 应询信息
	public function getByUseridDetailId($userid,$detail_id){
		$this->db->where('user_id',$userid);
		$this->db->where('detail_id',$detail_id);
		$query = $this->db->get('tdj_xj_reply');
		
		return $query->row_array();
	}
	
	public function update($param){
		$this->db->where('user_id',$param['user_id']);
		$this->db->where('detail_id',$param['detail_id']);
		$this->db->update($param);
	}

}