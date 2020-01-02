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
    <h1 class="custom-font">Companies</h1>

    <div class="input-group input-group-lg">
      <input id="searchInput" type="text" class="form-control" placeholder="Search" autofocus>
      <div class="input-group-append">
        <button id="clear-input" class="btn btn-outline-secondary" type="button"><i class='bx bx-x-circle'></i></button>
      </div>
    </div>

    <div id="company-cards">


    </div>

  </div>

  <script>
    $(document).ready(function() {

      $("#companies-navbar-link").addClass('selected');

      updateCompanyCards('');

      $('#searchInput').on('keyup', function() {
        updateCompanyCards($('#searchInput').val());
      });


      $("#clear-input").on('click', function() {
        $("#searchInput").val('');
        updateCompanyCards('');
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
