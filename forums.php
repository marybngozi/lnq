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
    <title>lnQ | User-Forums</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/custom.css">
</head>
<body class="container-fluid" id="mybody">
<?php include 'process/select.php';?>   
<header class="navbar-fixed-top" id="myheader">
        <div id="mySidenav" class="sidenav">
            <div style="height:240px; background:#fff;margin-top:-30%">
                <span class="col-xs-4 closebtn fa fa-angle-left" style="color:slategrey;"></span>
                <img src="uploads/<?php echo $_SESSION['user_pp'];?>" alt="" class="img-responsive img-circle img-thumbnail sidebardp">
                <p class="sidebarname"><?php echo $_SESSION['user_name']?></p>
                <p class="sidebaruname"><?php echo $_SESSION['user_uname']?></p>
                <p class="sidebarstatus"><?php echo $_SESSION['user_status'];?></p>
            </div>
            
            <a href="userhome.php"><i class="fa fa-home"></i> &nbsp;Home</a>
            <a href="profile.php"><i class="fa fa-sliders"></i> &nbsp;Profile</a>
            <a href="allcontacts.php"><i class="fa fa-user"></i> &nbsp;All Contacts</a>
            <a href="forums.php"><i class="fa fa-group"></i> &nbsp;All Forums</a>
            <a href="setting.php"><i class="fa fa-gears"></i> &nbsp;Settings</a>
            <a href="./process/logout.php"><i class="fa fa-power-off"></i> &nbsp;Sign Out</a>
        </div>
        <span class="col-xs-4" id="openN">&#9776;</span>
    </header>
    <main class="row">
        <div class="col-sm-12" id="contentArea">
            <p>bloody hell!!!!!!!!!!!!!!!</p>
        </div>
    </main>
    <footer class="row customNavBar">
        <div class="col-xs-12">
            <div class="col-xs-4"><a href="userhome.php"><i class="fa fa-commenting"></i> CHATS</a></div>
            <div class="col-xs-4"><a href="forums.php" id="Cactive"><i class="fa fa-comments"></i> FORUMS</a></div>
            <div class="col-xs-4"><a href="search.php"><i class="fa fa-search"></i> SEARCH</a></div>
        </div>
    </footer>

    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/lnq.js"></script>
</body>
</html>