<?php
require_once '../auth/auth.php';

class Customer {
    public static function mySQLCheck($con, $op){
        if (!$op){
            $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
            exit();
        };
    }
}

?>