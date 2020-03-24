<?php

$search = '';
if (isset($_POST['search'])) {
    $search = trim($_POST['search']);
}

$PageSize = 3;

if(!isset($_GET['page']))
{
    $page = 1;
}else{
    $page =$_GET['page'];
}

// Database user
$UsersDb = RegisterRepository::getInstance();
$total = $UsersDb->CountAllUsers();
$PageCount = ceil($total/$PageSize);

$Users = $UsersDb->GetAllUsers($page, $PageSize, $search);