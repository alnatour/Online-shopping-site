<?php
require '../../../config.php';

require (ROOT_PATH . '/view/elements/head_section.php');

?>
<html>
    <head>
        <title> Contact </title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}
        
        input[type=text], select, textarea {
          width: 100%;
          padding: 12px;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
          margin-top: 6px;
          margin-bottom: 16px;
          resize: vertical;
        }
        
        input[type=submit] {
          background-color: #4CAF50;
          color: white;
          padding: 12px 20px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        }
        
        input[type=submit]:hover {
          background-color: #45a049;
        }
        
        .container-body {
          width: 450px;
          border-radius: 5px;
          background-color: #f2f2f2;
          padding: 20px;
        }
        </style>

    <body>
    <div class="container" style="margin-top:100px"> 
        <div class="container-body"  style="margin: 0 auto;">
        <p><h4 align="center">Contact Us</h4></p>
            <form  action="contactform.php " method="post" >
          
              <label for="fname">First Name</label>
              <input type="text" name="firstname" placeholder="Your name..">
          
              <label for="lname">Last Name</label>
              <input type="text" name="lastname" placeholder="Your last name..">
          
              <label for="E-mail">E-mail</label>
              <input type="text" name="email" placeholder="Your E-Mail..">
              
              <label for="Subject">Subject</label>
              <input type="text" name="subject" placeholder="The subject..">
          
              <label for="subject">Your Message</label>
              <textarea  name="message" placeholder="Write something.." style="height:200px"></textarea>
          
              <input type="submit" name="submit_contact" value="Submit">
          
            </form>
          </div>
        </div>
    </body>
      

    <?php require (ROOT_PATH . '/view/elements/footer.php') ?>

