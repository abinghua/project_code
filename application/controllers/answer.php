<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class answer extends CI_Controller {
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
	   $this->load->model('CompanyModel');
	   $this->load->model('yxListModel');
	   $this->load->model('yxDetailModel');
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
			$xj_id = $this->input->get('xjid',true);
			
			$parentidList="";//分类匹配用
			$xjDetailUser = array();//该用户可以应询的单
			$arrChildList='';//地区匹配用
			if($member['groupid'] != 6 && $member['groupid'] !=7 && $member['groupid'] !=1){ //1 admin 测试用
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/\">');</script> ";
					$msg = '您无权访问此页面！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
			}
			if(!preg_match("#^[0-9]{1,9}$#",$xj_id)){
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
					$msg = '您访问的订单不存在！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
			}
			$xjList = $this->xjListModel->getOneAnswerByUserid($userid,$xj_id);
			
			if(!$xjList){
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
					$msg = '您访问的订单不存在！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
			}
			
			
			$xjDetailUser = $this->answeradm->searchAnsList($xjList,$member,"xjDetail");
			
			$state = $this->xjStateModel->getByPk($xjList[0]['state_id']);
			if($xjList[0]['state_id'] ==3 || $xjList[0]['state_id'] ==4){
				$xjList[0]['statename'] ="应询中";
			}else{
				$xjList[0]['statename'] = $state['text'];
			}
			
			if(!$xjDetailUser){
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
				$msg = '您提交的订单不存在！页面在5s钟后跳转！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;
			}
			
			$yxList = $this->yxListModel->getYxByComId_Xjid($member['company_id'],$xj_id);
			
			
			if(!$yxList){
				$detail = $xjDetailUser;
				foreach($detail as $key=>$val){
					$detail[$key]['submit'] = '否';
				}
			}else{
				$catCount = array();
				$yxDetail = $this->yxDetailModel->getByYxId($yxList[0]['yx_id']);
				if($yxList[0]['state_id'] ==7){
					$detail = $xjDetailUser;
					foreach($detail as $key =>$val){
						$flagYx = false;
						foreach($yxDetail as $key2 =>$val2){
							if($val['detail_id'] == $val2['xj_detail_id']){
								$flagYx = true;
								foreach($val2 as $key3 =>$val3){
									$detail[$key]['yx_'.$key3]  = $val3;
								}
								break;
							}
						}
						if($flagYx){
							$detail[$key]['submit'] = "是";
							
						}else{
							$detail[$key]['submit'] = '否';
						}
						
						///构造分类(个数)
						$item = $this->sellModel->getByPk($val['itemid']);
						$catid = $this->categoryModel->getByPk($item[0]['catid']);
						$arrparentid = explode(',',$catid['arrparentid']);
						if(count($arrparentid) ==1){
							$flag=true;
							$k = count($catCount);
							if($k != 0){
								foreach($catCount as $val){
										if($val['catid'] == $catid['catid']){
											$catCount[$k-1]['count'] ++;
											$flag =false;
											break;
										}
								}
								if($flag){
										$catCount[$k]['catid'] = $catid['catid'];
										$catCount[$k]['catname'] = $catid['catname'];
										$catCount[$k]['count'] = 1;
								}
							}else{
										$catCount[$k]['catid'] = $catid['catid'];
										$catCount[$k]['catname'] = $catid['catname'];
										$catCount[$k]['count'] = 1;
							}
							$detail[$key]['catname'] = $catid['catname'];
							$detail[$key]['catid'] = $catid['catid'];
						}else{
							$catname = $this->categoryModel->getByPk($arrparentid[1]);
							$k = count($catCount);
							if($k != 0){
								$flag=true;
								foreach($catCount as $val){
										if($val['catid'] == $catname['catid']){
											$catCount[$k-1]['count'] ++;
											$flag =false;
											break;
										}
								}
								if($flag){
										$catCount[$k]['catid'] = $catname['catid'];
										$catCount[$k]['catname'] = $catname['catname'];
										$catCount[$k]['count'] = 1;
								}
							}else{
										$catCount[$k]['catid'] = $catname['catid'];
										$catCount[$k]['catname'] = $catname['catname'];
										$catCount[$k]['count'] = 1;
							}
							$detail[$key]['catname'] =  $catname['catname'];
							$detail[$key]['catid'] = $catname['catid'];
						}
					}
				}else{
					$detail  = $xjDetailUser;
					foreach($detail as $key=>$val){
						/*
						$detail[$key]['submit'] = "是";
						foreach($yxDetail as $key2 =>$val2){
							foreach($val2 as $key3 =>$val3){
								$detail[$key]['yx_'.$key3]  = $val3;
							}
						}
						*/
						
						
						$flagYx = false;
						
						foreach($yxDetail as $key2 =>$val2){
							if($val['detail_id'] == $val2['xj_detail_id']){
								$flagYx = true;
								foreach($val2 as $key3 =>$val3){
									$detail[$key]['yx_'.$key3]  = $val3;
								}
								break;
							}
						}
						if($flagYx){
							$detail[$key]['submit'] = "是";
							
						}else{
							$detail[$key]['submit'] = '否';
						}
						
						///构造分类(个数)
						$item = $this->sellModel->getByPk($val['itemid']);
						$catid = $this->categoryModel->getByPk($item[0]['catid']);
						$arrparentid = explode(',',$catid['arrparentid']);
						if(count($arrparentid) ==1){
							$flag=true;
							$k = count($catCount);
							if($k != 0){
								foreach($catCount as $val){
										if($val['catid'] == $catid['catid']){
											$catCount[$k-1]['count'] ++;
											$flag =false;
											break;
										}
								}
								if($flag){
										$catCount[$k]['catid'] = $catid['catid'];
										$catCount[$k]['catname'] = $catid['catname'];
										$catCount[$k]['count'] = 1;
								}
							}else{
										$catCount[$k]['catid'] = $catid['catid'];
										$catCount[$k]['catname'] = $catid['catname'];
										$catCount[$k]['count'] = 1;
							}
							$detail[$key]['catname'] = $catid['catname'];
							$detail[$key]['catid'] = $catid['catid'];
						}else{
							$catname = $this->categoryModel->getByPk($arrparentid[1]);
							$k = count($catCount);
							if($k != 0){
								$flag=true;
								foreach($catCount as $val){
										if($val['catid'] == $catname['catid']){
											$catCount[$k-1]['count'] ++;
											$flag =false;
											break;
										}
								}
								if($flag){
										$catCount[$k]['catid'] = $catname['catid'];
										$catCount[$k]['catname'] = $catname['catname'];
										$catCount[$k]['count'] = 1;
								}
							}else{
										$catCount[$k]['catid'] = $catname['catid'];
										$catCount[$k]['catname'] = $catname['catname'];
										$catCount[$k]['count'] = 1;
							}
							$detail[$key]['catname'] =  $catname['catname'];
							$detail[$key]['catid'] = $catname['catid'];
						}
						
					}
				}
			}
			//print_r($detail);
			$data['catCount'] = $catCount;
			$data['yxList'] = $yxList;
			$data['detail'] = $detail;
			$data['xjList'] =  $xjList;
			$data['catCount'] = $catCount;
			$this->load->view("answer",$data);
		}else{
			redirect(base_url()."index.php/login");
		}
		
	}
	function submitUn(){
		if(!$this->auth->hasLogin()){
			redirect(base_url()."index.php/login");
		}
		
		$xj_id = $this->input->post('xjid',true);
		$userid = $this->session->userdata('userid');
		$member = $this->memberModel->getByPk($userid);
		$username  = $member['username'];
		$data['userid'] = $userid;
		$data['username'] = $username;
		$company = $this->CompanyModel->getByPk($member['company_id']);//解决一个供应商下有多个用户问题
		$company_catid = explode(',',$company[0]['catid']);
		$company_areaid = $this->areaModel->getByPk($company[0]['areaid']);
			
		$parentidList="";//分类匹配用
		$xjDetailUser = array();//该用户可以应询的单
		$arrChildList='';//地区匹配用
		if($member['groupid'] != 6 && $member['groupid'] !=7 && $member['groupid'] !=1){ //1 admin 测试用
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/\">');</script> ";
				$msg = '您无权访问此页面！页面在5s钟后跳转！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;
		}
		$xj_id = $this->input->post('xjid',true);
		if(!preg_match("#^[0-9]{1,9}$#",$xj_id)){
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
				$msg = '您访问的订单不存在！页面在5s钟后跳转！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;
		}
		$xjList = $this->xjListModel->getOneAnswerByUserid($userid,$xj_id);
		if(!$xjList){
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
				$msg = '您访问的订单不存在！页面在5s钟后跳转！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;
		}else if($xjList && $xjList[0]['state_id']>=4){
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
				$msg = '您提交的订单已结束';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;
		}
		
		
		$xjDetailUser = $this->answeradm->searchAnsList($xjList,$member,"xjDetail");
		if(!$xjDetailUser){
			echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
			$msg = '您提交的订单不存在！页面在5s钟后跳转！';
			$data['msg'] = $msg;
			$this->load->view('404',$data);
			return false;
		}
		$yxList = $this->yxListModel->getYxByComId_Xjid($member['company_id'],$xj_id);
		//print_r($yxList);
		if(!$yxList){
			echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
			$msg = '您提交的订单不存在！页面在5s钟后跳转！';
			$data['msg'] = $msg;
			$this->load->view('404',$data);
			return false;
		}else{
			if($yxList[0]['state_id'] ==7){//改变状态
				
				$yxList[0]['sub_time'] = date('Y-m-d H:i:s');
				$yxList[0]['state_id'] = 8;
				$yxList[0]['company'] = $company[0]['company'];
				$param = $yxList[0];
				/*
				$param['yx_id'] = $yxList[0]['yx_id'];
				$param['sub_time'] = date('Y-m-d H:i:s');
				$param['state_id'] = 8;
				$param['company'] = $company[0]['company'];
				*/
				
				$this->yxListModel->update($param);
				//print_r($param);
				redirect(base_url()."index.php/answer?xjid=".$xj_id);
			}else{
				echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/answeradm\">');</script> ";
				$msg = '您提交的订单不存在！页面在5s钟后跳转！';
				$data['msg'] = $msg;
				$this->load->view('404',$data);
				return false;
			}
		}
		redirect(base_url()."index.php/answer?xjid=".$xj_id);
		
		
	}
	
}

?>
