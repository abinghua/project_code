<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Provide extends CI_Controller {

	
	 function __construct()
	{
       parent::__construct();
	   $this->load->model('areaModel');
	   $this->load->model('categoryModel');
	   $this->load->library("auth");
	   $this->load->model('sellModel');
	   $this->load->model('xjListModel');
	   $this->load->model('XjDetailModel');
	   $this->load->model('xjImageModel');
	   
	}
	public function index()
	{
		
		$data =array();
		$searchInfo = array();
		
		$pages = $this->input->get("page",true);//当前页
		$brand = $this->input->get("brand",true);//品牌
		$catid = $this->input->get("catid",true);//分类id号，
		$areaid = $this->input->get('areaid',true);//地区id号
		$kw     = $this->input->get("kw",true);     //关键字
		$price = $this->input->get('price',true);   //根据价格来排序显示结果
		$edittime = $this->input->get('edittime'.true);//根据更新时间来显示
		$page = $this->input->get("page",true);
		
		//pages初始化
		if($pages=="" || $pages ==0){
			$pages=1;
		}else{
			if(!preg_match('#^[0-9]{1,10}$#',$pages)){
				$pages =1;
			}else if($pages<0){
				$pages = 1;
			}
		}

		if($areaid !="" && preg_match("#^[0-9]{1,4}$#",$areaid)){
			$searchInfo['areaid'] = $areaid;
			$searchInfo['areaSave'] = $this->areaSave($areaid);
			
		}else{
			$areaid = "";
		}
		$data['area'] = $this->areaModel->getByParentid(0); //初始地区
		
		if($catid !="" && preg_match("#^[0-9]{1,6}$#",$catid)){
			$searchInfo['catid'] = $catid;
			$searchInfo['categorySave'] = $this->categorySave($catid);
			
			if(!isset($searchInfo['categorySave'])){
				
				$data['category'] = $this->categoryModel->getByParentid(0);
			}
			/**/
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
		
		$data['item'] = $this->sellModel->getByWhere($catid,$areaid,$kw,10,$page);
		$data['searchInfo'] = $searchInfo;
		$totalCount = $this->sellModel->getByWhereCount($catid,$areaid,$kw);
		$pageUrl = "catid=$catid&areaid=$areaid&kw=$kw";
		$data['pagelinks'] = $this->pageAjax($totalCount[0]['count(*)'],$pageUrl);//获取分页数据
		
		$result=$this->opResult($kw,$data['item']);
		$data['item']=$result;

		$this->load->view("sell",$data);
	}
	//异步请求判断是否登录,是否为采购商,设计师,管理员为测试人员
	function hasLogin(){
		if($this->auth->hasLogin()){
			$userid = $this->session->userdata('userid');
			$member = $this->memberModel->getByPk($userid);
			if($member['groupid'] == 5 || $member['groupid'] ==8 || $member['groupid'] ==1){
				$state = $this->xjListModel->getUnSubmit($userid);
				if($state){
					$data['NO'] = $state['xj_no'];
					$data['NAME'] = $state['project_name'];
					$data['ADDR'] = empty($state['project_addr']) ? "全国": $state['project_addr'];
					$data['ENDDATE'] = date("Y-m-d",strtotime($state['end_date']));
				}
				$data['flag'] = 1;
				echo json_encode($data);
			}else{//登录了，但非采购,设计师
				$data['flag'] = 2;
				echo json_encode($data);
			}
		}else{
			$data['flag'] = 0;
			echo json_encode($data);
		}
	}
	//处理弹窗的询价单
	function addToIn(){
		if($this->auth->hasLogin()){
			$userid = $this->session->userdata('userid');
			$member = $this->memberModel->getByPk($userid);
			if($member['groupid'] != 5 && $member['groupid'] !=8 && $member['groupid'] !=1){//防止非法访问
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/provide\">');</script> ";
					$msg = '您无权访问此页面！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
			}
			$title = trim($this->input->post('Cat_nameIn',true));
			$itemid = trim($this->input->post('itemidIn',true));
			$brandIn = trim($this->input->post('brandIn',true));
			$standard = trim($this->input->post('standardIn',true));
			$model = trim($this->input->post('modelIn',true));
			$unit = trim($this->input->post('unitIn',true));
			$count = is_numeric(trim($this->input->post('countIn',true)))? trim($this->input->post('countIn',true)):1;
			$remark = trim($this->input->post('remarkIn',true));
			$areaidArr = trim($this->input->post('areaAreaidList',true));//添加在表头的地区限制
			$areaName = trim($this->input->post('areaNameArr',true));//也是添加在表头
			$isLimitArea = trim($this->input->post('item_limit',true));//checked on  不选 神码都没有
			$project_name = trim($this->input->post("project_nameIn",true));
			$end_date = trim($this->input->post('end_dateIn',true));
			$sample = trim($this->input->post('sample',true));
			
			if($sample){
				$sample = 1;
			}else{
				$sample = 0;
			}
			
			if(!$title){
				echo "<script type='text/javascript'>alert('产品名称不能为空!')</script>";
				return false;
			}
			if(!preg_match("#^[0-9]{1,6}$#",$count)){
				echo "<script type='text/javascript'>alert('产品数量太大!')</script>";
				return false;
			}
			
			
			
			if(isset($_FILES['url']) && !empty($_FILES['url'])){
				$picurl = $_FILES['url'];
			}
			if(preg_match("#[0-9]{1,9}#",$itemid)){
				if(!$this->sellModel->getByPk($itemid)){
					echo "<script type='text/javascript'>alert('您询价的产品不存在!')</script>";
					return false;
				}
			}
			$state = $this->xjListModel->getUnSubmit($userid);
			
			
			if($state){//有未提交的询价单
				
				//xj_detail
				$xj_id = $state['xj_id'];
				$itemidCheck = $this->XjDetailModel->getByXjId($xj_id);
				$flag=true;
				foreach($itemidCheck as $key=>$val){
					if($val['itemid'] == $itemid){
						$flag = false;
					}
				}
				if(!$flag){//check是否有相同材料
					echo "<script type='text/javascript'>alert('该产品您已经询价过了!')</script>";
					return false;
				}
				$item_limit = isset($isLimitArea) && $isLimitArea ? $state['limit_areaid'] : "";
				$paramDetail = array(
					'cat_name' => $title,
					'brand'    => $brandIn,
					'standard' => $standard,
					'model'    => $model,
					'unit'     => $unit,
					'count'    => $count,
					'remark'   => $remark,
					'limit_areaid'    =>$item_limit,//加上的原因是不需对业务再做调整
					'itemid'   => $itemid,
					'xj_id'    => $xj_id,
					'to_sample' =>$sample
				);
				$detail_id = $this->XjDetailModel->insert($paramDetail);
				if(isset($picurl)){
					if(!file_exists('file/inquery/'.$userid)){
						mkdir('file/inquery/'.$userid);
					}
					if(!file_exists('file/inquery/'.$userid.'/'.$detail_id)){
						mkdir('file/inquery/'.$userid.'/'.$detail_id);
					}
					$dir = 'file/inquery/'.$userid.'/'.$detail_id.'/'.date("Ymd");
					if(!file_exists($dir)){
						mkdir($dir);
					}
					//$images = $this->xjImageModel->getByDetailid($detail_id);
					//$imagesMaxId = $images['image_id'];
					$i=1;
					foreach($picurl['name'] as $key => $val){
						if($picurl['type'][$key] =='image/jpeg' || $picurl['type'][$key] =='image/gif' || $picurl['type'][$key] =='image/png'){
							$extName = substr($picurl['name'][$key],strrpos($picurl['name'][$key],'.'));
							$uploadFile = $dir.'/'.date('YmdHis').rand(1000,9999).$extName;
							move_uploaded_file($picurl['tmp_name'][$key],$uploadFile);
							$paramImage = array(
								'detail_id' =>$detail_id,
								'url'       =>$uploadFile,
								'image_id'  =>$i
							);
							$this->xjImageModel->insert($paramImage);
							$i++;
						}
					}
				}
				
			}else{
				if(!preg_match("#^[0-9]{4}(\-)[0-9]{1,2}(\-)[0-9]{1,2}$#",$end_date)){
					echo "<script type='text/javascript'>alert('截至日期格式不正确!')</script>";
					return false;
				}else if(time()-strtotime($end_date)>=0){
					echo "<script type='text/javascript'>alert('截至日期不能在今天以前!')</script>";
					return false;
				}else{
					$end_date .=" 23:59:59";
				}
				if(!$project_name){
					echo "<script type='text/javascript'>alert('项目名称不能为空！')</script>";
					return false;
				}
				//xj_list
				if(!preg_match("#^(\d+)(,\d+)*$#",$areaidArr)){
					$project_addr = "";
					//echo "<script type='text/javascript'>alert('$areaidArr')</script>";
					
				}else{
					//echo "<script type='text/javascript'>alert('{$areaName}')</script>";
					/*
					$addr_area = $this->areaModel->getByPk($areaidArr);
					if(!$addr_area){
						$project_addr = "";
					}else{
						$project_addr  ="";
						$arrParentid = explode(',',$addr_area['arrparentid']);
						foreach($arrParentid as $val){
							if($val !='' && $val !=0){
								$name = $this->areaModel->getByPk($val);
								$project_addr .= $name['areaname'];
							}
						}
						$project_addr .= $addr_area['areaname'];
					}
					*/
					$project_addr = $areaName;
				}
				$param=array(
					'xj_no' => date("YmdHis").$userid,
					'edit_time' => date('Y-m-d:H:i:s'),
					'user_id' => $userid,
					'state_id' => 1,
					'project_name' => $project_name,
					'project_addr' => $project_addr,//方便查看
					'user_name' => $member['username'],
					'edit_time' => date("Y-m-d H:i:s"),
					'end_date' =>$end_date,
					'limit_areaid'=>$areaidArr,
					'js_unit' =>$member['company']
				);
				$xj_id = $this->xjListModel->insert($param);
				$item_limit = isset($isLimitArea) && $isLimitArea ? $areaidArr : "";
				//xj_detail
				$paramDetail = array(
					'cat_name' => $title,
					'brand'    => $brandIn,
					'standard' => $standard,
					'model'    => $model,
					'unit'     => $unit,
					'count'    => $count,
					'remark'   => $remark,
					'limit_areaid'    => $item_limit,
					'itemid'   => $itemid,
					'xj_id'    => $xj_id,
					'to_sample' =>$sample
				);
				$detail_id = $this->XjDetailModel->insert($paramDetail);
				//xj_image
				//图片路径：file/inquery/用户名/订单号/订单详细编号/日期/
				if(isset($picurl)){
					if(!file_exists('file/inquery/'.$userid)){
						mkdir('file/inquery/'.$userid);
					}
					if(!file_exists('file/inquery/'.$userid.'/'.$detail_id)){
						mkdir('file/inquery/'.$userid.'/'.$detail_id);
					}
					$dir = 'file/inquery/'.$userid.'/'.$detail_id.'/'.date("Ymd");
					if(!file_exists($dir)){
						mkdir($dir);
					}
					$i=1;
					foreach($picurl['name'] as $key => $val){
						if($picurl['type'][$key] =='image/jpeg' || $picurl['type'][$key] =='image/gif' || $picurl['type'][$key] =='image/png'){
							$extName = substr($picurl['name'][$key],strrpos($picurl['name'][$key],'.'));
							$uploadFile = $dir.'/'.date('YmdHis').rand(1000,9999).$extName;
							move_uploaded_file($picurl['tmp_name'][$key],$uploadFile);
							$paramImage = array(
								'detail_id' =>$detail_id,
								'url'       =>$uploadFile,
								'image_id'  =>$i
							);
							$this->xjImageModel->insert($paramImage);
							$i++;
						}
					}
				}
				
				
			}
			echo "<script type='text/javascript'>alert('该产品已经添加到询价单中心!')</script>";
		}else{
			redirect(base_url()."index.php/login");
		}
		
	}
	//用来保存地区条件
	function areaSave($areaid){
			$option = "<option value=-1>全部地区</option>";
			$area = $this->areaModel->getByPk($areaid);
			$arrParentid  = explode(",",$area['arrparentid']);
			$select ="";
			$i=1;
			
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
					if($area['child'] !=1 && $i!=count($arrParentid)){
						$select .= "<select $style onchange='load_area(this.value)'>".$option."</select>";
						$option="<option value=-1>全部地区</option>";
					}
					if($area['child'] ==1){
						$select .= "<select $style onchange='load_area(this.value)'>".$option."</select>";
						$option="<option value=-1>全部地区</option>";
					}
				}
				return $select;
			
	}
	//用来保存搜索分类条件
	function categorySave($catid){
			
			if($catid !="" && preg_match("#^[0-9]{1,4}$#",$catid)){
					$cateInfo = $this->categoryModel->getByPk($catid);
					$i=1;
					$arrParentid = explode(",",$cateInfo['arrparentid']);
					$option ="<option value=-1>全部分类</option>";
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
						$value = isset($arrParentid[$i]) ? $arrParentid[$i] : '';
						if($cateInfo['child'] !=1 && $i!=count($arrParentid)){
							$select .= "<select $style onchange='load_category(this.value)'>".$option."</select>";
							$option="<option value=".$value.">全部分类</option>";
						}
						if($cateInfo['child'] == 1){
							$select .= "<select $style onchange='load_category(this.value)'>".$option."</select>";
							$option="<option value=".$value.">全部分类</option>";
						}
						$i++;
					}
					return $select;
					
				
			}
			
	}
	function categoryAjax(){
			$catid = $this->input->get("catid",true);
			$type = $this->input->get("type",true);
			if($type !="" && !preg_match("#[1-4]{1}#",$type)){
				return false;
			}
			if($catid !="" && preg_match("#^\-?[0-9]{1,4}$#",$catid)){
				if($catid < 0){
					$cateInfo = $this->categoryModel->getByParentid(0);
					$option ="<option value=-1>全部分类</option>";
					foreach($cateInfo as $val){
						$option .= "<option value='{$val['catid']}'>".$val['catname']."</option>";
					}
					echo "<select onchange='load_category(this.value)'>".$option."</select>";
					return false;
				}
				$cateInfo = $this->categoryModel->getByPk($catid);
				
				if(isset($cateInfo['child']) && $cateInfo['child'] == 1){
					$i=1;
					$arrParentid = explode(",",$cateInfo['arrparentid']);
					$option ="<option value=-1>全部分类</option>";
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
							}else{$selected ="";}
							
							$option .= "<option value={$var['catid']} $selected>".$var['catname']."</option>";
						}	
						if($i !=1){
							$style ="style='margin-left:6px;'";
						}else{
							$style ="";
						}
						$value = isset($arrParentid[$i]) ? $arrParentid[$i] : '';
						if($type==1){//for register做的
							$select .= "<select $style onchange='load_category1(this.value)'>".$option."</select>";
						}elseif($type==2){
							$select .= "<select $style onchange='load_category2(this.value)'>".$option."</select>";
						}elseif($type==3){
							$select .= "<select $style onchange='load_category3(this.value)'>".$option."</select>";
						}elseif($type==4){
							$select .= "<select $style onchange='load_category4(this.value)'>".$option."</select>";
						}else{
							$select .= "<select $style onchange='load_category(this.value)'>".$option."</select>";
						}
						
						$option="<option value=".$value.">全部分类</option>";
						$i++;
					}
					echo $select;
					
				}	
			}
			
	}
	function pageAjax($totalCount,$pageUrl){
				
		//分页处理
		$this->load->library('pagination');
		
		$config['base_url'] = base_url()."index.php/provide?".$pageUrl;
		$config['uri_segment'] = 0;
		$config['num_links']  = 5; //链接数
		$config['total_rows'] = $totalCount;
		$config['per_page']   = 10; 
		$config['page_query_string']=true;//以参数的形式显示
		$config['use_page_numbers'] = true;//不显示pagesize
		$config['enable_query_strings'] = true;
		$config['query_string_segment'] ="page";
		
		$config['num_tag_open'] = "<li onclick='fanye(window.event.srcElement)'>";
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
					$option="<option>所有地区</option>";
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
				$select .= "<select onchange='load_category(this.value,".$index.")'><option value=0>全部分类分类</option>".$option."</select>";
				
			}
			
			echo $select;
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
				$title=$obj['title'];
				$company=$obj['company'];
				$address=$obj['address'];
				$paramLength=strlen($param);
				$tsIndex=strripos($title,$param);
				$csTndex=strripos($company,$param);
				$ksIndex=strripos($address,$param);
				$titleText=null;
				$companyText=null;
				$addressText=null;
				if($tsIndex!=-1){
					$titleText=substr($title,$tsIndex,$paramLength);
				}
				if($csTndex!=-1){
					$companyText=substr($company,$csTndex,$paramLength);
				}
				if($ksIndex!=-1){
					$addressText=substr($address,$ksIndex,$paramLength);
				}
				$title=str_ireplace($param,"<font style='color:red'>".$titleText."</font>",$title);  
				$company=str_ireplace($param,"<font style='color:red'>".$companyText."</font>",$company);
				$address=str_ireplace($param,"<font style='color:red'>".$addressText."</font>",$address);
				$obj['title']=$title;
				$obj['company']=$company;
				$obj['keyword']=$address;
				$rs[$rsIndex]=$obj;
				$rsIndex++;
			}
		}else{
			$rs=$result;
		}
		return $rs;
	}
}
