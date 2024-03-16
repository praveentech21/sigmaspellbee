<?php
session_start();
// Calculation for this Month
if (empty($_SESSION['admin'])) header("location: login.php");
include("connect.php");
if (isset($_POST['getdetails'])) {
  $mobile = $_POST['mobile'];
  if (mysqli_num_rows(mysqli_query($conn, "SELECT pid FROM `users` WHERE `pid` = '$mobile'")) == 0) {
    echo "<script>alert('No such Student found.');</script>";
  } else {
    $setstatus = $conn->prepare("UPDATE `users` SET `status`=1 WHERE `pid` = ?");
    $setstatus->bind_param("s", $mobile);
    $setstatus->execute();

    if ($setstatus->execute()) {
      echo "Update successful."; // Update was successful
    } else {
      echo "Error updating: " . $setstatus->error; // Error occurred
    }
  }
}
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

      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">Enter Student Mobile Number</h5>
          <form action="#" method="post">
            <div class="card-body">
              <div>
                <label for="defaultFormControlInput" class="form-label">Student Mobile Number</label>
                <input type="number" class="form-control" id="defaultFormControlInput" placeholder="905 2727 402" aria-describedby="defaultFormControlHelp" name="mobile" />
              </div>
              <div class="mt-3">
                <button type="submit" name="getdetails" class="btn btn-primary">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- / Content -->

  <!-- Footer -->
  <footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
      <div class="mb-2 mb-md-0">
        ©
        <script>
          document.write(new Date().getFullYear());
        </script>
        , made with ❤️ by
        <a href="https://github.com/praveentech21" target="_blank" class="footer-link fw-bolder">Sai
          Praveen</a>
      </div>

    </div>
  </footer>
  <!-- / Footer -->

  </div>
  <!-- Content wrapper -->
  <?php //include 'fotter.php'; 
  ?>
</body>

</html>