<?php
require '../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$articledb = ArticleDb::getInstance();
$artikelinfo = new ArticleInfo();
$search='';

/* Number of page  */
(!isset($_GET['page'])) ?$page = 1 : $page =$_GET['page'];

/* Number of articles pre page  */
(isset($_SESSION['PageSize'])) ? $PageSize = $_SESSION['PageSize'] : $PageSize=10;

/* Get All in articles with Authors*/
if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' )) {
	$user_id='';
	$articles = $articledb->GetProductsWithAuthors($page, $PageSize,$search);
	$total = $articledb->CountAllArtikels($user_id);
}

/* search in Admin panel */

if (isset($_POST['submit_search'])) {
	$search = trim($_POST['search']);
	if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' )) {
		$search = "%{$search}%";
		$articles = $articledb->GetProductsWithAuthors($page, $PageSize,$search);
		$total = count($articles);
	}
	if (empty($articles)){
		$feedback = ' nichts gefunden';
	}
}

/* Count of articles  */
$PageCount = ceil($total/$PageSize);


//echo '<pre>'; print_r($total);die();
require (ROOT_PATH . '/view/elements/head_section.php');
?>


<br><br><br>


<br>
	<div class="container content bg-white p-4">
		<div class="row">
			<!-- Left side menu -->
			<div class="col-md-3  menu mb-4">
				<div class="card">
					<div class="card-header">
						<h2>Actions</h2>
					</div>
					<div class="card-content">
						<a href="<?php echo BASE_URL . 'view/admin/admin_panel.php' ?>">Manage Articles</a>
						<a href="<?php echo BASE_URL . 'view/admin/topics/topics_view.php' ?>">Manage Topics</a>
						<a href="<?php echo BASE_URL . 'view/admin/users/users_view.php' ?>">Manage Users</a>
						<a href="<?php echo BASE_URL . 'view/admin/reviews/reviews_view.php' ?>">Manage Reviews</a>
					</div>
				</div>
			</div>

			<!-- Display records from DB-->
			<div class="table-div col-9 table-hover table-responsive" >
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
							<a class="btn btn-outline-primary" href="<?php echo BASE_URL . 'view/admin/products/article_create.php' ?>" style="float: right;"><i class="fa fa-plus-circle"></i> Create Article</a>
						</div>
					</div>
				</div>
				<!-- Display notification message -->
				<?php include(ROOT_PATH . '/view/elements/messages.php') ?>

				<?php if (empty($articles)): ?>
					<h1 style="text-align: center; margin-top: 20px;">No articles in the database.</h1>
				<?php else: ?>
					<table class="table admin-table">
						<thead>
							<th><b>N</b></th>
							<th><b>Author</b></th>
							<th><b>Title</b></th>
							<th><b>Detail</b></th>
							<th>View</th>
							<th>Edit</th>
							<th>Delete</th>
						</thead>
						<tbody>
							<?php foreach ($articles as $key => $article): ?>
							<tr>
								<td><?= $key + 1; ?></td>
								<td><span style="font-size: 14px!important;"><?= $article->getFirstname(); ?></span></td>
								<td><span style="font-size: 14px!important;"><?= $article->getTitle(); ?></span></td>
								<td><span style="font-size: 14px!important;"> <?php echo substr($article->getArticle() ,0 ,100);
										if(strlen($article->getArticle()) > 100){?>
                                        	<a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $article->getId(); ?>">...</a>
									<?php } ?>
									</span> 
								</td>
								<td>
									<a class="text-white btn btn-primary btn-sm"
										 href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $article->getId(); ?>" >
										<i class="fa fa-eye" style="font-size: 14px!important;"></i>
									</a>
								</td>
								<td>
									<a class="text-white btn btn-success btn-sm" 
										href="<?php echo BASE_URL . 'view/admin/products/article_update.php?id='?><?php echo $article->getId() ?>">
										<i class="fa fa-edit" style="font-size: 14px!important;"></i>
									</a>
								</td>
								<td>
									<a class="text-white btn btn-danger btn-sm" 
										href="<?php echo BASE_URL . 'view/admin/products/article_delete.php?id='?><?php echo $article->getId() ?>">
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
		</div>
	</div> 

<div style="height:50px"></div>
<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
