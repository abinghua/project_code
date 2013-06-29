<?php
class XjListModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 按主键查找
	 * @param unknown_type $detailId
	 * @return NULL
	 */
	public function getById($xjId){
		if($itemid!=null){
			$this->db->where("xj_id",$xjId);
			$query=$this->db->get('tdj_xj_list');
			return $query->row_array();
		}
		return null;
	}
	//数据放到首页正在进行或完结的单
	public function getIng_Over(){
		$this->db->where("state_id",3);
		$this->db->or_where("state_id",4);
		//$this->db->order_by("state_id");
		$query = $this->db->get("tdj_xj_list");
		return $query->result_array();
		
	}
	/**
	 * 添加一个询价单
	 * @param unknown_type $array
	 */
	public function insert($array){
		if($array!=null){
			$this->db->set($array);
			$this->db->insert('tdj_xj_list');
			return $this->db->insert_id();
		}
	}
	//是否有未提交的询价单
	public function getUnSubmit($userid){
		$this->db->where('user_id',$userid);
		$this->db->where('state_id',1);
		$query = $this->db->get('tdj_xj_list');
		return $query->row_array();
	}
	//更新状态
	public function updateState($userid){
		$this->db->where('user_id',$userid);
		$this->db->where('state_id',1);
		$this->db->update('tdj_xj_list',array('state_id'=>2,'send_time'=>date('Y-m-d H:i:s')));
	}
	//获取当前用户所有询价单
	public function getByUserid($userid){
		$this->db->where('user_id',$userid);
		$query = $this->db->get('tdj_xj_list');
		return $query->result_array($query);
	}
	//防止当前用户查看其他用户订单
	public function getByUserid_Xjid($xj_id,$userid){
		$this->db->where('xj_id',$xj_id);
		$this->db->where('user_id',$userid);
		$query = $this->db->get('tdj_xj_list');
		return $query->row_array();
	}
	//获取当前用户，未提交的订单，by xj_id
	
	public function getByUserid_Xjid_Unsubmit($xj_id,$userid){
		$this->db->where('xj_id',$xj_id);
		$this->db->where('user_id',$userid);
		$this->db->where('state_id',1);
		$query = $this->db->get('tdj_xj_list');
		return $query->row_array();
	}
	//取最近修改的订单
	public function getOneByUserid($userid){
		$this->db->where('user_id',$userid);
		$this->db->order_by('edit_time','desc');
		$this->db->limit(1);
		$query = $this->db->get('tdj_xj_list');
		return $query->row_array();
	}
	//更新订单信息
	public function updateUnsubmitByUserid_Xjid($param=array()){
		$this->db->where('user_id',$param['user_id']);
		$this->db->where('xj_id',$param['xj_id']);
		$this->db->where('state_id',1);
		$this->db->update('tdj_xj_list', $param);
	}
	public function delByPk($xj_id){
		$this->db->where('xj_id',$xj_id);
		$this->db->delete("tdj_xj_list");
	}
	//最近提交的订单
	public function getSubmitByUserid($userid){
		$this->db->where('user_id',$userid);
		$this->db->where('state_id',2);
		$this->db->or_where('state_id',3);
		$this->db->or_where('state_id',4);
		$this->db->order_by('edit_time','desc');
		$this->db->limit(1);
		$query = $this->db->get('tdj_xj_list');
		//echo $this->db->last_query();
		return $query->row_array();
	}
	
	//应询部分
	public function getAnswerByUserid_Xjno($userid,$xj_no){
		$sql =  "SELECT * FROM (`tdj_xj_list`) WHERE  `dist_ban` NOT LIKE '%$userid%' AND xj_no='$xj_no' and
		(`state_id` = 3 OR `state_id` = 4 OR `state_id` = 5 OR `state_id` = 6) order by send_time desc ";
		$query = $this->db->query($sql);
		//print_r( $query->result_array());
		return $query->result_array();
	}
	//userid 该用户是否被客服禁止询价
	public function getAnswerByUserid($userid){
		
		$sql =  "SELECT * FROM (`tdj_xj_list`) WHERE  `dist_ban` NOT LIKE '%$userid%' AND
		(`state_id` = 3 OR `state_id` = 4 OR `state_id` = 5 OR `state_id` = 6) order by send_time desc ";
		//$this->db->not_like('dist_ban',$userid);
		//$this->db->where('state_id',3);
		//$this->db->or_where("state_id",4);
		//$query = $this->db->get('tdj_xj_list');
		$query = $this->db->query($sql);
		//print_r( $query->result_array());
		return $query->result_array();
	}
	 //防止当前会员查看其他订单信息
	public function getOneAnswerByUserid($userid,$xjId){
		$sql =  "SELECT * FROM (`tdj_xj_list`) WHERE `xj_id` = '$xjId'  AND `dist_ban` NOT LIKE '%$userid%' AND 
		(`state_id` = 3 OR `state_id` = 4 OR `state_id` = 5 OR `state_id` = 6) order by send_time desc";
		//$this->db->where('xj_id',$xjId);
		//$this->db->where('state_id',3);
		//$this->db->not_like('dist_ban',$userid);
		//$this->db->or_where('state_id',4);
		$query = $this->db->query($sql);
		//$query = $this->db->get('tdj_xj_list');
		//print_r( $query->result_array());
		//echo $this->db->last_query();
		return $query->result_array();
	}
	
	
}