<?php

// Check if user have session (if user is logged)
if (isset($_SESSION['loggedUser'])) {

    //Redirect to Main
    header('Location: ../index.php');
    die();
}