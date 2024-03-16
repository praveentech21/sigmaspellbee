<?php
session_start();
if (!isset($_SESSION['admin']))
  header('location: login.php');
$admin = $_SESSION['admin'];

include 'connect.php';

if (isset($_POST['addnewword'])) {
  $qid = $_POST['qid'];
  $word = $_POST['word'];
  $meaning = $_POST['meaning'];
  $level = $_POST['level'];
  $option1 = $_POST['option1'];
  $option2 = $_POST['option2'];
  $option3 = $_POST['option3'];

  if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `words` WHERE `qid` = '$qid' or `word` = '$word'")) > 0) {
    echo "<script>alert('Question Already Exists');</script>";
  } else {
    // Define the target directory where you want to store the uploaded MP3 files
    $targetDir = '../exam/sounds/machine/';

    // Get the original file name provided by the user
    $fileName = $_FILES['sound']['name'];
    $targetFilePath = $targetDir . $fileName;

    // Check if the file type is MP3
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    if ($fileType == 'mp3') {
      // Upload the file to the specified directory
      if (move_uploaded_file($_FILES['sound']['tmp_name'], $targetFilePath)) {
        $addnewword = $conn->prepare('INSERT INTO `words`(`qid`, `word`, `meaning`, `level`, `option1`, `option2`, `option3`) VALUES (?,?,?,?,?,?,?)');
        $addnewword->bind_param('ississs', $qid, $word, $meaning, $level, $option1, $option2, $option3);
        if ($addnewword->execute()) {
          echo "<script>alert('Word Added Successfully');</script>";
        } else {
          echo "<script>alert('Word Adding Failed');</script>";
        }
      } else {
        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
      }
    } else {
      echo "<script>alert('Sorry!..  Only MP3 files are allowed. Uplode an mp3 file');</script>";
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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">SPELLBEE</span> WORDS</h4>

    <div class="row">


      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">New Word Addition</h5>
            <!-- <small class="text-muted float-end">Default label</small> -->
          </div>
          <div class="card-body">
            <form method="post" action="#" onsubmit="return validateForm();" enctype="multipart/form-data">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="qid">Question ID</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input type="text" name="qid" id="qid" autocomplete="off" class="form-control" placeholder="Question Id" required />
                  </div>
                  <div class="form-text">Question Id File name and questionid must be same</div>
                  <div id="qid-error" class="error"></div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="word">Word</label>
                <div class="col-sm-10">
                  <input type="text" required class="form-control" autocomplete="off" id="word" autofocus name="word" placeholder="Word" />
                </div>
                <div id="word-error" class="error"></div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="meaning">Meaning</label>
                <div class="col-sm-10">
                  <input type="text" required autocomplete="off" class="form-control" id="meaning" name="meaning" placeholder="Meaning" />
                </div>
                <div id="meaning-error" class="error"></div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="sound">Sound</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="sound" name="sound" required />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="level">Level</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <select class="form-select" id="level" name="level" required>
                      <option selected value="">Select Word Level</option>
                      <option value="1">Level 1</option>
                      <option value="2">Level 2</option>
                      <option value="3">Level 3</option>
                      <option value="4">Level 4</option>
                      <option value="5">Level 5</option>
                      <option value="6">Level 6</option>
                      <option value="7">Level 7</option>
                      <option value="8">Level 8</option>
                      <option value="9">Level 9</option>
                      <option value="10">Level 10</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="option1">OPTION 1</label>
                <div class="col-sm-10">
                  <input type="text" required id="option1" autocomplete="off" name="option1" class="form-control phone-mask" placeholder="Options for this words" />
                </div>
                <div id="option1-error" class="error"></div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="option2">OPTION 2</label>
                <div class="col-sm-10">
                  <input type="text" required id="option2" autocomplete="off" name="option2" class="form-control phone-mask" placeholder="Options for this words" />
                </div>
                <div id="option2-error" class="error"></div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="option3">OPTION 3</label>
                <div class="col-sm-10">
                  <input type="text" required id="option3" autocomplete="off" name="option3" class="form-control phone-mask" placeholder="Options for this words" />
                </div>
                <div id="option3-error" class="error"></div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" name="addnewword" class="btn btn-primary">Send</button>
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
      var word = document.getElementById("word").value;
      var meaning = document.getElementById("meaning").value;
      var qid = document.getElementById("qid").value;
      var option1 = document.getElementById("option1").value;
      var option2 = document.getElementById("option2").value;
      var option3 = document.getElementById("option3").value;

      // Clear previous error messages
      document.getElementById("word-error").innerHTML = "";
      document.getElementById("meaning-error").innerHTML = "";
      document.getElementById("qid-error").innerHTML = "";
      document.getElementById("option1-error").innerHTML = "";
      document.getElementById("option2-error").innerHTML = "";
      document.getElementById("option3-error").innerHTML = "";

      // Basic field validation
      var isValid = true;

      if (word === "") {
        document.getElementById("name-error").innerHTML = "Word must be filled out";
        isValid = false;
      }

      if (meaning === "") {
        document.getElementById("meaning-error").innerHTML = "Register Number must be filled out";
        isValid = false;
      }

      if (qid === "") {
        document.getElementById("qid-error").innerHTML = "qid must be filled out";
        isValid = false;
      }
      // qid must be a number
      else if (isNaN(qid)) {
        document.getElementById("qid-error").innerHTML = "qid must be a number";
        isValid = false;
      }

      return isValid; // Form is valid if all validations pass
    }
  </script>


</body>

</html>