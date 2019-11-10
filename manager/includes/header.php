<?php 
session_start();
require_once('includes/configDB.php');
//checking for the session data for the system
if (isset($_SESSION['shop_sec'])) {
    $email = $_SESSION['shop_sec'];
    $shop = $dbacc->prepare("SELECT * FROM `shop_details` WHERE `shopEmail`=:email");
    $shop->execute(array(":email" => $email));
    $row = $shop->fetch(PDO::FETCH_ASSOC);
    $count = $shop->rowCount();
    if($row['shop_status'] == 0){
      header('location:payment.php');
    } elseif($_SESSION['shop_sec'] != $row['shopEmail']){
        header('location: ../login.php');
    }
}else{
    header('location: ../login.php');
}
//shop ID to be used by all of the other remaining pages..!!
$shopid = $row['shop_id'];
$Tdate  = data_cleaner(date('Y-m-d'));
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Home | <?php echo $row['shopName']; ?></title>
<meta name="author" content="Genes">
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css?h=2cc656fcd4198eb1d0e80dceaf418cf2">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
<link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="../assets/fonts/material-icons.min.css">
<link rel="stylesheet" href="../assets/fonts/simple-line-icons.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,300,700,400italic,300italic,700italic">
<link rel="stylesheet" href="../assets/css/styles.min.css?h=807201580de509d8a54d863067a4486a">
</head>
<body>
<nav class="navbar navbar-light navbar-expand-md navigation-clean navbar-inverse navbar-fixed-top">
<div class="container">
<a class="navbar-brand" href="index.php" style="padding: 0px;margin-left: 0px;height: 10px;color: rgb(255,255,255);"><?php echo $row['shopName']; ?></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="navcol-1">
    <ul class="nav navbar-nav ml-auto" style="margin-top:13px;">
        <li class="nav-item" role="presentation"><a class="nav-link" href="sales.php" uk-scroll="offset:50">Add sales</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" href="expenses.php" uk-scroll="offset:100">Add Expenses</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" href="stock.php" uk-scroll="offset:100">Add Products</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" href="reports.php" uk-scroll="offset:50">View Reports</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php" uk-scroll="offset:50">logout</a></li>

    </ul>
    </div>
</div>
</nav>