<?php
session_start();
if (!isset($_SESSION['admin'])) header("location: login.php");

include 'connect.php';

$notpayed = mysqli_query($conn, "SELECT * FROM `users` WHERE `payment_status` = '0' ");

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

  <!-- Add these links in your HTML -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
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
        <h5 class="card-header">Payment Conformation</h5>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered" id="registrationTable">
              <thead>
                <tr>
                  <th>NAME</th>
                  <th>REGISTRATION NO</th>
                  <th>DEPARTMENT</th>
                  <th>YEAR</th>
                  <th>Conformation</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($notpayed)) { ?>
                  <tr>
                    <td><strong><?php echo strtoupper($row['player_name']) ?></strong></td>
                    <td><?php echo strtoupper($row['regno']) ?></td>
                    <td><?php echo $row['department'] ?></td>
                    <td><?php if ($row['place'] == '2027') echo "First Year";
                        elseif ($row['place'] == '2026') echo "Second Year";
                        elseif ($row['place'] == '2025') echo "Third Year";
                        elseif ($row['place'] == '2024') echo "Fourth Year";
                        ?></td>
                    <td><button type="button" name="conformpayment" class="btn rounded-pill btn-success conform-payment" data-toggle="modal" data-target="#confirmationModal_<?php echo $row['pid']; ?>" data-pid="<?php echo $row['pid']; ?>" data-name="<?php echo $row['player_name']; ?>">Confirm Payment</button></td>
                  </tr>

                  <!-- Confirmation Modal for This Person -->
                  <div class="modal fade" id="confirmationModal_<?php echo $row['pid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Confirm Payment</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Are you sure you want to confirm payment for <strong><?php echo $row['player_name']; ?></strong>?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary cancleButton" data-dismiss="modal">Cancel</button>
                          <button type="button" class="btn btn-primary confirmButton" data-pid="<?php echo $row['pid']; ?>">Confirm</button>
                        </div>
                      </div>
                    </div>
                  </div>
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
      $(".conform-payment").click(function() {
        // Get the user ID and name from the data attributes
        var pid = $(this).data("pid");
        var name = $(this).data("name");

        // Set the modal title to include the person's name
        $("#confirmationModal_" + pid + " .modal-title").html("Confirm Payment for " + name);

        // Open the confirmation modal
        $("#confirmationModal_" + pid).modal("show");

        // Handle the "Confirm" button click
        $(".confirmButton").click(function() {
          // Get the user ID from the data attribute
          var confirmedPid = $(this).data("pid");

          // Send an AJAX request to update the database
          $.ajax({
            type: "POST",
            url: "update_payment.php", // Replace with the URL of your PHP script
            data: {
              payment: confirmedPid
            }, // Send the user ID to the server
            success: function(response) {
              // Handle the server response if needed
              console.log("Payment confirmation updated successfully.");
              window.location.reload();
            },
            error: function() {
              // Handle errors if the AJAX request fails
              console.error("Error updating payment confirmation.");
            }
          });

          // Close the modal
          $("#confirmationModal_" + confirmedPid).modal("hide");
        });

        // Handle the "Cancel" button click

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