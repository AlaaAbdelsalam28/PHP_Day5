<!DOCTYPE html>
<html>
<head>
    <title>home</title>
    <style>
      h1{
        text-align: center;
        color:rgb(199, 21, 21);
        font-size: 45px;
      }
    </style>
</head>

<body>

    <img src="img2.jpg" width="130px" , height="65px" , style="float: right;">
    <input style="width: 350px; height:70px;background-color:rgb(199, 21, 21);font-size:30px; color: rgb(243, 237, 237); border: 0;" type="button" value="Sign out of your account" onclick="goToLogin()">
    <?php
    session_start();
        $username = $_SESSION['username'];
        ?>

        <h1>Hi,  <?php echo $username ?> Welcome to our website.</h1>
    
    
    <a href="lab.php"><img src="img1.jpg"  width="1844px" , height="730px" style="overflow: hidden;" ></a>
    <script>
        function goToLogin() {
            window.location.href = "login.php";
        }
    </script>

</body>
</html>