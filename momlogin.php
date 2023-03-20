<?php
session_start();
error_reporting(0);
if($_SERVER['REQUEST_METHOD']=="POST")
{
    function test_input($x)
    {
        $x=trim($x);
        $x=stripslashes($x);
        $x=htmlspecialchars($x);
        return $x;
    }
    $conn = new mysqli("localhost", "root", "", "user");
    if(!$conn->connect_error){
        $email= test_input($_POST['email']);
        $password= test_input($_POST['password']);
        if(!empty($email) and !empty($password))
        {
            $sql = "SELECT * FROM mine WHERE email1=? and password1=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $password);
            if($stmt->execute())
            {
                $result = $stmt->get_result();
                if($result->num_rows)
                {
                    $_SESSION['email'] = $email;
                    header('Location: welcome.php');
                    exit();
                }
                else
                $err = "Wrong username And/or Password ";
            }

        }
    }
    $conn->close();
}
?>


	


<!DOCTYPE html>
<html>


	<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Welcome  To Biobook - Sin up, Log in, Chat </title>
	<link rel="stylesheet" type="text/css" href="momlogin.css">
	</head>


    <body>

	<div id="container">
		<div class="sign-in-form">
			<table>
			<h1>Welcome to Biobook</h1>
			<h2>Log in</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
				<tr>
					<td><label>Email
                        <?php
                        if(!empty($err))
                        
                            echo"<SPAN class=\"red\">*</SPAN>";
                            else
                            
                                echo "*";
                            
                               

                        

                        
                        ?>
                    </label><br></td>
					<td><input type="email" name="email" placeholder="example@razor.com" class="form-1" title="Enter your email" required /></td>
				</tr>
				<tr>
					<td><label>Password
                    <?php
                        if(!empty($err))
                        
                            echo"<SPAN class=\"red\">*</SPAN>";
                            else
                            
                                echo "*";
                        ?>
                    </label></td>
					<td><input type="password" name="password" placeholder="~~~~~~~~~~" class="form-1" title="Enter your password" required /></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
					<input type="submit" name="submit" value="Log in" class="btn-sign-in" title="Log in" />
					<input type="reset" name="cancel" value="Cancel" class="btn-sign-up" title="Cancel" />
					</td>
				</tr>
	</form>
    <?php
        echo"<DIV class=\"red\">";
        if(isset($err))
        echo $err;
        echo"</DIV>";
        ?>

			</table>
		
		</div>
        
	</div>
	
</body>

</html>