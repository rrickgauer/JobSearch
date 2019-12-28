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

    <div id="toolbar">
      <!-- <input type="text" name="search" class="form-control search"> -->

      <div class="form-group search">
        <input name="search" class="form-control search-input" type="text" placeholder="Search">
      </div>

    </div>


    <!-- <table class="table table-sm table-striped" data-toggle="table" data-search="true" data-show-columns="true" data-sortable="true" data-show-columns-toggle-all="true"> -->
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

  <script>
    var table = $("table");

    table.bootstrapTable({
      classes: 'table table-striped',
      search: 'true',
      // showColumns: 'true',
      // showColumnsToggleAll: 'true',
      toolbar: '#toolbar'

    });
  </script>


</body>

</html>
