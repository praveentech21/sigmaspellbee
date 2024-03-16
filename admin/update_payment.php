<?php

include "connect.php";

if(isset($_POST['replay'])){
    mysqli_query($conn,"UPDATE `users` SET `status`=1,`points`=NULL WHERE `pid` = {$_POST['replay']}");
    mysqli_query($conn,"DELETE FROM responses WHERE `sid` = {$_POST['replay']}");
}
else{
    echo "<script>alert('Sorry You are accessing wrong file')</script>";
}

?>