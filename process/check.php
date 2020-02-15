<?php
//ini_set('display_errors', '0');
require_once "./config/functions.php";
if(isset($_POST['uname'])){
$uname = $_POST['uname'];
if(checkExist("reg_details","username",$_POST['uname'])){echo "Username taken!";}
}elseif(isset($_POST['email'])){
$email = $_POST['email'];
if(checkExist("reg_details","email",$_POST['email'])){echo "Email Used!";}
}elseif(isset($_POST['phone'])){
$phone = $_POST['phone'];
if(checkExist("reg_details","phone",$_POST['phone'])){echo "Phone number already used!";}
}
?>