<?php
    require_once 'controllers/seller.controller.php';
    require_once 'db/db.connection.php';
    require_once 'controllers/product.controller.php';
    Product::showProduct($con, 2);
    Seller::addDiscount($con,2,20,'2022-04-01');
?>