<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '产品管理';
include ('includes/header.html')
?>


<main role="main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-2 sidebar text-center">
				<ul class="nav nav-sidebar">
					<li class="active">订单</li>
          <li><a href="#">今日订单</a></li>
				  <li><a href="#">未完成订单</a></li>
          <li><a href="#">已完成订单</a></li>
          <li><a href="#">订单查询</a></li>
				</ul>
				<ul class="nav nav-sidebar">
      		<li class="active">产品</li>
      		<li><a href="">添加产品</a></li>
      		<li><a href="">管理产品</a></li>
    		</ul>
				<ul class="nav nav-sidebar">
      		<li class="active">客户</li>
      		<li><a href="">客户管理</a></li>
      		<li><a href="">客户查询</a></li>
    		</ul>
			</div>
      <div class="col-xs-10 col-xs-offset-2">
	    	<h1 class="page-header">管理面板</h1>
        <h2 class="sub-header">Section title</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Header</th>
                <th>Header</th>
                <th>Header</th>
                <th>Header</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1,001</td>
                <td>Lorem</td>
                <td>ipsum</td>
                <td>dolor</td>
                <td>sit</td>
              </tr>
              <tr>
                <td>1,013</td>
                <td>torquent</td>
                <td>per</td>
                <td>conubia</td>
                <td>nostra</td>
              </tr>
              <tr>
                <td>1,014</td>
                <td>per</td>
                <td>inceptos</td>
                <td>himenaeos</td>
                <td>Curabitur</td>
              </tr>
              <tr>
                <td>1,015</td>
                <td>sodales</td>
                <td>ligula</td>
                <td>in</td>
                <td>libero</td>
              </tr>
            </tbody>
          </table>
  	    </div>
      </div>
    </div>
	</div>
</main>

<?php include ('includes/footer.html')  ?>