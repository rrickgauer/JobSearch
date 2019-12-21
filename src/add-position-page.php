<?php include('functions.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include('header.php'); ?>

  <!-- select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

	<title>Add Position</title>
</head>

<body>
	<?php include('navbar.php'); ?>
	<div class="container">
		<h1>Add position</h1>


		<form class="form" method="post">

      <!-- company -->
      <div class="form-group">
        <label for="company"><b>Company:</b></label>
        <select class="form-control" id="company" name="company">
          <?php
          $companies = getAllCompaniesData();
          while ($company = $companies->fetch(PDO::FETCH_ASSOC)) {
            echo getSelectOption($company['id'], $company['name']);
          }
          ?>
        </select>
      </div>


      <!-- position -->
			<div class="form-group">
				<label for="position"><b>Position:</b></label>
				<input type="text" class="form-control" id="position">
			</div>



		</form>
	</div>

  <script>

  $(document).ready(function() {

    // set the company select inut to select2
    $("#company").select2({
      tags: true
    });

  });

  </script>

</body>

</html>
