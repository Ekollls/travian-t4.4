<div class="card">
<div class="card-header">Control records</div>
<div class="card-body">
<?php 
if(isset($_POST['rEdit'])){
    if($_POST['regstatus']){
        $database->query("UPDATE config SET regstatus = 1");
    }else{
        $database->query("UPDATE config SET regstatus = 0");
    }

    echo '<div class="alert alert-success">Modification has been successfully registered</div>';
}
?>

<form action="" method="post">
	<div class="form-group">
		<label>register</label>
		<select class="form-control" name="regstatus">
            <option <?php if($database->config()['regstatus']){ echo 'selected'; } ?> value="1">enable</option>
            <option <?php if(!$database->config()['regstatus']){ echo 'selected'; } ?> value="0">disable</option>
            </select>

	</div>
	<div class="form-group">
		<button name="rEdit" class="btn btn-primary">Modification</button>
	</div>
</form>
</div>
</div>
