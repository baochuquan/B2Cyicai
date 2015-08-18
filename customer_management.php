<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '客户管理';
include ('includes/header.html');

//redirect if is not admin or unlogged in
if (!isset($_SESSION['username']) || ($_SESSION['userlevel'] == 0)) {
	$url = BASE_URL .'index.php';
	ob_end_clean();
	header("Location: $url");
	exit();
}
?>

<main role="main">
	<div class="container">
		<h1 class="page-header">客户管理</h1>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#allusers" aria-controls="allusers" role="tab" data-toggle="tab">所有客户</a></li>
			<li role="presentation"><a href="#adduser" aria-controls="adduser" role="tab" data-toggle="tab">添加客户</a></li>
			<li role="presentation"><a href="#edituser" aria-controls="edituser" role="tab" data-toggle="tab">编辑客户</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="allusers">

					<?php  
					// Need the database connection:
					require (MYSQL);

					// Define the query...
					$q = "SELECT COUNT(user_id) FROM users WHERE userlevel=0";
					$r = @mysqli_query($dbc, $q);
					// Get the mount of registered users
					$usermount = mysqli_fetch_array($r, MYSQLI_NUM);
					echo '<div class="panel panel-info">
					  			<div class="panel-heading">
					    			<h3 class="panel-title">总客户量：' . $usermount[0] . '</h3>
					  			</div>
					  			<div class="panel-body">';
					echo 			'<table class="table table-striped">
										<thead>
			            					<tr>
							            		<th>编号</th>
									            <th>用户ID</th>
									            <th>用户名</th>
									            <th>用户邮箱</th>
									            <th>注册时间</th>
									            <th></th>
								        	</tr>
							    		</thead>
							    		<tbody>';

					// Fetch all the information of users;
					$q = "SELECT user_id, username, usermail, regist_date FROM users WHERE userlevel=0 ORDER BY regist_date DESC";
					$r = @mysqli_query($dbc, $q);

					$i = 0;
					while ($eachuser = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
						$i++;
						echo 				'<tr>
												<td>' . $i . '</td>
												<td>' . $eachuser['user_id'] . '</td>
												<td>' . $eachuser['username'] . '</td>
												<td>' . $eachuser['usermail'] . '</td>
												<td>' . $eachuser['regist_date'] . '</td>
											</tr>';
					}
					echo 				'</tbody>
									</table>
								</div>
							</div>';
					mysqli_free_result($r);
					mysqli_close($dbc);
					?>
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