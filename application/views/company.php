<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通达建网络科技有限公司</title>
<link href="<?php echo base_url()?>file/css/top.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>file/css/company.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>file/css/foot.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url()?>file/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>file/js/placehold.js"></script>
<script type="text/javascript">
	$(function(){
		$('.kw').placeHolder();
		$(".fl_nav ul").hover(function(){
			
			$(this).children("li").addClass("fl_on");
			$(this).siblings("ul").children("li").removeClass("fl_on");
			$(this).siblings().css({"border-right":"1px solid #e4e4e4"});
			$(this).css({"border-right":"none"});
			
			$(".fl_subnav").removeClass("fl_subnav_on");
			$(".fl_subnav").eq($(this).index()).addClass("fl_subnav_on");
		})
		$(".search_btn").click(function(){
			
		})
		
		
	})
	function load_area(areaid){
		if(areaid){
			$(".arLast").val(areaid);
			$.ajax({
				url:"<?php echo base_url();?>index.php/index/ajax?areaid="+areaid
				
			}).done(function(data){
				
				if(data!=null&&data.replace(/(^\s*)|(\s*$)/g,'')!=""){
					$(".sel").html(data);
				}
			})
		}
	}
	
	function load_category(catid){
		
		if(catid.replace(/(^\s*)|(\s*$)/g,'')!=""){
		$(".ctLast").val(catid);
			$.ajax({
				url:"<?php echo base_url();?>index.php/provide/categoryAjax?catid="+catid
				
			}).done(function(data){
				
				if(data!=null&&data.replace(/(^\s*)|(\s*$)/g,'')!=""){
					$(".category_sel").html(data);
				}
			})
		}
	}
	
</script>

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
   <form action="<?php echo base_url().'index.php/company'?>" method="get">
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
			echo "<select onchange='load_category(this.value)'><option value=0>所在分类</option>".$options."</select>";
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
				echo "<select onchange='load_area(this.value)'><option>所在地区</option>".$options."</select>";
			}else{
				echo $searchInfo['areaSave'];
			}
	  ?>
		<select><option>所在地区</option></select>
		<select><option>所在地区</option></select>
		</span>
		
       <!--地区-->  
       </li>
     </ul></div>
     <!--搜材搜企业开始-->
     <div class="sc"><ul>
     <li><input type="text" size="18" style="height:28px;margin-left:80px; width:300px;line-height:28px;" name="kw" class="kw" <?php if(isset($searchInfo['kw'])){echo "value={$searchInfo['kw']}";}else{echo "placeholder=\"输入供应商名称\"";}?>></li> <li class="sc_1"><input type="image" src="<?=base_url()?>file/images/sq_an.gif" class="sell_search" onclick="javascript:void(0)"></li>
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
     <div class="pro_ding"><div class="pro_ding_1"><ul><li>当前位置：</li><li><a href="#">生产厂家</a></li></ul></div></div>
  <!--当前END-->	
  <!--信息START-->
      <div class="pro_zong">
      <!--品牌类START-->
	  <!---
       <div class="pro_pinpai">
         <div class="pro_pinpai_1"><ul><li><img src="<?php echo base_url()?>file/images/pinpai.gif" />&nbsp;</li><li><a href="#" style="color:#006698">地区</a></li></ul></div>
         
		 
         <div class="pro_pinpai_2"><ul>
         <li><img src="<?php echo base_url()?>file/images/pinpai_dian.gif" />&nbsp;<a href="#">上海(147)</a></li>
           <li><img src="<?php echo base_url()?>file/images/pinpai_dian.gif" />&nbsp;<a href="#">北京(51)</a></li>
             <li><img src="<?php echo base_url()?>file/images/pinpai_dian.gif" />&nbsp;<a href="#">天津(33)</a></li>
               <li><img src="<?php echo base_url()?>file/images/pinpai_dian.gif" />&nbsp;<a href="#">湖南(36)</a></li>
         </ul></div>
           
       </div>
	   ---->
      <!--品牌类END-->
      
   <div class="fanye" style="clear:both;"><?php echo $pageLinks;?></div>
  <!--产品START-->
  <?php
	foreach($company as $val){
  ?>
     <div class="chanpin">
     <!--产品单图START-->
       <div class="chanpin_1">
         <div class="chanpin_1_1">
            <ul>
            <li class="tu"><a href="<?php echo base_url()."index.php/homepage?companyId=".$val['userid'];?>" target="_blank"><img src="<?php echo base_url()?>file/images/cp.jpg"/></a></li>
            </ul>
            </div>      
       </div>
     <!--产品单图END-->
     <!--产品详细START-->
      <div class="chanpin_2">
      <ul>
      <li class="biaoti"><a href="<?php echo base_url()."index.php/homepage?companyId=".$val['userid'];?>" target="_blank"><span>[供应商]</span><?php echo $val['company']?></a></li>
      <li class="xinghao">经营范围：<?php echo $val['sell']?></li>      
      <li class="chandi">地&nbsp;&nbsp;&nbsp;&nbsp;址：<?php echo $val['address']?></li>
      <li class="cuxiaojia">联系方式：电话 <?php echo $val['telephone']?> 手机 <?php echo $val['mail']?></li>

      </ul>      
      </div>
     <!--产品详细END-->
     <!--产品联系START-->
      <div class="chanpin_3">
      <ul>
      <li class="jiage">商家评分：<img src="<?php echo base_url()?>file/images/hx.gif"/><img src="<?php echo base_url()?>file/images/hx.gif"/><img src="<?php echo base_url()?>file/images/hx.gif"/><img src="<?php echo base_url()?>file/images/hx.gif"/>&nbsp;3.9分</li>
      <li class="shijian">实名认证：<img src="<?php echo base_url()?>file/images/keshi.gif" /></li>
      <li class="xunjia">现有产品数：<span>686</span>个</li>
      </ul>      
      </div>    
     <!--产品联系END-->
     </div>
  <!--产品END-->     <!--虚线START-->
      <div class="xuxian"></div>
      <!--虚线END-->  
   <?php }?>
   <div class="fanye" style="clear:both;"><?php echo $pageLinks;?></div>
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
      <div class="right_t_2">商家推荐</div>
      <div class="right_t_3">查看更多信息 >></div>
     </div></div>
    <div class="right_x">
      <ul>
      <li><a href="#">推荐 佛山市顺德区朗晟不锈钢有限公司 </a></li>
      <li><a href="#">推荐 佛山市顺德区朗晟不锈钢有限公司 </a></li>
      <li><a href="#">推荐 佛山市顺德区朗晟不锈钢有限公司 </a></li>
      <li><a href="#">推荐 佛山市顺德区朗晟不锈钢有限公司 </a></li>
      <li><a href="#">推荐 佛山市顺德区朗晟不锈钢有限公司 </a></li>
      <li><a href="#">推荐 佛山市顺德区朗晟不锈钢有限公司 </a></li>
      <li><a href="#">推荐 佛山市顺德区朗晟不锈钢有限公司 </a></li>
      <li><a href="#">推荐 佛山市顺德区朗晟不锈钢有限公司 </a></li>      
      </ul>
    </div> 
    <!--招标结束-->
    
  
    <div class="guanggao">
    <ul>
    <li><a href="#"><img src="<?php echo base_url()?>file/images/guanggao_1.jpg" /></a></li>
    </ul>
    </div>
    <!--广告结束-->
     <!--招标开始-->
    <div class="right_t">
     <div class="right_t_1">
      <div class="right_t_2">推荐品牌</div>
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
       
    </div> 
    <!--招标结束-->
 </div>
<!--中间右边结束-->
</div>
<!--中间结束-->
<div style="clear:both"></div>
<?php $this->load->view("./inc/footer")?>


</body>
</html>