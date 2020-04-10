<?php
	include "dbconnection.php";
	$name = $_POST['name'];
	$email = $_POST['email'];
	$pwd = $_POST['password'];
	$password = password_hash($pwd, PASSWORD_DEFAULT);

	$sql = 'insert into allusers (name , email , pswrd) values (?,?,?);'; 

	$stmt = mysqli_prepare($conn , $sql);

	mysqli_stmt_bind_param($stmt , 'sss' , $name , $email , $password);

	mysqli_stmt_execute($stmt);
	
	header("Location: signupsuccess.html");



?>