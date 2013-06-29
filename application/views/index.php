<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通达建网络科技有限公司</title>
<link href="<?php echo base_url()?>file/css/top.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>file/css/css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>file/css/foot.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url()?>file/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>file/js/placehold.js"></script>
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
 <div class="a">
  <div class="b">
   <div class="Search"><div class="cx"><div class="cx1">快速查询</div></div>  
    <div class="search_01">
     <div class="Search_lei">
      <!--地区--> 
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
				echo "<select onchange='load_area(this.value)'><option>全部地区</option>".$options."</select>";
			 ?>
			 <select style="margin-left:3px;"><option>全部地区</option></select>
			 <select style="margin-left:3px;"><option>全部地区</option></select>
		</span>  
       </li>
     </ul></div>
     <!--地区-->  
     
     <!--搜材搜企业开始-->
     <div class="sc"><ul>
     <li><input type="text" size="28" style="height:28px; line-height:28px;border:1px solid #C9C9C9;" name="kw"  class="provide_kw"  placeholder="输入产品名称"></li> <li class="sc_1"><input type="image" src="<?php echo base_url()?>file/images/sc_an.gif" class="provide_btn" ></li>
     </ul>
     </div>
      <!--搜材搜企业结束--> 
         
      <!--搜材搜企业开始-->
     <div class="sq"><ul>
     <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="28" style="height:28px; line-height:28px;border:1px solid #C9C9C9;" name="maxprice"  class="company_kw" placeholder="输入供应商名称"></li> <li class="sq_1"><input type="image" src="<?php echo base_url()?>file/images/sq_an.gif" class="company_btn"></li>
     </ul>
     </div>
     <!--搜材搜企业结束-->
     
     <!--<div class="gx"><li>&nbsp;<input type="checkbox"  name="remember" id="remember" />&nbsp;厂商</li>
     <li>&nbsp;<input type="checkbox" name="remember" id="remember" />&nbsp;经销商</li></ul></div> -->
     
    </div><!--Search_leiEND--> 
   </div><!--search_01END--> 
   </div><!--SearchEND-->
   </div><!--b-->
   </div><!--a-->
<!--产品分类开始--> 
 <div class="a">
 <div class="b">
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
	
 </div> <!--产品分类结束-->   
 </div><!--b-->
 </div><!--a-->

  </div>
 <!--左边结束-->
 <div class="middle_right">
  <!--项目询价开始-->
    <div class="a">
    <div class="b">
    <div class="c">
    <div class="right_z">
    
      <!--标题S-->
      <div class="right_z_1">
       <div class="right_z_1_1"><a href="#">项目询价</a></div><div class="right_z_1_2"></div>  
      </div><!--标题E-->
      <!--内容S-->
      <!--类标题S-->
      <div class="right_z_xm">
      <ul>
      <li class="xm1">状态</li>
      <li class="xm2">项目标题</li>
      <li class="xm3">截止日期</li>
      </ul>
      </div>
       <!--类标题E-->
     <Marquee direction="up" height="130px" ONMOUSEOUT=this.start() 
ONMOUSEOVER=this.stop() scrollamount="2" >
      <div class="gundong"><!--滚动-->
      <div class="right_z_2">
       <div class="right_z_2_1">
       <ul>
           <li class="rongzi_wj1">完结</li>
           <li class="rongzi_wj1">完结</li>
           <li class="rongzi_wj2">进行</li>
           <i class="rongzi_wj2">进行</li>
           <li class="rongzi_wj2">进行</li></ul>
       </div>         
       
              <div class="right_z_2_3">
       <ul>
           <li class="rongzi_xmbt"><a href="#">通达建网络科技有限公司</a></li>
           <li class="rongzi_xmbt"><a href="#">通达建网络科技有限公司</a></li>
           <li class="rongzi_xmbt"><a href="#">通达建网络科技有限公司</a></li>
           <li class="rongzi_xmbt"><a href="#">通达建网络科技有限公司</a></li>
           <li class="rongzi_xmbt"><a href="#">通达建网络科技有限公司</a></li></ul>
       </div>  
       
                     <div class="right_z_2_3">
       <ul>
           <li class="rongzi_xmrq">2012-10-30</li>
           <li class="rongzi_xmrq">2012-10-30</li>
           <li class="rongzi_xmrq">2012-10-30</li>
           <li class="rongzi_xmrq">2012-10-30</li>
           <li class="rongzi_xmrq">2012-10-30</li></ul>
       </div> 
       </div><!--内容E--> 
      </div></Marquee><!--滚动-->
     
    </div><!--项目询价结束-->
    </div><!--a-->
    </div><!--b-->
    </div><!--c-->
    
    <!--融资开始-->
    <div class="a">
    <div class="b">
    <div class="c">
    <div class="right_z">
    
      <!--标题S-->
      <div class="right_z_1">
       <div class="right_z_1_1"><a href="#">融资需求</a></div><div class="right_z_1_2"></div>  
      </div><!--标题E-->
      <!--内容S-->
      <!--类标题S-->
      <div class="right_z_lei">
      <ul>
      <li class="lei1">项目</li>
      <li class="lei2">金额（万元）</li>
      <li class="lei3">方式</li>
      <li class="lei3">地区</li>
      </ul>
      </div>
       <!--类标题E-->
      <Marquee direction="up" height="130px" scrolldelay="4" ONMOUSEOUT=this.start() 
ONMOUSEOVER=this.stop() scrollamount="2" >
      <div class="gundong"><!--滚动-->
      <div class="right_z_2">
       <div class="right_z_2_1">
       <ul>
           <li class="rongzi_ys"><a href="#">通达建网络科技有限公司</a></li>
           <li class="rongzi_ys"><a href="#">通达建网络科技有限公司</a></li>
           <li class="rongzi_ys"><a href="#">通达建网络科技有限公司</a></li>
           <li class="rongzi_ys"><a href="#">通达建网络科技有限公司</a></li>
           <li class="rongzi_ys"><a href="#">通达建网络科技有限公司</a></li></ul>
       </div>  
       
       <div class="right_z_2_2">
       <ul>
           <li class="rongzi_sz">700.00</li>
           <li class="rongzi_sz">500.00</li>
           <li class="rongzi_sz">600.00</li>
           <li class="rongzi_sz">400.00</li>
           <li class="rongzi_sz">30.00</li></ul>
       </div>  
       
              <div class="right_z_2_3">
       <ul>
           <li class="rongzi_kg">控股</li>
           <li class="rongzi_kg">控股</li>
           <li class="rongzi_kg">控股</li>
           <li class="rongzi_kg">控股</li>
           <li class="rongzi_kg">控股</li></ul>
       </div>  
       
                     <div class="right_z_2_3">
       <ul>
           <li class="rongzi_kg">深圳</li>
           <li class="rongzi_kg">长沙</li>
           <li class="rongzi_kg">北京</li>
           <li class="rongzi_kg">上海</li>
           <li class="rongzi_kg">武汉</li></ul>
       </div> 
       </div><!--内容E--> 
      </div></Marquee><!--滚动-->
     
    </div><!--融资结束-->
    </div><!--a-->
    </div><!--b-->
    </div><!--c-->
    
    
    <div class="guanggao">
		<a href="#"><img src="<?php echo base_url()?>file/images/guanggao_1.jpg" /></a>
    </div>
    <!--广告结束-->
    
    <!--成交公告开始-->
    <div class="a">
    <div class="b">
    <div class="c">
    <div class="cjgg">
    
      <!--标题S-->
      <div class="cjgg_1">
       <div class="cjgg_1_1"><a href="#">成交公告</a></div><div class="cjgg_1_2"></div>  
      </div><!--标题E-->
      <!--内容S-->
      <!--类标题S-->
      <div class="cjgg_xm">
      <ul>
      <li class="xm1">状态</li>
      <li class="xm2">项目标题</li>
      <li class="xm3">成交日期</li>
      </ul>
      </div>
       <!--类标题E-->

      <div class="gundong"><!--滚动-->
      <div class="cjgg_2">
       <div class="cjgg_2_1">
       <ul>
           <li class="rongzi_wj1">成交</li>
           <li class="rongzi_wj1">成交</li>
           <li class="rongzi_wj1">成交</li>
           <li class="rongzi_wj1">成交</li>
           <li class="rongzi_wj1">成交</li>
           <li class="rongzi_wj1">成交</li></ul>
       </div>         
       
              <div class="cjgg_2_3">
       <ul>
           <li class="rongzi_xmbt"><a href="#">北京万代公园材料成交成功</a></li>
           <li class="rongzi_xmbt"><a href="#">上海现代园林装饰工程材料成交成功</a></li>
           <li class="rongzi_xmbt"><a href="#">长沙烈士公园重修二期项目成交成功</a></li>
           <li class="rongzi_xmbt"><a href="#">深圳南山影剧院一期项目成交成功</a></li>
           <li class="rongzi_xmbt"><a href="#">广州白云机场修缮材料成交成功</a></li>
           <li class="rongzi_xmbt"><a href="#">广州白云机场修缮材料成交成功</a></li></ul>
       </div>  
       
                     <div class="cjgg_2_3">
       <ul>
           <li class="rongzi_xmrq">2012-10-30</li>
           <li class="rongzi_xmrq">2012-10-30</li>
           <li class="rongzi_xmrq">2012-10-30</li>
           <li class="rongzi_xmrq">2012-10-30</li>
           <li class="rongzi_xmrq">2012-10-30</li>
            <li class="rongzi_xmrq">2012-10-30</li></ul>
       </div> 
       </div><!--内容E--> 
      </div><!--滚动-->
     
    </div><!--成交公告结束-->
    </div><!--a-->
    </div><!--b-->
    </div><!--c-->
    
     <!--投融资公告开始-->
    <div class="a">
    <div class="b">
    <div class="c">
    <div class="cjgg">
    
      <!--标题S-->
      <div class="cjgg_1">
       <div class="cjgg_1_1"><a href="#">投融资公告</a></div><div class="cjgg_1_2"></div>  
      </div><!--标题E-->
      <!--内容S-->
      <!--类标题S-->
      <div class="cjgg_xm">
      <ul>
      <li class="xm1">状态</li>
      <li class="xm2">项目简介</li>
      <li class="xm3">申购金额</li>
      </ul>
      </div>
       <!--类标题E-->

      <div class="gundong"><!--滚动-->
      <div class="cjgg_2">
       <div class="cjgg_2_1">
       <ul>
           <li class="rongzi_wj1">成功</li>
           <li class="rongzi_wj1">成功</li>
           <li class="rongzi_wj1">成功</li>
           <li class="rongzi_wj1">成功</li>
           <li class="rongzi_wj1">成功</li>
           <li class="rongzi_wj1">成功</li></ul>
       </div>         
       
              <div class="cjgg_2_3">
       <ul>
           <li class="rongzi_xmbt"><a href="#">北京万代公园材料成交成功</a></li>
           <li class="rongzi_xmbt"><a href="#">上海现代园林装饰工程材料成交成功</a></li>
           <li class="rongzi_xmbt"><a href="#">长沙烈士公园重修二期项目成交成功</a></li>
           <li class="rongzi_xmbt"><a href="#">深圳南山影剧院一期项目成交成功</a></li>
           <li class="rongzi_xmbt"><a href="#">广州白云机场修缮材料成交成功</a></li>
           <li class="rongzi_xmbt"><a href="#">广州白云机场修缮材料成交成功</a></li></ul>
       </div>  
       
                     <div class="cjgg_2_3">
       <ul>
           <li class="rongzi_xmrq">500万</li>
           <li class="rongzi_xmrq">2200万</li>
           <li class="rongzi_xmrq">1200万</li>
           <li class="rongzi_xmrq">1300万</li>
           <li class="rongzi_xmrq">168万</li>
            <li class="rongzi_xmrq">280万</li></ul>
       </div> 
       </div><!--内容E--> 
      </div><!--滚动-->
     
    </div><!--成交公告结束-->
    </div><!--a-->
    </div><!--b-->
    </div><!--c-->
 </div>
<!--中间右边结束-->
</div>
<!--中间结束-->

<div style="clear:both"></div>
    <div class="d">
    <div class="a">
    <div class="b">
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
 </div><!--促销结束-->
 </div><!--a-->
 </div><!--b-->
 </div><!--d-->




<?php $this->load->view("./inc/footer")?>


</body>
</html>