<?php 
    if(isset($_POST['gFarms'])){
        if(is_numeric($_POST['fNum'])){
            for($i=1;$i<=$_POST['fNum'];$i++){
                $database->generateFarm(0,3,'Natars');
                
            }
            echo "Farms have been added successfully";
        }
    }
?>
<form action="" method="post">
	<br>
	<table class="table">
		<thead>
			<tr>
				<th colspan="3">Breed farms Natars</th>
			</tr>
		</thead>
		<tbody><tr class="slr3">
			<td>number Farmer</td>
			<td>
				<input name="fNum" class="text" type="text" value="">
			</td>
			<td>
				<input type="submit" name="gFarms" value="Birth">
			</td>
		</tr>
	</tbody></table>
</form>
<br>
