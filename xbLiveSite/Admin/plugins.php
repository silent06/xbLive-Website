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

$clients = mysqli_query($con, "SELECT COUNT(1) FROM `xex_data`");
$clients_row = mysqli_fetch_array($clients);
$clients_total = $clients_row[0];
//$time_now = time("Y-m-d");
$Current_Admin = $_SESSION['username_admin'];
if(isset($_POST['deleteplugin']))
{
    if(isset($_GET['id']))
    {
	    $id = $_GET['id'];
	    $delete_Plugin = mysqli_query($con, "DELETE FROM `xex_data` WHERE `id` = '".$id."'");
	    if($delete_Plugin)
	    {
		    echo '<meta http-equiv="refresh" content="0.00001;url=plugins.php">';
	    }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>        
        <title><?php echo $name; ?> &bull; Plugin info</title>    
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
                    <li class="active"><a href="plugins.php"><i class="fa fa-users"></i>Manage Plugins</a></li>
                    <li><a href="tokens.php"><i class="fa fa-barcode"></i> Manage Tokens</a></li>
                    <li><a href="failed.php"><i class="fa fa-ban"></i> Failed Logins</a></li>
                    <li><a href="redeem.php"><i class="fa fa-gear"></i> Redeem Token</a></li>
                    <li><a href="settings.php"><i class="fa fa-gear"></i>Settings</a></li>
                    <li><a href="hash.php"><i class="fa fa-gear"></i>Manage NoKv Hashes</a></li>
                    <li><a href="logs.php"><i class="fa fa-barcode"></i>Logs</a></li>
                    </li>                    
                </ul>
                
            </div>
            
            <div class="page-content">
                <div class="container">
                    <div class="page-toolbar">
                        
                        <div class="page-toolbar-block">
                            <div class="page-toolbar-title">Plugins</div>
                        </div>       
                        <ul class="breadcrumb">
                            <li><a href="index.php"><?php echo $name; ?></a></li>
                            <li class="active">Plugins</li>
                        </ul>
                    </div>                    
                    
					<div class="row">
					
                    <div class="row">
                        <div class="col-md-10">
                        <?php
                                if(isset($_POST["create"]))
                                {
                                    $VersionVal = $_POST['VersionVal'];
                                    $PluginVal = $_POST['PluginVal'];
                                    $patch_nameVal = $_POST['patch_nameVal'];
                                    $titleidVal = $_POST['titleidVal'];
                                    $timestampVal = $_POST['timestampVal'];

                                    $select_plugin_first = mysqli_query($con, "SELECT * FROM `xex_data` WHERE `title` = '$titleidVal'");
                                        $select_plugin2_first = mysqli_num_rows($select_plugin_first);

                                        if($select_plugin2_first > 0)
                                        {
                                            echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>Fail!</strong> Title ID already exists in DB, please try again!.
                                            </div></div></div>';
                                        }
                                        else
                                        {
                                            
                                            $insert = mysqli_query($con, "INSERT INTO `xex_data`(`id`, `latest_version`,`name`, `patch_name`, `title`, `title_timestamp`) VALUES ('0', '$VersionVal','$PluginVal', '$patch_nameVal',  '$titleidVal',  '$timestampVal' )");

                                            if($insert)
                                            {
                                                echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>Great!</strong> '.$titleidVal.' successfully added
                                                </div></div></div>';
                                                echo '<meta http-equiv="refresh" content="3;url=plugins.php">';
                                            }
                                            elseif(!$insert)
                                            {
                                                echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    <strong>Fail!</strong> Plugin not added, please try again!.
                                                </div></div></div>';
                                                //echo mysqli_error($con);
                                            }
                                        }
                                }
                                
                                ?>
                            <div class="panel panel-info">
                                <form method="POST">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Add Plugin</h3>
                                    </div>
                                    <div class="panel-body controls no-padding">
                                        <div class="row-form">
                                            <div class="col-md-3"><strong>Version:</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" placeholder="e.g. 100" name="VersionVal"/></div>
                                        </div>
                                        <div class="row-form">
                                            <div class="col-md-3"><strong>Plugin Name:</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" placeholder="e.g. ENGINE.AW.xex" name="PluginVal"/></div>
                                        </div>
                                        <div class="row-form">
                                            <div class="col-md-3"><strong>Patch Name:</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" placeholder="e.g. AW-patch" name="patch_nameVal"/></div>
                                        </div>
                                        <div class="row-form">
                                            <div class="col-md-3"><strong>Title Id:</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" placeholder="e.g. 1096157460" name="titleidVal"/></div>
                                        </div>
                                        <div class="row-form">
                                            <div class="col-md-3"><strong>Title Timestamp:</strong></div>
                                            <div class="col-md-9"><input type="text" required class="form-control" placeholder= "e.g. 1438827463"  name="timestampVal"/></div>
                                        </div>
                                    </div>
                                    <div class="panel-footer"><button class="btn btn-success" name="create">Add Plugin</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Plugins (Total: <?php echo $clients_total; ?>)</h3>
                                </div>
                                <div class="panel-body controls no-padding">
                                    <div class="block">
                                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Latest Version</th>
                                                    <th>name</th>
                                                    <th>patch_name</th>
                                                    <th>Title ID</th>
                                                    <th>Title Timestamp</th>
                                                    <th>Enabled</th>
													<th>Beta</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            <?php
                                            $clients_result = mysqli_query($con, "SELECT * FROM `xex_data`") or die(mysqli_error($con));

                                            while($clients_row2 = mysqli_fetch_array($clients_result))
                                            {

                                                echo '
                                                <tr>
                                                <td>
                                                '.$clients_row2['id'].'
                                                </td>
                                                <td>
                                                '.$clients_row2['latest_version'].'
                                                </td>
                                                <td>
                                                '.$clients_row2['name'].'
                                                </td>
                                                <td>
                                                '.$clients_row2['patch_name'].'
                                                </td>

                                                <td>
                                                '.$clients_row2['title'].'
                                                </td>

                                                <td>
                                                '.$clients_row2['title_timestamp'].'
                                                </td>

												<td>
                                                <center>'. ($clients_row2['enabled'] == "1" ? "<label class = 'label label-success'>Enabled</label>" : "<label class = 'label label-danger'>Disabled</label>") .'</label></center> 
                                                </td>

                                                <td>
                                                <center>'. ($clients_row2['beta_only'] == "1" ? "<label class = 'label label-success'>Enabled</label>" : "<label class = 'label label-danger'>Disabled</label>") .'</label></center> 
                                                </td>

                                                <td>
                                                <form action = "plugins.php?id='.$clients_row2['id'].'" method="POST">
                                                <center><button type="submit" name = "deleteplugin" class="btn btn-primary"><i class="fa fa-cog"></i> Delete Plugin</button></center>
                                                </form>

                                                <form action = "editplugin.php?id='.$clients_row2['id'].'" method="POST">
                                                <center><button type="submit" class="btn btn-primary"><i class="fa fa-cog"></i>Edit Plugin</button></center>
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
