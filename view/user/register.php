<?php 
require '../../config.php';

$errors = array();

if (isset($_POST['submit'])) {

    $user = new User();

    $user->setEmail($_POST['email']);
    $user->setPassword(sha1($_POST['password']));
    $user->setFirstname($_POST['firstname']);
    $user->setLastname($_POST['lastname']);
    $user->setPhone($_POST['phone']);

    $RegisterService = new RegisterService();

    $register = $RegisterService->register($user);
    $errors = $register;

}

include(ROOT_PATH . '/view/elements/head_section.php');
?>

<div style="background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg')">     
    <div style="height: 50px;"></div>

    <div class="container" >
        <div class="d-flex justify-content-center " >
            <div  class="d-flex justify-content-center " style="background: rgba(0, 0, 0, 0.3); border-radius:22px; width:450px;">
                <form action="register.php" method="post" style=" margin-top:50px; width:400px; ">
                    <h3 class="text-white" >Register now </h3><br />

                    <?php  foreach($errors as $error){ ?>
                        <p class="text-danger"><?= $error ?></p>
                    <?php } ?>

                     <!--  <p>All fields are required!</p> -->
                    <h6 class="text-white">Your Email</h6>
                    <div class="input-group mb-2 mr-sm-2">
                        <span class="input-group-prepend input-group-text ">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" name="email" placeholder="Your Email" class="form-control"/>  
                    </div>
                    
                    <!--  <p>Email already exists!</p>-->

                    <h6 class="text-white">Your password</h6>
                    <div class="input-group mb-2 mr-sm-2">
                        <span class="input-group-prepend input-group-text">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input type="password" name="password" placeholder="Your Password" pattern=".{6,50}" title="Password should be more  6" class="form-control"/>
                    </div>
                    <!--  <p>Passwords must be between 6 and 12 symbols!</p> -->
            
                    <h6 class="text-white">First Name</h6>
                    <div class="input-group mb-2 mr-sm-2">
                        <span class="input-group-prepend input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <input type="text" name="firstname" placeholder="First Name" pattern=".{3,20}" title="First Name should be between 3 and 20 characters" class="form-control"/>
                    </div>
                    <!--  <p>First Name should be between 3 and 20 symbols!</p> -->

                    <h6 class="text-white">Last Name</h6>
                    <div class="input-group mb-2 mr-sm-2">
                        <span class="input-group-prepend input-group-text">
                            <i class=" fa fa-user"></i>
                        </span>
                        <input type="text" name ="lastname" placeholder="Last Name" pattern=".{3,20}" title="Last Name should be between 3 and 20 characters" class="form-control"/>
                    </div>
                    <!--  Last Name should be between 3 and 20 symbols!</p>-->
                    
                    <h6 class="text-white">Your Mobile Number</h6>
                    <div class="input-group mb-2 mr-sm-2">
                        <span class="input-group-prepend input-group-text ">
                            <i class="fa fa-mobile"></i>
                        </span>
                        <input type="tel" name="phone" placeholder="Mobile Number" pattern="[0-9]{9,20}" title="Number must be 10 digits" class="form-control"/>
                    </div>
                    <p>
                     <!-- Mobile Number should be 10 digits!</p> -->
                    <input type="submit" name="submit" value="REGISTER" class="btn btn-primary">
                    <p align="right" class="message text-white">Already a user? <a  href="<?php echo BASE_URL . 'view/user/login.php' ?>" style="font-weight: bold;color:#66a3ff ;text-decoration: none;">&nbspLog In</a></p>
                </form>
            </div>
        </div>
    </div>

    <div style="height: 100px;"></div>
</div>


<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
