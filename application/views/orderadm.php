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
  <li class="jiben"><a href="<?php echo base_url()?>index.php/orderadm">询价管理</a></li>
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
<div class="middle_1">询价单中心</div>
<div class="middle_2"><select id="ordertype" class="sele" name="">
                <option value="1">近一个月订单</option>
                <option value="2">一个月前订单</option>
            </select><select id="orderstateselect" class="sele" name="">
                <option value="1">全部订单</option>
                <option value="2">有效订单</option>
                <option value="3">已取消订单</option>
            </select> 
			<?php 
			foreach($stateCount as $key=>$val){
				if($val['state_id'] !=2 && $val['state_id'] !=3){
					echo "&nbsp;".$val['text'].":&nbsp;";
					echo !isset($val['count'])?'<span>0</span>':"<span>{$val['count']}</span>";
				}else if($val['state_id'] ==3){//未分发 已分发 全部处理为已应询
					echo "&nbsp;应询中:&nbsp;";
					$c1 = !isset($stateCount[$key-1]['count']) ? 0 : $stateCount[$key-1]['count'];
					
					
					$c2 = !isset($val['count']) ? 0 : $val['count'];
					$count = $c1+$c2;
					echo  "<span>".$count."</span>";
				}
				
			}
			?>
			
			
			&nbsp;&nbsp;&nbsp;&nbsp; <input id="ip_keyword" name="" type="text" class="text" value="项目名称、单据编号" onfocus="if (this.value==this.defaultValue)this.value=''" onblur="if (this.value=='') this.value=this.defaultValue"><input name="" type="button" value="查 询" class="bti"></div>

<div class="middle_4">
<table width="971" cellpadding="0" cellspacing="0" border='0' style='border:1px solid #e8e8e8;' >
	<tr bgcolor='#f6f6f6' height='40' align='center'>
		<td class="bk1">状态</td>
		<td class="bk2">单据号</td>
		<td class="bk3">项目名称</td>
		<td class="bk4">地区限制</td>
		<td class="bk4">材料数量</td>
		<td class="bk5">询价截止日期</td>
		<td class="bk6">发布时间</td>
		<td class="bk7">操作</td>
	</tr>
	<?php 
		if($orderList){
			foreach($orderList as $val){
				?>
				 <tr>
					<td class="bk1"><?php echo $val['text'];?></td>
					<td class="bk2"><?php echo $val['xj_no'];?></td>
					<td class="bk3"><a href="#"><?php echo $val['project_name'];?></a></td>
					<td class="bk4"><?php echo $val['project_addr'];?></td>
					<td class="bk4"><?php echo $val['detailCount'];?></td>
					<td class="bk5"><?php echo date('Y-m-d',strtotime($val['end_date']));?></td>
					<td class="bk6"><?php echo $val['send_time'];?></td>
					<td class="bk7"><a href="<?php echo base_url()?>index.php/order?xjid=<?php echo $val['xj_id'];?>">查看</a></td>
				 </tr>
				<?php
			}
		}else{
			?>
			<tr>
				<td colspan='7' align='center'>暂无记录</td>
			</tr>
			
			<?php
		}
	?>
 
</table>


</div>                    
<!--中间-->
</body>
</html>

