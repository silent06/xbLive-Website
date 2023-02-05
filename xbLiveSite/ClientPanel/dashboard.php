<?php
include "includes/settings.php";
include "includes/database.php";
// TURN OFF STRICT MYSQL MODE
$strict = "SET sql_mode = ''";
if(!isset($_SESSION))
{
    session_start();
}

if(!isset($_SESSION['username']))
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
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>        
        <title><?php echo $name; ?> &bull; Dashboard</title>    

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>        
        <script type="text/javascript" src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;libraries=places"></script> 
        <script type="text/javascript" src="js/plugins/fancybox/jquery.fancybox.pack.js"></script>                
        <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='js/plugins/knob/jquery.knob.js'></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/moment.min.js"></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script> 
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-europe-mill-en.js'></script>
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/demo.js"></script>
        <script type="text/javascript" src="js/maps.js"></script>        
        <script type="text/javascript" src="js/charts.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>        
        
    </head>
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
                    <li class="active"><a href="javascript:void"><i class="fa fa-users"></i>User</a></li>
                    <li><a href="redeem.php"><i class="fa fa-cog"></i> Redeem Token</a></li>
                    <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                    <li><a href="GamesApps.php"><i class="fa fa-gear"></i>Games & Apps</a></li>
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
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">XbLive Currently servicing (Total Clients: <?php echo $clients_total; ?>)</h3>
                                </div>
                                <div class="panel-body controls no-padding">
                                    <div class="block">
                                        <table cellpadding="0" cellspacing="0" width="150%" class="table table-bordered table-striped sortable">
                                            <thead>
                                                <tr>
                                                    <th>Actions</th>                                              
                                                    <th>CPU Key</th>
                                                    <th>Email</th>
                                                    <th>Expires</th>
                                                    <th>Reserved Time</th>
                                                    <th>Enabled</th>
													<th>Primary Color</th>
                                                    <th>Secondary Color</th>
                                                    <th>Last GamerTag</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            <?php
                                            $Username = $_SESSION['username'];
                                            $clients_result = mysqli_query($con, "SELECT * FROM `users` WHERE `Username` = '$Username' ") or die(mysqli_error($con));
                                            $time_result = mysqli_query($con, "SELECT * FROM `users` WHERE `Username` = '$Username' ") or die(mysqli_error($con));
                                            $row = mysqli_fetch_array($time_result);
                                            $timestamp_before_reserve = $row['reserve_seconds'];
                                            $reserve_seconds= $timestamp_before_reserve/86400;/*86400 seconds equals 1 day*/
                                            $timestamp = $row['time_end'];
                                            $Lifetime = time() + 31536000;/*LIfetime in seconds equal to 365 days*/                                   
                                            $time_now=gmdate("Y-m-d\  T:H:i:s\Z", $timestamp);
                                            while($clients_row2 = mysqli_fetch_array($clients_result))
                                            {
    
                                                $primarycolor = "#$clients_row2[primaryuicolor]";
                                                $secondarycolor = "#$clients_row2[secondaryuicolor]";
                                                echo '

                                                <td>
                                                <form action = "edituser.php?id='.$clients_row2['id'].'" method="POST">
                                                <center><button type="submit" class="btn btn-primary"><i class="fa fa-cog"></i>Edit User</button></center>
                                                </form>
                                                </td>

                                                <td>
                                                <center> '.$clients_row2['cpu'].' </center>
                                                </td>

                                                <td>
                                                <center> '.$clients_row2['Email'].' </center>
                                                </td>

                                                <td>
                                                <center>'.($Lifetime < $timestamp ? "<label class = 'label label-success'>LIFETIME</label>" : $time_now).'</center>
                                                </td>

                                                <td>
                                                <center> '.($reserve_seconds > 365 ?  "<label class = 'label label-success'>LIFETIME</label>": "$reserve_seconds day(s) left (86400sec/day)").'  </center>
                                                
                                                </td>
                                                <td>
                                                <center>'. ($clients_row2['status'] == "0" ? "<label class = 'label label-success'>Enabled</label>" : "<label class = 'label label-danger'>Disabled</label>") .'</label></center>
                                                </td>
												<td>
                                                <input type="color" value = "'.$primarycolor.'" "/>                                             
                                                </td>
                                                <td>
                                                <input type="color" value = "'.$secondarycolor.'" "/>

                                                </td>
                                                <td>
                                                <center> '.$clients_row2['last_gamertag'].' </center>
                                                </td>'
                                                ;
                                            }
                                            ?>
                                            </tr>
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
