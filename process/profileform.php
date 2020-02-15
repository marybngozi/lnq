<?php
include './config/functions.php';
$con = connekt();
if (isset($_POST['id']) && isset($_POST['name']) && 
  isset($_POST['email']) && isset($_POST['pnum'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pnum = $_POST['pnum'];
  $update_sql = "UPDATE `reg_details` SET `name`='{$name}', `email`='{$email}', `phone`='{$pnum}' WHERE `id` = '{$id}'";
  $update_query = mysqli_query($con, $update_sql);
  //var_dump($update_query);
  if($update_query){
    echo "Update Successful";
  }
}

//status change process
if (isset($_POST['id']) && isset($_POST['userstatus'])){
  $id = $_POST['id'];
  $stats = $_POST['userstatus'];
  $update_sql = "UPDATE `reg_details` SET `status`='{$stats}' WHERE `id` = '{$id}'";
  $update_query = mysqli_query($con, $update_sql);
  //var_dump($update_query);

}

//search name and username process
if ((isset($_POST['searchwrd'])) && (isset($_POST['usedname']))) {
  $term = strtolower($_POST['searchwrd']);
  $usedname = $_POST['usedname'];
  $termlen = strlen($term);

  if ($term !== "") {
    $sql1 = "SELECT DISTINCT name, username FROM reg_details WHERE ";
    $sql1 .= "reg_details.name LIKE '%{$term}%' OR reg_details.username LIKE '%{$term}%'";
    $result1 = mysqli_query($con,$sql1);

    if (mysqli_num_rows($result1) > 0) {
      while($row = mysqli_fetch_array($result1)){
        if (stristr($row['name'], $term) || stristr($row['username'], $term)) {
          if (strcasecmp($usedname, $row['username']) == 0) {
            # show nothing
          }else {
            echo "<a href='#' data-toggle='modal' data-target='#briefModal' class='tt'><p style='padding:5px; font-size:18px; color:rgb(49, 138, 123);'>{$row['name']}</br>";
            echo "<span class='briefname' style='padding:5px; font-size:13px; color:#808080'>{$row['username']}</span></p></a>";
          }
          
        }else {
          echo "<p class='ttn'>No Result Found</p>";
        }
      }
    }else{
      echo "<p class='ttn'>No matches found</p>";
    }
  }
}

//search group process
if (isset($_POST['searchgrp'])) {
  incrGroupUsersNo('LnQ Newbies');
  $grp = strtolower($_POST['searchgrp']);
  $grplen = strlen($grp);

  if ($grp !== "") {
    $sql2 = "SELECT DISTINCT groupName FROM groups WHERE groups.groupName LIKE '%{$grp}%'";
    $result2 = mysqli_query($con,$sql2);

    if (mysqli_num_rows($result2) > 0) {
      while($row2 = mysqli_fetch_array($result2)){
        $cutgrp = substr($row2['groupName'], 0, $grplen);
        if (stristr($row2['groupName'], $grp)) {
          echo "<a href='#' data-toggle='modal' data-target='#grpModal' class='ttg'>{$row2['groupName']}</a>";
        }else {
          echo "<p class='ttn'>No Result Found</p>";
        }
      }
    }else{
      echo "<p class='ttn'>No matches found</p>";
    }
  }
}
  
//brief user profile
if ((isset($_POST['usname'])) && (isset($_POST['ownerName']))) {
  $ownerName = $_POST['ownerName'];
  $clicked_usename = $_POST['usname'];
  $brief_sql = "select * from reg_details where username = '$clicked_usename'";
  $brief_query = mysqli_query($con,$brief_sql);
  $brief = mysqli_fetch_array($brief_query);
  if (checkExist("{$ownerName}_friends","friend_username",$clicked_usename)) {
    echo "You are already friends with {$clicked_usename}";
  }else{
    echo "<center>";
    echo "<h3>{$brief['name']}</h3><img class='img-responsive img-circle' width='200' height='200' src='uploads/{$brief['profile_picture']}'>";
    echo "<br><p id='moduname'><b><i>{$brief['username']}</i></b></p>";
    echo "<p><em>{$brief['status']}</em></p>";
    echo "</center>";
  }
  

}

//handles friend request sending
if ((isset($_POST['request_to'])) && (isset($_POST['request_from']))) {
  $request_to = $_POST['request_to'];
  $request_from = $_POST['request_from'];

  // checks if request has already been sent
  $sel_req_sql = "select `request_to/from` from `{$request_from}_request` where `request_to/from` = '{$request_to}_request'";
  $sel_req_query = mysqli_query($con,$sel_req_sql);
  if ($sel_req_query) {
    echo "Requested already!!!";
  }else {
    $send_sql = "INSERT INTO `{$request_from}_request` (`request_to/from`, `request_message`, `request_date`) VALUES ('{$request_to}', 'sent', CURRENT_TIMESTAMP)";
    $recieve_sql = "INSERT INTO `{$request_to}_request` (`request_to/from`, `request_message`, `request_date`) VALUES ('{$request_from}', 'recieved', CURRENT_TIMESTAMP)";
    $send_query = mysqli_query($con,$send_sql);
    $recieve_query = mysqli_query($con,$recieve_sql);
    if (($send_query) && ($recieve_query)) {
      echo "<p>Request Sent Successfully!!!</p>";
    }
  }
}

//handles accepting friend request
if ((isset($_POST['request_tod'])) && (isset($_POST['request_fromd']))) {
  $request_tod = $_POST['request_tod'];
  $request_fromd = $_POST['request_fromd'];

  // deletes the friend requests accepted
  $del_sent_sql = "DELETE FROM `{$request_fromd}_request` WHERE `request_to/from` = '{$request_tod}'";
  $del_recieve_sql = "DELETE FROM `{$request_tod}_request` WHERE `request_to/from` = '{$request_fromd}'";
  $del_send_query = mysqli_query($con,$del_sent_sql);
  $del_recieve_query = mysqli_query($con,$del_recieve_sql);
  if (($del_send_query) && ($del_recieve_query)) {
    $insert_friend_sql = "INSERT INTO `{$request_tod}_friends` (`friend_username`, `friend_datemade`) VALUES ('{$request_fromd}', CURRENT_TIMESTAMP)";
    $insert_friend_sql1 = "INSERT INTO `{$request_fromd}_friends` (`friend_username`, `friend_datemade`) VALUES ('{$request_tod}', CURRENT_TIMESTAMP)";
    $insert_friend_query = mysqli_query($con,$insert_friend_sql);
    $insert_friend_query1 = mysqli_query($con,$insert_friend_sql1);
    if(($insert_friend_query) && ($insert_friend_query1)){
      $create_lnq_sql = "CREATE TABLE `lnq`.`{$request_fromd}-{$request_tod}` ( 
        `mess_id` INT NOT NULL AUTO_INCREMENT , 
        `mess_sender` VARCHAR(200) NOT NULL , 
        `message` TEXT NOT NULL , 
        `mess_time` TIMESTAMP NOT NULL , 
        PRIMARY KEY (`mess_id`)) ENGINE = InnoDB;";
      $create_lnq_query = mysqli_query($con,$create_lnq_sql);
      if ($create_lnq_query) {
        echo "Thank God";
      }
      
    }
  }
}
?>