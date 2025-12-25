<?php 
    if(isset($_POST['gFarms'])){
        if(is_numeric($_POST['fNum'])){
            for($i=1;$i<=$_POST['fNum'];$i++){
                $database->generateFarm($_POST['hlxVektor'],$_POST['hlxUid'],$_POST['hlxPop'],$_POST['hlxName']);
            }
            echo "Farms have been added successfully";
        }
    }
	$kullanicilar=$database->query('SELECT id,username FROM users');
?>
<form action="" method="post">
	<div class="form-group">
		<label>Villa Adı</label>
		<input type="text" name="hlxName" class="form-control" placeholder="Farm Villa" required>
	</div>
	<div class="form-group">
		<label>Villa Sayısı</label>
		<input type="number" step="1" name="fNum" class="form-control" placeholder="10" required>
	</div>
	<div class="form-group">
		<label>Nüfus Sayısı</label>
		<input type="number" step="1" name="hlxPop" class="form-control" placeholder="1000" required>
	</div>
	<div class="form-group">
		<label>Sektör</label>
		<select class="custom-select mr-sm-2" name="hlxVektor" required>
			<option value="25">25x25</option>
			<option value="50">50x50</option>
			<option value="75">75x75</option>
			<option value="100">100x100</option>
		</select>
	</div>
	<div class="form-group">
		<label>Kullanıcı</label>
		<select class="custom-select mr-sm-2" name="hlxUid" required>
			<?php
				foreach($kullanicilar as $kullanici){
					echo '<option value="'.$kullanici['id'].'">'.$kullanici['username'].'</option>';
				}
			?>
		</select>
	</div>
	<div class="form-group text-center">
		<input type="submit" class="btn btn-primary" name="gFarms" value="Oluştur">
	</div>
</form>
<br>
