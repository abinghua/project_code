<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>供应商模版</title>
<link href="<?php echo base_url()?>file/css/moble.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url()?>file/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	$(function(){
		$(".menu_1_2 li").click(function(){
			$(this).addClass("menu_s").siblings().removeClass("menu_s");
			index = $(this).index();
			$(".company_2").eq(index).addClass("homepage_sel_on").siblings().removeClass("homepage_sel_on");
			
		})
	})
</script>
</head>

<body>
<!--顶部STAR-->
<div class="top">
  <!--站注START-->
  <div class="top_1">
   <div class="top_1_1">
    <ul>
    <li style="margin-right:120px;">欢迎来到通达建一站式建材采购服务平台！</li>
    <li class="t_1"><a href="#">平台首页</a>&nbsp;|&nbsp;</li>
      <li><a href="#">建材采购</a>&nbsp;|&nbsp;</li>
        <li><a href="#">建材供应</a>&nbsp;|&nbsp;</li>
          <li><a href="#">蜂巢社区</a>&nbsp;|&nbsp;</li>
            <li><a href="#">融资服务&nbsp;</a></li>
              <li>咨询热线：400-003-5006&nbsp;</li>
                <li class="t_1"><a href="#">[请登录]</a>&nbsp;</li>
                  <li class="t_1"><a href="#">[注册中心]</a></li>
    </ul>
   </div><!--top_1_1END-->
  </div>
  <!--站注END-->
  <!--搜索START-->
  <div class="top_2"><!--背景-->
    <div class="top_2_1">
       <div class="t_logo"><img src="<?php echo base_url()?>file/img/logo.jpg" width="160" height="48" /></div>
       <div class="cailiao">
       <ul>
       <li><a href="#"><span>五金</span></a>&nbsp;<a href="#">油漆涂料</a>&nbsp;<a href="#">厨房卫浴</a>&nbsp;<a href="#">家居家具</a> </li>
          <li><a href="#">五金</a>&nbsp;<a href="#"><span>油漆涂料</span></a>&nbsp;<a href="#">厨房卫浴</a>&nbsp;<a href="#"><span>家居家具</span></a> </li>
       </ul>
       
       </div>
       <!--2_1END-->
     <div class="top_2_2">
     <ul>
     <li><input type="text" size="30" style="height:26px; text-align:center; color:#cccccc; line-height:26px;" name="maxprice" value="请输入产品\企业名称"></li>
     <li><input type="image" src="<?php echo base_url()?>file/img/sc.gif">&nbsp;</li>
     <li><input type="image" src="<?php echo base_url()?>file/img/sq.gif"></li>
     </ul>     
     </div>
    </div>  
  </div><!--搜索END-->
</div>
<!--顶部END-->
<!--供应商logo开始-->
<div class="g_logo">
  <div class="g_logo_1">
    <div class="logo"><img src="<?php echo base_url()?>file/img/logo_g.jpg" width="299" height="52" /></div>      
  </div>
</div>
<!--供应商logo结束-->

<!--导航START-->
<div class="menu">
  <div class="menu_1">
    <div class="menu_1_1"><img src="<?php echo base_url()?>file/img/gysxx.jpg" width="269" height="52" /></div><!--1_1END-->
    <div class="menu_1_2">
      <ul>
      <li class="menu_s"><a href="javascript:void(0)">网站首页</a></li>
       <li><a href="javascript:void(0)">产品中心</a></li>
        <li><a href="javascript:void(0)">在线询价</a></li>
         <li><a href="javascript:void(0)">联系我们</a></li>
      </ul>    
    </div><!--1_2END-->   
  </div>
</div>
<!--导航END-->
<!--公司简介START-->
<div class="company">
 <div class="company_0">
 <div class="company_1">
  <div class="company_1_1">
  <ul>
   <li><img src="<?php echo base_url()?>file/img/jt.gif"/>&nbsp;<span><?php echo $company[0]['company']?></span></li>
   <li><img src="<?php echo base_url()?>file/img/jt.gif"/>&nbsp;经营模式：供应商</li>
   <li><img src="<?php echo base_url()?>file/img/jt.gif"/>&nbsp;所在地区：<?php echo $company[0]['address']?></li>
   <li><img src="<?php echo base_url()?>file/img/jt.gif"/>&nbsp;商家评分：<img src="<?php echo base_url()?>file/img/hx.gif"  /><img src="<?php echo base_url()?>file/img/hx.gif" /><img src="<?php echo base_url()?>file/img/hx.gif"  />2.9分</li>
   <li><img src="<?php echo base_url()?>file/img/jt.gif"/>&nbsp;<span>满&nbsp;意&nbsp;度：100%</span></li>
   <li>......................................</li>
   <li><img src="<?php echo base_url()?>file/img/yj.gif" width="16" height="12" />&nbsp;邮件：<?php echo $company[0]['mail']?></li>
   <li><img src="<?php echo base_url()?>file/img/dh.gif" width="16" height="12" />&nbsp;电话：<?php echo $company[0]['telephone']?></li>
   <li><img src="<?php echo base_url()?>file/img/cz.gif" width="16" height="12" />&nbsp;传真：<?php echo $company[0]['fax']?></li>
   <li><img src="<?php echo base_url()?>file/img/qq.gif" width="16" height="16" />&nbsp;QQ：</li>
   <li><input type="image" src="<?php echo base_url()?>file/img/zxxj.jpg"></li>
  </ul>
 </div>
 </div><!--1END-->
  <!---详细介绍--->
  <div class="company_2 homepage_sel_on">
    <div class="company_2_1"><ul>
    <li><img src="<?php echo base_url()?>file/img/gsjj.gif" width="76" height="21" /></li>
    
    </ul>    
    </div>
        <div class="company_2_2">
			<?php echo $indtroduce[0]['content']?>
    </div>
  </div><!--company_2END-->
  <!---产品中心--->
    <div class="company_2">
    <div class="company_2_1"><ul>
    <li><img src="<?php echo base_url()?>file/img/gsjj.gif" width="76" height="21" /></li>
    
    </ul>    
    </div>
        <div class="company_2_2">
  <p>&nbsp;&nbsp;直接粘贴在裂缝表面，抗三远路桥企业是一家专注于道路施工、养护材料研发、化工及沥青产品研发、生产销售的股份制企业。下设三远中交（北京）路桥工程有限公司和三远路桥加工厂。</p>
  <p>&nbsp; 公司重组于2008年中国奥运之年，经过将旗下产业有效的整合，使公司的资源更有效投入到公路建设及养护行业。    </p>
  <p>&nbsp;&nbsp;公司致力于公路养护行业，力求不断的将国内外的新材料、新工艺、新技术引进中国，将简便、快捷、低成本、高效益的新产品技术应用在实际施工养护工作当中。提升路面建设及养护的质量，为国内广大筑、养路工作者带来更大的工作便利。    </p>
  <p>&nbsp;&nbsp;公司在山东、四川、云南建立了销售办事处及分公司，产品及服务在高速、公路、市政上的使用得到了用户的认可和好评。
    衷远不变的服务、久远信赖的朋友、恒远质量的产品成为三远人永远不变的承诺！ </p>
  </ul>    
    </div>
  </div><!--company_2END-->
   <!---在线询价--->
    <div class="company_2">
    <div class="company_2_1"><ul>
    <li><img src="<?php echo base_url()?>file/img/xunjia.gif" width="76" height="21" /></li>
    
    </ul>    
    </div>
        <div class="company_2_2">
  <p>询价标题：<input type="text" name="title" value="我对您发布的“供应xxxxxxxxxxxxx”很感兴趣" size="45、0" id="title" class="pd3">&nbsp;建议修改主题，吸引注意,得到优先回复!</p>
  <p>我想了解：<input type="checkbox" name="type[]" value="单价" id="type_0" checked=""><label for="type_0"> 单价</label>&nbsp;
  <input type="checkbox" name="type[]" value="产品规格" id="type_1" checked=""><label for="type_1"> 产品规格</label>&nbsp;
  <input type="checkbox" name="type[]" value="型号" id="type_2" checked=""><label for="type_2"> 型号</label>&nbsp;
  <input type="checkbox" name="type[]" value="原产地" id="type_3" checked=""> <label for="type_3"> 原产地</label>   </p>
  <p>主要内容：<textarea rows="5" cols="60" name="content" id="content" class="pd3"></textarea>    </p>
  <p>联 系 人：<input type="text" name="truename" size="25" id="truename">  </p>
  <p>联系电话：<input type="text" name="telephone" size="25" id="telephone">  </p>
  <p>电子邮箱：<input type="text" name="email" size="25" id="email">  </p>
  <p>Q&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Q：<input type="text" size="20" name="qq" id="qq">  </p>
  <p class="juli"> <input type="submit" name="submit" value=" 发送询价单 " class="pd3 px14 f_b"></p>
  </ul>    
    </div>
  </div><!--company_2END-->
   <!---联系我们--->
    <div class="company_2">
    <div class="company_2_1"><ul>
    <li><img src="<?php echo base_url()?>file/img/lxwm.gif" width="76" height="21" /></li>
    
    </ul>    
    </div>
        <div class="company_2_2">
  <p>&nbsp;地址：<?php echo $company[0]['address']?></p>
  <p>&nbsp;电话：  <?php echo $company[0]['telephone']?>  </p>
  <p>&nbsp;传真：<?php echo $company[0]['fax']?>    </p>
  <p>&nbsp;公司网址：<?php echo $company[0]['homepage']?>  </p>
  <p>&nbsp;邮箱：<?php echo $company[0]['mail']?>  </p>
  <p>&nbsp;主营产品：<?php echo $company[0]['sell']?>  </p>
  </ul>    
    </div>
  </div><!--company_2END-->
</div><!--0END-->
</div>
<!--公司简介END-->

<!--促销产品START-->
<div class="product">
 <div class="product_0">
  <div class="biaoti"><img src="<?php echo base_url()?>file/img/cxcp.jpg" width="246" height="20" /></div>
   <!--产品详情START-->
  <div class="chanpin">
   <div class="cp">
    <div class="chanpin_1">
     <ul>
     <li class="tu"><a href="#"><span><img src="<?php echo base_url()?>file/img/tu.jpg" width="132" height="78" /></span></a></li>
     <li class="wenzi"><a href="#">强势来袭 通达建力推</a></li>
     </ul>
     </div><!--chanpin_1END--> 
         <div class="chanpin_2">
     <ul>
     <li class="tu"><a href="#"><span><img src="<?php echo base_url()?>file/img/tu.jpg" width="132" height="78" /></span></a></li>
     <li class="wenzi"><a href="#">强势来袭 通达建力推</a></li>
     </ul>
     </div><!--chanpin_2END--> 
              <div class="chanpin_2">
     <ul>
     <li class="tu"><a href="#"><span><img src="<?php echo base_url()?>file/img/tu.jpg" width="132" height="78" /></span></a></li>
     <li class="wenzi"><a href="#">强势来袭 通达建力推</a></li>
     </ul>
     </div><!--chanpin_2END--> 
              <div class="chanpin_2">
     <ul>
     <li class="tu"><a href="#"><span><img src="<?php echo base_url()?>file/img/tu.jpg" width="132" height="78" /></span></a></li>
     <li class="wenzi"><a href="#">强势来袭 通达建力推</a></li>
     </ul>
     </div><!--chanpin_2END--> 
              <div class="chanpin_2">
     <ul>
     <li class="tu"><a href="#"><span><img src="<?php echo base_url()?>file/img/tu.jpg" width="132" height="78" /></span></a></li>
     <li class="wenzi"><a href="#">强势来袭 通达建力推</a></li>
     </ul>
     </div><!--chanpin_2END-->      
     </div><!--cpEND--> 
       <div class="cp">
    <div class="chanpin_1">
     <ul>
     <li class="tu"><a href="#"><span><img src="<?php echo base_url()?>file/img/tu.jpg" width="132" height="78" /></span></a></li>
     <li class="wenzi"><a href="#">强势来袭 通达建力推</a></li>
     </ul>
     </div><!--chanpin_1END--> 
         <div class="chanpin_2">
     <ul>
     <li class="tu"><a href="#"><span><img src="<?php echo base_url()?>file/img/tu.jpg" width="132" height="78" /></span></a></li>
     <li class="wenzi"><a href="#">强势来袭 通达建力推</a></li>
     </ul>
     </div><!--chanpin_2END--> 
              <div class="chanpin_2">
     <ul>
     <li class="tu"><a href="#"><span><img src="<?php echo base_url()?>file/img/tu.jpg" width="132" height="78" /></span></a></li>
     <li class="wenzi"><a href="#">强势来袭 通达建力推</a></li>
     </ul>
     </div><!--chanpin_2END--> 
              <div class="chanpin_2">
     <ul>
     <li class="tu"><a href="#"><span><img src="<?php echo base_url()?>file/img/tu.jpg" width="132" height="78" /></span></a></li>
     <li class="wenzi"><a href="#">强势来袭 通达建力推</a></li>
     </ul>
     </div><!--chanpin_2END--> 
              <div class="chanpin_2">
     <ul>
     <li class="tu"><a href="#"><span><img src="<?php echo base_url()?>file/img/tu.jpg" width="132" height="78" /></span></a></li>
     <li class="wenzi"><a href="#">强势来袭 通达建力推</a></li>
     </ul>
     </div><!--chanpin_2END-->      
     </div><!--cpEND--> 
       </div> 
  <!--产品详情END-->  
 </div><!--0END-->
</div>
<!--促销产品END-->

<!--站底START-->
<div class="foot">
  <div class="top_1_1">
    <ul>

    <li class="t_1"><a href="#">平台首页</a>&nbsp;|&nbsp;</li>
      <li><a href="#">建材采购</a>&nbsp;|&nbsp;</li>
        <li><a href="#">建材供应</a>&nbsp;|&nbsp;</li>
          <li><a href="#">蜂巢社区</a>&nbsp;|&nbsp;</li>
            <li><a href="#">融资服务&nbsp;</a></li>
              <li>咨询热线：400-003-5006&nbsp;</li>
                <li class="t_1"><a href="#">[请登录]</a>&nbsp;</li>
                  <li class="t_1"><a href="#">[注册中心]</a></li>
                      <li>&nbsp;&nbsp;&nbsp;技术支持：<a href="#">通达建网络科技有限公司</a></li>
    </ul>
   </div><!--top_1_1END-->
</div>
<!--站底END-->
</body>
</html>

