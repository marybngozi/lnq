<?php
  include 'config/functions.php';
  $con = connekt();
  $sql = "select * from reg_details where username = '{$_SESSION['user']}'";
  $query = mysqli_query($con, $sql);
  if ($query) {
    $member = mysqli_fetch_assoc($query);
    $_SESSION['user_id'] = $member['id'];
    $_SESSION['user_pword'] = $member['password'];
    $_SESSION['user_name'] = $member['name'];
    $_SESSION['user_uname'] = $member['username'];
    $_SESSION['user_status'] = $member['status'];
    $_SESSION['user_sex'] = $member['gender'];
    $_SESSION['user_phone'] = $member['phone'];
    $_SESSION['user_email'] = $member['email'];
    $_SESSION['user_pp'] = $member['profile_picture'];
  }else{
    header("Location:/lnq/index.php");
  }
  function getRequests(){
    $con = connekt();
    $req_sql = "SELECT `request_to/from` FROM `{$_SESSION['user_uname']}_request` WHERE `request_message` = 'recieved'";
    $req_query = mysqli_query($con,$req_sql);
    $reqmess = "";
    $numb = 0;
    if (mysqli_num_rows($req_query) > 0) {
      while ($req = mysqli_fetch_assoc($req_query)) {
        $reqmess .= "<p class='reqP' data-toggle='modal' data-target='#briefModal2'><a href='#' class='reqName'>{$req['request_to/from']}</a> wants to be friend with you</p>";
        $numb++;
      }
    }else{
      $reqmess .= "No Requests";
    }
    return $reqmess;
  }

  function showFriends(){
    $con = connekt();
    $friend_sql = "SELECT `friend_username` FROM `{$_SESSION['user_uname']}_friends`";
    $friend_query = mysqli_query($con,$friend_sql);
    if ($friend_query) {
      $friend_list = "<ul>";
      while ($friend = mysqli_fetch_assoc($friend_query)) {
        $deQuery = mysqli_query($con, "select * from reg_details where `username` = '{$friend['friend_username']}'");
        $friender = mysqli_fetch_assoc($deQuery);
        $friend_list .= "<li><img src='uploads/{$friender['profile_picture']}' class='img-circle' width='30' height='30'>{$friend['friend_username']}</li>";
      }
      $friend_list .= "</ul>";
    }
    return $friend_list;
  }

?>