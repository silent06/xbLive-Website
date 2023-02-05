<?php
include "includes/database.php";
include "includes/settings.php";

if(!isset($_SESSION))
{
    session_start();
}


?>
<!DOCTYPE html>
<html lang="en">
    
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>        
        <title><?php echo $name; ?> &bull; Client Reset Password<</title>    
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--favicon icon-->
        <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
                
        <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/demo.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>        
        
    </head>
    <body>
        
        <div class="page-container">
            
            <div class="page-content page-content-default">

                <div class="block-login">
                    <div class="block-login-logo">
                        <a class="logo">17559 Client Panel Reset Password<</a>
                    </div>                   
                    <div class="block-login-content">
                        <h1>Client Reset Password</h1>
                        <form id="signinForm" method="POST" action="resetpwemail.php">
                            
                        <div class="form-group">                        
                              <td>Your CPUKey<span class="required"><font color="#CC0000">*</font></span></td>
                              <td><input name="CPU_Key" type="text" id="CPU_Key" size="40" class="required"></td>
                        </div>

                        <div class="form-group">
                              <td>Password<span class="required"><font color="#CC0000">*</font></span> 
                              </td>
                              <td><input name="pwd" type="password" class="required password" minlength="5" id="pwd"> 
                              <span class="example">** 5 chars minimum..</span></td>

                        </div>

                        <div class="form-group">
                              <td>Retype Password<span class="required"><font color="#CC0000">*</font></span> 
                              </td>
                              <td><input name="pwd2"  id="pwd2" class="required password" type="password" minlength="5" equalto="#pwd"></td>

                        </div>


                        <button name = "login" class="btn btn-primary btn-block" type="submit">Reset</button>                                        
                        
                        </form>

                        <div class="sp"></div>
                        <div class="pull-center">
                            <center>Copyright © 2022 - <?php echo $name; ?> | All Rights Reserved.</center>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
    </body>
</html>
