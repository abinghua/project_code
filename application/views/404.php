<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>404</title>
<style type="text/css">
* { margin:0px; padding:0px; list-style:none; }
body { font-family: "宋体", Arial, Helvetica, sans-serif; font-size: 12px; color:#4e4e4e; background:#efefef;}
body,ul,li{margin:0;padding:0;}
a {padding-top:0px; margin-top:0px;}
a:link { text-decoration: none; }
a:visited { text-decoration: none;}
a:hover { text-decoration: none; }
a:active { text-decoration: none; }
.clear { clear:both; }


.middle{ width:352px; height:211px; margin:0 auto; margin-top:180px;border:1px solid #7fa8c9; background:#FFFFFF;}
.middle_1{width:352px;height:27px; background:url(<?php echo base_url();?>file/images/tishi.gif) repeat-x; line-height:27px; color:#000000;}
.middle_2{width:321px; height:32px; margin:0 auto; line-height:32px; margin-top:25px;}
.middle_2 ul{}
.middle_2 ul li{ float:left; color: #FF0000;}
.middle_2 ul li.m1{ width:38px; height:32px;background:url(<?php echo base_url();?>file/images/tishi_1.gif) no-repeat; margin-right:5px;}
.middle_3{width:310px; height:32px; margin:0 auto; line-height:20px; margin-top:20px;}
.middle_4{width:310px; height:32px; margin:0 auto; line-height:20px; margin-top:25px;}
.middle_4 ul{}
.middle_4 ul li{float:left; width:71px; height:23px; line-height:23px;background:url(<?php echo base_url();?>file/images/tishi_an.gif) no-repeat; text-align:center;}
.middle_4 ul li.m2{  margin-left:5px;}
.middle_4 ul li a{ color:#505050;}
.middle_4 ul li a:hover{ color:#0000FF;}
</style>
</head>

<body>
<!--头部开始-->
<div class="middle">
  <div class="middle_1">&nbsp;&nbsp;提示</div>
  <div class="middle_2"><ul><li class="m1"></li><li>您好，<?php if(isset($msg)){echo $msg;}else{echo '您访问的页面不存在!';}?>，</li></ul></div>
  <div class="middle_3">提醒您，您可能输入了错误的网址，或者该网页已删除或移动。</div>
  <div class="middle_4">
   <ul>
   <li><a href="<?php echo base_url();?>">网站首页</a></li>
   <li class="m2"><a href="<?php echo base_url();?>index.php/provide">建材供应</a></li>
   <li class="m2"><a href="<?php echo base_url();?>index.php/company">生产厂家</a></li>
   <li class="m2"><a href="<?php echo base_url();?>index.php/help">帮助中心</a></li>   
   </ul>    
  </div>
</div>
<!--头部结束-->
</body>
</html>

