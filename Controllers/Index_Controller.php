<?php


    session_start();

    include '../Functions/Authentication.php';

        include '../Views/Principal_View.php';
        new Principal_View();
    