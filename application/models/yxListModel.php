<?php
class yxListModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	
	
	/**
	 * 添加一条应询记录
	 * @param unknown_type $array
	 */
	public function insert($array){
		if($array!=null){
			$this->db->set($array);
			$this->db->insert('tdj_yx_list');
			return $this->db->insert_id();
		}
	}
	
	//通过userid  detail_id获取 应询信息
	
	
	public function update($param){
		$this->db->where('yx_id',$param['yx_id']);
		//$this->db->where('detail_id',$param['detail_id']);
		$this->db->update('tdj_yx_list',$param);
	}
	//获取此供应商 提交的应询单 表头
	public function getYxByComId_Xjid($company_id,$xjid){
		$this->db->where('company_id',$company_id);
		$this->db->where('xj_id',$xjid);
		$query = $this->db->get('tdj_yx_list');
		return $query->result_array();
	}
	public function getByPk($id){
		$this->db->where('yx_id',$id);
		$query = $this->db->get('tdj_yx_list');
		return $query->row_array();
	}
	//方便在采购商统计该询价单 的 报价数
	public function getByXjid($xjid){
		$this->db->where('xj_id',$xjid);
		$query = $this->db->get('tdj_yx_list');
		return $query->result_array();
	}

}