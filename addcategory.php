<?php
	include('conn.php');
	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	

	$cname=test_input($_POST['cname']);
	$sql=$conn->prepare("INSERT into category(catname) values(?)");
	$sql->bind_param('s', $cname);
	$sql->execute();


	header('location:category.php');

?>