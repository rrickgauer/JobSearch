<?php include('functions.php'); ?>
<?php $company = getCompanyData($_GET['companyID']); ?>

<!DOCTYPE html>
<html>

<head>
  <?php include('header.php'); ?>

  <title></title>
</head>

<body>
  <?php include('navbar.php'); ?>

  <div class="container">

    <h1><?php echo $company['name']; ?></h1>

    <div class="card">

      <div id="myToolbar">

        <input type="text" name="search" class="search-input form-control">
      </div>

      <div class="card-header">
        <h2>Lastest positions</h2>

      </div>

      <div class="card-body">
        <table>
          <thead>
            <tr>
              <th data-field="position" data-sortable="true">Position</th>
              <th data-field="date" data-sortable="true">Date Applied</th>
              <th data-field="details" data-sortable="true">Detail Link</th>
            </tr>
          </thead>

          <tbody>

            <?php
              $positions = getCompanyPositions($_GET['companyID']);
              while ($position = $positions->fetch(PDO::FETCH_ASSOC)) {
                $positionID = $position['id'];
                echo '<tr>';
                echo '<td>' . $position['title'] . '</td>';
                echo '<td>' . $position['date_applied_format'] . '</td>';
                echo "<td><a href=\"position.php?positionID=$positionID\" target=\"_blank\">Details</a></td>";
                echo '</tr>';
              }
            ?>

          </tbody>
        </table>
      </div>

    </div>

  </div>

  <script>
    var table = $("table");

    table.bootstrapTable({
      classes: 'table table-striped table-sm',
    });






  </script>


</body>

</html>
