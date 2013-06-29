<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cat_detail extends CI_Controller {

	
	 function __construct()
	{
       parent::__construct();
	   $this->load->model('sellDataModel');
	   $this->load->model('companyModel');
	   $this->load->model('sellModel');
	   $this->load->model('categoryModel');
	   $this->load->model('sellReplyModel');
	   $this->load->library("auth");
	}
	
	public function index()
	{	
		$itemid=$this->input->get("itemid",true);
		$result=$this->init($itemid);
		$this->load->view("cat_detail",$result);
	}
	
	/**
	 * 初始化界面数据
	 */
	function init($itemid){
		$result=array();
		$sell=$this->sellModel->getByPk($itemid);
		$company=$this->companyModel->getByCompanyName($sell[0]['company']);
		$sellData=$this->sellDataModel->getByItemid($sell[0]['itemid']);
		$category=$this->categoryModel->getByPk($sell[0]['catid']);
		$sellReply=$this->sellReplyModel->getByItemid($itemid);
		
		$catMenu=array();
		$catid=$category['parentid'];
		$menuIndex=0;
		$catMenu[$menuIndex]=$category['catname'];
		$menuIndex++;
		while(true){
			if($catid!=0){
				$catObj=$this->categoryModel->getByPk($catid);
				$catMenu[$menuIndex]=$catObj['catname'];
				$catid=$catObj['parentid'];
				$menuIndex++;
			}else{
				break;
			}
		}
		$result['sell']=$sell[0];
		$result['company']=!empty($company[0])? $company[0]:null;
		
		$result['sellData']=!empty($sellData[0]) ? $sellData[0] :'';
		//$result['sellData']=$sellData[0];
		$result['category']=$category;
		$result['sellReply']=$sellReply;
		$result['catMenu']=$catMenu;
		return $result;
	}
	
	function commitMsg(){
		//登录验证
		
		
		//获取参数
		$msgText = $this->input->get("msgText",true);	//评论内容
		$itemId= $this->input->get("itemid",true);	//评论内容
		$user="jason";	//评论人
		$userId="1001";	//用户ID
		$time=date('Y-m-d H:i:s',time());	//服务器当前时间
		
		
		//数据落地处理
		$data = array(
				'itemid' => $itemId ,
				'content' => $msgText ,
				'date' => $time ,
				'user_id' => $userId ,
				'user_name' => $user
		);
		
		$this->sellReplyModel->insert($data);
		
		//生成界面代码
		$value="<div class='liuyan'><ul>";
		$value.="<li><span>评论内容：</span>".$msgText."</li>";
		$value.="<li>评论时间：[".$time."]&nbsp;&nbsp;&nbsp;&nbsp;会员：<a href='#'>".$user."</a>";
		$value.="</ul></div>";
		echo $value;
	}
	
}
?>
