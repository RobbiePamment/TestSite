<?php
	//check post is submited
	//check the test stuff
	//import db file
	//save to db
	//redirect to test pages
	// include 'db.include';

	// $sql = 'SELECT * FROM `Tests`';
	// $query = $PDO->query($sql);
	// $query->execute();
	// //$results = $query->fetchAll();
	var_dump($_GET);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Test</title>
</head>
<body>
<form method="GET" action="createTest.php">
	Name: <input type="text" name="name"/><br>
	Description: <textarea name="Desc"></textarea><br>
	Question: <input type="text" name="question[]"><br>
	Answer: <input type="text" name="answers[]"><input type="checkbox" name="correct[]" value="1"><br>
	Answer: <input type="text" name="answers[]"><input type="checkbox" name="correct[]" value="2"><br>
	Answer: <input type="text" name="answers[]"><input type="checkbox" name="correct[]" value="3"><br>
	Answer: <input type="text" name="answers[]"><input type="checkbox" name="correct[]" value="4"><br>
	Question: <input type="text" name="question[]"><br>
	Answer: <input type="text" name="answers[]"><input type="checkbox" name="correct[]" value="1"><br>
	Answer: <input type="text" name="answers[]"><input type="checkbox" name="correct[]" value="2"><br>
	Answer: <input type="text" name="answers[]"><input type="checkbox" name="correct[]" value="3"><br>
	Answer: <input type="text" name="answers[]"><input type="checkbox" name="correct[]" value="4"><br>
	<input type="button" value="Add Question"/><br>
	<input type="submit" value="save test"/>
</form>
</body>
</html>