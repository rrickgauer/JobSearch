<?php include('functions.php'); ?>
<?php $companies = getAllCompaniesPositionsCount(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <?php include('header.php'); ?>
  <title>Companies</title>
</head>

<body>
  <?php include('navbar.php'); ?>
  <div class="container">
    <h1>Companies</h1>

    <div class="input-group input-group-lg">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class='bx bx-search'></i></span>
      </div>
      <input id="searchInput" type="text" class="form-control" placeholder="Search" autofocus>
    </div>

    <div id="company-cards">


    </div>

  </div>

  <script>
    $(document).ready(function() {

      updateCompanyCards('');

      $('#searchInput').on('keyup', function() {
        updateCompanyCards($('#searchInput').val());
      });
    });


    function updateCompanyCards(query) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var e = this.responseText;
          $("#company-cards").html(e);
        }
      };

      xhttp.open("GET", "get-company-cards.php?q=" + query, true);
      xhttp.send();
    }

    function gotoCompany(id) {
      window.open('company.php?companyID=' + id, '_blank');
    }
  </script>

</body>

</html>
