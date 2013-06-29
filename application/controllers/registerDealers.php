<?php
/**
 * 经销商
 * @author admin
 *
 */
class registerDealers extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('encrypt');
		$this->load->library("auth");
		$this->load->model("registerbuyersModel");
		$this->load->model('categoryModel');
	}


	public function index(){
		$username = trim($this->input->post("dusernames",true));//用户名
		$userPass = trim($this->input->post("duserpasses",true));//密码
		$userEmail = trim($this->input->post("demailVali",true));//email
		$userContact = trim($this->input->post("lianxiren",true));//联系人
		$gender = trim($this->input->post("dGender",true));//性别
		$userMobilephone = trim($this->input->post("dmobiePhone",true));//移动电话
		$comany = trim($this->input->post("companyname",true));//公司名称
		$huoqu = trim($this->input->post("huoquzhi",true));
		$department = trim($this->input->post("ddepartment",true));//部门
		$career = trim($this->input->post("dcareer",true));//职位
		$md5userpass = md5(md5($userPass));
		$catidArray="";//得到的分类id字符串
		$areaids="";//地区id
		$areaidArray="";//得到的地区id的字符串
		$citys="";
		$comanyid=0;
		//查询角色id
		$arrayId = $this->registerbuyersModel->showRegRoleId("经销商");
		foreach ($arrayId as $row){
			$roseid = $arrayId["groupid"];
		}
		if($huoqu==0){
			$area = trim($this->input->post("dareaname",true));//注册城市
			$address = trim($this->input->post("daddress",true));//公司地址
			$cfanwei = trim($this->input->post("dfanweis",true));//经营范围
			$companytype = trim($this->input->post("dcompanytype",true));//公司类型
			$companymoney = trim($this->input->post("dmoney",true));//注册资本
			$cmoneyType = trim($this->input->post("dcmoneyType",true));//货币单位
			$companyemail= trim($this->input->post("dcompanyemail",true));//公司邮件
			$companyphone = trim($this->input->post("dcompanyPhone",true));//公司电话
			$faren = trim($this->input->post("dfaren",true));//法人代表
			$guimo = trim($this->input->post("dguimo",true));//规模
			$years = trim($this->input->post("dyear",true));//成立年份
			$internet = trim($this->input->post("dinternet",true));//公司网站
			$chuanzhen = trim($this->input->post("dchuanzhen",true));//公司传真
			$zhizhao = trim($this->input->post("dzhizhao",true));//营业执照
			$introduce = trim($this->input->post("dIntroduce",true));//简介
			$postcode = trim($this->input->post("dpostcode",true));//邮编 
			//查询公司id
			$companyArray = $this->registerbuyersModel->showUserId("userid","tdj_company");
			foreach ($companyArray as $row){
				$comanyid = $companyArray["userid"];
			}
			$catidArray="";//得到的分类id字符串
			$resultfanwei = explode("|",$cfanwei);
			foreach( $resultfanwei as $k => $v )
			{
				$catidsArrays = $this->registerbuyersModel->showcatid($v);
				foreach($catidsArrays as $row){
					if($catidArray==""){
						$catidArray=$catidsArrays["catid"];
					}else{
						$catidArray=$catidArray.",".$catidsArrays["catid"];
					}
				}
			}
			$areaidArray="";//得到的地区id的字符串
			$resultarea = explode("|",$area);
			foreach( $resultarea as $k => $v )
			{
				$areaidsArrays = $this->registerbuyersModel->showareaid($v);
				foreach($areaidsArrays as $row){
					if($areaidArray==""){
						$areaidArray=$areaidsArrays["areaid"];
					}else{
						$areaidArray=$areaidArray.",".$areaidsArrays["areaid"];
					}
				}
			}
			$citys="";
			$resultcity = explode("|",$area);
			foreach( $resultcity as $k => $v )
			{
				if($citys==null)
					$citys=$v;
				else
					$citys=$citys.','.$v;
			}
			$areaids="";//地区id
			$resultareas = explode(",",$areaidArray);
			foreach( $resultareas as $k => $v )
			{
				$areaids=$v;
			}
			//公司参数
			$comanydata=array(
					'userid'=>$comanyid,
					'username'=>$comanyid,
					'groupid'=>$roseid,
					'company'=>$comany,
					'type'=>$companytype,
					'catid'=>$catidArray,
					'areaid'=>$areaids,
					'capital'=>$companymoney,
					'regunit'=>$cmoneyType,
					'size'=>$guimo,
					'regyear'=>$years,
					'regcity'=>$citys,
					'sell'=>$cfanwei,
					'telephone'=>$companyphone,
					'fax'=>$chuanzhen,   //传真
					'mail'=>$companyemail,
					'address'=>$address,
					'postcode'=>$postcode,
					'homepage'=>$internet,
					'introduce'=>$introduce,
					'keyword'=>$comany,
					'legal_person'=>$faren
			
			);
			//添加公司信息
			$companyFalg = $this->registerbuyersModel->insertCompany($comanydata,"tdj_company");
		}else{
			//查询公司id
			$companyArray = $this->registerbuyersModel->validatecompanynames($comany);
			foreach ($companyArray as $row){
				$comanyid = $companyArray["userid"];
				$areaids = $companyArray["areaid"];
			}
		}
		//查询用户id
		$useridArray = $this->registerbuyersModel->showUserId("userid","tdj_member");
		foreach ($useridArray as $row){
			$usernamesid = $useridArray["userid"];
		}
		
		//获取注册的ip
		if(!empty($_SERVER["HTTP_CLIENT_IP"])){
			$cip = $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		elseif(!empty($_SERVER["REMOTE_ADDR"])){
			$cip = $_SERVER["REMOTE_ADDR"];
		}
		else{
			$cip = "无法获取！";
		}

		//会员参数
		$memberdata = array(
				'userid'=>$usernamesid+1,
				'username'=>$username,
				'passport'=>$usernamesid+1,
				'company'=>	$comany,
				'password'=>$md5userpass,
				'email'=>$userEmail,
				'gender'=>$gender,
				'truename'=>$userContact,
				'mobile'=>$userMobilephone,
				'department'=>$department,
				'career'=>$career,
				'groupid'=>$roseid,
				'areaid'=>$areaids,
				'regid'=>$roseid,
				'regip'=>$cip,
				'regtime'=>date('Ymd'),
				'company_id'=>$comanyid
		);
		
		//添加会员信息
		$memberFalg = $this->registerbuyersModel->insertCompany($memberdata,"tdj_member");
		if($memberFalg>0 )
		{
			echo "<script type='text/javascript'>alert('经销商注册成功！')</script>";
			$this->load->view("login");
		}
		else
		{
			echo "<script type='text/javascript'>alert('经销商注册失败，请检查你输入的注册信息！')</script>";
			$this->load->view("register");
		}
			
	}

}

?>