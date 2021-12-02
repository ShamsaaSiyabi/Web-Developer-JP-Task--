<!DOCTYPE html>

<html>

<head>
  <title>Students Dashboard</title>
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <link href="styles.css" type="text/css" rel="stylesheet" />
  <meta charset="utf-8" />

</head>

<body>
  <?php require_once 'process.php'; ?>

  <?php

  if (isset($_SESSION['message']));  ?>

  <div class="alert alert-<?=$_SESSION['msg_type']?> " >

    <?php 
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    
    ?>
</div>

<?php endif ?>


  <div class="container">
  <?php

  $mysqli = new mysqli('localhost', 'user', 'pass', 'crud') or die(mysqli_error($mysqli));
  $result = $mysqli->query("select * from data") or die($mysqli->error);
  //data is table 
  //pre_r($result);
  //pre_r($result->fetch_assoc());
  ?>

  <div class="row justify-content-center">

    <table class="table">
      <thead>

        <tr>
          <th>Name </th>
          <th>Country</th>
          <th>Class</th>
          <th>Day of Birth</th>

        </tr>
      </thead>
  <?php
      while($row = $result-> fetch_assoc())  ?>
        <tr>
          <td><?php  echo $row['name'] ?></td>
          <td><?php  echo $row['country'] ?></td>
          <td><?php  echo $row['classname'] ?></td>
          <td><?php  echo $row['dob'] ?></td>
          <td><a href="index.php?edit=<?php echo $row['id']; ?>"
                 class="btn btn-info">Edit </a>
              <a href="process.php?delete=<?php echo $row['id']; ?>"
                 class="btn btn-danger">Delete</a>
        
        </td>
          
        </tr>
        <?php endwhile; ?>

    </table>

  </div>


  <?php
  function pre_r($array)
  {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
  }

  ?>


  <div class="row justify-content-center">
    <form action="process.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id ?>">

      <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" 
        value= "<?php  echo $name; ?>" placeholder="Enter your name! ">
      </div>
      <div class="form-group">
        <label>Country</label>
        <input type="text" name="country" class="form-control" 
        value="<?php  echo $country; ?>"  placeholder="Enter your country!">
      </div>
      <div class="form-group">
        <?php 
        
        if ($update== true):
          ?>
          <button type="submit" class="btn btn-info" name="update">Update</button>

        <?php else: ?>

        <button type="submit" class="btn btn-primary" name="save">Save</button>
     <?php endif; ?>
      </div>

    </form>
  </div>
  </div>

</body>

</html>