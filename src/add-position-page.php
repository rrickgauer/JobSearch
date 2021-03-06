<?php include('functions.php'); ?>

<?php

// check if post was sent
if (isset($_POST['company'])) {

  // check if company exists in database
  if (doesCompanyExist($_POST['company'])) {
    $companyID = getCompanyID($_POST['company']);

    // insert position
    insertPosition (
      $companyID,
      $_POST['position'],
      $_POST['date'],
      $_POST['address1'],
      $_POST['address2'],
      $_POST['city'],
      $_POST['state'],
      $_POST['zip'],
      $_POST['phone'],
      $_POST['source'],
      $_POST['notes']
    );

    // get position's id
    $positionID = getNewestPositionID();

    // go to the new positions page
    header("Location: position.php?positionID=$positionID");
    exit;

  } else {

    // insert company into database
    insertCompany($_POST['company']);

    // get the id of the new company
    $companyID = getNewestCompanyID();

    // insert the position
    insertPosition (
      $companyID,
      $_POST['position'],
      $_POST['date'],
      $_POST['address1'],
      $_POST['address2'],
      $_POST['city'],
      $_POST['state'],
      $_POST['zip'],
      $_POST['phone'],
      $_POST['source'],
      $_POST['notes']
    );

    // get position's id
    $positionID = getNewestPositionID();

    // go to the new positions page
    header("Location: position.php?positionID=$positionID");
    exit;


  }
}


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <?php include('header.php'); ?>
  <title>Add Position</title>
</head>

<body>
  <?php include('navbar.php'); ?>
  <div class="container">
    <h1 class="custom-font">Add position</h1>

    <form class="form" method="post">
      <div class="form-row">
        <!-- company -->
        <div class="form-group col-md-6">
          <label for="company">Company:</label>
          <select class="form-control" id="company" name="company" required>
            <?php
            $companies = getAllCompaniesData();
            while ($company = $companies->fetch(PDO::FETCH_ASSOC)) {
              echo getSelectOption($company['name'], $company['name']);
            }
            ?>
          </select>
        </div>

        <!-- position -->
        <div class="form-group col-md-6">
          <label for="position">Position:</label>
          <select class="form-control" id="position" name="position" required>

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
          <input type="number" class="form-control" id="phone" name="phone" min="1" step="1">
        </div>

        <!-- source found-->
        <div class="form-group col-md-4">
          <label for="source">Source:</label>
          <input type="text" class="form-control" id="source" name="source">
        </div>

      </div>


      <div class="form-row">

        <!-- address 1 -->
        <div class="form-group col-md-6">
          <label for="address1">Address 1:</label>
          <input type="text" class="form-control" id="address1" name="address1">
        </div>

        <!-- address 2 -->
        <div class="form-group col-md-6">
          <label for="address2">Address 2:</label>
          <input type="text" class="form-control" id="address2" name="address2">
        </div>
      </div>

      <div class="form-row">

        <!-- city-->
        <div class="form-group col-md-6">
          <label for="city">City:</label>
          <input type="text" class="form-control" id="city" name="city">
        </div>

        <!-- state -->
        <div class="form-group col-md-3">
          <label for="address2">State:</label>
          <select class="form-control" name="state" id="state">
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District Of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL" selected>Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
          </select>
        </div>

        <!-- zip-->
        <div class="form-group col-md-3">
          <label for="zip">Zip:</label>
          <input type="number" class="form-control" id="zip" name="zip" min="1" step="1">
        </div>
      </div>



      <!-- notes-->
      <div class="form-group">
        <label for="notes">Notes:</label>
        <textarea class="form-control" name="notes" rows="8" cols="80"></textarea>
      </div>

      <!-- submit button -->
      <input class="btn btn-primary" type="submit" id="submit-new-position-button">

    </form>
  </div>

  <script>
    $(document).ready(function() {

      // set the company select input to select2
      $("#company").select2({
        tags: true,
        theme: 'bootstrap4',
        placeholder: "Select a company",
      });

      // set the position select input to select2
      $("#position").select2({
        tags: true,
        theme: 'bootstrap4',
        placeholder: "Select a company",
      });

      // set the state select input to select2
      $("#state").select2({
        theme: 'bootstrap4',
        placeholder: "Select state",
      });

      // enable the flatpickr date plugin
      $("#date").flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        defaultDate: "today",
      });

    });
  </script>

</body>

</html>
