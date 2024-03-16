<?php
error_reporting(E_ALL); 

$im = imagecreatefrompng("spellbee.png");
// if there's an error, stop processing the page:
if(!$im)
{
 die("ISSUE WITH GENERATING CERTIFICATE! CONTACT ADMIN!");
}


//Name
// define some colours to use with the image
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$font = './roboto.ttf'; // Provide the correct path to your font file

$rollno=($_POST['rollno']);
include "../connect.php";

$result=mysqli_query($conn, "SELECT * FROM `users` WHERE `pid`='$rollno'");
$row=mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) == 0)
  {
 	echo "<span style='color:red;font-family:Arial;'><b>SORRY! YOUR CREDENTIALS DID NOT MATCH THE RECORDS. CERTIFICATE WILL NOT BE GENERATED</b></span><br><a href='../certificate.php' style='color:blue;font-family:Arial;'>TRY AGAIN</a><br>";
  }  
else
  {
	//echo "<h2 style='color:#AA0055;font-family:Arial;'>CODE MASTER 2018 - LEVEL 1 CERTIFICATE</h2>";  
  $sname=ucwords(strtolower($row['player_name']));
  $rollno=$row['regno'];
  if($row['place'] == '2024') $year = '4'; 
  elseif($row['place'] == '2025') $year = '3'; 
  elseif($row['place'] == '2026') $year = '2'; 
  elseif($row['place'] == '2027') $year = '1';

  if($row['department'] == 'CSD') $department = 'Computer Science and Design';
  elseif($row['department'] == 'CSE') $department = 'CSE';
  elseif($row['department'] == 'ECE') $department = 'ECE';
  elseif($row['department'] == 'EEE') $department = 'EEE';
  elseif($row['department'] == 'MECH') $department = 'Mechanical Engineering';
  elseif($row['department'] == 'CIVIL') $department = 'Civil Engineering';
  elseif($row['department'] == 'IT') $department = 'Information Technology';
  elseif($row['department'] == 'AIDS') $department = 'AIDS';
  elseif($row['department'] == 'AIML') $department = 'AIML';
  elseif($row['department'] == 'CSBS') $department = 'CSBS';
  elseif($row['department'] == 'CST') $department = 'CSI';
  elseif($row['department'] == 'CIC') $department = 'CIC';

  //$name=$sname." - ".$rollno;
  $name=$sname;

    $batch=$year." /4 - ".$department;
    
	  
  
//writing name and roll number
$text = $name;
imagettftext($im, 20, 0, 500, 353, $black, $font, $text);

//writing rool number
$text = $batch; 
imagettftext($im, 20, 0, 150, 413, $black, $font, $text);

$myfile = "tmp/".$rollno.".png";

// output the image as a png

imagepng($im, $myfile);

// tidy up

imagedestroy($im);
	}		
?>