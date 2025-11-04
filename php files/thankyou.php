<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

// Check if user is logged in
if(empty($_SESSION["user_id"])) {
    header('location:login.php');
    exit();
}

// Get the latest order for the user
$user_id = $_SESSION["user_id"];
$order_query = "SELECT * FROM users_orders WHERE u_id = '$user_id' ORDER BY o_id DESC LIMIT 1";
$order_result = mysqli_query($db, $order_query);
$order = mysqli_fetch_assoc($order_result);

// Get all items from the latest order
$order_id = $order['o_id'];
$order_items_query = "SELECT * FROM users_orders WHERE u_id = '$user_id' AND o_id = '$order_id'";
$order_items_result = mysqli_query($db, $order_items_query);

// Calculate order total
$order_total = 0;
while($item = mysqli_fetch_assoc($order_items_result)) {
    $order_total += ($item['price'] * $item['quantity']);
}

// Store order total in session for display
$_SESSION['order_total'] = $order_total;
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Order | VIT Food Ordering</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
        
        .thank-you-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        
        .thank-you-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            padding: 3rem;
            text-align: center;
            max-width: 700px;
            width: 100%;
            margin: 2rem;
            animation: fadeInUp 0.6s ease-out;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--success) 0%, #1e7e34 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2.5rem;
        }
        
        .thank-you-title {
            color: var(--dark);
            margin-bottom: 1rem;
            font-weight: 700;
        }
        
        .thank-you-message {
            color: var(--secondary);
            margin-bottom: 2rem;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .order-details {
            background: var(--light);
            border-radius: 12px;
            padding: 1.5rem;
            margin: 2rem 0;
            text-align: left;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border);
        }
        
        .detail-row:last-child {
            border-bottom: none;
            font-weight: 700;
            color: var(--primary);
        }
        
        .benefits-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .benefit-card {
            background: var(--light);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.3s;
        }
        
        .benefit-card:hover {
            transform: translateY(-5px);
        }
        
        .benefit-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
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
            display: inline-block;
            margin: 0.5rem;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            color: white;
            text-decoration: none;
        }
        
        .modern-footer {
            background: linear-gradient(135deg, #2c3e50 0%, #1a2530 100%);
            color: white;
            padding: 40px 0 20px;
            margin-top: auto;
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
        
        .countdown {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            margin: 1rem 0;
        }
        
        .order-items {
            margin: 1rem 0;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border);
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        @media (max-width: 768px) {
            .thank-you-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
            
            .benefits-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
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

    <div class="thank-you-container">
        <div class="thank-you-card">
            <div class="success-icon">
                <i class="fa fa-check"></i>
            </div>
            <h1 class="thank-you-title">Thank You for Your Order!</h1>
            <p class="thank-you-message">
                Your order has been successfully placed. Skip the wait times and queues by picking up your food directly from the canteen.
            </p>
            
            <div class="order-details">
                <h4>Order Details</h4>
                <div class="detail-row">
                    <span>Order Number:</span>
                    <span>#<?php echo $order_id; ?></span>
                </div>
                <div class="detail-row">
                    <span>Order Time:</span>
                    <span><?php echo date("h:i A"); ?></span>
                </div>
                <div class="detail-row">
                    <span>Estimated Pickup Time:</span>
                    <span><?php echo date("h:i A", strtotime('+15 minutes')); ?></span>
                </div>
                
                <div class="order-items">
                    <h5>Order Items:</h5>
                    <?php
                    // Reset pointer and loop through order items again
                    mysqli_data_seek($order_items_result, 0);
                    while($item = mysqli_fetch_assoc($order_items_result)) {
                        echo '<div class="order-item">';
                        echo '<span>' . $item['title'] . ' x ' . $item['quantity'] . '</span>';
                        echo '<span>₹' . ($item['price'] * $item['quantity']) . '</span>';
                        echo '</div>';
                    }
                    ?>
                </div>
                
                <div class="detail-row">
                    <span>Total Amount:</span>
                    <span>₹<?php echo $order_total; ?></span>
                </div>
            </div>
            
            <div class="countdown">
                <i class="fa fa-clock-o"></i> Your order will be ready in approximately 15 minutes
            </div>
            
            <h4>Why Order Online?</h4>
            <div class="benefits-container">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fa fa-bolt"></i>
                    </div>
                    <h5>Skip the Queue</h5>
                    <p>No more waiting in long lines during peak hours</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fa fa-cutlery"></i>
                    </div>
                    <h5>Freshly Prepared</h5>
                    <p>Your food is prepared after you order</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fa fa-calendar-check-o"></i>
                    </div>
                    <h5>Plan Ahead</h5>
                    <p>Schedule pickups between your classes</p>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="your_orders.php" class="btn-modern">
                    <i class="fa fa-list-alt"></i> View Your Orders
                </a>
                <a href="restaurants.php" class="btn-modern">
                    <i class="fa fa-utensils"></i> Order Again
                </a>
            </div>
        </div>
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

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Simple countdown animation
            let timeLeft = 15;
            const countdownElement = $('.countdown');
            
            const countdownInterval = setInterval(function() {
                timeLeft--;
                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    countdownElement.html('<i class="fa fa-check-circle"></i> Your order is now ready for pickup!');
                    countdownElement.css('color', '#28a745');
                } else {
                    countdownElement.html('<i class="fa fa-clock-o"></i> Your order will be ready in approximately ' + 
                                         timeLeft + ' minute' + (timeLeft !== 1 ? 's' : ''));
                }
            }, 60000); // Update every minute
        });
    </script>
</body>
</html>