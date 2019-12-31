<?php include('functions.php'); ?>

<?php


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <?php include('header.php'); ?>
  <title>Questions</title>
</head>

<body>
  <?php include('navbar.php'); ?>

  <div class="container">

    <h2>New Question</h2>
    <form class="form" method="post">
      <input type="text" name="question" class="form-control" placeholder="Question">
      <textarea name="answer" rows="12" class="form-control" placeholder="Answer"></textarea>
      <input type="submit" value="Submit" class="btn btn-primary">
    </form>










  </div>

</body>

</html>
