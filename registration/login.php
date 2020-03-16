<?php 
require '../include.php';
include(ROOT_PATH . '/controlle/session.php');

$errors = array();

if (isset($_POST['submit'])) {

	$email = trim($_POST['email']);
	
	$RegisterService = new RegisterService();
	$login = $RegisterService->login($email);

	$errors = $login;
}

    //echo '<pre>'; print_r($user->getFirstname());die();
include(ROOT_PATH . '/header.php');
?>
<div style="height: 100%; background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg')">
	<div class="container">
		<div style="height: 100px;"></div>
		<div class="d-flex justify-content-center ">
			<div class="card">
				<div class="card-header">
					<h3>Sign In</h3>
				</div>
				<?php  foreach($errors as $error){ ?>
					<p class="text-danger"><?= $error ?></p>
					<?php } ?>
				<div class="card-body">
					<form  action="login.php" method="post" >
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input type="text" name="email" class="form-control" placeholder="Email">
							
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control" placeholder="password" autocomplete="on">
						</div>

						<div class="form-group " align="right">
							<input type="submit" name="submit" value="Login" class="btn btn-success">
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						<p>Don't have an account? </p> <a href="<?php echo BASE_URL . 'registration/register.php' ?>" style="font-weight: bold;text-decoration: none;">&nbspSign Up</a>
					</div>

				</div>
			</div>
		</div>
		<div style="height: 100px;"></div>
	</div>
</div>

<?php include(ROOT_PATH . '/footer.php') ?>
