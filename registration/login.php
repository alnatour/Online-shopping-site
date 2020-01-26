<?php 
require '../include.php';

require '../controlle/session.php';

$errors = array();

if (isset($_POST['submit'])) {

	$email = trim($_POST['email']);
	
	$RegisterService = new RegisterService();
	$login = $RegisterService->login($email);

	$errors = $login;
}

    //echo '<pre>'; print_r($user->getFirstname());die();

require '../header.php';
?>
<div style="height: 100%; background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg')">
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header" style="color:#fff">
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
			<div class="card-footer" style="color:#fff">
				<div class="d-flex justify-content-center links">
					<p>Don't have an account? </p> <a href="http://localhost:8888/kontakte_verwalten/registration/register.php" style="font-weight: bold;color:#66a3ff ;text-decoration: none;">&nbspSign Up</a>
				</div>

			</div>
		</div>
	</div>
</div>
</div>

<?php
require '../footer.php';
