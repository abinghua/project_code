<?php
class AreaModel extends CI_Model {

  public function __construct()
  {
    $this->load->database();
    $this->getAllDataList();
  }
  
  private $areaList;
  
  /**
   * 所有地区数据
   */
  public function getAllDataList(){
  	if($this->areaList==null){
  		$this->db->select("areaid,areaname,parentid,arrparentid,child,arrchildid");
  		$query = $this->db->get_where("tdj_area",null);
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
   * 获取父节点对应的结果集
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
   * 主键对应结果
   * @param unknown_type $paramid
   * @return Ambigous <multitype:, unknown>
   */
  public function getByPk($areaid){
  	$size = count($this->areaList);
  	$array=array(); 
  	for($i=0;$i<$size;$i++)
  	{
  		$row=$this->areaList[$i];
  		$col=$row["areaid"];
  		if($col==$areaid){
  			 $array=$row;
  			 break;
  		}
  	}
  	return $array;
  }
  
}