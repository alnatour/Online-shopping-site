<?php  require '../include.php';

if(!isset($_SESSION['user']) )
{	// not logged in
    header('Location: '.BASE_URL.'index.php');
    die();
}

$articledb = ArticleDb::getInstance();
$artikelinfo = new ArticleInfo();

(isset($_SESSION['PageSize'])) ? $PageSize = $_SESSION['PageSize'] : $PageSize=4;

(!isset($_GET['page'])) ?$page = 1 : $page =$_GET['page'];
$search='';
$data = false;

if (isset($_POST['submit_search'])) {
		$search = trim($_POST['search']);
		if (isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) {
			$search = "%{$search}%";
			$posts = $articledb->GetProductsWithAuthors($page, $PageSize,$search);
			
			$total = count($posts);
			//echo '<pre>'; print_r($total);die();
		} else{
			$user_id = $_SESSION['user']->getId();
			$posts = $articledb->GetProductsUserWithAuthors($user_id,$page, $PageSize,$search);
			$total = $articledb->CountAllArtikels($user_id);
		}
	if (empty($posts)){
		$feedback = ' nichts gefunden';
	}
}else{
	if (isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) {
		$user_id='';
		$posts = $articledb->GetProductsWithAuthors($page, $PageSize,$search);
		$total = $articledb->CountAllArtikels($user_id);
	} else{
		$user_id = $_SESSION['user']->getId();
		$posts = $articledb->GetProductsUserWithAuthors($user_id,$page, $PageSize,$search);
		$total = $articledb->CountAllArtikels($user_id);
	}
}


$PageCount = ceil($total/$PageSize);


  // echo '<pre>'; print_r($total);die();
?>



<!-- Get all admin posts from DB -->
	<title>Admin | Manage Posts</title>
	<style>
			.container.content .menu .card .card-content a {
				display: block;
				box-sizing: border-box;
				padding: 8px 10px;
				border-bottom: 1px solid #e4e1e1;
				color: #444;
			}
			.container.content .menu .card .card-content a:hover {
				padding-left: 20px; background: #F9F9F9; transition: 0.1s;
			}
	</style>
</head>
<body>
	<!-- admin navbar -->
	<?php require '../header.php'; // include(ROOT_PATH . '/admin/includes/navbar.php') ?>

	<br><br><br><br>

<div class='d-flex justify-content-center '>
    <form method="post" action='posts.php' style='margin:50px 0' class="form-inline"> 
        <input type="text" name="search" class="form-control mr-sm-2" value="<?=$search;?>">
        <input type="submit" name="submit_search" value="Search" class="btn btn-outline-success btn-rounded btn-sm my-0" />
        <br/>
    </form>
</div>

<br><br>
	<div class="container content">
		<div class="row">

		<!-- Left side menu -->
		
		<div class="menu col-4">
			<div class="card">
				<div class="card-header">
					<h2>Actions</h2>
				</div>
				<div class="card-content">
					<a href="<?php echo BASE_URL . 'article/InsertArticle.php' ?>">Create Article</a>
					<a href="<?php echo BASE_URL . 'article/posts.php' ?>">Manage Articles</a>
					<a href="<?php echo BASE_URL . 'category/creatCategory.php' ?>">Manage Categories</a>
					<a href="<?php echo BASE_URL . 'Contacts/contact_Sql/index.php' ?>">Manage Users</a>
					<a href="<?php echo BASE_URL . 'article/topics.php' ?>">Manage Topics</a>
				</div>
			</div>
		</div>


		<!-- Display records from DB-->
		<div class="table-div col-8 table-hover"  style="width: 100%;">
			<!-- Display notification message -->
			<?php include('messages.php') ?>

			<?php if (empty($posts)): ?>
				<h1 style="text-align: center; margin-top: 20px;">No posts in the database.</h1>
			<?php else: ?>
				<table class="table">
						<thead>
						<th><b>N</b></th>
						<th><b>Author</b></th>
						<th><b>Title</b></th>
						<th><b>Content</b></th>
						<!-- Only Admin can publish/unpublish post -->
					
						<th><b>View</b></th>
						<th><b>Edit</b></th>
						<th><b>Delete</b></th>
					</thead>
					<tbody>
					<?php foreach ($posts as $key => $post):
						//echo '<pre>'; print_r($posts);die();
						?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $post->getFirstname(); ?></td>
							<td>
								<a 	target="_blank" >
									<?php echo $post->getTitle(); ?>	
								</a>
							</td>
							<td><?php echo $post->getArticle(); ?></td>
							
							<!-- Only Admin can publish/unpublish post -->
						
							<td>
								<a class="text-success" href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $post->getId(); ?>"
									><i class="fa fa-eye text-success"></i>
								</a>
							</td>
							<td>
								<a class="text-success"
									href="<?php echo BASE_URL . 'article/EditArticle.php?id='?><?php echo $post->getId() ?>">
									<i class="fa fa-edit text-warning"></i>
								</a>
							</td>
							<td>
								<a class="text-danger" 
									href="<?php echo BASE_URL . 'article/delete.php?id='?><?php echo $post->getId() ?>"><i class="fas fa-times"></i>
								</a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>

			<?php include(ROOT_PATH . '/article/pages.php') ?>
			
		</div>
		<!-- // Display records from DB -->
		
		</div>
	</div>
</body>
</html>
