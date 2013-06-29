<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>询价单页面</title>
<link href="<?php echo base_url()?>file/css/member.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url()?>file/js/jquery-1.7.2.min.js"></script>

</head>

<body>
<!--头部START-->
<div class="top">
  <div class="top_1">
     <div class="top_1_1"><ul><li><a href="<?php echo base_url();?>">通达建首页</a></li><li><a href="<?php echo base_url();?>/index.php/provide">建材供应</a></li><li><a href="#">帮助中心</a></li></ul></div>
     <div class="top_1_2">
     <ul>
     <li><a href="<?php echo base_url();?>">深圳市通达建网络科技有限公司</a></li>
     <li><a href="#">信息</a></li>
     <li class="span">5</li>
     <li><a href="<?php echo base_url();?>index.php/login/logout?v=<?php echo time();?>">退出</a></li>
     </ul></div>
  </div>
</div>
<!--头部END-->
<!--导航START-->
<div class="menu">
 <div class="menu_1">
  <div class="menu_logo"><img src="<?php echo base_url()?>file/member/menber_logo.jpg" /></div>
  <div class="menu_1_1">
  <ul>
  <li><img src="<?php echo base_url()?>file/member/menu.jpg"/></li>
  <li class="jiben"><a href="">基本信息</a></li>
  </ul>  
  </div><!--1_1END-->
    <div class="menu_1_1">
  <ul>
  <li><img src="<?php echo base_url()?>file/member/menu02.jpg"/></a></li>
  <li class="jiben"><a href="<?php echo base_url();?>index.php/orderadm">询价管理</a></li>
  </ul>  
  </div><!--1_1END-->
    <div class="menu_1_1">
  <ul>
  <li><img src="<?php echo base_url()?>file/member/menu03.jpg"/></li>
  <li class="jiben"><a href="#">消息管理</a></li>
  </ul>  
  </div><!--1_1END-->
  
  <div class="menu_1_2">
   <ul>
   <li><a href="#"><?php echo $username;?></a><a href="#">（修改资料）</a>服务时间：8:00-17：30（周一至周日） </li>
   <li>服务热线：0755-88888888 全国免费电话：400-003-5006</li>
   <li></li>
   </ul>
  </div>  
 </div><!--1END-->
</div>
<!--导航END-->

<!--中间-->
<div class="mb_detail_1">
  <div class="danjuhao"><ul><li class="danjuhao_3">单据号：</li><li class="danjuhao_1"><?php echo $xjList['xj_no'];?></li><li class="danjuhao_0">截止日期：</li><li class="danjuhao_1"><?php echo date('Y-m-d',strtotime($xjList['end_date']));?></li><li class="danjuhao_0">状态：</li><li class="danjuhao_1"><?php echo $xjList['statename'];?></li><li>&nbsp; 尊敬的客户，请核实您所输入的询价信息是否无误，如有问题您可以在这进行进一步的修改。</li></ul></div>
</div>  



<div id="xjList_no">

<div class="mb_detail_2">  
 <div class="detail_2_1">单据信息</div>
 <div class="detail_2_2"><?php if($xjList['state_id'] <=1){?><input name="" type="button" value="修 改" class="bti" onclick="getUpdateList('<?php echo $xjList['xj_id']; ?>')"><?php }?></div>
</div>  

<div class="mb_detail_3">  
 <div class="detail_3">
  <div class="detail_3_1">
  <ul>
  <li><span>项目名称:</span><?php echo $xjList['project_name'];?><span class="juli">所属地区：</span><?php echo $xjList['project_addr'];?></li>
  <li><span>备注：</span><?php echo $xjList['remark'];?>(特殊要求填写，注意事项，对所要了解信息进一步要求等等)</li>
  </ul>
  </div> 
 </div>
 </div>  
 
</div>



<div class="mb_detail_4">
 <div class="detail_4_1">询价单材料</div>
 <!---
 <div class="detail_4_2">按类型筛选：<select style="width:123px;" onchange="load_area(this.value, 1);"><option value="0"  style="color:#e5e5e5">请选择类型</option><option value="1">五金</option><option value="2">石材</option></select> <select style="width:123px;" onchange="load_area(this.value, 1);"><option value="0"  style="color:#e5e5e5">请选择类型</option><option value="1">五金</option><option value="2">石材</option></select> <select style="width:123px;" onchange="load_area(this.value, 1);"><option value="0"  style="color:#e5e5e5">请选择类型</option><option value="1">五金</option><option value="2">石材</option></select></div>--->
</div> 


<table width="971" cellpadding='0' border='1' cellspacing='0' style='margin:0 auto;'>
	<tr align='center' bgcolor="#f6f6f6" height='40' class="firstTr">
		<td>材料名称</td>
		<td>分类</td>
		<td>产品规格</td>
		<td>型号</td>
		<td>品牌</td>
		<td>单位</td>
		<td>数量</td>
		<td>备注</td>
		<td>地区限制</td>
		<td>操作</td>
	</tr>
	<tr class='countC'>
		<td colspan='10'>
			<div class="mb_detail_6">
				<ul>
				<?php 
					$totalCat = 0;
					foreach($catCount as $totalCount){
						$totalCat += $totalCount['count'] ;
					}
				?>
				<li><img src="<?php echo base_url()?>file/member/dian.gif" /><a href="javascript:void(0)" onclick="displayCat('0')"> 全部（<?php echo $totalCat;?>）</a></li>
				<?php
					foreach($catCount as $val){
				?>
				<li><img src="<?php echo base_url()?>file/member/dian.gif" /><a href="javascript:void(0)" onclick="displayCat('<?php echo $val['catid'];?>')"> <?php echo $val['catname']?>（<?php echo $val['count']?>）</a></li>
				<?php 
					}
				?>
				</ul>
				</div>
		</td>
	</tr>
	</table>
	<table width="971" cellpadding="0" cellspacing="0" border="1" style='margin:0 auto;' id='dataDis'>
	<?php 
	$data_detail = array();
	foreach($detail as $key =>$val){
		$data_detail[$key]['detailId'] = $val['detail_id'];
		$data_detail[$key]['url'] = $val['imgurl'];
		$data_detail[$key]['areaid'] = $val['limit_areaid'];
?>
  <tr height='40' class='<?php echo $val['catid'];?>'>
    <td class="xx1"><?php echo $val['cat_name'];$data_detail[$key]['name'] = $val['cat_name'];?></td>
	<td class="xx6"><?php echo $val['catname'];$data_detail[$key]['catname'] = $val['cat_name'];?></td>
    <td class="xx2"><?php echo $val['standard'];$data_detail[$key]['standard'] = $val['standard'];?></td>
    <td class="xx3"><?php echo $val['model'];$data_detail[$key]['model'] = $val['model'];?></td>
    <td class="xx4"><?php echo $val['brand'];$data_detail[$key]['brand'] = $val['brand'];?></td>
    <td class="xx5"><?php echo $val['unit'];$data_detail[$key]['unit'] = $val['unit'];?></td>
    <td class="xx6"><?php echo $val['count'];$data_detail[$key]['count'] = $val['count'];?></td>
    <td class="xx7"><?php echo $val['remark'];$data_detail[$key]['remark'] = $val['remark'];?></td>
    <td class="xx8"><?php echo $val['areaname'];$data_detail[$key]['areaname'] = $val['areaname'];?></td>
    <td class="xx9">
		<?php 
			if($xjList['state_id'] <=1){
		?>
			<a href="javascript:void(0);" onclick="viewDetail(<?php echo $val['detail_id'];?>)"><img src="<?php echo base_url()?>file/member/tj.gif" /></a>&nbsp;<a href="javascript:void(0)" onclick="deleteDetail(<?php echo $val['detail_id'];?>)"><img src="<?php echo base_url()?>file/member/sc.gif" /></a>
		<?php
		}else{
		?>
					<a href="" >查看</a>
		<?php

		}
		?>
	</td>
  </tr>
  <?php }?>
</table>



<div class="mb_detail_8" style="height:30px;">
<?php
	if($xjList['state_id'] <=1){
?>
<form action='<?php echo base_url()?>index.php/order/submitUn' method='post'>
<input type="image" src="<?php echo base_url()?>file/member/tjx.gif">
</form>
<?php }?>
</div>
<!--中间-->
<iframe id="updateDetail" name="updateDetail---"  style="width:0;heigth:0;overflow:hidden;border:0;position: absolute; left:-500px;"></iframe>
<div id="sellaskdiv" style="position: absolute; width: 100%; bottom: 0px; zoom: 1; opacity: 0.6; filter:alpha(opacity=60);top: 0px; right: 0px; left: 0px; height: 100%; z-index: 999; background-color: rgb(204, 204, 204);display:none;"></div>
<!--弹窗-->
<div class="mb_tanchuang" style="padding: 0px; background-color: rgb(255, 255, 255);position: fixed;margin: 0px; z-index: 1001;  font-size: 12px; left: 359.5px; top: 30px; display:none;">
<form action="<?php echo base_url()?>index.php/order/updateDetail" method="post" enctype='multipart/form-data' target="updateDetail">
  <div class="tanchuang_1">
   <ul>
   <li>当前位置:<input type="hidden" name="detailId" class='detailId_H' value=''></li>
   <li><?php echo $xjList['project_name'];?></li>
   <li>（单据号：<?php echo $xjList['xj_no'];?> <input type="hidden" name="xjId" value="<?php echo $xjList['xj_id'];?>">截止日期：<?php echo date('Y-m-d',strtotime($xjList['end_date']));?>）</li>
   <li class="tc_an"><img src="<?php echo base_url();?>file/member/tc_sc.gif" onclick="closeDialog()"  style="cursor:pointer;"/></li>
   </ul></div>
   
  <div class="tanchuang_2"> <span class="title"></span></div> 
  
  <div class="tanchuang_3">
   <div class="tanchuang_3_1"><span ><img src="<?php echo base_url();?>file/member/cp.jpg" name='url[]' class="img1" width='140' height='110'/></span></div>  
   <div class="tanchuang_3_1"><span><img src="<?php echo base_url();?>file/member/cp1.jpg" name='url[]' class="img2" width='140' height='110'/></span></div>  
   <div class="tanchuang_3_1"><span><img src="<?php echo base_url();?>file/member/cp1.jpg" class="img3" width='140' height='110'/></span></div>  
  </div>
  
  <div class="tanchuang_4">
  <ul>
  <li><span>产品规格：</span><input type="text"  value="" name='standardIn' class='standard' maxlength="20" class="txt" ><span>产品型号：</span><input type="text" name='modelIn'   value="" maxlength="20" class="model" ></li>
  <li><span>品&nbsp;&nbsp;&nbsp;&nbsp;牌：</span><input type="text" name='brandIn' value="" maxlength="20" class="brand" ><span>单&nbsp;&nbsp;&nbsp;&nbsp;位：</span><input type="text" value="" maxlength="20" class="unit" name='unitIn' ></li>
  <li><span>数&nbsp;&nbsp;&nbsp;&nbsp;量：</span><input type="text" name='countIn' value="" maxlength="20" class="count" ></li>
  <li>
		<span>地区限制：</span><span class="addArea">
					<?php 
		
							
							$options ="";
							foreach($area as $val){
								$options .= "<option value={$val['areaid']}>".$val['areaname']."</option>";
							}
							echo "<select onchange='add_area(this.value,this.options[this.selectedIndex].text)'><option>所在地区</option>".$options."</select>";
						
					?>
				</span>
				<a href="javascript:void(0)" onclick="addAreaArr()">添加</a>&nbsp;<a href="javascript:void(0)" onclick="areaReset()">重置</a><br>
				<textarea class="areaNameArr" disabled="disabled"></textarea>
				<input type="hidden" class="areaName" value="" />
				<input type="hidden" class="areaAreaid" value="" />
				<input type="hidden" class="areaAreaidList" name='areaAreaidList' value="" />
				
	</li>
  </ul></div>
  
  <div class="tanchuang_5">
 <span>备注：</span><textarea name="remarkIn" cols="3" rows="5" style="width:500px;" class="remark"></textarea></div>
 
 <input type="image" src="<?php echo base_url();?>file/member/tc_bc.gif">
 </form>
</div>
<!--弹窗-->




<script type="text/javascript">
	var detail = <?php echo json_encode($data_detail);?>;
	var base_url = "<?php echo base_url();?>";
	var time = "<?php echo time()?>";
	//var myObject = eval('(' + detail + ')');
	function addAreaArr(){
		areaid = $('.areaAreaid').val();
		areaName = $(".areaName").val();
		areaidList = $('.areaAreaidList').val();
		areaNameList = $('.areaNameArr').val();
		if(areaid == -1){
			return false;
		}
		if(areaidList){
			flag = true;
			areaidListArr = areaidList.split(',');
			for($i=0;$i<areaidListArr.length;$i++){
				if(areaidListArr[$i] == areaid){
					flag = false;
					break;
				}
			}
			if(flag){//判断是否有相同id
				$('.areaAreaidList').val($('.areaAreaidList').val()+','+areaid);
				$('.areaNameArr').val($('.areaNameArr').val()+','+areaName);
			}else{
				alert('您已经添加过\"'+areaName+'\"了！');
			}
			
		}else{
			$('.areaAreaidList').val(areaid);
			$('.areaNameArr').val(areaName);
		}
	}
	
	function areaReset(){
			$('.areaAreaidList').val('');
			$('.areaNameArr').val('');
	}
	
	function add_area(areaid,areaName){
		if(areaid){
			$(".areaAreaid").val(areaid);
			$(".areaName").val(areaName);
			$.ajax({
				url:base_url+"index.php/index/ajax?areaid="+areaid+"&type=addArea"
				
			}).done(function(data){
				
				if(data!=null&&data.replace(/(^\s*)|(\s*$)/g,'')!=""){
					$(".addArea").html(data);
				}
			})
		}
	}
		
	function viewDetail(id){
		for(i=0;i<detail.length;i++){
			if(detail[i].detailId ==id){
				$("#sellaskdiv").css({"display":"block"});
				$(".mb_tanchuang").css({"display":"block"});
				$(".title").html(detail[i].catname);
				$(".standard").val(detail[i].standard);
				$(".model").val(detail[i].model);
				$(".unit").val(detail[i].unit);
				//$(".areaname").val(detail[i].areaname);
				$(".brand").val(detail[i].brand);
				$(".count").val(detail[i].count);
				$(".remark").val(detail[i].remark);
				$(".detailId_H").val(detail[i].detailId);
				$(".areaNameArr").val(detail[i].areaname);
				$(".areaAreaidList").val(detail[i].areaid);
				
				img = detail[i].url.split(',');
				
				if(img[0]){
					$(".img1").attr('src',base_url+img[0]);
					if(img[1]){
						$(".img2").attr('src',base_url+img[1]);
					}
					
				}else{
					$(".img1").attr('src',base_url+img[1]);
					if(img[0]){
						$(".img2").attr('src',base_url+img[0]);
					}
					
				}
				break;
			}
		}
		
	}
	function displayCat(catid){
		if(catid ==0){
			$("#dataDis tr").css({"display":"block"});
		}else{
			$("#dataDis tr."+catid).css({"display":"block"});
			$("#dataDis tr").not('.'+catid).css({'display':'none'});
			//$("#dataDis tr:not("+catid+")").css({"display":"none"});
			//$("table#dataDis tr").eq("not:"+catid).css({"display":"none"});
		}
	}
	
	function getUpdateList(xjId){
		//alert(xjId);
		$.ajax({
			url:base_url+'index.php/order/getUpdateList?xjId='+xjId+"&v="+time
		}).done(function(data){
			if(data.replace(/(^\s*)|(\s*$)/g,'')!=""){
				$(".mb_detail_2").css({"display":"none"});
				$(".mb_detail_3").css({"display":"none"});
				$("#xjList_no").append(data);
			}
			
		})
	}
	function closeUpdate(){
		$(".mb_detail_2").css({"display":"block"});
		$(".mb_detail_3").css({"display":"block"});
		$(".mb_detail_2_no").remove();
		$(".mb_detail_3_no").remove();
	}
	function saveOrder(){
		project_name = $(".project_name").val();
		areaid =$(".arLast").val();
		addr = $('.addr').val();
		end_date = $(".end_date").val();
		
		remark = $(".remark").val();
		xjId = $(".xjId").val();
		if(!project_name){
			alert("请仔细填写项目名称");
			return false;
		}
		var now= new Date();
		var year=now.getYear();
		var month=now.getMonth()+1;
		var day=now.getDate();
		
		param = "xjId="+xjId+"&project_name="+project_name+"&areaid="+areaid+"&addr="+addr+"&end_date="+end_date+"&remark="+remark+"&v="+time;
		
		$.ajax({
			url:base_url+"index.php/order/orderDo?"+param
		}).done(function(data){
			if(data.replace(/(^\s*)|(\s*$)/g,'')!="" && data.replace(/(^\s*)|(\s*$)/g,'')=="success"){
				window.location = base_url+"/index.php/order";
			}
		})
	}
	
	function updateDetail(detail_id){
		param = 'detailId='+detail_id;
		
		/*
		$.ajax({
			url:"<?php echo base_url()?>index.php/order/updateDetail?"+param
		}).done(function(data){
			if(data.replace(/(^\s*)|(\s*$)/g,'')!="" && data.replace(/(^\s*)|(\s*$)/g,'')=="success"){
				window.location = "<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>";
			}
		})
		*/
	}
	
	function deleteDetail(detail_id){
		param = 'detailId='+detail_id;
		if(!confirm('是否要删除这条记录?')){
			return false;
		}
		$.ajax({
			url:base_url+"index.php/order/deleteDetail?"+param
		}).done(function(data){
			if(data.replace(/(^\s*)|(\s*$)/g,'')!="" && data.replace(/(^\s*)|(\s*$)/g,'')=="success"){
				
				window.location = "<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>";
			}
		})
	}
	function closeDialog(){
		$("#sellaskdiv").css({"display":"none"});
		$(".mb_tanchuang").css({"display":"none"});
	}
</script>

<script type="text/javascript" src="<?php echo base_url()?>file/wdatepick/WdatePicker.js"></script>;

</body>
</html>

