<?php
/**
 * 设计师
 * @author admin
 *
 */
class registerDesigner extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('encrypt');
		$this->load->library("auth");
		$this->load->model("registerbuyersModel");
	}


	public function index(){
		$username = trim($this->input->post("susernames",true));//用户名
		$userPass = trim($this->input->post("suserpasss",true));//密码
		$userEmail = trim($this->input->post("sdemails",true));//email
		$userContact = trim($this->input->post("sdlianxiren",true));//联系人
		$gender = trim($this->input->post("sGender",true));//性别
		$userMobilephone = trim($this->input->post("sdmobielphone",true));//移动电话
		$comany = trim($this->input->post("sdcompany",true));//公司名称
		$huoqu = trim($this->input->post("shuoquzhi",true));
		$department = trim($this->input->post("sdepartment",true));//部门
		$career = trim($this->input->post("scareer",true));//职位
		$md5userpass = md5(md5($userPass));
		$catidArray="";//得到的分类id字符串
		$areaids="";//地区id
		$areaidArray="";//得到的地区id的字符串
		$citys="";
		$comanyid=0;
		//查询角色id
		$arrayId = $this->registerbuyersModel->showRegRoleId("设计师");
		foreach ($arrayId as $row){
			$roseid = $arrayId["groupid"];
		}
		if($huoqu==0){
			$area = trim($this->input->post("sareaname",true));//注册城市
			$address = trim($this->input->post("sdaddress",true));//公司地址
			$cfanwei = trim($this->input->post("sfanweis",true));//经营范围
			$companytype = trim($this->input->post("scompanytype",true));//公司类型
			$companymoney = trim($this->input->post("smoney",true));//注册资本
			$cmoneyType = trim($this->input->post("smoneyType",true));//货币单位
			$companyemail= trim($this->input->post("scompanyemail",true));//公司邮件
			$companyphone = trim($this->input->post("scompanyPhone",true));//公司电话
			$faren = trim($this->input->post("sdfaren",true));//法人代表
			$guimo = trim($this->input->post("sguimo",true));//规模
			$years = trim($this->input->post("sdyears",true));//成立年份
			$internet = trim($this->input->post("sdinternet",true));//公司网站
			$chuanzhen = trim($this->input->post("sdchuanzhen",true));//公司传真
			$zhizhao = trim($this->input->post("sdzhizhao",true));//营业执照
			$introduce = trim($this->input->post("sdIntroduce",true));//简介
			$postcode = trim($this->input->post("spostcode",true));//邮编 
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
			$resultcity = explode("|",$area);
			foreach( $resultcity as $k => $v )
			{
				if($citys==null)
					$citys=$v;
				else
					$citys=$citys.','.$v;
			}
			$resultareas = explode(",",$areaidArray);
			foreach( $resultareas as $k => $v )
			{
				$areaids=$v;
			}
			//公司参数
			$comanydata=array(
					'userid'=>$comanyid+1,
					'username'=>$comanyid+1,
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
					'keyword'=>$comany
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
		//查询用户id
		$useridArray = $this->registerbuyersModel->showUserId("userid","tdj_member");
		foreach ($useridArray as $row){
			$usernamesid = $useridArray["userid"];
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
				'company_id'=>$comanyid+1
		);

		
		//添加会员信息
		$memberFalg = $this->registerbuyersModel->insertCompany($memberdata,"tdj_member");
		if($memberFalg>0 )
		{
			echo "<script type='text/javascript'>alert('采购商注册成功！')</script>";
			$this->load->view("login");
		}
		else
		{
			echo "<script type='text/javascript'>alert('采购商注册失败，请检查你输入的注册信息！')</script>";
			$this->load->view("register");
		}
			
	}

}

?>