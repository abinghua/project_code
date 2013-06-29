<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通达建网络科技有限公司</title>
<link href="<?php echo base_url()?>file/css/top.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>file/css/css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>file/css/foot.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url()?>file/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
var base_url = "<?php echo base_url()?>";
</script>
<script type="text/javascript" src='<?php echo base_url()?>file/js/index.js'></script>

</head>

<body>
<?php $this->load->view("./inc/header")?>
<!--中间开始-->
<div class="middle">
 <div class="middle_left">
   <div class="Search"><div class="cx"><div class="cx1">快速查询</div></div>  
   <div class="search_01">
     <div class="Search_lei">
         <div class="Search_lei_1">
     <ul><li ><strong style="color:#ff6308">*</strong> 所属分类：
	 
	 <input type=hidden value=-1  name="catid" class="ctLast"/>
		<span class="category_sel">
		<?php 
		
			$options ="";
			foreach($category as $val){
				$options .= "<option value={$val['catid']}>".$val['catname']."</option>";
			}
			echo "<select onchange='load_category(this.value)'><option value=0>全部分类</option>".$options."</select>";
		
		?>  
		</span>

     </li>
     <li class="area"><strong  style="color:#ff6308">*</strong> 所在地区：
	 <input type=hidden  value=-1 name="areaid" class="arLast"/>
      <span class="sel">
			<?php 
				$options ="";
				foreach($area as $val){
					$options .= "<option value={$val['areaid']}>".$val['areaname']."</option>";
				}
				echo "<select onchange='load_area(this.value)'><option>所有地区</option>".$options."</select>";
			 ?>
			 <select style="margin-left:3px;"><option>所有地区</option></select>
			 <select style="margin-left:3px;"><option>所有地区</option></select>
		</span>
		
       <!--地区-->  
       </li>
     </ul></div>
     <!--搜材搜企业开始-->
     <div class="sc"><ul>
     <li><input type="text" size="18" style="height:28px; line-height:28px;border:1px solid #C9C9C9;" name="kw" value="" class="provide_kw" ></li> <li class="sc_1"><input type="image" src="<?php echo base_url()?>file/images/sc_an.gif" class="provide_btn" ></li>
     </ul>
     </div> <!--搜材搜企业结束-->     <!--搜材搜企业开始-->
     <div class="sq"><ul>
     <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="18" style="height:28px; line-height:28px;border:1px solid #C9C9C9;" name="maxprice" value="" class="company_kw"></li> <li class="sq_1"><input type="image" src="<?php echo base_url()?>file/images/sq_an.gif" class="company_btn"></li>
     </ul>
     </div> <!--搜材搜企业结束-->
     <div class="gx"><li>&nbsp;<input type="checkbox"  name="remember" id="remember" />&nbsp;厂商</li>
     <li>&nbsp;<input type="checkbox" name="remember" id="remember" />&nbsp;经销商</li></ul></div>

    </div>   
   </div>  
   </div>
   
<!--产品分类开始--> 

 <div class="fenlei">
	
	<div class="fl">
		<div class="fl1">所有产品分类</div>
		
	</div>
	<div class="fenlei_01">
		<div class="fl_nav">
		
		<?php
			$j=0;
			foreach($category as $val){
			$j++;
		?>
				
			<ul <?php if($j==1) {echo " style='border-right:none;'";} ?> >
					<li class="fl_title <?php if($j==1) echo " fl_on";?>"><a href="<?php echo base_url()."index.php/provide?catid=".$val['catid']?>" target="_blank"><?php echo $val['catname']?></a></li><li class="fl_pic fl_on">>></li>
			</ul>
				<?php
			}
		?>
		
		</div>
		<?php
			$k=0;
			foreach($category as $val){
				$k++;
				?>
				<div class="fl_subnav <?php if($k==1){?>fl_subnav_on<?php }?>">
				
							<?php
								$catid=$val['catid'];
								$i = 1;
								
								foreach($one as $key =>$sub){
									
									$catid2=$sub['parentid'];
									if($catid==$catid2){
									?>
									<div class="fl_son" <?php if($i==1){echo "style='border:none;'";}?>>
										<h6><a href="<?php echo base_url()."index.php/provide?catid=".$sub['catid'];?>" target="_blank"><?php echo $sub['catname']?></a></h6>
										
										<ul >
										<?php 
											foreach($sub as $val2){
													if(is_array($val2)){
														
														$text=$val2['catname'];
										?>
															
															<li>&nbsp;|&nbsp;<a href="<?php echo base_url()."index.php/provide?catid=".$val2['catid']?>" target="_blank"><?php echo $text?></a></li>
										<?php 
													}
											}
										?>
										</ul>
									</div>
							<?php 	
									$i++;
									}
									$index=$catid;
									
								}
							?>		
				
				</div>		
				<?php
			}
		?>
		
	
	</div>
	
 </div>	
 
 <!--产品分类结束-->   
  </div>
 <!--左边结束-->
 <div class="middle_right">
 <!--招标开始-->
    <div class="right_t">
     <div class="right_t_1">
      <div class="right_t_2">材料招标</div>
      <div class="right_t_3">查看更多信息 >></div>
     </div></div>
    <div class="right_x"><div class="right_xx">
				<ul>                       	
					<li class="sg"><span class="sg_name" style="color:black;font-weight:bold;">状态</span><span class="xiangmu_title" ><a href="#" style="color:black;font-weight:bold;">项目标题</a></span><span class="xiangmu_date" style="text-align:right;color:black;font-weight:bold;">截止日期</span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">完结</span><span class="xiangmu_title"><a href="#">山东佳能第一期项目</a></span><span class="xiangmu_date">2012-09-08</span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">进行</span><span class="xiangmu_title"><a href="#">通达建南山蛇口公园首期项目</a></span><span class="xiangmu_date">2012-09-08</span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">进行</span><span class="xiangmu_title"><a href="#">通达建南山首期项目</a></span><span class="xiangmu_date">2012-09-08</span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">进行</span><span class="xiangmu_title"><a href="#">通达建南山首期项目</a></span><span class="xiangmu_date">2012-09-08</span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">进行</span><span class="xiangmu_title"><a href="#">山东佳能第一期项目</a></span><span class="xiangmu_date">2012-09-08</span></li>
                </ul>
	
               
               </div>    
    </div> 
    <!--招标结束-->
    
    <!--融资开始-->
    <div class="right_z">
     <div class="right_z_1">
      <div class="right_z_2">融资需求</div>
      <div class="right_z_3">查看更多信息 >></div>
     </div></div>
    <div class="right_zb"><div class="right_zbx">
                               <ul>            
            	<li class="zhuangtai">项目&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li class="xiangmu">&nbsp;&nbsp;金额(万元)</li>
                 <li class="xiangmu">&nbsp;&nbsp;方式</li>
                <li class="riqi">地区</li>
                </ul>
                                <ul>            
            	<li class="rongzi_1"><a href="#">白酒网络推广项目&nbsp;&nbsp;&nbsp;</a></li>
                <li class="jine">&nbsp;&nbsp;700.00</li>
                 <li class="konggu">控股</li>
                <li class="diqu">湖北省</li>
                </ul>
                                                <ul>            
            	<li class="rongzi_1"><a href="#">动漫服装生产项目&nbsp;&nbsp;&nbsp;</a></li>
                <li class="jine">&nbsp;&nbsp;50.00</li>
                 <li class="konggu">控股</li>
                <li class="diqu">湖北省</li>
                </ul>
                                                <ul>            
            	<li class="rongzi_1"><a href="#">动漫服装生产项目&nbsp;&nbsp;&nbsp;</a></li>
                <li class="jine">&nbsp;&nbsp;500.00</li>
                 <li class="konggu">控股</li>
                <li class="diqu">湖北省</li>
                </ul>
                                                <ul>            
            	<li class="rongzi_1"><a href="#">动漫服装生产项目&nbsp;&nbsp;&nbsp;</a></li>
                <li class="jine">&nbsp;&nbsp;80.00</li>
                 <li class="konggu">控股</li>
                <li class="diqu">湖北省</li>
                </ul>
                                                <ul>            
            	<li class="rongzi_1"><a href="#">动漫服装生产项目&nbsp;&nbsp;&nbsp;</a></li>
                <li class="jine">&nbsp;&nbsp;90.00</li>
                 <li class="konggu">控股</li>
                <li class="diqu">湖北省</li>
                </ul>
                                                <ul>            
            	<li class="rongzi_1"><a href="#">动漫服装生产项目&nbsp;&nbsp;&nbsp;</a></li>
                <li class="jine">&nbsp;&nbsp;100.00</li>
                 <li class="konggu">控股</li>
                <li class="diqu">湖北省</li>
                </ul>
               
                     </div>  
    </div> <!--融资结束-->
    <div class="guanggao">
		<a href="#"><img src="<?php echo base_url()?>file/images/guanggao_1.jpg" /></a>
    </div>
    <!--广告结束-->
    <!--中标开始-->
    <div class="right_t" style="margin-top:9px;">
     <div class="right_t_1">
      <div class="right_t_2">中标</div>
      <div class="right_t_3">查看更多信息 >></div>
     </div></div>
    <div class="right_gongxi"><div class="right_xx">
				<ul>                       	
					<li class="sg"><span class="sg_name">中标</span><span><a href="#">恭喜通****网络科技有限公司成功中标</a></span></li>
                </ul>
                <ul>                       	
					<li class="sg"><span class="sg_name">中标</span><span><a href="#">恭喜通****网络科技有限公司成功中标</a></span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">中标</span><span><a href="#">恭喜通****网络科技有限公司成功中标</a></span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">中标</span><span><a href="#">恭喜通****网络科技有限公司成功中标</a></span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">中标</span><span><a href="#">恭喜通****网络科技有限公司成功中标</a></span></li>
                </ul>				
								
                              
               </div>    
    </div> 
    <!--中标结束-->
       <!--投融资公告开始-->
       <div class="ewqe">
    <div class="right_t">
     <div class="right_t_1">
      <div class="right_t_trz">投融资公告</div>
      <div class="right_t_3">查看更多信息 >></div>
     </div></div>
    <div class="right_tourongzi"><div class="right_xx">
                <ul>                       	
					<li class="sg"><span class="sg_name">王***</span><span><a href="#">已成功申购<font style="color:red">10万元</font>整</a></span></li>
                </ul>
                <ul>                       	
					<li class="sg" ><span class="sg_name">王***</span><span><a href="#">已成功申购<font style="color:red">10万元</font>整</a></span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">王***</span><span><a href="#">已成功申购<font style="color:red">10万元</font>整</a></span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">王***</span><span><a href="#">已成功申购<font style="color:red">10万元</font>整</a></span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">王***</span><span><a href="#">已成功申购<font style="color:red">10万元</font>整</a></span></li>
                </ul>
				<ul>                       	
					<li class="sg"><span class="sg_name">王***</span><span><a href="#">已成功申购<font style="color:red">10万元</font>整</a></span></li>
                </ul>
                           

                              
               </div>    
    </div> </div>
    <!--投融资公告结束-->
 </div>
<!--中间右边结束-->
</div>
<!--中间结束-->

<div style="clear:both"></div>
<div class="cuxiao">
   <div class="cuxiao_1">
     <div class="cxcp"><ul><li class="cscp_title cscp_title_on"><a href="#">团购产品</a></li><li class="cscp_title"><a href="#">促销产品</a></li><li class="cscp_title"><a href="#">新品上架</a></li><li style="width:713px;border-right:none;"></li></ul></div>   
     <div class="cuxiao_1_1">
       <div class="cpfl">
         <!--产品列表开始-->
         <div class="cpfl_1">
          <ul>
          <li>截止：<span>2012年12月12号</span></li>
  
          <li><a href="#"><img src="<?php echo base_url()?>file/images/cp1.jpg"/></a></li>
          <li><a href="#">直降300 花之恋地板</a></li>
          <li class="cp_s">抢购价：<a href="#">￥188.00元</a></li>          
          </ul>
         </div>
         <!--产品列表结束-->
                  <!--产品列表开始-->
         <div class="cpfl_1">
          <ul>
          <li>截止：<span>2012年12月12号</span></li>
  
          <li><a href="#"><img src="<?php echo base_url()?>file/images/cp1.jpg"/></a></li>
          <li><a href="#">直降300 花之恋地板</a></li>
          <li class="cp_s">抢购价：<a href="#">￥188.00元</a></li>          
          </ul>
         </div>
         <!--产品列表结束-->
                  <!--产品列表开始-->
         <div class="cpfl_1">
          <ul>
          <li>截止：<span>2012年12月12号</span></li>
  
          <li><a href="#"><img src="<?php echo base_url()?>file/images/cp1.jpg"/></a></li>
          <li><a href="#">直降300 花之恋地板</a></li>
          <li class="cp_s">抢购价：<a href="#">￥188.00元</a></li>          
          </ul>
         </div>
         <!--产品列表结束-->
                  <!--产品列表开始-->
         <div class="cpfl_1">
          <ul>
          <li>截止：<span>2012年12月12号</span></li>
  
          <li><a href="#"><img src="<?php echo base_url()?>file/images/cp1.jpg"/></a></li>
          <li><a href="#">直降300 花之恋地板</a></li>
          <li class="cp_s">抢购价：<a href="#">￥188.00元</a></li>          
          </ul>
         </div>
         <!--产品列表结束-->
                  <!--产品列表开始-->
         <div class="cpfl_1">
          <ul>
          <li>截止：<span>2012年12月12号</span></li>
  
          <li><a href="#"><img src="<?php echo base_url()?>file/images/cp1.jpg"/></a></li>
          <li><a href="#">直降300 花之恋地板</a></li>
          <li class="cp_s">抢购价：<a href="#">￥188.00元</a></li>          
          </ul>
         </div>
         <!--产品列表结束-->
                         
       </div><!--详细产品结束-->
     </div>   
  </div>
 </div>
<!--促销结束-->



<?php $this->load->view("./inc/footer")?>


</body>
</html>