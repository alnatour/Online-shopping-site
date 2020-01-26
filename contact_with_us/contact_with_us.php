<?php



if(isset( $_POST['submit_contact'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];

    $content="From: $name \n Email: $email \n Message: $message";
    $recipient = "abdo.alnatoor@gmail.com";
    $mailheader = "From: $email \r\n";
    mail($recipient, $subject, $content, $mailheader) or die("Error!");
    echo "Email sent!";
}




require '../header.php';
?>
<br><br><br><br><br><br>




<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="well well-sm">
                <form class="form-horizontal" method="post">
                    <fieldset>
                        <legend class="text-center header">Contact us</legend>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user bigicon"></i></span>
                            </div>
                                <input id="fname" name="name" type="text" placeholder="Name" class="form-control">
                         </div><br>

                         <div class="input-group">
                            <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fa fa-envelope bigicon"></i></span>
                            </div>
                                <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">  
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-phone-square bigicon"></i></span>
                           
                                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
                        </div><br>

                        <div class="input-group">
                                <input id="subject" name="subject" type="text" placeholder="Subject" class="form-control">
                            
                        </div><br>
                        

                        <div class="input-group">
                            <div class="col-md-12">
                            <span class="input-group-text"><i class="fa fa-pencil-square-o bigicon"></i></span>

                                <textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>
                            </div>
                        </div><br>

                        <div class="input-group">
                            <div class="col-md-12 text-center">
                                <input type="submit" name="submit" class="btn btn-primary btn-lg"  value="Submit"/>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>