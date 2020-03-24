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
<div class='d-flex justify-content-center'>
    <form method="post" action='admin_panel.php' style='margin:20px 0' class="form-inline"> 
        <input type="text" name="search" class="form-control mr-sm-2" value="<?=$search;?>">
        <input type="submit" name="submit_search" value="Search" class="btn btn-outline-success btn-rounded btn-sm my-0" />
        <br/>
    </form>
</div>

<br><br>
	<div class="container content">
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
				<!-- Display notification message -->
				<?php include(ROOT_PATH . '/view/elements/messages.php') ?>

				<?php if (empty($articles)): ?>
					<h1 style="text-align: center; margin-top: 20px;">No articles in the database.</h1>
				<?php else: ?>
					<table class="table admin-table">
						<div class="mb-2">
							<a class="btn btn-outline-primary" href="<?php echo BASE_URL . 'view/admin/products/article_create.php' ?>">Create Article</a>
						</div>
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
								<td><?= $article->getFirstname(); ?></td>
								<td><?= $article->getTitle(); ?></td>
								<td><?php echo substr($article->getArticle() ,0 ,50);
										if(strlen($article->getArticle()) > 50){?>
                                        	<a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $article->getId(); ?>">...</a>
									<?php } ?>
								</td>
								<td>
									<a class="text-white btn btn-primary"
										 href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $article->getId(); ?>" >
										<i class="fa fa-eye"></i>
									</a>
								</td>
								<td>
									<a class="text-white btn btn-success" 
										href="<?php echo BASE_URL . 'view/admin/products/article_update.php?id='?><?php echo $article->getId() ?>">
										<i class="fa fa-edit" style="font-size: 16px!important;"></i>
									</a>
								</td>
								<td>
									<a class="text-white btn btn-danger" 
										href="<?php echo BASE_URL . 'view/admin/products/article_delete.php?id='?><?php echo $article->getId() ?>">
										<i class="fa fa-trash " style="font-size: 16px!important;"></i>
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
