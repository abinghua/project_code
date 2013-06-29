<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class order extends CI_Controller {

	
	 function __construct()
	{
       parent::__construct();
	   $this->load->model('memberModel');
	   $this->load->database();
	   $this->load->model('sellModel');
	   $this->load->library('encrypt');
	   $this->load->library("auth");
	   $this->load->model('areaModel');
	   $this->load->model('categoryModel');
	   $this->load->library("checkcode"); 
	   $this->load->model('xjListModel');
	   $this->load->model('XjDetailModel');
	   $this->load->model('xjImageModel');
	   $this->load->model('xjStateModel');
	   $this->load->model('XjImageModel');
	   $this->load->model('yxListModel');
	   $this->load->model('yxDetailModel');
	}
	public function index()
	{
		if($this->auth->hasLogin()){//询价页面不让采购访问
			$data =array();
			$catCount = array();//分类（个数）
			$areaName = '';
			$catidDis = trim($this->input->get("catid",true));//用于分类筛选
			if(!preg_match("#[1-9]{1,}#",$catidDis)){
				unset($catidDis);
			}else{
				$catidDis = array($catidDis);
			}
			$userid = $this->session->userdata('userid');
			$member = $this->memberModel->getByPk($userid);
			$username  = $member['username'];
			$data['userid'] = $userid;
			$data['username'] = $username;
			if($member['groupid'] != 5 && $member['groupid'] !=8 && $member['groupid'] !=1){
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/\">');</script> ";
					$msg = '您无权访问此页面！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
			}
			
			$xj_id = $this->input->get('xjid',true);
			if(preg_match('#^[0-9]{1,9}$#',$xj_id)){//对提交的xjid做严格匹配，防止非法提交
				$xj_id = $this->input->get('xjid',true);
				$xjList = $this->xjListModel->getByUserid_Xjid($xj_id,$userid);
				
				if(!$xjList){//防止提交非法数据
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/orderadm\">');</script> ";
					$msg = '您访问的订单不存在！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
				}
			}else{//如果用户直接访问order页面
				$xjList = $this->xjListModel->getUnSubmit($userid);
				if(!$xjList){//如果没有未提交的订单，就显示最新修改的订单，只限一条
					$xjList = $this->xjListModel->getOneByUserid($userid);
					if(!$xjList){//如果该用户没有订单，就跳转
						echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/orderadm\">');</script> ";
						$msg = '您访问的订单不存在！页面在5s钟后跳转！';
						$data['msg'] = $msg;
						$this->load->view('404',$data);
						return false;
					}
				}
				$xj_id = $xjList['xj_id'];
			}
			//状态处理 未分发 和已分发 均处理为 应询中
			
			if($xjList['state_id'] ==2 || $xjList['state_id'] ==3 ){
				$xjList['statename'] = "应询中";
			}else{
				$stateName = $this->xjStateModel->getByPk($xjList['state_id']);
				$xjList['statename'] = $stateName['text'];
			}
			if(!$xjList['project_addr']){
				$xjList['project_addr'] = "全国";
			}	
			
			$detail_all = $this->XjDetailModel->getByXjId($xj_id);
			//$catidDis = array(1);
			$detail = isset($catidDis) ?  $this->filterDetailByCategory($detail_all,$catidDis) : $detail_all;
			//$detail = $this->filterDetailByCategory($detail_all,$catidDis);
			if($detail){
				foreach($detail as $key =>$detail_one){
					$item = $this->sellModel->getByPk($detail_one['itemid']);
					$catid = $this->categoryModel->getByPk($item[0]['catid']);
					$detail[$key]['imgurl'] = $item[0]['thumb'];
					$arrparentid = explode(',',$catid['arrparentid']);
					
					
					//细表不要地区处理,修改后
					$limit_areaid = $detail_one['limit_areaid'];
					if($limit_areaid){//地区处理
						$areaidArr = explode(',',$limit_areaid);
						foreach($areaidArr as $val){
							$area = $this->areaModel->getByPk($val);
							$areaName .= ' '.$area['areaname'];
						}
						$detail[$key]['areaname'] =  $areaName;
						$areaName ='';
					}else{
						$detail[$key]['areaname'] =  '全国';
					}
					/**/
					//imgage url 处理
					$img = $this->XjImageModel->getByDetailid($detail_one['detail_id']);
					$imgurl = isset($img['url']) ? $img['url'] : "";
					$detail[$key]['imgurl'] =$item[0]['thumb'].",".$imgurl;
					//构造分类(个数)
					
					if(count($arrparentid) ==1){//当前分类id为顶级分类
						$flag=true;
						$k = count($catCount);
						if($k != 0){
							foreach($catCount as $val){
									if($val['catid'] == $catid['catid']){
										$catCount[$k-1]['count'] ++;
										$flag =false;
										break;
									}
							}
							if($flag){
									$catCount[$k]['catid'] = $catid['catid'];
									$catCount[$k]['catname'] = $catid['catname'];
									$catCount[$k]['count'] = 1;
							}
						}else{
									$catCount[$k]['catid'] = $catid['catid'];
									$catCount[$k]['catname'] = $catid['catname'];
									$catCount[$k]['count'] = 1;
						}
						$detail[$key]['catname'] = $catid['catname'];
						$detail[$key]['catid'] = $catid['catid'];
					}else{
						$catname = $this->categoryModel->getByPk($arrparentid[1]);
						$k = count($catCount);
						if($k != 0){
							$flag=true;
							foreach($catCount as $val){
									if($val['catid'] == $catname['catid']){
										$catCount[$k-1]['count'] ++;
										$flag =false;
										break;
									}
							}
							if($flag){
									$catCount[$k]['catid'] = $catname['catid'];
									$catCount[$k]['catname'] = $catname['catname'];
									$catCount[$k]['count'] = 1;
							}
						}else{
									$catCount[$k]['catid'] = $catname['catid'];
									$catCount[$k]['catname'] = $catname['catname'];
									$catCount[$k]['count'] = 1;
						}
						$detail[$key]['catname'] =  $catname['catname'];
						$detail[$key]['catid'] = $catname['catid'];
					}
					///构造应询报价数ansCount
					if($xjList['state_id'] >=4){
						$yxList = $this->yxListModel->getByXjid($xjList['xj_id']);
						
						if($yxList){
							foreach($yxList as $val){
								if($val['state_id'] ==8 || $val['state_id'] == 9){
									$yx_detail = $this->yxDetailModel->getByYx_idXj_detailid($val['yx_id'],$detail_one['detail_id']);
									//print_r($yx_detail);
									if($yx_detail){
										//$detail[$key]['ansCount'] = count($yx_detail);
										 isset($detail[$key]['ansCount']) ?  $detail[$key]['ansCount']++ : $detail[$key]['ansCount'] =1;
									}
								}
								
							}
						}
					}
					
					
				}
			}
			
			$data['area'] = $this->areaModel->getByParentid(0);
			$data['xjList'] = $xjList;
			$data['detail'] = $detail;
			$data['catCount'] = $catCount;
			$this->load->view("order",$data);
		}else{
			redirect(base_url()."index.php/login");
		}
		
	}
	/*
	*$detail_all xjdetail数组
	*$catidDis 要筛选的分类数组id
	*$detail 返回筛选后的数据
	**/
	function filterDetailByCategory($detail_all,$catidDis){
		
		$detail = array();//筛选后的数组
		foreach($detail_all as $key=>$val){
			$item = $this->sellModel->getByPk($val['itemid']);
			$catid = $this->categoryModel->getByPk($item[0]['catid']);
			//$detail[$key]['imgurl'] = $item[0]['thumb'];
			$arrparentid = explode(',',$catid['arrparentid']);
			
				foreach($catidDis as $val2){
					if(count($arrparentid) ==1){
						if($arrparentid[0]==$val2){
							$detail[] = $detail_all[$key];
						}
					}else{
						if($arrparentid[1]==$val2){
							$detail[] = $detail_all[$key];
						}
					}
					
				}
		}
		return $detail;
	}
	function submitUn(){
		if($this->auth->hasLogin()){
			
			$userid = $this->session->userdata('userid');
			$member = $this->memberModel->getByPk($userid);
			$username  = $member['username'];
			if($member['groupid'] != 5 && $member['groupid'] !=8 && $member['groupid'] !=1){
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/\">');</script> ";
					$msg = '您无权访问此页面！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
			}
			$xjList = $this->xjListModel->getUnSubmit($userid);
			if($xjList){
				$this->xjListModel->updateState($userid);
			}
			redirect(base_url()."index.php/order?xjid=".$xjList['xj_id']);
		}
	}
	function getUpdateList(){//获取询价单表头信息
		$xj_id = $this->input->get('xjId',true);
		if(!$this->auth->hasLogin()){//没有登录,
			return false;
		}
		
		if(!preg_match("#^[0-9]{1,9}$#",$xj_id)){
			return false;
		}
		$userid = $this->session->userdata('userid');
		$member = $this->memberModel->getByPk($userid);
		$username  = $member['username'];
		if($member['groupid'] != 5 && $member['groupid'] !=8 && $member['groupid'] !=1){//防止非法访问
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/\">');</script> ";
					$msg = '您无权访问此页面！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
		}
		$xjList = $this->xjListModel->getByUserid_Xjid_Unsubmit($xj_id,$userid);
		if(!$xjList){
			return false;
		}
		if(!strtotime($xjList['end_date'])){
			$date = date("y-m-d",time());
		}else{
			$date = date('Y-m-d',strtotime($xjList['end_date']));
		}
		//处理状态
		if($xjList['state_id'] ==2 || $xjList['state_id'] ==3 ){
				$xjList['statename'] = "应询中";
		}else{
			$stateName = $this->xjStateModel->getByPk($xjList['state_id']);
			$xjList['statename'] = $stateName['text'];
		}
		$options = "";
		$str = "";
		$area = $this->areaModel->getByParentid(0);
		//$str .= "<div class=\"detail_2_1\" style=\"float:left;width:400px;padding-top:10px;padding-left:10px;font-weight:bold;\">单据号：<span class=\"xj_no_\" style=\"color: #B40002;\">".$xjList['xj_no']."</span>&nbsp;截止日期:<span style=\"color: #B40002;\">".date("Y-m-d",strtotime($xjList['end_date']))."</span>&nbsp;&nbsp;状态;<span style=\"color: #B40002;\">".$xjList['statename']."</span></div>";

		$str .= "<div class=\"mb_detail_2_no\">";
		$str .= "<div class=\"detail_2_1\" style=\"\"><div class=\"danjuhao\"><ul><li class=\"danjuhao_3\">单据号：</li><li class=\"danjuhao_1\">".$xjList['xj_no']."</li><li class=\"danjuhao_0\">截止日期：</li><li class=\"danjuhao_1\">".date("Y-m-d",strtotime($xjList['end_date']))."</li><li class=\"danjuhao_0\">状态：</li><li class=\"danjuhao_1\">".$xjList['statename']."</li></ul></div>";
		$str .= "<div class=\"detail_2_2\"><input type=\"button\" value=\"关 闭\" class=\"closeUpdate\" onclick=\"closeUpdate()\"></div></div>";
		$str .= "</div>  ";
		$str .= "<div class=\"mb_detail_3_no\">  ";
		
		$str .= "<input type=hidden name='xjId' class=\"xjId\"value='".$xjList['xj_id']."'>";
			$str .= "<div class=\"detail_xiugai\">";
			  $str .= "<div class=\"detail_xiugai_1\">";
			  $str .= "<ul>";
			  $str .= "<li style=\"padding-top:10px;\">";
				$str .= "<span>项目名称:</span><input type=\"text\" name=\"project_name\"  class=\"project_name\" value=\"".$xjList['project_name']."\"  class=\"txt\" >";
				
					$str .= "<span>截止日期:</span><input type=\"text\" name=\"end_date\" value=\"".$date."\" onclick=\"WdatePicker()\" class=\"end_date Wdate\"  onfocus=\"WdatePicker({minDate:'%y-%M-%d',errDealMode:2})\" >";
					$str .= "<span class=\"sasd\">地区限制：</span>";
					
					
					$str .="<span class=\"addArea\" style=\"display:;\">";
					
							///options ="";
							foreach($area as $val){
								$options .= "<option value={$val['areaid']}>".$val['areaname']."</option>";
							}
							$str .= "<select onchange='add_area(this.value,this.options[this.selectedIndex].text)'><option>全部地区</option>".$options."</select>";
					
					
				$str .= "</span>";
				$str .= "<span class='addAreaBtn' ><a href=\"javascript:void(0);\" class=\"addAreaArr\" onclick=\"addAreaArr()\">添加</a>&nbsp;&nbsp;<a href=\"javascript:void(0)\" class=\"areaReset\" onclick=\"areaReset()\">重置</a><input type=\"text\" class=\"areaNameArr\"  readOnly name=\"areaNameArr\" value=\"".$xjList['project_addr']."\"  style=\"width:100px;\"/></span>";
				$str .= "</span>";
				$str .= "<input type=\"hidden\" class=\"areaAreaid\" name=\"areaAreaid\" value=\"\" />";
				$str .= "<input type=\"hidden\" class=\"areaAreaidList\" name=\"areaAreaidList\" value=\"".$xjList['limit_areaid']."\" />";
				$str .= "<input type=\"hidden\" class=\"areaName\" name=\"areaName\" value=\"\" />";
					
					
					
					
					
					//$str .= "<span class=\"sel\">";
					//$str .= $this->areaSave($xjList['limit_areaid']);
					//$str .= "</span>";
					//$str .= "<input type='hidden' class='addr' value='".$xjList['limit_areaid']."'>";
			  $str .= "</li>";
			  $str .= "<li style=\"margin-top:10px;\"><span>备注：</span><textarea name=\"remark\" cols=\"3\" class=\"remark\" rows=\"5\" style=\"width:700px; margin-left:20px;\">".$xjList['remark']."</textarea></li>";
			  $str .= "<li style=\"padding:10px 0px 10px;\"><input type=\"image\" src=\"".base_url()."file/member/xiugai_bc.gif\" onclick=\"saveOrder()\"></li>";
			  $str .= "</ul>";
			  $str .= "</div> ";
			  
			$str .= "</div>";
			
		$str .= "</div> ";
		echo  $str;
		
		
		
	}
	function orderDo(){//修改询价单表头信息
		if(!$this->auth->hasLogin()){
			return false;
		}
		$userid = $this->session->userdata('userid');
		$member = $this->memberModel->getByPk($userid);
		if($member['groupid'] != 5 && $member['groupid'] !=8 && $member['groupid'] !=1){//防止非法访问
					echo "<script type=\"text/javascript\">document.write('<meta http-equiv=\"refresh\" content=\"5;'+'url=".base_url()."index.php/\">');</script> ";
					$msg = '您无权访问此页面！页面在5s钟后跳转！';
					$data['msg'] = $msg;
					$this->load->view('404',$data);
					return false;
		}
		$xj_id = $this->input->get('xjId',true);
		$project_name = $this->input->get('project_name',true);
		$areaName = $this->input->get("areaNameArr",true);
		$areaidArr = trim($this->input->get('areaAreaidList',true));
		$end_date = $this->input->get("end_date",true);
		$remark = $this->input->get("remark",true);
		
		
		if(!preg_match("#^[0-9]{1,9}$#",$xj_id)){
			$msg = array(
				'msg'=>'您提交的订单非法',
				'flag' => false
			);
			echo json_encode($msg);
			return false;
		}
		$xjList = $this->xjListModel->getByUserid_Xjid_Unsubmit($xj_id,$userid);//是否是未提交的订单
		if(!$xjList){
			$msg = array(
				'msg'=>'您提交的订单不存在',
				'flag' => false
			);
			echo json_encode($msg);
			return false;
		}
		if(!$project_name){
			$msg = array(
				'msg'=>'您提交的项目名称为空',
				'flag' => false
			);
			echo json_encode($msg);
			return false;
		}
		
		if(!preg_match("#^[0-9]{4}(\-)[0-9]{1,2}(\-)[0-9]{1,2}$#",$end_date)){
			$msg = array(
				'msg'=>'截至日期格式不正确',
				'flag' => false
			);
			echo json_encode($msg);
			return false;
		}else if(time()-strtotime($end_date)>=0){
			$msg = array(
				'msg'=>'您输入的截至日期不能在今天以前',
				'flag' => false
			);
			echo json_encode($msg);
			return false;
		}else{
			$end_date .=" 23:59:59";
		}
		//$areaidArr = $this->input->get('addr',true);
		if(!preg_match("#^(\d+)(,\d+)*$#",$areaidArr)){
					$project_addr = "";
					$limit_area = "";
		}else{
			/*
			$addr_area = $this->areaModel->getByPk($areaidArr);
			if(!$addr_area){
				$project_addr = "";
			}else{
				$arrParentid = explode(',',$addr_area['arrparentid']);
				$project_addr  ="";
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
		
		$param = array(
			"project_name"=>$project_name,
			"project_addr"=>$project_addr,
			"remark" =>$remark,
			"end_date"=>$end_date,
			'xj_id' =>$xj_id,
			'user_id' =>$userid,
			'project_addr'=>$project_addr,
			'limit_areaid' => $areaidArr,
			'edit_time' => date("Y-m-d H:i:s")
		);
		$this->xjListModel->updateUnsubmitByUserid_Xjid($param);
		$paramDetail = array(
			"limit_areaid" => $areaidArr
		);
		$this->XjDetailModel->updateLimit_areaidByXjid($xj_id,$paramDetail);
		
		$msg = array(
				'msg'=>'修改成功',
				'flag' => true,
				'xjId' => $xj_id
		);
		
		echo json_encode($msg);
	}
	public function deleteDetail(){
		if(!$this->auth->hasLogin()){
			return false;
		}
		
		$detail_id = $this->input->get("detailId",true);
		if(!preg_match("#^[0-9]{1,9}$#",$detail_id)){
			return false;
		}
		$userid = $this->session->userdata('userid');
		$member = $this->memberModel->getByPk($userid);
		if($member['groupid'] != 5 && $member['groupid'] !=8 && $member['groupid'] !=1){
			return false;
		}
		$detail = $this->XjDetailModel->getByDetailId($detail_id);//是否有此详情单
		if(!$detail){return false;}
		
		
		$xj_id = $detail[0]['xj_id'];
		$xjList = $this->xjListModel->getByUserid_Xjid_Unsubmit($xj_id,$userid);
		if(!$xjList){return false;}//此详情单 的 表头订单 是否是未提交的单
		$xjImg = $this->xjImageModel->getByDetailid($detail_id);
		unlink($xjImg['url']);//删除物理图片
		$this->xjImageModel->delByDetailid($detail_id);//删除图片记录
		$this->XjDetailModel->delByPk($detail_id);//删除 该 详情订单
		
		$xjListA = $this->XjDetailModel->getByXjId($xj_id);
		if(!$xjListA){ //若是最后一条详情订单,删除表头订单
			$this->xjListModel->delByPk($xj_id);
			redirect(base_url()."index.php/orderadm");
		}
		redirect(base_url()."index.php/order?xjid=".$xjList['xj_id']);
	}
	public function updateDetail(){
		if(!$this->auth->hasLogin()){
			redirect(base_url()."index.php/login");
		}
		$detail_id = trim($this->input->post('detailId',true));
		$brandIn = trim($this->input->post('brandIn',true));
		$standard = trim($this->input->post('standardIn',true));
		$model = trim($this->input->post('modelIn',true));
		$unit = trim($this->input->post('unitIn',true));
		//$count = is_numeric(trim($this->input->post('countIn',true)))? trim($this->input->post('countIn',true)):1;
		$count = trim($this->input->post('countIn',true));
		$remark = trim($this->input->post('remarkIn',true));
		$item_limit = trim($this->input->post("item_limit",true)) ? 1 : 0;//细表时候地区限制
		$xj_id = trim($this->input->post('xjId',true));
		$sample = trim($this->input->post('sample',true)) ? 1 : 0;//是否取样只是 0  1
		
		if(strlen($remark)>100){
			$remark = substr($remark,10);
		}
		if(!preg_match("#^[0-9]{1,9}$#",$detail_id)){
			$msg = array(
				'msg'=>'error',
				'flag' => false,
			);
			echo json_encode($msg);
			return false;
		}
		/*
		if(!$unit){
			$msg = array(
				'msg'=>'单位不能为空',
				'flag' => false,
			);
			echo json_encode($msg);
			return false;
		}
		*/
		if(!preg_match("#^[0-9]{1,6}$#",$count)){
			$msg = array(
				'msg'=>'数量输入有误',
				'flag' => false,
			);
			echo json_encode($msg);
			return false;
		}
		/*
		if(isset($_FILES['url']) && !empty($_FILES['url'])){
			$picurl = $_FILES['url'];
		}
		*/
		$userid = $this->session->userdata('userid');
		$member = $this->memberModel->getByPk($userid);
		if($member['groupid'] != 5 && $member['groupid'] !=8 && $member['groupid'] !=1){
			$msg = array(
				'msg'=>'只有设计师采购商才能询价',
				'flag' => false,
			);
			echo json_encode($msg);
			return false;
		}
		$detail = $this->XjDetailModel->getByDetailId($detail_id);//是否有此详情单
		if(!$detail){
			$msg = array(
				'msg'=>'您提交的订单不存在',
				'flag' => false,
			);
			echo json_encode($msg);
			return false;
		}
		$xj_id = $detail[0]['xj_id'];
		$xjList = $this->xjListModel->getByUserid_Xjid_Unsubmit($xj_id,$userid);
		if(!$xjList){
			$msg = array(
				'msg'=>'您提交的订单不存在',
				'flag' => false,
			);
			echo json_encode($msg);
			return false;
		}//此详情单 的 表头订单 是否是未提交的单
		$item_limit = $item_limit ? $xjList['limit_areaid'] : "";
		$param = array(
			'detail_id' => $detail_id,
			'brand' => $brandIn,
			'standard' => $standard,
			'model' => $model,
			'unit' => $unit,
			'count' => $count,
			'remark' => $remark,
			'to_sample' => $sample,
			'limit_areaid'=>$item_limit
		);
		$this->XjDetailModel->updateByPk($param);
		//图片没有处理
		//echo "<script type='text/javascript'>alert('更新成功!');</script>";
		
		redirect(base_url()."index.php/order?xjid=".$xj_id);
		//$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		//echo "<script type='text/javascript'>top.location.href='{$url}'</script>";
		//redirect('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
		
	}
	function areaSave($areaid){
			if($areaid =="" || $areaid == -1){
				$areaid = 0;
			}
			$option = "<option value=-1>全部地区</option>";
			$area = $this->areaModel->getByPk($areaid);
			
			if(!$area){
				$area = $this->areaModel->getByParentid(0);
				$select ="";
				foreach($area as $val){
					$option .= "<option value={$val['areaid']} >".$val['areaname']."</option>";
				}
				return "<select onchange='load_area(this.value)'>".$option."</select>";
			}else{
				
				$arrParentid  = explode(",",$area['arrparentid']);
				$select ="";
				$i=1;
				$arrParentid[count($arrParentid)] = $area['areaid'];
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
	}
}

?>
