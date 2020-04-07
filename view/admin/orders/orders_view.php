<?php
require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$orders_db = OrdersDb::getInstance();
$search='';

(!isset($_GET['page'])) ?$page = 1 : $page =$_GET['page'];

$orders = $orders_db->GetAllOrder($page, $pageSize=25);

$total = count($orders);
$PageCount = ceil($total/$pageSize);


//echo '<pre>'; print_r($orders);die();


require (ROOT_PATH . '/view/elements/head_section.php');
?>
<style>
.table tbody tr td span{
	font-size:14px;
}
</style>

<br><br>
<div class="container content bg-white p-4 mt-4">
	<div class="row">
		<!-- Left side menu -->
	<div class="menu col-2">
			<div class="card">
				<div class="card-header">
					<h2>Actions</h2>
				</div>
				<div class="card-content">
					<a href="<?php echo BASE_URL . 'view/admin/admin_panel.php' ?>">Manage orders</a>
					<a href="<?php echo BASE_URL . 'view/admin/topics/topics_view.php' ?>">Manage Topics</a>
					<a href="<?php echo BASE_URL . 'view/admin/users/users_view.php' ?>">Manage Users</a>
					<a href="<?php echo BASE_URL . 'view/admin/reviews/reviews_view.php' ?>">Manage comment</a>
				</div>
			</div>
			<div style="height:10px"></div>
	</div>

	<!-- Display records from DB-->
	
	<br><br><br>
	<div class="table-div col-8 table-hover" >
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/view/elements/messages.php') ?>

			<div class="container mb-2">
				<div class="row">
					<div class="col-8">
						<div class='d-flex justify-content-center'>
							<form method="post" action='admin_panel.php' class="form-inline"> 
								<input type="text" name="search" class="form-control mr-sm-2" value="<?=$search;?>">
								<input type="submit" name="submit_search" value="Search" class="btn btn-outline-success" />
								<br/>
							</form>
						</div>
					</div>
					<div class="mb-2 col-4" style="float:right">
						<a class="btn btn-outline-primary" href="<?php echo BASE_URL . 'view/admin/products/order_create.php' ?>" style="float: right;"><i class="fa fa-plus-circle"></i> Create order</a>
					</div>
				</div>
			</div>
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/view/elements/messages.php') ?>

			<?php if (empty($orders)): ?>
				<h1 style="text-align: center; margin-top: 20px;">No orders in the database.</h1>
			<?php else: ?>
				<table class="table admin-table">
					<thead>
						<th><b>N</b></th>
						<th>Order Nr:</th>
						<th>Order Product Nr:</th>
						<th>Product Name</th>
						<th>The purchase Price</th>
						<th>The selling price</th>
						
						<th>Edit</th>
						<th>Delete</th>
					</thead>
					<tbody>
						<?php foreach ($orders as $key => $order): ?>
						<tr>
							<td><?= $key + 1; ?></td>
							<td><span style="font-size: 14px!important;">000<?= $order['order_id']; ?></span></td>
							<td><span style="font-size: 14px!important;"><?= $order['id']; ?></span></td>
							<td><span style="font-size: 14px!important;"><?= $order['title']; ?></span></td>
							<td><span style="font-size: 14px!important;"><?= $order['price']; ?></span></td>
							<td><span style="font-size: 14px!important;"><?= $order['price']; ?></span></td>
							
							
							<td>
								<a class="text-white btn btn-success btn-sm" 
									href="<?php echo BASE_URL . 'view/admin/products/order_update.php?id='?><?php echo $order['id'] ?>">
									<i class="fa fa-edit" style="font-size: 14px!important;"></i>
								</a>
							</td>
							<td>
								<a class="text-white btn btn-danger btn-sm" 
									href="<?php echo BASE_URL . 'view/admin/products/order_delete.php?id='?><?php echo $order['id'] ?>">
									<i class="fa fa-trash " style="font-size: 14px!important;"></i>
								</a>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>

			<?php include(ROOT_PATH . '/view/elements/pages.php') ?>
			
	</div>
	<!-- // Display records from DB -->
	<div class="col-2">
		<table>
			<thead>
				<th>Profit</th>
			</thead>
			<tbody>
				<tr>
					<td>$<?=$order['price']?></td>
				</tr>
			</tbody>
		</table>
	</div>

	</div>
</div> 

<div style="height:50px"></div>
<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
