<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orderadm extends CI_Controller {

	
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
	   $this->load->model('XjStateModel');
	}
	public function index()//询价页面只有采购商,设计师 才能访问
	{
		if($this->auth->hasLogin()){
			
			$data =array();
			$stateCount = array();
			$userid = $this->session->userdata('userid');
			$member = $this->memberModel->getByPk($userid);
			$username  = $member['username'];
			if($member['groupid'] != 5 && $member['groupid'] !=8 && $member['groupid'] !=1){ //1 admin 测试用
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/\">');</script> ";
					$msg = '您无权访问此页面！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
			}
			$data['userid'] = $userid;
			$data['username'] = $username;
			$stateCount = $this->XjStateModel->getAllXjState();
		
			$orderList = $this->xjListModel->getByUserid($userid);//获取该用户的所有询价单
			if($orderList){
				foreach($orderList as $key2=>$val){
					foreach($stateCount as $key => $stateVal){
						if($stateVal['state_id'] == $val['state_id']){

							if(isset($stateCount[$key]['count'])){
								$stateCount[$key]['count'] ++;
							}else{
								$stateCount[$key]['count'] =1;
							}
							if($val['state_id']==2 || $val['state_id']==3 ){
								$orderList[$key2]['text'] = "应询中";
							}else{
								$orderList[$key2]['text'] = $stateCount[$key]['text'];
							}
						}
					}
					$detail = $this->XjDetailModel->getByXjId($val['xj_id']);
					$orderList[$key2]['detailCount'] = count($detail);
				}
				
			}
			
			$data['orderList'] = $orderList;
			$data['stateCount'] = $stateCount;
			
			
			$this->load->view("orderadm",$data);
		}else{
			redirect(base_url()."index.php/login");
		}
		
	}
	/*
	function submitUn(){
		if($this->auth->hasLogin()){
			$userid = $this->session->userdata('userid');
			$member = $this->memberModel->getByPk($userid);
			$username  = $member['username'];
			if($member['groupid'] != 5 && $member['groupid'] !=8 && $member['groupid'] !=1){
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/\">');</script> ";
					$msg = '您无权访问此页面！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
			}
			$xjList = $this->xjListModel->getUnSubmit($userid);
			if($xjList){
				$this->xjListModel->updateState($userid);
			}
		}
	}
	*/
}

?>
