<!DOCTYPE html>
<html>
<head>
	<title>Image Viewer</title>
	<style type="text/css">
		img {
			height: 800px;
			width: 900px;
		}
		
	</style>
</head>
<body>

  <?php

  	$img = $_GET['img'];
  	echo '<div><img src="'.$img.'"></div>';

  ?>


</body>
</html>