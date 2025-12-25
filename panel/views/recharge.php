<div class="card">
    <div class="card-header">Recharge a gold package to the player</div>
    <div class="card-body">
    <?php 
        if(isset($_POST['addGold'])){
            if(is_numeric($_POST['goldA']) && is_numeric($_POST['uid'])){
                $database->query("UPDATE users SET gold = gold + ".$_POST['goldA']." WHERE id = ".$_POST['uid']."");
                $database->sendMessage($_POST['uid'], 6, 'Charged', 'Your account has been charged with '. $_POST['goldA']. ' gold. ', 0, 0, 0, 0,0);
                echo '<div class="alert alert-success">The player order has shipped successfully.</div>';
            }else{
                echo '<div class="alert alert-danger">Wrong entries.</div>';
            }
        }
    ?>
        <form action="" method="post">
        <input type="hidden" name="addGold" value="1">
        <div class="form-group">
        <label>gold</label>
            <select name="goldA" class="form-control">
            <?php foreach($packages as $package){ ?>
                <option value="<?php echo $package['gold']; ?>">Pack <?php echo $package['cost'].$package['currency']; ?> - Top <?php echo $package['gold']; ?> gold</option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
        <label>player</label>
            <select name="uid" class="form-control">
            <?php 
                $users = $database->query('SELECT id,username FROM users WHERE id >5');
                foreach($users as $user){
            ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Confirmation</button>
        </div>
        </form>
    </div>
</div>