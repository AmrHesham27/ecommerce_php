<?php
    require_once './controllers/seller.controller.php';
    require_once './auth/auth.php';
    require './db/db.connection.php';

    Auth::checkCustomer();
    $user_id = $_SESSION['userId'];
    $product_id = $_GET['id'];

    // check if user already have this cart
    $sql = "SELECT c.* FROM products AS p
    LEFT JOIN cart_items AS c 
    ON p.id = c.product_id WHERE c.client_id = $user_id;
    ";
    $result = SQL::doQuery($con, $sql);
    $data = mysqli_fetch_assoc($result);
    if ($data == null){
        if( $data['client_id'] != $user_id )
            exit();
        Customer::addCartItem($con, $product_id, 1);
    }
    else {
        $quantity = $data['quantity'];
        Customer::editCartItem($con, $product_id, $quantity + 1);
    }
?>