<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	
	 function __construct()
	{
       parent::__construct();
	   $this->load->model('memberModel');
	   $this->load->database();
	   $this->load->library('encrypt');
	   $this->load->library("auth");
	}
	public function index()
	{
		
		$data = array();
		$username = trim($this->input->post("username",true));
		$passwd = trim($this->input->post("passwd",true));
		$remember = trim($this->input->post("remember",true));
		$url  = trim(($this->input->get("url",true)));
		if($url && preg_match("#([a-z0-9]{1,9}\,*)*#",$url)){
			$urlArr = explode(",",$url);
			if($urlArr && $urlArr[0]=="provide"){
				$param = "provide?";
				if(isset($urlArr[1]) && $urlArr[1]){
					$param .="catid=".$urlArr[1]."&";
				}
				if(isset($urlArr[2]) && $urlArr[2]){
					$param .="areaid=".$urlArr[2]."&";
				}
				if(isset($urlArr[3]) && $urlArr[3]){
					$param .="kw=".$urlArr[3]."&";
				}
				
			}
		}
		$url = isset($param) ?$param:"index.php";
		
		//$returnUrl = $_SERVER['REQUEST_URI']
		$checkcode = strtolower(trim($this->input->post("checkcode",true)));
		//$this->session->set_userdata('username',$username);
		$checkcodeSession = $this->session->userdata('regCheckCode');
		if($checkcode ==$checkcodeSession ){//先check 验证码
			if($this->checkName($username)){
				$memberInfo = $this->memberModel->validateUser($username);
				if(count($memberInfo) !=0 && $memberInfo['password'] == md5(md5($passwd))){
					$this->auth->process_login($memberInfo,$remember);
					//header('Location:'.$url);
					//redirect($url);
					//redirect($url!="" ? $url:"index",'refresh');
					//echo "<script type='text/javascript'>location.href='".$url."'</script>";
					
					//header('Refresh:0;url='.$url);
					//header("Location: ".$returnUrl, TRUE);
					//echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"0;'+'url=".$url."\">');</script> ";
					redirect($url);
				}else{
					$data['message'] = "error";
				}
			}
		}else if($checkcode  && $checkcode!= $checkcodeSession){
			$data['message']= "checkCodeError";
		}
		
		//$this->auth->process_login($memberInfo,$remember);
		//echo $this->session->userdata('username');
		//$this->session->userdata($username);
		//echo $this->encrypt->encode("userid");
		//echo "<br>".$this->encrypt->decode("Jhyb0rPpOAJUm7Gom/n2LaxsdIsffqVXKAu7eDrjDMQ8Tkvy5oTzSV8cDOPpDGpmsuZCjq1OARN5qB1EA2zHow==");
		$this->load->view("login",$data);
	}
	function checkName($userName){
		if(preg_match("#^(\w{5,18})$|^(\w{6,18}\@[a-zA-Z0-9]{2,8}(\.[a-zA-Z]{1,6}){1,3})$#",$userName) && $userName!=""){
			return true;
		}
		return false;
	}
	function logout(){
		$this->auth->logout();
		redirect(base_url());
		return false;
	}

}
