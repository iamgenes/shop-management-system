<?php 
session_start();
require_once('../includes/configDB.php');
//checking if the shop is deactivated before loading the shop list.
if (isset($_POST['deactivate'])) {
    $name = $_POST['shopname'];
    $q = $dbacc->prepare("UPDATE `shop_details` SET `shop_status` = '0' WHERE `shop_details`.`shopName` = ?");
    if ($q->execute(array($name))){
        $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Success!</strong> ".$name." shop deactivated..!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }
}

//checking for the session data for the system
if (isset($_SESSION['SHOP_ADMIN_SEC'])) {
    $email = $_SESSION['SHOP_ADMIN_SEC'];
    $admin = $dbacc->prepare("SELECT * FROM `shop_details` WHERE `shop_status`= 1");
    $admin->execute();
    $count = $admin->rowCount();
}else{
    header('location: login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Active shops</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md custom-header">
        <div class="container-fluid"><a class="navbar-brand" href="./">Online Shop Accountant</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav links">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="./">Active shops</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="inactive.php">Inactive shops</a></li>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"> </a>
                        <div class="dropdown-menu dropdown-menu-right" role="menu"><a class="dropdown-item" role="presentation" href="logout.php">Logout </a></div>
                    </li>
                </ul>
        </div>
        </div>
    </nav>
    <h1 class="text-center">Active Shops</h1>
        <?php 
        if (isset($msg)) {
                echo $msg;
            }    

     ?>
    <div class="datagrid">
        <table class="table">
            <thead>
                <tr>
                    <th>no</th>
                    <th>Shop name</th>
                    <th>Contact</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($count == 0) {
                    echo "<tr><td colspan='5'><center><h4>There is no any Inactive shop</h4></center></td></tr>";
                }
                $counter = 1;
                while ($row = $admin->fetch(PDO::FETCH_ASSOC)) {                 
                echo "<tr>
                    <td>".$counter."</td>
                    <td>".$row['shopName']."</td>
                    <td>Owner:".$row['shopOwner']."<br>Email: ".$row['shopEmail']."<br>Phone: ".$row['shopPhone']."</td>
                    <td>Register: 24/06/2019<br>Deletion : 24/7/2019</td>
                    <td colspan='3' style='padding: 1px;padding-right: 0px;padding-left: 0px;padding-bottom: 1px;width: 150px;'>
                        <div class='paging'>
                            <form action='./' method='POST'>
                            <ul class='list-unstyled' style='margin-bottom: 0px;height: 20px;width: 150px;'>
                                <li class='text-center' style='width: 200px;'> 
                                    <input type='hidden' name='shopname' value='".$row['shopName']."'>
                                    <input type='submit' name='deactivate' class='btn btn-danger btn-sm text-center'  value='Deactivate'>
                                    </li>
                            </ul>
                            </form>
                        </div>
                    </td>
                </tr>"; 
                $counter++;
                }
            ?>
            </tbody>
            <tfoot>
                <tr></tr>
            </tfoot>
        </table>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>