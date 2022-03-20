<?php 
require_once './checkNotLogged.php';
require_once './components/header.php';
require_once './components/navBar.php';
require_once './dbConnection.php';
require_once '../helpers/validation.php';

if( $_SERVER['REQUEST_METHOD'] == "POST"){
    // validate data
    Validation::required_input('email', $_POST['email']);
    Validation::required_input('password', $_POST['password']);
    $email = Validation::filterData($_POST['email']);
    $hashed_password = md5( Validation::filterData($_POST['password']) );

    // print errors if any
    if ( count(Validation::$errors) != 0 ){
        $_SESSION['mssg'] = reset(Validation::$errors); 
    }
    else {
        // login logic
        $sql = "SELECT id, email FROM users WHERE email = '$email' AND userPassword = '$hashed_password'";
        $op =  mysqli_query($con,$sql);
        if (!$op){
            $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
        }
        elseif (mysqli_num_rows(mysqli_query($con,$sql)) != 1){
            $_SESSION['mssg'] = 'Email or Password is wrong, please try again';
        }
        else {
            $data = mysqli_fetch_assoc($op);
            $_SESSION['user'] = $data['id'];
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
        <label>Passowrd</label>
        <input name="password" type='password' class="form-control" minLength='6'>
    </div>
    
    <div class="btn-3 mt-5">
        <button type='submit' type='password' name="submit" class="btn btn-primary"> Login </button>
    </div>
    <?php
        require_once './components/message.php';
    ?>
</form>
<?php
    include_once './components/footer.php';
?>