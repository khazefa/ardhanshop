<?php
error_reporting(0);
$isLoggedIn = $_SESSION['isLoggedin'];

if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
    header('HTTP/1.1 403 Forbidden.', TRUE, 403);
    echo 'You dont have permissions to access this page! <a href="javascript:history.back()">Back</a>';
    exit(1); // EXIT_ERROR
}else{
    $pagetitle = "Site Banner";
    $act = "modules/banner/do_task.php";

    $getpage = "list-banner";
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
                <span class="pull-right"><button class="btn btn-primary" onclick="location.href='?page=<?php echo $getpage; ?>&act=add';"><i class="fa fa-plus-circle"></i> Add New</button> </span>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>Banner Pict</th>
                            <th>Banner Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM banner ORDER BY banner_id DESC ";
                            $results = $database->get_results( $query );
                            $no = 1;
                            foreach( $results as $row )
                            {
                                $img_path = "../" . UPLOADS_DIR . "images" . DIRECTORY_SEPARATOR;
                                $pict = !empty($row[banner_pict]) ? "<img class='img-responsive' src='$img_path$row[banner_pict]' width='300px'>" : "NO IMAGE";
                                echo "<tr>";
                                    echo "<td>
                                            <a href='?page=$getpage&act=edit&key=$row[banner_id]'><i class='fa fa-edit'></i> Edit</a> | 
                                            <a href='$act?page=$getpage&act=delete&key=$row[banner_id]'><i class='fa fa-trash'></i> Delete</a>
                                        </td>";
                                    echo "<td class='text-center'>$pict</td>";
                                    echo "<td>$row[banner_title]</td>";
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

case "add":
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Data Form</h5>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="POST" action="<?php echo $act.'?page='.$getpage;?>&act=save" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Banner Title</label>
                        <div class="col-sm-6">
                            <input type="text" name="fname" class="form-control" id="fname" placeholder="Banner Title" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Banner Description</label>
                        <div class="col-sm-8">
                            <textarea name="fdesc" class="form-control summernote" id="fdesc"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Banner Position</label>
                        <div class="col-sm-6">
                            <input type="text" name="fposition" class="form-control" id="fposition" placeholder="Banner Position">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Banner Picture</label>
                        <div class="col-sm-6">
                            <input type="file" name="fupload" class="form-control" id="fupload" accept="image/x-png,image/jpeg">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!--/.row-->
<?php
break;

case "edit";
$key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
$query = "SELECT * FROM banner WHERE banner_id = '$key' ";
if( $database->num_rows( $query ) > 0 )
{
    list( $id, $name, $desc, $pict, $position ) = $database->get_row( $query );
    
    $img_path = "../" . UPLOADS_DIR . "images" . DIRECTORY_SEPARATOR;
    $img = !empty($pict) ? "<img class='img-responsive' src='$img_path$pict'>" : "NO IMAGE";
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Data Form</h5>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="POST" action="<?php echo $act.'?page='.$getpage;?>&act=update" enctype="multipart/form-data">
                <input type="hidden" name="fkey" value="<?php echo $key;?>" readonly>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Brand Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $name;?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Brand Description</label>
                        <div class="col-sm-8">
                            <textarea name="fdesc" class="form-control summernote" id="fdesc"><?php echo $desc;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Brand Position</label>
                        <div class="col-sm-6">
                            <input type="text" name="fposition" class="form-control" id="fposition" value="<?php echo $position;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Item Picture</label>
                        <div class="col-sm-6">
                            <?php echo $img;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Change Picture</label>
                        <div class="col-sm-6">
                            <input type="file" name="fupload" class="form-control" id="fupload" accept="image/x-png,image/jpeg">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
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