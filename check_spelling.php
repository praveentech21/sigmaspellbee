<?php include "access_check.php"; ?>
<?php

  include "connect.php";

  $qid = (int)$_GET['qid'];
  $response = strtoupper(trim($_GET['answer']));

  $ans=mysqli_query($conn, "SELECT * FROM words where qid=$qid;"); 		

  $answer=mysqli_fetch_row($ans);
  $sid=$_SESSION['pid'];	
  $ranswer=strtoupper(trim($answer[1]));	  
  $level=$answer[3];	  
  $right=1;
  if($level=='E') { $marks=10;}
  else if($level=='M') { $marks=20;}
  else if($level=='C') { $marks=30;}
  $marks=100;
  
  if($ranswer != $response) {$marks=0; $right=0;}
  $query = "insert into responses1 (sid, qid, answer,marks) values ('$sid', $qid, '$response', $marks)";  
  mysqli_query($conn, $query);  
  
  echo $right;
  
?>
