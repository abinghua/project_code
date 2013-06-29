<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>询价单页面</title>
<link href="<?php echo base_url()?>file/css/member.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url()?>file/js/jquery-1.7.2.min.js"></script>
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
  <li><span>项目名称:</span><?php echo $xjList[0]['project_name'];?><span class="juli">所属地区：</span><?php echo $xjList[0]['project_addr'];?></li>
  <li><span>备注：</span><?php echo $xjList[0]['remark'];?></li>
  </ul>
  </div> 
 </div>
</div>  



<div class="cailiao_1">
 <div class="cailiao_1_1"><?php echo $detail['cat_name'];?></div>
</div>

<div class="cailiao_2">
<div class="cailiao_2_1">
<ul>
<li><span>产品规格：</span><?php echo $detail['standard'];?></li>
<li class="cailiao_2_1_1"><span>型号：</span><?php echo $detail['model'];?></li>
<li class="cailiao_2_1_1"><span>品牌：</span><?php echo $detail['brand'];?></li>
<li class="cailiao_2_1_1"><span>单位：</span><?php echo $detail['unit'];?></li>
<li class="cailiao_2_1_1"><span>求购数量：</span><span class="sl"><?php echo $detail['count'];?></span></li>
</ul>
</div></div>
<div class="cailiao_2_2">
<?php 
	
	if($detail['item_img']){
	?>
	<img src="<?php echo base_url().$detail['item_img']?>" width="150" height="113"/>
	<?php
	}
	if($detail['detail_img']){
	?>
	<img src="<?php echo base_url().$detail['detail_img']?>" width="150" height="113"/>
	<?php
	}
?>
<?php 
	if($detail['yx_img']){
?>
		<img src="<?php echo base_url().$detail['yx_img']?>" width="150" width="200" />
<?php
	}
?>
</div>

<form action="<?php echo base_url()?>index.php/answermodify/updateAnswer"  method="post" onsubmit="return checkInput();" enctype="multipart/form-data">
<div class="cailiao_3">
<input type="hidden" name="xj_id" value="<?php echo $detail['xj_id'];?>"/>
<input type="hidden" name="xj_detail_id" value="<?php echo $detail['detail_id'];?>">
供货总量：<input type="text" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'');" name="amount" value="<?php echo isset($detail['yx_detail']['amount'])? $detail['yx_detail']['amount'] : '';?>" size="10"  class="amount">&nbsp;&nbsp;&nbsp;&nbsp;
单位：<input type="text" name="unit" value="<?php echo isset($detail['unit'])? $detail['unit'] : '';?>" size="5" class="unit">&nbsp;&nbsp;&nbsp;&nbsp;
价格：<input type="text" name="price" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'');"  value="<?php echo isset($detail['yx_detail']['price'])? $detail['yx_detail']['price'] : '';?>" size="5" id="title" class="price">&nbsp;&nbsp;&nbsp;&nbsp;
预计发货周期：<input type="text" name="days" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'');" value="<?php echo isset($detail['yx_detail']['days'])? $detail['yx_detail']['days'] : '';?>" size="15" class="days">
样品图片：<input type="file" name="url" />


</div>
<div class="cailiao_3">
<ul>
<li>备&nbsp;&nbsp;注：<textarea rows="5" cols="80" name="remark" id="content" class="pd3"></textarea></li>
<li class="cailiao_3_1"><input type="image" src="<?php echo base_url()?>file/member/tjbj.gif"></li>
</ul>
</div>
</form>
<!--中间-->
<script type="text/javascript">
	function checkInput(){
		amount = $(".amount").val();
		unit = $(".unit").val();
		price = $(".price").val();
		days = $(".days").val();
		if(!minamount || !mount || !unit || !price || !days){
			alert('请将数据填写完整！');
			return false;
		}
	}
	
	
</script>
</body>
</html>

