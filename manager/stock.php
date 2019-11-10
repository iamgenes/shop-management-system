<?php 

require 'includes/header.php';
if (isset($_POST['addProd'])) {
    $prdname = data_cleaner($_POST['productName']);
    $prdqtty = data_cleaner($_POST['quantity']);
    $prdprice = data_cleaner($_POST['price']);

    $add = $dbacc->prepare("INSERT INTO `products` (`shop_id`, `product_name`, `product_quantity`, `product_price`,`prd_date_entered`) VALUES (?,?,?,?,?)");
    if($add->execute(array($shopid, $prdname, $prdqtty, $prdprice,$Tdate))){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Successful!</strong> added the product<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Failed!</strong> to add product please add it again<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>"; 
    }
}

$products = $dbacc->prepare("SELECT * FROM `products` WHERE `shop_id`=:id AND `prd_date_entered`= CURRENT_DATE() ORDER BY `prd_date_entered` DESC");
$products->execute(array(':id' => $shopid));
$prodtotal = $products->rowCount();



?>
<script type="text/javascript">
    document.title = "Stock | <?php echo $row['shopName']; ?>"
</script>
<div id="salesPoint" class="point-of-sale" style="margin-top: 20px;">
<header>
<div class="alert alert-secondary text-center" role="alert" style="margin-bottom: 0px;padding-top: 12px;"><span><strong>Add to Stock</strong><br></span></div>
</header>
<div class="row shop-row" style="margin-top: 10px;">
    <div class="col" style="padding-left: 10px;padding-right: 5px;">
        <form method="POST" action="stock.php">
            <div class="col">
                    <fieldset style="margin-bottom: 0px;">
                        <div class="form-row" style="margin-right: -5px;">
                            <div class="col-6 col-sm-6 col-md-3 text-center"><label><strong>Product Name</strong></label>
                            <div id="lp-name-wrapper">
                                <input class="form-control" type="text" name="productName" placeholder="product name" required="true">
                            </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-2 text-center"><label><strong>price &nbsp; per item</strong><br></label>
                                <div id="lp-name-wrapper">
                                    <input class="form-control" name="price" type="number" placeholder="100000" id="price" style="height: 40px;" required="true">
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-1 text-center"><label><strong>Quantity</strong></label>
                                <div id="lp-name-wrapper">
                                    <input class="form-control" name="quantity" type="number" placeholder="1" id="quantity" style="height: 40px;" required="true">
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-1 text-center">
                                <div id="lp-name-wrapper">
                                    <input type="button" class="btn" style="background-color: #af3545;color: #fff; margin-top: 30px;" value="calculate value" name="calculate price" onclick="calculate()">
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-3 col-xl-2 offset-xl-0"><label style="margin-bottom: 7px;margin-left: 74px;"><strong>product value</strong><br></label>
                                <div id="lp-name-wrapper" style="width: 152px;margin-left: 50px;">
                                    <div class="alert alert-success" role="alert" style="height: 40px;padding-top: 5px;padding-right: 0px;padding-bottom: 0px;padding-left: 20px;"><span class="prodvalue" style="font-weight: bold;">
                                        <strong>0/=</strong></span></div>
                                    <script type="text/javascript" async defer>
                                        var value = document.querySelector('.prodvalue');
                                        var qtty = document.querySelector('#quantity');
                                        var price = document.querySelector('#price');
                                        
                                        price.onchange = () =>{
                                            value.innerHTML = price.value;
                                        }    
                                        qtty.onchange = () =>{
                                            value.innerHTML = price.value*qtty.value;
                                        }
                                        function calculate(e){
                                            //e.preventDefault();
                                            value.innerHTML = price.value*qtty.value;   
                                        }
                                        const clearPrice = () =>{
                                            value.innerHTML = "0.00/="
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <button class="btn btn-danger float-left" type="reset" onclick="clearPrice()" style="margin-left: 20%;">reset</button>
                    <button class="btn btn-success float-right" name="addProd" type="submit" style="margin-right: 40%;">Add to stock</button>
                </div>
        </form>
    </div>
</div>
</div>

<div id="sales-records" class="sales">
<header>
    <div class="alert alert-secondary text-center" role="alert" style="margin-bottom: 0px;margin-top: 50px;"><span><strong>Items in stock</strong><br></span></div>
    </header>
    <div class="row shop-row" style="margin-top: 0px;">
        <div class="col" style="padding-left: 15px;padding-right: 10px;">
            <div class="datagrid">
                <table class="table">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>Product name</th>
                            <th>quantity</th>
                            <th>Price per Item</th>
                            <th>date</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                if ($prodtotal == 0) {
                        echo "<tr><td colspan='6'><center><h4>No Products were made today</h4></center></td></tr>";
                }else {     
                    $no = 1;
                    while($prods = $products->fetch(PDO::FETCH_ASSOC)){
                        echo "
                        <td>".$no."</td>
                            <td>".$prods['product_name']."</td>
                            <td>".$prods['product_quantity']."</td>
                            <td>".$prods['product_price']."</td>
                            <td>".$prods['prd_date_entered']."</td>
                        </tr>";
                        $no++;
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