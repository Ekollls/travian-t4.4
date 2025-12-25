<div class="card">
	<div class="card-header">Gold distribution to members</div>
	<div class="card-body">
	<?php 
		if(isset($_POST['addGold'])){
			if(is_numeric($_POST['gold'])){
				$database->query('UPDATE users SET gold = gold + '.$_POST['gold'].'');
				echo '<div class="alert alert-success">add '.$_POST['gold'].' done.</div>';

			}
		}
	?>
	
		<form action="" method="post">
		<div class="form-group">
				<label>quantity gold</label>
				<input class="form-control" name="gold" type="number" required>
			</div>
		<div class="form-group">
			<button class="btn btn-primary" name="addGold">add</button>
		</div>
		</form>
	</div>
</div>
