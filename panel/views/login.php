


<div class="col-md-6 mx-auto mt-5">
<div class="card">
	<div class="card-header">Log in</div>
	<div class="card-body">
		<form method="post" action="index.php">
			<input type="hidden" name="action" value="login">
			
			<div class="form-group">
			<label>username</label>
				<input class="form-control" type="text" name="name" value="<?php echo $_SESSION['username']?>" maxlength="15">
			</div>

			<div class="form-group">
			<label>password</label>
				<input class="form-control" type="password" name="pw">
			</div>
			<hr>
			<button type="submit" class="btn btn-primary">Login</button>
		</form>	
	</div>
</div>
</form>
</div>