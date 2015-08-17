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
        <h1 class="page-header">管理面板</h1>
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
        <h2 class="sub-header">今日订单</h2>
        <table class="table table-striped">
          <thead>
            <tr class="col-name">
              <th class="baobei">宝贝</th>
              <th class="price">单价(元)</th>
              <th class="quantity">数量</th>
              <th class="amount">实付款(元)</th>
              <th class="trade-status">
                <div class="trade-status">
                  <select id="J_TradeStatusHandle" class="J_NiceSelect" data-config='{"w": 86, "h": 15}'>
                    <option data-msg="交易状态" value="ALL" >交易状态</option>
                    <option data-msg="等待买家付款" value="NOT_PAID" >等待买家付款</option>
                    <option data-msg="买家已付款" value="PAID" >买家已付款</option>
                    <option data-msg="卖家已发货" value="SEND" >卖家已发货</option>
                    <option data-msg="交易成功" value="SUCCESS" >交易成功</option>
                    <option data-msg="交易关闭" value="DROP" >交易关闭</option>
                    <option data-msg="退款中的订单" value="REFUNDING" >退款中的订单</option>
                  </select>
                </div>
              </th>
              <th class="trade-operate">交易操作</th>
            </tr>
          </thead>
        </table>
        <!--<div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>编号</th>
                <th>买家</th>
                <th>买家电话</th>
                <th>收件人</th>
                <th>收件人地址</th>
                <th>收件人电话</th>
                <th>支付状态</th>
                <th>发件状态</th>
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
  	    </div>-->
      </div>
    </div>
	</div>
</main>

<?php include ('includes/footer.html')  ?>