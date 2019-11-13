<?php


    session_start();

    include './Functions/Authentication.php';

    if(!isAuthenticated()){

        header('Location:./Controllers/Login_Controller.php');
    }else{
        header('Location:./Controllers/Index_Controller.php');
    }
