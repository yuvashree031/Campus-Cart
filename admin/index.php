<!DOCTYPE html>
<html lang="en" >
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(!empty($_POST["submit"])) 
     {
	$loginquery ="SELECT * FROM admin WHERE username='$username' && password='".md5($password)."'";
	$result=mysqli_query($db, $loginquery);
	$row=mysqli_fetch_array($result);
	
	                        if(is_array($row))
								{
                                    	$_SESSION["adm_id"] = $row['adm_id'];
										header("refresh:1;url=dashboard.php");
	                            } 
							else
							    {
										echo "<script>alert('Invalid Username or Password!');</script>"; 
                                }
	 }
	
	
}

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>VIT Online Canteen</title>

  <!-- CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/modern-minimal.css" rel="stylesheet">

</head>

<body>
  <!-- Modern Admin Login -->
  <div class="modern-auth-container">
    <div class="modern-auth-card fade-in-up">
      <div class="logo text-center">
        <a href="dashboard.php" onclick="return false;">
          <img src="../vit_white.png" alt="VIT Logo" style="height: 50px; filter: brightness(0.2);">
        </a>
      </div>
      <h2><i class="fa fa-lock"></i> Admin Panel</h2>
      <p class="text-center text-muted mb-4">Sign in to manage restaurants, menus, and orders</p>

      <div class="text-center mb-3">
        <img src="images/manager.png" alt="Admin" style="height:64px;width:64px;object-fit:contain;" />
      </div>

      <?php if (isset($message) && $message): ?>
        <div class="modern-alert modern-alert-danger">
          <i class="fa fa-exclamation-circle"></i> <?php echo $message; ?>
        </div>
      <?php endif; ?>
      <?php if (isset($success) && $success): ?>
        <div class="modern-alert modern-alert-success">
          <i class="fa fa-check-circle"></i> <?php echo $success; ?>
        </div>
      <?php endif; ?>

      <form action="index.php" method="post">
        <div class="modern-form-group">
          <label class="modern-form-label"><i class="fa fa-user"></i> Username</label>
          <input type="text" name="username" class="modern-form-input" placeholder="Enter admin username" required />
        </div>
        <div class="modern-form-group">
          <label class="modern-form-label"><i class="fa fa-key"></i> Password</label>
          <input type="password" name="password" class="modern-form-input" placeholder="Enter password" required />
        </div>
        <button type="submit" name="submit" value="Login" class="btn-modern w-100">
          <i class="fa fa-sign-in"></i> Sign In
        </button>
      </form>

      <div class="text-center mt-3">
        <a href="../index.php" class="text-decoration-none text-muted"><i class="fa fa-arrow-left"></i> Back to Website</a>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</body>

</html>
