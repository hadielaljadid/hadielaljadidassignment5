<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="expense.css">
  <title>Display all categories from Database</title>
</head>

<body>
<div class="container">
  <h2>Details</h2>
  <form action="#" method="post" enctype="multipart/form-data">

    <table border="2">
      <tr>
        <td>Category name</td>
        <td>Receipt</td>
        <td>Edit</td>
        <td>Delete</td>
      </tr>

      <?php

      require_once 'conf.php';
      $conn = mysqli_connect($host, $user, $pass ,$db_name); // Using database connection file here
      if ($conn->connect_error) {
        echo '<p>Error: Could not connect to database.<br/>
    Please try again later.<br/></p>';
        echo $conn->error;
        exit;
      }
      $sql = "SELECT `cat_name`, `receipt` FROM  `category` ";
      //echo $query;
      
      $result = $conn->query($sql);
      if (!$result) {
        echo "<p>Unable to execute the query.</p> ";
        echo $query;
        die($conn->error);
      }
      // fetch data from database
      
      while ($data = $result->fetch_array(MYSQLI_ASSOC)) {
        ?>
        <tr>
          <td>
            <?php echo $data['cat_name']; ?>
          </td>
          <td>
            <?php echo $data['receipt']; ?>
          </td>
         
    
          <td><a href="edit.php?cat_name=<?php echo $data['cat_name']; ?>">Edit</a></td>
       
          </td>

        </tr>
        <?php
      }
      ?>
    </table>

  </form>
    </div>
</body>

</html>