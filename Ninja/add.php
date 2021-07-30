<?php 
//include config file
require_once 'config.php';
$title = $ingredients = $email =  '';
$errors = array();

if (isset($_POST['submit'])) {
	
	//check if email is empty, else post it
	if (empty($_POST['email'])) {
		$errors['email'] = 'email is required';
	}else{
		$email = $_POST['email'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'email must be a valid email address';
		}
	}
	//check if title is empty, else post it
	if (empty($_POST['title'])) {
		$errors['title'] = 'title is required';
	}else{
		$title = $_POST['title'];
		if (!preg_match('/^[a-zA-Z\s]+$/', $title)) { 
			$errors['title'] = 'title must be letters and spaces only';
		}
	}
		//check if ingredients is empty, else post it
	if (empty($_POST['ingredients'])) {
		$errors['ingredients'] = 'at least one ingredient is required'; 
	}else{ 
		$ingredients = $_POST['ingredients'];
     if (!preg_match('/^[a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) { 
			$errors['ingredients'] = "ingredients must be a comma separated list";
		}
	}
	if (array_filter($errors)) {
		
		// protect data inserted in the db
		$title = mysqli_real_escape_string($link, $_POST['title']);
		$ingredients = mysqli_real_escape_string($link, $_POST['ingredients']);
		$email = mysqli_real_escape_string($link, $_POST['email']);
		// insert into db
		$sql = "INSERT INTO pizzas(title, ingredients, email) VALUES('$title', '$ingredients', '$email')";
		//save to db and check
		if (!mysqli_query($link, $sql)) {
			echo 'query error:' . mysqli_error($link);
		}else{
			header("location: index.php");
		}

		
	}else{echo "errors in the form";}

// close conn
	mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>
<style>
	input[type='submit']{
		background-color: darkcyan;
		object-position: center;
		padding: 9px;
		margin-left:40px;
		border-radius: 16px;
	}
</style>
<?php include_once "header.php"; ?>
<section class="container grey-text">
<h4><a href="#">Add a Pizza</a> &ensp; &ensp;<a href="index.php">Back</a> </h4>
<form class="white" action="add.php" method="POST">
	<label>Pizza Title</label><br />
	<input type="text" name="title" required><br />
	<label>Ingredients (comma separated)</label><br />
	<input type="text" name="ingredients" required><br />
	<div class="center">
	<label>Your Email:</label><br />
	<input type="email" name="email" required><br />
	
		<input type="submit" name="submit" value="Submit">
	</div>
</section>
</form>
<?php include_once "footer.php"; ?>
	
</html>