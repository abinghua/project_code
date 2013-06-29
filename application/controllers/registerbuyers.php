<?php
/**
 * 采购商
 * @author admin
 *
 */
class registerbuyers extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('encrypt');
		$this->load->library("auth");
		$this->load->model("registerbuyersModel");
		$this->load->model('categoryModel');
	}


	public function index(){
		$username = trim($this->input->post("infouserName",true));//用户名
		$userPass = trim($this->input->post("cpassword1",true));//密码
		$userEmail = trim($this->input->post("cemail",true));//email
		$userContact = trim($this->input->post("clianxiren",true));//联系人
		$gender = trim($this->input->post("cgender",true));//性别
		$userMobilephone = trim($this->input->post("cmobilephone",true));//移动电话
		$comany = trim($this->input->post("ccompany",true));//公司名称
		$huoqu = trim($this->input->post("huoquzhi",true));
		$department = trim($this->input->post("cdepartment",true));//部门
		$career = trim($this->input->post("ccareer",true));//职位
		$md5userpass = md5(md5($userPass));
		$catidArray="";//得到的分类id字符串
		$areaids="";//地区id
		$areaidArray="";//得到的地区id的字符串
		$citys="";
		$comanyid=0;
		//查询角色id
		$arrayId = $this->registerbuyersModel->showRegRoleId("采购商");
		foreach ($arrayId as $row){
			$roseid = $arrayId["groupid"];
		}
		if($huoqu==0){
			$area = trim($this->input->post("areaname",true));//注册城市
			$address = trim($this->input->post("caddress",true));//公司地址
			$cfanwei = trim($this->input->post("cfanweis",true));//经营范围
			$companytype = trim($this->input->post("ccompanytype",true));//公司类型
			$companymoney = trim($this->input->post("cmoney",true));//注册资本
			$cmoneyType = trim($this->input->post("cmoneyType",true));//货币单位
			$companyemail= trim($this->input->post("ccompanyemail",true));//公司邮件
			$companyphone = trim($this->input->post("ccompanyPhone",true));//公司电话
			$faren = trim($this->input->post("caigoufaxs",true));//法人代表
			$guimo = trim($this->input->post("cguimo",true));//规模
			$years = trim($this->input->post("cyears",true));//成立年份
			$internet = trim($this->input->post("cinternet",true));//公司网站
			$chuanzhen = trim($this->input->post("cchuanzhen",true));//公司传真
			$zhizhao = trim($this->input->post("czhizhao",true));//营业执照
			$introduce = trim($this->input->post("cIntroduce",true));//简介
			$postcode = trim($this->input->post("cpostcode",true));//邮编
			//查询公司id
			$companyArray = $this->registerbuyersModel->showUserId("userid","tdj_company");
			foreach ($companyArray as $row){
				$comanyid = $companyArray["userid"];
			}
			$comanyid= $comanyid+1;
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
			$resultareas = explode(",",$areaidArray);
			foreach( $resultareas as $k => $v )
			{
				$areaids=$v;
			}
			$resultcity = explode("|",$area);
			foreach( $resultcity as $k => $v )
			{
				if($citys==null)
					$citys=$v;
				else
					$citys=$citys.','.$v;
			}
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
					'keyword'=>$comany
			);
		//添加公司信息
// 		$companyFalg = $this->registerbuyersModel->insertCompany($comanydata,"tdj_company");
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
// 		$memberFalg = $this->registerbuyersModel->insertCompany($memberdata,"tdj_member");
// 		if($memberFalg>0  )
// 		{
// 			echo "<script type='text/javascript'>alert('采购商注册成功！')</script>";
// 			$this->load->view("login");
// 		}
// 		else
// 		{
// 			echo "<script type='text/javascript'>alert('采购商注册失败，请检查你输入的注册信息！')</script>";
// 			$this->load->view("register");
// 		}
		
		
	}
	public function userid(){
		//查询用户id
		$useridArray = $this->registerbuyersModel->showUserId("userid","tdj_member");
		foreach ($useridArray as $row){
			$usernamesid = $useridArray["userid"];
		}
		echo $usernamesid+1;
	}
	
	//验证输入的用户名，数据库是否存在
	public function validateUsername(){
		$username = $this->input->get("usernames");
		$usernameValidate = $this->registerbuyersModel->validatenames($username);
		if($usernameValidate==null){
			echo "用户名可以注册";
		}else{
			foreach($usernameValidate as $row){
				$usernameswho=  $usernameValidate["username"];
			}
			if($usernameswho==$username){
				echo "<font color='red'>用户名已经存在，请重新填写用户名</font>";
			}
		}
	}
	//验证输入公司名称是否存在
	public function validateCompnayname(){
		$username = $this->input->get("companynames");
		$usernameValidate = $this->registerbuyersModel->validatecompanynames($username);
		if($usernameValidate==null){
			echo null;
		}else{
			foreach($usernameValidate as $row){
				$companyname=  $usernameValidate["company"];
			}
			if($companyname==$username){
				echo $companyname;
			}
		}
	}
	//加载公司信息
	public function validateCompnaynamejiazai(){
		$username = $this->input->get("companynames");
		$usernameValidate = $this->registerbuyersModel->validatecompanynames($username);
		$yangshi="";
		$tou="<font style='color:black'><h4>".$username."公司的信息如：(一下信息均不可修改)</h4><br/>&nbsp;";
		$showcompany="";
		if($usernameValidate==null){
			echo "公司名可以注册";
		}else{
			foreach($usernameValidate as $row){
				$companyname=  $usernameValidate["company"];
			}
			$showcompany=$tou."<font style='color:black'>注册城市：&nbsp;&nbsp;</font><input type=text readonly='readonly' style='width:250px;height:30px' value='".$usernameValidate['regcity']."' /><br/><br/>
			&nbsp;<font style='color:black'>公司地址：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:250px;height:30px' value='".$usernameValidate['address']."' /><br/><br/>
			&nbsp;<font style='color:black'>经营范围：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['sell']."' /><br/><br/>
			&nbsp;<font style='color:black'>公司类型：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['type']."' /><br/><br/>
			&nbsp;<font style='color:black'>注册资本：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['capital'].$usernameValidate['regunit']."' /><br/><br/>
			&nbsp;<font style='color:black'>公司邮件：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['mail']."' /><br/><br/>
			&nbsp;<font style='color:black'>公司电话：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['telephone']."' /><br/><br/>
			&nbsp;<font style='color:black'>法人代表：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['legal_person']."' /><br/><br/>
			&nbsp;<font style='color:black'>公司邮编：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['postcode']."' /><br/><br/>
			&nbsp;<font style='color:black'>公司规模：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['size']."' /><br/><br/>
			&nbsp;<font style='color:black'>成立年份：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['regyear']."' /><br/><br/>
			&nbsp;<font style='color:black'>公司网站：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['homepage']."' /><br/><br/>
			&nbsp;<font style='color:black'>公司传真：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['fax']."' /><br/><br/>
			&nbsp;<font style='color:black'>营业执照：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['license_url']."' /><br/><br/>
			&nbsp;<font style='color:black'>公司简介：&nbsp;&nbsp;</font><input type=text readonly='readonly'  style='width:550px;height:30px' value='".$usernameValidate['introduce']."' /><br/><br/>";
		}
		echo $showcompany;
	}
	
	//查询材料分类
	public function showCatName(){
		$catnamei = $this->input->get("catnameidss");
		$fanweis="";
		$catids="";
		//查询分类
		$parentname = $this->registerbuyersModel->showParentcatname($catnamei);
		if($parentname!=null){
			foreach($parentname as $row){
				$parentnames=  $parentname["catname"];
				$parentcatid=  $parentname["catid"];
			}
			$fanweis=$parentnames;
			$catids=$parentcatid;
		}
		$childname =  $this->registerbuyersModel->showchildcatname($catnamei);
		if($childname!=null){
			foreach($childname as $row){
				$childnames= $childname["catname"];
				$childid= $childname["catid"];
			}
			if($fanweis!="")
				$fanweis=$fanweis.'|'.$childnames;
			else
				$fanweis=$childnames;
			if($catids !="")
				$catids = $catids.','.$childid;
			else
				$catids=$childid;
		}
		$catname =  $this->registerbuyersModel->showcatname($catnamei);
		if($catname!= null){
			foreach($catname as $row){
				$catnames= $catname["catname"];
				$catid= $catname["catid"];
			}
			if($fanweis!="")
				$fanweis=$fanweis.'|'.$catnames;
			else
				$fanweis=$catnames;
			if($catids !="")
				$catids = $catids.','.$catid;
			else
				$catids=$catid;
		}
		echo $fanweis;
	}
	
	//查询地区
	public function showareaname(){
		$areanamei = $this->input->get("areaides");
		$fanweis="";
		//查询分类
		$parentareaname = $this->registerbuyersModel->showParentareaname($areanamei);
		if($parentareaname!=null){
			foreach($parentareaname as $row){
				$parentareanames=  $parentareaname["areaname"];
			}
			$fanweis=$parentareanames;
		}
		$childareaname =  $this->registerbuyersModel->showchildareaname($areanamei);
		
		if($childareaname!=null){
			foreach($childareaname as $row){
				$childareanames= $childareaname["areaname"];
			}
			if($fanweis!="")
				$fanweis=$fanweis."|".$childareanames;
			else
				$fanweis=$childareanames;
		
		}
		$catnareaame =  $this->registerbuyersModel->showcatareaname($areanamei);
		if($catnareaame!= null){
			foreach($catnareaame as $row){
				$catareanames= $catnareaame["areaname"];
			}
			if($fanweis!="")
				$fanweis=$fanweis."|".$catareanames;
			else
				$fanweis=$catareanames;
		}
		echo $fanweis;
	}
	
	public function mobielphoneValidate(){
		$companyphone = $this->input->get("companyphoneid");
		$companyphoneArray = $this->registerbuyersModel->showmobilephone($companyphone);
		if($companyphoneArray==null){
			echo null;
		}else{
			foreach($companyphoneArray as $row){
				$phone=  $companyphoneArray["company"];
			}
			if($phone==$companyphone){
				echo $phone;
			}
		}
	}
	
}

?>