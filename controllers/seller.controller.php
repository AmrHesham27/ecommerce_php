<?php

require_once '../auth/auth.php';
require_once '../db/db.controller.php';

class Seller {
    public static function addProduct($con, $productName, $category_id, $price, $description, $image){
        Auth::checkSeller();
        $user_id = $_SESSION['userId'];
        SQL::insert(
            $con,
            'users',
            '(productName, category_id, price, seller_id, description, image)',
            "('$productName','$category_id','$price', '$user_id', '$description', '$image')",
            'Your product was added successfully'
        );

    }
    public static function deleteProduct($con, $productId){
        Auth::checkSeller();
        $user_id = $_SESSION['userId'];
        SQL::delete(
            $con, 
            'products',
            "'$productId', seller_id = '$user_id'",
            'Your product was deleted successfully'
        );
    }
    public static function editProduct($con, $productId, $productName, $category_id, $price, $productDescription, $productImage){
        Auth::checkSeller();
        $user_id = $_SESSION['userId'];
        SQL::update(
            $con, 
            'products',
            "productName = '$productName', category_id = '$category_id', price = '$price', productDescription = '$productDescription', productImage = '$productImage'",
            "id = '$productId' AND seller_id = '$user_id'",
            'Your product was edited successfully'
        );
    }
    public static function showSellerProducts($con){
        Auth::checkSeller();
        $user_id = $_SESSION['userId'];
        $result = SQL::read(
            $con,
            'productName, category_id, price, description, image',
            'products',
            "id = '$user_id'"
        );
        return $result;
    }
}

?>