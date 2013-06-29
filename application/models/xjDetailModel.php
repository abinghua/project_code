<?php
class XjDetailModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 按主键查找
	 * @param unknown_type $detailId
	 * @return NULL
	 */
	public function getByDetailId($detailId){
		if($detailId!=null){
			$this->db->where("detail_id",$detailId);
			$query=$this->db->get('tdj_xj_detail');
			return $query->result_array();
		}
		return null;
	}
	
	/**
	 * 添加一个询价材料
	 * @param unknown_type $array
	 */
	public function insert($array){
		if($array!=null){
			$this->db->set($array);
			$this->db->insert('tdj_xj_detail');
			return $this->db->insert_id();
		}
	}
	//获取最新的detail单条信息
	public function getLastestByXjId($xjId){
		$this->db->where('xj_id',$xjId);
		$this->db->order_by('detail_id','desc');
		$this->db->limit(1);
		$result = $this->db->get('tdj_xj_detail');
		return $result->row_array();
	}
	
	public function getByXjId($xjId){
		$this->db->where('xj_id',$xjId);
		$result = $this->db->get('tdj_xj_detail');
		return $result->result_array();
	}
	//删除订单详情记录 by detail_id
	public function delByPk($detail_id){
		$this->db->where("detail_id",$detail_id);
		$this->db->delete('tdj_xj_detail');
	}	
	//更新订单详细记录 by detail_id
	public function updateByPk($param){
		$this->db->where('detail_id',$param['detail_id']);
		$this->db->update('tdj_xj_detail', $param);
	}
	//更新表头的地区限制时，也要更新细表的地区限制
	public function updateLimit_areaidByXjid($xj_id,$limit_areaid){
		$this->db->where("xj_id",$xj_id);
		$this->db->where("limit_areaid <>",'');
		$this->db->update("tdj_xj_detail",$limit_areaid);
	}
	
	
	
	//应询
	//用作信息展示用,在modify页面
	public function getByXjid_Detailid($xjid,$detailid){
		$this->db->where('xj_id',$xjid);
		$this->db->where('detail_id',$detailid);
		$query = $this->db->get('tdj_xj_detail');
		return $query->row_array();
	}
	

}