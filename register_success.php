<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '注册成功';
include ('includes/header.html')
?>

<main role="main">
	<div class="container">
		<div class="jumbotron">	
			<h1 class="text-center"><small>注册成功</small><i class="icon fa fa-check"></i></h1>
			<p>感谢您的注册！激活码已经发送至您的邮箱。请点击邮件中的链接以激活您的账户。</p>
			<p class="text-center">3秒后自动跳转到首页。</p>
			<?php $url = BASE_URL . 'index_new.php'; header('Refresh: 3; index_new.php'); ?>
		</div>
	</div>
</main>

<?php include ('includes/footer.html')  ?>