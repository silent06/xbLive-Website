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
$clients = mysqli_query($con, "SELECT COUNT(1) FROM `users`");
$clients_row = mysqli_fetch_array($clients);
$clients_total = $clients_row[0];

?>
<!DOCTYPE html>
<html lang="en">
<head>
		<title><?php echo $name; ?> &bull; Current Logs</title>
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
					<li><a href="dashboard.php"><i class="fa fa-users"></i> Manage Users</a></li>
					<li><a href="tokens.php"><i class="fa fa-barcode"></i> Manage Tokens</a></li>
					<li  class="active"><a href="logs.php"><i class="fa fa-ban"></i>Logs</a></li>
					<li><a href="redeem.php"><i class="fa fa-cog"></i> Redeem Token</a></li>
					<li><a href="settings.php"><i class="fa fa-gear"></i>Settings</a></li>
					<li><a href="hash.php"><i class="fa fa-gear"></i>Manage NoKv Hashes</a></li>
					<li><a href="plugins.php"><i class="fa fa-gear"></i>Manage Plugins</a></li>
                    <li><a href="failed.php"><i class="fa fa-gear"></i>Failed Logins</a></li>
				</ul>
			</div>
			<div class="page-content">
				<div class="container">
					<div class="page-toolbar">
						<div class="page-toolbar-block">
							<div class="page-toolbar-title">Current Logs</div>
						</div>
						<ul class="breadcrumb">
							<li><a href="index.php"><?php echo $name; ?></a></li>
							<li class="active">Current Logs</li>
						</ul>
					</div>					
					<div class="row">
						<div class="col-md-10">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Servering Clients (Total: <?php echo $clients_total; ?>)</h3>
								</div>
								<div class="panel-body controls no-padding">
									<div class="block">
										<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
											<thead>
												<tr>
													
												</tr>
											</thead>
											<tbody>


											</tbody>
										</table>
									</div>
								</div>
						    <br />
						</div>
			       </div>
			       </div>
            <div class="page-sidebar"></div>
        </div>
		<h1>
          <?php echo $name; ?> &bull;  
		<section class="container"> 
		    <div class="panel panel-warning">
		            <header class="panel-heading">
		        <form method="POST">
		                <h2 class="panel-title">17559 Admin Server Console Log</h2>
		            </header>
		                        <div class="panel-body">
		            <textarea class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 480px; cursor: auto;" readonly>
		                <?php echo file_get_contents("server.log"); ?> 
		            </textarea>
		        </form>
		    </div>
		</section>


		<section class="container"> 
		    <div class="panel panel-warning">
		            <header class="panel-heading">
		        <form method="POST">
		                <h2 class="panel-title">NoKv Remove Log</h2>
		            </header>
		                        <div class="panel-body">
		            <textarea class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 480px; cursor: auto;" readonly>
		                <?php echo file_get_contents("nokv.log"); ?> 
		            </textarea>
		        </form>
		    </div>
		</section>

        <section class="container"> 
		    <div class="panel panel-warning">
		            <header class="panel-heading">
		        <form method="POST">
		                <h2 class="panel-title">NoKv Checker Log</h2>
		            </header>
		                        <div class="panel-body">
		            <textarea class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 480px; cursor: auto;" readonly>
		                <?php echo file_get_contents("nokvChecker.log"); ?> 
		            </textarea>
		        </form>
		    </div>
		</section>

        <section class="container"> 
		    <div class="panel panel-warning">
		            <header class="panel-heading">
		        <form method="POST">
		                <h2 class="panel-title">KvhashHandler Log</h2>
		            </header>
		                        <div class="panel-body">
		            <textarea class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 480px; cursor: auto;" readonly>
		                <?php echo file_get_contents("KvhashHandler.log"); ?> 
		            </textarea>
		        </form>
		    </div>
		</section>

		
        <div class="page-footer">
			<div class="container">
				<center><p class="no-s">&copy; XbLive 2022 All Rights Reserved</p></center>
			</div>
		</div>
      
        </nav>
        <div class="cd-overlay"></div>
	

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/classie/classie.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>
        <script src="assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="assets/plugins/jquery-counterup/jquery.counterup.min.js"></script>
        <script src="assets/plugins/toastr/toastr.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="assets/plugins/metrojs/MetroJs.min.js"></script>
        <script src="assets/js/pages/dashboard.js"></script>
    </body>
</html>