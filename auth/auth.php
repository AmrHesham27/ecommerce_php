<?php

class Auth {
    public static function checkLogin(){
        if(!$_SESSION['userType']){
            header("Location: login.php");
            exit();
        }
    }
    public static function checkSeller(){
        self::checkLogin();
        if(!$_SESSION['userType'] != 'seller'){
            header("Location: error404.php");
            exit();
        }
    }
    public static function checkCustomer(){
        self::checkLogin();
        if(!$_SESSION['userType'] != 'customer'){
            header("Location: error404.php");
            exit();
        }
    }
} 

?>