<?php
class MemberGroupModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 获取主键id的信息
	 */
	public function getByGroupId($groupid){
		$this->db->where("groupid",$groupid);
		$query = $this->db->get("tdj_member_group");
		return $query->result_array();
	}

}