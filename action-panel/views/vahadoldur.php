<?php 
    if(isset($_POST['vahadoldur'])){
		include("../../application/config.php");


	
		$stmt=$baglanDB->prepare("UPDATE odata SET wood=maxstore,clay=maxstore,iron=maxstore,crop=maxcrop WHERE owner=4");
		$stmt->execute([3]);


		echo "Depolar dolduruldu";
    }
?>
<form action="" method="post">
	<div class="form-group text-center">
		<input type="submit" class="btn btn-primary" name="vahadoldur" value="Vahaları Doldur">
	</div>
</form>
<br>
