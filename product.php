<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '登录';
include ('includes/header.html');



?>

<main role="main">
	<div class="container">
		<div class="row">
			<!--picture carousel-->
			<div class="col-xs-6 col-xs-push-3">
				<!--picture carousel-->
				<div id="homepage-feature" class="carousel slide mt20">
					<ol class="carousel-indicators">
						<li data-target="#homepage-feature" data-slide-to="0" class="active"></li>
						<li data-target="#homepage-feature" data-slide-to="1"></li>
						<li data-target="#homepage-feature" data-slide-to="2"></li>
						<li data-target="#homepage-feature" data-slide-to="3"></li>
					</ol>
					<!--Wrappers for slides-->
					<div class="carousel-inner">
						<div class="item active">
							<img src="img/okwu.jpg" alt="Product one">
						</div>
						<div class="item">	<!--item-->
							<img src="img/okwu-athletics.jpg" alt="Product two">
						</div>
						<div class="item">
							<img src="img/bartlesvillecf.jpg" alt="Product three">
						</div>
						<div class="item">
							<img src="img/emancipation.jpg" alt="Product four">
						</div>
					</div>
					<!--controls-->
					<a class="carousel-control left" href="#homepage-feature" data-slide="prev">
						<span class="icon fa fa-chevron-left"></span>

					<a class="carousel-control right" href="#homepage-feature" data-slide="next">
						<span class="icon fa fa-chevron-right"></span>
					</a>
				</div>	<!--carousel-->
				<hr class="mt20 mb20"></hr>
				<div class="row">
					<div class="col-xs-6 text-center">
						<button type="button" class="btn btn-warning btn-lg btn-block">立刻购买</button>
					</div>
					<div class="col-xs-6 text-center">
						<button type="button" class="btn btn-danger btn-lg btn-block"><i class="fa fa-shopping-cart"></i> 加入购物车</button>
					</div>
				</div>
			</div>
			<!--the first column-->
			<div class="col-xs-3 col-xs-pull-6 pr50">
				<div class="row ">
					<div class="col-xs-12 mt20 mb20">
						<a href="#">
							<img src="holder.js/60x60/auto" alt="小狸丢丢" class="img-circle box-shadow pull-left mr10">
							<vr></vr>
							<div class="pull-left">
								<p class="margin-bottom-none"><small class="text-muted serif">Photo by</small></p>
								<h6 class="margin-bottom-none margin-top-none">小三黑~</h6>
								<small><span>关注</span></small>
							</div>
						</a>
					</div>
					<div class="col-xs-12">
						<p class="mb5"><strong>产品名字</strong></p>
						<div>
							分类
						</div>
						<div class="text-muted mt30">
							<h5 class="mt5 mb5">产品描述</h5>
							<div>
								这是司马大师魔法师的发大水发斯蒂芬大丰收大法师加多少技术监督局。
							</div>
							<hr></hr>
							<div>
								<h5 class="padding-top-none pb10 text-center">喜欢这件宝贝</h5>
									<button type="button" class="btn btn-primary btn-lg btn-block">收藏</button>
							</div>
							<hr></hr>
						</div>
					</div>
					<div class="col-xs-12">
						<h5 class="padding-top-none pb10 margin-bottom-none text-muted text-center">分享</h5>
						<div>
							<ul class="social">
								<li><a href="#" title="Tiwtter Profile"><span class="icon fa fa-twitter"></span></a></li>
								<li><a href="#" title="Facebook Page"><span class="icon fa fa-facebook"></span></a></li>
								<li><a href="#" title="qq Profile"><span class="icon fa fa-qq"></span></a></li>
								<li><a href="#" title="weibo Profile"><span class="icon fa fa-weibo"></span></a></li>
								<li><a href="#" title="weixin Profile"><span class="icon fa fa-weixin"></span></a></li>
							</ul>
						</div>
						<hr></hr>
					</div>
				</div>
			</div><!--the first column-->
			<!--the third column-->
			<div class="col-xs-3">
				<hr class="mb10"></hr>
				<div class="row">
					<div class="col-xs-12">
						<span class="pull-left" style="font-size:1.2em"><strong>价格:</strong></span>
						<span class="pull-left ml20" style="font-size:1.2em"><strong>￥100</strong></span>
					</div>
					<div class="col-xs-12">
						<span class="pull-left text-muted">原价:</span>
						<span class="pull-left text-muted ml20" style="text-decoration:line-through">￥120</span>
					</div>
				</div>
				<hr class="mb10 mt10"></hr>
				<div class="row">
					<div class="col-xs-12">
						<span class="clearfix" style="font-size:1.2em"><strong>尺寸选择</strong></span>
						<div class="radio">
						  <label>
						    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
						    <div>
						    	<span class="pr20"><strong>型号:S<strong></span>
						    	<span class="pr20"><strong>尺码:168<strong></span>
						    </div>
						    <div>
						    	<span class="text-muted pr5"><small>衣长:68</small></span>
						    	<span class="text-muted pr5"><small>肩宽:40</small></span>
						    	<span class="text-muted pr5"><small>胸围:89</small></span>
						    	<span class="text-muted pr5"><small>袖长:17</small></span>
						    	<span class="text-muted pr5"><small>领围:40.5</small></span>
						    </div>
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
						    <div>
						    	<span class="pr20"><strong>型号:M<strong></span>
						    	<span class="pr20"><strong>尺码:170<strong></span>
						    </div>
						    <div>
						    	<span class="text-muted pr5"><small>衣长:69.5</small></span>
						    	<span class="text-muted pr5"><small>肩宽:41.5</small></span>
						    	<span class="text-muted pr5"><small>胸围:93</small></span>
						    	<span class="text-muted pr5"><small>袖长:18</small></span>
						    	<span class="text-muted pr5"><small>领围:40.5</small></span>
						    </div>
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
						    <div>
						    	<span class="pr20"><strong>型号:L<strong></span>
						    	<span class="pr20"><strong>尺码:175<strong></span>
						    </div>
						    <div>
						    	<span class="text-muted pr5"><small>衣长:71</small></span>
						    	<span class="text-muted pr5"><small>肩宽:43</small></span>
						    	<span class="text-muted pr5"><small>胸围:98</small></span>
						    	<span class="text-muted pr5"><small>袖长:19</small></span>
						    	<span class="text-muted pr5"><small>领围:42</small></span>
						    </div>
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
						    <div>
						    	<span class="pr20"><strong>型号:XL<strong></span>
						    	<span class="pr20"><strong>尺码:180<strong></span>
						    </div>
						    <div>
						    	<span class="text-muted pr5"><small>衣长:72.5</small></span>
						    	<span class="text-muted pr5"><small>肩宽:44.5</small></span>
						    	<span class="text-muted pr5"><small>胸围:103</small></span>
						    	<span class="text-muted pr5"><small>袖长:20</small></span>
						    	<span class="text-muted pr5"><small>领围:43.5</small></span>
						    </div>
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
						    <div>
						    	<span class="pr20"><strong>型号:XXL<strong></span>
						    	<span class="pr20"><strong>尺码:180<strong></span>
						    </div>
						    <div>
						    	<span class="text-muted pr5"><small>衣长:73.5</small></span>
						    	<span class="text-muted pr5"><small>肩宽:46</small></span>
						    	<span class="text-muted pr5"><small>胸围:110</small></span>
						    	<span class="text-muted pr5"><small>袖长:21</small></span>
						    	<span class="text-muted pr5"><small>领围:43.5</small></span>
						    </div>
						  </label>
						</div>
					</div>
				</div>	
				<hr class="mb10 mt10"></hr>
				<div class="row">
					<div class="col-xs-8">
						<span class="clearfix" style="font-size:1.2em"><strong>颜色分类</strong></span>
						<div class="radio">
							<label class="radio-inline">
								<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 白色
							</label>
							<label class="radio-inline">
								<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 黑色
							</label>
							<label class="radio-inline">
								<input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 蓝色
							</label>
						</div>
					</div>
					<div class="col-xs-4">
						<span class="clearfix" style="font-size:1.2em"><strong>数量</strong></span>
						<div class="mt10 mb10">
							<input id="min" name="" type="button" value="-" />
							<input id="text_box" name="" type="text" value="1" style="width:25px" />
							<input id="add" name="" type="button" value="+" />
						</div>
					</div>
				</div>
				<hr class="mb10 mt10"></hr>
			</div><!--the third column-->
		</div>
	</div>
</main>

<?php include ('includes/footer.html'); ?>
