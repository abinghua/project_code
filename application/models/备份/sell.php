<?php
class Sell extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->model("category");
		$this->load->model("area");
	}

	/**
	 * 过滤brand所有重复数据
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
	 * 获取brands字段对应的所有数据
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
	 * 获取catid字段对应的所有数据
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
	 * 获取分页数据
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
	 * 获取brand字段对应的结果集
	 * @param unknown_type $brand
	 */
	function getCountByBrand($brand){
		$this->db->count_all_results('tdj_sell');
		$this->db->from('tdj_sell');
		$this->db->where('brand', $brand);
		return $this->db->count_all_results();
	}
	
	/**
	 * 获取catid字段对应的结果集
	 * @param unknown_type $catid
	 */
	function getCountByCatid($catid){
		$this->db->count_all_results('tdj_sell');
		$this->db->from('tdj_sell');
		$this->db->where('catid', $catid);
		return $this->db->count_all_results();
	}
	
	/**
	 * 材料搜索
	 * @param unknown_type $catid
	 * @param unknown_type $areaid
	 * @param unknown_type $text
	 * @param unknown_type $pageSize
	 * @param unknown_type $pageIndex
	 */
	function getByWhere($catid,$areaid,$text,$pageSize,$pageIndex){
		$result=array();
		$catList=$this->category->getAllDataList();
		$areaList=$this->area->getAllDataList();
		$catids=array();	//分类ID集
		$areaids=array();	//地区ID集
		if($catid!=-1){
			//处理分类
			for($i=0; $i<count($catList); $i++){
				$id=$catList[$i]['catid'];
				if($id==$catid){
					$catids=explode(",",$catList[$i]['arrchildid']);	
					break;
				}
			}
		}
		
		if($areaid!=-1){
			//处理地区
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
		if($text!=null&&$text!=""){	//text不为空
			$this->db->where("(title like '%".$text."%' or company like'%".$text."%' or keyword like '%".$text."%')");
		}
		if(count($catids)>0){	//分类不为空
			$this->db->where_in('catid', $catids);
		}
		if(count($areaids)>0){	//地区不为空
			$this->db->where_in('areaid', $areaids);
		}
		$this->db->limit($pageSize,$pageIndex*$pageSize+1);
		$query=$this->db->get("tdj_sell");
		$value=$query->result_array();
		return $value;
	}
	
	/**
	 * 材料搜索结果集
	 * @param unknown_type $catid
	 * @param unknown_type $areaid
	 * @param unknown_type $text
	 * 		$this->db->last_query();
	 */
	function getByWhereCount($catid,$areaid,$text){
		$result=array();
		$catList=$this->category->getAllDataList();
		$areaList=$this->area->getAllDataList();
		$catids=array();	//分类ID集
		$areaids=array();	//地区ID集
		if($catid!=-1){
			//处理分类
			for($i=0; $i<count($catList); $i++){
				$id=$catList[$i]['catid'];
				if($id==$catid){
					$catids=explode(",",$catList[$i]['arrchildid']);
					break;
				}
			}
		}
	
		if($areaid!=-1){
			//处理地区
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
		if($text!=null&&$text!=""){	//text不为空
			$this->db->where("(title like '%".$text."%' or company like'%".$text."%' or keyword like '%".$text."%')");
		}
		if(count($catids)>0){	//分类不为空
			$this->db->where_in('catid', $catids);
		}
		if(count($areaids)>0){	//地区不为空
			$this->db->where_in('areaid', $areaids);
		}
		$this->db->select("count(*)");
		$query=$this->db->get("tdj_sell");
		$value=$query->result_array();
		return $value;
	}
	
	/**
	 * 主键查询
	 * @param unknown_type itemid
	 * 		$this->db->last_query();
	 */
	function getByPk($itemid){
		$query=$this->db->where("itemid",$itemid);
		$query=$this->db->get("tdj_sell");
		return $query->result_array();
	}
	
}