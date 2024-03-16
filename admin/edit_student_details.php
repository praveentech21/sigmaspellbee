<?php
// Include your database connection code here

include 'connect.php';

if (isset($_POST['work']) and $_POST['work'] == 'edit') {
    $pid = $_POST['pid'];
    

    $stud =mysqli_query($conn , "SELECT * FROM `users` WHERE `pid` = '$pid'");
    $student = mysqli_fetch_assoc($stud);
    $response = array(
        'sname' => $student['player_name'],
        'regno' => $student['regno'],
        'dept' => $student['department'],
        'year' => $student['place'],
        'section' => $student['section'],
        'pid' => $student['pid'],
        'email' => $student['email']
    );
    
    echo json_encode($response);
    
} 
elseif (isset($_POST['work']) and $_POST['work'] == 'update') {
    $pid = $_POST['pid'];

    $stud = $conn -> prepare("update `users` set `pid` = ? , `player_name` = ? , `place` = ? , `regno` = ? , `email` = ? , `department` = ? , `section` = ? where `pid` = ?");
    $stud -> bind_param("ssisssss",$_POST['mobile'],$_POST['sname'],$_POST['year'],$_POST['regno'],$_POST['email'],$_POST['dept'],$_POST['section'],$pid);
    if($stud -> execute()){
    $response = array(
        'success' => "Data Updated Successfully"
    );}
    else{
        $response = array(
        'error' => "Data Not Updated"
    );
    }
    
    echo json_encode($response);
    
} 

else {
    // Handle errors, e.g., invalid request
    echo json_encode(['error' => 'Invalid request']);
}
?>
