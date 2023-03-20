<?php
	include('conn.php');
	if(isset($_POST['productid'])){
 
		$customer=$_POST['customer'];
		
		
       $sql=" INSERT INTO purchase(customer, date_purchase) values('$customer', NOW())";
	   $conn->query($sql);
		$pid=$conn->insert_id;
 
		$total=0;
 
		foreach($_POST['productid'] as $product):
		$proinfo=explode("||",$product);
		$productid=$proinfo[0];
		$iterate=$proinfo[1];
		$sql="SELECT * from product where productid=?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param('s', $productid);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_array();
 
		if (isset($_POST['quantity_'.$iterate])){
			$subt=$row['price']*$_POST['quantity_'.$iterate];
			$total+=$subt;
			$quant=$_POST['quantity_'.$iterate];

			$sql=$conn->prepare("INSERT into purchase_detail (purchaseid, productid, quantity) 
			values (?, ?, ?)");
			$sql->bind_param('sis', $pid,$productid,$quant);
			$sql->execute();
		}
		endforeach;
 		
 		$sql="UPDATE purchase set total=? where purchaseid=?";
		$stml=$conn->prepare($sql);
		$stml->bind_param('si', $total,$pid);
		$stml->execute();
		header('location:sales.php');		
	
	}else{
		?>
		<script>
			window.alert('Please select a product');
			window.location.href='order.php';
		</script>
		<?php
	}
?>