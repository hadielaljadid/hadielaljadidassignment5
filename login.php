<?php
require_once 'conf.php';
$conn = mysqli_connect($host, $user, $pass ,$db_name);
if(isset($_POST['login']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];

  $select = "SELECT * FROM `user` WHERE username = '$username' && pswrd = '$password'";
  $result = mysqli_query($conn ,$select);
  

  if (mysqli_num_rows($result) == 1) {
    // Login credentials are valid, redirect to home page with user info
    $row = mysqli_fetch_assoc($result);
    session_start();
    $_SESSION['username'] = $username;
    header("Location: expensehome.php?username=".$row['username']);
    exit();}
  
  else 
  {
    $error[] = 'incorrect username or password';
}
}
mysqli_close($conn);

// Function to sanitize input fields
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <nav>
        <div class = "menu">
        <div class = "logo">
         <a href="#">EXPENSE TRACKER</a>
          </div>
            <ul>
              <li><a target ="_blank" href="expense.html">Homepage</a></li>
              <li><a target ="_self" href ="login.php">Login</a></li>
              <li><a target ="_blank" href="signup.php">Signup</a></li>
              <li><a href="#">About us</a></li>
              <li><a target ="_blank" href="category.html">Add category</a></li>
              <li><a href="#">Reports</a></li>
              <li><a href="#">Logout</a></li>
              <li><a href="#">Feedback</a></li>
             </ul>
         </div>
         </nav>
    <section>
        <div class="login-form">
            <h1>LOG IN</h1> 

            <P> <br> First log into your account</P>
            <div class="container">
                <form  method="post">
            
                  <div class="input-box underline">
                  <input type="text" placeholder="Enter your username" name = 'username' required>
                    <div class="underline"></div>
                  </div>
            <div class="input-box">
                <input type="password" placeholder="Enter Your Password" name = "password" required>
                <div class="underline"></div>
              </div>
              <div class="input-box button">
                <input type="submit" name="login" value="LOG IN">
              </div>
            </form>
              <div class="option">or Connect With Social Media</div>
              <div class="twitter">
                <a href="#"><i class="fab fa-twitter"></i>Sign in With Twitter</a>
              </div>
              <div class="facebook">
                <a href="#"><i class="fab fa-facebook-f"></i>Sign in With Facebook</a>
              </div>
          </div>
            </div>
        </div>
      <div class="gallery">
        <img src="img/pexels-karolina-grabowska-4968649.jpg" class="gallery-highlight" alt="">
    
    </div>  
    </section>
</body>
</html>