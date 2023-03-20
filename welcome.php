<?php
session_start();
    if(!isset($_SESSION['email']))
    {
        $_SESSION['msg']="You have to login first";
        header('locattion: momlogin.php');

    }
    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['email']);
        header('location: momlogin.php');

    }
include('ddb.php');
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    function test_input($x)
    {
        $x = trim($x);
        $x = stripslashes($x);
        $x = htmlspecialchars($x);
        return($x);
    }

    $stmt = $conn->prepare("INSERT INTO comments(user, word) VALUES(?,?)");
    $stmt->bind_param("ss" ,$user, $word);
    $user = test_input($_POST['user']);
    $word = test_input($_POST['word']);
    if($stmt->execute())
    {
        echo "Your comment posted successfully!";
    }
}



?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="welcome.css">
    

</head>
<body>
    <div class="header">
       <center> <h2>Home page</h2></center>
        <center><h3>AL-BAB ISLAMIC CENTER</h3><center>
    </div>
    <?php if(isset($_SESSION['email'])); ?>
    <p>
    Welcome
    <strong>
        <?php echo $_SESSION['email'];  ?>
    </strong>
    </p>
    <button name="logout">logout</button>
    <div class="row">
  <div class="col-3">...</div>
  <div class="col-9">...</div>
</div>
    <br><br>
    <div class="myForm">
            <form method="POST">
                <h2>Enter the comments</h2>
                <input type = "text" name="user" maxlength="250" placeholder="Enter Username"><br><br><hr><hr>
                <textarea type="text" name="word" maxlength="5000" placeholder="Write comment"></textarea><br>
                <button type="submit">Post</button>


            </form>
           </div>
           <div class= "display">
            <h2>Latest comments</h2>
            <?php
            $sql="SELECT * FROM comments ORDER BY id DESC LIMIT 10";
            if($result= $conn->query($sql))
            {
                while($row = $result->fetch_row())
                {
                    echo "<div class=\"commentBox\">";
                    echo "By <b>", $row[2], "</b><br>";
                    echo $row[3];
                    echo "<div class=\"right\">", $row[1], "</div>";
                    echo"</div>"; 
                }
            }
            $conn->close();
            
            ?>

           </div>



</body>

</html>