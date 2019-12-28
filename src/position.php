<?php include('functions.php'); ?>

<?php

// go to home.php if get[positionID] is not set
if (!isset($_GET['positionID']) || !doesPositionExist($_GET['positionID'])) {
	header('Location: home.php');
	exit;
} else {
	$position = getFormattedPositionData($_GET['positionID'])->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html>

<head>
  <?php include('header.php'); ?>
  <title>Position</title>
</head>

<body>
  <?php include('navbar.php'); ?>


  <div class="container">


    <h1><?php echo $position['title']; ?></h1>

    <div class="dropdown float-right dropleft">
      <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='bx bx-dots-vertical-rounded'></i></button>

      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit-position-modal"><i class='bx bxs-edit'></i> Edit</a>
        <a href="#" class="dropdown-item"><i class='bx bx-trash'></i> Delete</a>

      </div>
    </div>


    <table class="table">

      <tr>
        <th>Position ID</th>
        <td><?php echo $position['id']; ?></td>
      </tr>

      <tr>
        <th>Company</th>
        <td>
          <a href="company.php?companyID=<?php echo $position['company_id']; ?>">
            <?php echo $position['company_name']; ?>
          </a>
        </td>
      </tr>

      <tr>
        <th>Date Applied</th>
        <td><?php echo $position['date_applied_display']; ?></td>
      </tr>

      <tr>
        <th>Address</th>
        <td>

          <?php

					if (strlen($position['address1']) > 0) {
						echo $position['address1'] . ',<br>';
					}

					if (strlen($position['address2']) > 0) {
						echo $position['address2'] . ',<br>';
					}

					echo $position['city'] . ', ' . $position['state'] . ', ' . $position['zip'];
					?>

        </td>
      </tr>

      <tr>
        <th>Phone</th>
        <td><?php echo $position['phone']; ?></td>
      </tr>

      <tr>
        <th>Source</th>
        <td><?php echo $position['source_found']; ?></td>
      </tr>

      <tr>
        <th>Notes</th>
        <td>
          <textarea class="form-control" rows="5"><?php echo $position['notes']; ?></textarea>

        </td>
      </tr>
    </table>

  </div>

  <!-- Modal -->
  <div class="modal fade" id="edit-position-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form" method="post" action="edit-position.php">
            <!-- position -->
            <div class="form-group">
              <label for="position">Position:</label>
              <select class="form-control" id="position" name="position" style="width: 100%;" required>

                <?php

                // get the previous recorded position names
                $positionNames = getDistinctPositionNames();

                // print them to a select input
                while ($positionName = $positionNames->fetch(PDO::FETCH_ASSOC)) {
                  echo getSelectOption($positionName['title'], $positionName['title']);
                }

                ?>
              </select>

            </div>

            <!-- company -->
            <div class="form-group">
              <label for="company">Company:</label>
              <select class="form-control" id="company" name="company" style="width: 100%;" required>
                <?php
                  $companies = getAllCompaniesData();
                  while ($company = $companies->fetch(PDO::FETCH_ASSOC)) {
                    echo getSelectOption($company['name'], $company['name']);
                  }
                  ?>
              </select>
            </div>


            <div class="form-row">
              <!-- date -->
              <div class="form-group col-md-4">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date">
              </div>

              <!-- phone-->
              <div class="form-group col-md-4">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $position['phone']; ?>">
              </div>

              <!-- source found-->
              <div class="form-group col-md-4">
                <label for="source">Source:</label>
                <input type="text" class="form-control" id="source" name="source" value="<?php echo $position['source_found']; ?>">
              </div>

            </div>

            <div class="form-row">

              <!-- address 1 -->
              <div class="form-group col-md-6">
                <label for="address1">Address 1:</label>
                <input type="text" class="form-control" id="address1" name="address1" value="<?php echo $position['address1']; ?>">
              </div>

              <!-- address 2 -->
              <div class="form-group col-md-6">
                <label for="address2">Address 2:</label>
                <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $position['address2']; ?>">
              </div>
            </div>

            <div class="form-row">

              <!-- city-->
              <div class="form-group col-md-6">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $position['city']; ?>">
              </div>

              <!-- state -->
              <div class="form-group col-md-3">
                <label for="address2">State:</label>
                <select class="form-control" name="state" id="state">
                  <?php printStatesSelection($position['state']); ?>
                </select>
              </div>

              <!-- zip-->
              <div class="form-group col-md-3">
                <label for="zip">Zip:</label>
                <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $position['zip']; ?>">
              </div>
            </div>

            <!-- notes-->
            <div class="form-group">
              <label for="notes">Notes:</label>
              <textarea class="form-control" name="notes" rows="8" cols="80"><?php echo $position['notes']; ?></textarea>
            </div>

            <!-- submit button -->
            <input class="btn btn-primary" type="submit" id="submit-edit-position-button">
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {

      // set the company select input to select2
      $("#company").select2({
        tags: true,
        dropdownParent: $('#edit-position-modal'),
        theme: 'bootstrap4',
        placeholder: "Select a company",
      });

      $("#company").val('<?php echo $position['company_name']; ?>');
      $('#company').trigger('change');

      // set the position select input to select2
      $("#position").select2({
        tags: true,
        dropdownParent: $('#edit-position-modal'),
        theme: 'bootstrap4',
        placeholder: "Select a company",
      });

      $("#position").val('<?php echo $position['title']; ?>');
      $('#position').trigger('change');

      // set the state select input to select2
      $("#state").select2({
        dropdownParent: $('#edit-position-modal'),
        theme: 'bootstrap4',
        placeholder: "Select state",
      });

      // enable the flatpickr date plugin
      $("#date").flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        defaultDate: "<?php echo $position['date_applied']; ?>"
      });

    });
  </script>

</body>

</html>

<?php

function getPositionTableRow($header, $value) {
	return "<tr><th>$header</th><td>$value</td></tr>";
}

?>
