<?php 
    $users = $database->query('SELECT * FROM users WHERE id > 6');
    if(isset($_POST['mgold'])){
        if(is_numeric($_POST['mgoldN'])){
            
            $q = $database->query('UPDATE users SET gold = gold - '.$_POST['mgoldN'].' WHERE id = '.$_POST['p'].'');
            echo "discount".$_POST['mgoldN']." gold From player Successfully.";     
        }
    }
?><form action="" method="post">
	<br />
	<table class="table">
		<thead>
			<tr>
			    <th colspan="3">Discount gold</th>
			</tr>
		</thead>
		<tr class="slr3">
			<td>
				<select name="p" size="1" class="slr3">
                <?php foreach($users as $u): ?>
					<option value="<?php echo $u['id']; ?>" <?php if($_POST['p']==$u['id']){echo "selected";}?>><?php echo $u['username']; ?></option>
                <?php endforeach; ?>
				</select>
			</td>
			<td>
                <label>Quantity Discounted</label>
				<input name="mgoldN" type="text" class="text" value="<?php echo $_POST['mgoldN'];?>">
			</td>
			<td>
				<input type="submit" value="Discount" name="mgold">
			</td>
		</tr>
	</table>
</form>
