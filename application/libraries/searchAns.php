<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class searchAns{
	
	private $_CI;


	 /**
     * 构造函数
     * 
     * @access public
     * 
     */
    public function __construct()
    {
        /** 获取CI句柄 */
	   //$this->_CI = & get_instance();
	   $this->load->model('sellModel');
	   $this->load->library('encrypt');
	   //$this->load->library("auth");
	   $this->load->model('areaModel');
	   $this->load->model('categoryModel');
	   //$this->load->library("checkcode"); 
	   $this->load->model('xjListModel');
	   $this->load->model('XjDetailModel');
	   $this->load->model('xjImageModel');
	   $this->load->model('xjStateModel');
	   $this->load->model('CompanyModel');
	   $this->load->model('yxListModel');
	   $this->load->model('yxDetailModel');
    }
	/**/
	public function searchAnsList($xjList,$member,$type){
		
		$company = $this->CompanyModel->getByPk($member['company_id']);//解决一个供应商下有多个用户问题
		$company_catid = explode(',',$company[0]['catid']);
		$company_areaid = $this->areaModel->getByPk($company[0]['areaid']);
		$parentidList="";//分类匹配用
		$xjListUser = array();//该用户可以应询的单，用于返回
		$xjDetailUser = array(); //某单下可以应询的产品,用于返回
		$arrChildList='';//地区匹配用
		foreach($xjList as $key => $val){
				$yxList = $this->yxListModel->getYxByComId_Xjid($member['company_id'],$val['xj_id']);
				$flagArea = false;
				$detail_list = $this->XjDetailModel->getByXjId($val['xj_id']);
				$area_limit = $val['limit_areaid'];
				if($area_limit){
					foreach(explode(',',$area_limit) as $val6){
						if($val6 !=""){
							$arrChild = $this->areaModel->getByPk($val6);
							$arrChildList .= $arrChild['arrchildid'].',';
						}
					}
				}
				if(!$company_areaid || !$area_limit){ //地区匹配
						$flagArea = true;
				}else{
					foreach(explode(',',$company_areaid['arrchildid']) as $val5){//循环供应商分类
						foreach(explode(',',$arrChildList) as $val7){
							if($val7 !=0 && $val5 == $val7 && $val5!='' && $val7!=''){
								$flagArea =true;
								break;
							}
						}
					}
				}
				
				if($flagArea){
					foreach($detail_list as $key2 => $val2){
						$flagCategory=false;
						$flagEndate = false;
						$item = $this->sellModel->getByPk($val2['itemid']);
						$catidArr = $this->categoryModel->getByPk($item[0]['catid']);
						$parentidList = $catidArr['arrparentid'];
						
						foreach($company_catid as $val3){//分类匹配
							foreach(explode(',',$parentidList) as $val4){
								if($val3 == $val4 && $val3 !='' && $val4 !=0){
									$flagCategory = true;
									break;
								}
							}
						}
						
						
						// 应询中，过期，提交才能看     没过期，可以看
						if($val['state_id'] == 3){//应询中  多一个过期判断
							if(strtotime($val['end_date'] - time() <0)){
								if($yxList && $yxList[0]['state_id'] =8){
									$flagEndate = true;
								}
							}else{
								$flagEndate = true;
							}
						}else{//已应询  提交即可看
							if($yxList && $yxList[0]['state_id'] =8){
								$flagEndate = true;
							}
						}
						/**/
						$parentidList = "";
						$arrChildList = "";
						if($flagCategory &&  $flagEndate){
							$xjDetailUser[] = $val2;//用于返回可以应询的产品
							$i = $key;
							$yx_enable[] = $val2;//总的能够应询的detail数量 
							if($yxList){
								$yxDetail = $this->yxDetailModel->getByYxId($yxList[0]['yx_id']);
								$already_detail[] = $yxDetail;//已经应询的detail数量
							}
						}
					}
				}
				
				if(isset($i)){//统计能够应询和应询的数量
					$xjList[$i]['alreadyCount'] = isset($already_detail) ? count($already_detail) : 0;
					$xjList[$i]['totalCount'] = isset($yx_enable) ? count($yx_enable) : 0;//能够应询总数
					$xjListUser[] = $xjList[$i];
					unset($already_detail);
					unset($yx_enable);
					unset($i);
				}
		}
		
		if($type == "xjList"){
			return $xjListUser;
		}elseif($type == "xjDetail"){
			return $xjDetailUser;
		}
			
	}
	
 }

?>