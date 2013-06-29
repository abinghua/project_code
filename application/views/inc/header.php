<div class="top">
  <div class="top1">
  <div class="logo"><img src="<?php echo base_url()?>file/images/logo.jpg"></div>
  <div class="logo_r">
  
  <div class="logo_r_s">
     <div class="logo_r_s_1">
     <ul>
                		<li class="yw_1"><a href="#"></a></li>
                        <li class="yw_2"><a href="#"></a></li>
                        <li class="yw_3"><a href="#"></a></li>  
                        <li class="yw_4"><a href="#"></a></li>                     
                	</ul></div> 
     <div class="logo_r_s_2">                  

 <div class="submenu">
            		<ul>
						<?php 
						if(!$this->auth->hasLogin()){
							?>
						<li class="s1"> <a href="<?php echo base_url().'index.php/register'?>">免费注册</a>&nbsp;</li>
                        <li class="s2">&nbsp;|&nbsp;</li>
                    	<li class="s1"><a href="<?php echo base_url()."index.php/login"?>">会员登录</a>&nbsp;</li>
							<?php
						}else{
							?>
						<li class="s1"> &nbsp;<a href="<?php echo base_url()?>index.php/login/logout?v=<?php echo time();?>">退出</a>&nbsp;</li>
						<li class="s2">&nbsp;|&nbsp;</li>
						
						<li class="s1"> &nbsp;<a href="<?php echo base_url()?>index.php/answeradm">应询管理</a>&nbsp;</li>
                        <li class="s2">&nbsp;|&nbsp;</li>
						<?php //if($member['groupid'] == 5 || $member['groupid'] ==8 || $member['groupid'] ==1){}else{ }?>
						<li class="s1"> &nbsp;<a href="<?php echo base_url()?>index.php/orderadm">询价单管理</a>&nbsp;</li>
						<li class="s2">&nbsp;|&nbsp;</li>
						
						<li class="s1"> &nbsp;<a href="#">会员中心</a>&nbsp;</li>
						<li class="s2">&nbsp;|&nbsp;</li>
                    	<li class="s1">&nbsp;<?php $member = $this->memberModel->getByPk($this->session->userdata['userid']);echo $member['username']; ?>&nbsp;</li>
						
							<?php
						}
						?>
                	
                	</ul>
                    </div>  </div></div>
    <div class="logo_r_x">
      <div class="menu">
        	<ul>
              
            	<li><a href="<?php echo base_url()?>">首页</a></li>
                <!--<li><a href="<?php echo base_url()?>index.php/buy/">建材采购</a></li>-->
                <li><a href="<?php echo base_url()?>index.php/provide">建材供应</a></li>
                <li><a href="<?php echo base_url()?>index.php/company">生产厂家</a></li>
                <li><a href="#">项目询价</a></li>
                <li><a href="#">成交公告</a></li>
                <li><a href="#">蜂巢社区</a></li>
                <li><a href="#">融资服务</a></li>
        	</ul>
</div>
    
    
    </div>      
  </div>																																																																																																																																																																																																																																																																																																																																																																																																																																																											  </div>
</div>
