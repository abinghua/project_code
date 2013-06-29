<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {

	
	 function __construct()
	{
       parent::__construct();
	   $this->load->model('areaModel');
	   $this->load->model('categoryModel');
	   $this->load->model('companyModel');
	   $this->load->model('sellModel');
	   $this->load->model("companyDataModel");
	}
	public function index()
	{
		$data =array();
		$companyId = $this->input->get("companyId",true);
		if(!$companyId && !preg_match("#^[0-9]{1,10}$#",$companyId)){
			$companyId = 100230;
		}
		$data['company'] = $this->companyModel->getByPk($companyId);
		$data['indtroduce'] = $this->companyDataModel->getByPk($companyId);
		
		$this->load->view("homepage",$data);
	}
	function pageAjax($totalCount){
				
		//分页处理
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/company?';
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
					$arr = $this->category->getByParentid($val);
					
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
		$sell = $this->sell->getByWhere($catid,$areaid,$kw,10,0);
		$totalCount = $this->sell->getByWhereCount($catid,$areaid,$kw);
		$pagesLinks = $this->pageAjax($totalCount[0]['count(*)']);
		
		echo json_encode($sell)."###".$pagesLinks;
	}
}
