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
    <title>VIT Online Canteen</title>

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/modern-minimal.css" rel="stylesheet"> 

    <style>
        /* Added consistent button styling and animations */
        .btn-modern,
        .btn-modern-outline {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        /* Make Popular Dishes button same style as Browse Restaurants */
        .btn-modern-outline {
            /* Override outline style to match btn-modern */
            background-color: #19488b; /* Navy blue */
            color: white !important;
            border: none;
            padding-left: 1.3rem;
            padding-right: 1.3rem;
        }

        /* Hover effect: darken and scale up */
        .btn-modern:hover,
        .btn-modern-outline:hover {
            background-color: #0a3a65 !important;
            color: white !important;
            transform: scale(1.05);
            text-decoration: none;
        }

        /* Click (active) effect: scale down briefly */
        .btn-modern:active,
        .btn-modern-outline:active {
            transform: scale(0.95);
            transition: transform 0.1s ease;
        }
    </style>
</head>

<body class="home">
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
                        <li class="nav-item"> 
                            <a class="nav-link active" href="index.php">
                                <i class="fa fa-home"></i> Home
                            </a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" href="restaurants.php">
                                <i class="fa fa-cutlery"></i> Restaurants
                            </a> 
                        </li>
                        
                        <?php
                        if(empty($_SESSION["user_id"])) {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link"><i class="fa fa-sign-in"></i> Login</a></li>
                                  <li class="nav-item"><a href="registration.php" class="nav-link"><i class="fa fa-user-plus"></i> Register</a></li>';
                        } else {
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link"><i class="fa fa-shopping-bag"></i> My Orders</a></li>';
                            echo '<li class="nav-item"><a href="logout.php" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- MODERN HERO -->
    <section class="modern-hero">
        <div class="container text-center">
            <div class="fade-in-up">
                <h1>Order Delicious Food Online</h1>
                <p class="lead">Experience the best food delivery service from VIT's finest Canteens. Quick, easy, and delicious meals delivered right to your doorstep.</p>
                <div class="mt-4">
                    <a href="restaurants.php" class="btn-modern btn-modern-lg">
                        <i class="fa fa-cutlery"></i> Browse Restaurants
                    </a>
                    <a href="#popular-dishes" class="btn-modern btn-modern-lg ml-3">
                        <i class="fa fa-star"></i> Popular Dishes
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- POPULAR DISHES -->
    <section id="popular-dishes" class="modern-section">
        <div class="container">
            <div class="modern-section-title">
                <h2>Popular Dishes</h2>
                <p>Discover the most loved dishes from VIT's finest restaurants. Fresh, delicious, and delivered fast.</p>
            </div>
            <div class="row">
                <?php                   
                $query_res= mysqli_query($db,"SELECT * FROM dishes LIMIT 6"); 
                while($r=mysqli_fetch_array($query_res)) {
                    echo '<div class="col-lg-4 col-md-6 mb-4">
                            <div class="modern-card">
                                <img src="admin/Res_img/dishes/'.$r['img'].'" alt="'.$r['title'].'" class="img-fluid">
                                <div class="card-content">
                                    <h5><a href="dishes.php?res_id='.$r['rs_id'].'" class="text-decoration-none">'.$r['title'].'</a></h5>
                                    <p class="text-muted">'.$r['slogan'].'</p>
                                    <div class="d-flex justify-content-between align-items-center"> 
                                        <span class="price">₹'.$r['price'].'</span> 
                                        <a href="dishes.php?res_id='.$r['rs_id'].'" class="btn-modern">
                                            <i class="fa fa-shopping-cart"></i> Order Now
                                        </a> 
                                    </div>
                                </div>
                            </div>
                        </div>';                                                
                }   
                ?>
            </div>
        </div>
    </section>

    <!-- FEATURED RESTAURANTS -->
    <section class="modern-section" style="background: white;">
        <div class="container">
            <div class="modern-section-title">
                <h2>Featured Restaurants</h2>
                <p>Explore our carefully selected restaurants offering the best cuisine and dining experience.</p>
            </div>
            
            <!-- Restaurant categories filter -->
            <div class="text-center mb-4">
                <div class="btn-group" role="group">
                    <button type="button" class="filter-btn selected" data-filter="*">All</button>
                    <?php 
                    $res= mysqli_query($db,"SELECT * FROM res_category");
                    while($row=mysqli_fetch_array($res)) {
                        echo '<button type="button" class="filter-btn" data-filter=".'.$row['c_name'].'">'.$row['c_name'].'</button>';
                    }
                    ?>
                </div>
            </div>

            <!-- Restaurant listing -->
            <div class="row restaurant-listing">
                <?php  
                $ress= mysqli_query($db,"SELECT * FROM restaurant");  
                while($rows=mysqli_fetch_array($ress)) {
                    $query= mysqli_query($db,"SELECT * FROM res_category WHERE c_id='".$rows['c_id']."' ");
                    $rowss=mysqli_fetch_array($query);
                    echo '<div class="col-lg-6 col-md-6 mb-4 single-restaurant all '.$rowss['c_name'].'">
                            <div class="modern-card">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <a href="dishes.php?res_id='.$rows['rs_id'].'">
                                            <img src="admin/Res_img/'.$rows['image'].'" alt="'.$rows['title'].'" class="img-fluid rounded" style="height: 80px; width: 80px; object-fit: cover;"> 
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="mb-1"><a href="dishes.php?res_id='.$rows['rs_id'].'" class="text-decoration-none">'.$rows['title'].'</a></h5> 
                                        <p class="text-muted mb-2"><i class="fa fa-map-marker"></i> '.$rows['address'].'</p>
                                        <a href="dishes.php?res_id='.$rows['rs_id'].'" class="view-menu-btn">
                                            <i class="fa fa-eye"></i> View Menu
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                ?>
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
                    <p>Experience the best food delivery service. Fresh, delicious meals delivered fast to your doorstep.</p>
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

    <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    <script src="js/nav-fix.js"></script>
</body>
</html>
