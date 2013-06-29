<?php
class CompanyModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->model('categoryModel');
		$this->load->model('areaModel');
	}
	
	/**
	 * 锟斤拷锟揭癸拷应锟斤拷锟斤拷息
	 * @param unknown_type $companyName
	 * @return NULL
	 */
	public function getByCompanyName($companyName){
		if($companyName!=null){
			$this->db->where("company",$companyName);
			$query=$this->db->get('tdj_company');
			return $query->result_array();
		}
		return null;
	}
	/**
	 * 锟斤拷锟揭癸拷应锟斤拷锟斤拷息
	 * @param unknown_type $companyName
	 * @return NULL
	 */
	public function getByPk($id){
		if($id!=null){
			$this->db->where("userid",$id);
			$query=$this->db->get('tdj_company');
			return $query->result_array();
		}
		return null;
	}
	/**
	 * 锟斤拷锟揭癸拷应锟斤拷锟斤拷息
	 * @param $pageSize,$pageIndex
	 * @return result
	 */
	public function getCompany($pagesize = 10,$pageIndex){
		$this->db->limit($pagesize,$pageIndex);
		$this->db->order_by('userid','DESC');
		$query=$this->db->get('tdj_company');
		return $query->result_array();
	}
	/**
	 * 锟斤拷锟斤拷company锟斤拷锟斤拷息
	 * @param $$catid,$areaid,$kw
	 * @return result
	 */
	public function getByWhere($catid,$areaid,$text,$pageSize,$pageIndex){
		
		$catList=$this->categoryModel->getAllDataList();
		$areaList=$this->areaModel->getAllDataList();
		$catids=array();	//锟斤拷锟斤拷ID锟斤拷
		$areaids=array();	//锟斤拷锟斤拷ID锟斤拷
		if($catid!=-1){
			//锟斤拷锟斤拷锟斤拷锟�
			for($i=0; $i<count($catList); $i++){
				$id=$catList[$i]['catid'];
				if($id==$catid){
					$catids=explode(",",$catList[$i]['arrchildid']);	
					break;
				}
			}
		}
		
		if($areaid!=-1){
			//锟斤拷锟斤拷锟斤拷锟�
			for($i=0; $i<count($areaList); $i++){
				$id=$areaList[$i]['areaid'];
				if($id==$areaid){
					if(!isset($areaList[$i]['arrchildid'])){
						$areaids=explode(",",$areaList[$i]['arrchildid']);
					}else{
						$areaids=explode(",",$areaList[$i]['areaid']);
					}
					break;
				}
			}
		}
		if($text!=null&&$text!=""){	//text锟斤拷为锟斤拷
			$this->db->where("(company like '%".$text."%' or address like '%".$text."%' or sell like '%".$text."%')");
			$this->db->order_by('company asc, address asc, sell asc');
		}
		if(count($catids)>0){	//锟斤拷锟洁不为锟斤拷
			$this->db->where_in('catid', $catids);
		}
		if(count($areaids)>0){	//锟斤拷锟斤拷为锟斤拷
			$this->db->where_in('areaid', $areaids);
		}
		if($pageIndex>0){
			$this->db->limit($pageSize,$pageIndex*$pageSize-$pageSize);
		}else{
			$this->db->limit($pageSize,$pageIndex*$pageSize);
		}
		$query=$this->db->get("tdj_company");
		$value=$query->result_array();
		return $value;
		
	}
	
	/**
	 * 锟斤拷锟斤拷company锟斤拷锟�
	 * @param unknown_type $catid
	 * @param unknown_type $areaid
	 * @param unknown_type $text
	 * 		$this->db->last_query();
	 */
	function getByWhereCount($catid,$areaid,$text){
		$result=array();
		$catList=$this->categoryModel->getAllDataList();
		$areaList=$this->areaModel->getAllDataList();
		$catids=array();	//锟斤拷锟斤拷ID锟斤拷
		$areaids=array();	//锟斤拷锟斤拷ID锟斤拷
		if($catid!=-1){
			//锟斤拷锟斤拷锟斤拷锟�
			for($i=0; $i<count($catList); $i++){
				$id=$catList[$i]['catid'];
				if($id==$catid){
					$catids=explode(",",$catList[$i]['arrchildid']);
					break;
				}
			}
		}
	
		if($areaid!=-1){
			//锟斤拷锟斤拷锟斤拷锟�
			for($i=0; $i<count($areaList); $i++){
				$id=$areaList[$i]['areaid'];
				if($id==$areaid){
					if(isset($areaList[$i]['arrchildid'])){
						$areaids=explode(",",$areaList[$i]['arrchildid']);
					}else{
						$areaids=explode(",",$areaList[$i]['areaid']);
					}
					break;
				}
			}
		}
		if($text!=null&&$text!=""){	//text锟斤拷为锟斤拷
			$this->db->where("(company like '%".$text."%' or address like '%".$text."%' or sell like '%".$text."%')");
			$this->db->order_by('company asc, address asc, sell asc');
		}
		if(count($catids)>0){	//锟斤拷锟洁不为锟斤拷
			$this->db->where_in('catid', $catids);
		}
		if(count($areaids)>0){	//锟斤拷锟斤拷为锟斤拷
			$this->db->where_in('areaid', $areaids);
		}
		$this->db->select("count(*)");
		$query=$this->db->get("tdj_company");
		$value=$query->result_array();
		return $value;
	}

}