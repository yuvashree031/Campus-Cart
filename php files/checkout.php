<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();

if(empty($_SESSION["user_id"]))
{
    header('location:login.php');
}
else{
    foreach ($_SESSION["cart_item"] as $item)
    {
        $item_total += ($item["price"]*$item["quantity"]);
        
        if($_POST['submit'])
        {
            $SQL="insert into users_orders(u_id,title,quantity,price) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";
            
            mysqli_query($db,$SQL);
            
            // Store order total in session for thankyou.php
            $_SESSION['order_total'] = $item_total;
            
            unset($_SESSION["cart_item"]);
            unset($item["title"]);
            unset($item["quantity"]);
            unset($item["price"]);
            
            // Redirect to thank you page
            header("Location: thankyou.php");
            exit();
        }
    }
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Checkout</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4a6fa5;
            --secondary: #6c757d;
            --success: #28a745;
            --light: #f8f9fa;
            --dark: #343a40;
            --border: #dee2e6;
        }
        
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .modern-header {
            background: linear-gradient(135deg, #4a6fa5 0%, #2c3e50 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand img {
            filter: brightness(0) invert(1);
        }
        
        .nav-link {
            color: rgba(255,255,255,0.85) !important;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: #fff !important;
            transform: translateY(-1px);
        }
        
        .top-links {
            background-color: #fff;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .links .link-item {
            text-align: center;
            position: relative;
        }
        
        .links .link-item:not(:last-child):after {
            content: "→";
            position: absolute;
            right: -10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
            font-size: 18px;
        }
        
        .links .link-item span {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            background-color: #e9ecef;
            color: var(--secondary);
            margin-right: 10px;
            font-weight: bold;
        }
        
        .links .link-item.active span {
            background-color: var(--primary);
            color: white;
        }
        
        .modern-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            padding: 24px;
            margin-bottom: 24px;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
        }
        
        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .cart-item-details {
            flex: 1;
        }
        
        .cart-item-title {
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--dark);
        }
        
        .cart-item-price {
            color: var(--primary);
            font-weight: 600;
        }
        
        .cart-item-quantity {
            background: var(--light);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 14px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }
        
        .summary-row:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 18px;
        }
        
        .pay-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        
        @media (max-width: 768px) {
            .pay-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .pay-card {
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .pay-card:hover {
            border-color: var(--primary);
            background-color: rgba(74, 111, 165, 0.05);
        }
        
        .pay-card input[type="radio"]:checked + .modern-badge {
            background-color: var(--primary);
            color: white;
        }
        
        .modern-badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            background-color: var(--light);
            color: var(--secondary);
        }
        
        .btn-modern {
            background: linear-gradient(135deg, var(--primary) 0%, #3a5980 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            color: white;
        }
        
        .btn-modern-success {
            background: linear-gradient(135deg, var(--success) 0%, #1e7e34 100%);
        }
        
        .place-order-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-left: 4px solid var(--primary);
        }
        
        .modern-footer {
            background: linear-gradient(135deg, #2c3e50 0%, #1a2530 100%);
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }
        
        .modern-footer h5 {
            color: #fff;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .modern-footer p {
            color: rgba(255,255,255,0.8);
        }
        
        .payment-options img {
            height: 30px;
            margin-right: 10px;
            margin-bottom: 10px;
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        
        .payment-options img:hover {
            opacity: 1;
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modern-spinner {
            width: 2rem;
            height: 2rem;
            border: 3px solid rgba(74, 111, 165, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }
        
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
        
        .items-container {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        
        .section-title {
            position: relative;
            padding-bottom: 12px;
            margin-bottom: 24px;
            color: var(--dark);
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary);
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="site-wrapper">
        <header class="modern-header">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="index.php"> <img src="vit_white.png" alt="VIT Logo" height="40"> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse" aria-controls="mainNavbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNavbarCollapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"> <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="restaurants.php"><i class="fa fa-cutlery"></i> Restaurants</a> </li>
                            
                            <?php
                                if(empty($_SESSION["user_id"])) {
                                    echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                                    <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                                } else {
                                    echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                                    echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Order and Pay</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="container m-t-30 checkout">
                <form action="" method="post" id="checkoutForm">
                    <div class="row">
                        <div class="col-lg-8 col-md-7">
                            <div class="modern-card fade-in-up">
                                <h4 class="section-title">Order Summary</h4>
                                
                                <div class="items-container">
                                    <?php
                                    if(!empty($_SESSION["cart_item"])) {
                                        foreach ($_SESSION["cart_item"] as $item) {
                                    ?>
                                    <div class="cart-item">
                                        <div class="cart-item-details">
                                            <div class="cart-item-title"><?php echo $item["title"]; ?></div>
                                            <div class="cart-item-price">₹<?php echo $item["price"]; ?></div>
                                        </div>
                                        <div class="cart-item-quantity">
                                            Qty: <?php echo $item["quantity"]; ?>
                                        </div>
                                    </div>
                                    <?php 
                                        } 
                                    } else {
                                        echo '<div class="text-center p-4">Your cart is empty</div>';
                                    }
                                    ?>
                                </div>
                                
                                <div class="summary-row">
                                    <span>Cart Subtotal</span>
                                    <span><strong>₹<?php echo $item_total; ?></strong></span>
                                </div>
                                <div class="summary-row">
                                    <span>Delivery Charges</span>
                                    <span><strong>Free</strong></span>
                                </div>
                                <div class="summary-row">
                                    <span>Total</span>
                                    <span class="text-primary"><strong>₹<?php echo $item_total; ?></strong></span>
                                </div>
                            </div>

                            <div class="modern-card fade-in-up">
                                <h5 class="section-title">Payment Method</h5>
                                <div class="pay-grid">
                                    <div>
                                        <label class="pay-card" data-pay-card>
                                            <input type="radio" name="mod" value="COD" class="d-none" checked>
                                            <span class="modern-badge">COD</span>
                                            <span>Cash on Delivery</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="pay-card disabled" style="opacity:.6; cursor:not-allowed;">
                                            <input type="radio" name="mod" value="paypal" class="d-none" disabled>
                                            <img src="images/paypal.jpg" alt="PayPal" width="70" style="margin-right: 10px;">
                                            <span>PayPal (coming soon)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-5 mt-3 mt-md-0">
                            <div class="modern-card place-order-card fade-in-up">
                                <h5 class="mb-3">Place Order</h5>
                                <p class="text-muted mb-3">Free delivery. Secure payment when your order arrives.</p>
                                <button type="submit" name="submit" class="btn-modern btn-modern-success w-100" id="placeOrderBtn">
                                    <span class="btn-label">Order Now - ₹<?php echo $item_total; ?></span>
                                </button>
                                <div class="text-center mt-2" id="orderSpinner" style="display:none;">
                                    <div class="modern-spinner"></div>
                                    <small class="text-muted d-block mt-2">Placing your order...</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
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
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    <script>
        $(document).ready(function() {
            // Form submission handling
            $('#checkoutForm').on('submit', function() {
                $('#placeOrderBtn').prop('disabled', true);
                $('#orderSpinner').show();
            });
            
            // Payment method selection
            $('[data-pay-card]').on('click', function() {
                $('.pay-card').removeClass('active');
                $(this).addClass('active');
                $(this).find('input[type="radio"]').prop('checked', true);
            });
        });
    </script>
</body>
</html>

<?php
}
?>