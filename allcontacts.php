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
    <title>lnQ | All Contacts</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/custom.css">
</head>
<body class="container-fluid">
    <header class="row" id="signUpHeader">
        <div class="col-xs-1 backBtnDiv">
            <i class="fa fa-angle-left" id="backBtn"></i>
        </div>
        <div class="col-xs-6 col-xs-offset-1 titleDiv">
            <p class="auxhead">All Contacts</p>
        </div>
        <div class="col-xs-3 addNewDiv">
            <a href="search.php" class="fa fa-plus newBtn"></a>
        </div>
    </header>
    <main class="row">
        <div class="col-xs-10 col-xs-offset-1">
            
        </div>
    </main>

    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/lnq.js"></script>
</body>
</html>