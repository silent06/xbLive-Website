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
if(isset($_POST['delete_hash']))
{
    if(isset($_GET['id']))
    {
	    $id = $_GET['id'];
	    $delete_hash = mysqli_query($con, "DELETE FROM `kvs` WHERE `id` = '".$id."'");

	    if($delete_hash)   
	    {
		    echo '<meta http-equiv="refresh" content="0.00001;url=hash.php">';
	    }
    }
}
$NoKVHashes = mysqli_query($con, "SELECT COUNT(1) FROM `kvs`");
$NoKVHashes_row = mysqli_fetch_array($NoKVHashes);
$NoKVHashes_total = $NoKVHashes_row[0];


?>
<!DOCTYPE html>
<html lang="en">
<head>
		<title><?php echo $name; ?> &bull; NoKV Hashes</title>
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
					<li  class="active"><a href="hash.php"><i class="fa fa-barcode"></i> Manage NoKv Hashes</a></li>
					<li><a href="failed.php"><i class="fa fa-ban"></i> Failed Logins</a></li>
					<li><a href="redeem.php"><i class="fa fa-cog"></i> Redeem Token</a></li>
					<li><a href="settings.php"><i class="fa fa-gear"></i>Settings</a></li>
                    <li><a href="tokens.php"><i class="fa fa-gear"></i>Manage Tokens</a></li>
                    <li><a href="plugins.php"><i class="fa fa-gear"></i>Manage Plugins</a></li>
					<li><a href="logs.php"><i class="fa fa-barcode"></i>Logs</a></li>
				</ul>
			</div>
			<div class="page-content">
				<div class="container">
					<div class="page-toolbar">
						<div class="page-toolbar-block">
							<div class="page-toolbar-title">NoKV Hashes</div>
						</div>
						<ul class="breadcrumb">
							<li><a href="index.php"><?php echo $name; ?></a></li>
							<li class="active">NoKV Hashes</li>
						</ul>
					</div>					<div class="row">
						<div class="col-md-10">

					</div>
					<div class="row">
						<div class="col-md-10">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Hashes (Total: <?php echo $NoKVHashes_total; ?>)</h3>
								</div>
								<div class="panel-body controls no-padding">
									<div class="block">
										<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
											<thead>
												<tr>
													<th>ID</th>
													<th>Hash</th>
                                                    <th>Uses</th>
                                                    <th>Banned?</th>
													<th><center>Delete</center></th>
												</tr>
											</thead>
											<tbody>
											<?php
                                            //'.($tokens_rows2['seconds_to_add'] == "63072000" ? "LIFETIME" : $days.' day(s)').'
											$hash_result = mysqli_query($con, "SELECT * FROM `kvs`");
											while($hash_result2 = mysqli_fetch_array($hash_result))
											{
                                                $hash = $hash_result2['hash'];
                                                $GetHashInfo = mysqli_query($con, "SELECT * FROM `kv_stats` WHERE `kv_hash` = '$hash' LIMIT 1");
                                                $clientHashinfo = mysqli_fetch_array($GetHashInfo);
                                                $hash_banned = $clientHashinfo['banned'];

												echo'
												<tr>
												<td>
												'.$hash_result2['id'].'
												</td>
												<td>
												'.$hash.'
												</td>
												<td>
												'.$hash_result2['uses'].'
												</td>
                                                <td>
												'.($hash_banned == "1" ? "True" : "False" ).'
												</td>

												<td>
                                                <form action = "hash.php?id='.$hash_result2['id'].'" method="POST">
                                                <center><button type="submit" name = "delete_hash" class="btn btn-primary"><i class="fa fa-cog"></i> Delete Hash</button></center>
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