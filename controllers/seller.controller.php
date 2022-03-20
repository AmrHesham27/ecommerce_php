<?php

require_once '../auth/auth.php';
require_once '../db/db.controller.php';

class Seller {
    public static function mySQLCheck($con, $op){
        if (!$op){
            $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
            exit();
        };
    }
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
        $sql = "DELETE FROM products WHERE id = '$productId', seller_id = '$user_id'";
        $op = mysqli_query($con,$sql);
        self::mySQLCheck($con, $op);
        $_SESSION['mssg'] = 'Your product was deleted successfully';
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
}

?>