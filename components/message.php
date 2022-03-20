<?php
require_once './helpers';

if(count(Validation::$errors) != 0){
    $first_error = reset(Validation::$errors);
    echo "<p>{$first_error}<p>";
    Validation::$errors = [];
    return;
}
elseif(isset($_SESSION['mssg'])){
    echo "<p>{$_SESSION['mssg']}<p>";
    unset($_SESSION['mssg']);
}
?>