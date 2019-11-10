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
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Home|<?php echo $row['shopName']; ?></title>
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
<nav class="navbar navbar-light navbar-expand-md navigation-clean navbar-inverse navbar-fixed-top" style="height: 50px;">
<div class="container">
<a class="navbar-brand" href="index.php" style="padding: 0px;margin-left: 0px;height: 10px;color: rgb(255,255,255);"><?php echo $row['shopName']; ?></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
<div style="float: right;" class="content" id="navcol-1">
    <p style="font-size:30px; color: #0f0;"><i class="icon fa fa-fa flag"></i></p>
    </div>
</div>
</nav>
<?php 
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Holla! </strong> Welcome to your shop we are happy to serve you
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
?>
<div style="padding-top: 10px">
    <div class="container" style="background-color: #dfdfdf; padding-top: 2px;padding-right:5px; padding-bottom:2px;">
        <div class="row">
            <div class="col-md-3 offset-md-0 text-white" style="background-color: #1f2021; border-radius: 5px;" >
                <h2><?php echo $row['shopName']; ?></h2>
                <hr style="width: 10px;">
                <p >owner: <?php echo $row['shopOwner']; ?></p>
                <p>Phone: <?php echo $row['shopPhone']; ?></p>
                <p>Email: <?php echo $row['shopEmail']; ?></p>
            </div>
            <div class="col-md-9">
              <section id="services" class="content-section  text-white text-center" style="background-color: #1f2021">
          <div class="container">
            <div class="content-section-heading">
                <h2 class="mb-5" style="color: #efefef" > Management Dashboard</h2>
            </div>
            <div class="row">
              <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                <a href="sales.php" style="text-decoration: none; color: inherit;">
                <span class="mx-auto service-icon rounded-circle mb-3"><i class="icon-layers"></i></span>
                <h4><strong>Sales</strong></h4>
                </a>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                  <a href="expenses.php" style="text-decoration: none; color: inherit;">
                  <span class="mx-auto service-icon rounded-circle mb-3"><i class="icon-credit-card"></i></span>
                  <h4><strong>Expenses</strong></h4>
                  </a>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                  <a href="stock.php" style="text-decoration: none; color: inherit;">
                  <span class="mx-auto service-icon rounded-circle mb-3"><i class="fa fa-balance-scale"></i></span>
                  <h4><strong>Stocks</strong></h4>
                </a>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                  <a href="reports.php" style="text-decoration: none; color: inherit;">
                  <span class="mx-auto service-icon rounded-circle mb-3"><i class="icon-notebook"></i></span>
                  <h4><strong>Reports</strong></h4>
                </a>
                </div>
            </div>
        </div>
    </section>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/jquery.min.js?h=1dd785e1de9a32e236b624ae268bb803"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js?h=63715b63ee49d5fe4844c2ecae071373"></script>
<script src="../assets/js/script.min.js?h=45fa2fcdf0745d6e1750b946e9789ba5"></script>
</body>
</html>