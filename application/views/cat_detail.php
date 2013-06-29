<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通达建网络科技有限公司</title>
<link href="<?php echo base_url()?>file/css/top.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>file/css/pro.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>file/css/foot.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript"
	src="<?php echo base_url()?>file/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".commitMsg").click(function(){
		var msgText=$("#GBookCon").val();
		var itemid=$(".itemid").val();
		var msgText=encodeURI(msgText);
		if(msgText==null)return;
		$.ajax({
			type: "post", 
			url:"<?php echo base_url()?>index.php/cat_detail/commitMsg?msgText="+msgText+"&itemid="+itemid,
		}).done(function(data){
			if(data!=null&&data.replace(/(^\s*)|(\s*$)/g,'') !=""){
				$(".js_refresh").append(data);
			}
		})
	})
})

</script>

</head>

<body>
	<!--头部开始-->

	<?php $this->load->view("./inc/header")?>

	<!--头部结束-->
	<input class="itemid" type="hidden" value=<?php echo $sell['itemid'];?>></input>
	<!--产品详情START-->
	<div class="detail">
		<div class="detail_0">
			<ul>
				<?php 
				for($i=count($catMenu)-1; $i>=0; $i--){
						$menuName=$catMenu[$i];
						if($i>0){
							?>
				<li class="detail_jiacu"><a href="#"><?php echo $menuName?> </a></li>
				<li>&nbsp;>>&nbsp;</li>
				<?php 
						}else{
							?>
				<li><a href="#"><?php echo $menuName?> </a></li>
				<?php 
						}
				}
				?>
			</ul>
		</div>
		<!--介绍START-->
		<div class="detail_1">
			<div class="detai_zong">
				<!--图片START-->
				<div class="detail_zong_1">
					<div class="detai_zong_1_1" style="line-height:277px;text-align:center;">
							<span>
								<img style="vertical-align:middle;" id="bigPic" src="<?php if($sell['thumb']!=""){echo base_url().$sell['thumb'];}else{ echo base_url()."file/images/nopic.gif";}?>">&nbsp;
							</span>
						
					</div>
					<div class="detai_zong_1_2">
						<ul>
							<?php 
								if($sell['thumb']!=""){
								
							?>
							<li><a href="javascript:void(0)"><img src="<?php echo base_url().$sell['thumb'];?>" width='55' height="55" onclick="document.getElementById('bigPic').src=this.src;"/></a>
							</li>
							<?php }?>
							
							<?php 
								if($sell['thumb1']!=""){
								
							?>
							<li><a href="javascript:void(0)"><img src="<?php echo base_url().$sell['thumb1'];?>" width='55' height="55" onclick="document.getElementById('bigPic').src=this.src;"/></a>
							</li>
							<?php }?>
							
							<?php 
								if($sell['thumb2']!=""){
								
							?>
							<li><a href="javascript:void(0)"><img src="<?php echo base_url().$sell['thumb2'];?>" width='55' height="55" onclick="document.getElementById('bigPic').src=this.src;"/></a>
							</li>
							<?php }?>
							
						</ul>
					</div>
				</div>
				<!--图片END-->
				<!--内容START-->
				<div class="detail_zong_2">
					<div class="detail_zong_2_1">
						<a href="#" style="color: #ff6803" title='<?php echo $sell['keyword']?>'> <?php 
						echo $sell['title'];
						?>
						</a>
					</div>
					<div class="detail_zong_2_2">
						<div class="detail_zong_2_2_xinxi">
							<ul>
								<li><span>类 型：</span> <?php 
								echo $category['catname'];
								?>
								</li>
								<li><span>品 牌：</span> <?php 
								echo $sell['brand'];
								?>
								</li>
								<li><span>型 号：</span> <?php 
								echo $sell['model'];
								?>
								</li>
								<li><span>规 格：</span> <?php 
								echo $sell['standard'];
								?>
								</li>
								<li><span>产 地：</span> <?php 
								echo $sell['address'];
								?>
								</li>
								<li><span>参考价：</span><span class="cankao_s"><?php 
								echo $sell['price'];
								?> </span></li>
								<li><span>促销价：</span><span class="cankao_se"><?php 
								echo $sell['Promotion'];
								?> </span>&nbsp;<img
									src="<?php echo base_url()?>file/images/detai_cuxiao.gif"
									width="28" height="14" /></li>
								<li class="pingfen">产品评分：<img
									src="<?php echo base_url()?>file/images/xx.gif"><img
									src="<?php echo base_url()?>file/images/xx.gif"><img
									src="<?php echo base_url()?>file/images/xx.gif"><span
									class="pingjia">(已有168人评价)</span><span class="liulan">&nbsp;&nbsp;&nbsp;浏览次数：888次</span>
								</li>
							</ul>
						</div>
						<div class="detail_zong_2_2_shangjia">
							<div class="shangjia_1">
								<ul>
									<li class="sj_xx">商家信息</li>
									<li><a href="#" style="color: #005ca9"><?php 
									echo $company['company'];
									?> </a></li>
									<li>商家评分：<span><img
											src="<?php echo base_url()?>file/images/hx.gif" /><img
											src="<?php echo base_url()?>file/images/hx.gif" /> </span>&nbsp;1.9分
									</li>
								</ul>
							</div>
							<div class="shangjia_2">
								<ul>
									<li>邮件：<?php 
									echo $company['mail'];
									?>
									</li>
									<li>电话：<?php 
									echo $company['telephone'];
									?>
									</li>
									<li>传真：<?php 
									echo $company['fax'];
									?>
									</li>
									<li>地区：<?php 
									echo $company['address'];
									?>
									</li>
									<li><a href="#"><img
											src="<?php echo base_url()?>file/images/shangjia_t.jpg" /> </a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="cxjd">
						<ul>
							<li>询价数量：<img
								src="<?php echo base_url()?>file/images/shuliang.jpg" />
							</li>
							<!--<li class="fxx"><a href="#"><img
									src="<?php echo base_url()?>file/images/wypl.gif"> </a></li>-->
							<li class="fxx"><a href="#"><img
									src="<?php echo base_url()?>file/images/jrxjd.gif" /> </a></li>
						</ul>
					</div>
					<!--发询价单END-->
				</div>
				<!--内容END-->
			</div>
			<!--总END-->
		</div>
		<!--介绍END-->

		<!--案例切换START-->
		<div class="detail_2">
			<div class="detail_2_1">
				<ul>
					<li><a href="#">产品详情</a></li>
					<li><a href="#">产品案例</a></li>
					<li><a href="#">联系商家</a></li>
				</ul>
			</div>
			<div class="detail_2_2">
				<div class="detail_2_2_1">
					<p>
						&nbsp;&nbsp;
						<?php 
						echo isset($sellData['content']) ? $sellData['content'] :"";
						?>
					</p>
					<p>联&nbsp;&nbsp;系&nbsp;&nbsp;人:<?php echo $sell['truename'];?></p>
					<p>手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机:<?php echo $sell['mobile'];?></p>
					<p>联系电话:<?php echo $sell['telephone'];?></p>
					<p>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址:<?php echo $sell['address'];?></p>
					
				</div>
			</div>
		</div>
		<!--案例切换END-->
        <!--留言START--> <!--留言END-->
		</div>

		<!--站底开始-->
		<?php $this->load->view("./inc/footer")?>
		<!--站底结束-->

</body>
</html>

