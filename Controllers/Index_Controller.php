<?php


    session_start();

    include '../Functions/Authentication.php';

    if(!isAuthenticated()){
        header('Location: ../index.php');
    }else{
        include '../Views/Principal_View.php';
        new Principal_View();
    }