<?php include('functions.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <?php include('header.php'); ?>
  <title>Positions</title>
</head>

<body>
  <?php include('navbar.php'); ?>

  <div class="container">

    <h1>Positions</h1>

    <button type="button" name="button" onclick="enableCardView()" class="btn btn-primary">Card View</button>


    <table class="table table-sm table-striped" data-toggle="table" data-search="true" data-show-columns="true" data-sortable="true" data-show-columns-toggle-all="true">
      <thead>
        <tr>
          <th data-field="position" data-sortable="true">Position</th>
          <th data-field="company" data-sortable="true">Company</th>
          <th data-field="date" data-sortable="true" data-visible="true">Date Applied</th>
          <th data-field="details" data-sortable="true" data-visible="true">Details</th>
        </tr>
      </thead>

      <tbody>

        <?php
        $positions = getPositionsTableData();
        while ($row = $positions->fetch(PDO::FETCH_ASSOC)) {
            echo getTableRow($row);
        }
        ?>

      </tbody>
    </table>


  </div>

  <script>
    function detailFormatter(index, row) {
      return '<a href="google.com">Details</a>';
    }

    var table = $("table");

    function enableCardView() {
      $(table).bootstrapTable('toggleView')
    }
  </script>
</body>

</html>

<?php

function getTableRow($row) {
  $id = $row['id'];
  $title = $row['title'];
  $date = $row['date_applied'];
  $companyName = $row['company_name'];
  $companyID = $row['company_id'];

  $positionCell = "<td>$title</td>";
  $companyCell =  "<td><a href=\"company.php?companyID=$companyID\">$companyName</a></td>";
  $dateCell = "<td>$date</td>";
  $detailsCell =  "<td><a href=\"position.php?positionID=$id\" target=\"_blank\">Details</a></td>";

  return '<tr>' . $positionCell . $companyCell . $dateCell . $detailsCell . '</tr>';

}




?>
