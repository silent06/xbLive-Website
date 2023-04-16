<?php 
include 'includes/database.php';
include 'includes/settings.php';

if(!isset($_SESSION))
{
	session_start();
}

if(!isset($_SESSION['username_admin']))
{
	echo'
	<script language="javascript">
	window.location.href="index.php"
	</script>
	';
}

if(!isset($_GET['id'])){
		header('location: index.php');
	}
	$id = $_GET['id'];
	$GetInfo = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
	$clientinfo = mysqli_fetch_array($GetInfo);
	$client_name = $clientinfo['Username'];
	$client_cpuk = $clientinfo['cpu'];
	$client_email = $clientinfo['Email'];
	$client_expire = $clientinfo['time_end'];
	$client_enabled = $clientinfo['status'];

	//$time_now=gmdate("Y-m-d\ H:i:s", $client_expire);
	$time_now=gmdate("Y-m-d", $client_expire);
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<title><?php echo $name; ?> &bull; Edit User</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="css/styles.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
		<script type="text/javascript" src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;libraries=places"></script>
		<script type="text/javascript" src="js/plugins/fancybox/jquery.fancybox.pack.js"></script>
		<script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
		<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
		<script type="text/javascript" src="js/plugins/knob/jquery.knob.js"></script>
		<script type="text/javascript" src="js/plugins/daterangepicker/moment.min.js"></script>
		<script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script> 
		<script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-europe-mill-en.js"></script>
		<script type="text/javascript" src="js/plugins/noty/jquery.noty.js"></script>
		<script type="text/javascript" src="js/plugins/noty/layouts/topCenter.js"></script>
		<script type="text/javascript" src="js/plugins/noty/layouts/topLeft.js"></script>
		<script type="text/javascript" src="js/plugins/noty/layouts/topRight.js"></script>    
		<script type="text/javascript" src="js/plugins/noty/themes/default.js"></script>
		<script type="text/javascript" src="js/plugins.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/maps.js"></script>
		<script type="text/javascript" src="js/charts.js"></script>
		<script type="text/javascript" src="js/actions.js"></script>
		<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
		<script type="text/javascript" src="js/plugins/icheck/jquery.icheck.min.js"></script>
		<script type="text/javascript" src="js/plugins/jquery/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="js/plugins/chained/jquery.chained.min.js"></script>
		<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="js/plugins/select2/select2.min.js"></script>
		<script type="text/javascript" src="js/plugins/highlight/jquery.highlight-4.js"></script>
		<script type="text/javascript" src="js/plugins/other/faq.js"></script>
		<script type="text/javascript" src="js/plugins/summernote/summernote.min.js"></script>
		<script type="text/javascript" src="js/plugins/codemirror/codemirror.js"></script>
		<script type='text/javascript' src="js/plugins/codemirror/addon/edit/matchbrackets.js"></script>
		<script type='text/javascript' src="js/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script type='text/javascript' src="js/plugins/codemirror/mode/xml/xml.js"></script>
		<script type='text/javascript' src="js/plugins/codemirror/mode/javascript/javascript.js"></script>
		<script type='text/javascript' src="js/plugins/codemirror/mode/css/css.js"></script>
		<script type='text/javascript' src="js/plugins/codemirror/mode/clike/clike.js"></script>
		<script type='text/javascript' src="js/plugins/codemirror/mode/php/php.js"></script>
	<body>
		<div class="page-container">
            
            <div class="page-navigation">
                
                <div class="profile">                    
                    <img src="17559 Base Source.png"/>
                    <div class="profile-info">
                        <a class="profile-title"><?php echo $_SESSION['username_admin']; ?></a>
                        <span class="profile-subtitle">Admin Panel</span>
                        <div class="profile-buttons">
                            <div class="btn-group">                                
                                <a class="but dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="lib/logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>                        
                    </div>
                </div>
				<ul class="navigation">
					<li class="active"><a href="dashboard.php"><i class="fa fa-users"></i> Manage Users</a></li>
					<li><a href="tokens.php"><i class="fa fa-barcode"></i> Manage Tokens</a></li>
					<li><a href="failed.php"><i class="fa fa-ban"></i> Failed Logins</a></li>
					<li><a href="redeem.php"><i class="fa fa-cog"></i> Redeem Token</a></li>
					<li><a href="settings.php"><i class="fa fa-gear"></i>Settings</a></li>
					<li><a href="hash.php"><i class="fa fa-gear"></i>Manage NoKv Hashes</a></li>
					<li><a href="plugins.php"><i class="fa fa-gear"></i>Manage Plugins</a></li>
					<li><a href="logs.php"><i class="fa fa-barcode"></i>Logs</a></li>
				</ul>
			</div>
			<div class="page-content">
				<div class="container">
					<div class="page-toolbar">
						<div class="page-toolbar-block">
							<div class="page-toolbar-title">Manage Users</div>
						</div>
						<ul class="breadcrumb">
							<li><a href="index.php"><?php echo $name; ?></a></li>
							<li class="active">MANAGE USERS</li>
						</ul>
					</div>		
					<div class="row">
					    <div class="col-md-10">
					    <?php
					    if(isset($_POST['upduser']))
					    {
					    	$clientname = $_POST['nameVal'];
					    	$clientcpuk = $_POST['cpukeyVal'];
					    	$clientemail = $_POST['emailVal'];
					    	$clientexpire = $_POST['timeVal'];
							$clienttimetoseconds = strtotime($clientexpire);

					    	$update_now = mysqli_query($con, "UPDATE `users` SET `Username`='$clientname',`cpu`='$clientcpuk',`Email`='$clientemail', `time_end`='$clienttimetoseconds' WHERE `Username` = '".$clientname."'");
					    	if($update_now)
					    	{
					    		echo'<div class="row"><div class="col-md-12"><div class="alert alert-success">
					    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					    		<strong>OK!</strong> Client successfully updated!.
					    		</div></div></div>';
					    		echo '<meta http-equiv="refresh" content="1;url="dashboard.php">';
					    	}
					    	elseif(!$update_now)
					    	{
					    		echo'<div class="row"><div class="col-md-12"><div class="alert alert-danger">
					    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					    		<strong>Fail!</strong> Client not update, Try again!.
					    		</div></div></div>
					    		';
					    	}
					    }
					    ?>
					    <?php
				        if(isset($_POST['deleteuser']))
				        {
					        $deletenow = mysqli_query($con, "DELETE FROM `users` WHERE `Username` = '".$client_name."'");
					        if($deletenow)
					        {
					        	echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>OK!</strong> Client successfully deleted!.
                                        </div></div></div>';
                                echo '<meta http-equiv="refresh" content="1;url=dashboard.php">';
					        }
					        else
					        {
					            echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Fail!</strong> Client not deleted, please try again!.
                                    </div></div></div>';					        	
					        }
				        }
				        ?>
					    <?php
					    if(isset($_POST['statususer']))
					    {
					    	if($client_enabled == 1)
					    	{
					    		$enable = mysqli_query($con, "UPDATE `users` SET `status`='0' WHERE `cpu` = '$client_cpuk'");
					    		if($enable)
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>OK!</strong> Client successfully enabled!.
                                            </div></div></div>';
                                            echo '<meta http-equiv="refresh" content="2">';
					    		}
					    		else
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>Fail!</strong> Client not enabled, please try again!.
                                            </div></div></div>';
					    		}
					    	}
					    	elseif($client_enabled == 0)
					    	{
					    		$disable = mysqli_query($con, "UPDATE `users` SET `status`='1' WHERE `cpu` = '$client_cpuk'");

					    		if($disable)
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>OK!</strong> Client successfully disabled!.
                                            </div></div></div>';
                                            echo '<meta http-equiv="refresh" content="2">';
					    		}
					    		else
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>Fail!</strong> Client not disabled, please try again!.
                                            </div></div></div>';
					    		}
					    	}
					    }
					    ?>
					        <div class="panel panel-info">
					            <form method="POST">
					                <div class="panel-heading">
					                    <h3 class="panel-title">EDIT / DELETE USER</h3>
					                </div>
					                <div class="panel-body controls no-padding">
					                <div class="row-form">
                                        <div class="col-md-3"><strong>Name :</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" placeholder="Name" value = "<?php echo $client_name; ?>" name="nameVal"/></div>
                                        </div>
                                    <div class="row-form">
                                            <div class="col-md-3"><strong>CPU Key :</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" maxLength = "32" value = "<?php echo $client_cpuk; ?>" placeholder="CPUKey" name="cpukeyVal"/></div>
                                        </div>
                                    <div class="row-form">
                                            <div class="col-md-3"><strong>Email : </strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" value = "<?php echo $client_email; ?>" placeholder="Email" name="emailVal"/></div>
                                    </div>
                                    <div class="row-form">
                                           <div class="col-md-3"><strong>Expire : </strong></div>
                                           <div class="col-md-9"><input type="text" required class="form-control datepicker" value = "<?php echo $time_now; ?>" name="timeVal"/></date></div>
                                    </div>
					                </div>
					                <div class="panel-footer">
					                <button class="btn btn-success" name="upduser">Update</button>
					                <button class="btn btn-danger" name="deleteuser">Delete</button>
					                <?php
					                if($client_enabled == 0)
					                {
					                	echo '<button class="btn btn-warning" name="statususer">Disable</button>';
					                }
					                elseif($client_enabled == 1)
					                {
					                	echo '<button class="btn btn-primary" name="statususer">Enable</button>';
					                }
					                ?>
					                </div>
					            </form>
					        </div>
					    </div>
					</div>	
				</div>
			</div>
		</div>
	</body>
</html>