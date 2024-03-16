<?php

include 'connect.php';

$run1 = mysqli_query($conn, "SELECT * FROM `users` WHERE `points` >= 2700 order by `points` desc");
$run2 = mysqli_query($conn, "SELECT * FROM `users` WHERE `points` >= 2700 order by `points` desc");
$run3 = mysqli_query($conn, "SELECT * FROM `users` WHERE `points` >= 2700 order by `points` desc");
$run4 = mysqli_query($conn, "SELECT * FROM `users` WHERE `points` >= 2700 order by `points` desc");
while($row = mysqli_fetch_assoc($run1)){
    echo $row['pid']."<br>";
}
echo "<br><br><br><br><br><br>";

while($row = mysqli_fetch_assoc($run2)){
    echo $row['player_name']."<br>";
}
echo "<br><br><br><br><br><br>";
while($row = mysqli_fetch_assoc($run3)){
    echo $row['regno']."<br>";
}
echo "<br><br><br><br><br><br>";
while($row = mysqli_fetch_assoc($run4)){
    echo $row['department']."<br>";
}

?>