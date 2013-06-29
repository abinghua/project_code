<?php
class SellModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->model("categoryModel");
		$this->load->model("areaModel");
	}

	/**
	 * 锟斤拷锟斤拷brand锟斤拷锟斤拷锟截革拷锟斤拷锟�
	 * @param unknown_type $count
	 * @return unknown
	 */
	function getBrandList($count){
		$this->db->select("brand");
		$this->db->group_by('brand');
		if($count!=-1){
			$this->db->limit($count);
		}
		$this->db->where("brand <>","");
		$query=$this->db->get("tdj_sell");
		$result=$query->result_array();
		return $result;
	}
	
	/**
	 * 锟斤拷取brands锟街段讹拷应锟斤拷锟斤拷锟斤拷锟斤拷锟�
	 * @param unknown_type $brand
	 * @return unknown
	 */
	function getByBrand($brands){
  		$this->db->select('*')->from('tdj_sell');
  		$this->db->where_in('brand', $brands);
  		$query = $this->db->get();
  		$result= $query->result_array();
  		return $result;
	}
	
	/**
	 * 锟斤拷取catid锟街段讹拷应锟斤拷锟斤拷锟斤拷锟斤拷锟�
	 * @param unknown_type $catid
	 * @return unknown
	 */
	function getByCatid($catid){
		$this->db->select('*')->from('tdj_sell')->where('catid', $catid);
		$query = $this->db->get();
		$result= $query->result_array();
		return $result;
	}
	
	/**
	 * 锟斤拷取锟斤拷页锟斤拷锟�
	 * @param unknown_type $PageSize
	 * @param unknown_type $PageIndex
	 * @return multitype:|unknown
	 */
	function getPageList($PageSize,$PageIndex)
	{
		if ($PageSize < 1 || $PageIndex < 1)
			return array();
		$this->db->limit($PageSize,$PageIndex);
		$query=$this->db->get("tdj_sell");
		$result=$query->result_array();
		return $result;
	}
	
	/**
	 * 锟斤拷取brand锟街段讹拷应锟侥斤拷锟�
	 * @param unknown_type $brand
	 */
	function getCountByBrand($brand){
		$this->db->count_all_results('tdj_sell');
		$this->db->from('tdj_sell');
		$this->db->where('brand', $brand);
		return $this->db->count_all_results();
	}
	
	/**
	 * 锟斤拷取catid锟街段讹拷应锟侥斤拷锟�
	 * @param unknown_type $catid
	 */
	function getCountByCatid($catid){
		$this->db->count_all_results('tdj_sell');
		$this->db->from('tdj_sell');
		$this->db->where('catid', $catid);
		return $this->db->count_all_results();
	}
	
	/**
	 * 锟斤拷锟斤拷锟斤拷锟斤拷
	 * @param unknown_type $catid
	 * @param unknown_type $areaid
	 * @param unknown_type $text
	 * @param unknown_type $pageSize
	 * @param unknown_type $pageIndex
	 */
	function getByWhere($catid,$areaid,$text,$pageSize,$pageIndex){
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
					if(!empty($areaList[$i]['arrchildid'])){
						$areaids=explode(",",$areaList[$i]['arrchildid']);
					}else{
						$areaids=explode(",",$areaList[$i]['areaid']);
					}
					break;
				}
			}
		}
		if($text!=null&&$text!=""){	//text锟斤拷为锟斤拷
 			$this->db->where("(title like '%".$text."%' or address like '%".$text."%' or company like'%".$text."%')");
 			$this->db->order_by('title asc, address asc, company asc');
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
		$query=$this->db->get("tdj_sell");
		$value=$query->result_array();
		return $value;
	}
	
	/**
	 * 锟斤拷锟斤拷锟斤拷锟斤拷锟斤拷
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
					if(!empty($areaList[$i]['arrchildid'])){
						$areaids=explode(",",$areaList[$i]['arrchildid']);
					}else{
						$areaids=explode(",",$areaList[$i]['areaid']);
					}
					break;
				}
			}
		}
		if($text!=null&&$text!=""){	//text锟斤拷为锟斤拷
			$this->db->where("(title like '%".$text."%' or address like '%".$text."%' or company like'%".$text."%')");
			$this->db->order_by('title asc, address asc, company asc');
		}
		if(count($catids)>0){	//锟斤拷锟洁不为锟斤拷
			$this->db->where_in('catid', $catids);
		}
		if(count($areaids)>0){	//锟斤拷锟斤拷为锟斤拷
			$this->db->where_in('areaid', $areaids);
		}
		$this->db->select("count(*)");
		$query=$this->db->get("tdj_sell");
		$value=$query->result_array();
		return $value;
	}
	
	/**
	 * 锟斤拷锟斤拷询
	 * @param unknown_type itemid
	 * 		$this->db->last_query();
	 */
	function getByPk($itemid){
		$query=$this->db->where("itemid",$itemid);
		$query=$this->db->get("tdj_sell");
		return $query->result_array();
	}
	
}