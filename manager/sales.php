<?php 
require 'includes/header.php';
if (isset($_POST['addSell'])) {
    $prd = data_cleaner($_POST['productName']);
    $qtty = data_cleaner($_POST['prdQtty']);
    $discount = round(data_cleaner($_POST['prdDis']));
    //calculations
    $prc = $dbacc->prepare("SELECT `product_price`,`product_id` FROM `products` WHERE `shop_id`=:id AND `product_name`=:name");
    $prc->execute(array(':id' => $shopid, ':name' => $prd));
    $pri = $prc->fetch(PDO::FETCH_ASSOC);
    $price = ($pri['product_price'] * $qtty)-$discount;
    $prdID = $pri['product_id'];
    // //end of calculations
    $addsale = $dbacc->prepare("INSERT INTO `shop_sales` (`shop_id`, `product_id`, `prd_quantity_sold`, `sale_discount`, `sale_final_price`, `sale_date`) VALUES (?, ?, ?, ?, ?, ?)");
    if($addsale->execute(array($shopid, $prdID, $qtty, $discount, $price, $Tdate))){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Successful!</strong> sold.!<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failed!</strong> Please reset the form and enter the values again<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>"; 
    }
}
$sales = $dbacc->prepare("SELECT * FROM `shop_sales` WHERE `shop_id`=:id AND `sale_date`= CURRENT_DATE() ORDER BY `sale_date` DESC");
$sales->execute(array(':id' => $shopid));
$prices = array();
?>
<script type="text/javascript">
    document.title = "Sales | <?php echo $row['shopName']; ?>"
</script>
<div id="salesPoint" class="point-of-sale" style="margin-top: 20px;">
    <header>
        <div class="alert alert-secondary text-center" role="alert" style="margin-bottom: 0px;padding-top: 12px;"><span><strong>POINT OF SALE</strong><br></span></div>
    </header>
    <div class="row shop-row" style="margin-top: 10px;">
        <div class="col" style="padding-left: 10px;padding-right: 5px;">
            <form method="POST" action="sales.php">
                <div class="col">
                        <fieldset style="margin-bottom: 0px;">
                            <div class="form-row" style="margin-right: -5px;">
                                <div class="col-6 col-sm-6 col-md-3 text-center"><label><strong>Product</strong></label>
                                    <div id="lp-name-wrapper">
                                    <!--[product name section]-->
                                       <select class="form-control" id="prodName" name="productName" style="height: 40px;">
                                            <!-- <optgroup label="Product"> -->
                                                <?php 
                                                $prdopt = $dbacc->prepare("SELECT * FROM `products` WHERE `shop_id`=:id ORDER BY `product_name` ASC");
                                                $prdopt->execute(array(':id' => $shopid));
                                                while ($options = $prdopt->fetch(PDO::FETCH_ASSOC)) {
                                                echo "<option value='".$options['product_name']."'>".$options['product_name']."</option>";
                                                // adding data to the array for each of the products price
                                                $prices[$options['product_name']] = $options['product_price'];
                                                }
                                                ?>
                                            <!-- </optgroup> -->
                                       </select>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-1 text-center">
                                    <label><strong>Quantity</strong></label>
                                    <div id="lp-name-wrapper">
                                        <!-- [Product quantity section] -->
                                        <input class="form-control" type="number" value="1" id="prodQtty" name="prdQtty" style="height: 40px;">
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-2 text-center">
                                    <label class="text-center"><strong>discount</strong></label>
                                    <div id="lp-name-wrapper">
                                        <!-- [Prduct discount section] -->
                                        <input class="form-control" name="prdDis" type="number" value="0" id="prdDis" style="height: 40px;">
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-1 text-center">
                                <div id="lp-name-wrapper">
                                    <input type="button" class="btn" style="background-color: #af3545;color: #fff; margin-top: 30px;" value="calculate value" name="calculate price" onclick="calculates()">
                                </div>
                            </div>
                                <div class="col-6 col-sm-6 col-md-3 col-xl-2 offset-xl-0">
                                    <label style="margin-bottom: 7px;margin-left: 74px;"><strong>Price</strong></label>
                                    <div id="lp-name-wrapper" style="width: 152px;margin-left: 50px;">
                                        <div class="alert alert-success" role="alert"  style="height: 40px;padding-top: 5px;padding-right: 0px;padding-bottom: 0px;padding-left: 20px;"><span id="final"><strong> 0 </strong></span></div>
                                    </div>
                                </div>
                                 <script type="text/javascript">
                                    var product = document.querySelector('#prodName');
                                    var qtty = document.querySelector('#prodQtty');
                                    var dis = document.querySelector('#prdDis');
                                    var here = document.querySelector('#final');
                                    var prprice = <?php echo json_encode($prices); ?>;
                                    
                                    here.innerHTML = "<b>" + prprice[product.value] + " /=</b>";
                                    //on selection of the product
                                    product.onchange = () => {
                                        here.innerHTML = "<b>" + prprice[product.value] + " /=</b>";
                                    }
                                    qtty.onchange = () => {
                                        here.innerHTML = "<b>" + prprice[product.value]*qtty.value + " /=</b>";
                                    }
                                    dis.onchange = () => {
                                        var dat = dis.value;
                                        var pric = (prprice[product.value]*qtty.value)-dat;
                                        here.innerHTML = "<b>" + pric + " /=</b>";
                                    }
                                    function calculates(e){
                                        //e.preventDefault();
                                        if (dis.value !== 0) {
                                            var disc = dis.value;
                                            var price = (prprice[product.value]*qtty.value)-disc;
                                            here.innerHTML = "<b>" + price + " /=</b>";

                                        }else{
                                            here.innerHTML = "<b>" + prprice[product.value]*qtty.value + " /=</b>";
                                        }
                                    }
                                    var clearvalu = () => {
                                        here.innerHTML = "<b>0.00/=</b>";
                                    }
                                </script>
                            </div>
                        </fieldset><button onclick="clearvalu()" class="btn btn-danger float-left" type="reset" style="margin-left: 20%;">Reset</button>
                        <input class="btn btn-success float-right" name="addSell" type="submit" value="Sell" style="margin-right: 30%;">
                </div>
            </form>
        </div>
    </div>
</div>
<div id="sales-records" class="sales">
    <header>
        <div class="alert alert-secondary text-center" role="alert" style="margin-bottom: 0px;margin-top: 50px;"><span><strong>Today's Sales</strong><br></span></div>
    </header>
    <div class="row shop-row" style="margin-top: 0px;">
        <div class="col" style="padding-left: 25px;padding-right: 10px;">
            <div class="datagrid">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    if ($sales->rowCount() == 0) {
                        echo "<tr><td colspan='6'><center><h4>No sales were made today</h4></center></td></tr>";
                    }else {
                        $saleNo = 1;
                        while ($sale = $sales->fetch(PDO::FETCH_ASSOC)){
                ?>
                        <tr>
                            <td><?php echo $saleNo; ?></td>
                            <td>   
                <?php 
                    //getting the prodcut name from the products table using the shop id and product id obtained
                    $prod = $dbacc->prepare("SELECT `product_name` FROM `products` WHERE `shop_id` = ? AND `product_id` = ?");
                    $prod->execute(array($shopid, $sale['product_id']));
                    $row = $prod->fetch(PDO::FETCH_ASSOC);
                    echo $row['product_name']; 
                     ?>
                        </td>
                        <td><?php echo $sale['prd_quantity_sold']; ?></td>
                        <td><?php echo $sale['sale_final_price']; ?></td>
                        <td><?php echo $sale['sale_discount']; ?></td>
                        <td><?php echo $sale['sale_date']; ?></td>
                    </tr>
                <?php 
                    $saleNo++;
                        }
                    }
                ?>
                    </tbody>
                    <tfoot>
                        <tr></tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/jquery.min.js?h=1dd785e1de9a32e236b624ae268bb803"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js?h=63715b63ee49d5fe4844c2ecae071373"></script>
<script src="../assets/js/script.min.js?h=45fa2fcdf0745d6e1750b946e9789ba5"></script>
</body>
</html>