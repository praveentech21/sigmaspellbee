<?php
session_start();
if (!isset($_SESSION['admin'])) header("location: login.php");
$admin = $_SESSION['admin'];

include "connect.php";

if (isset($_POST['addnewstudent'])) {
  $sname = $_POST['sname'];
  $regno = $_POST['regno'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $branch = $_POST['branch'];
  $section = $_POST['section'];
  if (isset($_POST['paymentinfo'])) $paymentinfo = 1;
  else $paymentinfo = 0;
  if (isset($_POST['gamestatus']) and isset($_POST['paymentinfo'])) $gamestatus = 1;
  else $gamestatus = 0;
  $batch = $_POST['batch'];
  if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `pid` = '$mobile' or `regno` = '$regno'")) > 0) {
    echo "<script>alert('Student Already Registered');</script>";
  } else {
    if ($paymentinfo == 1) {
      $addnewstudent = $conn->prepare("INSERT INTO `users`(`pid`, `player_name`,`status` ,`place`, `regno`, `email`, `department`, `section`, `payment_status`,`admin`,`pconfprby`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
      $addnewstudent->bind_param("ssiissssiss", $mobile, $sname, $gamestatus, $batch, $regno, $email, $branch, $section, $paymentinfo, $admin,$admin);
    } else {
      $addnewstudent = $conn->prepare("INSERT INTO `users`(`pid`, `player_name`,`status` ,`place`, `regno`, `email`, `department`, `section`, `payment_status`,`admin`) VALUES (?,?,?,?,?,?,?,?,?,?)");
      $addnewstudent->bind_param("ssiissssis", $mobile, $sname, $gamestatus, $batch, $regno, $email, $branch, $section, $paymentinfo,$admin);
    }
    if ($addnewstudent->execute()) {
      echo "<script>alert('New Student Added Successfully');</script>";
    } else {
      echo "<script>alert('You are already Registered');</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="Bhavani/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Campus Online Admin</title>

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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">SPELLBEE</span> REGISTRATIONS</h4>

    <div class="row">


      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">New Student Registration</h5>
            <!-- <small class="text-muted float-end">Default label</small> -->
          </div>
          <div class="card-body">
            <form method="post" action="#" onsubmit="return validateForm();">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="sname">Name</label>
                <div class="col-sm-10">
                  <input type="text" required class="form-control" autocomplete="off" id="sname" autofocus name="sname" placeholder="Student Name" />
                  <div id="name-error" class="error"></div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="regno">Register Number</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input type="text" required autocomplete="off" class="form-control" id="regno" name="regno" placeholder="student College ID" />
                  </div>
                  <div class="form-text">For Juniours use their dept and remaning are last digits of mobile number must be length 10</div>
                  <div id="regno-error" class="error"></div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="email">Email</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input type="email" name="email" id="email" autocomplete="off" class="form-control" placeholder="Student Email" aria-label="john.doe" aria-describedby="basic-default-email2" required />
                  </div>
                  <div id="email-error" class="error"></div>
                  <div class="form-text">You can use letters, numbers & periods</div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="mobile">Mobile No</label>
                <div class="col-sm-10">
                  <input type="text" id="mobile" autocomplete="off" name="mobile" class="form-control phone-mask" placeholder="905 272 7402" aria-label="905 272 7402" aria-describedby="basic-default-phone" />
                  <div id="mobile-error" class="error"></div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="branch">Branch</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <select class="form-select" id="branch" name="branch" aria-label="Default select example">
                      <option selected value="">Select Student Branch</option>
                      <option value="CSD">CSD</option>
                      <option value="CSE">CSE</option>
                      <option value="CSBS">CSBS</option>
                      <option value="CIC">CIC</option>
                      <option value="CSIT">CSIT</option>
                      <option value="IT">IT</option>
                      <option value="AIDS">AIDS</option>
                      <option value="AIML">AIML</option>
                      <option value="MECH">MECH</option>
                      <option value="CIVIL">CIVIL</option>
                      <option value="ECE">ECE</option>
                      <option value="EEE">EEE</option>
                    </select>
                    <div id="branch-error" class="error"></div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="section">SECTION</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <select class="form-select" id="section" name="section" aria-label="Default select example">
                      <option selected value="">Select Student Section</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                      <option value="E">E</option>
                      <option value="F">F</option>
                    </select>
                    <div id="section-error" class="error"></div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="batch">Batch</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <select class="form-select" id="batch" name="batch" aria-label="Default select example">
                      <option selected value="">Select Student Year</option>
                      <option value="2027">First Year</option>
                      <option value="2026">Second</option>
                      <option value="2025">Third Year</option>
                      <option value="2024">Fourth Year</option>
                    </select>
                    <div id="batch-error" class="error"></div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-10">
                  <input class="form-check-input" type="checkbox" name="paymentinfo" value="1" id="defaultCheck1" />
                  <label class="form-check-label" for="defaultCheck1"> Payment Confirmation </label>
                </div>
                <!-- Error placeholder for payment confirmation -->
                <div id="paymentinfo-error" class="error"></div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-10">
                  <input class="form-check-input" type="checkbox" name="gamestatus" value="1" id="defaultCheck2" />
                  <label class="form-check-label" for="defaultCheck2"> Allow to Play</label>
                  <div id="allowtoplay-error" class="error"></div>
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" name="addnewstudent" class="btn btn-primary">Send</button>
                </div>
              </div>
              <!-- Error placeholders for other fields -->
            </form>
          </div>
        </div>
      </div>
      <!-- Basic with Icons -->

    </div>
  </div>
  <!-- Content Ends Here Shiva -->

  <!-- Footer Starts Here Shiva-->
  <?php include 'footer.php'; ?>
  <!-- Footer Ends Here Shiva-->
  <script>
    function validateForm() {
      // Get form input values
      var name = document.getElementById("sname").value;
      var regno = document.getElementById("regno").value;
      var email = document.getElementById("email").value;
      var mobile = document.getElementById("mobile").value;

      // Clear previous error messages
      document.getElementById("name-error").innerHTML = "";
      document.getElementById("regno-error").innerHTML = "";
      document.getElementById("email-error").innerHTML = "";
      document.getElementById("mobile-error").innerHTML = "";

      document.getElementById('allowtoplay-error').innerHTML = "";

      // Basic field validation
      var isValid = true;

      if (name === "") {
        document.getElementById("name-error").innerHTML = "Name must be filled out";
        isValid = false;
      }

      if (regno === "") {
        document.getElementById("regno-error").innerHTML = "Register Number must be filled out";
        isValid = false;
      } else {
        var regnoPattern = /^\w{10}$/;
        if (!regnoPattern.test(regno)) {
          document.getElementById("regno-error").innerHTML = "Invalid Register Number format";
          isValid = false;
        }

      }

      if (email === "") {
        document.getElementById("email-error").innerHTML = "Email must be filled out";
        isValid = false;
      } else {
        var emailPattern = /.+@.+/;
        if (!emailPattern.test(email)) {
          document.getElementById("email-error").innerHTML = "Invalid Email format";
          isValid = false;
        }
      }

      if (mobile === "") {
        document.getElementById("mobile-error").innerHTML = "Mobile Number must be filled out";
        isValid = false;
      } else {
        var mobilePattern = /^[6-9]\d{9}$/;
        if (!mobilePattern.test(mobile)) {
          document.getElementById("mobile-error").innerHTML = "Invalid Mobile Number format (must be 10 digits)";
          isValid = false;
        }

      }

      return isValid; // Form is valid if all validations pass
    }
  </script>
  <script>
    // Function to validate before allowing "Allow to Play" checkbox
    function validateAllowToPlay() {
      var paymentConfirmationCheckbox = document.getElementById("defaultCheck1");
      var allowToPlayCheckbox = document.getElementById("defaultCheck2");
      var paymentInfoError = document.getElementById("allowtoplay-error");

      // Check if Payment Confirmation checkbox is not selected
      if (!paymentConfirmationCheckbox.checked) {
        paymentInfoError.textContent = "Please confirm payment first.";
        return false; // Prevent checking "Allow to Play" checkbox
      } else {
        paymentInfoError.textContent = ""; // Clear error message
        return true; // Allow checking "Allow to Play" checkbox
      }
    }

    // Attach the validation function to the "Allow to Play" checkbox
    var allowToPlayCheckbox = document.getElementById("defaultCheck2");
    allowToPlayCheckbox.addEventListener("click", validateAllowToPlay);
  </script>



</body>

</html>