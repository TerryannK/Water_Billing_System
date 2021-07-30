<?php
// include conn file
require_once 'config.php';
// write the query
 $sql = "SELECT title, ingredients, id FROM pizzas ORDER BY created_at";

//make query and get the result
 $result = mysqli_query($link, $sql);
 // fetch resulting rows as an array
 $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
 // print_r($pizzas);
 //print_r(explode(',', $pizzas[0]['ingredients']));

 // we don need them anymore so we free them
 mysqli_free_result($result);
 // close conn
 mysqli_close($link);

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/cs/head">

<?php include('header.php');?>
<h4><b style="text-align: center">Pizzas!</b></h4>
<div class="container">
	<div class="row">
		<?php foreach ($pizzas as $pizza) :?>
		<div class="col s6 md3">
			<div class="card">
				<div class=" card-content center">
					<h5><?php echo htmlspecialchars($pizza['title'])?></h5>
					<ul>
						<?php foreach(explode(',', $pizza['ingredients']) as $ingre):?>
							<li><?php echo htmlspecialchars($ingre)?>  </li>
						<?php endforeach ?>
					</ul>
					
				</div>
				<div class="text-align: right">
					<a href="details.php?id=<?php echo $pizza['id']?>"><u><h6>more info</h6> </u></a>
				</div>
			</div>
			
		</div>	  
		<?php endforeach?>
	</div>
	
</div>
<?php include('footer.php');?>
</html>