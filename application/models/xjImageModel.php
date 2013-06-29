<?php
class XjImageModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 按主键查找
	 * @param unknown_type $detailId
	 * @return NULL
	 */
	public function getByPk($imageid,$detailid){
		if($imageid!=null&&$detailid!=null){
			$this->db->where("image_id",$imageid);
			$this->db->where("detail_id",$detailid);
			$query=$this->db->get('tdj_xj_image');
			return $query->result_array();
		}
		return null;
	}
	
	/**
	 * 插入多张图片,传入二维数组
	 * @param unknown_type $array
	 */
	public function inserts($arrays){
		if($arrays!=null){
			for($i=0; $i<count($arrays); $i++){
				$array=$arrays[$i];
				$this->db->set($array);
				$this->db->insert('tdj_xj_image');
			}
		}
	}
	
	/**
	 * 插入单张图片
	 * @param unknown_type $array
	 */
	public function insert($array){
		if($array!=null){
			$this->db->set($array);
			$this->db->insert('tdj_xj_image');
		}
	}
	//获取最大图片id
	public function getByDetailid($detailid){
		$this->db->where('detail_id',$detailid);
		$this->db->order_by("image_id", "desc");
		$this->db->limit(1);
		$result = $this->db->get('tdj_xj_image');
		return $result->row_array();
	}
	public function delByDetailid($detailid){
		$this->db->where('detail_id',$detailid);
		$this->db->delete('tdj_xj_image');
	}

}