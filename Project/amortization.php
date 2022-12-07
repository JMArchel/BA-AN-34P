<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>PROJECT #3 </title>
    <link rel = "icon" href ="imgs/cash-coin.svg">
</head>
<?php include("header.php"); ?>
<?php include_once('functions.php');?>
<body>
    <?php
    if(isset($_POST['amount'])){
        $_POST['amount'] = str_replace(',','',$_POST['amount']);
        echo ($_POST['amount']);
        $monthly_pay = PMT($_POST['interest'],$_POST['period'],$_POST['amount']);
        $balance = $_POST['amount'];
        $payment_date = $_POST['start_date'];
    }
    ?>
    <div class="container">
        <a href="https://github.com/JMArchel/BA-AN-34P" class="btn float">< ></a> 
        <h1 class="text-center" style="padding: 7.5rem 0 1.5rem 0;">Loan Amortization</h1>
        <div class="row">
            <div class="col-3" style="padding:1rem 0 0 0 ;">
                <div class="fillup form-container">
                    <p>Type in the necessary information.</p>
                    <form action="" method="post">
                        <div class="mb-2 row form-group">
                            <label class="col-5 col-form-label">Loan Amount</label>
                            <div class="col-6">
                                <input type="text" name="amount" class="form-control" value="<?php echo number_format(@$_POST['amount'],0);?>" required>
                            </div>
                        </div>
                        <div class="mb-2 row form-group">
                            <label class="col-5 col-form-label">Interest (%)</label>
                            <div class="col-6">
                                <input type="number" name="interest" class="form-control" value="<?php echo number_format(@$_POST['interest'],1);?>" required>
                            </div>
                        </div>
                        <div class="mb-2 row form-group">
                            <label class="col-5 col-form-label">Period (Years)</label>
                            <div class="col-6">
                                <input type="number" name="period" class="form-control" value="<?php echo number_format(@$_POST['period'],1);?>" required>
                            </div>
                        </div>
                        <div class="mb-2 row form-group">
                            <label class="col-5 col-form-label">Start Date</label>
                            <div class="col-6">
                                <input type="date" name="start_date" class="form-control" value="<?php echo @$_POST['start_date'];?>" required>
                            </div>
                        </div>
                        <div>
                            <?php echo "&nbsp&nbsp&nbsp" ?>
                        </div>
                        <div class="mb-2 form-group col-6">
                            <input type="submit" class="form-control btn press" value="Calculate">
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow p-1 mb-5 rounded col-9" style="padding: 0 0 0 0; height: 35rem; 
            <?php if ($_SERVER["REQUEST_METHOD"]=="POST"){ echo "background-color:white; overflow-y: scroll;"; }?>">
                <table class="table table-hover">
                    <thead class="tablehead">
                        <tr style="background-color:#078080;">
                            <th class="text-center">#</th>
                            <th>Payment Date</th>
                            <th>Monthly Pay</th>
                            <th>Interest</th>
                            <th>Principal</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $total = 0;
                        $total_interest = 0;
                        if ($_SERVER["REQUEST_METHOD"]=="POST"){
                            //loop of total payment period
                            for($i=1;$i<=$_POST['period']*12;$i++){?>
                        <?php
                            $interest = (($_POST['interest']/100)*$balance)/12;
                            $principal = $monthly_pay - $interest;
                            $balance = $balance - $principal;
                            $payment_date = date('Y-m-d',strtotime("+1 month",strtotime($payment_date)));
                    ?>
                        <tr>
                            <td class="text-center table-light"><?php echo $i;?></td>
                            <td class="table-light"><?php showDate($payment_date);?></td>
                            <td class="table-light"><?php showValue($monthly_pay);?></td>
                            <td class="table-light"><?php showValue($interest);?></td>
                            <td class="table-light"><?php showValue($principal);?></td>
                            <td class="table-light"><?php showValue($balance);?></td>
                        </tr>
                    <?php
                        //total for each of the following:
                        $total += $monthly_pay;
                        $total_interest += $interest;
                        $principal_t = $total - $total_interest;
                    }} ?>
                    </tbody>
                    <thead class="tablehead">
                    <?php if ($_SERVER["REQUEST_METHOD"]=="POST"){?>
                        <tr>
                            <th class="table-light"></th>
                            <th class="table-light"><b>Total<b></th>
                            <th class="table-light"><?php showValue($total);?></th>
                            <th class="table-light"><?php showValue($total_interest);?></th>
                            <th colspan="2" class="table-light"> <?php showvalue ($principal_t); ?></th>
                        </tr>
                    <?php }?>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>