<?php
	include('conn.php');
	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	$pname=test_input($_POST['pname']);
	$price=test_input($_POST['price']);
	$category=test_input($_POST['category']);

	$fileinfo=PATHINFO($_FILES["photo"]["name"]);

	if(empty($fileinfo['filename'])){
		$location="";
	}
	else{
	$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . $newFilename);
	$location="upload/" . $newFilename;
	}
	
	$sql=$conn->prepare("INSERT INTO product (productname, categoryid, price, photo) values(?, ?, ?, ?)");
	$sql->bind_param('ssss', $pname,$category,$price,$location);
	$sql->execute();
	

	header('location:product.php');

?>