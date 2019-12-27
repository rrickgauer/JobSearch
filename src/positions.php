<?php include('functions.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <?php include('header.php'); ?>

  <!-- boxicons -->
  <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>

  <!-- bootstrap table -->
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css" />


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

          $pdo = dbConnect();
          $sql = $pdo->prepare('SELECT * FROM Positions');
          $sql->execute();

          while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';

            $id = $row['id'];
            $title = $row['title'];

            echo '<td>' . $row['title'] . '</td>';
            echo '<td>' . $row['company_id'] . '</td>';
            echo '<td>' . $row['date_applied'] . '</td>';
            echo "<td><a href=\"position.php?positionID=$id\">Details</a></td>";
            echo '</tr>';
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







  <!-- bootstrap table -->
  <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
</body>

</html>
