<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通达建网络科技有限公司</title>                           
<link href="<?php echo base_url()?>file/css/top.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>file/css/sell_list.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>file/css/foot.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url()?>file/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>file/js/sell.js"></script>
<script type='text/javascript'>
var base_url = "<?php echo base_url()?>";
var returnUrl = encodeURI("provide,<?php echo isset($searchInfo['catid'])?$searchInfo['catid'].",":",";echo isset($searchInfo['areaid'])?$searchInfo['areaid'].",":",";echo isset($searchInfo['kw'])?$searchInfo['kw']:"";?>");

//http://14.153.61.141:8081/ci/index.php/provide?catid=53&areaid=1&kw=%E5%9C%A3%E8%B1%A1&x=64&y=20

</script>
<style type="text/css" rel="stylesheet">
.dys {
	position:absolute;
	z-index:5;
	left:111px;
	width:18px;
	overflow:hidden;
}
.dys select {
	margin-left:-111px;
	width:129px;
}
.dyw {
	position:absolute;
	z-index:4;
	#top:-1px;
}
.dyw input {
	width:113px;
	voice-family:"\"}\"";
	voice-family:inherit;
	width:110px;
	#width:107px;
}

</style>
</head>

<body>

<?php $this->load->view("./inc/header")?>


<!--中间开始-->
<div class="middle">
 <div class="middle_left">
  <div class="a">
  <div class="b">
   <div class="Search"><div class="cx"><div class="cx1">快速查询</div></div>  
   <div class="search_01">
   <form action="<?php echo base_url().'index.php/provide'?>" method="get">
     <div class="Search_lei">
        <div class="Search_lei_1">
     <ul><li ><strong style="color:#ff6308">*</strong> 所属分类：
	 
	 <input type=hidden <?php if(isset($searchInfo['catid'])){echo "value={$searchInfo['catid']}";}else{ echo "value=-1";}?>  name="catid" class="ctLast"/>
		<span class="category_sel">
		<?php 
		if(!isset($searchInfo['categorySave'])){
			$options ="";
			foreach($category as $val){
				$options .= "<option value={$val['catid']}>".$val['catname']."</option>";
			}
			echo "<select onchange='load_category(this.value)'><option value=0>全部分类</option>".$options."</select>";
		}else{
			echo $searchInfo['categorySave'];
		}
			
		?>  
		</span>

     </li>
     <li class="area"><strong  style="color:#ff6308">*</strong> 所在地区：
	 <input type=hidden  <?php if(isset($searchInfo['areaid'])) {echo "value={$searchInfo['areaid']}";}else{ echo "value=-1";}?> name="areaid" class="arLast"/>
      <span class="sel">
	  <?php 
		
			if(!isset($searchInfo['areaSave'])){
				$options ="";
				foreach($area as $val){
					$options .= "<option value={$val['areaid']}>".$val['areaname']."</option>";
				}
				echo "<select onchange='load_area(this.value)'><option>全部地区</option>".$options."</select>";
			}else{
				echo $searchInfo['areaSave'];
			}
	  ?>
	  	<select  style="margin-left:3px;"><option>全部地区</option></select>
		<select style="margin-left:3px;"><option>全部地区</option></select>
		</span>
		
       <!--地区-->  
       </li>
     </ul></div>
     <!--搜材搜企业开始-->
     <div class="sc"><ul>
     <li><input type="text" size="18" style="height:28px;margin-left:70px; _margin-left:76px;+margin-left:76px;width:300px;line-height:28px;"  name="kw" class="kw" <?php if(isset($searchInfo['kw'])){echo "value={$searchInfo['kw']}";}else{ echo "placeholder=\"输入产品名称、品牌或供应商名称\""; }?>></li> <li class="sc_1"><input type="image" src="<?php echo base_url()?>file/images/sc_an.gif" class="sell_search" onclick="javascript:void(0)"></li>
     </ul>
     </div> <!--搜材搜企业结束-->   
    </div>
	</form>
   </div>  
   </div>
   </div><!--b-->
   </div><!--a-->
   <!--产品列表开始--> 
  <div class="product">
  <!--当前START-->
     <div class="pro_ding"><div class="pro_ding_1"><ul><li>当前位置：</li><li><a href="#">建材供应</a></li></ul></div></div>
  <!--当前END-->	
  <!--信息START-->
      <div class="pro_zong">
      <!--品牌类START-->
      <div class="fanye">
		<?php echo $pagelinks;?>
	   </div>
  <!--产品START-->
  
  <?php 
	$k=0;
	foreach($item as $val){
		?>
     <div class="chanpin">
     <!--产品单图START-->
       <div class="chanpin_1">
         <div class="chanpin_1_1">
            <ul>
            <li class="tu"><a  target="_blank" title="<?php echo $val['title']?>" href="<?php echo base_url()?>index.php/cat_detail?itemid=<?php echo $val['itemid']?>"><img src="<?php if($val['thumb']!="") {echo base_url().$val['thumb'];}else if($val['thumb1']!=""){echo base_url().$val['thumb1'];}else if($val['thumb2'] != ""){echo base_url().$val['thumb2'];}else{echo base_url()."file/images/nopic.gif";}?>" alt="<?php echo $val['title']?>" width=100 height=100/></a></li>
            </ul>
            </div>      
       </div>
     <!--产品单图END-->
     <!--产品详细START-->
      <div class="chanpin_2">
      <ul>
      <li class="biaoti"><a href="<?php echo base_url()?>index.php/cat_detail?itemid=<?php echo $val['itemid']?>" target="_blank"><?php echo $val['title']?><input type='hidden' class='itmeidChanpin' value="<?php echo $val['itemid'];?>"></a></li>
      <li class="xinghao">品牌：<?php echo $val['brand']?>&nbsp;&nbsp;规格：<?php echo $val['standard']?>&nbsp;&nbsp;型号：<?php echo $val['model']?></li>      
      <li class="chandi">产地：<?php echo $val['address']?></li>
      <li class="cuxiaojia">供应：厂商&nbsp;&nbsp;实名认证：<?php if($val['validated']!=0){?><span>[已核实]</span><?php }else{?><span>[未核实]</span><?php }?></li>
      <li class="gongsi">公司名称：<?php echo $val['company']?>
	  <!--联系图标--->
	  
	 <?php if($val['qq']) {?>
		<a href="http://wpa.qq.com/msgrd?V=1&Uin=<?php echo $val['qq']?>&Site=tdjcn.com&Menu=no"><img src="http://wpa.qq.com/pa?p=1:<?php echo $val['qq']?>:4" />&nbsp;
	<?php }?>
	<?php if($val['ali']){?>
		<a target="_blank" href="http://amos.im.alisoft.com/msg.aw?v=2&uid=<?php echo $val['ali']?>&site=cntaobao&s=1&charset=utf-8" ><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo $val['ali']?>&site=cntaobao&s=1&charset=utf-8" alt="点击这里给我发消息" /></a>
	<?php }?>
	
	
	 
	   <!--联系图标--->
	  </li>
      </ul>      
      </div>
     <!--产品详细END-->
     <!--产品联系START-->
      <div class="chanpin_3">
      <ul>
	  <?php
		if($val['price'] !=0){
	  ?>
		<li class="cankaojiage">参考价格：<span><?php echo $val['unit']? $val['price']."/".$val['unit']:$val['price']?></span></li>
		<li class="jiage">促&nbsp;&nbsp;销&nbsp;&nbsp;价：<span><?php echo $val['Promotion'];?></span></li>
		
		<?php 
			}else{
			?>
			
			<li class="jiage">价格：面议</span></li>
			<?php
			}
		?>
      <li class="shijian">发布时间：<?php echo date("Y-m-d",$val['edittime'])?></li>
      <li class="xunjia"><a href="javascript:void(0)"  onclick="inqueryDialog(<?php echo $k;?>);return false;"><img src="<?php echo base_url()?>file/images/xunjia_anniu.jpg" width="70" height="19" class="inquery_btn" /></a>&nbsp;<img src="<?php echo base_url()?>file/images/lianxi_anniu.jpg" width="70" height="19" /></li>
      
      </ul>      
      </div>    
     <!--产品联系END-->
     </div>
	 
  <!--产品END-->
      <!--虚线START-->
      <div class="xuxian"></div>
	  	
		<?php
	$k++;
	}
  ?>
      <!--虚线END-->
   
    
<!--翻页START-->
  <div class="fanye">
  <?php echo $pagelinks;?>
</div>
<!--翻页END-->
      
      </div>
  <!--信息END-->
 </div>  
 <!--产品产品列表结束-->   

  </div>
 <!--左边结束-->
 <div class="middle_right">
 <!--招标开始-->
    <div class="right_t">
     <div class="right_t_1">
      <div class="right_t_2">促销产品</div>
      <div class="right_t_3">查看更多信息 >></div>
     </div></div>
    <div class="right_x">
    <!--整行产品STAT-->
     <div class="right_xx">
     <!--单个产品START-->
             <div class="right_pro">
             <ul>
             <li class="pro_biankuang"><a href="#"><img src="<?php echo base_url()?>file/images/right_cp1.jpg"></a></li>
             <li class="pro_wenzi"><a href="#">促销热品高隔断</a></li>
             </ul>
             </div>           
      <!--单个产品END-->     
           <!--单个产品START-->
             <div class="right_pr">
             <ul>
             <li class="pr_biankuang"><a href="#"><img src="<?php echo base_url()?>file/images/right_cp1.jpg"></a></li>
             <li class="pr_wenzi"><a href="#">促销热品高隔断</a></li>
             </ul>
             </div>           
      <!--单个产品END-->    
      </div>  
      <!--整行产品END-->  
          <!--整行产品STAT-->
     <div class="right_xx">
     <!--单个产品START-->
             <div class="right_pro">
             <ul>
             <li class="pro_biankuang"><a href="#"><img src="<?php echo base_url()?>file/images/right_cp1.jpg"></a></li>
             <li class="pro_wenzi"><a href="#">促销热品高隔断</a></li>
             </ul>
             </div>           
      <!--单个产品END-->     
           <!--单个产品START-->
             <div class="right_pr">
             <ul>
             <li class="pr_biankuang"><a href="#"><img src="<?php echo base_url()?>file/images/right_cp1.jpg"></a></li>
             <li class="pr_wenzi"><a href="#">促销热品高隔断</a></li>
             </ul>
             </div>           
      <!--单个产品END-->    
      </div>  
      <!--整行产品END-->  
          <!--整行产品STAT-->
     <div class="right_xx">
     <!--单个产品START-->
             <div class="right_pro">
             <ul>
             <li class="pro_biankuang"><a href="#"><img src="<?php echo base_url()?>file/images/right_cp1.jpg"></a></li>
             <li class="pro_wenzi"><a href="#">促销热品高隔断</a></li>
             </ul>
             </div>           
      <!--单个产品END-->     
           <!--单个产品START-->
             <div class="right_pr">
             <ul>
             <li class="pr_biankuang"><a href="#"><img src="<?php echo base_url()?>file/images/right_cp1.jpg"></a></li>
             <li class="pr_wenzi"><a href="#">促销热品高隔断</a></li>
             </ul>
             </div>           
      <!--单个产品END-->    
      </div>  
      <!--整行产品END-->  
    </div> 
    <!--招标结束-->
    
  
    <div class="guanggao">
    <ul>
    <li><a href="#"><img src="<?php echo base_url()?>file/images/guanggao_1.jpg" /></a></li>
    <li><a href="#"><img src="<?php echo base_url()?>file/images/guanggao_2.jpg" /></a></li>
 
    </ul>
    </div>
    <!--广告结束-->
 </div>
<!--中间右边结束-->
</div>
<!--中间结束-->

<div style="clear:both"></div>

<?php $this->load->view("./inc/footer");?>
<?php 
	if($this->auth->hasLogin()){
		$userid = $this->session->userdata('userid');
			$member = $this->memberModel->getByPk($userid);
			if($member['groupid'] == 5 || $member['groupid'] ==8 || $member['groupid'] ==1){
			
?>
<iframe id="upload_target" name="upload_target"  style="width:0;heigth:0;overflow:hidden;border:0;position: absolute; left:-500px;"></iframe>
<form action='<?php echo base_url()?>index.php/provide/addToIn' target='upload_target' method="post" enctype='multipart/form-data' onsubmit="return validate();">
<div id="sellaskdiv" style="position: absolute; width: 100%; bottom: 0px; zoom: 1; opacity: 0.6; filter:alpha(opacity=60);top: 0px; right: 0px; left: 0px; height: 2150px; z-index: 999; background-color: rgb(204, 204, 204);display:none;"></div>
<!-----
<div id="inquery" style="padding: 0px; position: fixed; border: 1px solid #dcdcdc; margin: 0px; z-index: 1001; width: 630px; background-color: rgb(255, 255, 255); font-size: 12px; left: 359.5px; top: 30px; display:none;">    ---->
<div id="inquery" style="padding: 0px; position: fixed; border: 1px solid #dcdcdc; margin: 0px; z-index: 1001; width: 630px; background-color: rgb(255, 255, 255); font-size: 12px; left: 20%; top: 30px; display:none;">
	<div style="border:;">
	<div id="" style="height:30px;background:#f9f9f9; border-bottom:1px solid #c9c9c9;line-height:30px;">
		<strong style="float:left; color:#ff6803;font-size:14px;padding-left:10px;">我的询价单</strong>
		<div style="float: right; margin-right: 10px; "><a title="管理询价单" href="<?php echo base_url()?>index.php/orderadm" style="color:#ff6803; text-decoration: none; ">管理询价单</a>&nbsp;&nbsp;&nbsp;带 <span class="red" style="color:#ff0000; line-height:30px;)">*</span> 为必填项&nbsp;<a class="close1" href="javascript:void(0)" style="color:#ff6803; text-decoration: none; ">&nbsp;&nbsp;关闭</a></div>
	</div>
	<table cellpadding="0" cellspacing="0" border="0" width="540" align='center' style=" margin-top:10px; margin-bottom:10px;">
        <tr height="40" style=" line-height:20px;">
			<td align='right'style=" color:#000000;"><span style="line-height:20px;color:#FF0000; font-weight:bold;">*&nbsp;&nbsp;</span>项目名称：</td><td class='proName'><input type="text" name="project_nameIn" class='project_nameIn' style="height:20px;width:300px; line-height:20px;"/></td>
		</tr>
        <tr height="40" style=" line-height:20px;">
			<td align='right'style=" color:#000000;"><span style="line-height:20px;color:#FF0000; font-weight:bold;">*&nbsp;&nbsp;</span>截止日期：</td><td class="endDate"><input type="text" name="end_dateIn" class='end_dateIn Wdate' value="" onclick='WdatePicker()' onfocus="WdatePicker({minDate:'%y-%M-%d',errDealMode:2})" style="height:20px;width:180px; line-height:20px;"/></td>
		</tr>
		
		<tr height="35">
			<td align='right'style="color:#000000;">地区限制：</td>
			<td class="proArea">
				<span class="area_addr_pro">
				<span>
					<input type="checkbox" name="limit_area"  onclick="toggleArea(this.checked)"/>
				</span>
				<span class="addArea" style="display:none;">
					<?php 
							$options ="";
							foreach($area as $val){
								$options .= "<option value={$val['areaid']}>".$val['areaname']."</option>";
							}
							echo "<select onchange='add_area(this.value,this.options[this.selectedIndex].text)'><option>全部地区</option>".$options."</select>";
					?>
					
				</span>
				<span class='addAreaBtn' style="display:none;"><a href="javascript:void(0);" class="addAreaArr">添加</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="areaReset">重置</a><input type="text" class="areaNameArr"  name="areaNameArr" readOnly /></span>
				</span>
				<input type="hidden" class="areaAreaid" name="areaAreaid" value="" />
				<input type="hidden" class="areaAreaidList" name="areaAreaidList" value="" />
				<input type="hidden" class="areaName" name="areaName" value="" />
				
			</td>
		</tr>
		<tr height="35" style=" line-height:20px;">
			<td align='right'style=" color:#000000;">是否限制：</td><td><input type="checkbox" name="item_limit"  /></td>
		</tr>
		<tr height="35" style=" line-height:20px;">
			<td align='right'style=" color:#000000;"><span style="line-height:20px;color:#FF0000; font-weight:bold;">*&nbsp;&nbsp;</span>材料名称：</td><td><input type="text" name="Cat_nameIn" class='Cat_nameIn' style="height:20px;width:260px; line-height:20px;"/><input type='hidden' class='itemidIn' name='itemidIn'></td>
		</tr>
		    <tr height="35" style="line-height:20px;">
			<td align='right'style=" color:#000000;">品牌：</td><td><input type="text" name="brandIn" class="brandIn"  style="height:20px;width:260px;line-height:20px;"/></td>
		</tr>
	     	<tr height="35" style="line-height:20px;">
			<td align='right' style=" color:#000000;">产品规格：</td><td><input type="text" name="standardIn" class="standardIn"  style="height:20px;width:260px;line-height:20px;"/></td>
		</tr>
		    <tr height="35" style="line-height:20px;">
			<td align='right'style=" color:#000000;">型号：</td><td><input type="text" name="modelIn" class="modelIn"  style="height:20px;width:260px;line-height:20px;" /></td>
		</tr>
        <tr height="35" style="line-height:20px;">
			<td align='right'style=" color:#000000;"><span style="line-height:20px;color:#FF0000; font-weight:bold;">*&nbsp;</span>采购数量：</td><td style="color:#000000; line-height:20px;"><input type="text" name="countIn" class='countIn' style="height:18px;width:40px;line-height:18px;;"/> &nbsp;&nbsp;单位：&nbsp;
			
				<span style="position:absolute;margin-left:0px;padding:0px;margin:0px;">
				<p class="dys">
					<select name="oks" id="oks" onchange="document.getElementById('unitIn').value=this.value;">
						<option value="斤">斤</option>
						<option value="吨">吨</option>
						<option value="克">克</option>
					</select>
				</p>
				<p class="dyw"><input type="text" name="unitIn" id="unitIn" class='unit unitIn' value="" /></p>
				</span>
				</td>
            
		</tr>
		<tr height="35" style="line-height:20px;">
			<td align='right'style=" color:#000000;">
				是否送样：
			</td>
			<td><input type="checkbox" name="sample" /></td>
		</tr>
		    <tr>
			<td align='right'style="color:#000000;">图片：</td>
			<td>
				<table cellpadding=0 cellspacing=0 border=0 id="itemPic">
					<tr height="30">
						<td><input type="file" name="url[]" /></td><!---<td><a href="javascript:void(0)" class="addPic">添加</a></td>---->
					</tr>
				</table>				
			</td>
		</tr>
		
		    <tr>
			<td align='right'style="color:#000000;">备注：</td>
			<td>
			<textarea rows="3"  cols="32" name="remarkIn"></textarea>
			</td>
		</tr>
        <tr height="35" style="line-height:20px;">
			<td align='right'style=" color:#000000;">
			
			</td>
			<td><input type="image" src="<?php echo base_url()?>file/images/wytj.gif"></td>
		</tr>
        

		
	</table>
	</div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>file/wdatepick/WdatePicker.js"></script>;
<?php }}?>
</body>
</html>