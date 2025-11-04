<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); 
error_reporting(0);
session_start();

include_once 'product-action.php'; 
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Dishes</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/modern-minimal.css" rel="stylesheet">
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
                    if(empty($_SESSION["user_id"]))
                        {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                          <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                        }
                    else
                        {
                            
                            
                            echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                            echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
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
                    <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                    
                </ul>
            </div>
        </div>
        <?php $ress= mysqli_query($db,"select * from restaurant where rs_id='$_GET[res_id]'");
                                         $rows=mysqli_fetch_array($ress);
                                          
                                           ?>
        <section class="inner-page-hero bg-image" data-image-src="images/img/restrrr.png">
            <div class="profile">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                            <div class="image-wrap">
                                <figure><?php echo '<img src="admin/Res_img/'.$rows['image'].'" alt="Restaurant logo">'; ?></figure>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                            <div class="pull-left right-text white-txt">
                                <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                <p><?php echo $rows['address']; ?></p>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="breadcrumb">
            <div class="container">
                
            </div>
        </div>

        <div class="container m-t-30">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

                    <div class="widget widget-cart cart-panel">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                             Your Cart
                         </h3>
                        
                         
                         
                            <div class="clearfix"></div>
                        </div>
                        <div class="order-row bg-white">
                            <div class="widget-body">

                        <?php

                        $item_total = 0;

                        if(!empty($_SESSION["cart_item"])) {
                        foreach ($_SESSION["cart_item"] as $item)   
                        {
                        ?>                        
                        
                        
                                <div class="title-row">
                                    <?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>" >
                                    <i class="fa fa-trash pull-right"></i></a>
                                </div>
                                
                                <div class="form-group row no-gutter">
                                    <div class="col-xs-8">
                                         <input type="text" class="form-control b-r-0" value=<?php echo "₹".$item["price"]; ?> readonly id="exampleSelect1">

                                    </div>
                                    <div class="col-xs-4">
                                       <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> </div>
                                
                                 </div>
                                 
                        <?php
                        $item_total += ($item["price"]*$item["quantity"]); 
                        }
                        }
                        ?>            
                             
                             
                             
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>TOTAL</p>
                                <h3 class="value"><strong><?php echo "₹".$item_total; ?></strong></h3>
                                <p>Free Delivery!</p>
                                <?php
                                if($item_total==0){
                                ?>


                                
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn-modern btn-modern-danger disabled">Checkout</a>

                                <?php
                                }
                                else{   
                                ?>
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn-modern btn-modern-success active w-100">Checkout</a>
                                <?php   
                                }
                                ?>


                            </div>
                        </div>

                    
                    
                    
                    
                    </div>
                </div>

                <div class="col-md-8">

                    <section class="menu-section">
                        <div class="menu-header">
                            <h3 class="h4 m-0 text-dark">Menu</h3>
                            <div class="menu-search">
                                <input type="text" id="menuSearch" placeholder="Search dishes..." aria-label="Search dishes">
                                <span class="icon"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="menu-grid">
                    <?php  
                            $stmt = $db->prepare("select * from dishes where rs_id='$_GET[res_id]'");
                            $stmt->execute();
                            $products = $stmt->get_result();
                            if (!empty($products)) 
                            {
                            foreach($products as $product)
                                {
                        
                                
                                 ?>
                            <form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['d_id']; ?>' class="menu-card" data-title="<?php echo htmlspecialchars(strtolower($product['title'])); ?>" data-slogan="<?php echo htmlspecialchars(strtolower($product['slogan'])); ?>">
                                <div class="thumb">
                                    <?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="'.$product['title'].'">'; ?>
                                </div>
                                <div class="meta">
                                    <h6><?php echo $product['title']; ?></h6>
                                    <p><?php echo $product['slogan']; ?></p>
                                </div>
                                <div class="actions">
                                    <span class="price-badge">₹<?php echo $product['price']; ?></span>
                                    <div class="qty-stepper" data-stepper>
                                        <button type="button" class="btn-step" data-stepper-dec>-</button>
                                        <input class="qty-input" type="text" name="quantity" value="1" />
                                        <button type="button" class="btn-step" data-stepper-inc>+</button>
                                    </div>
                                    <input type="submit" class="btn-modern" value="Add To Cart" />
                                </div>
                            </form>

                            
                            <?php
                                }
                            }
                            
                        ?>
                        
                        
                     
                        </div>
                    </section>
                
                    
                </div>
                
            </div>
        
            <!-- MODERN FOOTER (same as index.php) -->
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
  

 
    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <div class="modal-body cart-addon">
                    ... <!-- Modals content omitted for brevity - keep as before -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add To Cart</button>
                </div>
            </div>
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
    <script src="js/nav-fix.js"></script>
    <script src="js/menu-ui.js"></script>

    <script>
    $(document).ready(function() {
        // Search dishes live filter
        $('#menuSearch').on('input', function() {
            var searchVal = $(this).val().toLowerCase();

            $('.menu-card').each(function() {
                var title = $(this).data('title');
                var slogan = $(this).data('slogan');
                if (title.includes(searchVal) || slogan.includes(searchVal)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Quantity stepper buttons handling
        $('.btn-step').on('click', function() {
            var $button = $(this);
            var $input = $button.siblings('.qty-input');
            var currentVal = parseInt($input.val()) || 1;

            if ($button.attr('data-stepper-inc') !== undefined) {
                $input.val(currentVal + 1);
            }
            if ($button.attr('data-stepper-dec') !== undefined) {
                if(currentVal > 1) {  // prevent quantity less than 1
                    $input.val(currentVal - 1);
                }
            }
        });
    });
    </script>

</body>

</html>
