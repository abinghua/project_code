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

<div class="tj_1">
   <ul>
   <li>当前位置:</li>
   <li><?php echo $detail['cat_name'];?></li>
   <li>（单据号：<?php echo $xjList['xj_no'];?> 截止日期：<?php echo date("Y-m-d",strtotime($xjList['end_date']));?>）</li></ul>
</div>

<div class="tj_2">
 <div class="tj_2_1">
  <div class="tj_2_1_1">&nbsp;<?php echo $detail['cat_name'];?><span>（材料图片）</span></div> 
  <div class="tj_2_1_2">
  <?php 
	$urls = explode(',',$detail['imgurl']);
	if(isset($urls[0]) && $urls[0] !=''){
		?>
		 <div class="tj_tu"><span><img src="<?php echo base_url().$urls[0];?>" width='150' height='120' /></span><span>网站图片</span></div>  
		<?php
	}
	if(isset($urls[1]) && $urls[1] !=''){
		?>
		 <div class="tj_tu"><span><img src="<?php echo base_url().$urls[1];?>"   width='150' height='120' /></span><span>用户上传</span></div>  
		<?php
	}
  ?>
  
  
  </div> 
  <div class="tj_2_1_3"><span>【备注】<?php echo $detail['remark'];?></span></div>
 </div><!--tj_2_1END-->
 
 <div class="tj_2_2">
   <div class="tj_2_2_1">&nbsp;<?php echo $detail['cat_name'];?><span>（详情）</span></div> 
   <div class="tj_2_2_2">
   <ul>
   <li><span>产品规格：</span><?php echo $detail['standard'];?></li>
   <li><span>型&nbsp;&nbsp;&nbsp;&nbsp;号：</span><?php echo $detail['model'];?></li>
   <li><span>品&nbsp;&nbsp;&nbsp;&nbsp;牌：</span><?php echo $detail['brand'];?></li>
   <li><span>单&nbsp;&nbsp;&nbsp;&nbsp;位：</span><?php echo $detail['unit'];?></li>
   <li><span>需求数量：</span><?php echo $detail['count'];?></li>
   <li><span>地区限制：</span><?php echo $detail['areaname'];?></li>
   </ul></div> 
 </div><!--tj_2_2END-->
</div>

<div class="mb_detail_4">
 <div class="baojia"><?php echo $detail['cat_name'];?><span>（报价信息）</span></div>
</div> 

<div class="baojia_1">  
<ul>
<li class="bj8">&nbsp;&nbsp;操作</li>
<li class="bj1">供应商</li>
<li class="bj3">供货总量</li>
<li class="bj4">单位</li>
<li class="bj5">价格</li>
<li class="bj6">应询时间</li>
<li class="bj7">预计发货周期</li>

</ul>
</div>
<!--循环START-->
<?php 
	foreach($yxDetail as $val){
		?>
		<div class="baojia_2">  
		<table width="971">
		  <tr>
			<td class="bj_28"><a href="">选定</a></td>
			<td class="bj_21"><?php echo $val['company'];?></td>
			<td class="bj_23"><?php echo $val['amount'];?></td>
			<td class="bj_24"><?php echo $val['unit'];?></td>
			<td class="bj_25"><?php echo $val['price'];?></td>
			<td class="bj_27"><?php echo date("Y-m-d",strtotime($val['date']));?></td>
			<td class="bj_26"><?php echo $val['days'];?></td>
		  </tr>
		</table>
		</div>
				
		<div class="baojia_3">
		<ul>
		<li><dl><dt>联系人：<?php echo $val['truename'];?></dt>
		<dt>&nbsp;&nbsp;联系电话：<?php echo $val['telephone'];?></dt>
		<dt>&nbsp;&nbsp;手机：<?php echo $val['mobile'];?></dt>
		<dt>&nbsp;&nbsp;地址：<?php echo $val['address'];?></dt>
		</dl></li>
		<li>备注：</li>
		</ul>
		</div>
		
		<?php
	}
?>


<!--循环END-->

<!--中间-->


</body>
</html>

