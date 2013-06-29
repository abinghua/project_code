<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class answerModify extends CI_Controller {

	 private $answeradm;
	 function __construct()
	{
       parent::__construct();
	   include_once('answeradm.php');
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
	   $this->load->model('XjReplyModel');
	   $this->load->model('CompanyModel');
	   $this->load->model('yxListModel');
	   $this->load->model('yxDetailModel');
	   $this->load->model('XjImageModel');
	   $this->answeradm = new answeradm();
	}
	public function index()
	{
		if($this->auth->hasLogin()){
			$data =array();
			$catCount = array();//分类（个数）
			
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
			$xj_id = trim($this->input->get('xjid',true));
			$detail_id =trim($this->input->get("detailid",true));
			if(!preg_match("#^[0-9]{1,9}$#",$xj_id)  || !preg_match("#^[0-9]{1,9}$#",$detail_id)){
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
				$msg = '您访问的订单不存在！页面在5s钟后跳转！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;//待处理
			}
			$xjList = $this->xjListModel->getOneAnswerByUserid($userid,$xj_id);
			if(!$xjList){
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
				$msg = '您访问的订单不存在！页面在5s钟后跳转！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;//待处理
			}else if($xjList && $xjList[0]['state_id']>=4){
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
				$msg = '您访问的订单已结束！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;//待处理
			}
			
			$state = $this->xjStateModel->getByPk($xjList[0]['state_id']);
			if($xjList[0]['state_id'] ==3 || $xjList[0]['state_id'] ==4){
				$xjList[0]['statename'] ="应询中";
			}else{
				$xjList[0]['statename'] = $state['text'];
			}
			
			
			$xjDetailUser = $this->answeradm->searchAnsList($xjList,$member,"xjDetail");
			if(!$xjDetailUser){
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answer?xjid=$xj_id\">');</script> ";
				$msg = '您提交的订单不存在！页面在5s钟后跳转！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;
			}
			$detail_list = array();
			foreach($xjDetailUser as $key =>$val){
				if($val['detail_id'] == $detail_id){
					$detail_list = $xjDetailUser[$key];
					break;
				}
			}
			
			//获取图片信息
			$imgs = $this->XjImageModel->getByDetailid($detail_list['detail_id']);
			$item = $this->sellModel->getByPk($detail_list['itemid']);
			$detail_list['detail_img'] = isset($imgs['url']) ? $imgs['url'] : '';
			$detail_list['item_img'] = !empty($item[0]['thumb']) ? $item[0]['thumb'] : (!empty($item[0]['thumb1']) ? $item[0]['thumb1']:(!empty($item[0]['thumb2']) ? $item[0]['thumb2'] : ''));
			
			$detail_list['yx_img'] = '';
			$yxList = $this->yxListModel->getYxByComId_Xjid($member['company_id'],$xj_id);
		
			if($yxList && $yxList[0]['state_id'] ==7){//当前有未提交的单,
				$yxDetail = $this->yxDetailModel->getByYx_idUser_idXj_detialid($yxList[0]['yx_id'],$member['company_id'],$detail_id);
				if($yxDetail){
					$detail_list['yx_img'] = $yxDetail['sample_image'];
					$detail_list['yx_detail'] = $yxDetail;
				}
			}
			
			$data['detail'] = $detail_list;
			$data['xjList'] =  $xjList;
			$data['catCount'] = $catCount;
			$this->load->view("answerModify",$data);
		}else{
			redirect(base_url()."index.php/login");
		}
		
	}
	
	function updateAnswer(){
		if(!$this->auth->hasLogin()){
			redirect(base_url()."index.php/login");
		}
		
		
		$xj_id = $this->input->post('xj_id',true);
		$detail_id = $this->input->post('xj_detail_id',true); //询价id
		$price = $this->input->post('price',true);
		
		$amount = $this->input->post('amount',true);
		$unit = $this->input->post('unit',true);
		$days = $this->input->post('days',true);
		$remark = $this->input->post('remark',true);
		
		//$yxDetailId = trim($this->input->post('detail_id',true));//应询id
		if(!$xj_id || !$detail_id || !$price ||  !$amount || !$unit || !$days){
			echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
			$msg = '您访问的订单不存在！页面在5s钟后跳转！';
			$data['msg'] = $msg;
			$this->load->view('404',$data);
			return false;
		}
		
		if(!preg_match("#^[0-9]{1,9}$#",$xj_id) || !preg_match("#^[0-9]{1,9}$#",$detail_id) || !preg_match("#^[0-9]{1,9}$#",$amount) || !preg_match("#^[0-9]{1,9}$#",$days) ){
			echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
			$msg = '您访问的订单不存在！页面在5s钟后跳转！';
			$data['msg'] = $msg;
			$this->load->view('404',$data);
			return false;
		}
		
		$userid = $this->session->userdata('userid');
		$member = $this->memberModel->getByPk($userid);
		$username  = $member['username'];
		$company = $this->CompanyModel->getByPk($member['company_id']);//解决一个供应商下有多个用户问题
		$xjList = $this->xjListModel->getOneAnswerByUserid($userid,$xj_id);
		if(!$xjList){
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
				$msg = '您访问的订单不存在！页面在5s钟后跳转！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;
		}
		
		$xjDetailUser = array();
		$xjDetailUser = $this->answeradm->searchAnsList($xjList,$member,"xjDetail");
		if(!$xjDetailUser){
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answer?xjid=$xj_id\">');</script> ";
				$msg = '您提交的订单不存在！页面在5s钟后跳转！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;
		}
		
		
		//图片路径：file/answer/用户名/订单号/订单详细编号/日期/
		if(isset($_FILES['url']) && !empty($_FILES['url'])){
			$picurl = $_FILES['url'];
			if(!file_exists('file/answer/'.$userid)){
				mkdir('file/answer/'.$userid);
			}
			if(!file_exists('file/answer/'.$userid.'/'.$detail_id)){
				mkdir('file/answer/'.$userid.'/'.$detail_id);
			}
			$dir = 'file/answer/'.$userid.'/'.$detail_id.'/'.date("Ymd");
			if(!file_exists($dir)){
				mkdir($dir);
			}
			if($picurl['type'] =='image/jpeg' || $picurl['type'] =='image/gif' || $picurl['type'] =='image/png'){
				$extName = substr($picurl['name'],strrpos($picurl['name'],'.'));
				$uploadFile = $dir.'/'.date('YmdHis').rand(1000,9999).$extName;
				move_uploaded_file($picurl['tmp_name'],$uploadFile);
			}
		}
		
		$yxList = $this->yxListModel->getYxByComId_Xjid($member['company_id'],$xj_id);
		
		if(!$yxList || $yxList[0]['state_id'] ==8){//当前没有未提交的单,
			$paramYxList = array(
				'state_id' =>7,
				'company_id' =>$member['company_id'],
				'company' =>$company[0]['company'],
				'user_id'=>$userid,
				'user_name'=>$member['username'],
				'sub_time'=>date('Y-m-d H:i:s'),
				'xj_id' =>$xj_id
			);
			$yx_id = $this->yxListModel->insert($paramYxList);
			//print_r($paramYxList);
		}
		
		$paramYxDetail = array(
			'xj_detail_id' =>$detail_id,
			'yx_id' =>isset($yx_id)? $yx_id :$yxList[0]['yx_id'],
			'price' =>$price,
			'amount' =>$amount,
			'unit' => $unit,
			'days' => $days,
			'date' => date('Y-m-d H:i:s'),
			'user_id' =>$userid,
			'user_name' =>$username,
		);
		isset($uploadFile) ? $paramYxDetail['sample_image'] = $uploadFile : '';
		$yx_detail = $this->yxDetailModel->getForUpdate($detail_id,isset($yx_id)? $yx_id :$yxList[0]['yx_id'],$userid);
		
		if($yx_detail){
			//$paramYxDetail['detail_id'] = $yx_detail['detail_id'];
			//print_r($yx_detail);
			$this->yxDetailModel->update($paramYxDetail);
		}else{
			$this->yxDetailModel->insert($paramYxDetail);
		}
		redirect(base_url().'index.php/answer?xjid='.$xj_id);
	}
	
}

?>
