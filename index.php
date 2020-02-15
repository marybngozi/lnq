<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lnQ | Home</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/custom.css">    
</head>
<body class="container-fluid" id="indexBody">
    <div class="row" id="opq">
        <div class="col-sm-7" id="head">
            <h1 id="logo">lnQ</h1>
            <article id="logoArticle">
                an amazing new way to link 
                and connect with those that matter while meeting new people
            </article>
        </div>
        <div class="col-sm-5" id="loginForm">
            <form action="process/logRegform.php" method="post" role="form">
                <div class="form-group"> 
                    <label style="color:maroon;">
                        <?php
                        if (isset($_SESSION['login_stat'])) {
                            echo $_SESSION['login_stat'];
                        }
                        ?>
                    </label>    
                </div>
                <div class="form-group">
                    <input type="text" name="uname" class="form-control customInput" placeholder="email or username">
                </div>
                <div class="form-group">
                    <input type="password" name="pword" class="form-control customInput" placeholder="password">
                </div>
                <div class="form-group"><i><a href="#" id="fgtPswd">forgot password?</a></i></div>
                <div class="form-group">
                    <input type="submit" name="log" class="form-control btn btn-primary" value="Sign In" id="signInBtn">
                    <span><a href="signup.php" id="signUpBtn">Sign Up</a></span>
                </div>
            </form>
        </div>
        <footer class="col-sm-12" id="indexfooter">
            <span class="footerD">ABOUT</span> <span class="footerD">CONTACT</span> <span class="footerD">FAQs</span>
        </footer>
    </div>
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/lnq.js"></script>
</body>
</html>
<?php
session_destroy();
$_SESSION = array();
?>