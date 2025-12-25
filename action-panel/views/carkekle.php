<div class="card">
	<div class="card-header">Çark Ekle</div>
	<div class="card-body">
	<?php 
		if(isset($_POST['addGold'])){
			if(is_numeric($_POST['gold'])){
				$uData = $database->queryFetch('SELECT id,gold,cark,username FROM users WHERE id = '.$_POST['user'].'');
				if($uData['id']){
					$oldGold = $uData['gold']; // maybe i'll user later
					$database->query('UPDATE users SET cark = cark + '.$_POST['gold'].' WHERE id = '.$_POST['user'].'');
					
					echo '<div class="alert alert-success"> Başarıyla '.$_POST['gold'].' Çark '.$uData['username'].' Oyuncusuna Eklendi.</div>';
				}
			}
		}
	?>
		<form action="" method="post">
		<div class="form-group">
				<label>Vereceğiniz Çark Miktarı</label>
				<input class="form-control" name="gold" type="number" required>
			</div>
		<div class="form-group">
			<label>Oyuncu</label>
			<select class="form-control" name="user" required>
				<?php foreach($database->query('SELECT username,id FROM users WHERE id > 5') as $user): ?>
					<option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" name="addGold">Ekle</button>
		</div>
		</form>
	</div>
</div>
