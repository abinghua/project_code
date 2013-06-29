<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>询价单页面</title>
<link href="<?php echo base_url()?>file/css/member.css" rel="stylesheet" type="text/css" />

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
  <li class="jiben"><a href="#">应询管理</a></li>
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
<div class="middle_1">应询单中心</div>
<form action="<?php echo base_url().'index.php/answeradm';?>" method='get' onsubmit="return checkInput();">
<div class="middle_2"><select id="ordertype" class="sele" name="timeStatus">
				<option>不限时间</option>
                <option value="1">一周内</option>
				<option value="2">两周内</option>
                <option value="3">一个月内</option>
				<option value="4">两个月内</option>
            </select><select id="orderstateselect" class="sele" name="status">
                <option>全部订单</option>
				<option value="2">应询中订单</option>
                <option value="3">已过期订单</option>
				<option value="4">已取消订单</option>
            </select> 
			<?php
				foreach($stateAll as $key =>$val){
					if($val['state_id'] ==4){
						if(isset($stateAll[$key-1]['count'])) {
							if(isset($stateAll[$key]['count'])){
								echo "&nbsp;应询中:";
								echo "<span>".($stateAll[$key-1]['count']+$stateAll[$key]['count'])."</span>";
							}else{
								echo "&nbsp;应询中:";
								echo "<span>".$stateAll[$key-1]['count']."</span>";
							}
						}else if(isset($stateAll[$key]['count'])){
							echo "&nbsp;应询中:";
							echo "<span>".$stateAll[$key]['count']."</span>";
						}else{
							echo "&nbsp;应询中:";
							echo "<span>0</span>";
						}
						//isset();
					}else if($val['state_id'] !=3){
						echo "&nbsp;".$val['text'].":";
						echo isset($val['count']) ? "<span>".$val['count']."</span>":"<span>0</span>";
					}
					
				}
			?>

			<input id="ip_keyword" name="xjno" type="text" value="工程名称、订单编号" onfocus="if (this.value==this.defaultValue)this.value=''" onblur="if (this.value=='') this.value=this.defaultValue"><input type="submit" value="查 询" class="bti"></div></form>

<div class="middle_4">

<table width="971" cellpadding="0" cellspacing="0">
	<tr height="40" bgcolor="#e6e6e6" align='center'>
		<td>状态</td>
		<td>单据号</td>
		<td>项目名称</td>
		<td>地区限制</td>
		<td>报价数</td>
		<td>询价截止日期</td>
		<td>发布时间</td>
		<td>操作</td>

	</tr>

<?php 
	foreach($detail as $val){
	?>
	
	<tr>
    <td class="bk1"><span><?php echo $val['statename'];?></span></td>
    <td class="bk2"><?php echo $val['xj_no'];?></td>
    <td class="bk3"><a href="#"><?php echo $val['project_name'];?></a></td>
    <td class="bk4"><?php echo $val['project_addr'];?></td>
	<td class="bk4">已:<?php echo $val['alreadyCount'];?>个  未:<?php echo $val['totalCount']-$val['alreadyCount'];?>个</td>
    <td class="bk5"><?php echo date("Y-m-d",strtotime($val['end_date']));?></td>
    <td class="bk6"><?php echo $val['send_time'];?></td>
    <td class="bk7"><a href="<?php echo base_url()?>index.php/answer?xjid=<?php echo $val['xj_id'];?>">查看</a></td>
  </tr>
	<?php
	}
?>
  
</table>


</div>                    
<!--中间-->
<script type="text/javascript">
	function checkInput(){
		var xjno = document.getElementById('ip_keyword');
		if(xjno.defaultValue==xjno.value){
			return false;
		}
	}
	
</script>
</body>
</html>

