<?php
class Tdj_company extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->model('category');
		$this->load->model('area');
	}
	
	/**
	 * ���ҹ�Ӧ����Ϣ
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
	 * ���ҹ�Ӧ����Ϣ
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
	 * ���ҹ�Ӧ����Ϣ
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
	 * ����company����Ϣ
	 * @param $$catid,$areaid,$kw
	 * @return result
	 */
	public function getByWhere($catid,$areaid,$text,$pageSize,$pageIndex){
		
		$catList=$this->category->getAllDataList();
		$areaList=$this->area->getAllDataList();
		$catids=array();	//����ID��
		$areaids=array();	//����ID��
		if($catid!=-1){
			//�������
			for($i=0; $i<count($catList); $i++){
				$id=$catList[$i]['catid'];
				if($id==$catid){
					$catids=explode(",",$catList[$i]['arrchildid']);	
					break;
				}
			}
		}
		
		if($areaid!=-1){
			//�������
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
		if($text!=null&&$text!=""){	//text��Ϊ��
			$this->db->where("(company like '%".$text."%' or company like'%".$text."%' or keyword like '%".$text."%' or sell like '%".$text."%')");
		}
		if(count($catids)>0){	//���಻Ϊ��
			$this->db->where_in('catid', $catids);
		}
		if(count($areaids)>0){	//������Ϊ��
			$this->db->where_in('areaid', $areaids);
		}
		$this->db->limit($pageSize,$pageIndex*$pageSize+1);
		$query=$this->db->get("tdj_company");
		$value=$query->result_array();
		return $value;
		
	}
	
	/**
	 * ����company�����
	 * @param unknown_type $catid
	 * @param unknown_type $areaid
	 * @param unknown_type $text
	 * 		$this->db->last_query();
	 */
	function getByWhereCount($catid,$areaid,$text){
		$result=array();
		$catList=$this->category->getAllDataList();
		$areaList=$this->area->getAllDataList();
		$catids=array();	//����ID��
		$areaids=array();	//����ID��
		if($catid!=-1){
			//�������
			for($i=0; $i<count($catList); $i++){
				$id=$catList[$i]['catid'];
				if($id==$catid){
					$catids=explode(",",$catList[$i]['arrchildid']);
					break;
				}
			}
		}
	
		if($areaid!=-1){
			//�������
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
		if($text!=null&&$text!=""){	//text��Ϊ��
			$this->db->where("(company like '%".$text."%' or company like'%".$text."%' or keyword like '%".$text."%' or sell like '%".$text."%')");
		}
		if(count($catids)>0){	//���಻Ϊ��
			$this->db->where_in('catid', $catids);
		}
		if(count($areaids)>0){	//������Ϊ��
			$this->db->where_in('areaid', $areaids);
		}
		$this->db->select("count(*)");
		$query=$this->db->get("tdj_company");
		$value=$query->result_array();
		return $value;
	}

}