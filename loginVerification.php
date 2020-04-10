<?php

	include "dbconnection.php";
	$usrname = $_POST['username'];
	$pewd = $_POST['pwrd'];

	$sql1 = 'select * from allusers where email = ? ; ' ;

	$stmt = mysqli_prepare($conn , $sql1) ;

	mysqli_stmt_bind_param($stmt , 's' , $usrname);

	mysqli_stmt_execute($stmt);

	$results = mysqli_stmt_get_result($stmt);

	$datas = [];
	while($x = mysqli_fetch_assoc($results) ) {
		$datas[]= $x;
	}
	if( mysqli_num_rows($results) > 0) {
		$pp = $datas[0]['pswrd'];
		if ( password_verify($pewd, $pp) ) {
			
		header("Location: complaint.html");
		}
		else 
		{
		echo "<h2>Login Denied</h2> <p><a href='report.html'>Login Again!</a></p>";
		}
	}
	
	else 
	{
		echo "<h2>Login Denied</h2> <p><a href='report.html'>Login Again!</a></p>";
	}

?>