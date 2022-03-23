<?php

require_once __DIR__ .'/../auth/auth.php';
require_once __DIR__ .'/../db/db.controller.php';

class User {
    public static function register($con, $userName, $email, $phoneNumber, $password, $gender, $userType){
        SQL::insert(
            $con, 
            'users', 
            '(userName, email, phoneNumber ,userPassword, gender, userType)',
            "('$userName','$email','$phoneNumber', '$password', '$gender', '$userType')",
            'You were registered successfully'
        );
        header("Location: index.php");
    }
    public static function editUser($con, $userName, $email, $phoneNumber, $gender){
        Auth::checkLogin();
        $user_id = $_SESSION['userId'];
        SQL::update(
            $con, 
            'users',
            "userName = '$userName', email = '$email', phoneNumber = '$phoneNumber', gender = '$gender'",
            "user_id = '$user_id'",
            'You personal information were edited successfully'
        );
    }
    public static function login($con, $email, $password){
        $hashed_password = md5($password);
        $result = SQL::read(
            $con,
            'id, userType',
            'users',
            "email = '$email' AND userPassword = '$hashed_password'"
        );
        if ($result[0] != 1){
            $_SESSION['mssg'] = 'Email or Password is wrong, please try again';
            return;
        };
        $op = $result[1];
        $row = mysqli_fetch_assoc($op); 
        $_SESSION['userType'] = $row['userType'];
        $_SESSION['userId'] = $row['id'];
        header("Location: index.php");
    }
    public static function logout(){
        session_destroy();
        header("Location: index.php");
    }
    public static function addAddress($con, $AddressType, $userAddress){
        Auth::checkLogin();
        $user_id = $_SESSION['userId'];
        SQL::insert(
            $con, 
            'user_addresses',
            '(user_id, AddressType, userAddress)',
            "('$user_id','$AddressType','$userAddress')",
            'Your address was added successfully'
        );
    }
    public static function editAddress($con, $addressId, $AddressType, $userAddress){
        Auth::checkLogin();
        $user_id = $_SESSION['userId'];
        SQL::update(
            $con,
            'user_addresses',
            "AddressType = '$AddressType', userAddress = '$userAddress'",
            "addressId = '$addressId' AND user_id = '$user_id'",
            'Your data was edited successfully'
        );
    }
    public static function deleteAddress($con, $addressId){
        Auth::checkLogin();
        $user_id = $_SESSION['userId'];
        SQL::delete(
            $con, 
            'user_addresses',
            "addressId='$addressId' AND user_id='$user_id'",
            'Your address was deleted successfully'
        );
    }
    public static function sendMessage($con, $to_id, $text){
        Auth::checkLogin();
        $user_id = $_SESSION['userId'];
        SQL::insert(
            $con, 
            'messages',
            "(to_id, from_id, text)",
            "('$to_id','$user_id','$text')"
        );
    }
    public static function deleteMessage($con, $id){
        Auth::checkLogin();
        $user_id = $_SESSION['userId'];
        SQL::delete(
            $con,
            'messages',
            "id='$id' AND from_id='$user_id'"
        );
    }
}
?>