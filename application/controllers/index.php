<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends CI_Controller {

	
	 function __construct()
	{
       parent::__construct();
	   $this->load->model('areaModel');
	   $this->load->model('categoryModel');
	   $this->load->model('memberModel');
	   $this->load->database();
	   $this->load->library('encrypt');
	   $this->load->library("auth");
	   $this->load->model('xjListModel');
	   $this->load->model('XjDetailModel');
	   $this->load->model('xjImageModel');
	   $this->load->model('xjStateModel');
	   $this->load->model('CompanyModel');
	   $this->load->model('yxListModel');
	   $this->load->model('yxDetailModel');
	}
	public function index()
	{
		$data =array();
		$data['area'] = $this->areaModel->getByParentid(0);
		$data['category'] = $this->categoryModel->getByParentid(0);
		$userid = $this->session->userdata('userid');
		$member = $this->memberModel->getByPk($userid);
		$one=array();
		$oneIndex=0;
		$twoIndex=0;
		$inquery_list = array();
		for($i=0; $i<count($data['category']); $i++){
			$obj=$data['category'][$i];
			$catid=$obj['catid'];
			$list=$this->categoryModel->getByParentid($catid);//二级分类列表
			for($j=0; $j<count($list); $j++){
				$dto = $list[$j];
				$one[$oneIndex]=$dto;
				$catid2=$dto['catid'];
				$list2 = $this->categoryModel->getByParentid($catid2);
				for($h=0; $h<count($list2);$h++){
					 $dto2 = $list2[$h];
					 $one[$oneIndex][$twoIndex]=$dto2;
					 $twoIndex++;
				}
				$twoIndex=0;
				$oneIndex++;
			}
		}
		$inquery_list = $this->xjListModel->getIng_Over();
		//print_r($inquery_list);
		$data['one'] = $one;
		$data['inquery_list'] = $inquery_list;
		//$data['member'] = $member;
		
		//echo $this->encrypt->encode("userid");
		//echo "<br>".$this->encrypt->decode("Jhyb0rPpOAJUm7Gom/n2LaxsdIsffqVXKAu7eDrjDMQ8Tkvy5oTzSV8cDOPpDGpmsuZCjq1OARN5qB1EA2zHow==");
		$this->load->view("index",$data);
	}
	
	function ajax(){
			
			$option = "";
			$areaid = $this->input->get("areaid",true);
			$type = $this->input->get("type",true);
			if(!preg_match('#^(\-?[0-9]{1,6})$#',$areaid)){
				return false;
			}
			
			if($areaid<=0){
				$area = $this->areaModel->getByParentid(0);
				
				$option= "<option value='-1'>全部地区</option>";
				foreach($area as $val){
					
					$option .= "<option value='{$val['areaid']}'>".$val['areaname']."</option>";
				}
				echo "<select onchange='load_area(this.value)'>".$option."</select>";
				return false;
			}
			
			$area = $this->areaModel->getByPk($areaid);
			//print_R($area);
			$arrParentid  = explode(",",$area['arrparentid']);
			$select ="";
			$i=1;
			if($area['child'] ==1){
				$arrParentid[count($arrParentid)] = $areaid;
				foreach($arrParentid as $val){
					$arr = $this->areaModel->getByParentid($val);
					foreach($arr as $var){
						if($i <count($arrParentid)){
							if($arrParentid[$i] ==$var['areaid']){
								$selected ="selected=selected";
							}else{
								$selected = "";
							}
						}
						$option .= "<option value={$var['areaid']} $selected>".$var['areaname']."</option>";
					}
					if($i!=1){
						$style = "style='margin-left:6px;'";
					}else{$style ="";}
					/*
					print_r($arrParentid);
					echo "<br>";
					echo $value;
					echo "<br>";
					*/
					$value = isset($arrParentid[$i-1]) ? $arrParentid[$i-1] : '';
					
					if($type == "addArea"){//for inquery
						$select .= "<select $style onchange='add_area(this.value,this.options[this.selectedIndex].text)'><option value=".$value.">全部地区</option>".$option."</select>";
					}else if($type == "order"){//for order
						$select .= "<select $style onchange='load_area(this.value)'><option value=".$value.">全部地区</option>".$option."</select>";
					}else if($type == "area1"){
						$select .= "<select $style onchange='load_area1(this.value)'><option value=".$value.">全部地区</option>".$option."</select>";
					}else if($type == "area2"){
						$select .= "<select $style onchange='load_area2(this.value)'><option value=".$value.">全部地区</option>".$option."</select>";
					}else if($type == "area3"){
						$select .= "<select $style onchange='load_area3(this.value)'><option value=".$value.">全部地区</option>".$option."</select>";
					}else if($type == "area4"){
						$select .= "<select $style onchange='load_area4(this.value)'><option value=".$value.">全部地区</option>".$option."</select>";
					}else{
						$select .= "<select $style onchange='load_area(this.value)'><option value=".$value.">全部地区</option>".$option."</select>";
					}
					$i++;
					$option="";
				}
				if($i==3){
					$padding= "<select style='margin-left:6px;'><option>全部地区</option></select>";
				}else if($i==4){
					$padding="";
				}
				if($type=="register" || $type=="addArea" || $type="order"){
					$padding="";
				}
				
				echo $select.$padding;
			}
	}
	function ajax2(){
			$option = "";
			$catid = $this->input->get("catid",true);
			$index = $this->input->get("index",true)+1;
			if($catid==0){
				echo null;
				return;
			}
			$areas = $this->categoryModel->getByParentid($catid);
			$select ="";
			$selected ="";
			$flot=0;
			foreach($areas as $val){
				$catname=$val['catname'];
				$catid=$val['catid'];
				$option .= "<option value=$catid $selected>".$catname."</option>";
				$flot++;
			}
			if($flot!=0){
				$select .= "<select onchange='load_category(this.value,".$index.")'><option value=0>所在分类</option>".$option."</select>";
				
			}
			echo $select;
	}
	
}
