<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>询价单页面</title>
<link href="<?php echo base_url()?>file/css/member.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	tr.borderR td{border:1px solid #e6e6e6;}
</style>
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
  <li class="jiben"><a href="#">基本信息</a></li>
  </ul>  
  </div><!--1_1END-->
    <div class="menu_1_1">
  <ul>
  <li><img src="<?php echo base_url()?>file/member/menu02.jpg"/></li>
  <li class="jiben"><a href="<?php echo base_url()?>index.php/answeradm">应询管理</a></li>
  </ul>  
  </div><!--1_1END-->
    <div class="menu_1_1">
  <ul>
  <li><img src="<?php echo base_url()?>file/member/menu03.jpg"/></li>
  <li class="jiben"><a href="#">消息管理</a></li>
  </ul>  
  </div><!--1_1END-->
  <div class="menu_1_1">
  <ul>
  <li><img src="<?php echo base_url()?>file/member/menu04.jpg"/></li>
  <li class="jiben"><a href="#">产品维护</a></li>
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



<div class="mb_detail_2">  

	<div class="danjuhao"><ul><li class="danjuhao_3">单据号：</li><li class="danjuhao_1"><?php echo $xjList[0]['xj_no'];?></li><li class="danjuhao_0">截止日期：</li><li class="danjuhao_1"><?php echo date('Y-m-d',time($xjList[0]['end_date']));?></li><li class="danjuhao_0">状态：</li><li class="danjuhao_1"><?php echo $xjList[0]['statename'];?></li></ul></div>
</div>  

<div class="mb_detail_3">  
 <div class="detail_3">
  <div class="detail_3_1">
  <ul>
  <li><span>项目名称:</span><?php echo $xjList[0]['project_name'];?><span class="juli">地区限制：</span><?php echo $xjList[0]['project_addr'];?></li>
  <li><span>备注：</span><?php echo $xjList[0]['remark'];?></li>
  </ul>
  </div> 
 </div>
</div>  

<div class="mb_detail_4">
 <div class="detail_4_1">应询单材料 (<?php if($yxList && $yxList[0]['state_id'] == 7){echo '未提交';}else if($yxList && $yxList[0]['state_id'] ==8){echo "已提交   提交时间：".$yxList[0]['sub_time'];}?>)</div>
 <div class="detail_4_2">
	<?php 
		if(isset($catCount) && $catCount){
			foreach($catCount as $val){
				echo "<span>".$val['catname']."(".$val['count'].")</span>&nbsp;";
			}
		}
	?>
 </div>
 <!-----
 <div class="detail_4_2">按类型筛选：<select style="width:123px;" onchange="load_area(this.value, 1);"><option value="0"  style="color:#e5e5e5">请选择类型</option><option value="1">五金</option><option value="2">石材</option></select> <select style="width:123px;" onchange="load_area(this.value, 1);"><option value="0"  style="color:#e5e5e5">请选择类型</option><option value="1">五金</option><option value="2">石材</option></select> <select style="width:123px;" onchange="load_area(this.value, 1);"><option value="0"  style="color:#e5e5e5">请选择类型</option><option value="1">五金</option><option value="2">石材</option></select></div>----->
</div> 


<table width="971" cellpadding='0' cellspacing='0' style='margin:0 auto;'>
	<tr align='center' bgcolor="#f6f6f6" height='40'>
		<td>材料名称</td>
		<td>是否报价</td>
		
		<td>供货总量</td>
		<td>单位</td>
		<td>价格</td>
		<td>应询时间</td>
		<td>预计发货周期</td>
		<td>操作</td>
	</tr>
	<?php 
		foreach($detail as $val){
			?>
			
			<tr height='40' align='center' class='borderR' >
    <td class=""><?php echo $val['cat_name'];?></td>
	<td><?php echo $val['submit'];?></td>
    <td class="bj_23"><?php echo isset($val['yx_amount']) ? $val['yx_amount']:'';?></td>
    <td class="bj_24"><?php echo isset($val['yx_unit']) ? $val['yx_unit']:'';?></td>
    <td class="bj_25"><?php echo isset($val['yx_price']) ? $val['yx_price']:'';?></td>
    <td class="bj_26"><?php echo isset($val['yx_date']) ? $val['yx_date']:'';?></td>
    <td class="bj_27"><?php echo isset($val['yx_days']) ? $val['yx_days']:'';?></td>
    <td class="bj_28">
		
		<?php 
		if(!$yxList || $yxList[0]['state_id'] ==7){
			if($xjList[0]['state_id'] <4){//询价单状态未改变成已询价
			if($val['submit'] == '是'){
				
		?>
		<a href="<?php echo base_url().'index.php/answermodify?xjid='.$val['xj_id'].'&detailid='.$val['detail_id'];?>">修改</a> 
		<?php
			}else{
			?>
			<a href="<?php echo base_url().'index.php/answermodify?xjid='.$val['xj_id'].'&detailid='.$val['detail_id'];?>">报价</a> 
			<?php
			}
			}
		?>
	</td>
  </tr>
			
			
			<?php
		}
		}
	?>
	 
</table>

<div class="mb_detail_8" style="height:30px;">
<?php
	
	if(!$yxList || $yxList[0]['state_id'] ==7){
		if($xjList[0]['state_id'] >=4){
			echo "该询价单已结束！";
		}else{
?>
<form action='<?php echo base_url()?>index.php/answer/submitUn' method='post'>
<input type="hidden" name="xjid" value="<?php echo $xjList[0]['xj_id'];?>" />
<input type="image" src="<?php echo base_url()?>file/member/tjx.gif">
</form>
<?php }
}
?>
</div>

<!--中间-->
</body>
</html>

