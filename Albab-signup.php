<?php
include('ddb.php');

function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$nameerr = $nnamerr=$userNameErr=$numberr=$genderr=$birthdayerr=$emailerr=$passworderr="";
$name=$nname=$username=$number=$gender=$birthday=$email=$password=$password2="";


if ($_SERVER['REQUEST_METHOD']== 'POST'){
if (empty($_POST['firstname'])){
	$nameerr="Name is required";

}else{
	$name=test_input($_POST['firstname']);
    echo"<br>";
}
if (empty($_POST['lastname'])){
    $nnamerr='Lastname is required';
	
    
}
else{
	$nname =test_input($_POST['lastname']);

    

}
if (empty($_POST['username'])){
	$userNameErr="Username is required";

}
else
{
	$username=test_input($_POST['username']);
    echo"<br>";
	
if(strlen($username) < 5)
{
$userNameErr="Username is too short ";
}

}

if(empty($_POST['birthday'])){
	$birthdayerr="birthday is required";
}else{
	$birthday=test_input($_POST['day'])."/".test_input($_POST['month'])."/". test_input($_POST['year']).".";
}


if(empty($_POST['number'])){
    $numberr="Phone number is required";
    
    echo"<br>";
}else{
	$number=test_input($_POST['number']);


}
if(empty($_POST['gender'])){
    $genderr="gender is required";
    
}else{
	$gender=test_input($_POST['gender']);
    
}

if(empty($_POST['email']))
{
  $emailerr="email is required";
        echo"<br>";
        }
		else
		{
        $email=test_input($_POST['email']);


       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       $emailerr="A valid email is required";
    }

    }
	
			
	
	
				
if(empty($_POST['password']) && empty($_POST['password2'])){
	$passworderr="Password is required";
}else{
	$password=test_input($_POST['password']);
    $password2=test_input($_POST['password2']);

if($password!==$password2){
	$passworderr="password does not match";
	

}
}
if(empty($nameerr) && empty($nnamerr) && empty($userNameErr) && empty($birthdayerr) && empty($numberr)
	 && empty($genderr) && empty($emailerr) && empty($passworderr))
	{
	
	$sql = $conn->prepare('SELECT email1 FROM mine WHERE email1=?');
			$sql->bind_param('s', $email);
			$sql->execute();
			$exists = (bool) $sql->get_result()->fetch_row();
			if (!$exists)
			{
			$sql= $conn->prepare("INSERT INTO mine (firstname, lastname, userame, username2, phonenumber, gender, birthday, 
	email1, email2, password1, password2) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$sql->bind_param('sssssssssss', $name,$nname,$username,$username,$number,$gender,$birthday,$email,$email,$password,$password2);
	$name= $_REQUEST['firstname'];
	$nname= $_REQUEST['lastname'];
	$username= $_REQUEST['username'];
	$gender= $_REQUEST['gender'];
	$birthday= $_REQUEST['birthday'];
	$number= $_REQUEST['number'];
	$email= $_REQUEST['email'];
	$password= $_REQUEST['password'];
	if($sql->execute())
	{
	   

	
   echo "<script>alert('Account successfully created!'); window.location='momlogin.php'</script>";
   }
}
   
   else
   {
	   echo "ERROR: Could not prepare query: $sql. " . $conn->error;

   }

	
				
			
			

	
		
	 $sql->close();
	 $conn->close();
	}
}

else
{

}

?>



<!DOCTYPE html>
<html>

	<head>
		<title>Welcome  To Al-Bab - Sin up, Log in, Chat </title>
		<link rel="stylesheet" type="text/css" href="mom.css">
	</head>

<body>




	<div id="container">
		<div class="sign-in-form">
		<center>	
			<h1>Welcome to Al-Bab Islamic centre</h1>
		</center>

			<h2>Sign up</h2>
			<b>All fields are required.</b>
		<br />
		
		<fieldset class="sign-up-form-1">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><label>First name*</label></td>
					<td><label>Last name *</label></td>
				</tr>
				<tr>
					<td><input type="text" name="firstname" placeholder="Enter your firstname....." class="form-1" 
					title="Enter your firstname" value="<?php echo $name;?>" required /></td><br>
					
					<td><input type="text" name="lastname" placeholder="Enter your lastname....." class="form-1" 
					title="Enter your lastname" value="<?php echo $nname;?>" required /></td><br>		
				</tr>
				<tr>
				<td><?php echo $nameerr;?></td><br>
				<td><?php echo $nnamerr;?></td><br>
				</tr>
        
				
				

				<tr>
					<td><label>User name*</label></td>
					<td><label>Repeat user name*</label></td>
				</tr>
				
				<tr>
					<td><input type="text" name="username" placeholder="Enter your username....." class="form-1" 
					title="Enter your username" value="<?php echo $username;?>" required/></td>
					<td><input type="text" name="username2" class="form-1" title="Enter your username" value="<?php echo $username;?>" required /></td>
				</tr>
				<tr>
				<td><?php echo $userNameErr;?></td><br>
				<td><?php echo $userNameErr;?></td><br>
				
				
			</tr>
        
				<tr>
					<td colspan="2">Note: No one can follow your username.</td>
				</tr>
				
			</table>
		</fieldset>
			
		<br />		
		
		<fieldset class="sign-up-form-1">
			<legend>Profile information</legend>
			<table celltedpadding="5" cellspacing="5">
				<tr>
					<td><label>Birthday</label></td>
					<td>
					<select name=day style="font-size:18px;" value="<?php echo $birthday;?>">
					<?php

					$day=1;
					while($day<=31)
					  {
					  echo "<option> $day
					  </option>";
					  $day++;
					  }
					?>
					</select>
					<select name=month style="font-size:18px;" >
						<option>January</option>
						<option>Febuary</option>
						<option>March</option>
						<option>April</option>
						<option>May</option>
						<option>June</option>
						<option>July</option>
						<option>August</option>
						<option>September</option>
						<option>October</option>
						<option>November</option>
						<option>December</option>
					</select>
					<select name=year style="font-size:18px;" required>
					<?php
					$year=1901;
					while($year<=2014)
					  {
					  echo "<option> $year
					  </option>";
					  $year++;
					  }
					?>
					</select>
					</td>
				</tr>
				
				
				
        
				

				<tr>
					<td><label>Gender</label></td>
					<td>
					<label>Male</label><input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked"; ?>
					 value="male" required />
					<label>Female</label><input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked"; ?>
					 value="female" required />
					</td>
				</tr>
				<tr>
				<td><?php echo $genderr;?></td><br>
				
				
			</tr>
        
				<tr>
					<td><label>Mobile number*</label></td>
					<td><input type="text" name="number" placeholder="09...." maxlength="13" class="form-1" 
					title="Enter your mobile number" value="<?php echo $number?>" required /></td>
				</tr>
				<tr>
				<td><?php echo $numberr;?></td><br>
				
				
			</tr>
        
			</table>
		</fieldset>
		
		<br/>
		
		<fieldset class="sign-up-form-1">
			<legend>Log in information*</legend>
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><label>Your email address*</label></td>
					<td><label>Repeat email *</label></td>
				</tr>
				<tr>
					<td><input type="text" name="email" placeholder="Enter your email address....." class="form-1" 
					title="Enter your firstname" value="<?php echo $email;?>" required /></td>
					<td><input type="text" name="email" class="form-1" title="Enter your lastname" value="<?php echo $email;?>" required /></td>
				</tr>
				<tr>
					<td colspan="2">Note: no-one can see your email address.</td>
				</tr>
				<tr>
				<td><?php echo $emailerr;?></td><br>
				<td><?php echo $emailerr;?></td><br>
				</tr>
			    
        
        
				<tr>
					<td><label>Password*</label></td>
					<td><label>Repeat password*</label></td>
				</tr>
				<tr>
					<td><input type="password" name="password" placeholder="Enter your password....." class="form-1" 
					title="Enter your username" required /></td>
					<td><input type="password" name="password2" class="form-1" title="Enter your username" required /></td>
				</tr>
				<tr>
				<td><?php echo $passworderr;?></td><br>
				<td><?php echo $passworderr;?></td><br>
				</tr>
        
				<tr>
					<td colspan="2">Note: no-one else can see your password.</td>
				</tr>
			</table>
		</fieldset>
		
		<br />
		
			<strong>Yes, I have read and I accept the <a href="#">Al-bab Terms of Use</a> and the <a href="#"><Al-bab></Al-bab> Privacy Statement</a></strong>
			
		<br />
		<br />
					<input type="submit" name="submit" value="I Agree - Continue" class="btn-sign-in" title="Log in" />
		</form>
		
		</div>
	</div>
	

	


</body>
</html>


