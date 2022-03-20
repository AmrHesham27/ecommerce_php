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
}

?>