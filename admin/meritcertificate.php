<?php
session_start();
if (!isset($_SESSION['admin'])) header("location: login.php");

include 'connect.php';

$replayers = mysqli_query($conn, "SELECT * FROM `users` WHERE `points` =3000");

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
    <div class="row">

      <!-- Bordered Table -->
      <div class="card">
        <h5 class="card-header">Merite Certificate</h5>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered" id="registrationTable">
              <thead>
                <tr>
                  <th>NAME</th>
                  <th>REGISTRATION NO</th>
                  <th>DEPARTMENT</th>
                  <th>YEAR</th>
                  <th>Certificate</th>
                  <th>Send</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($replayers)) { ?>
                  <tr>
                    <td><strong><?php echo strtoupper($row['player_name']) ?></strong></td>
                    <td><?php echo strtoupper($row['regno']) ?></td>
                    <td><?php echo $row['department'] ?></td>
                    <td><?php if ($row['place'] == '2027') echo "First Year";
                        elseif ($row['place'] == '2026') echo "Second Year";
                        elseif ($row['place'] == '2025') echo "Third Year";
                        elseif ($row['place'] == '2024') echo "Fourth Year";
                        ?></td>
                    <td><button type="button" name="conformpayment" class="btn rounded-pill btn-primary get-certificate" data-pid="<?php echo $row['pid']; ?>" data-roll="<?php echo $row['regno']; ?>">Certificate</button></td>
                    <td><button type="button" name="conformpayment" class="btn btn-success conform-payment" data-name="<?php echo $row['player_name'] ?>" data-pid="<?php echo $row['pid']; ?>">Whats App</button></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--/ Bordered Table -->

      
    </div>
  </div>
  <!-- Content Ends Here Shiva -->

  <!-- Footer Starts Here Shiva-->
  <?php include 'footer.php'; ?>
  <!-- Footer Ends Here Shiva-->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {
      // Add a click event listener to the buttons with the class "conform-payment"
      $(".get-certificate").click(function() {
        // Get the user ID from the data attribute
        var pid = $(this).data("pid");
        var rolll = $(this).data("roll");

        // Send an AJAX request to update the database
        $.ajax({
          type: "POST",
          url: "certificate/certificate.php", // Replace with the URL of your PHP script
          data: {
            rollno: pid,
          }, // Send the user ID to the server
          success: function(response) {
            // Handle the server response if needed
            console.log("Server Response:", response);


            var link = document.createElement("a");

            // Set the href attribute to the file URL
            link.href = "https://srkrec.edu.in/spellbee/admin/certificate/tmp/" + rolll + ".png";

            // Set the download attribute to specify the filename
            link.download = rolll + ".png";

            // Trigger a click event on the anchor element
            link.click();

            window.open("https://srkrec.edu.in/spellbee/admin/certificate/tmp/" + rolll + ".png" , "_blank");

          },
          error: function() {
            // Handle errors if the AJAX request fails
            console.error("Error in Generating Certificate.");
          }
        });
      });
      $(".conform-payment").click(function() {
        // Get the user ID from the data attribute
        var phoneNumber = $(this).data("pid");
        var name = $(this).data("name");
        name.toUpperCase();
        

            var message = "Dear "+name+",\nThank You for being a part of SRKR SpellBee Challenge 2023\nThis certificate is presented to you in recognition of your active participation in SRKR SPELL BEE CHAMP. We hope you enjoyed the event.\n\nDownload Your Level 1 Certificate @  https://srkrec.edu.in/spellbee/certificate.php \nFor more details and leaderboard score, visit https://srkrec.edu.in/spellbee/\n\n-SRKR SpellBee Organizing Team(SDC), CSD";


        // Encode the message for use in a URL
        var encodedMessage = encodeURIComponent(message);

        // Construct the WhatsApp URL
        var whatsappURL = "https://wa.me/" + phoneNumber + "?text=" + encodedMessage;

        // Open WhatsApp with the pre-filled message
        window.open(whatsappURL, "_blank");
      });

    });
  </script>
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