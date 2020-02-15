<?php
session_start();
require_once "config/functions.php";
if (isset($_POST['log'])) {
  $con = connekt();
  if ($con) {
    $usename = secure($_POST['uname']);
    $pword = $_POST['pword'];
    if (!empty($usename) && !empty($pword)) {
      $select_sql = "select * from reg_details";
      $select_query = mysqli_query($con, $select_sql);
      $user_found = 0;                        
      while ($member = mysqli_fetch_assoc($select_query)) {
        if(($member['username'] === $usename || $member['email'] === $usename)  && password_verify($pword,$member['password'])){
          $user_found++;
        }  
      }
      if($user_found > 0){
        $online_update = "UPDATE `users-online` SET `status` = 'online' WHERE username ='{$usename}'";
        $online_update_query = mysqli_query($con, $online_update);
        if($online_update_query > 0){
          setcookie("uname", $usename, time() + (86400 * 30));
          $_SESSION['user'] = $usename;
          header("Location:../userhome.php");
        }else {
          header("Location:../index.php");
        }
      }else{
        $_SESSION['login_stat'] = "Username or Password incorrect!";
        header("Location:../index.php");
      }
    }else{
      $_SESSION['login_stat'] = "Fill all Fields!";
      header("Location:../index.php");
    }
  }else {
    header("Location:../index.php");
  }
}else {
  header("Location:../index.php");
}
//echo $_SESSION['login_stat'];
?>
