<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {

	
	 function __construct()
	{
       parent::__construct();
	   $this->load->model('areaModel');
	   $this->load->model('categoryModel');
	   $this->load->model('companyModel');
	   $this->load->model('sellModel');
	   $this->load->library("auth");
	}
	public function index()
	{
		$data =array();
		$searchInfo = array();
		
		$data['area'] = $this->areaModel->getByParentid(0); //初始地区
		$data['category'] = $this->categoryModel->getByParentid(0);//初始分类
		$page = $this->input->get("page",true);
		$catid = $this->input->get('catid',true);
		$areaid = $this->input->get('areaid',true);
		$kw = $this->input->get("kw",true);
		
		//pages初始化
		if($page=="" || $page ==0){
			$page=1;
		}else{
			if(!preg_match('#^[0-9]{1,10}$#',$page)){
				$page =1;
			}else if($page<0){
				$page = 1;
			}
		}
		$condition = "";
		
		if($areaid !="" && preg_match("#^[0-9]{1,4}$#",$areaid)){
			$searchInfo['areaid'] = $areaid;
			$searchInfo['areaSave'] = $this->areaSave($areaid);
			
		}else{
			$areaid = "";
			$data['area'] = $this->areaModel->getByParentid(0); //初始地区
			
		}
		
		
		if($catid !="" && preg_match("#^[0-9]{1,6}$#",$catid)){
			$searchInfo['catid'] = $catid;
			$searchInfo['categorySave'] = $this->categorySave($catid);
			
		}else{
			$catid = "";
			$data['category'] = $this->categoryModel->getByParentid(0);//初始分类
		}
		
		
		if($kw !=""){
			$searchInfo['kw'] = $kw;
 		}
		if(!preg_match("#^[0-9]{1,9}$#",$page)){
			$page =0;
		}
		//针对特殊字符写个正则
		
		$data['searchInfo'] = $searchInfo;
		$data['company'] = $this->companyModel->getByWhere($catid,$areaid,$kw,10,$page);
		$totalCount = $this->companyModel->getByWhereCount($catid,$areaid,$kw,10,$page);
		$pageUrl = "catid=$catid&areaid=$areaid&kw=$kw";
		$data['pageLinks'] = $this->pageAjax($totalCount[0]['count(*)']-1,$pageUrl);
		$result=$this->opResult($kw,$data['company']);
		$data['company']=$result;
		$this->load->view("company",$data);
	}
	//用来保存搜索分类条件
	function categorySave($catid){
			
			if($catid !="" && $catid>0 && preg_match("#^[0-9]{1,4}$#",$catid)){
				$cateInfo = $this->categoryModel->getByPk($catid);
				if($cateInfo['child'] == 1){
					$i=1;
					$arrParentid = explode(",",$cateInfo['arrparentid']);
					$option ="<option value=-1>所在分类</option>";
					$select ="";
					$arrParentid[count($arrParentid)] = $catid;
					foreach($arrParentid as $val){
						$arr = $this->categoryModel->getByParentid($val);
						foreach($arr as $var){
						if($i <count($arrParentid)){
							if($arrParentid[$i] ==$var['catid']){
								$selected ="selected=selected";
							}else{
								$selected = "";
							}
						}
						$option .= "<option value={$var['catid']} $selected>".$var['catname']."</option>";
						}	
						if($i !=1){
							$style ="style='margin-left:6px;'";
						}else{
							$style ="";
						}
						$i++;
						$select .= "<select $style onchange='load_category(this.value)'>".$option."</select>";
						$option="<option value=-1>所在分类</option>";
					}
					return $select;
					
				}	
			}
			
	}
	//用来保存地区条件
	function areaSave($areaid){
			$option = "<option value=-1>所在地区</option>";
			$area = $this->areaModel->getByPk($areaid);
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
					if($i !=1){
							$style ="style='margin-left:6px;'";
					}else{
							$style ="";
					}
					$i++;
					$select .= "<select $style onchange='load_area(this.value)'>".$option."</select>";
					$option="<option value=-1>所在地区</option>";
				}
				return $select;
			}
	}
	function pageAjax($totalCount,$pageUrl){
				
		//分页处理
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/company?'.$pageUrl;
		$config['uri_segment'] = 0;
		$config['num_links']  = 5; //链接数
		$config['total_rows'] = $totalCount;
		$config['per_page']   = 10; 
		$config['page_query_string']=true;//以参数的形式显示
		$config['use_page_numbers'] = true;//不显示pagesize
		$config['enable_query_strings'] = true;
		$config['query_string_segment'] ="page";
		
		$config['num_tag_open'] = "<li>";
		$config['num_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = "<li class='current_page'>";
		$config['cur_tag_close'] = '</li>';
		
		$config['prev_link'] = '上一页';
		$config['prev_tag_open'] = "<li class='prepage'>";
		$config['prev_tag_close'] = '</li>';
		
		$config['next_link'] = '下一页';
		$config['next_tag_open'] = "<li class='nextpage'>";
		$config['next_tag_close'] = '</li>';
		
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = '首页';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = ceil($totalCount/10);
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$this->pagination->initialize($config); 
		
		return $data['pagelinks'] =$this->pagination->create_links();
	}
	function ajax(){
			$option = "";
			$areaid = $this->input->get("areaid",true);
			$area = $this->areaModel->getByPk($areaid);
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
					$i++;
					$select .= "<select onchange='load_area(this.value)'>".$option."</select>";
					$option="<option>所在地区</option>";
				}
				echo $select;
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
			
			/*
			$arrParentid  = explode(",",$area['arrparentid']);
			$select ="";
			$selected ="";
			$i=1;
			if($area['child'] ==1){
				$arrParentid[count($arrParentid)] = $catid;
				foreach($arrParentid as $val){
					$arr = $this->categoryModel->getByParentid($val);
					
					foreach($arr as $var){
						if($i <count($arrParentid)){
							if($arrParentid[$i] ==$var['catid']){
								$selected ="selected=selected";
							}else{
								$selected = "";
							}
						}
						$option .= "<option value={$var['catid']} $selected>".$var['catname']."</option>";
					}
					$i++;
					$select .= "<select onchange='load_category(this.value)'>".$option."</select>";
					$option="<option>所在地区</option>";
				}
				echo $select;
			}*/
			
	}

	/**
	 * brand连接事件
	 * @param unknown_type $brand
	 * @return Ambigous <unknown, multitype:unknown >
	 */
	function sellBrandLink($brand){
		$array=array();
		$sellList=$this->sellModel->getByBrand($brand);
		$catList=$this->categoryModel->getAllDataList();
		for($i=0; $i<count($sellList); $i++){
			$sell=$sellList[$i];
			$catid=$sell['catid'];
			$array[$i]=$sell;
			for($j=0; $j<count($catList); $j++){
				$category=$catList[$j];
				if($category['catid']==$catid){
					$array[$i][0]=$category;
					break;
				}
			}
		}
		return $array;
	}

	/**
	 * 材料搜索
	 * @param unknown_type $catid
	 * @param unknown_type $areaid
	 * @param unknown_type $text
	 */
	function searchStuff($catid,$areaid,$text,$pageSize){
		$array=array();
		$sellList=$this->sellModel->getByWhere($catid,$areaid,$text,$pageSize);
		$catList=$this->categoryModel->getAllDataList();
		for($i=0; $i<count($sellList); $i++){
			$sell=$sellList[$i];
			$catid=$sell['catid'];
			$array[$i]=$sell;
			for($j=0; $j<count($catList); $j++){
				$category=$catList[$j];
				if($category['catid']==$catid){
					$array[$i][0]=$category;
					break;
				}
			}
		}
		return $array;
	}
	
	
	//获取搜索数据function getByWhere($catid,$areaid,$text,$pageSize,$pageIndex)
	function searchAjax(){
		$catid = $this->input->get("catid",true);
		$areaid = $this->input->get("areaid",true);
		$kw = $this->input->get("kw",true);
		$sell = $this->sellModel->getByWhere($catid,$areaid,$kw,10,0);
		$totalCount = $this->sellModel->getByWhereCount($catid,$areaid,$kw);
		$pagesLinks = $this->pageAjax($totalCount[0]['count(*)']);
		
		echo json_encode($sell)."###".$pagesLinks;
	}

	/**
	 * 加亮处理结果
	 * @param unknown_type $param
	 * @param unknown_type $result
	 */
	function opResult($param,$result){
		$rs=array();
		$rsIndex=0;
		if($result&&$param){
			for($i=0; $i<count($result); $i++){
				$obj=$result[$i];
				$sell=$obj['sell'];
				$company=$obj['company'];
				$address=$obj['address'];
				$paramLength=strlen($param);
				$tsIndex=strripos($sell,$param);
				$csTndex=strripos($company,$param);
				$ksIndex=strripos($address,$param);
				$sellText=null;
				$companyText=null;
				$addressText=null;
				if($tsIndex!=-1){
					$sellText=substr($sell,$tsIndex,$paramLength);
				}
				if($csTndex!=-1){
					$companyText=substr($company,$csTndex,$paramLength);
				}
				if($ksIndex!=-1){
					$addressText=substr($address,$ksIndex,$paramLength);
				}
				$sell=str_ireplace($param,"<font style='color:red'>".$sellText."</font>",$sell);
				$company=str_ireplace($param,"<font style='color:red'>".$companyText."</font>",$company);
				$address=str_ireplace($param,"<font style='color:red'>".$addressText."</font>",$address);
				$obj['sell']=$sell;
				$obj['company']=$company;
				$obj['address']=$address;
				$rs[$rsIndex]=$obj;
				$rsIndex++;
			}
		}else{
			$rs=$result;
		}
		return $rs;
	}
}
