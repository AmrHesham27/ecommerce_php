<?php

class SQL {
    public static function checkQuery($con, $op){
        if (!$op){
            $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
            exit();
        };
    }
    public static function insert($con, $table, $columns, $values, $successMssg = null){
        $sql = "INSERT INTO $table $columns VALUES $values"; 
        $op =  mysqli_query($con,$sql);
        self::checkQuery($con, $op);
        if($successMssg) $_SESSION['mssg'] = $successMssg;
    }
    public static function delete($con, $table, $condition, $successMssg){
        $sql = "DELETE FROM $table WHERE $condition;";
        $op =  mysqli_query($con,$sql);
        self::checkQuery($con, $op);
        $_SESSION['mssg'] = $successMssg;
    }
    public static function update($con, $table, $setValues, $condition, $successMssg){
        $sql = 
        "UPDATE $table SET $setValues WHERE $condition;";
        $op =  mysqli_query($con,$sql);
        self::checkQuery($con, $op);
        $_SESSION['mssg'] = $successMssg;
    }
    public static function read($con, $columns, $table, $condition){
        $sql = 
        "SELECT $columns FROM $table WHERE $condition;";
        $op =  mysqli_query($con,$sql);
        self::checkQuery($con, $op);
        $no_of_rows = mysqli_num_rows($op);
        $data = mysqli_fetch_assoc($op);
        return [$no_of_rows, $data];
    }
}

?>