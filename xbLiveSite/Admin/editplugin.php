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
	window.location.href="editplugin.php"
	</script>
	';
}

if(!isset($_GET['id'])){
		header('location: plugins.php');
	}
	$id = $_GET['id'];
	$GetInfo = mysqli_query($con, "SELECT * FROM `xex_data` WHERE `id` = '$id' LIMIT 1");
	$clientinfo = mysqli_fetch_array($GetInfo);
	$client_latest_version = $clientinfo['latest_version'];
	$client_name = $clientinfo['name'];
	$client_patch_name = $clientinfo['patch_name'];
	$client_title = $clientinfo['title'];
	$client_title_timestamp = $clientinfo['title_timestamp'];
    $client_enabled = $clientinfo['enabled'];
    $client_beta_only = $clientinfo['beta_only'];

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
					<li class="active"><a href="editplugin.php"><i class="fa fa-users"></i> Edit Plugins</a></li>
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
							<div class="page-toolbar-title">Edit Plugins</div>
						</div>
						<ul class="breadcrumb">
							<li><a href="editplugin.php"><?php echo $name; ?></a></li>
							<li class="active">Edit Plugins</li>
						</ul>
					</div>		
					<div class="row">
					    <div class="col-md-10">
					    <?php
					    if(isset($_POST['upduser']))
					    {
					    	$versionVal = $_POST['versionVal'];
					    	$nameVal = $_POST['nameVal'];
					    	$patchVal = $_POST['patchVal'];
					    	$titleidVal = $_POST['titleidVal'];

					    	$update_now = mysqli_query($con, "UPDATE `xex_data` SET `latest_version`='$versionVal',`name`='$nameVal',`patch_name`='$patchVal', `title_timestamp`='$titleidVal' WHERE `title` = '".$client_title."'");
					    	if($update_now)
					    	{
					    		echo'<div class="row"><div class="col-md-12"><div class="alert alert-success">
					    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					    		<strong>OK!</strong> Plugin successfully updated!.
					    		</div></div></div>';
					    		echo '<meta http-equiv="refresh" content="2">';
					    	}
					    	elseif(!$update_now)
					    	{
					    		echo'<div class="row"><div class="col-md-12"><div class="alert alert-danger">
					    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					    		<strong>Fail!</strong> Plugin not update, Try again!.
					    		</div></div></div>
					    		';
					    	}
					    }
					    ?>

                        <?php
					    if(isset($_POST['statususer']))
					    {
					    	if($client_enabled == 0)
					    	{
					    		$enable = mysqli_query($con, "UPDATE `xex_data` SET `enabled`='1' WHERE `title` = '$client_title'");
					    		if($enable)
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>OK!</strong> Plugin successfully enabled!.
                                            </div></div></div>';
                                            echo '<meta http-equiv="refresh" content="2">';
					    		}
					    		else
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>Fail!</strong> Plugin not enabled, please try again!.
                                            </div></div></div>';
					    		}
					    	}
					    	elseif($client_enabled == 1)
					    	{
					    		$disable = mysqli_query($con, "UPDATE `xex_data` SET `enabled`='0' WHERE `title` = '$client_title'");

					    		if($disable)
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>OK!</strong> Plugin successfully disabled!.
                                            </div></div></div>';
                                            echo '<meta http-equiv="refresh" content="2">';
					    		}
					    		else
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>Fail!</strong> Plugin not disabled, please try again!.
                                            </div></div></div>';
					    		}
					    	}
					    }
					    ?>


                        <?php
					    if(isset($_POST['betaonly']))
					    {
					    	if($client_beta_only == 0)
					    	{
					    		$enable = mysqli_query($con, "UPDATE `xex_data` SET `beta_only`='1' WHERE `title` = '$client_title'");
					    		if($enable)
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>OK!</strong> Plugin beta only successfully enabled!.
                                            </div></div></div>';
                                            echo '<meta http-equiv="refresh" content="2">';
					    		}
					    		else
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>Fail!</strong> Plugin beta only not enabled, please try again!.
                                            </div></div></div>';
					    		}
					    	}
					    	elseif($client_beta_only == 1)
					    	{
					    		$disable = mysqli_query($con, "UPDATE `xex_data` SET `beta_only`='0' WHERE `title` = '$client_title'");

					    		if($disable)
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>OK!</strong> Plugin  beta only successfully disabled!.
                                            </div></div></div>';
                                            echo '<meta http-equiv="refresh" content="2">';
					    		}
					    		else
					    		{
					    			echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>Fail!</strong> Plugin beta only not disabled, please try again!.
                                            </div></div></div>';
					    		}
					    	}
					    }
					    ?>
					        <div class="panel panel-info">
					            <form method="POST">
					                <div class="panel-heading">
					                    <h3 class="panel-title">EDIT Plugin</h3>
					                </div>
					                <div class="panel-body controls no-padding">
					                <div class="row-form">
                                        <div class="col-md-3"><strong>Version:</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" placeholder="Version" value = "<?php echo $client_latest_version; ?>" name="versionVal"/></div>
                                        </div>
                                    <div class="row-form">
                                            <div class="col-md-3"><strong>Plugin Name:</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" value = "<?php echo $client_name; ?>" placeholder="" name="nameVal"/></div>
                                        </div>
                                    <div class="row-form">
                                            <div class="col-md-3"><strong>Patch Name: </strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" value = "<?php echo $client_patch_name; ?>" placeholder="" name="patchVal"/></div>
                                    </div>

                                    <div class="row-form">
                                            <div class="col-md-3"><strong>Title TimeStamp: </strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" value = "<?php echo $client_title_timestamp; ?>" placeholder="" name="titleidVal"/></div>
                                    </div>

					                </div>
					                <div class="panel-footer">
					                <button class="btn btn-success" name="upduser">Update</button>
					                <?php
					                if($client_enabled == 0)
					                {
					                	echo '<button class="btn btn-warning" name="statususer">Plugin is Disabled</button>';
					                }
					                elseif($client_enabled == 1)
					                {
					                	echo '<button class="btn btn-primary" name="statususer">Plugin is Enabled</button>';
					                }
					                ?>

                                    <?php
					                if($client_beta_only == 0)
					                {
					                	echo '<button class="btn btn-warning" name="betaonly">Beta is Disabled</button>';
					                }
					                elseif($client_beta_only == 1)
					                {
					                	echo '<button class="btn btn-primary" name="betaonly">Beta is Enabled</button>';
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