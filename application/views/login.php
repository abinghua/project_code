<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<link href="<?php echo base_url()?>file/css/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!--头部START-->
 <div class="top">
   <div class="logo"><img src="<?php echo base_url()?>file/images/logo_dl.jpg" /></div>
 </div> 
<!--头部END-->

<!--中间START-->
 <div class="middle">
  <div class="middle_left">
    <div class="left_1"><span>还没有注册？<a href="<?php echo base_url().'index.php/register'?>" style="color:#faae7c">免费注册</a></span></div>
    <div class="left_2">
      <div class="left_2_1" style="position:relative">
	  <form action="<?php echo base_url()?>index.php/login?url=provide" onsubmit="" method="post">
							<div class="info_wrap">
								<div class="info_box"  <?php if(isset($message)){echo "style='display:block'";}?> id="info_box">
									<div class="info_box_inner">
										<?php 
											if(isset($message) && $message=="checkCodeError"){
												?>
												<div id="loginerror" class="login_error">验证码错误</div>
												<?php
											}else{
											?>
											<div id="loginerror" class="login_error">账号或密码错误</div>
											<?php
											}
										?>
										
									</div>
									<div class="info_box_bt"></div>
								</div>
							</div>

							<div class="field">
								<label for="name1">
									账&nbsp;&nbsp;号：
								</label>
								<input type="text" name="username" id="userName" class="txt8 tTip">
								<span class="L_Suc" style="display: none;"></span>
							</div>
							<div class="field1">
								<label for="name1">
									密&nbsp;&nbsp;码：
								</label>
								<input type="password" name="passwd" id="userPass" class="txt8 tTip">
								<span class="L_Suc" style="display: none;"></span>
							</div>   
							<div class="field1" style="">
								<label for="name1" style="float:left;">
									验证码：
								</label>
								<div class="" style="float:left;margin-left:8px;">
								<input type="text" name="checkcode" id="checkcode" class="" style='width:80px;height:30px;'>
								</div>
								<div style="float:left;margin-left:5px;">
								<img src="<?php echo base_url().'index.php/register/checkcode?v='.time();?>" onclick="this.src='<?php echo base_url().'index.php/register/checkcode?v='?>'+new Date().getTime()" style="cursor:pointer;">
								</div>
							</div>   
							<div class="remember">
								<label for="rememberPwd">
									<input type="checkbox" name="remember" id="rememberPwd" class="ckBx" title="为保证账户安全，请您不要在公用电脑上设置此功能">
									记住账号
								</label>
							</div>  
							<div class="actions">
							
								<input type="submit" value="" id="btnSubmit" class="btn">&nbsp;&nbsp;
						         <input type="btn"  id="btnSubmit" class="btn_1" onclick="window.location='<?php echo base_url().'index.php/register'?>'">
							</div>   
							</form>
							<div class="gongsi">
								通达建网络科技（深圳）有限公司				
							</div>                  
                                                              
      </div> <!--2_1END-->
    </div> <!--left_2END-->      
  </div><!--leftEND-->  

  <div class="middle_right"><img src="<?php echo base_url()?>file/images/denglu_bj.jpg" /></div><!--rightEND-->

 </div>
<!--中间END-->
<!--站底START-->
  <div class="foot">
   <div class="foot_1">
   <div class="foot_2">
   <ul>
    <li><a href="#">网站首页</a> |</li>
    <li><a href="#">建材供应</a> |</li>
    <li><a href="#">生产厂家</a> |</li>
    <li><a href="#">中标信息</a> |</li>
    <li><a href="#">蜂巢社区</a> |</li>
    <li><a href="#">融资服务</a> |</li>
    <li><a href="#">帮助中心</a></li>
   </ul></div>
   </div>
 <div class="foot_3"> <p>通达建网咯科技（深圳）有限公司 版权所有 Copyright 2010-2013 tdjcn.com</p></div>
  </div>
<!--站底END-->
</body>
</html>

