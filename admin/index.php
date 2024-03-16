<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['admin'])) header("location: login.php");

$leaderboard = mysqli_query($conn, "SELECT * FROM `users` where points is not null ORDER BY points DESC, lastseen DESC;");
$deptleaderboard = mysqli_query($conn, "SELECT department FROM `users` GROUP BY department");

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="Bhavani/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>SRKR SpellBee Admin</title>

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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

  <!-- Sidebar Starts Here Shiva -->
  <?php include 'header.php'; ?>
  <!-- Sidebar Ends Here Shiva -->

  <!-- Content Starts Here Shiva-->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">


      <!-- Bordered Table -->
      <div class="col-8 col-lg-7 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
          <h5 class="card-header">GAME LEADER BOARD</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered" id="registrationTable">
                <thead>
                  <tr>
                    <th>Rank</th>
                    <th>NAME</th>
                    <th>SCORE</th>
                    <th>Branch</th>
                    <th>Year</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sino = 1;
                  while ($student = mysqli_fetch_assoc($leaderboard)) {
                  ?>
                    <tr>
                      <td> <strong><?php echo $sino ?></strong></td>
                      <td> <strong><?php echo strtoupper($student['player_name']) ?></strong></td>
                      <td><?php echo $student['points'] ?></td>
                      <td><?php echo $student['department'] ?></td>
                      <td>
                        <?php if ($student['place'] == '2027') echo 'First Year';
                        elseif ($student['place'] == '2026') echo 'Second Year';
                        elseif ($student['place'] == '2025') echo 'Third Year';
                        elseif ($student['place'] == '2024') echo 'Fourth Year';
                        ?>
                      </td>
                    </tr>
                  <?php $sino++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-8 col-lg-5 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
          <h5 class="card-header">DEPARTMENT LEADER BOARD</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>DEPARTMENT</th>
                    <th>NAME</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($dept = mysqli_fetch_assoc($deptleaderboard)) {
                    $maxpoints = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `player_name` FROM `users` WHERE department = '{$dept['department']}' ORDER BY `points` DESC, `lastseen` DESC LIMIT 1;"))['player_name'];
                  ?>
                    <tr>
                      <td><?php echo $dept['department'] ?></td>
                      <td> <strong><?php echo strtoupper($maxpoints) ?></strong></td>
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
  <!-- Content Ends Here Shiva -->

  <!-- Footer Starts Here Shiva-->
  <?php include 'footer.php'; ?>
  <!-- Footer Ends Here Shiva-->
  <script>
    $(document).ready(function() {
      // Cache the table rows for better performance
      var rows = $("#registrationTable tr");

      // Bind the input field's keyup event
      $("#searchInput").keyup(function() {
        var searchText = $(this).val().toLowerCase();

        // Iterate through each table row
        rows.each(function() {
          var name = $(this).find("td:nth-child(1)").text().toLowerCase();
          var regno = $(this).find("td:nth-child(2)").text().toLowerCase();
          var department = $(this).find("td:nth-child(3)").text().toLowerCase();

          // Check if the search text matches any of the row data
          if (
            name.includes(searchText) ||
            regno.includes(searchText) ||
            department.includes(searchText)
          ) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      });
    });
  </script>


</body>

</html>