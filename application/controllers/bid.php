<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bid extends CI_Controller {

	
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
	   $this->load->model('XjImageModel');
	   $this->load->model('yxListModel');
	   $this->load->model('yxDetailModel');
	   $this->load->model('CompanyModel');
	}
	public function index()
	{
		if($this->auth->hasLogin()){
			$data =array();
			$catCount = array();//分类（个数）
			$areaName = '';
			$userid = $this->session->userdata('userid');
			$member = $this->memberModel->getByPk($userid);
			$username  = $member['username'];
			$data['userid'] = $userid;
			$data['username'] = $username;
			if($member['groupid'] != 5 && $member['groupid'] !=8 && $member['groupid'] !=1){
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/\">');</script> ";
					$msg = '您无权访问此页面！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
			}
			$detail_id = $this->input->get('detailid',true);
			$xj_id = $this->input->get('xjid',true);
			
			if(preg_match('#^[0-9]{1,9}$#',$xj_id)){//对提交的xjid做严格匹配，防止非法提交
				$xj_id = $this->input->get('xjid',true);
				$xjList = $this->xjListModel->getByUserid_Xjid($xj_id,$userid);
				
				if(!$xjList){//防止提交非法数据
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/orderadm\">');</script> ";
					$msg = '您访问的订单不存在！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
				}
				
			}else{//如果用户直接访问bid页面
				$xjList = $this->xjListModel->getSubmitByUserid($userid);
				if(!$xjList){//如果没有提交的订单
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/orderadm\">');</script> ";
					$msg = '您访问的订单不存在！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
				}
				$xj_id = $xjList['xj_id'];
			}
			if(!preg_match('#^[0-9]{1,9}$#',$detail_id)){
				$detail = $this->XjDetailModel->getLastestByXjId($xjList['xj_id']);
			}else{
				$detail = $this->XjDetailModel->getByXjid_Detailid($xj_id,$detail_id);
				if(!$detail){
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/orderadm\">');</script> ";
					$msg = '您访问的订单不存在！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
				}
			}
			
			//print_r($detail);
			
			
			if($xjList['state_id'] ==2 || $xjList['state_id'] ==3 ){
				$xjList['statename'] = "应询中";
			}else{
				$stateName = $this->xjStateModel->getByPk($xjList['state_id']);
				$xjList['statename'] = $stateName['text'];
			}
			
			$item = $this->sellModel->getByPk($detail['itemid']);
			$catid = $this->categoryModel->getByPk($item[0]['catid']);
			$detail['imgurl'] = $item[0]['thumb'];
			
			$limit_areaid = $detail['limit_areaid'];
			if($limit_areaid){//地区处理
				$areaidArr = explode(',',$limit_areaid);
				foreach($areaidArr as $val){
					$area = $this->areaModel->getByPk($val);
					$areaName .= ' '.$area['areaname'];
				}
				$detail['areaname'] =  $areaName;
				$areaName ='';
			}else{
				$detail['areaname'] =  '全国';
			}
			//imgage url 处理
			$img = $this->XjImageModel->getByDetailid($detail['detail_id']);
			$imgurl = isset($img['url']) ? $img['url'] : "";
			$detail['imgurl'] =$item[0]['thumb'].",".$imgurl;
			
			$yx_detail = $this->yxDetailModel->getByXjDetail($detail['detail_id']);
			
			$yx_detail_userd = array();
			$i =0;
			foreach($yx_detail as $key =>$val){
				$yxList = $this->yxListModel->getByPk($val['yx_id']);
				if($yxList && $yxList['state_id'] ==8 && $xjList['state_id'] >=4){//状态
					
					$yx_detail_userd[$i] = $val;
					$user = $this->memberModel->getByPk($val['user_id']);
					$company = $this->CompanyModel->getByPk($user['company_id']);
					
					//print_r($company);
					$yx_detail_userd[$i]['truename'] = $user['truename'];
					$yx_detail_userd[$i]['mobile'] = $user['mobile'];
					$yx_detail_userd[$i]['telephone'] = $company[0]['telephone'];
					$yx_detail_userd[$i]['address'] = $company[0]['address'];
					$yx_detail_userd[$i]['email'] = $user['email'];
					$yx_detail_userd[$i]['company'] = $company[0]['company'];
					$i++;
				}
				
			}
			$data['yxDetail'] = $yx_detail_userd;
			//print_r($yx_detail_userd);
			$data['xjList'] = $xjList;
			$data['detail'] = $detail;
			$data['catCount'] = $catCount;
			$this->load->view("bid",$data);
		}else{
			redirect(base_url()."index.php/login");
		}
		
	}
	
	
}

?>
