<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller {


	
	 function __construct()
	{
       parent::__construct();
	  // $this->load->model('area');
	 
	}
	/**/
	public function index()
	{
		$this->load->model('area');
		 $data =$this->area->getByParentid(0);
		 //$this->load->view('index');
		 //print_r($data); 
	}
	
	public function test(){
		print_r("dddddddddddddddddd");
		
	}


	public function ajax(){
		$option = "";
	
		$areaid = $this->input->get("areaid",true);
		if($areaid){
			$area =  $this->area->getOneById($areaid);
			$arrAreaid = explode(",",$area['arrparentid']);
			if($arrAreaid !=null){
				$select = "";
				foreach($arrAreaid as $key=>$parentid){
					$arrArea = $this->area->getByParentid($parentid);
					print_r($arrArea);
					$select .="<select onchange='load_area(this.value)'>";
					$option = "";
					foreach($arrArea as $val){
						$option .= "<option value={$val['areaid']}>".$val['areaname']."</option>";
					}
					$select .=$option."</select>";
				}
			}
			echo $select;
			/*
			if($area){
				$select ="<select onchange='load_area(this.value)'>";
				foreach($area as $val){
					$option .= "<option value={$val['areaid']}_{$val['child']}>".$val['areaname']."</option>";
				}
				echo $select .= $option."</select>";
			}
			*/
		}
	}
	
	
	

}
