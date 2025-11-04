<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>VIT Online Canteen</title>

  <!-- CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/modern-minimal.css" rel="stylesheet">

</head>

<body>
  <?php
  include("connection/connect.php");
  error_reporting(0);
  session_start();

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginquery = "SELECT * FROM users WHERE username='$username' && password='" . md5($password) . "'";
    $result = mysqli_query($db, $loginquery);
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
      $_SESSION["user_id"] = $row['u_id'];
      header("Location: index.php");
      exit();
    } else {
      $message = "Invalid Username or Password!";
    }
  }
  ?>

  <!-- Modern Login Container -->
  <div class="modern-auth-container">
    <div class="modern-auth-card fade-in-up">
      <!-- Logo -->
      <div class="logo">
        <a href="index.php">
          <img src="vit_white.png" alt="VIT Logo" style="height: 60px; filter: brightness(0.2);">
        </a>
      </div>

      <!-- Login Form -->
      <h2><i class="fa fa-sign-in"></i> Welcome Back</h2>
      <p class="text-center text-muted mb-4">Sign in to your account to continue</p>

      <!-- Alert Messages -->
      <?php if (isset($message)): ?>
        <div class="modern-alert modern-alert-danger">
          <i class="fa fa-exclamation-circle"></i> <?php echo $message; ?>
        </div>
      <?php endif; ?>

      <?php if (isset($success)): ?>
        <div class="modern-alert modern-alert-success">
          <i class="fa fa-check-circle"></i> <?php echo $success; ?>
        </div>
      <?php endif; ?>

      <form action="" method="post">
        <div class="modern-form-group">
          <label class="modern-form-label">
            <i class="fa fa-user"></i> Username
          </label>
          <input type="text" class="modern-form-input" placeholder="Enter your username" name="username" required />
        </div>

        <div class="modern-form-group">
          <label class="modern-form-label">
            <i class="fa fa-lock"></i> Password
          </label>
          <input type="password" class="modern-form-input" placeholder="Enter your password" name="password" required />
        </div>

        <button type="submit" name="submit" class="btn-modern w-100 mb-3">
          <i class="fa fa-sign-in"></i> Sign In
        </button>
      </form>

      <!-- Links -->
      <div class="text-center">
        <p class="text-muted">
          Don't have an account? 
          <a href="registration.php" class="text-decoration-none">
            <i class="fa fa-user-plus"></i> Create Account
          </a>
        </p>
        <p class="mt-3">
          <a href="index.php" class="text-decoration-none text-muted">
            <i class="fa fa-arrow-left"></i> Back to Home
          </a>
        </p>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>
