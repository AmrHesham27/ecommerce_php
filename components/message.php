<?php
if(isset($_SESSION['mssg'])){
    echo "<p>{$_SESSION['mssg']}<p>";
    unset($_SESSION['mssg']);
}
?>