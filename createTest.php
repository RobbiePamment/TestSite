<?php
	require 'adminLoggedIn.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['name']) && !empty($_POST['name'])) {
			$name = $_POST['name'];
		} else {
			$errors[] = 'quiz name is required';
		}
		if (isset($_POST['description']) && !empty($_POST['description'])) {
			$description = $_POST['description'];
		} else {
			$errors[] = 'A description is required';
		}
		if (isset($_POST['question']) && !empty(array_filter($_POST['question']))) {
			$question = $_POST['question'];
		} else {
			$errors[] = 'A quiz must have one question';
		}
		if (!isset($errors)) {
			//quiz fine so far

			include 'db.include';

			//create new test

			$sql = 'INSERT INTO Tests (Name, Description) VALUES (?, ?)';
			$query = $PDO->prepare($sql);
			$query->bindParam(1, $name);
			$query->bindParam(2, $description);
			$query->execute();
			$TID = $PDO->lastInsertId();

			//add answers
			
			foreach ($question as $key => $value) {
				$answers = $_POST[$key . '_answers'];

				$PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

				$sql = 'INSERT INTO Questions (TID, Question, Ans1, Ans2, Ans3, Ans4, CorAns) VALUES (?, ?, ?, ?, ?, ?, ?)';
				$query = $PDO->prepare($sql);
				$query->bindParam(1, $TID);
				$query->bindParam(2, $value);
				$query->bindParam(3, $answers[0]);
				$query->bindParam(4, $answers[1]);
				$query->bindParam(5, $answers[2]);
				$query->bindParam(6, $answers[3]);
				$query->bindParam(7, $_POST[$key . '_correct_value']);
				$query->execute();

				header('Location: tests.php');
				die();
			}
		}

	}




?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Test</title>
</head>
<body>
<?php if (isset($errors) && !empty($errors)) { ?>
	<?php foreach ($errors as $error) { ?>
		<span class="error"><?php echo $error; ?></span><br>
	<?php } ?>
<?php }?>
<form method="POST" action="createTest.php">
	<label for="name">Name: </label><input type="text" name="name"/><br>
	<label for="description">Description: </label><textarea name="description"></textarea><br>
	<div class="question_container">

	</div>
	<input type="button" id="add" value="Add Question"/><br>
	<input type="submit" value="save test"/>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
	index = 0;
	question = "<div class='single_question'>\
		<label>Question: </label><input type='text' name='question[]'><br>\
		<label>Answer: </label><input type='text' name='?_answers[]'><input type='radio' value='0' name='?_correct_value'=0><br>\
		<label>Answer: </label><input type='text' name='?_answers[]'><input type='radio' value='1' name='?_correct_value'=1><br>\
		<label>Answer: </label><input type='text' name='?_answers[]'><input type='radio' value='2' name='?_correct_value'=2><br>\
		<label>Answer: </label><input type='text' name='?_answers[]'><input type='radio' value='3' name='?_correct_value'=3><br>\
		</div>";

	$("#add").on("click", function(){
		$(".question_container").append($(question.replace(/\?/g, index++)));
	});
	$(".question_container").append($(question.replace(/\?/g, index++)));

</script>
</body>
</html>