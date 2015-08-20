<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '衣彩';
include ('includes/header.html');

if (isset($_GET['productid'])) {
	// Update the database...
	require (MYSQL);
	$q = "SELECT pre_price, cur_price, product_name, decription FROM products WHERE product_id=" . $_GET['productid'];
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	$productinfo = mysqli_fetch_array($r, MYSQLI_ASSOC);
	echo '	

<main role="main">
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-xs-push-3">
				<div id="homepage-feature" class="carousel slide mt20">
					<ol class="carousel-indicators">';
					
	$q = "SELECT COUNT(img_id) FROM imges WHERE product_id=" . $_GET['productid'];
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	$num = mysqli_fetch_array($r, MYSQLI_NUM);

	
	for ($i=0; $i < $num[0]; $i++) { 
		echo '
						<li data-target="#homepage-feature" data-slide-to="' . $i . '" ';
		if ($i == 0) {
			echo 															'class="active"';
		}
		echo 																				'></li>';
	}
	echo '						
					</ol>
					<div class="carousel-inner">';

/*
	echo '
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
						</div>';
*/
	$q = "SELECT img_name FROM imges WHERE product_id=" . $_GET['productid'];
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	$i = 0;
	while($imges = mysqli_fetch_array($r, MYSQLI_ASSOC)) { 
		if ($i == 0) {
			echo 		'<div class="item active">
							<img src="img/' . $imges['img_name'] . '" alt="ProductImg">
						</div>';
		}
		else {
			echo 		'<div class="item">
							<img src="img/' . $imges['img_name'] . '" alt="ProductImg">
						</div>';
		}
		$i += 1;
	}
	echo '
					</div>

					<a class="carousel-control left" href="#homepage-feature" data-slide="prev">
						<span class="icon fa fa-chevron-left"></span>

					<a class="carousel-control right" href="#homepage-feature" data-slide="next">
						<span class="icon fa fa-chevron-right"></span>
					</a>
				</div>

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

			
			<div class="col-xs-3 col-xs-pull-6 pr50">
				<div class="row ">
					<div class="col-xs-12 mt20 mb20">
						<a href="#">
							<img src="holder.js/60x60/auto" alt="小三黑~" class="img-circle box-shadow pull-left mr10">
							<vr></vr>
							<div class="pull-left">
								<p class="margin-bottom-none"><small class="text-muted serif">Photo by</small></p>
								<h6 class="margin-bottom-none margin-top-none">小三黑~</h6>
								<small><span>关注</span></small>
							</div>
						</a>
					</div>
					<div class="col-xs-12">
						<p class="mb5"><strong>'. $productinfo['product_name'] . '</strong></p>
						<div>';

	$q = "select tag_name from tags INNER JOIN product_tag USING(tag_id) INNER JOIN products USING(product_id) WHERE product_id="
		. $_GET['productid'];
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

	while ($tagname = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo  				'<span class="mr10">' . $tagname['tag_name'] . '</span>					
						';
	}
	echo '				</div>
						<div class="text-muted mt30">
							<h5 class="mt5 mb5">产品描述</h5>
							<div>' . 
								$productinfo['decription'] . '
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
			</div>
		
			<div class="col-xs-3">
				<hr class="mb10"></hr>
				<div class="row">
					<div class="col-xs-12">
						<span class="pull-left" style="font-size:1.2em"><strong>价格:</strong></span>
						<span class="pull-left ml20" style="font-size:1.2em"><strong>￥' . $productinfo['cur_price'] . '</strong></span>
					</div>
					<div class="col-xs-12">
						<span class="pull-left text-muted">原价:</span>
						<span class="pull-left text-muted ml20" style="text-decoration:line-through">￥' . $productinfo['pre_price'] . '</span>
					</div>
				</div>
				<hr class="mb10 mt10"></hr>
				<div class="row">
					<div class="col-xs-12">
						<span class="clearfix" style="font-size:1.2em"><strong>尺寸选择</strong></span>';
						

	$q = "SELECT size_name FROM size INNER JOIN product_size USING(size_id) INNER JOIN products USING(product_id) WHERE product_id="
		. $_GET['productid'];
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

	while ($sizename = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		switch ($sizename['size_name']) {
			case 'S':
				echo '
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
							</div>';
				break;
			case 'M':
				echo '
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
							</div>';
				break;
			case 'L':
				echo '
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
							</div>';
				break;
			case 'XL':
				echo '
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
							</div>';
				break;
			case 'XXL':
				echo '
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
							</div>';
				break;
			case 'XXXL':
				echo '
						<div class="radio">
							  <label>
							    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
							    <div>
							    	<span class="pr20"><strong>型号:XXXL<strong></span>
							    	<span class="pr20"><strong>尺码:185<strong></span>
							    </div>
							    <div>
							    	<span class="text-muted pr5"><small>衣长:75</small></span>
							    	<span class="text-muted pr5"><small>肩宽:47.5</small></span>
							    	<span class="text-muted pr5"><small>胸围:117</small></span>
							    	<span class="text-muted pr5"><small>袖长:23</small></span>
							    	<span class="text-muted pr5"><small>领围:45</small></span>
							    </div>
							  </label>
							</div>';
				break;
			default:
				break;
		}
	}
	echo '
					</div>
				</div>	
				<hr class="mb10 mt10"></hr>
				<div class="row">
					<div class="col-xs-8">
						<span class="clearfix" style="font-size:1.2em"><strong>颜色分类</strong></span>
						<div class="radio">';

	$q = "select color_name from color INNER JOIN product_color USING(color_id) INNER JOIN products USING(product_id) WHERE product_id="
		. $_GET['productid'];
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

	$j = 0;
	while ($colorname = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '
							<label class="radio-inline">
								<input type="radio" name="inlineRadioOptions" id="inlineRadio' . $j . '" value="' . $colorname['color_name'] . '"> ' . $colorname['color_name'] . '
							</label>
					';
	}
	echo '
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
			</div>
		</div>
	</div>
</main>';
}
else { // Redirect.
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}
?>

<?php include ('includes/footer.html'); ?>