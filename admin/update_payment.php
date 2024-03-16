<?php

session_start();

if (!isset($_SESSION['admin'])) header("location: login.php");

$admin = $_SESSION['admin'];



// Include your database connection code here

include 'connect.php';

// Get the user ID from the AJAX request

if (isset($_POST["payment"])) {

    $pid = $_POST["payment"];

    $stmt = $conn->prepare("UPDATE `users` SET `payment_status` = 1,`pconfprby` = ? WHERE pid = ?");

    $stmt->bind_param("ss", $admin, $pid);

    if ($stmt->execute()) {

        echo "Payment confirmation updated successfully.";
    } else {

        echo "Error updating payment confirmation.";
    }
} elseif (isset($_POST["replay"])) {

    $pid = $_POST["replay"];

    $previous_status = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `payment_status` FROM `users` WHERE `pid` = $pid"))['payment_status'];

    $previous_status++;

    $stmt = $conn->prepare("DELETE FROM responses WHERE `sid` = ? ");

    $stmt->bind_param("s", $pid);



    if ($stmt->execute()) {

        mysqli_query($conn, "INSERT INTO `replay`(`pid`, `replay`, `confby`) VALUES ('$pid','$pervious_status','$admin')");

        $setpoints = $conn->prepare("UPDATE `users` SET `payment_status` =?, `status`=1, `points`= NULL WHERE `pid` = ?");

        $setpoints->bind_param("is", $previous_status, $pid);

        $setpoints->execute();

        echo "Replay confirmation updated successfully.";
    } else {

        // Update failed

        echo "Error updating Replay confirmation.";
    }
} elseif (isset($_POST["allow"])) {

    $pid = $_POST["allow"];

    $setpoints = $conn->prepare("UPDATE `users` SET  `status`=1 WHERE `pid` = ?");

    $setpoints->bind_param("s", $pid);

    if ($setpoints->execute()) echo "Allow to game successfully.";

    else echo "Error updating Student status.";
} elseif (isset($_POST["stop"])) {

    $pid = $_POST["stop"];

    $setpoints = $conn->prepare("UPDATE `users` SET  `status`=0 WHERE `pid` = ?");

    $setpoints->bind_param("s", $pid);

    if ($setpoints->execute()) echo "Game stoped successfully.";

    else echo "Error updating Replay confirmation.";
} elseif (isset($_POST["gameconfirm"])) {

    $pid = $_POST["gameconfirm"];

    $stmt = $conn->prepare("UPDATE `users` SET `status`=1 ,`gameconfby` = ? WHERE `pid` = ?");

    $stmt->bind_param("ss", $admin, $pid);



    if ($stmt->execute()) {

        // Update successful

        echo "Game confirmation updated successfully.";
    } else {

        // Update failed

        echo "Error updating Game confirmation.";
    }
} else {

    echo "Invalid request.";
}
