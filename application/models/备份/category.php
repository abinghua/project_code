<?php
class Category extends CI_Model {

public function __construct()
  {
    $this->load->database();
    $this->getAllDataList();
  }
  
  private $areaList;
  
  /**
   * 所有分类集合
   */
  public function getAllDataList(){
  	if($this->areaList==null){
  		$this->db->select("*");
  		$query = $this->db->get_where("tdj_category",null);
  		$this->areaList= $query->result_array();
  	}
  	return $this->areaList;
  }
  
  /**
   * 刷新内存数据
   */
  public function clear(){
  		$areaList=null;
  		$this->getAllDataList();
  }
  
  /**
   * 找父节点对象
   * @param unknown_type $id
   * @return multitype:unknown
   */
  public function getByParentid($id){
  	$size = count($this->areaList);
  	$array=array(); 
  	$index=0;
  	for($i=0;$i<$size;$i++)
  	{
  		$row=$this->areaList[$i];
  		$parentid=$row["parentid"];
  		if($parentid==$id){
  			 $array[$index]=$row;
  			 $index++;
  		}
  	}
  	return $array;
  }
  
  /**
   * 找主键对象
   * @param unknown_type $id
   * @return Ambigous <multitype:, unknown>
   */
  public function getByPk($id){
  	$size = count($this->areaList);
  	$array=array(); 
  	for($i=0;$i<$size;$i++)
  	{
  		$row=$this->areaList[$i];
  		$catid=$row["catid"];
  		if($catid==$id){
  			 $array=$row;
  			 break;
  		}
  	}
  	return $array;
  }
  
  /**
   * 绑定所有商品对应的分类
   * @param unknown_type $sells
   */
  function getListBySells($sells){
  	$array=array();
  	if($sells!=null){
  		$index=0;
  		for($i=0; $i<count($sells); $i++){
  			$dto=$sells[$i];
  			$catid=$dto['catid'];
  			$list=$this->getAllDataList();
  			for($j=0;$j<count($list); $j++){
  				$obj=$list[$j];
  				$id=$obj['catid'];
  				if($id==$catid){
  					$array[$index]=$obj;
  					$index++;
  					break;
  				}
  			}
  		}
  	}
  }
  
}