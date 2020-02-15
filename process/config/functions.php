<?php
//ini_set('display_errors', '0');
function secure($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

function notempty($name, $username, $email, $number, $gender, $password, $captcha ){
    if (empty($name)) {
       return false;
    }elseif (empty($username)) {
        return false;
    }elseif (empty($email)) {
        return false;
    }elseif (empty($number)) {
        return false;
    }elseif (empty($gender)) {
        return false;
    }elseif (empty($password)) {
        return false;
    }elseif (strlen($password) < 6) {
        return false;
    }elseif (empty($captcha)) {
        return false;
    }else {
        return true;
    }
}

function validate($name, $username, $email, $number, $gender, $password, $captcha){
    if(notempty($name, $username, $email, $number, $gender, $password, $captcha)){

        if(filter_var($name, FILTER_SANITIZE_STRING)){
            if (filter_var($username, FILTER_SANITIZE_STRING)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL) && filter_var($email, FILTER_SANITIZE_EMAIL)) {
                    if (filter_var($number, FILTER_VALIDATE_INT)) {
                        if (filter_var($captcha, FILTER_SANITIZE_STRING)) {
                            return true;
                        }else {
                            return false;
                        }
                    }else {
                        return false;
                    }
                }else {
                    return false;
                }
            }else {
                return false;
            }

        }else {
            return false;
        }
    }
}

function connekt(){
    $host = "localhost";
    $user = "root";
    $pasword = "iammary1";
    $database = "lnq";
    $con = mysqli_connect($host, $user, $pasword, $database);
    if (mysqli_errno($con)) {
        die("Error");
    }else{
        return $con;
    }
}

function createUserTable($userName){
    $con = connekt();

    $create_friend_sql = "CREATE TABLE `lnq`.`{$userName}_friends` (
        `friend_id` INT NOT NULL AUTO_INCREMENT ,
        `friend_username` VARCHAR(200) NOT NULL ,
        `friend_datemade` TIMESTAMP NOT NULL ,
        PRIMARY KEY (`friend_id`)) ENGINE = InnoDB;";
    $create_friend_query = mysqli_query($con,$create_friend_sql);

    $create_forum_sql = "CREATE TABLE `lnq`.`{$userName}_forums` (
        `forum_id` INT NOT NULL AUTO_INCREMENT ,
        `forum_name` VARCHAR(200) NOT NULL ,
        `forum_datejoined` TIMESTAMP NOT NULL ,
        PRIMARY KEY (`forum_id`)) ENGINE = InnoDB;";
    $create_forum_query = mysqli_query($con,$create_forum_sql);

    $create_request_sql = "CREATE TABLE `lnq`.`{$userName}_request` (
        `request_id` INT NOT NULL AUTO_INCREMENT ,
        `request_to/from` VARCHAR(200) NOT NULL ,
        `request_message` VARCHAR(10) NOT NULL ,
        `request_date` TIMESTAMP NOT NULL ,
        PRIMARY KEY (`request_id`)) ENGINE = InnoDB;";
    $create_request_query = mysqli_query($con,$create_request_sql);

    if (($create_friend_query > 0) && ($create_forum_query > 0) && ($create_request_query > 0)) {
        $datedg = date('Y-m-d H:i:s');
        $insert_sql = "insert into `lnq`.`{$userName}_forums`(`forum_name`, `forum_datejoined`)values('LnQ Newbies','{$datedg}')";
        $insert_query = mysqli_query($con,$insert_sql);
        if($insert_query > 0){
            return true;
        }
    }
}

function checkExist($tableName,$colName,$checkData){
    $con = connekt();
    if($con){
        $check_sql = "select * from {$tableName} where {$colName} = '{$checkData}'";
        $check_query = mysqli_query($con,$check_sql);
        if (mysqli_num_rows($check_query) > 0) {
            return true;
        }else{
            return false;
        }
    }
}

function incrGroupUsersNo($grpName){
    $con = connekt();
    if($con){
        $sel_sql = "select noOfMembers from groups where groupName = '{$grpName}'";
        $sel_query = mysqli_query($con,$sel_sql);
        $noOfUser = mysqli_fetch_array($sel_query);
        var_dump(intval($noOfUser));
        return $noOfUser;
    }
}
?>
