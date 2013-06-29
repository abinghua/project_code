<?php
	/**
	 * 注册
	 * @author admin
	 *
	 */
	class registerbuyersModel extends CI_Model{
		function __construct(){
			$this->load->database();
		}
		
		public function insertCompany($array,$table){
			if($array!=null){
				$this->db->set($array);
				$this->db->insert($table);
				return $this->db->insert_id();
			}
			return null;
		}
		
		public function showRegRoleId($groupname){
			$sql = "select groupid from tdj_member_group where groupname like '%".$this->db->escape_like_str($groupname)."%'";
			$query = $this->db->query($sql,null);
			return $query->row_array();
		}
		
	
		public function showUserId($ids,$table){
			$this->db->select($ids);
		    $this->db->from($table);
		    $this->db->order_by($ids,"desc");
		    $query = $this->db->get();
			return $query->row_array();
		}
		
		
		public function showParentcatname($catid){
			$sql = "select catname,catid from tdj_category where catid=( select parentid from tdj_category where catid=(
						select parentid from tdj_category where catid='".$catid."'));";
			$query = $this->db->query($sql,null);
			if($query->result()==null){
				return null;
			}else{
				return $query->row_array();
			}
		}
		//得到parentname
		public function showchildcatname($catid){
			$sql = " select catname,catid from tdj_category where catid=(select parentid from tdj_category where catid='".$catid."');";
			$query = $this->db->query($sql,null);
			if($query->result()==null){
				return null;
			}else{
				return $query->row_array();
			}
		}
		public function showcatname($catid){
			$sql = "select catname,catid from tdj_category where catid='".$catid."'";
			$query = $this->db->query($sql,null);
			if($query->result()==null){
				return null;
			}else{
				return $query->row_array();
			}
		}
		//得到分类的名称
		public function showcatid($catname){
			$sql = "select catid from tdj_category where catname='".$catname."'";
			$query = $this->db->query($sql,null);
			if($query->result()==null){
				return null;
			}else{
				return $query->row_array();
			}
		}
		//验证用户名称是否存在
		public function validatenames($username){
			$sql = "select username from tdj_member where username='".$username."'";
			$query = $this->db->query($sql,null);
			if($query->result()==null){
				return null;
			}else{
				return $query->row_array();
			}
		}
		//验证公司名称是否存在
		public function validatecompanynames($companyname){
			$sql = "select * from tdj_company where company='".$companyname."'";
			$query = $this->db->query($sql,null);
			if($query->result()==null){
				return null;
			}else{
				return $query->row_array();
			}
		}
		
		public function showParentareaname($areaids){
			$sql = "select areaname,areaid from tdj_area where areaid=(
					select parentid from tdj_area where areaid=(select parentid from tdj_area where areaid='".$areaids."'));";
			$query = $this->db->query($sql,null);
			
			if($query->result()==null){
				return  null;
			}else{
				return $query->row_array();
			}
		}
		//得到parentname
		public function showchildareaname($areaids){
			$sql = " select areaname,areaid from tdj_area where areaid=(select parentid from tdj_area where areaid='".$areaids."')";
			$query = $this->db->query($sql,null);
			if($query->result()==null){
				return null;
			}else{
				return $query->row_array();
			}
		}
		public function showcatareaname($areaids){
			$sql = "select areaname,areaid from tdj_area where areaid='".$areaids."'";
			$query = $this->db->query($sql,null);
			if($query->result()==null){
				return null;
			}else{
				return $query->row_array();
			}
		}
		//得到地区的名称
		public function showareaid($areaname){
			$sql = "select areaid from tdj_area where areaname='".$areaname."'";
			$query = $this->db->query($sql,null);
			if($query->result()==null){
				return null;
			}else{
				return $query->row_array();
			}
		}
		//手机号码必须得唯一
		public function showmobilephone($mobilephone){
			$sql = "select * from tdj_member where mobile= '".$mobilephone."'";
			$query = $this->db->query($sql,null);
			if($query->result()==null){
				return null;
			}else{
				return $query->row_array();
			}
		}
		
	}
?>