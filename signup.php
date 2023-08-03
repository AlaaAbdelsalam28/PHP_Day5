<!DOCTYPE html>
<html>
<head>
    <title>SignUp</title>
    <style>
        
        #name {
            width: 350px;
            height: 40px;
            font-size: 30px;
        }
        #email {
            width: 350px;
            height: 40px;
            font-size: 30px;
        }
        #password
    {
        width: 350px;
            height: 40px;
            font-size: 30px;
    }
    #confpassword{
        width: 350px;
            height: 40px;
            font-size: 30px;
    }
        .formm{
          
        border: 2px solid white;
       background-color: white;
       padding: 60px;
       font-size: 22px;
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
    <h1 >Sign Up</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Please fill out this form and submit to add user record to the database</label><br><br>
        <label style="font-size: 30px;">Username:</label><br>
        <input type="text" name="username" id="name"><span style="color:red;font-size:20px;">*</span><br><br>
        <label style="font-size: 30px;">Email:</label><br>
        <input type="text" name="email" id="email"><span style="color:red;font-size:20px;">*</span><br><br>
        <label style="font-size: 30px;">Password:</label><br>
        <input type="password" name="password" id="password"><span style="color:red;font-size:20px;">*</span><br><br>
        <label style="font-size: 30px;">Confirm Password:</label><br>
        <input type="password" name="confpassword" id="confpassword"><br><br>
        <label style="font-size: 30px;">Gender:</label><br><br>
        <input type="radio" name="gender" value="male">Male<br>
        <input type="radio" name="gender" value="female">Female <span style="color:red; font-size:20px;">*</span><br><br>
        <input type="checkbox" id="myCheckbox" name="mailbox" value="1">
        <label>Receive E-Mails from us.</label><br><br>
        <input style="width: 100px; height:60px; background-color:black; font-size:20px; color:white;" type="submit" value="Submit">
        <input  style="width: 100px; height:60px; background-color:white; font-size:20px; color:black;" type="reset" value="Reset">
        <p style="font-size:25px;">Already have an account?<a href="login.php" style="color:blue;">Login here</a></p>
    </form>
    </div>  
    <?php
    include("conn.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dbusername = $_POST["username"];
        $dbemail = $_POST["email"];
        $dbpassword = $_POST["password"];
        $dbgender = isset($_POST["gender"]) ? $_POST["gender"] : "";
        $dbmail = isset($_POST["mailbox"]) ? "Yes" : "No";
        if ($dbemail == "" || $dbusername == "" || $dbgender == "" || $dbpassword == "") {
            echo '<script> alert ("Empty Field")</script>';
        } elseif (!filter_var($dbemail, FILTER_VALIDATE_EMAIL)) {
            echo '<script> alert ("Invalid email")</script>';
        } 
        elseif ($dbpassword != $_POST["confpassword"]) {
            echo '<script> alert ("Passwords do not match")</script>';
        }
        else {
            $sql = "INSERT INTO Users (Username, Email,Password, Gender, Mail_status) VALUES ('$dbusername', '$dbemail', $dbpassword,'$dbgender', '$dbmail')";
            //execute SQL query using mysqli_query
            if (mysqli_query($conn, $sql)) {
                // select all rows from Users and put result to $result
                $result = mysqli_query($conn, "SELECT * FROM Users");
                //initialize empty array to store fetched rows
                $data = array();
                //fetches each row from result and put it to $row ,The loop continues until there are no more rows to fetch
                while ($row = mysqli_fetch_assoc($result)) {
                    // insert fetched rows to $data array
                    $data[] = $row;
                
                }
                session_start();
                $_SESSION['username'] = $dbusername;
                mysqli_close($conn);
                header("Location: home.php");
                exit();
            } else {
                echo '<script>alert("Error: ' . mysqli_error($conn) . '")</script>';
            }
        }
        mysqli_close($conn);
    }
    ?>
     <script>
        function goToHome() {
            window.location.href = "login.php";
        }
    </script>
</body>
</html>



