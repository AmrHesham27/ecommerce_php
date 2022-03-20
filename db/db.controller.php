<?php

class SQL {
    public static function doQuery($con, $op){
        if (!$op){
            $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
            exit();
        };
    }
    function insert($con, $table, $columns, $values, $successMssg){
        $sql = "INSERT INTO $table $columns VALUES $values"; 
        $op =  mysqli_query($con,$sql);
        self::doQuery($con, $op);
        $_SESSION['mssg'] = $successMssg;
    }
    function delete($con, $table, $condition, $successMssg){
        $sql = "DELETE FROM $table WHERE $condition;";
        $op =  mysqli_query($con,$sql);
        self::doQuery($con, $op);
        $_SESSION['mssg'] = $successMssg;
    }
    function update($con, $table, $setValues, $condition, $successMssg){
        $sql = 
        "UPDATE $table SET $setValues WHERE $condition;";
        $op =  mysqli_query($con,$sql);
        self::doQuery($con, $op);
        $_SESSION['mssg'] = $successMssg;
    }
}

?>