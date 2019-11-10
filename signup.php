
<?php 
session_start();
require_once ('manager/includes/configDB.php');
if(isset($_POST['submit']) && isset($_POST['ownername']) && isset($_POST['shopname'])){
    $shopowner = data_cleaner($_POST['ownername']);
    $shopname = data_cleaner($_POST['shopname']);
    $shopphone = data_cleaner($_POST['ownertel']);
    $shopemail = data_cleaner($_POST['owneremail']);
    $shoppassword = data_cleaner($_POST['password1']);
    $shoppassver = data_cleaner($_POST['password2']);
    if (!empty($shopowner) && !empty($shopname) && !empty($shopphone) && !empty($shopemail) && !empty($shoppassword) && !empty($shoppassver)) {
        $mailchk = $dbacc->prepare("SELECT `shopEmail` FROM `shop_details` WHERE `shopEmail`=?");
        $mailchk->execute(array($shopemail));
        if ($mailchk->rowCount() !== 0) {
            $rpmail= "Please use another email";
        }else{
            if ($shoppassword == $shoppassver) {
                $key = "@_%_@";
                $ownerpass = md5($shoppassword.$key);
            }else{
                $erpass = "Error passwords do not match";
            }
            $register = $dbacc->prepare("INSERT INTO `shop_details` (`shopName`, `shopOwner`, `shopPhone`, `shopEmail`, `shopPassword`) VALUES (?,?,?,?,?)");
            if (isset($ownerpass) && $register->execute(array($shopname,$shopowner,$shopphone, $shopemail, $ownerpass))) {
                $_SESSION['registeredLog'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Success!</strong> login in here..!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
                header('location: login.php');
            }else{
                $erdet = "Please enter the correct details";
            }
        }
    }else{
        $erem = "Please fill all the fields";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Project</title>
    <meta name="author" content="Genes">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=2cc656fcd4198eb1d0e80dceaf418cf2">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,300,700,400italic,300italic,700italic">
    <link rel="stylesheet" href="assets/css/styles.min.css?h=807201580de509d8a54d863067a4486a">
<title> shop accounting manager</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-light navbar-expand-md">
            <div class="container-fluid"><a class="navbar-brand" href="index.html"><strong>Myshop</strong></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav"></ul><a class="btn btn-primary ml-auto action-button" role="button" href="index.html">Home</a></div>
            </div>
        </nav>
    </header>
    <div class="d-flex flex-column justify-content-center" id="login-box">
        <form action="signup.php" method="POST">
            <div class="login-box-header">
                <h4 style="color:rgb(139,139,139);margin-bottom:0px;font-weight:400;font-size:27px;">Sign up</h4>
            </div>
            <div class="email-login" style="background-color:#efefef;">
<?php 
if (isset($rpmail)) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>failed </strong>".$rpmail."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
}
if (isset($erpass)) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>failed </strong>".$erpass."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
}
if (isset($erdet)) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>failed </strong>".$erdet."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
}
if (isset($erem)) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>failed </strong>".$erem."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
}
?>
                <!-- owner name -->
                <input type="text"  name="ownername" required="true" placeholder="Owner Name" minlength="3" class="text-input form-control" required="true" style="margin-top:10px;" title="name of the owner of the shop">
                <!-- shop name -->
                <input type="text" name="shopname" required="true" placeholder="Shop Name" class="text-input form-control" style="margin-top:10px;" title="name of the shop">
                <!-- phone number -->
                <input type="tel" name="ownertel" required="true" placeholder="phone: +255623458919" minlength="10" class="text-input form-control" style="margin-top:10px;" title="Shop's business phone number">
                <!-- email -->
                <input type="email" name="owneremail" required="true" placeholder="email: email@example.com" class="email-input form-control" style="margin-top:10px;" title="shop's business email address">
                <!-- PASSWORD section -->
                <!-- pass1 -->
                <input type="password" name="password1" id="password1" required="true" placeholder="******" minlength="4" class="password-input form-control" style="margin-top:10px;" title="password">
                <!-- password verification -->
                <input type="password" name="password2" id="password2" required="true" placeholder="******" minlength="4" class="password-input form-control" style="margin-top:10px;" title="password verification">
            </div>
            <div class="submit-row" style="margin-bottom:8px;padding-top:0px;">
                <button class="btn btn-primary btn-block box-shadow" type="submit" name="submit" id="submit-id-submit" title="submit you shop's details">Sign up</button>
            </div>
            <div id="login-box-footer" style="padding:10px 20px;padding-bottom:23px;padding-top:18px;">
                <p style="margin-bottom:0px;">Already have an account&nbsp;<a href="login.php" id="register-link">Login</a></p>
            </div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js?h=1dd785e1de9a32e236b624ae268bb803"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=63715b63ee49d5fe4844c2ecae071373"></script>
    <script src="assets/js/script.min.js?h=45fa2fcdf0745d6e1750b946e9789ba5"></script>
    <!-- script for password match -->
    <script>
        window.onload = function () {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            console.log('passwords dont match');
            else
                document.getElementById("password2").setCustomValidity('');
            console.log("passwords matched");
            //empty string means no validation error
        }
    </script>
    <!-- script for password match -->
</body>
</html>