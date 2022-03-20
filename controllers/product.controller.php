<?php

require_once '../db/db.controller.php';
require_once '../auth/auth.php';

class Product {
    public static function addView($con, $product_id, $product_category_id ){
        $user_id = $_SESSION['userId'];
        SQL::insert(
            $con,
            'views',
            '(user_id, product_id, product_category_id )',
            "('$user_id', '$product_id', '$product_category_id')"
        );
    }
    public static function showProduct($con, $product_id){
        SQL::read(
            $con,
            '(productName, category_id, price, seller_id, description, image)',
            'products',
            "id = '$product_id'"
        );
    }
}

?>