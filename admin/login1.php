<?php

session_start();

include("connect.php");



if(!empty($_SESSION['admin'])){

  header("location: index.php");

}

if(isset($_POST['submit'])){

  $admin=$_POST['admin'];

  $pass=$_POST['pass'];

  if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `admins` WHERE `mobile`='$admin' AND `password`='$pass'")) ==1){

    $_SESSION['admin']=$admin;

    header("location: index.php");

  }

    else{

      echo "<script>alert('This is Not For You')</script>";

    }

}



?><!DOCTYPE html>

<html

  lang="en"

  class="light-style customizer-hide"

  dir="ltr"

  data-theme="theme-default"

  data-assets-path="Bhavani/"

  data-template="vertical-menu-template-free"

>

  <head>

      <meta charset="utf-8" />

      <meta

        name="viewport"

        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"

      />



      <title>SpellBee SRKR Admin</title>



      <meta name="description" content="" />



      <!-- Favicon -->

      <link rel="icon" type="image/x-icon" href="Bhavani/img/cup.png" />



      <!-- Fonts -->

      <link rel="preconnect" href="https://fonts.googleapis.com" />

      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

      <link

        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"

        rel="stylesheet"

      />



      <!-- Icons. Uncomment required icon fonts -->

      <link rel="stylesheet" href="Bhavani/vendor/fonts/boxicons.css" />



      <!-- Core CSS -->

      <link rel="stylesheet" href="Bhavani/vendor/css/core.css" class="template-customizer-core-css" />

      <link rel="stylesheet" href="Bhavani/vendor/css/theme-default.css" class="template-customizer-theme-css" />

      <link rel="stylesheet" href="Bhavani/css/demo.css" />



      <!-- Vendors CSS -->

      <link rel="stylesheet" href="Bhavani/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />



      <!-- Page CSS -->

      <!-- Page -->

      <link rel="stylesheet" href="Bhavani/vendor/css/pages/page-auth.css" />

      <!-- Helpers -->

      <script src="Bhavani/vendor/js/helpers.js"></script>



      <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

      <script src="Bhavani/js/config.js"></script>

  </head>



  <body>

    <!-- Content -->



    <div class="container-xxl">

      <div class="authentication-wrapper authentication-basic container-p-y">

        <div class="authentication-inner">

          <!-- Register -->

          <div class="card">

            <div class="card-body">

              <!-- Logo -->

              <div class="app-brand justify-content-center">

                <a href="index.html" class="app-brand-link gap-2">

                  <span class="app-brand-text demo text-body fw-bolder">SPELLBEE ADMIN</span>

                </a>

              </div>

              <!-- /Logo -->

              <form id="formAuthentication" class="mb-3" action="#" method="POST">

                <div class="mb-3 form-password-toggle">

                <div class="d-flex justify-content-between">

                    <label class="form-label" for="password">Admin Mobile Number</label>

                  </div>

                  <div class="input-group input-group-merge">

                    <input

                      type="text"

                      id="password"

                      class="form-control"

                      autocomplete="off"

                      name="admin"

                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"

                      aria-describedby="password"

                    />

                  </div>

                  <div class="d-flex justify-content-between">

                    <label class="form-label" for="password">Password</label>

                  </div>

                  <div class="input-group input-group-merge">

                    <input

                      type="password"

                      id="password"

                      class="form-control"

                      autocomplete="off"

                      name="pass"

                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"

                      aria-describedby="password"

                    />

                  </div>

                </div>

                <div class="mb-3">

                  <button class="btn btn-primary d-grid w-100" name="submit" type="submit">Sign in</button>

                </div>

              </form>



            </div>

          </div>

          <!-- /Register -->

        </div>

      </div>

    </div>



    <!-- / Content -->





    <!-- Core JS -->

    <!-- build:js assets/vendor/js/core.js -->

    <script src="Bhavani/vendor/libs/jquery/jquery.js"></script>

    <script src="Bhavani/vendor/libs/popper/popper.js"></script>

    <script src="Bhavani/vendor/js/bootstrap.js"></script>

    <script src="Bhavani/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>



    <script src="Bhavani/vendor/js/menu.js"></script>

    <!-- endbuild -->



    <!-- Vendors JS -->



    <!-- Main JS -->

    <script src="Bhavani/js/main.js"></script>



    <!-- Page JS -->



    <!-- Place this tag in your head or just before your close body tag. -->

    <script async defer src="https://buttons.github.io/buttons.js"></script>

  </body>

</html>

