<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        
        #name {
            width: 350px;
            height: 40px;
            font-size: 30px;
        }
        #password {
            width: 350px;
            height: 40px;
            font-size: 30px;
        }
        .formm{
            text-align: center;
        border: 2px solid white;
       background-color: white;
       padding: 60px;
       font-size: 45px;
        }
        body{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
   background-color: black;
      }
    </style>
</head>
<body>
    <div class="formm">
    <h1>Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Please fill in your credentials to login </label><br><br>
        <label style="font-size: 30px;">Username:</label><br>
        <input type="text" name="username" id="name"><span style="color:red;font-size:20px;">*</span><br><br>
        <label style="font-size: 30px;">Password:</label><br>
        <input type="password" name="password" id="password"><span style="color:red;font-size:20px;">*</span><br><br>
        <input style="width: 150px; height:70px; background-color:black; font-size:25px; border:0;color:white;" type="submit" value="Login">
        <p style="font-size:25px;">Don't have an account?<a href="signup.php" style="color:blue;">Sign Up now</a></p>
    </form>
    </div>
    <?php
    include("conn.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dbusername = $_POST["username"];
    $dbpassword = $_POST["password"];
    if ($dbpassword == "" || $dbusername == "") {
        echo '<script> alert ("Empty Field")</script>';
    } 

    else {
        // execute SQL query using mysqli_query
        $query = "SELECT * FROM Users WHERE username='$dbusername'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($dbpassword == $row['password']) {
                session_start();
                $_SESSION['username'] = $dbusername;
                mysqli_close($conn);
                header("Location: home.php");
                exit();
            }
        }
        $message = "Invalid username or password. Please try again.";
        echo "<script>alert('$message');</script>";
        mysqli_close($conn);
    }
}
?>
</body>
</html>



