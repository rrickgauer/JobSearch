<?php include('functions.php'); ?>

<?php

if (isset($_POST['question']) && isset($_POST['answer'])) {
  insertQuestion($_POST['question'], $_POST['answer']);
}

$questions = getQuestions();



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include('header.php'); ?>
	<title>Questions</title>
</head>

<body>
	<?php include('navbar.php'); ?>

	<div class="container">

		<h1 class="custom-font">Questions</h1>

    <div class="input-group mb-3">
      <input id="questionSearchInput" type="text" class="form-control" placeholder="Search">

      <div class="input-group-append">
        <button class="btn btn-outline-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='bx bx-dots-horizontal-rounded'></i></button>
        <div class="dropdown-menu">
          <a class="dropdown-item" data-toggle="modal" data-target="#new-question-modal" href="#">New Question</a>
        </div>
      </div>

    </div>


    <div id="question-cards">
    </div>






	</div>

	<!-- new question modal -->
	<div class="modal fade" id="new-question-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">New Question</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="form" method="post">
						<input id="questionInput" type="text" name="question" class="form-control" placeholder="Question" onkeyup="isBlank()">
						<textarea id="textAreaInput" name="answer" rows="12" class="form-control" placeholder="Answer" onkeyup="isBlank()"></textarea>
						<input id="submitButton" type="submit" value="Submit" class="btn btn-primary" disabled>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$("#questions-navbar-link").addClass('selected');

      updateQuestionTable('');

			$('#questionSearchInput').on('keyup', function() {
				updateQuestionTable($('#questionSearchInput').val());
			});
		});

		function isBlank() {
			if (document.getElementById("questionInput").value === "" || document.getElementById("textAreaInput").value === "") {
				document.getElementById('submitButton').disabled = true;
			} else {
				document.getElementById('submitButton').disabled = false;
			}
		}

		function updateQuestionTable(query) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var e = this.responseText;
					$("#question-cards").html(e);
				}
			};

			xhttp.open("GET", "get-questions-table.php?q=" + query, true);
			xhttp.send();
		}
	</script>

</body>

</html>
