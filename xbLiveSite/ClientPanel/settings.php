<?php
include 'includes/database.php';
include 'includes/settings.php';
// TURN OFF STRICT MYSQL MODE
$strict = "SET sql_mode = ''";
if(!isset($_SESSION))
{
	session_start();
}
if(!isset($_SESSION['username']))
{
	echo '
	<script language="javascript">
	window.location.href="index.php"
	</script>';
}

$Current_User = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<title><?php echo $name; ?> &bull; Settings</title>
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
                        <a class="profile-title"><?php echo $_SESSION['username']; ?></a>
                        <span class="profile-subtitle">Client Panel</span>
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
					<li><a href="dashboard.php"><i class="fa fa-users"></i> Manage Users</a></li>
                    <li><a href="redeem.php"><i class="fa fa-cog"></i> Redeem tokens</a></li>
					<li  class="active"><a href="settings.php"><i class="fa fa-gear"></i>Settings</a></li>
					<li><a href="GamesApps.php"><i class="fa fa-gear"></i>Games & Apps</a></li>
				</ul>
			</div>
			<div class="page-content">
				<div class="container">
					<div class="page-toolbar">
						<div class="page-toolbar-block">
							<div class="page-toolbar-title">Settings</div>
						</div>
						<ul class="breadcrumb">
							<li><a href="index.php"><?php echo $name; ?></a></li>
							<li class="active">Settings</li>
						</ul>
					</div>					
					<div class="row">
						<div class="col-md-10">
						<?php

							if(isset($_POST['Valon'])) 
							{
								
								$cheatsVal = $_POST['Valon'];
								//echo $cheatsVal;					 
                            	$update_now = mysqli_query($con, "UPDATE `users` SET `qtitleid`='$cheatsVal' WHERE `Username` = '".$Current_User."'");

								$GetInfo = mysqli_query($con, "SELECT * FROM `users` WHERE `Username` = '".$Current_User."' LIMIT 1");
								$clientinfo = mysqli_fetch_array($GetInfo);
								$client_online = $clientinfo['online'];

								if($client_online==0) {

                            		if($update_now)
                            		{
                                		echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                		<strong>Setting Updated!</strong> give it about 15 seconds.
                                		</div></div></div>';
                            		} 
                            		else						
                            		{								
                                		echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                		<strong>Fail!</strong> failed!.
                               	 		</div></div></div>';
                            		}
								} else {

									echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<strong>Failed!</strong> Please ensure your 360 is connected to XBLive.
										</div></div></div>';
								}
							}
				
						?>
							<div class="panel panel-info">
								<form method="POST">
									<div class="panel-heading">
										<h3 class="panel-title">Settings</h3>
									</div>
									<div class="panel-body controls no-padding">

										<div class="row-form">
                                            <div class="col-md-3"><strong>Cheats:</strong></div>
												<button class="btn btn-success" value="98789651" name="Valon">Turn on</button> 
												<button class="btn alert-danger" value="98789657" name="Valon">Turn Off</button> 
										</div>

										
										<div class="row-form">
                                            <div class="col-md-3"><strong>Bypasses:</strong></div>
												<button class="btn btn-success" value="98789653" name="Valon">Turn on</button> 
												<button class="btn alert-danger" value="98789658" name="Valon">Turn Off</button> 
										</div>

										<div class="row-form">
                                            <div class="col-md-3"><strong>Rainbow:</strong></div>
												<button class="btn btn-success" value="98789654" name="Valon">Turn on</button> 
												<button class="btn alert-danger" value="98789659" name="Valon">Turn Off</button> 
										</div>

										<div class="row-form">
                                            <div class="col-md-3"><strong>Rotations:</strong></div>
												<button class="btn btn-success" value="98989643" name="Valon">Turn on</button> 
												<button class="btn alert-danger" value="98989668" name="Valon">Turn Off</button> 
										</div>
										
										<div class="row-form">
                                            <div class="col-md-3"><strong>LiveBlock:</strong></div>
												<button class="btn btn-success" value="98789443" name="Valon">Turn on</button> 
												<button class="btn alert-danger" value="98785668" name="Valon">Turn Off</button> 
										</div>
										
										<div class="row-form">
                                            <div class="col-md-3"><strong>LiveStrong:</strong></div>
												<button class="btn btn-success" value="98789613" name="Valon">Turn on</button> 
												<button class="btn alert-danger" value="98789628" name="Valon">Turn Off</button> 
										</div>

										<div class="row-form"> <div class="col-md-3"><strong>Shutdown:</strong></div> <button class="btn alert-danger" value="78984655" name="Valon">Shutdown</button> </div>

									</div>
									<div class="panel-footer">                                                                
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