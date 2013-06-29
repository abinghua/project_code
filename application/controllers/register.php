<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class register extends CI_Controller {

	
	 function __construct()
	{
       parent::__construct();
	   $this->load->model('memberModel');
	   $this->load->database();
	   $this->load->library('encrypt');
	   $this->load->library("auth");
	    $this->load->model('areaModel');
	   $this->load->model('categoryModel');
	   
	}
	public function index()
	{
		
		 $data = array();
		$data['area'] = $this->areaModel->getByParentid(0);
		$data['category'] = $this->categoryModel->getByParentid(0);
		$username = trim($this->input->post("username",true));
		$passwd = trim($this->input->post("passwd",true));
		$remember = trim($this->input->post("remember",true));
		$url  = trim(($this->input->get("url",true)));
		//$this->session->set_userdata('username',$username);
		if($this->checkName($username)){
			$memberInfo = $this->memberModel->validateUser($username);
			if(count($memberInfo) !=0 && $memberInfo['password'] == md5(md5($passwd))){
				$this->auth->process_login($memberInfo,$remember);
				
				redirect($url!="" ? $url:"index",'refresh');
			}else{
				$data['message'] = "error";
			}
		} 
		//$this->auth->process_login($memberInfo,$remember);
		//echo $this->session->userdata('username');
		//$this->session->userdata($username);
		//echo $this->encrypt->encode("userid");
		//echo "<br>".$this->encrypt->decode("Jhyb0rPpOAJUm7Gom/n2LaxsdIsffqVXKAu7eDrjDMQ8Tkvy5oTzSV8cDOPpDGpmsuZCjq1OARN5qB1EA2zHow==");
	
		//$checkcode = new checkcode();
		
		$this->load->view("register",$data);
	}
	function checkName($userName){
		if(preg_match("#^(\w{5,18})$|^(\w{6,18}\@[a-zA-Z0-9]{2,8}(\.[a-zA-Z]{1,6}){1,3})$#",$userName) && $userName!=""){
			return true;
		}
		return false;
	}
	function checkCode(){
		$this->load->library("checkcode"); 
		$this->checkcode->doimage();
		$this->session->set_userdata('regCheckCode',$this->checkcode->get_code());
	}
	
}

?>
