<?php
include "ClientPanel/includes/database.php";
// TURN OFF STRICT MYSQL MODE
$strict = "SET sql_mode = ''";


/*Client stats*/
$clients = mysqli_query($con, "SELECT COUNT(1) FROM `users`");
$clients_row = mysqli_fetch_array($clients);
$clients_total = $clients_row[0];


/*Lifetime*/
$clients_result = mysqli_query($con, "SELECT * FROM `users`") or die(mysqli_error($con));

$Lifetimetotal = 0;
while($clients_row2 = mysqli_fetch_array($clients_result)) {

   $timestamp = $clients_row2['time_end'];
   $Lifetime = time() + 31536000;                                  
   while($Lifetime < $timestamp) {

      $Lifetimetotal++;/*increment loop*/
      break;
   }
   
}


/*Total Client Challenges*/
$Challenges_tokens = mysqli_query($con, 'SELECT SUM(total_challenges) AS total_challenges FROM kv_stats');
$Challenges_row = mysqli_fetch_assoc($Challenges_tokens);
$clients_Challenges = $Challenges_row['total_challenges'];


/*CLients online from access_tokens*/
$access_tokens = mysqli_query($con, "SELECT COUNT(1) FROM `access_tokens`");
$access_row = mysqli_fetch_array($access_tokens);
$clients_Online = $access_row[0];

?>


<!doctype html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
      <meta property="og:site_name" content="">
      <!-- website name -->
      <meta property="og:site" content="">
      <!-- website link -->
      <meta property="og:title" content="">
      <!-- title shown in the actual shared post -->
      <meta property="og:description" content="">
      <!-- description shown in the actual shared post -->
      <meta property="og:image" content="">
      <!-- image link, make sure it's jpg -->
      <meta property="og:url" content="">
      <!-- where do you want your post to link to -->
      <meta property="og:type" content="article">
      <!--title-->
      <title>XbLive</title>
      <!--favicon icon-->
      <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
      <!--google fonts-->
      <link href="https://fonts.googleapis.com/css?family=Comfortaa:500,600,700%7COpen+Sans&amp;display=swap" rel="stylesheet">
      <!--Bootstrap css-->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!--Magnific popup css-->
      <link rel="stylesheet" href="css/magnific-popup.css">
      <!--Themify icon css-->
      <link rel="stylesheet" href="css/themify-icons.css">
      <!--Owl carousel css-->
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <!--custom css-->
      <link rel="stylesheet" href="css/style.css">
      <!--responsive css-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- Font Awesome -->
      <!--link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" /-->
   </head>
   <body>
      <!--header section start-->
      <header class="header">
         <!--start navbar-->
         <nav class="navbar navbar-expand-lg fixed-top bg-transparent">
            <div class="container">
            <!--a class="navbar-brand" href="index-2.html"><img src="img/logo-white-1x.png" width="180" alt="logo" class="img-fluid"></a-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="ti-menu"></span>
            </button>
            <div class="collapse navbar-collapse main-menu" id="navbarSupportedContent">
               <ul class="navbar-nav ml-auto">
               <li class="nav-item dropdown">
                  <a class="nav-link page-scroll" href="#home">
                  Home
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link page-scroll" href="#services">Service</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link page-scroll" href="#about">Statistics</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link page-scroll" href="#pricing">Pricing</a>
               </li>
               </li>
               <li class="nav-item">
                  <a class="nav-link page-scroll" href="#contact">Contact</a>
               </li>
               </li>
               <div class="collapse navbar-collapse main-menu" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item dropdown">
                        <a class="nav-link page-scroll dropdown-toggle" href="#" id="navbarDropdownHome" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Downloads & Extras
                        </a>
                        <div class="dropdown-menu submenu" aria-labelledby="navbarDropdownHome">
                           <a class="dropdown-item" href="Files/XbLive.rar">
                              <center>XEX Download (17559)</center>
                           </a>
                           <a class="dropdown-item" href="Files/XeBuild.rar">
                              <center>Xebuild Download (17559)</center>
                           </a>
                           <a class="dropdown-item" href="https://stats.uptimerobot.com/WqmMOc5E4A"target="_blank">
                              <center>Server Status (Online?)</center>
                           </a>
                        </div>
                        <li class="Button">
                        <a href="ClientPanel/index.php" target="_blank">Client Panel</a>
                     </li>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
         <!--end navbar-->
      </header>
      <!--header section end-->
      <!--body content wrap start-->
      <div class="main">
      <!--hero section start-->
      <section id="home" class="hero-section pt-100 background-img" style="background: url('img/hero-bg-2.jpg')no-repeat center center / cover">
         <div class="container">
            <div class="row align-items-center justify-content-between pt-5 pb-5">
               <div class="col-md-6 col-lg-6">
                  <div class="hero-content-left text-white">
                     <h1 class="text-white">XbLive 2.0.17559.0</h1>
                     <p class="lead">Providing Perfect Responses to All Clients at the Lowest Prices</p>
                     <b class="lead">
                        <center><b style="color:Black;">FOREVER FREE SERVICE</b></center>
                     </b>
                     <a href="Files/XbLive.rar" class="btn solid-btn mb-3" target="_blank">Download XEX</a>
                     <a href="Files/XeBuild.rar" class="btn solid-btn mb-3" target="_blank">Download XeBuild</a>
                     <a href="https://discord.gg/aFQaezX" class="btn solid-btn mb-3" target="_blank">Join Our Discord</a>
                     <!--clients logo end-->
                  </div>
               </div>
               <div class="col-md-6 col-lg-5">
                  <div class="hero-animation-img">
                     <img class="img-fluid d-block animation-one" src="" alt="animation image">
                  </div>
               </div>
            </div>
         </div>
         <div class="bottom-img">
            <!--img src="img/bg-wave.svg" alt="wave shape" class="img-fluid"-->
         </div>
      </section>
      <!--hero section end-->
      <!--our services section start-->
      <section id="services" class="our-services-section ptb-100">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-8 col-lg-7">
                  <div class="section-heading text-center mb-5">
                     <h2>What XbLive has to offer </h2>
                     <p class="lead">XbLive gives you what other servers don't, a good reliable service for cheap!</p>
                  </div>
               </div>
            </div>
            <div class="row no-gutters">
               <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-services single-feature-hover gray-light-bg single-feature text-center p-5 h-100">
                     <span class="ti-cloud-down icon-color-1 icon rounded"></span>
                     <div class="feature-content">
                        <h5 class="mb-2">Automatic Updates</h5>
                        <li>When new updates role out, they will automatically download to the console</li>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-services single-feature-hover gray-light-bg single-feature text-center p-5 h-100">
                     <span class="ti-file icon-color-2 icon rounded"></span>
                     <div class="feature-content">
                        <h5 class="mb-2">No Keyvault Mode</h5>
                        <li>No Need for a Keyvault on this service :)</li>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-services single-feature-hover gray-light-bg single-feature text-center p-5 h-100">
                     <span class="ti-shield icon-color-2 icon rounded"></span>
                     <div class="feature-content">
                        <h5 class="mb-2">All COD Bypasses</h5>
                        <li>Advanced Warfare</li>
                        <li>Black Ops 2</li>
                        <li>Black Ops 3</li> 
                        <li>Ghost</li>  
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-services single-feature-hover gray-light-bg single-feature text-center p-5 h-100">
                     <span class="ti-money icon-color-2 icon rounded"></span>
                     <div class="feature-content">
                        <h5 class="mb-2">Really Cheap and Affordable</h5>
                        <li>We thrive to be as affordable as possible for everyone!</li>
                        <li>We offer a FOREVER FREE Service!</li>                    
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-services single-feature-hover gray-light-bg single-feature text-center p-5 h-100">
                     <span class="ti-server icon-color-2 icon rounded"></span>
                     <div class="feature-content">
                        <h5 class="mb-2">Dedicated Servers</h5>
                        <li>Our service runs off of multiple dedicated services with 10GB/s Bandwidth (99% uptime)</li>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-services single-feature-hover gray-light-bg single-feature text-center p-5 h-100">
                     <span class="far fa-file-code icon-color-2 icon rounded"></span>
                     <div class="feature-content">
                        <h5 class="mb-2">Custom Client</h5>
                        <li>Our Client was written from Scratch, no pasted code here! This has been in the works for a while, and we will not let you down!</li>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--our services section end-->
      <!--about us section start-->
      <section id="about" class="about-us ptb-100 gray-light-bg">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-md-6">
                  <div class="about-content-left">
                     <h2>XbLive Statistics</h2>
                     <p class="lead">Real-Time Server Statistics</p>
                     <div class="row">
                        <div class="col single-feature mb-4">
                           <div class="d-flex align-items-center mb-2">
                              <span class="ti-bar-chart rounded mr-3 icon icon-color-2"></span>
                              <h5 class="mb-0">Real Data</h5>
                           </div>
                           <p>Watch the real-time statistics change as you go online!</p>
                        </div>
                        <div class="col single-feature mb-4">
                           <div class="d-flex align-items-center mb-2">
                              <span class="ti-stats-up rounded mr-3 icon icon-color-3"></span>
                              <h5 class="mb-0">Product Usage</h5>
                           </div>
                           <p>See how many clients are using our service with our perfected challenge responses!</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="counter">
                     <div class="single-card box-animation-1 secondary-bg text-white">
                        <span class="fas fa-users color-primary"></span>
                        <h3 class="counter-up"><?php echo $clients_total; ?></h3>
                        <p>Total Clients</p>
                     </div>
                     <div class="single-card box-animation-2 icon-color-1">
                        <span class="fas fa-signal"></span>
                        <h3 class="counter-up"><?php echo $clients_Online; ?> </h3>
                        <p>Clients Online</p>
                     </div>
                     <div class="single-card box-animation-3 icon-color-2">
                        <span class="fas fa-server"></span>
                        <h3 class="counter-up"><?php echo $clients_Challenges; ?></h3>
                        <p>Total Challenges Ran</p>
                     </div>
                     <div class="single-card box-animation-4 primary-bg text-white">
                        <span class="fas fa-infinity"></span>
                        <h3 class="counter-up"><?php echo $Lifetimetotal; ?></h3>
                        <p>Lifetime Clients</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--about us section end-->
      <!--our services section start-->
      <section id="services" class="imageblock-section switchable">
         <div class="imageblock-section-img col-lg-6 col-md-5">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/ux6jDndqQP4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-lg-5 col-md-5">
                  <div class="about-content ptb-100">
                     <h2>
                        <center>What XbLive has to offer!</center>
                     </h2>
                     <p>
                     <center>Watch the video provided to see the features that are accessible</center>
                     </p>
                  </div>
               </div>
            </div>
            <!--end of row-->
         </div>
      </section>
      <!--our services section end-->
      <section id="pricing" class="package-section gray-light-bg ptb-100">
         <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-12">
               <div class="section-heading text-center mb-5">
                  <h2>Packages</h2>
                  <p class="lead">
                     Select Between Any of the Provided Packages
                  </p>
                  <strong>*If you want Reserved Days (24 Hour Intervals) contact the owners!</strong>
               </div>
            </div>
         </div>
         <div class="row justify-content-center">
            <div class="col-lg-3 col-md">
               <div class="card text-center single-pricing-pack">
                  <div class="card-header py-5 border-0 pricing-header">
                     <div class="h1 text-center mb-0"><span class="price font-weight-bolder">FREE</span></div>
                     <span class="h6 text-muted">XbLive LITE</span>
                  </div>
                  <div class="card-body">
                     <ul class="list-unstyled text-sm mb-4 pricing-feature-list">
                        <li><font color="green">YES </font><font>Perfect Challenges</font>
                        <li>
                        <li><font color="orange">YES </font><font>No KV Mode</font>
                        <li><font color="red">KVs Donated Purely By Users</font>
                        <li>
                        <li><font color="orange">YES </font><font>Fully Custom UI</font>
                        <li><font color="red">No Textures, Cant Upload UI</font>
                        <li>
                        <li><font color="red">NO </font><font>COD Cheats</font>
                        <li>
                        <li><font color="red">NO </font><font>GTA 5 Menu</font>
                        <li>
                        <li><font color="green">YES </font><font>99% Uptime</font>
                        <li>
                        <li><font color="green">YES </font><font>Frequent Updates</font>
                        <li>
                        <li><font color="red">NO </font><font>Automatic Token Delivery</font>
                        <li>
                        <li><font color="red">NO </font><font>Provide Tech Support</font>
                        <li>
                        <li><font color="red">NO </font><font>Paypal, Amazon, And BTC Accepted</font>
                        <li>
                     </ul>
                     <a href="Files/XbLive.rar" class="btn primary-solid-btn mb-3" target="_blank">Download Now</a>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md">
               <div class="card text-center single-pricing-pack">
                  <div class="card-header py-5 border-0 pricing-header">
                     <div class="h1 text-center mb-0">$<span class="price font-weight-bolder">0</span></div>
                     <span class="h6 text-muted">7 Day Token</span>
                  </div>
                  <div class="card-body">
                     <ul class="list-unstyled text-sm mb-4 pricing-feature-list">
                        <li><font color="green">YES </font><font>Perfect Challenges</font>
                        <li>
                        <li><font color="green">YES </font><font>No KV Mode</font>
                        <li>
                        <li><font color="green">YES </font><font>Fully Custom UI</font>
                        <li>
                        <li><font color="orange">Coming </font><font>COD Cheats</font>
                        <li>
                        <li><font color="orange">Coming </font><font>GTA 5 Menu</font>
                        <li>
                        <li><font color="green">YES </font><font>99% Uptime</font>
                        <li>
                        <li><font color="green">YES </font><font>Frequent Updates</font>
                        <li>
                        <li><font color="green">YES </font><font>Automatic Token Delivery</font>
                        <li>
                        <li><font color="green">YES </font><font>Provide Tech Support</font>
                        <li>
                        <li><font color="green">YES </font><font>Paypal, Amazon, And BTC Accepted</font>
                        <li>
                     </ul>
                     <a href="https://shoppy.gg/@XbLive" class="btn primary-solid-btn mb-3" target="_blank">Purchase now</a>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md">
               <div class="card text-center single-pricing-pack">
                  <div class="card-header py-5 border-0 pricing-header">
                     <div class="h1 text-center mb-0">$<span class="price font-weight-bolder">0</span></div>
                     <span class="h6 text-muted">14 Day Token</span>
                  </div>
                  <div class="card-body">
                     <ul class="list-unstyled text-sm mb-4 pricing-feature-list">
                        <li><font color="green">YES </font><font>Perfect Challenges</font>
                        <li>
                        <li><font color="green">YES </font><font>No KV Mode</font>
                        <li>
                        <li><font color="green">YES </font><font>Fully Custom UI</font>
                        <li>
                        <li><font color="orange">Coming </font><font>COD Cheats</font>
                        <li>
                        <li><font color="orange">Coming </font><font>GTA 5 Menu</font>
                        <li>
                        <li><font color="green">YES </font><font>99% Uptime</font>
                        <li>
                        <li><font color="green">YES </font><font>Frequent Updates</font>
                        <li>
                        <li><font color="green">YES </font><font>Automatic Token Delivery</font>
                        <li>
                        <li><font color="green">YES </font><font>Provide Tech Support</font>
                        <li>
                        <li><font color="green">YES </font><font>Paypal, Amazon, And BTC Accepted</font>
                        <li>
                     </ul>
                     <a href="https://shoppy.gg/@XbLive" class="btn primary-solid-btn mb-3" target="_blank">Purchase now</a>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md">
               <div class="card primary-bg text-center single-pricing-pack">
                  <div class="card-header py-5 border-0 pricing-header">
                     <div class="h1 text-white text-center mb-0">$<span class="price font-weight-bolder">0</span></div>
                     <span class="h6 text-white">31 Days</span>
                  </div>
                  <div class="card-body">
                     <ul class="list-unstyled text-white text-sm mb-4 pricing-feature-list">
                        <li><font color="green">YES </font><font>Perfect Challenges</font>
                        <li>
                        <li><font color="green">YES </font><font>No KV Mode</font>
                        <li>
                        <li><font color="green">YES </font><font>Fully Custom UI</font>
                        <li>
                        <li><font color="orange">Coming </font><font>COD Cheats</font>
                        <li>
                        <li><font color="orange">Coming </font><font>GTA 5 Menu</font>
                        <li>
                        <li><font color="green">YES </font><font>99% Uptime</font>
                        <li>
                        <li><font color="green">YES </font><font>Frequent Updates</font>
                        <li>
                        <li><font color="green">YES </font><font>Automatic Token Delivery</font>
                        <li>
                        <li><font color="green">YES </font><font>Provide Tech Support</font>
                        <li>
                        <li><font color="green">YES </font><font>Paypal, Amazon, And BTC Accepted</font>
                        <li>
                     </ul>
                     <a href="https://shoppy.gg/@XbLive" class="btn solid-btn mb-3" target="_blank">Purchase now</a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--our pricing packages section end-->
      <!--Discord Widget Start-->
      <section id="contact" class="contact ptb-100 gray-light-bg">
         <iframe #contact src="https://discordapp.com/widget?id=645184151305191448&amp;theme=dark" class="center" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
      </section>
      <!--Discord Widget End-->
      <footer class="footer">
         <div class="container" style="width: 40%">
            <div class="row">
               <div class="col-sm-12">
                  <h3 class="text-center" style="color: #FFF; text-transform: none;font-size: 50px;">xbLive</h3>
                  <hr style="background: white">
                  <div class="copyright-text text-center">
                     <p style="font-size: 20px">Copyright XbLive 2022. All Rights Reserved.</p>
                     <br>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!--jQuery-->
      <script src="js/jquery-3.4.1.min.js"></script>
      <script src="../code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
      <!--Popper js-->
      <script src="js/popper.min.js"></script>
      <!--Bootstrap js-->
      <script src="js/bootstrap.min.js"></script>
      <!--Magnific popup js-->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!--jquery easing js-->
      <script src="js/jquery.easing.min.js"></script>
      <!--owl carousel js-->
      <script src="js/owl.carousel.min.js"></script>
      <!--custom js-->
      <script src="js/scripts.js"></script>
      <script src="../cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <script>
         jQuery(document).ready(function($) {
             $('.counter-up').counterUp({
                 delay: 10,
                 time: 1000
             });
         });
         var par = document.getElementById('par');
         var div = document.getElementById('div');
         var w = 400;
         div.style.width = w + 'px';
         var s = 0;
         function movefunction() {

         par.style.left = s +'px';
         if (s <= 0 - w+1) {
         s = w-1;
         }else {
         s=s-1;
         }
         console.log(div.style.width);
         }


         window.onload = setInterval(movefunction,30);
      </script>
      <script src="../ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      <script src="../cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
      <script>
         //paste this code under the head tag or in a separate js file.
            // Wait for window load
            $(window).load(function() {
               // Animate loader off screen
               $(".se-pre-con").fadeOut("slow");;
            });
      </script>
   </body>


</html>
