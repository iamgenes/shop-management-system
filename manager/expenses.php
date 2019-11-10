<?php 

require 'includes/header.php';
if (isset($_POST['addExpense'])) {
    $expname = data_cleaner($_POST['expense_name']);
    $expdetails = data_cleaner($_POST['expense_details']);
    $expamnt = data_cleaner($_POST['amount_used']);
    $add = $dbacc->prepare("INSERT INTO `shop_expenses` (`shop_id`, `expense_name`, `expense_details`, `expense_amount`,`expense_date`) VALUES (?,?,?,?,?)");
    if($add->execute(array($shopid, $expname, $expdetails, $expamnt,$Tdate))){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Successful!</strong> Added the expense<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Failed!</strong> To add the expense please try again!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>"; 
    }
}

$expenses = $dbacc->prepare("SELECT * FROM `shop_expenses` WHERE `shop_id`=:id AND `expense_date` = CURRENT_DATE() ORDER BY `expense_date` DESC");
$expenses->execute(array(':id' => $shopid));
$exptotal = $expenses->rowCount();




?>
<script type="text/javascript">
    document.title = "Expenses | <?php echo $row['shopName']; ?>"
</script>
<div id="salesPoint" class="point-of-sale" style="margin-top: 20px;">
    <header>
        <div class="alert alert-secondary text-center" role="alert" style="margin-bottom: 0px;padding-top: 12px;"><span><strong>Shop expenses</strong><br></span></div>
    </header>
    <div class="row shop-row" style="margin-top: 10px;margin-right: 0px;margin-left: 0px;">
        <div class="col" style="padding-left: 10px;padding-right: 5px;">
            <form action="expenses.php" method="POST">
                <div class="col">
                        <fieldset style="margin-bottom: 0px;">
                            <div class="form-row" style="margin-right: -5px;">
                                <div class="col-6 col-sm-6 col-md-3 text-center"><label><strong>Expense name</strong></label>
                                    <div id="lp-name-wrapper">
                                        <input class="form-control" type="text" name="expense_name" placeholder="Painted the roof" required="true"></div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-2 text-center"><label><strong>Details</strong><br></label>
                                    <div id="lp-name-wrapper">
                                        <textarea class="form-control" name="expense_details" placeholder="Painted the roof with blue color and paid the painter" required="true"></textarea></div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-2 text-center"><label class="text-center"><strong>amount used</strong></label>
                                    <div id="lp-name-wrapper">
                                        <input class="form-control" name="amount_used" type="text" placeholder="100" id="lp-name" style="height: 40px;" required="true"></div>
                                </div>
                            </div>
                        </fieldset><button class="btn btn-danger float-left" type="reset" style="margin-left: 100px;">reset</button><button class="btn btn-success float-right" type="submit" name="addExpense" style="margin-right: 50%;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="sales-records" class="sales">
    <header>
        <div class="alert alert-secondary text-center" role="alert" style="margin-bottom: 0px;margin-top: 50px;"><span><strong>Today's expenses</strong><br></span></div>
    </header>
    <div class="row shop-row" style="margin-top: 0px;">
        <div class="col" style="padding-left: 10px;padding-right: 15px;">
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
                if ($exptotal == 0) {
                    echo "<tr><td colspan='6'><center><h4>No expenses were made today</h4></center></td></tr>";
                }else{ 
                    $no = 1;
                    while ($exps = $expenses->fetch(PDO::FETCH_ASSOC)) {   
                       echo" <tr>
                            <td>".$no."</td>
                            <td>".$exps['expense_name']."</td>
                            <td>".$exps['expense_details']."</td>
                            <td>".$exps['expense_amount']."</td>
                            <td>".$exps['expense_date']."</td>
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