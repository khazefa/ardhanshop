<?php
error_reporting(0);
$isLoggedIn = $_SESSION['isLoggedin'];

if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
    header('HTTP/1.1 403 Forbidden.', TRUE, 403);
    echo 'You dont have permissions to access this page! <a href="javascript:history.back()">Back</a>';
    exit(1); // EXIT_ERROR
}else{
    $pagetitle = "Payment List";
    $act = "modules/payments/do_task.php";

    $getpage = "payment-list";
    $getact = htmlspecialchars($_GET["act"], ENT_QUOTES, 'UTF-8');
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="<?php echo $baseurl;?>">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active"><?php echo $pagetitle;?></li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $pagetitle;?></h1>
    </div>
</div><!--/.row-->
<?php
switch($getact){
    // Show List
    default:
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="pull-right"> &nbsp;</span>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Destination</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT p.*, c.customer_name, b.bank_acc_no, b.bank_acc_name, b.bank_acc_bank, p.payment_status "
                                    . "FROM payment AS p LEFT JOIN customers AS c "
                                    . "ON p.customer_uniqid = c.customer_uniqid "
                                    . "INNER JOIN bank_acc AS b ON p.bank_acc_id = b.bank_acc_id";
                            $results = $database->get_results( $query );
                            $no = 1;
                            foreach( $results as $row )
                            {
                                echo "<tr>";
                                    echo "<td>
                                            <a href='?page=$getpage&act=info&key=$row[payment_id]'><i class='fa fa-eye'></i> View</a>
                                        </td>";
                                    echo "<td>#$row[payment_id]</td>";
                                    echo "<td>". tgl_indo($row[created_date]) ."</td>";
                                    echo "<td><a href='?page=customer-orders&act=info&key=$row[order_uniqid]'> #$row[order_uniqid]</a></td>";
                                    echo "<td>$row[customer_name]</td>";
                                    echo "<td>$row[bank_acc_bank] <br> $row[bank_acc_no] ($row[bank_acc_name])</td>";
                                    echo "<td>". strtoupper($row[payment_status]). "</td>";
                                echo "</tr>";
                                $no++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!--/.row-->
<?php
break;

case "info";
$key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
$query = "SELECT payment_id, order_uniqid, payment_account, payment_name, payment_date, "
        . "payment_bank, payment_attach, payment_status FROM payment WHERE payment_id = '$key' ";
if( $database->num_rows( $query ) > 0 )
{
    list( $id, $orderid, $payacc, $payname, $paydate, $paybank, $payattach, $paystatus ) = $database->get_row( $query );
    $img_path = "../" . UPLOADS_DIR . "receipt" . DIRECTORY_SEPARATOR;
    $pict = !empty($payattach) ? "<img class='img-responsive' src='$img_path$payattach'>" : "NO IMAGE";
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Payment #<?php echo $id;?></h5>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="POST" action="<?php echo $act.'?page='.$getpage;?>&act=update">
                <input type="hidden" name="fid" value="<?php echo $id;?>" readonly>
                <input type="hidden" name="fkey" value="<?php echo $orderid;?>" readonly>
                    <div class="form-group">
                        <label class="col-sm-2">Payment Date</label>
                        <div class="col-sm-5">
                            <p>: <?php echo tgl_indo($paydate);?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Customer Account</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $payacc." (".$paybank.")";?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Customer Account Name</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $payname;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Payment Attachment</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $pict;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Payment Status</label>
                        
                        <?php
                            if($paystatus == "verified"){
                                echo '<div class="col-sm-3"><p>: Verified</p></div>';
                            }else{
                        ?>
                        <div class="col-sm-3">
                            <select name="fstatus" class="form-control" id="fstatus">
                                <option value="verified">Confirm Payment</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!--/.row-->
<?php
}else{
echo '<div class="row"><div class="col-lg-12"> '
    . '<div class="panel panel-default">'
    . '<div class="panel-body"><h2 class="text-center">Data Not Available</h2></div>'
    . '</div>'
    . '</div></div>';
}
break;
}
}
?>