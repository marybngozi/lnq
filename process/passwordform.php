<?php
session_start();
include 'select.php';
$con = connekt();
  if (isset($_POST['id']) && isset($_POST['oldpass']) && 
    isset($_POST['newpass']) && isset($_POST['vnewpass'])) {
    $id = $_POST['id'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $vnewpass = $_POST['vnewpass'];
    //var_dump($_POST);
    if (password_verify($oldpass, $_SESSION['user_pword'])) {
      if (strlen($newpass) > 5) {
        if ($newpass == $vnewpass) {
          $hash_pword = password_hash($newpass,PASSWORD_DEFAULT);
          $update_psql = "UPDATE `reg_details` SET `password`='{$hash_pword}' WHERE `id` = '{$id}'";
          $update_pquery = mysqli_query($con, $update_psql);
          if($update_pquery){
            echo "Update password Successful";
          }
        }
      }
    }else {
      echo "Old password incorrect";
    }
  }
?>  