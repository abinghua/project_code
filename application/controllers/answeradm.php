<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class answeradm extends CI_Controller {

	
	 function __construct()
	{
       parent::__construct();
	   $this->load->model('memberModel');
	   $this->load->database();
	   $this->load->model('sellModel');
	   $this->load->library('encrypt');
	   $this->load->library("auth");
	   $this->load->model('areaModel');
	   $this->load->model('categoryModel');
	   $this->load->library("checkcode"); 
	   $this->load->model('xjListModel');
	   $this->load->model('XjDetailModel');
	   $this->load->model('xjImageModel');
	   $this->load->model('xjStateModel');
	   $this->load->model('CompanyModel');
	   $this->load->model('yxListModel');
	   $this->load->model('yxDetailModel');
	}
	public function index()
	{
		if($this->auth->hasLogin()){
			$data =array();
			$stateCount = array();
			$userid = $this->session->userdata('userid');
			$member = $this->memberModel->getByPk($userid);
			$username  = $member['username'];
			$data['userid'] = $userid;
			$data['username'] = $username;
			
			if($member['groupid'] != 6 && $member['groupid'] !=7 && $member['groupid'] !=1){ //1 admin 测试用
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/\">');</script> ";
					$msg = '您无权访问此页面！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
			}
			$xj_no = trim($this->input->get('xjno',true));
			$timeStatus = trim($this->input->get('timeStatus',true));//时间状态
			$status = trim($this->input->get('status',true));//应询单状态
			
			/*
			if(preg_match("#^[0-9]{1,}$#",$xj_no) && preg_match("#^[0-9]{1,}$#",$timeStatus) && preg_match("#^[0-9]{1,}$#",$status)){
				$xjList = $this->xjListModel->getAnswerByUserid_Xjno($userid,$xj_no);
				$detail = $this->searchAnsList($xjList,$member);
			}else{
				$detail =array();
			}
			*/
			
			$xjList = $this->xjListModel->getAnswerByUserid($userid);
			$detail = $this->searchAnsList($xjList,$member,"xjList");
			
			//构造状态个数
			$stateAll = $this->xjStateModel->getAnswer();
			foreach($stateAll as $key=>$val){
				foreach($detail as $key2 =>$val2){
					if($val2['state_id'] == $val['state_id']){
						if(isset($stateAll[$key]['count'])){
							$stateAll[$key]['count']++;
						}else{
							$stateAll[$key]['count'] =1;
						}
						if($val['state_id'] && $val['state_id'] !=5 && $val['state_id'] !=6){
							$detail[$key2]['statename'] = '应询中';
						}else{
							$detail[$key2]['statename'] = $val['text'];
						}
					}
				}
			}
			//print_r($stateAll);
			$data['stateAll'] = $stateAll;
			$data['detail'] = $detail;
			$this->load->view("answeradm",$data);
		}else{
			redirect(base_url()."index.php/login");
		}
		
	}
	//寻找该用户能够应询的单 分类 地区 $type 返回xjlist 或 xj_detail
	public function searchAnsList($xjList,$member,$type){
		$company = $this->CompanyModel->getByPk($member['company_id']);//解决一个供应商下有多个用户问题
		$company_catid = explode(',',$company[0]['catid']);
		
		$company_areaid = $this->areaModel->getByPk($company[0]['areaid']);
		//print_R($company_areaid);
		$parentidList="";//分类匹配用
		$xjListUser = array();//该用户可以应询的单，用于返回
		$xjDetailUser = array(); //某单下可以应询的产品,用于返回
		$arrChildList='';//地区匹配用
		foreach($xjList as $key => $val){
				
				$yxList = $this->yxListModel->getYxByComId_Xjid($member['company_id'],$val['xj_id']);
				
				$detail_list = $this->XjDetailModel->getByXjId($val['xj_id']);
				
				
				
				
					foreach($detail_list as $key2 => $val2){
						$flagCategory=false;
						$flagEndate = false;
						$flagArea = false;
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
						
						$area_limit = $val2['limit_areaid'];
						if($area_limit){
							foreach(explode(',',$area_limit) as $val6){
								if($val6 !=""){
									$arrChild = $this->areaModel->getByPk($val6);
									$arrChildList .= $arrChild['arrchildid'].',';
								}
							}
						}
						if(!$company_areaid  || !$area_limit){ //地区匹配
								$flagArea = true;
						}else if($company_areaid && empty($company_areaid['arrchildid'])){
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
						if($flagCategory &&  $flagEndate && $flagArea){
							$xjDetailUser[] = $val2;//用于返回可以应询的产品
							$i = $key;
							$yx_enable[] = $val2;//总的能够应询的detail数量 
							if($yxList){
								$yxDetail = $this->yxDetailModel->getByYxId($yxList[0]['yx_id']);
								$already_detail[] = $yxDetail;//已经应询的detail数量
								//print_R($already_detail);
								//echo "<br>";
								//echo count($already_detail)."<br>";
								//print_r($)
							}
						}
					}
				
				
				if(isset($i)){//统计能够应询和应询的数量
					$xjList[$i]['alreadyCount'] = isset($already_detail) ? count($already_detail[$i]) : 0;
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
