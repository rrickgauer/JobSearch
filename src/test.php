<?php include('functions.php'); ?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <?php include('header.php'); ?>

 

  <title>Add Position</title>
</head>

<body>
  <?php include('navbar.php'); ?>

  <div class="container">

    <h1>Test</h1>

    <form class="form" method="post">

      <select class="form-control" name="select-me">
        <option value="yo">yo</option>
        <option value="2">2</option>
      </select> <br>

      <input type="submit" name="hi" class="btn btn-primary" value="Submit">
      


    </form>

    <?php

    echo '<h1>' . $_POST['select-me'] . '</h1>';


    ?>




  </div>
  

  <script>
    $(document).ready(function() {

      // set the company select input to select2
      $("select").select2({
        tags: true,
        theme: 'bootstrap4',
        placeholder: "Select a company",
        allowClear: true
      });

      

      

    });
  </script>

</body>

</html>
