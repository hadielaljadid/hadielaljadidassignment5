<?php
require_once 'conf.php';
// Create connection
$conn = mysqli_connect($host, $user, $pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
// Check if user ID is set in session
if (!isset($_SESSION['username'])) {
    die("User ID not found in session");
}
///echo " found id";
// Fetch user ID from users_table
$username = $_SESSION['username'];
$user_query = "SELECT id FROM user WHERE username = '$username'";
$user_result = mysqli_query($conn, $user_query);
//echo " id is setted";
if (!$user_result) {
    die("Error fetching user ID: " . mysqli_error($conn));
}
//echo "it is confirmed";
$user_row = mysqli_fetch_assoc($user_result);
$user_id = $user_row['id'];

// Check if form is submitted
if(isset($_POST['ADD']))
{
    $category_name = $_POST['namecat'];
    $receipt = $_POST['receipt'];

    // Insert category into category table
    $sql = "INSERT INTO `category`(`cat_name`, `user_id`, `receipt`) VALUES ('$category_name','$user_id','$receipt')";
   echo "hi";
   $result = mysqli_query($conn , $sql);
    if (isset($result)) {
        $_SESSION['username'] = $username;
        header("Location: display.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD CATEGORY</title>
    <link rel="stylesheet" href="addcategory.css">
        
       
</head>
<body>
<nav>
        <div class = "menu">
        <div class = "logo">
         <a href="expense.html">EXPENSE TRACKER</a>
          </div>
            <ul>
            <?php
       echo '<span style="color: white;">' . $username . '</span>';
        ?>
              <li><a target ="_blank" href="expensehome.php">Homepage</a></li>
              <li><a target ="_blank" href ="login.php">Login</a></li>
              <li><a target ="_blank" href="signup.php">Signup</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Add category</a></li>
              <li><a href="#">Reports</a></li>
              <li><a target ="_self" href="login.php">Logout</a></li>
              <li><a href="#">Feedback</a></li>
             </ul>
         </div>
         </nav>
         
  <form method="POST"> 
   
   <div class="container"> 
     <div class="cat">
    <input type="text" placeholder="CATEGORY NAME" name="namecat" required />

    <input type="text" placeholder="RECEIPT" name = "receipt" required>
   </div>
   <div class="btn">
   <input type="submit" name="ADD" value="ADD CATEGORY" >
  </div>
  </form>
</div>

</body>
</html>