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
			<div class="col-xs-6 col-xs-push-3">
				<div>

				</div>
				<div>

				<div>
			</div>
			<!--the first column-->
			<div class="col-xs-3 col-xs-pull-6 pr100">
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
			<div class="col-xs-3">

			</div>
		</div>
		<div class="well well-sm">

		</div>
	</div>
</main>

<?php include ('includes/footer.html'); ?>