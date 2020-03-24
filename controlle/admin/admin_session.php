<?php

// Check if user have session (if user is logged and admin)

if(!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'admin')
{	// not logged in
    header('Location: '.BASE_URL.'index.php');
    die();
}