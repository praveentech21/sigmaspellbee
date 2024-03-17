<?php include "access_check.php"; ?>
<?php
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    $ssid=$_SESSION['pid'];
	include "connect.php";
    $table="";
	
	$my_res=mysqli_query($conn, "SELECT sum(marks) as mymark from responses where sid='$ssid';"); 		
    $mrow=mysqli_fetch_array($my_res);
	$my_score=$mrow['mymark'];
	$table=$table."<h4><b>MY SCORE</b></h4><h1 style='color:#0047AB'><b>$my_score</b></h1>"; 

	
	$ques=mysqli_query($conn, "SELECT * from responses where sid='$ssid' order by timestamp LIMIT 20;"); 		
    //$row=mysqli_fetch_array($ques);	
	
    if(mysqli_num_rows($ques)>0)
	{
        $sno=1;		
		$table=$table."<table style='line-height:0px;'><tr><th>Question</th><th>Status</th><th>Score</th></tr>";
	    while($row=mysqli_fetch_array($ques))
	      {
          	 $table=$table."<tr><td align='center'>Question $sno</td><th>";
			 $marks=$row['marks'];
			 
			 if($marks > 0)
			 {
			   $table=$table."<span style='color:green;'>RIGHT</span></th>";  	 
			 }
			 else
			 {
			   $table=$table."<span style='color:red;'>WRONG</span></th>";  	 
			 }
 			 
 	    $table=$table."<td align='center'>".$marks."</td></tr>";
	  	     $sno++;
		  }	 
         $table=$table."</table>";

	}

	
	
    echo "retry:1000\n";
	echo "data:{$table}\n\n";
    flush();

?><?php
