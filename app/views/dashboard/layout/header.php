<?php
if (!isset($_SESSION["user"])) {
   header('Location: ' . BASEURL . 'ryu');
   exit;
} ?>
<?php @include('navbar-name.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Bootstrap v5 CSS -->
   <link rel="stylesheet" href="<?= BASEURL; ?>public/Vendor/Bootstrap5/css/bootstrap.min.css">
   <!-- CSS -->
   <link rel="stylesheet" href="<?= BASEURL; ?>public/css/main.css">
   <link rel="stylesheet" href="<?= BASEURL; ?>public/Vendor/InSketch/css/bland.css">
   <!-- Icons -->
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   <!-- favicon -->
   <link rel="apple-touch-icon" sizes="180x180" href="<?= BASEURL; ?>public/favicon/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="<?= BASEURL; ?>public/favicon/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="<?= BASEURL; ?>public/favicon/favicon-16x16.png">
   <link rel="manifest" href="<?= BASEURL; ?>public/favicon/site.webmanifest">
   <!-- title -->
   <title><?= $data['title']; ?></title>
</head>

<body>
   <?php @include('bottomNavigation.php') ?>
   <?php @include('sidebar.php') ?>
   <section id="main">
      <header id="header" class="d-flex justify-content-between align-content-center">
         <div class="d-flex">
            <i class="m-auto uil uil-bars sidebar-toggle"></i>
            <span id="title" class="ms-sm-3 m-auto fs-5"><?= $data['title']; ?></span>
         </div>
         <div class="btn-group">
            <img data-bs-toggle="dropdown" aria-expanded="false" src="<?= BASEURL; ?>public/user_profile/<?= $_SESSION['user']["profile"]; ?>" alt="">
            <ul class="dropdown-menu">
               <li><a class="dropdown-item" href="#">Profile</a></li>
               <li><a class="dropdown-item" href="<?= BASEURL . 'dashboard/' . $Setting['link']; ?>"><?= $Setting['name']; ?></a></li>
               <li><a class="dropdown-item" href="<?= BASEURL . 'dashboard/' . $Wallets['link']; ?>"><?= $Wallets['name']; ?></a></li>
               <li>
                  <hr class="dropdown-divider">
               </li>
               <li>
                  <div class="dropdown-item d-flex align-items-center gap-2 mode-toggle" style="cursor: pointer;">
                     <i class="uil uil-moon thames-icon"></i>
                     <span class="link-name thames-name">Dark Mode</span>
                  </div>
                  <div class="dropdown-item d-flex align-items-center gap-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#Logout">
                     <i class="uil uil-signout"></i>
                     <span class="link-name">Logout</span>
                  </div>
               </li>
            </ul>
         </div>
      </header>
      <main id="dashboard">