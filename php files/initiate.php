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
    <meta name="description" content="Online Canteen Food Ordering System">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Online Canteen Food Ordering System</title>

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/navy-theme.css" rel="stylesheet">

    <style>
        body {
            background-color: #19488b; /* Navy blue from your image */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
            color: #ffffff;
        }

        .landing-container {
            text-align: center;
            padding: 2rem;
            max-width: 500px;
            margin: auto;
        }

        .logo {
            max-width: 220px;   /* Image size enlarged */
            margin-bottom: 2rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .choose-role-text {
            color: #ffffff;
            font-size: 1.15rem;
            margin-bottom: 1.2rem;
            font-weight: 600;
        }

        .welcome-title {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .row {
            display: flex;
            justify-content: center;
            gap: 1.2rem;
            margin-top: 1.5rem;
        }

        .card-option {
            background-color: #ffffff;
            color: #19488b;
            border: none;
            border-radius: 10px;
            width: 190px;
            height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 3px 12px rgba(10,25,47,0.08);
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .card-option:hover {
            transform: translateY(-4px) scale(1.04);
            box-shadow: 0 8px 24px rgba(10,25,47,0.15);
            background-color: #e3eefd;
            color: #19488b;
        }

        .card-icon {
            font-size: 2.4rem;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="landing-container">
        <img src="vit_white.png" alt="Logo" class="logo">
        <div class="choose-role-text">
            Please select your role to proceed
        </div>
        <h1 class="welcome-title">Welcome to Online Canteen Food Ordering System</h1>
        <div class="row">
            <a href="login.php" class="card-option user-card">
                <div class="card-icon">
                    <i class="fa fa-user"></i>
                </div>
                <div class="card-title">
                    Enter as User
                </div>
            </a>
            <a href="admin/index.php" class="card-option admin-card">
                <div class="card-icon">
                    <i class="fa fa-lock"></i>
                </div>
                <div class="card-title">
                    Enter as Admin
                </div>
            </a>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
</body>
</html>
