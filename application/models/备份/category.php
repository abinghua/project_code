<?php
class Category extends CI_Model {

public function __construct()
  {
    $this->load->database();
    $this->getAllDataList();
  }
  
  private $areaList;
  
  /**
   * ���з��༯��
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
   * ˢ���ڴ�����
   */
  public function clear(){
  		$areaList=null;
  		$this->getAllDataList();
  }
  
  /**
   * �Ҹ��ڵ����
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
   * ����������
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
   * ��������Ʒ��Ӧ�ķ���
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