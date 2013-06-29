<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MemberModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 验证用户返回用户ID
	 * @param unknown_type $parem
	 * @param unknown_type $password
	 */
	public function validateUser($parem){
		$this->db->select("*");
		$this->db->where("username",$parem);
		$this->db->or_where("email",$parem);
		//$this->db->where("password",$password);
		$query = $this->db->get("tdj_member");
		return $query->row_array();
	}
	
	/**
	 * 插入一条会员记录
	 * @param unknown_type $array
	 * @return boolean
	 */
	public function insert($array){
		if($array!=null){
			$this->db->set($array);
			$this->db->insert('tdj_member');
			return true;
		}
		return false;
	}
	public function getByPk($userid){
		$this->db->select("*");
		$this->db->where("userid",$userid);
		$query = $this->db->get("tdj_member");
		return $query->row_array();
	}
	public function updateOne($member){
		$this->db->where("userid",$member['userid']);
		$this->db->update("tdj_member",$member);
	}

}