<?php 
if(isset($_GET['replay'])){
    $msData = $database->queryFetch('SELECT * FROM support WHERE id = '.$_GET['replay'].'');
    if(!$msData['id']){ header('Location: ?p=support'); die(); }
    ?>
<div class="card">
    <div class="card-header">Reply - <?php echo $msData['name']; ?> <a href="?p=support"><button class="btn btn-primary float-right">Return</button></a></div>
    <div class="card-body">
    <?php 
    if(isset($_POST['replay']) && $_POST['replay']){
        if($Mails->sendMessage($msData['email'], $_POST['replay'])){
            echo '<div class="alert alert-success">was sent.</div>';
        }else{
            echo '<div class="alert alert-danger">there is problem in SMTP Mailer.</div>';
        }
    }
    ?>
    <span>name: <?php echo $msData['name']; ?></span><br>
    <span>server: <?php echo $msData['server']; ?></span><br>
    <span>Section: <?php echo $msData['category']; ?></span><br>
    <span>mail : <?php echo $msData['email']; ?></span><br>
    <span>Sending Date: <?php echo date('Y/m/d H:i:s',$msData['sdate']); ?></span>
    <hr>

        <form action="" method="post">
            <textarea name="replay">
                <blockquote>
                <p><?php echo $msData['message']; ?></p>
                </blockquote><br>

            </textarea>
            <hr>
            <button type="submit" class="btn btn-primary">send</button>
        </form>
    
    </div>
</div>
<script>CKEDITOR.replace('replay');</script>
    <?php
}else{
    if(isset($_GET['del'])){
        $database->query('DELETE FROM support WHERE id = '.$_GET['del'].'');
        header('Location: ?p=support');
    }
?>

<div class="card">
    <div class="card-header">Support messages</div>
    <div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">message</th>
                <th scope="col">Section</th>
                <th scope="col">Sending Date</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $sList = $database->query('SELECT * FROM support ORDER BY id DESC');
            foreach($sList as $s):
        ?>
            <tr>
                <th scope="row"><?php echo $s['id']; ?></th>
                <td><p><?php echo $s['message']; ?></p></td>
                <td><p><?php echo $s['category']; ?></p></td>
                <td><p><?php echo date('Y/m/d H:i:s', $s['sdate']); ?></p></td>
                <td>
                    <a href="?p=support&replay=<?php echo $s['id']; ?>"><button class="btn btn-primary">reply</button></a>
                    <a href="?p=support&del=<?php echo $s['id']; ?>"><button class="btn btn-danger">delete</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
                </tbody>
        </table>    </div>
</div>
<?php } ?>