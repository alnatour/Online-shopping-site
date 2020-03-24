<?php
require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$articledb = ArticleDb::getInstance();
$reviews_db = ReviewsDb::getInstance();
$search='';

(isset($_SESSION['PageSize'])) ? $PageSize = $_SESSION['PageSize'] : $PageSize=10;
(!isset($_GET['page'])) ?$page = 1 : $page =$_GET['page'];

$comments = $reviews_db->GetAllCommentsWithAuthor($page, $PageSize);
$all_comments = $reviews_db->GetAllComment();
$total = count($all_comments);
$PageCount = ceil($total/$PageSize);
//echo '<pre>'; print_r($comments);die();
/*




$data = false;

if (isset($_POST['submit_search'])) {
		$search = trim($_POST['search']);
		if (isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) {
			$search = "%{$search}%";
			$articles = $articledb->GetProductsWithAuthors($page, $PageSize,$search);
			$total = count($articles);
			//echo '<pre>'; print_r($total);die();
		} 
	if (empty($articles)){
		$feedback = ' nichts gefunden';
	}
}else{
	if (isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) {
		$user_id='';
		$articles = $articledb->GetProductsWithAuthors($page, $PageSize,$search);
		$total = $articledb->CountAllArtikels($user_id);
	} 
}


$PageCount = ceil($total/$PageSize);
*/

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
	<div class="container content bg-white">
		<div class="row">
			<!-- Left side menu -->
			<div class="menu col-3">
				<div class="card">
					<div class="card-header">
						<h2>Actions</h2>
					</div>
					<div class="card-content">
						<a href="<?php echo BASE_URL . 'view/admin/admin_panel.php' ?>">Manage Articles</a>
						<a href="<?php echo BASE_URL . 'view/admin/topics/topics_view.php' ?>">Manage Topics</a>
						<a href="<?php echo BASE_URL . 'view/admin/users/users_view.php' ?>">Manage Users</a>
						<a href="<?php echo BASE_URL . 'view/admin/reviews/reviews_view.php' ?>">Manage comment</a>
					</div>
				</div>
				<div style="height:10px"></div>
			</div>

			<!-- Display records from DB-->
			<div class="table-div col-9 table-hover" >
				<!-- Display notification message -->
				<?php include(ROOT_PATH . '/view/elements/messages.php') ?>

				<?php if (empty($comments)): ?>
					<h1 style="text-align: center; margin-top: 20px;">No Comments in the database.</h1>
				<?php else: ?>
					<table class="table admin-table">
						<thead>
							<th><b>N</b></th>
							<th><b>First Name</b></th>
							<th><b>last Name</b></th>
							<th><b>E-mail</b></th>
							<th><b>Rating</b></th>
							<th><b>Comment</b></th>
							<th>View</th>
							<th>Delete</th>
						</thead>
						<tbody>
							<?php foreach ($comments as $key => $comment): ?>
							<tr>
								<td><?= $key + 1; ?></td>
								<td><?= $comment['firstname']; ?></td>
								<td><?= $comment['lastname']; ?></td>
								<td><?= $comment['email']; ?></td>
								<td><?= $comment['rating']; ?></td>
								<td><?= $comment['comment']; ?></td>
								<td>
									<a class="text-success" href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $comment['product_id']; ?>" >
										<i class="fa fa-eye text-success"></i>
									</a>
								</td>
								<td>
									<a class="text-danger" 
										href="<?php echo BASE_URL . 'view/admin/reviews/review_delete.php?id='?><?= $comment['id']; ?>">
										<i class="fa fa-trash "></i>
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
