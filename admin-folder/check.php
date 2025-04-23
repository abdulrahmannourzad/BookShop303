<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('location:../general-folder/Login.php');
    if(isset($role) && $role!='' && $_SESSION['user']['role']!=$role)
        header('location:home.php');
?>