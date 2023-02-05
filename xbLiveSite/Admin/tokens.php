<?php
include 'includes/database.php';
include 'includes/settings.php';
// TURN OFF STRICT MYSQL MODE
$strict = "SET sql_mode = ''";
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
if(isset($_POST['deletetoken']))
{
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$delete_token = mysqli_query($con, "DELETE FROM `redeem_tokens` WHERE `id` = '".$id."'");
	if($delete_token)
	{
		echo '<meta http-equiv="refresh" content="0.00001;url=tokens.php">';
	}
}
}
$tokens = mysqli_query($con, "SELECT COUNT(1) FROM `redeem_tokens`");
$tokens_row = mysqli_fetch_array($tokens);
$tokens_total = $tokens_row[0];


?>
<!DOCTYPE html>
<html lang="en">
<head>
		<title><?php echo $name; ?> &bull; Tokens</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--meta http-equiv="X-UA-Compatible" content="IE=edge" /-->
		<!--meta name="viewport" content="width=device-width, initial-scale=1" /-->
		<link href="css/styles.css" rel="stylesheet" type="text/css" />
		<!--[if lt IE 10]><link rel="stylesheet" type="text/css" href="css/ie.css"/><![endif]-->
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
					<li><a href="dashboard.php"><i class="fa fa-users"></i> Manage Users</a></li>
					<li  class="active"><a href="tokens.php"><i class="fa fa-barcode"></i> Manage Tokens</a></li>
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
							<div class="page-toolbar-title">Tokens</div>
						</div>
						<ul class="breadcrumb">
							<li><a href="index.php"><?php echo $name; ?></a></li>
							<li class="active">Tokens</li>
						</ul>
					</div>					<div class="row">
						<div class="col-md-10">
						

<?php

function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWQRSTUVWXYZ0123456789')
{
	$str = '';
	$count = strlen($charset);
	while ($length--) {
	$str .= $charset[mt_rand(0, $count-1)];
	}
	return $str;
}

if(isset($_POST['create']))
{
		$token_time = $_POST['days'];
		$token_semi_quantity = 0;
		$token_combo = $_POST['howmany'];
			while($token_semi_quantity < $token_combo)
			{
				$token = randString(12); //this is the Token string
				//$token = openssl_digest(uniqid(rand(),true), "sha1");
				$timestamp = $token_time * 86400;
				$insert_token = mysqli_query($con, "INSERT INTO `redeem_tokens`(`id`, `token`, `seconds_to_add`) VALUES ('0', '".$token."','".$timestamp."')");
				$token_semi_quantity++;/*increment loop*/			
				echo "Success!";
			}
}
?>
						<div class="panel panel-info">
								<form method="POST">
									<div class="panel-heading">
										<h3 class="panel-title">Create Token</h3>
										<h3 class="panel-title">Don't Make Tokens For No Reason</h3>
									</div>
									<div class="panel-body controls no-padding">
										<div class="row-form">
											<div class="col-md-3"><strong>How Many:</strong></div>
											<div class="col-md-9">
												<select class="form-control" name="howmany">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
													<option value="13">13</option>
													<option value="14">14</option>
													<option value="15">15</option>
													<option value="16">16</option>
													<option value="17">17</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="21">21</option>
													<option value="22">22</option>
													<option value="23">23</option>
													<option value="24">24</option>
													<option value="25">25</option>
													<option value="26">26</option>
													<option value="27">27</option>
													<option value="28">28</option>
													<option value="29">29</option>
													<option value="30">30</option>
												</select>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-3"><strong>Days:</strong></div>
											<div class="col-md-9">
												<select class="form-control" name="days">
													<option value="1">1 Day</option>
                                                    <option value="3">3 Days</option>
                                                    <option value="7">1 Week</option>
													<option value="14">2 Weeks</option>
                                                    <option value="31">1 Month</option>
													<option value="93">3 Months</option>
													<option value="186">6 Months</option>
													<option value="365">1 Year</option>
                                                    <option value="730">LIFETIME</option>
												</select>
											</div>
										</div>
									</div>
									<div class="panel-footer"><button class="btn btn-success" name="create">Generate</button></div>
								</form>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Tokens (Total: <?php echo $tokens_total; ?>)</h3>
								</div>
								<div class="panel-body controls no-padding">
									<div class="block">
										<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
											<thead>
												<tr>
													<th>ID</th>
													<th>Token</th>
													<th>Time Generated</th>
													<th>Used</th>
													<th>Used By</th>
													<th><center>Delete</center></th>
												</tr>
											</thead>
											<tbody>
											<?php
											$tokens_result = mysqli_query($con, "SELECT * FROM `redeem_tokens`");
											while($tokens_rows2 = mysqli_fetch_array($tokens_result))
											{
												$days = $tokens_rows2['seconds_to_add']/86400;
												echo'
												<tr>
												<td>
												'.$tokens_rows2['id'].'
												</td>
												<td>
												'.$tokens_rows2['token'].'
												</td>
												<td>
												'.($tokens_rows2['seconds_to_add'] == "63072000" ? "LIFETIME" : $days.' day(s)').'
												</td>
												<td>
												<center>'.($tokens_rows2['redeemer_console_key'] == "--none--" ? "<label class = 'label label-success'>NOT USED</label>" : "<label class = 'label label-danger'>USED</label>").'</center>
												</td>
												<td>
												'.$tokens_rows2['redeemer_console_key'].'
												</td>
												<td>
                                                <form action = "tokens.php?id='.$tokens_rows2['id'].'" method="POST">
                                                <center><button type="submit" name = "deletetoken" class="btn btn-primary"><i class="fa fa-cog"></i> Delete Token</button></center>
                                                </form>
                                                </td>'
                                                ;
											}
											?>
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
    </body>
</html>