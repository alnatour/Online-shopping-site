
<div class="fixed-top">
    <nav class="navbar navbar-expand-lg  navbar-dark btn-group-toggle bg-primary" >
        <a class="navbar-brand" href="<?php echo BASE_URL . 'index.php' ?>">
        <img src="<?php echo BASE_URL . 'public/assets/img/logo-carousel/logo.png' ?>" height='40px'></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo BASE_URL . 'index.php'?>">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link"  href="<?php echo BASE_URL . 'index.php' ?>">Articles</a>
                </li>
            </ul>

            <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL . 'view/main/contact_us/contact.php' ?>"><i class="fas fa-envelope" ></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
                </li> 
                <?php if (!isset($_SESSION['user'] )) { ?>
                    <li class="nav-item support"><a href="<?php echo BASE_URL . 'view/user/register.php' ?>" class="nav-link"><i class="fa fa-registered"></i> Register</a> </li>
                    <li class="nav-item support"><a href="<?php echo BASE_URL . 'view/user/login.php' ?>" class="nav-link"><i class="fa fa-user"></i> Login</a> </li>
                <?php  } ?>
            
                <?php if( isset($_SESSION['user']) ) { ?>
                    <li class="nav-item support"><a class="nav-link bg-white">Welcom <?php echo $_SESSION['user']->getLastname()?></a> </li>
                    <li class="nav-item support"><a href="<?php echo BASE_URL . 'view/admin/admin_panel.php'?>" class="nav-link"> Admin Plan</a></li>
                    <li class="nav-item support"><a href="<?php echo BASE_URL . 'view/user/log_out.php' ?>" class="nav-link">LogOut</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>

<?php if ($feedback != '') { ?>
    <div class="alert alert-danger d-flex justify-content-center" style="margin-top:200px"><?=$feedback;?></div>
<?php } ?> 