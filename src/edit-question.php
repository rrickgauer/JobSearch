<?php
include('functions.php');

if (isset($_POST['question']) && isset($_POST['answer'])) {
  updateQuestion($_GET['questionID'], $_POST['question'], $_POST['answer']);
  header('Location: questions.php');
  exit;
}

$question = getQuestion($_GET['questionID']);
$question = $question->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include('header.php'); ?>
	<title>Edit question</title>
</head>

<body>
	<?php include('navbar.php'); ?>

	<div class="container">
		<h1 class="custom-font">Edit Question</h1>

		<form class="form" method="post">
			<input type="text" name="question" class="form-control" value="<?php echo $question['question']; ?>" placeholder="Question"> <br>
			<textarea name="answer" rows="15" class="form-control" placeholder="Answer"><?php echo $question['answer']; ?></textarea><br>
      <input type="submit" name="" value="Save" class="btn btn-primary">
		</form>
	</div>
</body>

</html>
