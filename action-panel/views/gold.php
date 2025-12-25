<div class="card">
	<div class="card-header">Tüm oyunculara altın gönder</div>
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
				<label>Altın Gönder</label>
				<input class="form-control" name="gold" type="number" required>
			</div>
		<div class="form-group">
			<button class="btn btn-primary" name="addGold">add</button>
		</div>
		</form>
	</div>
</div>

<div class="card">
	<div class="card-header">Tüm oyunculara Çark gönder</div>
	<div class="card-body">
	<?php 
		if(isset($_POST['addcark'])){
			if(is_numeric($_POST['cark'])){
				$database->query('UPDATE users SET cark = cark + '.$_POST['cark'].'');
				echo '<div class="alert alert-success">add '.$_POST['cark'].' done.</div>';

			}
		}
	?>
	
		<form action="" method="post">
		<div class="form-group">
				<label>Çark Gönder</label>
				<input class="form-control" name="cark" type="number" required>
			</div>
		<div class="form-group">
			<button class="btn btn-primary" name="addcark">add</button>
		</div>
		</form>
	</div>
</div>

