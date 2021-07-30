<?php
//include config file

require_once 'config.php';
// include the post method as we delete a record
if (isset($_POST['delete'])) {
 	// secure the input detail id
 	$id_to_delete = mysqli_real_escape_string($link, $_POST['id_to_delete']);
 	//prepare an sql stmt for deleting the id details
 	$sql = "DELETE FROM pizzas WHERE id = $id_to_delete";
 	//prepare a query
 	if (!mysqli_query($link, $sql)) {
 		echo 'query error:' . mysqli_error($link);
 	}else{
 		header("location: index.php");
 	}
 } 

//check GET request id param
if (isset($_GET['id'])) {
	$id = mysqli_real_escape_string($link, $_GET['id']);
	// make sql stmt
	$sql = "SELECT * FROM pizzas WHERE id = $id";
	// get the query results
	$result = mysqli_query($link, $sql);
	 // fetch result in array format ...one row needed
	$pizza = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	mysqli_close($link);
	print_r($pizza);
	}
	
?>
<!DOCTYPE html>
<html>
<?php include('header.php');?>
<div class="container center">
<h3>details</h3> 
<?php if($pizza):?>
	<h4> <?php  echo htmlspecialchars($pizza['title']);?></h4>
	<p> Created by: <?php echo htmlspecialchars($pizza['email']);?></p>
	<p><?php echo date($pizza['created_at']);?></p>
	<h5>Ingredients</h5>
	<p><?php echo htmlspecialchars($pizza['ingredients']);?></p>
	<!-- THE DELETE FORM -->
	<form action="details.php" method="POST">
		<input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'];?>">
		<input type="submit" name="delete" value="Delete">
	</form>

<?php else: ?>
<h5>pizza doesn't exist</h5>
<?php endif; ?>
</div>
<?php include('footer.php');?>

</body>
</html>