<?php 
require_once './checkNotLogged.php';
require_once './components/header.php';
require_once './components/navBar.php';
require_once './dbConnection.php';
require_once './validation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // validate data
    Validation::required_input('email', $_POST['email']);
    Validation::checkEmail($_POST['email']);
    Validation::required_input('password', $_POST['password']);
    if($_POST['password'] != $_POST['confirm']){
        Validation::$errors['Password'] = 'Password and confirm password do not match';
    }
    $email = Validation::filterData($_POST['email']);
    $password = md5( Validation::filterData($_POST['password']) );
    
    // print errors if any
    if ( count(Validation::$errors) != 0 ){
        $_SESSION['mssg'] = reset(Validation::$errors); 
    }
    else {
        $sql = "INSERT INTO users (email, userPassword) VALUES ('$email', '$password')";
        $op =  mysqli_query($con,$sql);
        if (!$op){
            $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
        }
        else {
            $_SESSION['user'] = true;
            header("Location: blog.php");
        }
    }    
}
mysqli_close($con);
?>
<form action=<?php echo $_SERVER['PHP_SELF'] ?> method='post' enctype="multipart/form-data" 
      class="mx-auto my-5" style="width: 300px;">
    <div class="btn-3 mt-3">
        <label>Email</label>
        <input name="email" class="form-control">
    </div>
    <div class="btn-3 mt-3">
        <label>Password</label>
        <input name="password" type='password' class="form-control" minLength='6'>
    </div>
    <div class="btn-3 mt-3">
        <label>Confirm Password</label>
        <input name="confirm" type='password' class="form-control" minLength='6'>
    </div>
    
    <div class="btn-3 mt-5">
        <button type='submit' name="submit" class="btn btn-primary"> Register </button>
    </div>
    <?php
        require_once './components/message.php';
    ?>
</form>
<?php
    include_once './components/footer.php';
?>