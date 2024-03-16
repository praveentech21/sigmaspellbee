<?php

session_start();
if (!isset($_SESSION['admin'])) header("location: login.php");

include 'connect.php';
$date = date('Y-m-d');
$csd = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'CSD' "));
$csbs = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'CSBS' "));
$cse = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'CSE' "));
$it = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'IT' "));
$cic = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'CIC' "));
$cseiot = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'CSIT' "));
$civil = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'CIVIL' "));
$ece = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'ECE' "));
$eee = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'EEE' "));
$mech = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'MECH' "));
$aids = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'AIDS' "));
$aiml = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = 'AIML' "));

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="Bhavani/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Spell Bee Champ SRKR</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="Bhavani/img/cup.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="Bhavani/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="Bhavani/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="Bhavani/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="Bhavani/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="Bhavani/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="Bhavani/vendor/libs/apex-charts/apex-charts.css" />

  <script src="Bhavani/vendor/js/helpers.js"></script>

  <script src="Bhavani/js/config.js"></script>
</head>

<body>

  <!-- Sidebar Starts Here Shiva -->
  <?php include 'header.php'; ?>
  <!-- Sidebar Ends Here Shiva -->

  <!-- Content Starts Here Shiva-->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

      <!-- Today Delivary Agent Report Starts Here Shiva -->
      <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
          <h5 class="card-header">Today Game Status</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <?php
                    $todaygames = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `responses` WHERE DATE(`timestamp`) = '$date' GROUP BY `sid` ")); ?>
                    <th>Number of Games</th>
                    <th><?php echo $todaygames ?></th>
                  </tr>
                  <tr>
                    <?php
                    $retakes = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE DATE(`lastseen`) = '$date' and `payment_status` >1 ")); ?>
                    <th>No of Retakes</th>
                    <th><?php echo $retakes ?></th>
                  </tr>
                  <tr>
                    <?php $today_first_years = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE DATE(`lastseen`) = '$date' and `place` = 2027")); ?>
                    <th>FIRST YEAR </th>
                    <th><?php echo $today_first_years ?></th>
                  </tr>
                  <tr>
                    <?php $today_second_years = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE DATE(`lastseen`) = '$date' and `place` = 2026")); ?>
                    <th>SECOND YEAR </th>
                    <th><?php echo $today_second_years ?></th>
                  </tr>
                  <tr>
                    <?php $today_third_years = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE DATE(`lastseen`) = '$date' and `place` = 2025")); ?>
                    <th>THIRD YEAR </th>
                    <th><?php echo $today_third_years ?></th>
                  </tr>
                  <tr>
                    <?php $today_fourth_years = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE DATE(`lastseen`) = '$date' and `place` = 2024")); ?>
                    <th>FOURTH YEAR </th>
                    <th><?php echo $today_fourth_years ?></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--/ Today Delivary Agent Report Ends Here Shiva -->
      <!-- Data Cards Here Shiva -->
      <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <span class="d-block mb-1">Total Register </span>
                <h3 class="card-title text-nowrap mb-2"> <?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM `users` "))['total']; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <span class="d-block mb-1">Total Played </span>
                <h3 class="card-title text-nowrap mb-2"> <?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM `users` WHERE `points` IS NOT NULL "))['total']; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <span class="d-block mb-1">Needs to play </span>
                <h3 class="card-title text-nowrap mb-2"> <?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM `users` WHERE `points` IS NULL "))['total']; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <span class="d-block mb-1">Higest Score</span>
                <h3 class="card-title text-nowrap mb-2"> <?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(`points`) as total FROM `users`"))['total']; ?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Data Cards Here Shiva -->


    </div>
    <div class="row">
      <!-- Today Delivary Agent Report Starts Here Shiva -->
      <div class="col-6 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
          <h5 class="card-header">Department Status</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>COMPUTER SCIENCE AND DESIGN</th>
                    <th><?php echo $csd ?></th>
                  </tr>
                  <tr>
                    <th>COMPUTER SCIENCE AND BUSSINESS SYSTEMS </th>
                    <th><?php echo $csbs ?></th>
                  </tr>
                  <tr>
                    <th>COMPUTER SCIENCE AND ENGINEERING </th>
                    <th><?php echo $cse ?></th>
                  </tr>
                  <tr>
                    <th>INFORMATION TECHNOLOGY </th>
                    <th><?php echo $it ?></th>
                  </tr>
                  <tr>
                    <th>CSE INFORMATION TECHNOLOGY </th>
                    <th><?php echo $cic ?></th>
                  </tr>
                  <tr>
                    <th>CSE CYBER SECURITY IOT, BLOCK CHAIN </th>
                    <th><?php echo $cseiot ?></th>
                  </tr>
                  <tr>
                    <th>CIVIL ENGINEERING</th>
                    <th><?php echo $civil ?></th>
                  </tr>
                  <tr>
                    <th>Electronics and Communications Engineering </th>
                    <th><?php echo $ece ?></th>
                  </tr>
                  <tr>
                    <th>Electrical and Electronics Engineering </th>
                    <th><?php echo $eee ?></th>
                  </tr>
                  <tr>
                    <th>mechanical Engineering </th>
                    <th><?php echo $mech ?></th>
                  </tr>
                  <tr>
                    <th>AIDArtificial Intelligence and Data ScienceS </th>
                    <th><?php echo $aids ?></th>
                  </tr>
                  <tr>
                    <th>Artificial Intelligence & Machine Learning </th>
                    <th><?php echo $aiml ?></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--/ Today Delivary Agent Report Ends Here Shiva -->
      <!-- Subscribed Parents -->
      <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
          <div class="col-12 mb-4">
            <div class="card">
              <h5 class="card-header">Section Wise Reistrations</h5>
              <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>SECTION</th>
                        <th>students Registered</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $subscribed_parents = mysqli_query($conn, "SELECT `department` FROM `users` GROUP BY`department`");
                      while ($row = mysqli_fetch_assoc($subscribed_parents)) {
                        $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as players,`section` FROM `users` WHERE `department` = '$row[department]' GROUP BY`section`"));
                      ?>
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                            <strong><?php echo $row['department'] . '_' . $section['section'] ?></strong>
                          </td>
                          <td><?php echo $section['players'] ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Subscribed Parents -->
      <hr>
      <?php if($_SESSION['category'] == 'superadmin'){ ?>
      <!-- Super Admin Access starts Hear -->

      <!-- Today Delivary Agent Report Starts Here Shiva -->
      <div class="card">
        <h5 class="card-header">Today Stall Wise Status</h5>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Team Name</th>
                  <th>Lead</th>
                  <th>Place</th>
                  <th>NO of registrations</th>
                  <th>NO of Payment Confirmations</th>
                  <th>No of Game Confirmations</th>
                  <th>No of Replays</th>
                  <th>Todat amount Collected</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $admindetails = mysqli_query($conn, "SELECT * FROM `admins`");
                while ($aboutadmin = mysqli_fetch_assoc($admindetails)) {
                  
                  ?>

                  <tr>
                    <th><?php echo $aboutadmin['team_name'] ?></th>
                    <th><?php echo $aboutadmin['admin_name'] ?></th>
                    <th><?php echo $aboutadmin['stall_area'] ?></th>
                    <th><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT `pid` FROM `users` WHERE date(`lastseen`) = '$date' AND admin = '{$aboutadmin['mobile']}'"))?></th>
                    <th><?php echo $tdpcf = mysqli_num_rows(mysqli_query($conn,"SELECT `pid` FROM `users` WHERE date(`lastseen`) = '$date' AND `pconfprby` = '{$aboutadmin['mobile']}'")) ?></th>
                    <th><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT `pid` FROM `users` WHERE date(`lastseen`) = '$date' AND `gameconfby` = '{$aboutadmin['mobile']}'")) ?></th>
                    <th><?php echo $tdrepl = mysqli_num_rows(mysqli_query($conn,"SELECT `pid` FROM `replay` WHERE date(`date`) = '$date' and `confby` = '{$aboutadmin['mobile']}'")) ?></th>
                    <th><?php echo ($tdpcf * 20) + ($tdrepl * 10) ?></th>
                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--/ Today Delivary Agent Report Ends Here Shiva -->

      <!-- Super Admin Access Ends Hear -->
      <br><br>
      <hr>

            <!-- Today Delivary Agent Report Starts Here Shiva -->
            <div class="card">
        <h5 class="card-header">Overall Stall Wise Status</h5>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Team Name</th>
                  <th>Lead</th>
                  <th>Place</th>
                  <th>NO of registrations</th>
                  <th>NO of Payment Confirmations</th>
                  <th>No of Game Confirmations</th>
                  <th>No of Replays</th>
                  <th>Todat amount Collected</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $admindetails = mysqli_query($conn, "SELECT * FROM `admins`");
                while ($aboutadmin = mysqli_fetch_assoc($admindetails)) {
                  
                  ?>

                  <tr>
                    <th><?php echo $aboutadmin['team_name'] ?></th>
                    <th><?php echo $aboutadmin['admin_name'] ?></th>
                    <th><?php echo $aboutadmin['stall_area'] ?></th>
                    <th><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT `pid` FROM `users` WHERE admin = '{$aboutadmin['mobile']}'"))?></th>
                    <th><?php echo $tdpcf = mysqli_num_rows(mysqli_query($conn,"SELECT `pid` FROM `users` WHERE `pconfprby` = '{$aboutadmin['mobile']}'")) ?></th>
                    <th><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT `pid` FROM `users` WHERE `gameconfby` = '{$aboutadmin['mobile']}'")) ?></th>
                    <th><?php echo $tdrepl = mysqli_num_rows(mysqli_query($conn,"SELECT `pid` FROM `replay` WHERE `confby` = '{$aboutadmin['mobile']}'")) ?></th>
                    <th><?php echo ($tdpcf * 20) + ($tdrepl * 10) ?></th>
                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--/ Today Delivary Agent Report Ends Here Shiva -->

      <!-- Super Admin Access Ends Hear -->
      <br><br>
      <hr>
      <?php } ?>

    </div>
  </div>
  <!-- Content Ends Here Shiva -->

  <!-- Footer Starts Here Shiva-->
  <?php include 'footer.php'; ?>
  <!-- Footer Ends Here Shiva-->

</body>

</html>