<!DOCTYPE html>
<html lang="en">
<?php

session_start(); 
error_reporting(0); 
include("connection/connect.php"); 
if(isset($_POST['submit'] )) 
{
     if(empty($_POST['firstname']) || 
   	    empty($_POST['lastname'])|| 
		empty($_POST['email']) ||  
		empty($_POST['phone'])||
		empty($_POST['password'])||
		empty($_POST['cpassword']) ||
		empty($_POST['cpassword']))
		{
			$message = "All fields must be Required!";
		}
	else
	{
	
	$check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");
	$check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");
		

	
	if($_POST['password'] != $_POST['cpassword']){  
       	
          echo "<script>alert('Password not match');</script>"; 
    }
	elseif(strlen($_POST['password']) < 6)  
	{
      echo "<script>alert('Password Must be >=6');</script>"; 
	}
	elseif(strlen($_POST['phone']) < 10)  
	{
      echo "<script>alert('Invalid phone number!');</script>"; 
	}

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
          echo "<script>alert('Invalid email address please type a valid email!');</script>"; 
    }
	elseif(mysqli_num_rows($check_username) > 0) 
     {
       echo "<script>alert('Username Already exists!');</script>"; 
     }
	elseif(mysqli_num_rows($check_email) > 0) 
     {
       echo "<script>alert('Email Already exists!');</script>"; 
     }
	else{
       
	 
	$mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
	mysqli_query($db, $mql);
	
		 header("refresh:0.1;url=login.php");
    }
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
    <title>Registration</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/modern-minimal.css" rel="stylesheet">
    </head>
<body>
<div style=" background-image: url('images/img/pimg.jpg');">
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
                        <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="restaurants.php"><i class="fa fa-cutlery"></i> Restaurants</a></li>
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
            
               <div class="container">
                  <ul>
                    
                    
                  </ul>
               </div>
            
            <section class="contact-page inner-page modern-section">
               <div class="container ">
                  <div class="row ">
                     <div class="col-md-12">
                        <div class="widget" >
                           <div class="modern-form">
                            
                              <div class="modern-section-title" style="margin-top: -1rem;">
                                 <h2>Create your account</h2>
                                 <p>Join us for a fast and delightful food ordering experience.</p>
                              </div>

                              <form action="" method="post">
                                 <div class="row">
                                  <div class="form-group col-sm-12">
                                       <label class="modern-form-label" for="example-text-input">User-Name</label>
                                       <input class="modern-form-input" type="text" name="username" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="modern-form-label" for="example-text-input">First Name</label>
                                       <input class="modern-form-input" type="text" name="firstname" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="modern-form-label" for="example-text-input-2">Last Name</label>
                                       <input class="modern-form-input" type="text" name="lastname" id="example-text-input-2"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="modern-form-label" for="exampleInputEmail1">Email Address</label>
                                       <input type="text" class="modern-form-input" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="modern-form-label" for="example-tel-input-3">Phone number</label>
                                       <input class="modern-form-input" type="text" name="phone" id="example-tel-input-3"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="modern-form-label" for="exampleInputPassword1">Password</label>
                                       <input type="password" class="modern-form-input" name="password" id="exampleInputPassword1"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="modern-form-label" for="exampleInputPassword2">Confirm password</label>
                                       <input type="password" class="modern-form-input" name="cpassword" id="exampleInputPassword2"> 
                                    </div>
                                     <div class="form-group col-sm-12">
                                       <label class="modern-form-label" for="exampleTextarea">Delivery Address</label>
                                       <textarea class="modern-form-input" id="exampleTextarea"  name="address" rows="3"></textarea>
                                    </div>
                                   
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Register" name="submit" class="btn-modern"> </p>
                                    </div>
                                 </div>
                              </form>
                  
						   </div>
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
</body>

</html>