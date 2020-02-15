<?php
session_start();
require_once "config/functions.php";
  // if (isset($_POST['reg'])) {
    $con = connekt();
    if ($con) {

      $name = secure($_POST['name']);
      $uname = secure($_POST['uname']);
      $email = secure($_POST['email']);
      $phone = secure($_POST['pnum']);
      $gend = secure($_POST['sex']);
      $pword = $_POST['pword'];
      $vpword = $_POST['vpword'];
      $capcha = strtoupper($_POST['captcha']);

      $secured = validate($name,$uname,$email,intval($phone),$gend,$pword,$capcha);
      if ($secured) {

        if ($pword == $vpword) {
          $hash_pword = password_hash($pword,PASSWORD_DEFAULT);
          if ($capcha == $_SESSION['captext']) {
            $select_sql = "select * from reg_details";
            $select_query = mysqli_query($con, $select_sql);
            if ($select_query) {
              while ($member = mysqli_fetch_assoc($select_query)) {
                if ($member['username'] === $uname) {
                  $_SESSION['usn_exist'] = "Username already used!";
                }elseif ($member['email'] === $email) {
                  $_SESSION['email_exist'] = "Email exists!";
                }elseif ($member['phone'] === $phone) {
                  $_SESSION['num_exist'] = "Phone Number exists!";
                }
              }
            }

            if(!isset($_SESSION['usn_exist']) && !isset($_SESSION['email_exist'])
              && !isset($_SESSION['num_exist'])){
              $dated = date('Y-m-d H:i:s');
              $gend_pic = $gend.".png";
              $default_stat = "Hey am lnQing ...";
              $insert_sql = "insert into `reg_details` (`name`, `username`, `email`, `phone`, `gender`, `password`, `date_reg`, `profile_picture`, `status`)";
              $insert_sql .= "values('{$name}', '{$uname}', '{$email}', '{$phone}', '{$gend}', '{$hash_pword}', '{$dated}' , '{$gend_pic}', '{$default_stat}')";
              $insert_query = mysqli_query($con, $insert_sql);
              if(mysqli_affected_rows($con) > 0){
                //create an online presence
                $online_sql = "select id from reg_details where username = '{$uname}'";
                $online_query = mysqli_query($con, $online_sql);
                $on_member = mysqli_fetch_assoc($online_query);
                $insert_online = "insert into `users-online`(`username`, `user_id`, `time`, `status`)";
                $insert_online .= "values ('{$uname}','{$on_member['id']}',CURRENT_TIMESTAMP,'online')";
                $insert_online_query = mysqli_query($con, $insert_online);
                if($insert_online_query){
                  setcookie("uname", $uname, time() + (86400 * 30));
                  if (createUserTable($uname)) {
                    $_SESSION['user'] = $uname;
                    echo "Registration successful..redirecting";
                  }
                }
              }
            }
          }
        }
      }
    }
  // }
?>
<?php
  foreach($_SESSION as $key=>$value){
    if($key == "captext" || $key == "user"){
      continue;
    }
    unset($_SESSION[$key]);
  }
?>