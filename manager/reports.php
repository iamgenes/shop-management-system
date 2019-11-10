<?php
require 'includes/header.php';

/*

ALL THE QUERIES ARE SEPARATED DEPENDING ON THE DAY WEEK MONTH OR YEAR

*/

/*[DAILY REPORTS QUERIES]*/
//sales
$salesD = $dbacc->prepare("SELECT * FROM `shop_sales` WHERE `shop_id`=:id AND `sale_date` = CURRENT_DATE() AND YEAR(sale_date) = YEAR(CURRENT_DATE()) ORDER BY `sale_date` ASC");
$salesD->execute(array(':id' => $shopid));
$salesTotalD = $salesD->rowCount();
//sum obtined obtained
$incD = $dbacc->prepare("SELECT SUM(sale_final_price) FROM `shop_sales` WHERE `shop_id`=:id AND `sale_date` = CURRENT_DATE() AND YEAR(sale_date) = YEAR(CURRENT_DATE())");
$incD->execute(array(':id' => $shopid));
$incomeD = $incD->fetch(PDO::FETCH_ASSOC);
//expenses
$expensesD = $dbacc->prepare("SELECT * FROM `shop_expenses` WHERE `shop_id`=:id AND `expense_date` = CURRENT_DATE() AND YEAR(expense_date) = YEAR(CURRENT_DATE()) ORDER BY `expense_date` ASC");
$expensesD->execute(array(':id' => $shopid));
$exptotalD = $expensesD->rowCount();
//products
$productsD = $dbacc->prepare("SELECT * FROM `products` WHERE `shop_id`=:id AND `prd_date_entered` = CURRENT_DATE() AND YEAR(prd_date_entered) = YEAR(CURRENT_DATE()) ORDER BY `prd_date_entered` ASC");
$productsD->execute(array(':id' => $shopid));
$prodtotalD = $productsD->rowCount();
// end of DAILY reports.




/*[WEEKLY REPORTS QUERIES]*/
$salesW = $dbacc->prepare("SELECT * FROM `shop_sales` WHERE `shop_id`=:id AND WEEK(sale_date) = WEEK(CURRENT_DATE()) AND YEAR(sale_date) = YEAR(CURRENT_DATE()) ORDER BY `sale_date` ASC");
$salesW->execute(array(':id' => $shopid));
$salesTotalW = $salesW->rowCount();
//sum obtined obtained
$incW = $dbacc->prepare("SELECT SUM(sale_final_price) FROM `shop_sales` WHERE `shop_id`=:id AND WEEK(sale_date) = WEEK(CURRENT_DATE()) AND YEAR(sale_date) = YEAR(CURRENT_DATE())");
$incW->execute(array(':id' => $shopid));
$incomeW = $incW->fetch(PDO::FETCH_ASSOC);
//expenses
$expensesW = $dbacc->prepare("SELECT * FROM `shop_expenses` WHERE `shop_id`=:id AND WEEK(expense_date) = WEEK(CURRENT_DATE()) AND YEAR(expense_date) = YEAR(CURRENT_DATE()) ORDER BY `expense_date` ASC");
$expensesW->execute(array(':id' => $shopid));
$exptotalW = $expensesW->rowCount();
//products
$productsW = $dbacc->prepare("SELECT * FROM `products` WHERE `shop_id`=:id AND WEEK(prd_date_entered) = WEEK(CURRENT_DATE()) AND YEAR(prd_date_entered) = YEAR(CURRENT_DATE()) ORDER BY `prd_date_entered` ASC");
$productsW->execute(array(':id' => $shopid));
$prodtotalW = $productsW->rowCount();
// end of WEEKLY reports.




/*[MONTHLY REPORTS QUERIES]*/
$salesM = $dbacc->prepare("SELECT * FROM `shop_sales` WHERE `shop_id`=:id AND MONTH(sale_date) = MONTH(CURRENT_DATE()) AND YEAR(sale_date) = YEAR(CURRENT_DATE()) ORDER BY `sale_date` ASC");
$salesM->execute(array(':id' => $shopid));
$salesTotalM = $salesM->rowCount();
//sum obtined obtained
$incM = $dbacc->prepare("SELECT SUM(sale_final_price) FROM `shop_sales` WHERE `shop_id`=:id AND MONTH(sale_date) = MONTH(CURRENT_DATE()) AND YEAR(sale_date) = YEAR(CURRENT_DATE())");
$incM->execute(array(':id' => $shopid));
$incomeM = $incM->fetch(PDO::FETCH_ASSOC);
//expenses
$expensesM = $dbacc->prepare("SELECT * FROM `shop_expenses` WHERE `shop_id`=:id AND MONTH(expense_date) = MONTH(CURRENT_DATE()) AND YEAR(expense_date) = YEAR(CURRENT_DATE()) ORDER BY `expense_date` ASC");
$expensesM->execute(array(':id' => $shopid));
$exptotalM = $expensesM->rowCount();
//products
$productsM = $dbacc->prepare("SELECT * FROM `products` WHERE `shop_id`=:id AND MONTH(prd_date_entered) = MONTH(CURRENT_DATE()) AND YEAR(prd_date_entered) = YEAR(CURRENT_DATE()) ORDER BY `prd_date_entered` ASC");
$productsM->execute(array(':id' => $shopid));
$prodtotalM = $productsM->rowCount();
// end of MONTHLY reports.




/*[YEARLY REPORTS QUERIES]*/

$salesY = $dbacc->prepare("SELECT * FROM `shop_sales` WHERE `shop_id`=:id AND YEAR(sale_date) = YEAR(CURRENT_DATE()) ORDER BY `sale_date` ASC");
$salesY->execute(array(':id' => $shopid));
$salesTotalY = $salesY->rowCount();
//sum obtined obtained
$incY = $dbacc->prepare("SELECT SUM(sale_final_price) FROM `shop_sales` WHERE `shop_id`=:id AND YEAR(sale_date) = YEAR(CURRENT_DATE())");
$incY->execute(array(':id' => $shopid));
$incomeY = $incY->fetch(PDO::FETCH_ASSOC);
//expenses
$expensesY = $dbacc->prepare("SELECT * FROM `shop_expenses` WHERE `shop_id`=:id AND YEAR(expense_date) = YEAR(CURRENT_DATE()) ORDER BY `expense_date` ASC");
$expensesY->execute(array(':id' => $shopid));
$exptotalY = $expensesY->rowCount();
//products
$productsY = $dbacc->prepare("SELECT * FROM `products` WHERE `shop_id`=:id AND YEAR(prd_date_entered) = YEAR(CURRENT_DATE()) ORDER BY `prd_date_entered` ASC");
$productsY->execute(array(':id' => $shopid));
$prodtotalY = $productsY->rowCount();
// end of YEARLY reports.

/*

END OF DATABASE QUERIES
*/
?>
<script type="text/javascript">
    document.title = "Reports | <?php echo $row['shopName']; ?>"
</script>
<!-- Start: sums -->
<div id="sums">
    <ul class="nav nav-tabs nav-justified text-capitalize border rounded border-success shadow-sm">
        <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#dailyRep">Daily</a></li>
        <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#weeklyRep">Weekly</a></li>
        <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#monthlyRep">Monthly</a></li>
        <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#yearlyRep">Yearly</a></li>
    </ul>
    <div class="tab-content">
        <!-- [START DAILY] -->
        <div class="tab-pane active" role="tabpanel" id="dailyRep">
            <!-- Start: Box-panels -->
            <div class="row report-panel">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $salesTotalD; ?></div>
                                    <div><h5>Total Sales</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $exptotalD; ?></div>
                                    <div><h5>Total Expenses</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-database fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $prodtotalD; ?></div>
                                    <div><h5>Total Products</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php if ($salesTotalD == 0) {
                                        echo '0';
                                    }else{
                                        echo $incomeD['SUM(sale_final_price)']; }?></div>
                                    <div><h5>Total income</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End: Box-panels -->
            <header style="margin-top:30px; padding-top:10px;">
                <div class="alert alert-secondary text-center" role="alert" style="margin-bottom: 0px;margin-top: 50px;"><span><strong>Reports</strong><br></span></div>
            </header>
            <!-- Start: Details tables -->
            <div id="tables">
                <ul class="nav nav-tabs nav-justified text-capitalize border rounded border-success shadow-sm">
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#salesRepD">Sales</a></li>
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#expensesRepD">expenses</a></li>
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#productsRepD">products</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="salesRepD">
                        <!-- Start: Pretty Table -->
                        <div class="datagrid">
                            <!-- sales -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($salesTotalD == 0) {
                                        echo "<tr><td colspan='6'><center><h4>No sales were made today</h4></center></td></tr>";
                                    }else{
                                         $saleNoD = 1;
                                         while ($saleD = $salesD->fetch(PDO::FETCH_ASSOC)){
                                         ?>
                                        <tr>
                                            <td><?php echo $saleNoD; ?></td>
                                            <td>   
                                        <?php 
                                        //getting the prodcut name from the products table using the shop id and product id obtained
                                        $prodD = $dbacc->prepare("SELECT `product_name` FROM `products` WHERE `shop_id` = ? AND `product_id` = ?");
                                        $prodD->execute(array($shopid, $saleD['product_id']));
                                        $rowD = $prodD->fetch(PDO::FETCH_ASSOC);
                                        echo $rowD['product_name'];
                                         
                                         ?>
                                            </td>
                                            <td><?php echo $saleD['prd_quantity_sold']; ?></td>
                                            <td><?php echo $saleD['sale_final_price']; ?></td>
                                            <td><?php echo $saleD['sale_discount']; ?></td>
                                            <td><?php echo $saleD['sale_date']; ?></td>
                                        </tr>
                                        <?php 
                                            $saleNoD++;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                    <div class="tab-pane" role="tabpanel" id="expensesRepD">
                        <!-- Start: Pretty Table -->
                        <!-- expenses -->
                        <div class="datagrid">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Expense title</th>
                                        <th>expense Details</th>
                                        <th>Amount used</th>
                                        <th>date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($exptotalD == 0) {
                                        echo "<tr><td colspan='6'><center><h4>No expenses were made today</h4></center></td></tr>";
                                    }else{ 
                                        $noD = 1;
                                        while ($expsD = $expensesD->fetch(PDO::FETCH_ASSOC)) {   
                                               echo" <tr>
                                                    <td>".$noD."</td>
                                                    <td>".$expsD['expense_name']."</td>
                                                    <td>".$expsD['expense_details']."</td>
                                                    <td>".$expsD['expense_amount']."</td>
                                                    <td>".$expsD['expense_date']."</td>
                                                </tr>";
                                                $noD++;
                                            }
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                    <div class="tab-pane" role="tabpanel" id="productsRepD">
                        <!-- Start: Pretty Table -->
                        <div class="datagrid">
                            <!-- products -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Product name</th>
                                        <th>quantity</th>
                                        <th>value</th>
                                        <th>date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($prodtotalD == 0) {
                                    echo "<tr><td colspan='6'><center><h4>No products were added today</h4></center></td></tr>";
                                }else{ 
                                    $noD = 1;
                                    while($prodsD = $productsD->fetch(PDO::FETCH_ASSOC)){
                                        echo "<td>".$noD."</td>
                                            <td>".$prodsD['product_name']."</td>
                                            <td>".$prodsD['product_quantity']."</td>
                                            <td>".$prodsD['product_price']."</td>
                                            <td>".$prodsD['prd_date_entered']."</td>
                                        </tr>";
                                        $noD++;
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr></tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                </div>
            </div>
            <!-- End: Details tables -->
        </div>
        <!-- [END DAILY] -->
        <!-- [START WEEKLY] -->
        <div class="tab-pane" role="tabpanel" id="weeklyRep">
            <!-- Start: Box-panels -->
            <div class="row report-panel">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $salesTotalW; ?></div>
                                    <div><h5>Total Sales</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $exptotalW; ?></div>
                                    <div><h5>Total Expenses</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-database fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $prodtotalW; ?></div>
                                    <div><h5>Total Products</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $incomeW['SUM(sale_final_price)'] ?></div>
                                    <div><h5>Total income</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End: Box-panels -->
            <header style="margin-top:30px; padding-top:10px;">
                <div class="alert alert-secondary text-center" role="alert" style="margin-bottom: 0px;margin-top: 50px;"><span><strong>Reports</strong><br></span></div>
            </header>
            
            <!-- Start: Details tables -->
            <div id="tables">
                <ul class="nav nav-tabs nav-justified text-capitalize border rounded border-success shadow-sm">
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#salesRepW">Sales</a></li>
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#expensesRepW">expenses</a></li>
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#productsRepW">products</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="salesRepW">
                        <!-- Start: Pretty Table -->
                        <div class="datagrid">
                            <!-- sales -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($salesTotalW == 0) {
                                        echo "<tr><td colspan='6'><center><h4>No sales were made This Week</h4></center></td></tr>";
                                    }else{
                                         $saleNoW = 1;
                                         while ($saleW = $salesW->fetch(PDO::FETCH_ASSOC)){
                                         ?>
                                        <tr>
                                            <td><?php echo $saleNoW; ?></td>
                                            <td>   
                                        <?php 
                                        //getting the prodcut name from the products table using the shop id and product id obtained
                                        $prodW = $dbacc->prepare("SELECT `product_name` FROM `products` WHERE `shop_id` = ? AND `product_id` = ?");
                                        $prodW->execute(array($shopid, $saleW['product_id']));
                                        $rowW = $prodW->fetch(PDO::FETCH_ASSOC);
                                        echo $rowW['product_name'];
                                         
                                         ?>
                                            </td>
                                            <td><?php echo $saleW['prd_quantity_sold']; ?></td>
                                            <td><?php echo $saleW['sale_final_price']; ?></td>
                                            <td><?php echo $saleW['sale_discount']; ?></td>
                                            <td><?php echo $saleW['sale_date']; ?></td>
                                        </tr>
                                        <?php 
                                            $saleNoW++;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                    <div class="tab-pane" role="tabpanel" id="expensesRepW">
                        <!-- Start: Pretty Table -->
                        <!-- expenses -->
                        <div class="datagrid">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Expense title</th>
                                        <th>expense Details</th>
                                        <th>Amount used</th>
                                        <th>date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($exptotalW == 0) {
                                        echo "<tr><td colspan='6'><center><h4>No expenses were made This Week</h4></center></td></tr>";
                                    }else{ 
                                        $noW = 1;
                                        while ($expsW = $expensesW->fetch(PDO::FETCH_ASSOC)) {   
                                               echo" <tr>
                                                    <td>".$noW."</td>
                                                    <td>".$expsW['expense_name']."</td>
                                                    <td>".$expsW['expense_details']."</td>
                                                    <td>".$expsW['expense_amount']."</td>
                                                    <td>".$expsW['expense_date']."</td>
                                                </tr>";
                                                $noW++;
                                            }
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                    <div class="tab-pane" role="tabpanel" id="productsRepW">
                        <!-- Start: Pretty Table -->
                        <div class="datagrid">
                            <!-- products -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Product name</th>
                                        <th>quantity</th>
                                        <th>value</th>
                                        <th>date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($prodtotalW == 0) {
                                    echo "<tr><td colspan='6'><center><h4>No products were added This Week</h4></center></td></tr>";
                                }else{ 
                                    $noW = 1;
                                    while($prodsW = $productsW->fetch(PDO::FETCH_ASSOC)){
                                        echo "<td>".$noW."</td>
                                            <td>".$prodsW['product_name']."</td>
                                            <td>".$prodsW['product_quantity']."</td>
                                            <td>".$prodsW['product_price']."</td>
                                            <td>".$prodsW['prd_date_entered']."</td>
                                        </tr>";
                                        $noW++;
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr></tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                </div>
            </div>
            <!-- End: Details tables -->
        </div>
        <!-- [END WEEKLY] -->
        <!-- [START MONTHLY] -->
        <div class="tab-pane" role="tabpanel" id="monthlyRep">
            <!-- Start: Box-panels -->
            <div class="row report-panel">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $salesTotalM; ?></div>
                                    <div><h5>Total Sales</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $exptotalM; ?></div>
                                    <div><h5>Total Expenses</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-database fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $prodtotalM; ?></div>
                                    <div><h5>Total Products</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $incomeM['SUM(sale_final_price)'] ?></div>
                                    <div><h5>Total income</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End: Box-panels -->
            <header style="margin-top:30px; padding-top:10px;">
                <div class="alert alert-secondary text-center" role="alert" style="margin-bottom: 0px;margin-top: 50px;"><span><strong>Reports</strong><br></span></div>
            </header>
            <!-- Start: Details tables -->
            <div id="tables">
                <ul class="nav nav-tabs nav-justified text-capitalize border rounded border-success shadow-sm">
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#salesRepM">Sales</a></li>
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#expensesRepM">expenses</a></li>
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#productsRepM">products</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="salesRepM">
                        <!-- Start: Pretty Table -->
                        <div class="datagrid">
                            <!-- sales -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($salesTotalM == 0) {
                                        echo "<tr><td colspan='6'><center><h4>No sales were made This Month</h4></center></td></tr>";
                                    }else{
                                         $saleNoM = 1;
                                         while ($saleM = $salesM->fetch(PDO::FETCH_ASSOC)){
                                         ?>
                                        <tr>
                                            <td><?php echo $saleNoM; ?></td>
                                            <td>   
                                        <?php 
                                        //getting the prodcut name from the products table using the shop id and product id obtained
                                        $prodM = $dbacc->prepare("SELECT `product_name` FROM `products` WHERE `shop_id` = ? AND `product_id` = ?");
                                        $prodM->execute(array($shopid, $saleM['product_id']));
                                        $rowM = $prodM->fetch(PDO::FETCH_ASSOC);
                                        echo $rowM['product_name'];
                                         
                                         ?>
                                            </td>
                                            <td><?php echo $saleM['prd_quantity_sold']; ?></td>
                                            <td><?php echo $saleM['sale_final_price']; ?></td>
                                            <td><?php echo $saleM['sale_discount']; ?></td>
                                            <td><?php echo $saleM['sale_date']; ?></td>
                                        </tr>
                                        <?php 
                                            $saleNoM++;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                    <div class="tab-pane" role="tabpanel" id="expensesRepM">
                        <!-- Start: Pretty Table -->
                        <!-- expenses -->
                        <div class="datagrid">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Expense title</th>
                                        <th>expense Details</th>
                                        <th>Amount used</th>
                                        <th>date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($exptotalM == 0) {
                                        echo "<tr><td colspan='6'><center><h4>No expenses were This Month</h4></center></td></tr>";
                                    }else{ 
                                        $noM = 1;
                                        while ($expsM = $expensesM->fetch(PDO::FETCH_ASSOC)) {   
                                               echo" <tr>
                                                    <td>".$noD."</td>
                                                    <td>".$expsM['expense_name']."</td>
                                                    <td>".$expsM['expense_details']."</td>
                                                    <td>".$expsM['expense_amount']."</td>
                                                    <td>".$expsM['expense_date']."</td>
                                                </tr>";
                                                $noM++;
                                            }
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                    <div class="tab-pane" role="tabpanel" id="productsRepM">
                        <!-- Start: Pretty Table -->
                        <div class="datagrid">
                            <!-- products -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Product name</th>
                                        <th>quantity</th>
                                        <th>value</th>
                                        <th>date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($prodtotalM == 0) {
                                    echo "<tr><td colspan='6'><center><h4>No products were added This Month</h4></center></td></tr>";
                                }else{ 
                                    $noM = 1;
                                    while($prodsM = $productsM->fetch(PDO::FETCH_ASSOC)){
                                        echo "<td>".$noM."</td>
                                            <td>".$prodsM['product_name']."</td>
                                            <td>".$prodsM['product_quantity']."</td>
                                            <td>".$prodsM['product_price']."</td>
                                            <td>".$prodsM['prd_date_entered']."</td>
                                        </tr>";
                                        $noM++;
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr></tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                </div>
            </div>
            <!-- end details table -->
        </div>
        <!-- [END MONTHLY] -->
        <!-- [START YEARLY] -->
        <div class="tab-pane" role="tabpanel" id="yearlyRep">
            <!-- Start: Box-panels -->
            <div class="row report-panel">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $salesTotalY; ?></div>
                                    <div><h5>Total Sales</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $exptotalY; ?></div>
                                    <div><h5>Total Expenses</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-database fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $prodtotalY; ?></div>
                                    <div><h5>Total Products</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $incomeY['SUM(sale_final_price)'] ?></div>
                                    <div><h5>Total income</h5></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End: Box-panels -->
            <header style="margin-top:30px; padding-top:10px;">
                <div class="alert alert-secondary text-center" role="alert" style="margin-bottom: 0px;margin-top: 50px;"><span><strong>Reports</strong><br></span></div>
            </header>
            <!-- Start: Details tables -->
            <div id="tables">
                <ul class="nav nav-tabs nav-justified text-capitalize border rounded border-success shadow-sm">
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#salesRepY">Sales</a></li>
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#expensesRepY">expenses</a></li>
                    <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#productsRepY">products</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="salesRepY">
                        <!-- Start: Pretty Table -->
                        <div class="datagrid">
                            <!-- sales -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($salesTotalY == 0) {
                                        echo "<tr><td colspan='6'><center><h4>No sales were made This year</h4></center></td></tr>";
                                    }else{
                                         $saleNoY = 1;
                                         while ($saleY = $salesY->fetch(PDO::FETCH_ASSOC)){
                                         ?>
                                        <tr>
                                            <td><?php echo $saleNoY; ?></td>
                                            <td>   
                                        <?php 
                                        //getting the prodcut name from the products table using the shop id and product id obtained
                                        $prodY = $dbacc->prepare("SELECT `product_name` FROM `products` WHERE `shop_id` = ? AND `product_id` = ?");
                                        $prodY->execute(array($shopid, $saleY['product_id']));
                                        $rowY = $prodY->fetch(PDO::FETCH_ASSOC);
                                        echo $rowY['product_name'];
                                         
                                         ?>
                                            </td>
                                            <td><?php echo $saleY['prd_quantity_sold']; ?></td>
                                            <td><?php echo $saleY['sale_final_price']; ?></td>
                                            <td><?php echo $saleY['sale_discount']; ?></td>
                                            <td><?php echo $saleY['sale_date']; ?></td>
                                        </tr>
                                        <?php 
                                            $saleNoY++;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                    <div class="tab-pane" role="tabpanel" id="expensesRepY">
                        <!-- Start: Pretty Table -->
                        <!-- expenses -->
                        <div class="datagrid">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Expense title</th>
                                        <th>expense Details</th>
                                        <th>Amount used</th>
                                        <th>date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($exptotalY == 0) {
                                        echo "<tr><td colspan='6'><center><h4>No expenses were made This year</h4></center></td></tr>";
                                    }else{ 
                                        $noY = 1;
                                        while ($expsY = $expensesY->fetch(PDO::FETCH_ASSOC)) {   
                                               echo" <tr>
                                                    <td>".$noY."</td>
                                                    <td>".$expsY['expense_name']."</td>
                                                    <td>".$expsY['expense_details']."</td>
                                                    <td>".$expsY['expense_amount']."</td>
                                                    <td>".$expsY['expense_date']."</td>
                                                </tr>";
                                                $noY++;
                                            }
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End: Pretty Table -->
                    </div>
                    <div class="tab-pane" role="tabpanel" id="productsRepY">
                        <!-- Start: Pretty Table -->
                        <div class="datagrid">
                            <!-- products -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Product name</th>
                                        <th>quantity</th>
                                        <th>value</th>
                                        <th>date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($prodtotalY == 0) {
                                    echo "<tr><td colspan='6'><center><h4>No products were added This year</h4></center></td></tr>";
                                }else{ 
                                    $noY = 1;
                                    while($prodsY = $productsY->fetch(PDO::FETCH_ASSOC)){
                                        echo "<td>".$noY."</td>
                                            <td>".$prodsY['product_name']."</td>
                                            <td>".$prodsY['product_quantity']."</td>
                                            <td>".$prodsY['product_price']."</td>
                                            <td>".$prodsY['prd_date_entered']."</td>
                                        </tr>";
                                        $noY++;
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr></tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- End: Pretty Table -->
        </div>
        <!-- [END YEARLY] -->
    </div>
</div>
<!-- End: sums -->
<script src="../assets/js/jquery.min.js?h=1dd785e1de9a32e236b624ae268bb803"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js?h=63715b63ee49d5fe4844c2ecae071373"></script>
<script src="../assets/js/script.min.js?h=45fa2fcdf0745d6e1750b946e9789ba5"></script>
</body>

</html>