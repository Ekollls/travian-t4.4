<div class="card">
<div class="card-header">Mail list</div>
<div class="card-body">
<?php 
    $players = $database->query('SELECT * FROM users WHERE id > 6 ORDER BY id ');

    foreach($players as $p){
        echo $p['email'];
        echo '<br>';
    }
?>
</div>