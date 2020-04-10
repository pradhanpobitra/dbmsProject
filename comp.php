<?php
	include 'dbconnection.php';

	$img = $_FILES['file'];
	$imgTmpName = $_FILES['file']['tmp_name'];
	$imgSize = $_FILES['file']['size'];
	$imgError = $_FILES['file']['error'];
	$imgType = $_FILES['file']['type'];
	$imgName = $_FILES['file']['name'];

	$fileExt = explode('.', $imgName);
	$fileActualExt = strtolower(end($fileExt));
	$allowed  = array('jpg' , 'jpeg' ,'png' );

	if (in_array($fileActualExt, $allowed)) {
		if ($imgError === 0) {
			 $imgNameNew = uniqid('' , true).'.'.$fileActualExt;
			 $fileDestination = $imgNameNew;
			 move_uploaded_file($imgTmpName, $fileDestination);
		} else {
			echo "IMAGE UPLOADING ERROR";
			echo '<p><a href="complaint.html">CLick to refill the form</a></p>';
		}

	} else {
		echo 'INVALID IMAGE FORMAT';
		echo '<p><a href="complaint.html">CLick to refill the form</a></p>';
	}

	$email1 = $_POST['email'];
	$sql5 = 'select name, pswrd from allusers where email = "'.$email1.'";';

	$rst = mysqli_query($conn , $sql5);

	$dtas = [];

	while ($x = mysqli_fetch_assoc($rst) ) {
		$dtas[]= $x;
	}

	$dt = $dtas[0];

	$name1 = $dt['name'];
	$pesswrd = $dt['pswrd'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$img_dir = $fileDestination;
	$description = $_POST['description'];
	$address1 = $_POST['address'];

	$sql3 = 'insert into allcomplaints (name , email , pswrd , city , state , zip , img_dir , description , location , stats ) values (?,?,?, ? , ? , ?,?,?,?,"In Progress") ;';

	$stmt = mysqli_prepare($conn , $sql3);

	mysqli_stmt_bind_param($stmt , 'sssssssss' , $name1, $email1 ,  $pesswrd, $city, $state , $zip, $img_dir, $description , $address1);

	mysqli_stmt_execute($stmt);

	header("Location: allcomplaintsofauser.html?email=".$email1);
	


?>