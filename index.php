<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '衣彩';
include ('includes/header.html')
?>

<main role="main">
	<!--picture carousel-->
	<div id="homepage-feature" class="carousel slide">
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

	<div class="container">
		<div class="row">
			<h1 class="hidden">店主</h1>
			<h1 class="text-center"><small>~~店主~~</small></h1>
			<div class="col-xs-4">
				<p class="text-center"><a href="#"><img src="holder.js/50x50/auto" alt="小狸丢丢" class="img-circle box-shadow"><br/><span>小狸丢丢</span></a></p>
			</div>
			<div class="col-xs-4">
				<p class="text-center"><a href="#"><img src="holder.js/75x75/auto" alt="水木衣彩" class="img-circle"><br/><span>水木衣彩</span></a></p>
			</div>
			<div class="col-xs-4">
				<p class="text-center"><a href="#"><img src="holder.js/50x50/auto" alt="小三黑~ " class="img-circle"><br/><span>小三黑~ </span></a></p>
			</div>
		</div>
	</div><!--.container-->

	<div class="container">
		<div class="page-header">
			<h2 class="text-center"><small>全部宝贝</small></h2>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<div class="thumbnail">
					<img src="holder.js/300x300/auto" alt="picture">
					
						<h3>Product</h3>
						<p>This text describes the above product a little not too much but just enough or maybe a little more.this product just really deserves it!</p>
						<p><a href="#" class="btn btn-primary" role="button">加入购物车</a></p>
				
				</div>
			</div>
			<div class="col-xs-4">
				<div class="thumbnail">
					<img src="holder.js/300x300/auto" alt="picture">
						<h3>Product</h3>
						<p>This text describes the above product a little not too much.</p>
						<p><a href="#" class="btn btn-primary" role="button">加入购物车</a></p>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="thumbnail">
					<img src="holder.js/300x300/auto" alt="picture">
						<h3>Product</h3>
						<p>This text describes the above produ and, well, this product just really deserves it!</p>
						<p><a href="#" class="btn btn-primary" role="button">加入购物车</a></p>
				
				</div>
			</div>
			<!--a set of three products-->
		</div>
	</div>
</main>
<?php include ('includes/footer.html')  ?>
