<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lnQ | Sign Up</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/custom.css">
</head>
<body class="container-fluid">
    <header class="row navbar-fixed-top" id="signUpHeader">
        <div class="col-xs-1 backBtnDiv">
            <i class="fa fa-angle-left" id="backBtn"></i>
        </div>
        <div class="col-xs-8 col-xs-offset-1 titleDiv">
            <h1 class="titleh1">Sign Up</h1>
            <p class="titlep">explore amazing new frontiers....</p>
        </div>
    </header>
    <main class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <form role="form" id="signUpForm">
                <div class="form-group row">
                    <div class="col-xs-12">
                        <input type="text" class="form-control signUpInput col-10" name="name" placeholder="Name" id="name" required>
                        <p class="msgalerts"></p>
                    </div>
                    <div class="col-xs-12">
                        <input type="text" class="form-control signUpInput" name="uname" placeholder="Username" id="uname" required>
                        <p id="userP" class="msgalerts"></p>
                    </div>
                    <div class="col-xs-12">
                        <input type="email" class="form-control signUpInput" name="email" placeholder="Email" id="email" required>
                        <p id="emailP" class="msgalerts"></p>
                    </div>
                    <div class="col-xs-12">
                        <input type="text" class="form-control signUpInput" name="pnum" placeholder="Phone Number" id="pnum" required>
                        <p id="pnumP" class="msgalerts"></p>
                    </div>
                    <div class="col-xs-12">
                        <input type="password" name="pword" class="form-control signUpInput" placeholder="Password" id="pass" required>
                        <p id="pwordP" class="msgalerts"></p>
                    </div>
                    <div class="col-xs-12">
                        <input type="password" name="vpword" class="form-control signUpInput" placeholder="Verify Password" id="vpass" required>
                        <p id="vpwordP" class="msgalerts"></p>
                    </div>
                    <div class="radio col-xs-12">
                        <label class="contol-label" id="gndrTxt">Gender: </label>
                        <label class="radio-inline formIcon">
                        <input type="radio" class="sex" value="male" name="sex"><i class="fa fa-male"></i> Male </label>
                        <label class="radio-inline formIcon">
                        <input type="radio" class="sex" value="female" name="sex"> <i class="fa fa-female"></i> Female</label>
                    </div>
                    <div class="col-xs-10 form-group " >
                        <?php
                        $_SESSION['captext'] = str_shuffle(substr(rand(1000, 9999).
                        str_shuffle('QWERTYGSMNXZPYFH'), rand(0,5), 6));

                        ?>
                        <div>
                            <img id="capimg" src="process/captcha.php" alt="captcha/"/>
                            <p id="validate"><?php echo $_SESSION['captext'];?></p>
                            <p id=""><?php echo $_SESSION['captext'];?></p>
                        </div>
                     </div>
                     <div class="col-xs-7 form-group">
                        <input type="text" name="captcha" required id="cap" class="form-control col-xs-3 signUpInput" placeholder="Type characters here" >
                     </div>
                     <div class="col-xs-4 form-group">
                            <label id="validError">
                                <span style="color:maroon; font-size:18px" class="glyphicon glyphicon-remove-sign"></span>
                            </label>
                            <label id="validOk">
                                <span style="color:#075032; font-size:18px" class="glyphicon glyphicon-ok-sign"></span>
                            </label>
                            <label id="validBtn" style="background:#075032;
                                    font-family:Trebuchet MS;
                                    font-size:10px;
                                    color:white;
                                    padding:5px 5px;
                                    border-radius:6px;
                                    cursor:pointer;
                                    text-align:center;
                                    ">validate &nbsp;<span class="glyphicon glyphicon-ok-circle"></span>
                            </label>
                       </div>


                    <div class="col-xs-8 col-xs-offset-2">
                        <input type="button" name="reg" class="form-control btn btn-primary col-xs-8" value="Sign Up" id="signInBtnB">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-12" id="signUpForm">
            <p id="regok" style="border-radius:0px;font-family:Trebuchet MS;color:#fff;"
                 class="form-control btn btn-success" ></p>
            <br><br><br><br>
        </div>
    </main>

    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/lnq.js"></script>
</body>
</html>
<?php
    foreach($_SESSION as $key=>$value){
        if($key == "captext" || $key == "user"){
            continue;
        }
        unset($_SESSION[$key]);
    }
?>