<?php
include "includes/settings.php";
include "includes/database.php";
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

$clients = mysqli_query($con, "SELECT COUNT(1) FROM `users`");
$clients_row = mysqli_fetch_array($clients);
$clients_total = $clients_row[0];
//$time_now = time("Y-m-d");
$Current_Admin = $_SESSION['username_admin'];
if(isset($_GET['deleteclient']))
{
    if($_GET['deleteclient'])
    {
        $id = strip_tags($_GET['deleteclient']);
        mysqli_query($con, "DELETE FROM `consoles` WHERE `id` = '$id'") or die(mysqli_error($con));
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>        
        <title><?php echo $name; ?> &bull; Dashboard</title>    
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
        
    </head>
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
                    <li class="active"><a href="javascript:void"><i class="fa fa-users"></i> Manage Users</a></li>
                    <li><a href="tokens.php"><i class="fa fa-barcode"></i> Manage Tokens</a></li>
                    <li><a href="failed.php"><i class="fa fa-ban"></i> Failed Logins</a></li>
                    <li><a href="redeem.php"><i class="fa fa-gear"></i> Redeem Token</a></li>
                    <li><a href="settings.php"><i class="fa fa-gear"></i>Settings</a></li>
                    <li><a href="hash.php"><i class="fa fa-gear"></i>Manage NoKv Hashes</a></li>
                    <li><a href="plugins.php"><i class="fa fa-gear"></i>Manage Plugins</a></li>
                    <li><a href="logs.php"><i class="fa fa-barcode"></i>Logs</a></li>
                    </li>                    
                </ul>
                
            </div>
            
            <div class="page-content">
                <div class="container">
                    <div class="page-toolbar">
                        
                        <div class="page-toolbar-block">
                            <div class="page-toolbar-title">Dashboard</div>
                        </div>       
                        <ul class="breadcrumb">
                            <li><a href="index.php"><?php echo $name; ?></a></li>
                            <li class="active">Dashboard</li>
                        </ul>
                    </div>                    
                    
					<div class="row">
						<div class="col-md-10">
						<?php
						if(isset($_POST['check']))
						{
							$cpukey = $_POST['cpukeyVal'];
							$get_time = mysqli_query($con, "SELECT * FROM `users` WHERE `cpu` = '".$cpukey."'");
							$do_time_check = mysqli_num_rows($get_time);
							$row = mysqli_fetch_array($get_time);
							$time = $row['expire'];
							$client_name = $row['name'];
							$realx_time=strtotime($time) - strtotime('now');
							$real_time = intval($realx_time/60/60/24);

							if($do_time_check == 1)
							{
								echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <center><strong>Client found in database.</strong></center> <center>
                                <div>Name : '.$client_name.'</div>
                                <div>CPUKey : '.$cpukey.'</div>
                                <div>Remaining Time : '.($real_time == "16606" ? "LIFETIME" : $real_time.'days').  '</div>
                                </center>
                                </div></div></div>';
							}
							elseif($do_time_check == 0)
							{
								echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Fail!</strong> Client not found in database.
                                </div></div></div>';
							}
						}
						?>
					
					
                    <div class="row">
                        <div class="col-md-10">
                        <?php
                                if(isset($_POST["create"]))
                                {
                                    $client_name = $_POST['nameVal'];
                                    $client_cpuk = $_POST['cpukeyVal'];
                                    $client_email = $_POST['emailVal'];
                                    $client_time = $_POST['daysVal'];
                                    $client_AddedBy = $_POST['AddedByVal'];
                                    $client_realtime = $client_time * 86400;
                                    

                                    $select_username_first = mysqli_query($con, "SELECT COUNT(*) FROM `users` WHERE `Username` = '$client_name'");
                                    $select_cpukey_first = mysqli_query($con, "SELECT * FROM `users` WHERE `cpu` = '$client_cpuk'");
                                        $select_cpuk_first = mysqli_num_rows($select_cpukey_first);

                                        if($select_cpuk_first > 0)
                                        {
                                            echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>Fail!</strong> This cpukey exist in DB, please try again!.
                                            </div></div></div>';
                                        }
                                        else
                                        {
                                            
                                            $insert = mysqli_query($con, "INSERT INTO `users`(`id`, `Username`,`email`, `cpu`, `reserve_seconds`, `status`, `addedby`) VALUES ('0', '$client_name','$client_email', '$client_cpuk',  '$client_realtime', '1',  '$client_AddedBy' )");

                                            if($insert)
                                            {
                                                echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>Great!</strong> '.$client_name.' successfully added
                                                </div></div></div>';
                                                echo '<meta http-equiv="refresh" content="3;url=index.php">';
                                            }
                                            elseif(!$insert)
                                            {
                                                echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    <strong>Fail!</strong> Client not added, please try again!.
                                                </div></div></div>';
                                                //echo mysqli_error($con);
                                            }
                                        }
                                }
                                
                                ?>
                            <div class="panel panel-info">
                                <form method="POST">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Add User(Client Portals default password: password)</h3>
                                    </div>
                                    <div class="panel-body controls no-padding">
                                        <div class="row-form">
                                            <div class="col-md-3"><strong>Username:</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" placeholder="name" name="nameVal"/></div>
                                        </div>
                                        <div class="row-form">
                                            <div class="col-md-3"><strong>CPU Key:</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" maxLength = "32" placeholder="cpu key" name="cpukeyVal"/></div>
                                        </div>
                                        <div class="row-form">
                                            <div class="col-md-3"><strong>Email:</strong></div>
                                            <div class="col-md-9"><input type="email" required class="form-control" placeholder="email" name="emailVal"/></div>
                                        </div>
                                        <div class="row-form">
                                            <div class="col-md-3"><strong>Time:</strong></div>
                                            <div class="col-md-9">
                                                <select class="form-control" name="daysVal">
                                                    <option value="1">1 Day</option>
                                                    <option value="3">3 Days</option>
                                                    <option value="7">1 Week</option>
													<option value="14">2 Weeks</option>
                                                    <option value="31">1 Month</option>
													<option value="93">3 Months</option>
													<option value="186">6 Months</option>
                                                    <option value="99999">Lifetime</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row-form">
                                            <div class="col-md-3"><strong>AddedBy:</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" placeholder=<?php echo $_SESSION['username_admin']; ?>  name="AddedByVal"/></div>
                                        </div>
                                    </div>
                                    <div class="panel-footer"><button class="btn btn-success" name="create">Add User</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Users (Total: <?php echo $clients_total; ?>)</h3>
                                </div>
                                <div class="panel-body controls no-padding">
                                    <div class="block">
                                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>CPU Key</th>
                                                    <th>Email</th>
                                                    <th>Expire</th>
                                                    <th>Reserved Time</th>
                                                    <th>Enabled</th>
													<th>Added By</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            <?php
                                            $clients_result = mysqli_query($con, "SELECT * FROM `users`") or die(mysqli_error($con));

                                            while($clients_row2 = mysqli_fetch_array($clients_result))
                                            {
                                                $timestamp_before_reserve = $clients_row2['reserve_seconds'];
                                                $reserve_seconds= $timestamp_before_reserve/86400;/*86400 seconds equals 1 day*/
                                                $timestamp = $clients_row2['time_end'];
                                                $Lifetime = time() + 31536000;/*LIfetime in seconds equal to 365 days*/                                   
                                                $time_now=gmdate("Y-m-d\  T:H:i:s\Z", $timestamp);

                                                echo '
                                                <tr>
                                                <td>
                                                '.$clients_row2['id'].'
                                                </td>
                                                <td>
                                                '.$clients_row2['Username'].'
                                                </td>
                                                <td>
                                                '.$clients_row2['cpu'].'
                                                </td>
                                                <td>
                                                '.$clients_row2['Email'].'
                                                </td>
                                                <td>
                                                <center>'.($Lifetime < $timestamp ? "<label class = 'label label-success'>LIFETIME</label>" : $time_now).'</center>
                                                                                             
                                                </td>
                                                <td>
                                                <center> '.($reserve_seconds > 365 ?  "<label class = 'label label-success'>LIFETIME</label>": "$reserve_seconds day(s) left (86400sec/day)").'  </center>
                                                
                                                </td>
                                                <td>
                                                <center>'. ($clients_row2['status'] == "1" ? "<label class = 'label label-success'>Enabled</label>" : "<label class = 'label label-danger'>Disabled</label>") .'</label></center>                                                                                      
                                                </td>
												<td>
                                                '.$clients_row2['addedby'].'
                                                </td>
                                                <td>
                                                <form action = "edituser.php?id='.$clients_row2['id'].'" method="POST">
                                                <center><button type="submit" class="btn btn-primary"><i class="fa fa-cog"></i>Edit User</button></center>
                                                </form>
                                                </td>
                                                </tr>'
                                                ;
                                            }
                                            ?>
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>          
                    </div>
                </div>
            <div class="page-sidebar"></div>
        </div>
    </body>
</html>
