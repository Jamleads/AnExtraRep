<?php  session_start() ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
  </head>
  <body>
    <?php 
      if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])){
        echo $_SESSION['msg']; unset($_SESSION['msg']);
      }
    ?>
    <form action="inc/submit.php" method="POST" enctype="multipart/form-data">
      <label for="name">Name:</label>
      <input type="text" name="name" /><br />

      <label for="age">Age:</label>
      <input type="number" name="age" /><br />

      <label for="weight">Weight:</label>
      <input type="number" name="weight" /><br />

      <label for="email_id">Email id:</label>
      <input type="email" name="email_id" /><br />

      <label for="heath_report">Upload health Report:</label>
      <input type="file" name="heath_report" id="heath_report" />
      <button>Submit</button>
    </form>
  </body>
</html>
