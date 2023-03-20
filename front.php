<?php include('header.php'); ?>
<body>
<?php include('navbar.php'); ?>
<style>
	.panel-body img{
	    width: 100%;
	    height: 23rem;
	    object-fit: cover;
	}
</style>
<div class="container">
	<h1 class="page-header text-center">MENU</h1>
	<ul class="nav nav-tabs">
		<?php
			$sql="SELECT * from category order by categoryid asc limit 1";
			$fquery=$conn->query($sql);
			$frow=$fquery->fetch_array();
			?>
				<li class="active"><a data-toggle="tab" href="#<?php echo $frow['catname'] ?>"><?php echo $frow['catname'] ?></a></li>
			<?php

			$sql="SELECT* FROM category order by categoryid asc";
			$nquery=$conn->query($sql);
			$num=$nquery->num_rows-1;

			$query=$conn->query($sql);
			while($row=$query->fetch_array()){
				?>
				<li><a data-toggle="tab" href="#<?php echo $row['catname'] ?>"><?php echo $row['catname'] ?></a></li>
				<?php
			}
		?>
	</ul>

	<div class="tab-content">
		<?php
			$sql="SELECT * from category order by categoryid asc limit 1";
			$fquery=$conn->query($sql);
			$ftrow=$fquery->fetch_array();
			?>
				<div id="<?php echo $ftrow['catname']; ?>" class="tab-pane fade in active" style="margin-top:20px;">
					<?php
					$men=$ftrow['categoryid'];

						$sql="SELECT * FROM product WHERE categoryid=?";
						$stml=$conn->prepare($sql);
						$stml->bind_param('i', $men);
						$stml->execute();
						$result=$stml->get_result();
						$inc=4;
						while($pfrow=$result->fetch_array()){
							$inc = ($inc == 4) ? 1 : $inc+1; 
							if($inc == 1) echo "<div class='row'>"; 
							?>
								<div class="col-md-3">
									<div class="panel panel-default">
										<div class="panel-heading text-center">
											<b><?php echo $pfrow['productname']; ?></b>
										</div>
										<div class="panel-body">
											<img src="<?php if(empty($pfrow['photo'])){echo "upload/noimage.jpg";} else{echo $pfrow['photo'];} ?>" height="225px;" width="100%">
										</div>
										<div class="panel-footer text-center">
											&#8369; <?php echo number_format($pfrow['price'], 2); ?>
										</div>
									</div>
								</div>
							<?php
							if($inc == 4) echo "</div>";
						}
						if($inc == 1) echo "<div class='col-md-3'></div><div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 2) echo "<div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 3) echo "<div class='col-md-3'></div></div>"; 
					?>
		    	</div>
			<?php

			$sql="SELECT * from category order by categoryid asc";
			$tquery=$conn->query($sql);
			$tnum=$tquery->num_rows-1;

			$sql="SELECT * from category order by categoryid asc limit 10, $tnum";
			$cquery=$conn->query($sql);
			while($trow=$cquery->fetch_array()){
				?>
				<div id="<?php echo $trow['catname']; ?>" class="tab-pane fade" style="margin-top:20px;">
					<?php
					$mes=$trow['categoryid'];

						$sql="SELECT * from product where categoryid=?";
						$stmt=$conn->prepare($sql);
						$stmt->bind_param('i', $mes);
						$stmt->execute();
						$result=$stmt->get_result();
						$inc=4;
						while($prow=$result->fetch_array()){
							$inc = ($inc == 4) ? 1 : $inc+1; 
							if($inc == 1) echo "<div class='row'>"; 
							?>
								<div class="col-md-3">
									<div class="panel panel-default">
										<div class="panel-heading text-center">
											<b><?php echo $prow['productname']; ?></b>
										</div>
										<div class="panel-body">
											<img src="<?php if($prow['photo']==''){echo "upload/noimage.jpg";} else{echo $prow['photo'];} ?>" height="" width="">
										</div>
										<div class="panel-footer text-center">
											&#8369; <?php echo number_format($prow['price'], 2); ?>
										</div>
									</div>
								</div>
							<?php
							if($inc == 4) echo "</div>";
						}
						if($inc == 1) echo "<div class='col-md-3'></div><div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 2) echo "<div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 3) echo "<div class='col-md-3'></div></div>"; 
					?>
		    	</div>
				<?php
			}
		?>
	</div>
</div>
</body>
</html>