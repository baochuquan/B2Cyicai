<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '产品管理';
include ('includes/header.html');

//redirect if is not admin or unlogged in
if (!isset($_SESSION['username']) || ($_SESSION['userlevel'] == 0)) {
	$url = BASE_URL .'index.php';
	ob_end_clean();
	header("Location: $url");
	exit();
}
?>

<main role='main'>
	<div class="container">
		<h1 class="page-header">产品管理</h1>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#allusers" aria-controls="allusers" role="tab" data-toggle="tab">所有产品</a></li>
			<li role="presentation"><a href="#adduser" aria-controls="adduser" role="tab" data-toggle="tab">添加产品</a></li>
			<li role="presentation"><a href="#edituser" aria-controls="edituser" role="tab" data-toggle="tab">编辑产品</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="allusers">

				</div>

				<div role="tabpanel" class="tab-pane" id="adduser">
					<div>
						<h1>哈哈哈哈...</h1>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="edituser">
					<div>
						<h1>喝喝喝</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php include ('includes/footer.html')  ?>