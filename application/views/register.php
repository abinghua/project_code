<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册</title>
<link href="<?php echo base_url()?>file/css/login.css" rel="stylesheet"
	type="text/css" />
<script type="text/javascript"
	src="<?php echo base_url()?>file/js/jquery-1.7.2.min.js"></script>
<script
	src="<?php echo base_url()?>file/validator/formValidator-4.1.1.js"
	type="text/javascript" charset="UTF-8"></script>
<script
	src="<?php echo base_url()?>file/validator/formValidatorRegex.js"
	type="text/javascript" charset="UTF-8"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>file/js/register.js" charset="UTF-8"></script>
<script>
var base_url = "<?php echo base_url()?>";
</script>
</head>

<body>
	<!--头部START-->
	<div class="zhuce">
		<div class="logo">
			<img src="<?php echo base_url()?>file/images/logo_dl.jpg" />
		</div>
		<div class="zhuce_1">欢迎您注册通达建建材采购服务平台会员，请从下面选择您要注册的类型</div>
	</div>
	<!--头部END-->
	<!--类型START-->
	<div class="reg">
		<ul>
			<li class="reg_1"><a href="javascript:void(0)" onclick="buyers()">采购商注册</a>
			</li>
			<li class="reg_2"><a href="javascript:void(0)" onclick="dealers()">经销商注册</a>
			</li>
			<li class="reg_3"><a href="javascript:void(0)"
				onclick="manufacturers()">厂商注册</a></li>
			<li class="reg_4"><a href="javascript:void(0)" onclick="designer()">设计师注册</a>
			</li>
		</ul>
	</div>
	<!--类型END-->
	<!--注册信息START-->
	<!-- 采购商 -->
	<form id="buyUser" method="post"
		action="<?php echo base_url()?>index.php/registerbuyers"
		onsubmit="return dearlersValidate('infouserName','cusernameTip','cpassword1','cpasswordTip','cpass','crelpassTip','cemail',
			'cemailTip','clianxiren','clianxirenTip','cmobilephone','cmobilephoneTip','cdepartment','cdepartmentTip','ccareer','ccareerTip',
			'ccompany','ccompanyTips','caddress','caddressTip','cmoney','cmoneyTip','ccompanyemail','ccompanyemailTips','ccompanyPhone',
			'ccompanyPhoneTips','caigoufaxs','cfarenTips','ccpostcode','ccpostcodeTips','cyears','cyearTip','cinternet','cinterTip','chuanzhen',
			'cfaxTip','cIntroduce','cIntroduceTips','cyincang');">
	
		<div class="information info_on" id="info_on">

			<div class="infor_1">
				<div class="infor_1_1">
					<ul>
						<li class="infor_s1">采购商注册</li>
						<li class="infor_s2">注册步骤:</li>
						<li class="infor_s3">1、填写注册信息</li>
						<li class="infor_s4">2、注册成功</li>
					</ul>
				</div>
				<div class="infor_1_2">
					请认真、仔细地填写以下信息，严肃的商业信息有助于您获得别人的信任，结交潜在的商业伙伴，获取商业机会！<span>*</span>为必填项
				</div>
			</div>
			<!--infor_1END-->
			<!--列表信息单个循环-->
			<div class="infor_2">
				<div class="biaoti">
					<ul>
						<li class="biaoti_1">账户信息</li>
						<li><img src="<?php echo base_url()?>file/images/zhuce_1.gif" /></li>
					</ul>
				</div>
				<div class="fd">
					<label for="name1"> <span>* </span>登录账号：
					</label> <input type="text" name="infouserName" id="infouserName" 
					onblur="userNameValidate('infouserName','cusernameTip','登录帐号')"
						class="txt8 tTip">
					<span id="cusernameTip" class="cusernameTip">这是您的登录号码</span>
				</div>
				<br />
				<div class="fd1">
					<label for="name1"> <span>* </span>登录密码：
					</label> <input type="password" name="cpassword1" id="cpassword1"
						class="txt8 tTip"
						onblur="liuershivalidate('cpassword1','cpasswordTip','登录密码')"> <span
						id="cpasswordTip">请填写登录密码</span>
				</div>
				<br />
				<div class="fd1">
					<label for="name1"> <span>* </span>确认密码：
					</label> <input type="password" name="password2" id="cpass"
						class="txt8 tTip"
						onblur="reluserpassValidate('cpass','cpassword1','crelpassTip')">
					<span id="crelpassTip">请再次输入密码</span>
				</div>
				<br />
				<div class="fd">
					<label for="name1"> <span>* </span>电子邮箱：
					</label> <input type="text" name="cemail" id="cemail"
						class="txt8 tTip" onblur="emailValidate('cemail','cemailTip')"> <span
						id="cemailTip">请输入电子邮箱</span>
				</div>
				<br />
				<div class="fd">
					<label for="name1"> <span>* </span>联 系 人：
					</label> <input type="text" name="clianxiren" id="clianxiren"
						class="txt8 tTip" onblur="validatenull('clianxiren','clianxirenTip','联系人')"> 
						<input type="radio" name="cgender" id="cgender" value="1" checked="checked">先生 
						<input type="radio" name="cgender" id="cgender" value="0">女士 <span id="clianxirenTip">请输入联系人</span>
				</div>
				<br />
				<div class="fd">
					<label for="name1"> <span>* </span>移动电话：
					</label> <input type="text" name="cmobilephone" id="cmobilephone"
						class="txt8 tTip" onblur="mobielphoneVali('cmobilephone','cmobilephoneTip')"> <span
						id='cmobilephoneTip'>建议您填写，以便客户及时与您取得联系</span>
				</div><br />
				<div class="fd">
					<label for="name1"> <span>* </span>所在部门：
					</label> <input type="text" name="cdepartment" id="cdepartment" 
						class="txt8 tTip" onblur="validatenull('cdepartment','cdepartmentTip','所在部门')"
						onblur="validatenull('cdepartment','cdepartmentTip','所在部门')"> <span
						id='cdepartmentTip'>建议您填写，以便客户及时与您取得联系</span>
				</div><br />
				<div class="fd">
					<label for="name1"> <span>* </span>担任职位：
					</label> <input type="text" name="ccareer" id="ccareer"
						class="txt8 tTip"
						onblur="validatenull('ccareer','ccareerTip','担任职务')"> <span
						id='ccareerTip'>建议您填写，以便客户及时与您取得联系</span>
				</div>
			</div>
			<!--infor_2END-->

			<div class="infor_2">
				<div class="biaoti">
					<ul>
						<li class="biaoti_1">公司档案</li>
						<li><img src="<?php echo base_url()?>file/images/zhuce_1.gif" /></li>
					</ul>
				</div>
				<div class="fd">
					<label for="name1"> <span>* </span>公司名称：
					</label> <input type="text" name="ccompany" id="ccompany"
						class="txt8 tTip" onblur="companyValidate('ccompany','ccompanyTips','companyjiazai','公司名称','ctip')"> 
					<span id="ccompanyTips"></span>
					<span id="companyjiazai" class="companyjiazai" style="display:none;">
						<a href="javascript:jiazai('ccompany','cyincang','cshow','huoquzhi')">加载</a>&nbsp;&nbsp;
						<a href="javascript:bujiazai('cyincang','cshow','huoquzhi')">不加载</a>
					</span>
				<input type="hidden" id="huoquzhi" class="huoquzhi" value="0" name="huoquzhi"/>
				<input type="hidden" id="ctip" class="ctip" value="0" name="ctip"/>
				</div><br/>
				<div class="cshow"></div>
				<div id="cyincang" class="cyincang" style="display: inline">
					<div class="fd1">
						<label for="name1"> <span>* </span>注册城市：
						</label>
						<span class="ccompanycity">
							 <span class="sel1"> <?php 
						$options ="";
						foreach($area as $val){
					$options .= "<option value={$val['areaid']}>".$val['areaname']."</option>";
				}
				echo "<select id='carea' name='carea' onchange='load_area1(this.value)'><option>所在地区</option>".$options."</select>";
				?>
							</span> 
						<a href="javascript:areaValue('caddress','areaname')">添加</a>
						<span id="areaTips">请选择公司注册城市</span>
						</span>
						<input type=hidden  name="areaid" class="arLast1" />
						<input type="hidden"  name="areaname" id="areaname" class="arLast1" style="width:250px;height:30px;" />
				
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司地址：
						</label> 
						<input type="text" name="caddress" id="caddress" class="txt8 tTip" 
							onblur="validatenull('caddress','caddressTip','公司地址')"> 
						<span id="caddressTip">例：朝阳区北三环东路三元大厦1栋4层339室</span>
					</div><br/>
						
					<div class="fd">
						<label for="name1"> <span>* </span>经营范围：
						</label> 
						<input type=hidden value=-1 name="catid" class="ctLast1" /> 
							<span class="category_sel1"> <?php 
	
							$options ="";
							foreach($category as $val){
								$options .= "<option value={$val['catid']}>".$val['catname']."</option>";
							}
				echo "<select id='cfanwei' name='cfanwei' onchange='load_category1(this.value)'><option value=0>全部分类</option>".$options."</select>";
					
				?>
						</span>
						
						<a href="javascript:addfanwei('cfanweis')">添加</a>
						<a href="javascript:chongzhi('cfanweis')">重置</a>
						<input type="text" value="" style="width:300px;height:30px" name="cfanweis" id="cfanweis" readonly="readonly" />
						 <input type=hidden value=-1 name="catid" class="ctLast" />
					</div><br/>
					<div class="fd">
						<label for="name1"> 
						<span>* </span>公司类型： 
						<select id="ccompanytype" name="ccompanytype"
							style="width: 250px;height:20px; text-align: center" onchange="">
								<option value="0" style="color: #e5e5e5">请选择所属分类</option>
								<option value="私营企业">私营企业</option>
								<option value="民营企业">民营企业</option>
								<option value="外资企业">外资企业</option>
								<option value="上市公司">上市公司</option>
						</select>
						</label>
					</div><br/>
							
					<div class="fd">
						<label for="name1"> <span>* </span>注册资本： 
						<input type="text" value="" name="cmoney" id="cmoney" onblur="validatenull('cmoney','cmoneyTip','注册资本')" />
						<select id="cmoneyType" name="cmoneyType" style="width: 123px;" onchange="">
								<option value="0" style="color: #e5e5e5">请选择货币单位</option>
								<option value="人民币">人民币</option>
								<option value="港币">港币</option>
								<option value="美元">美元</option>
								<option value="欧元">欧元</option>
						</select>
						<span id="cmoneyTip"></span>
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司邮件：
						</label> <input type="text" name="ccompanyemail"
							id="ccompanyemail" class="txt8 tTip"
							onblur="emailValidate('ccompanyemail','ccompanyemailTips')">
						<span id="ccompanyemailTips">请输入公司邮件，以便更好联系</span>
					</div><br/>
				
					<div class="fd">
						<label for="name1"> <span>* </span>公司电话：
						</label> <input type="text" name="ccompanyPhone"
							id="ccompanyPhone" class="txt8 tTip"
							onblur="mobielweiyiValidate('ccompanyPhone','ccompanyPhoneTips')"/>
						<span id="ccompanyPhoneTips">请输入公司电话，以便更好联系</span>
					</div><br/>
					
					<div class="fd">
						<label for="name1"> <span>* </span>法人代表：
						</label> <input type="text" name="caigoufaxs" id="caigoufaxs"
							class="txt8 tTip"
							onblur="validatenull('caigoufaxs','cfarenTips','法人代表')"> <span
							id="cfarenTips">请输入公司的法人代表，以便更好的增强企业诚信度</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司邮编：
						</label> <input type="text" name="ccpostcode" id="ccpostcode"
							class="txt8 tTip"
							onblur="validatenull('ccpostcode','ccpostcodeTips','公司邮编')"> <span
							id="ccpostcodeTips">请输入公司邮编，以便更好的增强企业诚信度</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司规模：
						 <select name="cguimo" style="width: 250px; text-align: center" id="cguimo" onchange="">
								<option value="0" style="color: #e5e5e5">请选择所属分类</option>
								<option value="0~50人">0~50人</option>
								<option value="50~100人">50~100人</option>
								<option value="100~500人">100~500人</option>
								<option value="500人以上">500人以上</option>
						</select>
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>成立年份：
						</label> <input type="text" name="cyears" id="cyears"
							class="txt8 tTip" onblur="yearValidate('cyears','cyearTip')"> <span
							id="cyearTip">请输入成立年份，如：1900</span>
					</div><br/>
					
					<div class="fd">
						<label for="name1"> <span>* </span>公司网站：
						</label>
						 <input type="text" name="cinternet" id="cinternet" class="txt8 tTip"
							onblur="internetValidate('cinternet','cinterTip')"> 
						<span id="cinterTip">例：http://www.tdjcn.com</span>
					</div><br/>
				
					<div class="fd">
						<label for="name1"> <span>* </span>公司传真：
						</label> 
						<input type="text" name="cchuanzhen" id="cchuanzhen" class="txt8 tTip"
							onblur="validatenull('cchuanzhen','cfaxTip','公司传真')"> 
						<span id="cfaxTip">请输入公司传真</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>营业执照：
						</label> <input type="text" name="ecuserCustomer.id"
							id="czhizhao" class="txt8 tTip"
							onblur="validatenull('czhizhao','czhizhaoTip','营业执照')"> <span
							id="czhizhaoTip">例：朝阳区北三环东路三元大厦1栋4层339室</span>
					</div><br/>
				
					<div class="fd">
						<label for="name1"> <span>* </span>公司简介：
						</label>
					</div><br/>
					<div class="wenben">
						<textarea name="cIntroduce" id="cIntroduce" class="inkuang01"
							onblur="validatenull('cIntroduce','cIntroduceTips','公司简介')"></textarea>
						<span id="cIntroduceTips">要求1000字以内。请用中文详细如实填写贵公司的成立时间、主营范围、品牌及服务优势等；如果内容过于简单或</span>
						含有QQ、电话、网址等不规范信息将无法通过审核。
					</div><br/>
				</div>
				
				<div class="fd" style="float: left;">
					<label for="name1"> <span>* </span>验 证 码：
					</label> <input type="text" name="ecuserCustomer.id"
						id="userName" class="txt8 tTip" style="width: 100px">
	
				</div>
				<div style="float: left;">
					<img id="gcheckCode"
						src="<?php echo base_url()?>index.php/register/checkCode"
						style="cursor: pointer"
						onclick="this.src='<?php echo base_url().'index.php/register/checkCode';?>'+'?'+new Date().getTime()"
						title="看不清"><a href="javascript:void(0)"
						onclick="document.getElementById('gcheckCode').src='<?php echo base_url().'index.php/register/checkCode';?>'+'?'+new Date().getTime()">
						看不清</a>
				</div>
				<input type="submit" value="" id="btnSubmit" class="tijiao">

		<!--infor_2END-->

		</div>

		</div>
		<!--注册信息END-->
	</form>

	<!--注册信息START-->
	<!-- 厂商注册 -->
	<form action="<?php echo base_url()?>index.php/registerManufactures" id="dealersform" method="post"
		onsubmit="return dearlersValidate('musername','musernameTip','muserpass','muserpassTip','muserPassrel','muserPassrelTip','memails','memailTip','mlianxiren','mlianxirenTips',
			 'mobeilphone','mmobeilphoneTips','mdepartment','mdepartmentTip','mcareer','mcareerTip','mcompany','mcompanyTips','maddress','maddressTips','mmoney',
			 'mmoneyTip','mcompanyemail','mcompanyemailTips','mcompanyPhone','mcompanyPhoneTips','mfaren','mfarenTips','mpostcode','mpostcodeTips'
			 ,'myear','myearTip','minternet','minternetTip','mchuanzhen','mchuanzhanTip','mIntroduce','mIntroduceTip','myincang','mhuoquzhi')">
		<div class="information" id="manufacturers">
			<div class="infor_1">
				<div class="infor_1_1">
					<ul>
						<li class="infor_s1">厂商注册</li>
						<li class="infor_s2">注册步骤:</li>
						<li class="infor_s3">1、填写注册信息</li>
						<li class="infor_s4">2、注册成功</li>
					</ul>
				</div>
				<div class="infor_1_2">
					请认真、仔细地填写以下信息，严肃的商业信息有助于您获得别人的信任，结交潜在的商业伙伴，获取商业机会！<span>*</span>为必填项
				</div>
			</div>
			<!--infor_1END-->
			<!--列表信息单个循环-->
			<div class="infor_2">
				<div class="biaoti">
					<ul>
						<li class="biaoti_1">账户信息</li>
						<li><img src="<?php echo base_url()?>file/images/zhuce_1.gif" /></li>
					</ul>
				</div>
				<div class="fd">
					<label for="name1"> <span>* </span>登录账号：
					</label>
					<input type="text" name="musername" id="musername" class="txt8 tTip"
					 onblur="userNameValidate('musername','musernameTip','登录帐号')">
					<span id="musernameTip" class="musernameTip">这是你的登录号码</span>
				</div><br/>
				<div class="fd1">
					<label for="name1"> <span>* </span>登录密码：
					</label> <input type="password" name="muserpass" id="muserpass"
						class="txt8 tTip"
						onblur="liuershivalidate('muserpass','muserpassTip','登录密码')"> <span
						id="muserpassTip">由6-20位英文母或数字组成，不区分大小写</span>
				</div><br/>
				<div class="fd1">
					<label for="name1"> <span>* </span>确认密码：
					</label> <input type="password" name="muserPassrel"
						id="muserPassrel" class="txt8 tTip"
						onblur="reluserpassValidate('muserpass','muserPassrel','muserPassrelTip')">
					<span id="muserPassrelTip">请再输入一遍您上面填写的密码 </span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>电子邮箱：
					</label> <input type="text" name="memails" id="memails"
						class="txt8 tTip" onblur="emailValidate('memails','memailTip')"> <span
						id="memailTip">请填写有效的电子邮箱，便于找回密码。例：abc@163.com </span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>联 系 人：
					</label> 
					<input type="text" name="mlianxiren" id="mlianxiren"
						class="txt8 tTip" onblur="validatenull('mlianxiren','mlianxirenTips','联系人')"> 
					<input type="radio" name="mGender" value="1" checked="checked">先生 
					<input type="radio" name="mGender" value="0">女士
					 <span id="mlianxirenTips">请输入联系人</span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>移动电话：
					</label> <input type="text" name="mobeilphone" id="mobeilphone"
						class="txt8 tTip"
						onblur="mobielphoneVali('mobeilphone','mmobeilphoneTips')"> <span
						id="mmobeilphoneTips">建议您填写，以便客户及时与您取得联系</span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>所在部门：
					</label> <input type="text" name="mdepartment" id="mdepartment"
						class="txt8 tTip"
						onblur="validatenull('mdepartment','mdepartmentTip','所在部门')"> <span
						id='mdepartmentTip'>建议您填写，以便客户及时与您取得联系</span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>担任职位：
					</label> <input type="text" name="mcareer" id="mcareer"
						class="txt8 tTip"
						onblur="validatenull('mcareer','mcareerTip','担任职务')"> <span
						id='mcareerTip'>建议您填写，以便客户及时与您取得联系</span>
				</div>
			</div>
			<!--infor_2END-->

			<div class="infor_2">
				<div class="biaoti">
					<ul>
						<li class="biaoti_1">公司档案</li>
						<li><img src="<?php echo base_url()?>file/images/zhuce_1.gif" /></li>
					</ul>
				</div>
				<div class="fd">
					<label for="name1"> <span>* </span>公司名称：
					</label> <input type="text" name="mcompany" id="mcompany" class="txt8 tTip"
						onblur="companyValidate('mcompany','mcompanyTips','mcompanyjiazai','公司名称')"> 
						<span id="mcompanyTips"></span>
					<span id="mcompanyjiazai" class="mcompanyjiazai" style="display:none;">你填写公司名称已经存在，是否加载公司信息
						<a href="javascript:jiazai('mcompany','myincang','mcshow','mhuoquzhi')">加载</a>&nbsp;&nbsp;
						<a href="javascript:bujiazai('myincang','mcshow','mhuoquzhi')">不加载</a>
					</span>
					<input type="hidden" id="mhuoquzhi" class="mhuoquzhi" value="0" name="mhuoquzhi"/>
				</div><br/>
				<div class="mcshow"></div>
				<div id="myincang" class="myincang" style="display: inline">
					<div class="fd1">
						<label for="name1"> <span>* </span>注册城市：
						</label> <span class="sel2"> <?php 
						$options ="";
						foreach($area as $val){
							$options .= "<option value={$val['areaid']}>".$val['areaname']."</option>";
						}
						echo "<select id='PCity' name='mPCity' onchange='load_area2(this.value)'><option>所在地区</option>".$options."</select>";
						?>
						</span> 
						<a href="javascript:areaValue('maddress','mareaname')">添加</a>
						<span id="areaTips">请选择公司注册城市</span>
						
						<input type=hidden  name="areaid" class="arLast2" />
						<input type=hidden  name="mareaname" id="mareaname" class="arLast2" />
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司地址：
						</label> <input type="text" name="maddress" id="maddress"
							class="txt8 tTip"
							onblur="validatenull('maddress','maddressTips','公司地址')"> <span
							id="maddressTips">例：朝阳区北三环东路三元大厦1栋4层339室</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>经营范围： <input type=hidden
							value=-1 name="catid" class="ctLast2" /> <span
							class="category_sel2"> <?php 
				
							$options ="";
							foreach($category as $val){
								$options .= "<option value={$val['catid']}>".$val['catname']."</option>";
							}
							echo "<select id='mfanwei' name='mfanwei' onchange='load_category2(this.value)'><option value=0>全部分类</option>".$options."</select>";
								
							?>
						</span>
						<a href="javascript:addfanwei('mfanweis')">添加</a>
						<a href="javascript:chongzhi('mfanweis')">重置</a>
						<input type="text" value="" style="width:300px;" name="mfanweis" id="mfanweis" readonly="readonly" />
						 <input type=hidden value=-1 name="catid" class="ctLast" />	
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司类型： 
						<select id="mcompanyType" name="mcompanyType" style="width: 250px;text-align:center" onchange="">
							<option value="0" style="color: #e5e5e5">请选择所属分类</option>
								<option value="私营企业">私营企业</option>
								<option value="民营企业">民营企业</option>
								<option value="外资企业">外资企业</option>
								<option value="上市公司">上市公司</option>
						</select>
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1">
						 <span>* </span>注册资本： 
						 <input type="text" value="" name="mmoney" id="mmoney" 
						 	 onblur="validatenull('mmoney','mmoneyTip','注册资本')"	/> 
						 <select id="mmoneyType" name="mmoneyType" style="width: 123px;" onchange="">
							<option value="0" style="color: #e5e5e5">请选择货币单位</option>
							<option value="人民币">人民币</option>
							<option value="港币">港币</option>
							<option value="美元">美元</option>
							<option value="日元">日元</option>
						</select>
						<span id="mmoneyTip"></span>
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司邮件：
						</label> <input type="text" name="mcompanyemail"
							id="mcompanyemail" class="txt8 tTip"
							onblur="validatenull('mcompanyemail','mcompanyemailTips','公司邮件')">
						<span id="mcompanyemailTips">请输入公司邮件，以便更好联系</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司电话：
						</label> <input type="text" name="mcompanyPhone"
							id="mcompanyPhone" class="txt8 tTip"
							onblur="validatenull('mcompanyPhone','mcompanyPhoneTips','公司电话')">
						<span id="mcompanyPhoneTips">请输入公司电话，以便更好联系</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>法人代表：
						</label> <input type="text" name="mfaren" id="mfaren"
							class="txt8 tTip"
							onblur="validatenull('mfaren','mfarenTips','法人代表')"> <span
							id="mfarenTips">请输入公司的法人代表，以便更好的增强企业诚信度</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司邮编：
						</label> <input type="text" name="mpostcode" id="mpostcode"
							class="txt8 tTip"
							onblur="validatenull('mpostcode','mpostcodeTips','公司邮编')"> <span
							id="mpostcodeTips">请输入公司邮编，以便更好的增强企业诚信度</span>
					</div><br/>
					<div class="fd">
						<label for="name1">
						 <span>* </span>公司规模：
						  <select style="width: 250px;text-align:center" id="mguimo" name="mguimo" onchange="">
						  	<option value="0"style="color: #e5e5e5">请选择所属分类</option>
								<option value="0~50人">0~50人</option>
								<option value="50~100人">50~100人</option>
								<option value="100~500人">100~500人</option>
								<option value="500人以上">500人以上</option>
						</select>
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>成立年份：
						</label> <input type="text" name="myear" id="myear"
							class="txt8 tTip" onblur="validatenull('myear','myearTip','成立年份')">
						<span id="myearTip">请输入成立年份</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司网站：
						</label> <input type="text" name="minternet" id="minternet"
							class="txt8 tTip"
							onblur="internetValidate('minternet','minternetTip')"> <span
							id="minternetTip">例：http://www.tdjcn.com</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司传真：
						</label> <input type="text" name="mchuanzhen" id="mchuanzhen"
							class="txt8 tTip"
							onblur="validatenull('mchuanzhen','mchuanzhanTip','公司传真')"> <span
							id="mchuanzhanTip">请输入公司传真</span>
					</div><br/>
					
					<div class="fd">
						<label for="name1"> <span>* </span>营业执照：
						</label> <input type="text" name="mzhizhao" id="mzhizhao"
							class="txt8 tTip"
							onblur="validatenull('mzhizhao','mzhizhaoTips','营业执照')"> <span
							id="mzhizhaoTips">例：朝阳区北三环东路三元大厦1栋4层339室</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司简介：
						</label>
					</div>
					<div class="wenben">
						<textarea name="mIntroduce" id="mIntroduce" class="inkuang01"
							onblur="validatenull('mIntroduce','mIntroduceTip','公司简介')"></textarea>
						<span id="mIntroduceTip">要求1000字以内。请用中文详细如实填写贵公司的成立时间、主营范围、品牌及服务优势等；如果内容过于简单或</span>
						含有QQ、电话、网址等不规范信息将无法通过审核。
					</div>
				</div>

				<div class="fd" style="float: left;">
					<label for="name1"> <span>* </span>验 证 码：
					</label> <input type="text" name="ecuserCustomer.id" id="userName"
						class="txt8 tTip" style="width: 100px">

				</div>
				<div style="float: left;">
					<img id="checkCode"
						src="<?php echo base_url()?>index.php/register/checkCode"
						style="cursor: pointer"
						onclick="this.src='<?php echo base_url().'index.php/register/checkCode';?>'+'?'+new Date().getTime()"
						title="看不清"><a href="javascript:void(0)"
						onclick="document.getElementById('checkCode').src='<?php echo base_url().'index.php/register/checkCode';?>'+'?'+new Date().getTime()">
						看不清</a>
				</div>

			</div>

			<div>
				<input type="submit" value="" id="btnSubmit" class="tijiao">
			</div>


		</div>
		<!--infor_2END-->


	</form>

	<!--注册信息END-->


	<!--注册信息START  经销商-->
	<form action="<?php echo base_url()?>index.php/registerDealers"
		id="dealersform" method="post"
		onsubmit="return dearlersValidate('dusernames','duserNameTip','duserpasses','dpasswordTip','dreluserPass','relpasswordTip','demailVali','demialTip','lianxiren','lianxirenTip',
			'dmobiePhone','mobielPhoneTip','ddepartment','ddepartmentTip','dcareer','dcareerTip','companyname','companynameTip','daddress','daddressTip','dmoney',
			 'dcmoneyTypeTip','dcompanyemail','dcompanyemailTips','dcompanyPhone','dcompanyPhoneTips','dfaren','dfarenTip','dpostcode','dpostcodeTips'
			 ,'dyear','dyearTip','dinternet','dinternetTip','dchuanzhen','dchuanzhenTipp','dIntroduce','dIntroduceTip','dyincang','dhuoqu')">

		<div class="information" id="dealers">
			<div class="infor_1">
				<div class="infor_1_1">
					<ul>
						<li class="infor_s1">经销商注册</li>
						<li class="infor_s2">注册步骤:</li>
						<li class="infor_s3">1、填写注册信息</li>
						<li class="infor_s4">2、注册成功</li>
					</ul>
				</div>
				<div class="infor_1_2">
					请认真、仔细地填写以下信息，严肃的商业信息有助于您获得别人的信任，结交潜在的商业伙伴，获取商业机会！<span>*</span>为必填项
				</div>
			</div>
			<!--infor_1END-->
			<!--列表信息单个循环-->
			<div class="infor_2">
				<div class="biaoti">
					<ul>
						<li class="biaoti_1">账户信息</li>
						<li><img src="<?php echo base_url()?>file/images/zhuce_1.gif" /></li>
					</ul>
				</div>
				<div class="fd">
					<label for="name1"> <span>* </span>登录账号：
					</label> <input type="text" name="dusernames" id="dusernames" class="txt8 tTip"  
					onblur="userNameValidate('dusernames','duserNameTip','登录帐号')">
					<span id="duserNameTip" class="duserNameTip">这是你的登录号码</span>
				</div><br/>
				<div class="fd1">
					<label for="name1"> <span>* </span>登录密码：
					</label> <input type="password" name="duserpasses" id="duserpasses"
						class="txt8 tTip"
						onblur="liuershivalidate('duserpasses','dpasswordTip','登录密码')"> <span
						id="dpasswordTip">由6-20位英文母或数字组成，不区分大小写</span>
				</div><br/>
				<div class="fd1">
					<label for="name1"> <span>* </span>确认密码：
					</label> <input type="password" name="dreluserPass"
						id="dreluserPass" class="txt8 tTip"
						onblur="reluserpassValidate('duserpasses','dreluserPass','relpasswordTip')">
					<span id="relpasswordTip">两次输入的密码不一致，请重新输入 </span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>电子邮箱：
					</label> <input type="text" name="demailVali" id="demailVali"
						class="txt8 tTip"
						onblur="emailValidate('demailVali','demialTip','电子邮箱')"> <span
						id="demialTip">请填写有效的电子邮箱，便于找回密码。例：abc@163.com </span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>联 系 人：
					</label> <input type="text" name="lianxiren" id="lianxiren"
						class="txt8 tTip"
						onblur="validatenull('lianxiren','lianxirenTip','联系人')"> <input
						type="radio" name="dGender" value="1" checked="checked">先生 <input
						type="radio" name="dGender" value="0">女士 <span id="lianxirenTip">请填写联系人</span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>移动电话：
					</label> <input type="text" name="dmobiePhone" id="dmobiePhone"
						class="txt8 tTip"
						onblur="mobielphoneVali('dmobiePhone','mobielPhoneTip')"> <span
						id="mobielPhoneTip">建议您填写，以便客户及时与您取得联系</span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>所在部门：
					</label> <input type="text" name="ddepartment" id="ddepartment"
						class="txt8 tTip"
						onblur="validatenull('ddepartment','ddepartmentTip','所在部门')"> <span
						id='ddepartmentTip'>建议您填写，以便客户及时与您取得联系</span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>担任职位：
					</label> <input type="text" name="dcareer" id="dcareer"
						class="txt8 tTip"
						onblur="validatenull('dcareer','dcareerTip','担任职位')"> <span
						id='dcareerTip'>建议您填写，以便客户及时与您取得联系</span>
				</div>
			</div>
			<!--infor_2END-->
			
			<!--列表信息单个循环-->
			<div class="infor_2">
				<div class="biaoti">
					<ul>
						<li class="biaoti_1">公司档案</li>
						<li><img src="<?php echo base_url()?>file/images/zhuce_1.gif" /></li>
					</ul>
				</div>
				<div class="fd">
					<label for="name1"> <span>* </span>公司名称：
					</label> <input type="text" name="companyname" id="companyname" class="txt8 tTip"
						onblur="companyValidate('companyname','companynameTip','dcompanyjiazai','公司名称')"> 
						<span id="companynameTip">请按照营业执照上的企业名称如实填写</span>
						<span id="dcompanyjiazai" class="dcompanyjiazai" style="display:none;">
						<a href="javascript:jiazai('companyname','dyincang','dshow','dhuoquzhi')">加载</a>&nbsp;&nbsp;
						<a href="javascript:bujiazai('dyincang','dshow','dhuoquzhi')">不加载</a>
					</span>
					<input type="hidden" id="dhuoquzhi" class="dhuoquzhi" value="0" name="huoquzhi"/>
				</div><br/>
				<div class="dshow"></div>
				<div id="dyincang" class="dyincang" style="display: inline">
					<div class="fd1">
						<label for="name1"> <span>* </span>注册城市：
						</label> <span class="sel3"> <?php 
						$options ="";
						foreach($area as $val){
							$options .= "<option value={$val['areaid']}>".$val['areaname']."</option>";
						}
						echo "<select id='PCity' name='PCity' onchange='load_area3(this.value)'><option>所在地区</option>".$options."</select>";
						?>
						</span>
						<a href="javascript:areaValue('daddress','dareaname')">添加</a>
						<span id="areaTips">请选择公司注册城市</span>
						<input type=hidden  name="areaid" class="arLast3" />
						<input type=hidden  name="dareaname" id="dareaname" class="arLast3" />
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司地址：
						</label> <input type="text" name="daddress" id="daddress"
							class="txt8 tTip"
							onblur="validatenull('daddress','daddressTip','经营地址')"> <span
							id="daddressTip">例：朝阳区北三环东路三元大厦1栋4层339室</span>
					</div><br/>
					<div class="fd">
						 <label for="name1"> <span>* </span>经营范围：
						 <input type=hidden value=-1 name="catid" class="ctLast3" /> 
						 <span class="category_sel3"> 
						 <?php 
				
							$options ="";
							foreach($category as $val){
								$options .= "<option value={$val['catid']}>".$val['catname']."</option>";
							}
							echo "<select id='dfanwei' name='dfanwei' onchange='load_category3(this.value)'><option value=0>全部分类</option>".$options."</select>";
								
							?>
						</span>
						<a href="javascript:addfanwei('dfanweis')">添加</a>
						<a href="javascript:chongzhi('dfanweis')">重置</a>
						<input type="text" value="" style="width:300px;" name="dfanweis" id="dfanweis" readonly="readonly" />
						 <input type=hidden value=-1 name="catid" class="ctLast3" />	
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司类型： <select
							style="width: 250px;text-align:center" id="dcompanytype" name="dcompanytype" onchange="">
							<option value="0" style="color: #e5e5e5">请选择所属分类</option>
							<option value="私营企业">私营企业</option>
							<option value="民营企业">民营企业</option>
							<option value="外资企业">外资企业</option>
							<option value="上市公司">上市公司</option>
						</select>
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1">
						 <span>* </span>注册资本： 
						 <input type="text"value="" name="dmoney" id="dmoney" onblur="validatenull('dmoney','dcmoneyTypeTip','注册资本')"	/> 
						 <select id="dcmoneyType"name="dcmoneyType" style="width: 123px;" onchange="">
								<option value="0" style="color: #e5e5e5">请选择货币单位</option>
								<option value="人民币">人民币</option>
								<option value="港币">港币</option>
								<option value="美元">美元</option>
								<option value="日元">日元</option>
						</select>
						<span id="dcmoneyTypeTip"></span>
						</label>
					</div><br/>
				
					<div class="fd">
						<label for="name1"> <span>* </span>公司邮件：
						</label> <input type="text" name="dcompanyemail"
							id="dcompanyemail" class="txt8 tTip"
							onblur="validatenull('dcompanyemail','dcompanyemailTips','公司邮件')">
						<span id="dcompanyemailTips">请输入公司邮件，以便更好联系</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司电话：
						</label> <input type="text" name="dcompanyPhone"
							id="dcompanyPhone" class="txt8 tTip"
							onblur="validatenull('dcompanyPhone','dcompanyPhoneTips','公司电话')">
						<span id="dcompanyPhoneTips">请输入公司电话，以便更好联系</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>法人代表：</label> 
						<input type="text" name="dfaren" id="dfaren"
							class="txt8 tTip" onblur="validatenull('dfaren','dfarenTip','法人代表')"> 
						<span id="dfarenTip">请输入公司的法人代表，以便更好的增强企业诚信度</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司邮编：
						</label> <input type="text" name="dpostcode" id="dpostcode"
							class="txt8 tTip"
							onblur="validatenull('dpostcode','dpostcodeTips','法人代表')"> <span
							id="dpostcodeTips">请输入公司邮编，以便更好的增强企业诚信度</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司规模： <select
							style="width: 250px;text-align:center" id="dguimo" name="dguimo" onchange=""><option value="0"
									style="color: #e5e5e5">请选择所属分类</option>
								<option value="0~50人">0~50人</option>
								<option value="50~100人">50~100人</option>
								<option value="100~500人">100~500人</option>
								<option value="500人以上">500人以上</option>
						</select>
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>成立年份：
						</label> <input type="text" name="dyear" id="dyear"
							class="txt8 tTip" onblur="yearValidate('dyear','dyearTip')"> <span
							id="dyearTip">例：1900</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司网站：
						</label> <input type="text" name="dinternet" id="dinternet"
							class="txt8 tTip"
							onblur="internetValidate('dinternet','dinternetTip')"> <span
							id="dinternetTip">例：http://www.tdjcn.com</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司传真：
						</label> <input type="text" name="dchuanzhen" id="dchuanzhen"
							class="txt8 tTip"
							onblur="validatenull('dchuanzhen','dchuanzhenTipp','公司传真')"> <span
							id="dchuanzhenTipp"></span>
					</div><br/>
					
					<div class="fd">
						<label for="name1"> <span>* </span>营业执照：
						</label> <input type="text" name="dzhizhao" id="dzhizhao"
							class="txt8 tTip"
							onblur="validatenull('dzhizhao','dzhizhaoTip','经营执照')"> <span
							id="dzhizhaoTip">例：朝阳区北三环东路三元大厦1栋4层339室</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司简介：
						</label>
					</div>
					<div class="wenben">
						<textarea name="dIntroduce" id="dIntroduce" class="inkuang01"
							onblur="validatenull('dIntroduce','dIntroduceTip','公司简介')"></textarea>
						<span id="dIntroduceTip">要求1000字以内。请用中文详细如实填写贵公司的成立时间、主营范围、品牌及服务优势等；如果内容过于简单或含有QQ、电话、网址等不规范信息将无法通过审核。</span>
					</div>
				</div>
				<div class="fd" style="float: left;">
					<label for="name1"> <span>* </span>验 证 码：
					</label> <input type="text" name="ecuserCustomer.id" id="userName"
						class="txt8 tTip" style="width: 100px">

				</div>
				<div style="float: left;">
					<img id="ccheckCode"
						src="<?php echo base_url()?>index.php/register/checkCode"
						style="cursor: pointer"
						onclick="this.src='<?php echo base_url().'index.php/register/checkCode';?>'+'?'+new Date().getTime()"
						title="看不清"><a href="javascript:void(0)"
						onclick="document.getElementById('ccheckCode').src='<?php echo base_url().'index.php/register/checkCode';?>'+'?'+new Date().getTime()">
						看不清</a>
				</div>

			</div>

			<input type="submit" value="" id="btnSubmit" class="tijiao">

		</div>
		<!--infor_2END-->


		<!--注册信息END-->
	</form>

	<!--注册信息START-->
	<!-- 设计师注册 -->
	<form action="<?php echo base_url()?>index.php/registerDesigner"
		id="dealersform" method="post"
		onsubmit="return dearlersValidate('susernames','susernamesTip','suserpasss','suserpasssTip','sdreluserpass','sdreluserpassTips','sdemails','sdemailTip','sdlianxiren','sdlianxirenTips',
			'sdmobielphone','sdmobielphoneTips','sdepartment','sdepartmentTip','scareer','scareerTip','sdcompany','sdcompanyTips','sdaddress','sdaddressTips','smoney',
			 'smoneyTypeTips','scompanyemail','scompanyemailTips','scompanyPhone','scompanyPhoneTips','sdfaren','sdfarenTips','spostcode','spostcodeTips'
			 ,'sdyears','sdyearTips','sdinternet','sdinternetTips','sdchuanzhen','sdchuanzhenTips','sdIntroduce','sdIntroduceTips','syincang','shuoqu'
			  ,'scompanyjiazai')">
		<div class="information" id="designer">
			<div class="infor_1">
				<div class="infor_1_1">
					<ul>
						<li class="infor_s1">设计师注册</li>
						<li class="infor_s2">注册步骤:</li>
						<li class="infor_s3">1、填写注册信息</li>
						<li class="infor_s4">2、注册成功</li>
					</ul>
				</div>
				<div class="infor_1_2">
					请认真、仔细地填写以下信息，严肃的商业信息有助于您获得别人的信任，结交潜在的商业伙伴，获取商业机会！<span>*</span>为必填项
				</div>
			</div>
		
			<!--infor_1END-->
			<!--列表信息单个循环-->
			<div class="infor_2">
				<div class="biaoti">
					<ul>
						<li class="biaoti_1">账户信息</li>
						<li><img src="<?php echo base_url()?>file/images/zhuce_1.gif" /></li>
					</ul>
				</div>
				<div class="fd">
					<label for="name1"> <span>* </span>登录账号：
					</label> <input type="text" name="susernames" id="susernames" class="txt8 tTip"
						onblur="userNameValidate('susernames','susernamesTip','登录帐号')">
					<span id="susernamesTip" class="susernamesTip">这是你的登录帐号</span>
				</div><br/>
				<div class="fd1">
					<label for="name1"> <span>* </span>登录密码：
					</label> <input type="password" name="suserpasss" id="suserpasss"
						class="txt8 tTip"
						onblur="liuershivalidate('suserpasss','suserpasssTip','登录帐号')"> <span
						id="suserpasssTip">由6-20位英文母或数字组成，不区分大小写</span>
				</div><br/>
				<div class="fd1">
					<label for="name1"> <span>* </span>确认密码：
					</label> <input type="password" name="sdreluserpass"
						id="sdreluserpass" class="txt8 tTip"
						onblur="reluserpassValidate('suserpasss','sdreluserpass','sdreluserpassTips')">
					<span id="sdreluserpassTips">请再输入一遍您上面填写的密码 </span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>电子邮箱：
					</label> <input type="text" name="sdemails" id="sdemails"
						class="txt8 tTip" onblur="emailValidate('sdemails','sdemailTip')">
					<span id="sdemailTip">请填写有效的电子邮箱，便于找回密码。例：abc@163.com </span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>联 系 人：
					</label> <input type="text" name="sdlianxiren" id="sdlianxiren"
						class="txt8 tTip"
						onblur="validatenull('sdlianxiren','sdlianxirenTips','联系人')" />
					<input type="radio" name="sGender" value="1" checked="checked">先生 <input
						type="radio" name="sGender" value="0">女士 <span
						id="sdlianxirenTips">请输入联系人</span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>移动电话：
					</label> <input type="text" name="sdmobielphone" id="sdmobielphone"
						class="txt8 tTip"
						onblur="mobielphoneVali('sdmobielphone','sdmobielphoneTips')"> <span
						id="sdmobielphoneTips">建议您填写，以便客户及时与您取得联系</span>
						<div class="fd">
				<div><br/>
					<label for="name1"> <span>* </span>所在部门：
					</label> <input type="text" name="sdepartment" id="sdepartment"
						class="txt8 tTip"
						onblur="validatenull('sdepartment','sdepartmentTip','所在部门')"> <span
						id='sdepartmentTip'>建议您填写，以便客户及时与您取得联系</span>
				</div><br/>
				<div class="fd">
					<label for="name1"> <span>* </span>担任职位：
					</label> <input type="text" name="scareer" id="scareer"
						class="txt8 tTip"
						onblur="validatenull('scareer','scareerTip','担任职位')"> <span
						id='scareerTip'>建议您填写，以便客户及时与您取得联系</span>
				</div>
			</div>
			<!--infor_2END-->
			<div class="infor_2">
				<div class="biaoti">
					<ul>
						<li class="biaoti_1">公司档案</li>
						<li><img src="<?php echo base_url()?>file/images/zhuce_1.gif" /></li>
					</ul>
				</div>
				<div class="fd" >
					<label for="name1"> <span>* </span>公司名称：
					</label> <input type="text" name="sdcompany" id="sdcompany" class="txt8 tTip"
						onblur="companyValidate('sdcompany','sdcompanyTips','scompanyjiazai','公司名称')"> 
					<span id="sdcompanyTips">请按照营业执照上的企业名称如实填写</span>
					<span id="scompanyjiazai" class="scompanyjiazai" style="display:none;">
					<a href="javascript:jiazai('sdcompany','syincang','sshow','shuoquzhi')">加载</a>&nbsp;&nbsp;
					<a href="javascript:bujiazai('syincang','sshow','shuoquzhi')">不加载</a>
					</span>
					<input type="hidden" id="shuoquzhi" class="shuoquzhi" value="0" name="shuoquzhi"/>
				</div><br/>
				<div class="sshow"></div>
				<div id="syincang" class="syincang" style="display: inline">
					<div class="fd1">
						<label for="name1"> <span>* </span>注册城市：
						</label> <span class="sel4"> <?php 
						$options ="";
						foreach($area as $val){
							$options .= "<option value={$val['areaid']}>".$val['areaname']."</option>";
						}
						echo "<select id='spcity' name='spcity' onchange='load_area4(this.value)'><option>所在地区</option>".$options."</select>";
						?>
						</span>
						<a href="javascript:areaValue('sdaddress','sareaname')">添加</a>
						<span id="areaTips">请选择公司注册城市</span>
						<input type=hidden  name="areaid" class="arLast4" />
						<input type=hidden name="sareaname" id="sareaname" class="arLast4" />
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>公司地址：
						</label> <input type="text" name="sdaddress" id="sdaddress"
							class="txt8 tTip"
							onblur="validatenull('sdaddress','sdaddressTips','公司地址')"> <span
							id="sdaddressTips">例：朝阳区北三环东路三元大厦1栋4层339室</span>
					</div><br/>
					<div class="fd">
						<label for="name1"> <span>* </span>经营范围： <input type=hidden
							value=-1 name="catid" class="ctLast4" /> <span
							class="category_sel4"> <?php 
				
							$options ="";
							foreach($category as $val){
								$options .= "<option value={$val['catid']}>".$val['catname']."</option>";
							}
							echo "<select id='sfanwei' name='sfanwei' onchange='load_category4(this.value)'><option value=0>全部分类</option>".$options."</select>";
								
							?>
						</span>
						<a href="javascript:addfanwei('sfanweis')">添加</a>
						<a href="javascript:chongzhi('sfanweis')">重置</a>
						<input type="text" value="" style="width:300px;" name="sfanweis" id="sfanweis" readonly="readonly" />
						 <input type=hidden value=-1 name="catid" class="ctLast4" />	
						</label>
					</div><br/>
					
					<div class="fd">
						<label for="name1"> <span>* </span>公司类型：
						 <select id="scompanytype" name="scompanytype" style="width: 250px;text-align:center;" onchange="">
							<option value="0"style="color: #e5e5e5">请选择所属分类</option>
							<option value="私营企业">私营企业</option>
							<option value="民营企业">民营企业</option>
							<option value="外资企业">外资企业</option>
							<option value="上市公司">上市公司</option>
						</select>
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1">&nbsp; 注册资本：
						 <input type="text" onblur="validatenull('smoney','smoneyTypeTips','注册资本')"
							value="" name="smoney" id="smoney" /> <select id="smoneyType"
							name="smoneyType" style="width: 123px;" onchange="">
								<option value="0" style="color: #e5e5e5">请选择货币单位</option>
								<option value="人民币">人民币</option>
								<option value="港币">港币</option>
								<option value="美元">美元</option>
								<option value="日元">日元</option>
						</select>
						<span id="smoneyTypeTips"></span>
						</label>
					</div><br/>
				
					<div class="fd">
						<label for="name1">&nbsp; 公司邮件：
						</label> <input type="text" name="scompanyemail"
							id="scompanyemail" class="txt8 tTip"
							onblur="validatenull('scompanyemail','scompanyemailTips','公司邮件')">
						<span id="scompanyemailTips">请输入公司邮件，以便更好联系</span>
					</div><br/>
					<div class="fd">
						<label for="name1">&nbsp; 公司电话：
						</label> <input type="text" name="scompanyPhone"
							id="scompanyPhone" class="txt8 tTip"
							onblur="validatenull('scompanyPhone','scompanyPhoneTips','公司电话')">
						<span id="scompanyPhoneTips">请输入公司电话，以便更好联系</span>
					</div><br/>
					<div class="fd">
						<label for="name1">&nbsp; 法人代表：
						</label> <input type="text" name="sdfaren" id="sdfaren"
							class="txt8 tTip"
							onblur="validatenull('sdfaren','sdfarenTips','法人代表')"> <span
							id="sdfarenTips">请输入公司的法人代表，以便更好的增强企业诚信度</span>
					</div><br/>
					<div class="fd">
						<label for="name1">&nbsp; 公司邮编：
						</label> 
						<input type="text" name="spostcode" id="spostcode" class="txt8 tTip"
							onblur="validatenull('spostcode','spostcodeTips','公司邮编')"> 
						<span id="spostcodeTips">请输入公司邮编，以便更好的增强企业诚信度</span>
					</div><br/>
					<div class="fd">
						<label for="name1">&nbsp; 公司规模： <select id="sguimo" name="sguimo"
							style="width: 250px;text-align:center" onchange=""><option value="0"
									style="color: #e5e5e5">请选择所属分类</option>
								<option value="2243">0~50人</option>
								<option value="230">50~100人</option>
								<option value="1632">100~500人</option>
								<option value="1764">500人以上</option>
						</select>
						</label>
					</div><br/>
					<div class="fd">
						<label for="name1">&nbsp; 成立年份：
						</label> <input type="text" name="sdyears" id="sdyears"
							class="txt8 tTip" onblur="yearValidate('sdyears','sdyearTips')"> <span
							id="sdyearTips">请按照1990-01-01的格式填写公司年份</span>
					</div><br/>
					<div class="fd">
						<label for="name1">&nbsp; 公司网站：
						</label> <input type="text" name="sdinternet" id="sdinternet"
							class="txt8 tTip"
							onblur="internetValidate('sdinternet','sdinternetTips')"> <span
							id="sdinternetTips">例：http://www.tdjcn.com</span>
					</div><br/>
					<div class="fd">
						<label for="name1">&nbsp; 公司传真：
						</label> <input type="text" name="sdchuanzhen" id="sdchuanzhen"
							class="txt8 tTip"
							onblur="validatenull('sdchuanzhen','sdchuanzhenTips','公司传真')"> <span
							id="sdchuanzhenTips">请输入公司传真</span>
					</div><br/>
					<div class="fd">
						<label for="name1">&nbsp; 营业执照：
						</label> <input type="text" name="sdzhizhao" id="sdzhizhao"
							class="txt8 tTip"
							onblur="validatenull('sdzhizhao','sdzhizhaoTips','营业执照')"> <span
							id="sdzhizhaoTips">例：朝阳区北三环东路三元大厦1栋4层339室</span>
					</div><br/>
					<div class="fd">
						<label for="name1">&nbsp; 公司简介：
						</label>
					</div>
					<div class="wenben">
						<textarea name="sdIntroduce" id="sdIntroduce" class="inkuang01"
							onblur="validatenull('sdIntroduce','sdIntroduceTips','公司简介')"></textarea>
						<span id="sdIntroduceTips">要求1000字以内。请用中文详细如实填写贵公司的成立时间、主营范围、品牌及服务优势等；如果内容过于简单或</span>
						含有QQ、电话、网址等不规范信息将无法通过审核。
					</div>
				</div>

				<div class="fd" style="float: left;">
					<label for="name1"> <span>* </span>验 证 码：
					</label> <input type="text" name="ecuserCustomer.id" id="userName"
						class="txt8 tTip" style="width: 100px">

				</div>
				<div style="float: left;">
					<img id="checkCodes"
						src="<?php echo base_url()?>index.php/register/checkCode"
						style="cursor: pointer"
						onclick="this.src='<?php echo base_url().'index.php/register/checkCode';?>'+'?'+new Date().getTime()"
						title="看不清"><a href="javascript:void(0)"
						onclick="document.getElementById('checkCodes').src='<?php echo base_url().'index.php/register/checkCode';?>'+'?'+new Date().getTime()">
						看不清</a>
				</div>

			</div>

			<input type="submit" value="" id="btnSubmit" class="tijiao">

		</div>
		<!--infor_2END-->



	</form>
	<!--注册信息END-->
	<!--站底START-->
	<div class="foot">
		<div class="foot_3">
			<p>通达建网咯科技（深圳）有限公司 版权所有 Copyright 2010-2013 tdjcn.com</p>
		</div>
	</div>
	<!--站底END-->
</body>
</html>

