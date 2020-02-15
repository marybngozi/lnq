<?php session_start();
if (isset($_SESSION['user'])) {
//    echo $_SESSION['user'];
}else {
   header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lnQ | User-Home</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/custom.css">
</head>
<body class="container-fluid" id="mybody">
<?php include 'process/select.php';?>
    <header class="navbar-fixed-top" id="myheader">
        <div class="col-xs-1 backBtnDiv">
            <i class="fa fa-angle-left" id="backBtn"></i>
        </div>
        <div class="col-xs-8 col-xs-offset-1 titleDiv">
            <br><br><br><br><br><br>
        </div>
        <div id="dp">
            <img id="profilepic" src="uploads/<?php echo $_SESSION['user_pp'];?>" alt="" class="img-responsive img-circle img-thumbnail sidebardp">
        </div>
    </header>
    
    <div class="col-xs-12" id="userDetails"><br>
        <h3 id="snameName"><?php echo $_SESSION['user_name']?></h3>
        <h4 id="username"><i><?php echo $_SESSION['user_uname']?></i></h4>
        <p id="status"><?php echo $_SESSION['user_status'];?></p> <i>&nbsp;</i> <span class="btn sbtns" id="updateS">Update Status</span> 
            <input type="hidden" id="userId" name="userId" value="<?php echo $_SESSION['user_id']?>">
            <input class="signUpInput col-xs-4" type="text" name="" id="statupdateinput" value="<?php echo $_SESSION['user_status'];?>"> <br><br>
        <p id="frndsFrms"><i class="fnf" id="numFrnds">90</i> friends <span><i class="fnf" id="numFrms">5</i> forums</span></p><br>
        <div>
            <span class="btn sbtns" id="ep">Edit Profile</span>
            <span class="btn sbtns" id="cp">Change Password</span>
        </div><br>
    </div>
    <div class="col-xs-10 col-xs-offset-1">
        <form method="post" role="form" id="updatep">
            <div class="form-group row">
                <input type="hidden" id="userId" name="userId" value="<?php echo $_SESSION['user_id']?>">
                <div class="col-xs-12">
                    <input type="text" class="form-control signUpInput col-10" name="name" value="<?php echo $_SESSION['user_name']?>" id="upname">
                    <br>
                </div>

                <div class="col-xs-12">
                    <input type="email" class="form-control signUpInput" name="email" value="<?php echo $_SESSION['user_email']?>" id="uemail">
                    <p id="UemailP" class="msgalerts"></p>
                </div>
                
                <div class="col-xs-12">
                    <input type="text" class="form-control signUpInput" name="pnum" value="<?php echo $_SESSION['user_phone']?>" id="upnum"> <br>
                    <p id="UpnumP" class="msgalerts"></p>
                </div>
                
                <div class="col-xs-8 col-xs-offset-2">
                    <input type="button" class="form-control btn pbtns col-xs-8" value="Update Profile" id="updateBtn">
                </div>
            </div>
        </form>

        <form method="post" role="form" id="changepass">
            <div class="form-group row">
            <input type="hidden" id="userId" value="<?php echo $_SESSION['user_id']?>">
                <div class="col-xs-12">
                    <input type="password" class="form-control signUpInput col-10" id="oldpass" placeholder="old password">
                    <br>
                </div>

                <div class="col-xs-12">
                    <input type="password" class="form-control signUpInput" id="newpass" placeholder="new password">
                    <p id="newpassP" class="msgalerts"></p>
                </div>
                
                <div class="col-xs-12">
                    <input type="password" class="form-control signUpInput" id="vnewpass" placeholder="verify password"><br><br>
                    <p id="vnewpassP" class="msgalerts"></p>
                </div>

                <div class="col-xs-8 col-xs-offset-2">
                    <input type="button" class="form-control btn pbtns col-xs-8" value="Change Password" id="passBtn">
                </div>
            </div>
        </form>
        <p id="dumpn"></p>
    </div>

    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/lnq.js"></script>
</body>
</html>