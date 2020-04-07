<?php
require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$CategoryDb = CategoriesDb::getInstance();
$subCategoryDb = SubCategoriesDb::getInstance();
$categories = $CategoryDb->getAllCategories();
$subcategories = $subCategoryDb->getAllSubCategories();

$search='';

(isset($_SESSION['PageSize'])) ? $PageSize = $_SESSION['PageSize'] : $PageSize=10;
(!isset($_GET['page'])) ?$page = 1 : $page =$_GET['page'];


$total = count($categories);
$PageCount = ceil($total/$PageSize);

require (ROOT_PATH . '/view/elements/head_section.php');
?>


<br><br><br>


<br><br>
	<div class="container content bg-white">
		<div class="row">
			<!-- Left side menu -->
			<div class="col-md-3  menu">
				<div class="card">
					<div class="card-header">
						<h2>Actions</h2>
					</div>
					<div class="card-content">
						<a href="<?php echo BASE_URL . 'view/admin/admin_panel.php' ?>">Manage Articles</a>
						<a href="<?php echo BASE_URL . 'view/admin/users/users_view.php' ?>">Manage Users</a>
						<a href="<?php echo BASE_URL . 'view/admin/topics/topics_view.php' ?>">Manage Topics</a>
						<a href="<?php echo BASE_URL . 'view/admin/reviews/reviews_view.php' ?>" > Manage Reviews</a>
					</div>
				</div>
			</div>

			<!-- Display records from DB-->
			<div class="table-div col-9 table-hover" >
				<div class="container mb-2 mt-4">
					<div class="row">
						<div  class="col-3" >
							<a class="btn btn-outline-primary" href="<?php echo BASE_URL . 'view/admin/topics/categories_create.php' ?>">Create Category</a>
						</div>
						<div class="col-6">
							<div class='d-flex justify-content-center'>
								<form method="post" action='admin_panel.php' class="form-inline"> 
									<input type="text" name="search" class="form-control mr-sm-2" value="<?=$search;?>">
									<input type="submit" name="submit_search" value="Search" class="btn btn-outline-success btn-rounded btn-sm my-0" />
									<br/>
								</form>
							</div>
						</div>
						<div class="col-3" >
							<a class="btn btn-outline-primary" style="float:right" href="<?php echo BASE_URL . 'view/admin/topics/subcategories_create.php' ?>">Create Subcategory</a>
						</div>
					</div>
				</div>
				<!-- Display notification message -->
				<?php include(ROOT_PATH . '/view/elements/messages.php') ?>

				<?php if (empty($categories)): ?>
					<h1 style="text-align: center; margin-top: 20px;">No Categories in the database.</h1>
				<?php else: ?>
					<table class="table table-hover">
						<thead>
							<th><b>N</b></th>
							<th><b>Category Name</b></th>
							<th>Edit</th>
							<th>Delete</th>
							<th colspan="1"><b>SubCategory</b></th>
						</thead>
						<tbody>
							<?php foreach ($categories as $key => $category){ ?>
							<tr>
								<td><?= $key + 1; ?></td>
								<td><?= $category->getName(); ?></td>
								<td>
									<a class="text-white btn btn-sm btn-success" 
										href="<?php echo BASE_URL . 'view/admin/topics/categories_update.php?id='?><?= $category->getId(); ?>">
										<i  class="fa fa-edit" style="font-size: 16px!important;"></i>
									</a>
								</td>
								<td>
									<a class="text-white btn btn-sm btn-danger"
										href="<?php echo BASE_URL . 'view/admin/topics/categories_delete.php?id='?><?= $category->getId(); ?>">
										<i class="fa fa-trash " style="font-size: 16px!important;"></i>
									</a>
								</td>
								<!-- Subcategory -->
								<td colspan="1">
									<table class="table table-hover" width="100%">
										<thead>
											<th>SubCategory Name</th>
											<th colspan="2">Action</th>
										</thead>
										<tbody>
											<?php foreach($subcategories as $subcategory){
											if($category->getId() == $subcategory->getCategoryId()){ ?>
												<tr>
													<td><?= $subcategory->getName(); ?></td>
													<td>
														<a class="text-white btn btn-sm btn-success" 
															href="<?php echo BASE_URL . 'view/admin/topics/subcategories_update.php?id='?><?= $subcategory->getId(); ?>">
															<i class="fa fa-edit" style="font-size: 16px!important;"></i>
														</a>
													</td>
													<td>
														<a class="text-white btn btn-sm btn-danger"
															href="<?php echo BASE_URL . 'view/admin/topics/subcategories_delete.php?id='?><?= $subcategory->getId(); ?>">
															<i class="fa fa-trash " style="font-size: 16px!important;"></i>
														</a>
													</td>
												</tr>
											<?php } } ?>
										</tbody>
									</table>
								</td>
							
								
							</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php endif ?>

				<?php include(ROOT_PATH . '/view/elements/pages.php') ?>
				
			</div>
			<!-- // Display records from DB -->
		</div>
	</div> 

<div style="height:50px"></div>
<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
