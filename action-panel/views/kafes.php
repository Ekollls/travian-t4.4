<div class="card">
	<div class="card-header">Açık Artırmaya Kafes Ekle</div>
	<div class="card-body">
	<?php 
		if(isset($_POST['addGold'])){
			if(is_numeric($_POST['gold'])){
			
				 // maybe i'll user later
$min = 10800;
$max = 13002;
                 $zaman9 = rand($min, $max)+time();
				 $zaman8 = $zaman9+1200;
				 $zaman7 = $zaman9+2300;
					$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES ('0', '4', '9', '114', '".$_POST['gold']."', '0', '0', '100', '0', '".$zaman9."', '0')");
					
					
					$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES ('0', '4', '9', '114', '".$_POST['gold']."', '0', '0', '100', '0', '".$zaman8."', '0')");
					
					$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES ('0', '4', '9', '114', '".$_POST['gold']."', '0', '0', '100', '0', '".$zaman7."', '0')");
					
					echo '<div class="alert alert-success"> Kafes Eklendi Başarılı !</div>';
				
			}
		}
	?>
		<form action="" method="post">
		<div class="form-group">
				<label>Eklenecek Kafes Sayısı</label>
				<input class="form-control" name="gold" type="number" required>
			</div>
		<div class="form-group">
			<button class="btn btn-primary" name="addGold">Ekle</button>
		</div>
		</form>
	</div>
</div>
