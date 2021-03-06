<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
     <head>
          <title><?= APP_NAME ?> | Error - 404</title>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon">
          <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon">
          <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
          <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/fontawesome.css') ?>">
          <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/icofont.css') ?>">
          <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/themify.css') ?>">
          <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/flag-icon.css') ?>">
          <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/feather-icon.css') ?>">
          <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css') ?>">
          <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css') ?>">
          <link id="color" rel="stylesheet" href="<?= base_url('assets/css/light-1.css') ?>" media="screen">
          <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/responsive.css') ?>">
     </head>
     <body>
          <div class="loader-wrapper">
               <div class="loader bg-white">
               <div class="whirly-loader"> </div>
               </div>
          </div>
          <div class="page-wrapper">
               <div class="error-wrapper">
                    <div class="container">
                         <img class="img-100" src="<?= base_url('assets/images/sad.png') ?>" alt="">
                         <div class="error-heading">
                              <h2 class="headline font-danger">404</h2>
                         </div>
                         <div class="col-md-8 offset-md-2">
                              <p class="sub-content">The page you are attempting to reach is currently not available. This may be because the page does not exist or has been moved.</p>
                         </div>
                         <div><a class="btn btn-danger-gradien btn-lg" href="<?= base_url() ?>">BACK TO HOME PAGE</a></div>
                    </div>
               </div>
          </div>
          <script src="<?= base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
          <script src="<?= base_url('assets/js/bootstrap/popper.min.js') ?>"></script>
          <script src="<?= base_url('assets/js/bootstrap/bootstrap.js') ?>"></script>
          <script src="<?= base_url('assets/js/icons/feather-icon/feather.min.js') ?>"></script>
          <script src="<?= base_url('assets/js/icons/feather-icon/feather-icon.js') ?>"></script>
          <script src="<?= base_url('assets/js/sidebar-menu.js') ?>"></script>
          <script src="<?= base_url('assets/js/config.js') ?>"></script>
          <script src="<?= base_url('assets/js/script.js') ?>"></script>
     </body>
</html>