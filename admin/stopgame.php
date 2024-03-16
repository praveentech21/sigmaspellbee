<?php
session_start();
if (!isset($_SESSION['admin'])) header("location: login.php");

include 'connect.php';

$registrations = mysqli_query($conn, "SELECT * FROM `users` where `status`=1 and `pid` in (SELECT `sid` FROM `responses` GROUP BY `sid` HAVING COUNT(`sid`) < 15) ");

?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="Bhavani/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Students SpellBee SRKR</title>

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
  <!-- Sidebar Ends Here Shiva --> <!-- Content Starts Here Shiva-->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

      <!-- Bordered Table -->
      <div class="card">
        <h5 class="card-header">Registered Students</h5>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered" id="registrationTable">
              <thead>
                <tr>
                  <th>NAME</th>
                  <th>REGISTRATION NO</th>
                  <th>DEPARTMENT</th>
                  <th>YEAR</th>
                  <th>Status</th>
                  <th>Discontinu</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($registrations)) {
                  $tresponces = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) FROM `responses` WHERE `sid` = '$row[regno]'"))['count(*)'];
                ?>
                  <tr title="<?php echo $row['pid'] ?>">
                    <td><strong><?php echo strtoupper($row['player_name']) ?></strong></td>
                    <td><?php echo strtoupper($row['regno']) ?></td>
                    <td><?php echo $row['department'] ?></td>
                    <td><?php if ($row['place'] == '2027') echo "First Year";
                        elseif ($row['place'] == '2026') echo "Second Year";
                        elseif ($row['place'] == '2025') echo "Third Year";
                        elseif ($row['place'] == '2024') echo "Fourth Year";
                        ?></td>
                    <td><?php if ($row['payment_status'] == '0') echo "Not Paid";
                        elseif ($row['payment_status'] == '1' and $row['status'] == '0') echo "Payment Confirmed";
                        elseif ($row['payment_status'] == '1' and $row['status'] == '1' and $tresponces == 0) echo "Go and Play";
                        elseif ($row['payment_status'] == '1' and $row['status'] == '1' and $tresponces < 15) echo "Semi Played";
                        elseif ($row['payment_status'] == '1' and $row['status'] == '1' and $tresponces == 15) echo "Game Completed";
                        elseif ($row['payment_status'] > 1 and $row['status'] == '1' and $tresponces == '0') echo "Choose to Replay";
                        elseif ($row['payment_status'] > 1 and $row['status'] == '1' and $tresponces < '15') echo "Semi Replay";
                        elseif ($row['payment_status'] > 1 and $row['status'] == '1' and $tresponces == '15') echo "Replayed";
                        else echo "Update Status";
                        ?></td>
                    <td><button type="button" class="btn rounded-pill btn-danger confirm-game" data-toggle="modal" data-target="#confirmationModal" data-pid="<?php echo $row['pid']; ?>">Stop Game</button></td>

                  </tr>
                  <!-- Modal Code Starts Here -->
                  <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Stop Game</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Are you sure you want to stop his/her game?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button type="button" class="btn btn-primary" id="confirmButton">Confirm</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Code Ends Here -->

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
  <script>
    $(document).ready(function() {
      // Add a click event listener to the buttons with the class "confirm-game"
      $(".confirm-game").click(function() {
        // Get the game ID from the data attribute
        var pid = $(this).data("pid");

        // Handle the "Confirm" button click
        $("#confirmButton").click(function() {
          // Send the AJAX request to update the game confirmation
          $.ajax({
          type: "POST",
          url: "update_payment.php", // Replace with the URL of your PHP script
          data: {
            stop: pid
          }, // Send the user ID to the server
          success: function(response) {
            // Handle the server response if needed
            console.log("Game Stoped successfully.");
            window.location.reload();
          },
          error: function() {
            // Handle errors if the AJAX request fails
            console.error("Error in Game Stoping.");
          }
        });

          // Close the modal
          $("#confirmationModal").modal("hide");
        });
      });

    });
  </script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>