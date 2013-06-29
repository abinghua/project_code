<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * 控制会员的登录和退出
 *
 */
 class Auth{
	public $_member = array();

	/*简单权限组
	*1 管理员
	*2 禁止访问
	*3 游客
	*4 待审核会员
	*5 采购商会员
	*6 经销商会员
	*7 生产厂家会员
	*8 设计师会员
	*
	*/
	public $groups = array(
	    'admin' => 0,
	    'editor'		=> 1,
	    'contributor'	=> 2
	    );
	private $_CI;


	 /**
     * 构造函数
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        /** 获取CI句柄 */
		$this->_CI = & get_instance();
		$this->_CI->load->model('memberModel');
		$this->_CI->load->library('encrypt');
    }
	function hasLogin(){
		if($this->_CI->session->userdata('userid')){
			return true;
		}else if(isset($_COOKIE["TDJAUTO"])){
			$auto = $this->_CI->encrypt->decode($_COOKIE['TDJAUTO']);
			$useridArray = explode("###",$auto);
			$userid = $useridArray[0];
			$this->_member = $this->_CI->memberModel->getByPk($userid);
			if(count($this->_member) != 0){
				$autoCode = $this->_member['userid']."###".$this->_member['password'].$this->_CI->input->ip_address().$this->_CI->input->user_agent();
				if($autoCode == $auto){
					$this->_CI->session->set_userdata('userid',$userid);
					return true;
				}
				return false;
			}
			return false;
		}
		return false;
	}
	function exceed($group, $return = false){}
	
	public function logout(){
		setcookie("TDJAUTO", '', time()-3600, "/", "", false, true);
		$this->_CI->session->unset_userdata('userid');
	}
	
	public function get_level($data){}
	
	public function process_login($member, $remember=false){		$this->_member = $member;
		$this->_CI->session->set_userdata('userid',$this->_member['userid']);
		if($remember){
			$autoCode = $this->_member['userid']."###".$this->_member['password'].$this->_CI->input->ip_address().$this->_CI->input->user_agent();
			$auto = $this->_CI->encrypt->encode($autoCode);
			//$encodeAccount = $this->_CI->encrypt->encode($this->_member['userid']);
			setcookie("TDJAUTO", $auto, time()+3600, "/", "", false, true);
			//setcookie("TDJACCOUNT",$encodeAccount, time()+3600, "/", "", false, true);
		}else{
			setcookie("TDJAUTO", '', 0, "/", "", false, true);
			//setcookie("TDJACCOUNT",'',0,"/","",false,false);
		}
		$this->_member['logintimes']++;
		$data = array(
			"userid" => $this->_member['userid'],
			"loginip" => $this->_CI->input->ip_address(),
			'logintime' => time(),
			'logintimes' =>$this->_member['logintimes']
		);
		$this->_CI->memberModel->updateOne($data);	}
 }



?>