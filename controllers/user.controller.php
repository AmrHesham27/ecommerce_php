<?php
require_once '../auth/auth.php';

class User {
    public static function mySQLCheck($con, $op){
        if (!$op){
            $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
            exit();
        };
    }
    public static function register($con, $userName, $email, $phoneNumber, $password, $gender, $userType){
        $sql = "insert into users (userName, email, password, phoneNumber, gender, userType) 
        values ('$userName','$email','$phoneNumber', '$password', '$gender', '$userType')";
        $op =  mysqli_query($con,$sql);
        self::mySQLCheck($con, $op);
        $_SESSION['mssg'] = 'You were registered successfully';
    }
    public static function editUser($con, $userName, $email, $phoneNumber, $gender){
        Auth::checkLogin();
        $user_id = $_SESSION['userId'];
        $sql = 
        "UPDATE users
        SET userName = '$userName', email = '$email', phoneNumber = '$phoneNumber', gender = '$gender'
        WHERE user_id = '$user_id' ;";
        $op =  mysqli_query($con,$sql);
        self::mySQLCheck($con, $op);
        $_SESSION['mssg'] = 'You personal information were edited successfully';
    }
    public static function login($con, $email, $password){
        $hashed_password = md5($password);
        $sql = "SELECT id, userType FROM users WHERE email = '$email' AND userPassword = '$hashed_password'";
        $op =  mysqli_query($con,$sql);
        self::mySQLCheck($con, $op);
        if (mysqli_num_rows(mysqli_query($con,$sql)) != 1){
            $_SESSION['mssg'] = 'Email or Password is wrong, please try again';
            return;
        };
        $data = mysqli_fetch_assoc($op);
        $_SESSION['userType'] = $data['userType'];
        $_SESSION['userId'] = $data['id'];
        header("Location: index.php");
    }
    public static function logout(){
        session_destroy();
        header("Location: index.php");
    }
    public static function addAddress($con, $AddressType, $userAddress){
        Auth::checkLogin();
        $user_id = $_SESSION['userId'];
        $sql = "INSERT INTO user_addresses (user_id, AddressType, userAddress) 
        values ('$user_id','$AddressType','$userAddress')";
        $op =  mysqli_query($con,$sql);
        self::mySQLCheck($con, $op);
        $_SESSION['mssg'] = 'Your address was added successfully';
    }
    public static function editAddress($con, $addressId, $AddressType, $userAddress){
        Auth::checkLogin();
        $user_id = $_SESSION['userId'];
        $sql = 
        "UPDATE user_addresses
        SET AddressType = '$AddressType', userAddress = '$userAddress'
        WHERE addressId = '$addressId' AND user_id = '$user_id' ;";
        $op =  mysqli_query($con,$sql);
        self::mySQLCheck($con, $op);
    }
    public static function deleteAddress($con, $addressId){
        Auth::checkLogin();
        $user_id = $_SESSION['userId'];
        $sql = "DELETE FROM user_addresses WHERE addressId='$addressId', user_id='$user_id'";
        $op =  mysqli_query($con,$sql);
        self::mySQLCheck($con, $op);
    }
}

?>