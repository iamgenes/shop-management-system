<?php 
session_start();
unset($_SESSION['shop_sec']);

if(session_destroy()){
		$loggedout =  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>success!</strong>  Logged out of the system<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Myshop | logout</title>
<meta name="author" content="Genes">
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css?h=2cc656fcd4198eb1d0e80dceaf418cf2">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
<link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="../assets/fonts/material-icons.min.css">
<link rel="stylesheet" href="../assets/fonts/simple-line-icons.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,300,700,400italic,300italic,700italic">
<link rel="stylesheet" href="../assets/css/styles.min.css?h=807201580de509d8a54d863067a4486a">
</head>
<body style="background-color: #1f7fb4;">
<center>
<div class="jumbotron centered text-xs-center" style="background-color: #1f7fb4;">
  <h1 class="display-3">Thank You!</h1>
  <p class="lead">For using our service</p>
  <?php 
    if (isset($loggedout)) {
      echo $loggedout;
    }
   ?> 
  <hr>
  <p>
    Having trouble? <a href="mailto:genes0022@gmail.com" target="_blank" title="genes0022@gmail.com" style="text-decoration: none; color: yellow;">Contact us</a>
  </p>
  <p class="lead">
    <a class="btn btn-success btn-sm" href="../index.html" role="button">Continue to homepage</a>
    <a class="btn btn-secondary btn-sm" href="../login.php" role="button">login</a>
  </p>
</div>
</center>
<script src="../assets/js/jquery.min.js?h=1dd785e1de9a32e236b624ae268bb803"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js?h=63715b63ee49d5fe4844c2ecae071373"></script>
<script src="../assets/js/script.min.js?h=45fa2fcdf0745d6e1750b946e9789ba5"></script>
</body>
</html>