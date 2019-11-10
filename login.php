<?php 
session_start();
require_once('manager/includes/configDB.php');

//removing the session data for the user to login again.
if (isset($_SESSION['shop_sec'])) {
     unset($_SESSION['shop_sec']);  
}

if (isset($_POST['submit_login'])) {
    $mail = data_cleaner($_POST['loginMail']);
    $pass = data_cleaner($_POST['loginPass']);
    $key = "@_%_@";

    //encripting password
    $passphrase = md5($pass.$key);
    try {
        $sql = $dbacc->prepare("SELECT * FROM `shop_details` WHERE `shopEmail`=:email");
        $sql->execute(array(":email" => $mail));
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $count = $sql->rowCount();
        if ($row['shopPassword']==$passphrase){
            $_SESSION['shop_sec'] = $row['shopEmail'];
            header('location: manager/');
        }else {
            $baddet = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Failed!</strong> Wrong password..!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";  
        }
        
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="author" content="Genes">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=2cc656fcd4198eb1d0e80dceaf418cf2">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,300,700,400italic,300italic,700italic">
    <link rel="stylesheet" href="assets/css/styles.min.css?h=807201580de509d8a54d863067a4486a">
<title>login | shop accountant</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-light navbar-expand-md">
            <div class="container-fluid"><a class="navbar-brand" href="index.html"><strong>Myshop</strong></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav"></ul><a class="btn btn-primary ml-auto action-button" role="button" href="index.html">Home</a></div>
            </div>
        </nav>
</header>
<div class="d-flex flex-column justify-content-center" id="login-box">
    <div class="login-box-header">
        <h4 style="color:rgb(139,139,139);margin-bottom:0px;font-weight:400;font-size:27px;">Login</h4>
    </div>
<form action="login.php" method="POST">
    <div class="email-login" style="background-color:#efefef;">
<?php 
if (isset($baddet)) {
    echo $baddet;
}
if (isset($_SESSION['registeredLog'])) {
    echo $_SESSION['registeredLog'];
    unset($_SESSION['registeredLog']);
}
?>
        <input type="email" name="loginMail" required="true" placeholder="example@mail.com" autocomplete="off" class="email-imput form-control" style="margin-top:10px;">
        
        <input type="password" name="loginPass" required="" placeholder="Password"  autocomplete="off" class="password-input form-control" style="margin-top:10px;">
    </div>
    <div class="submit-row" style="margin-bottom:8px;padding-top:0px;"><button class="btn btn-primary btn-block box-shadow" name="submit_login" type="submit" id="submit-id-submit">Login</button>
    </div>
    <div id="login-box-footer" style="padding:10px 20px;padding-bottom:23px;padding-top:18px;">
        <p style="margin-bottom:0px;">Don't you have an account?<a href="signup.php" id="register-link">Sign Up!</a></p>
    </div>
    </div>
</form>
    <script src="assets/js/jquery.min.js?h=1dd785e1de9a32e236b624ae268bb803"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=63715b63ee49d5fe4844c2ecae071373"></script>
    <script src="assets/js/script.min.js?h=45fa2fcdf0745d6e1750b946e9789ba5"></script>
</body>
</html>