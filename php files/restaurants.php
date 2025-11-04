<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Restaurants</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/modern-minimal.css" rel="stylesheet"> 
    </head>

<body>

        <!-- MODERN HEADER -->
        <header class="modern-header">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                        <img src="vit_white.png" alt="VIT Logo" height="40">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse" aria-controls="mainNavbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNavbarCollapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"> <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home</a></li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php"><i class="fa fa-cutlery"></i> Restaurants</a></li>
                            <?php if(empty($_SESSION["user_id"])) {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link"><i class="fa fa-sign-in"></i> Login</a></li>
                                      <li class="nav-item"><a href="registration.php" class="nav-link"><i class="fa fa-user-plus"></i> Register</a></li>';
                            } else {
                                echo '<li class="nav-item"><a href="your_orders.php" class="nav-link"><i class="fa fa-shopping-bag"></i> My Orders</a></li>';
                                echo '<li class="nav-item"><a href="logout.php" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></li>';
                            } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                       
                        <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="#">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                    </ul>
                </div>
            </div>
            <div class="inner-page-hero bg-image" data-image-src="vit.jpg">
                <div class="container"> </div>
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">     
                    </div>
                </div>
            </div>
            <section class="restaurants-page modern-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <?php $ress= mysqli_query($db,"select * from restaurant");
                                      while($rows=mysqli_fetch_array($ress))
                                      {
                                        echo '<div class="col-lg-6 col-md-6 mb-4"><div class="modern-card"><div class="d-flex align-items-center"><a href="dishes.php?res_id='.$rows['rs_id'].'"><img src="admin/Res_img/'.$rows['image'].'" alt="'.$rows['title'].'" style="height:80px;width:80px;object-fit:cover;border-radius:8px;margin-right:16px;"></a><div><h5 class="mb-1"><a class="text-decoration-none" href="dishes.php?res_id='.$rows['rs_id'].'">'.$rows['title'].'</a></h5><p class="text-muted mb-2"><i class="fa fa-map-marker"></i> '.$rows['address'].'</p><a href="dishes.php?res_id='.$rows['rs_id'].'" class="btn-modern btn-sm"><i class="fa fa-eye"></i> View Menu</a></div></div></div></div>';
                                      }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
       
        <!-- MODERN FOOTER -->
        <footer class="modern-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <h5><i class="fa fa-credit-card"></i> Payment Options</h5>
                        <div class="payment-options">
                            <img src="images/paypal.png" alt="Paypal">
                            <img src="images/mastercard.png" alt="Mastercard">
                            <img src="images/maestro.png" alt="Maestro">
                            <img src="images/stripe.png" alt="Stripe">
                            <img src="images/bitcoin.png" alt="Bitcoin">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <h5><i class="fa fa-university"></i> VIT University</h5>
                        <p><i class="fa fa-map-marker"></i> Vellore Campus<br>Vellore - 632 014<br>Tamil Nadu, India</p>
                        <p><i class="fa fa-phone"></i> +91-416-2243091</p>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-4">
                        <h5><i class="fa fa-cutlery"></i> Order & Enjoy</h5>
                        <p>Anything, anytime, anywhere. We deliver it all.</p>
                        <div class="mt-3">
                            <a href="restaurants.php" class="btn-modern">
                                <i class="fa fa-shopping-cart"></i> Start Ordering
                            </a>
                        </div>
                    </div>
                </div>
                <hr style="border-color: #374151; margin: 2rem 0 1rem;">
                <div class="text-center">
                    <p>&copy; 2024 VIT Online Food Ordering System. All rights reserved.</p>
                </div>
            </div>
        </footer>
        
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/nav-fix.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>