<?php 
include_once("../application/Models/Msg.php");

if(isset($_POST['msg'])){ // Delete MSG
    $panel->deleteMsg($_POST['msg']);
}

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $msg = $database->getMessage($_GET['id'],3);
    $input = $msg[0]['message'];
    $alliance = $msg[0]['alliance'];
    $player = $msg[0]['player'];
    $coor = $msg[0]['coor'];
    $report = $msg[0]['report'];
?>
<div class="card">
    <div class="card-header">message - <?php echo $msg[0]['topic'];?></div>
    <div class="card-body">
        <p>sender: <a href="../spieler.php?uid=<?php echo $database->getUserField($msg[0]['owner'],'id',0);?>"><?php echo $database->getUserField($msg[0]['owner'],'username',0);?></a></p>
        <p>Sent to: <a href="../spieler.php?uid=<?php echo $database->getUserField($msg[0]['target'],'id',0);?>"><?php echo $database->getUserField($msg[0]['target'],'username',0);?></a></p>
    <hr>
    <?php include("../application/BBCode.php"); echo stripslashes(nl2br($bbcoded)); ?>
    <hr>
    <a href="?p=allmsgs">
        <button class="btn btn-primary">Return</button>
    </a>
    </div>
</div>
<?php
}else{

    if(isset($_GET['pp']) && is_numeric($_GET['pp'])){
        $page = ($_GET['pp']-1) * 20;
        $msData = $database->query("SELECT * FROM mdata ORDER BY id DESC LIMIT $page,20");
    }else{
        $msData = $database->query("SELECT * FROM mdata ORDER BY id DESC LIMIT 20");
    }
?>
<div class="card">
    <div class="card-header">Player messages list</div>
    <div class="card-body table-responsive">
    <nav aria-label="Page navigation example">
        <ul class="pagination" style="float:left;">
            <li class="page-item <?php if(isset($_GET['pp']) && $_GET['pp'] != 1){ }else{ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if(isset($_GET['pp']) && $_GET['pp'] != 1){ echo '?p=allmsgs&pp='.($_GET['pp']-1); }else{ echo '#'; } ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
            </li>
            <li class="page-item">
            <a class="page-link" href="?p=allmsgs&pp=<?php echo $_GET['pp']+1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
            </li>
        </ul>
        </nav>

        <table class="table">
            <tr>
                <td>ID</td>
                <td>sender</td>
                <td>recipient</td>
                <td>Title</td>
                <td>message</td>
                <td>Operations</td>
            </tr>

            <?php
            
            foreach($msData as $ms): $msg = $database->getMessage($ms['id'],3);
            $input = $msg[0]['message'];$alliance = $msg[0]['alliance'];$player = $msg[0]['player'];$coor = $msg[0]['coor'];$report = $msg[0]['report'];
            ?>
            
                <tr>
                    <td><?php echo $ms['id']; ?></td>
                    <td><a href="../spieler.php?uid=<?php echo $database->getUserField($msg[0]['owner'],'id',0);?>"><?php echo $database->getUserField($msg[0]['owner'],'username',0);?></a></td>
                    <td><a href="../spieler.php?uid=<?php echo $database->getUserField($msg[0]['target'],'id',0);?>"><?php echo $database->getUserField($msg[0]['target'],'username',0);?></a></td>
                    <td><a href="?p=allmsgs&id=<?php echo $ms['id']; ?>"><?php echo $ms['topic']; ?></a></td>
                    <td><?php  
include("../application/BBCode.php");
echo mb_substr(stripslashes(nl2br($bbcoded)), 0, 50);

?>.....</td>
                    <td><input type="button" style="width:100%" name="btn" value="delete" id="submitBtn" data-toggle="modal" data-target="#deleteMSG<?php echo $ms['id']; ?>" class="btn btn-danger" /></td>
                </tr>
                <div class="modal fade" id="deleteMSG<?php echo $ms['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            Confirmation
                        </div>
                        <div class="modal-body">Are you sure?
                        <hr>
                        titre message: <?php echo $ms['topic']; ?>
                    </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <form action="" method="post">
                                <input type="hidden" name="msg" value="<?php echo $ms['id']; ?>">
                                <button href="#" type="submit" class="btn btn-danger danger">Confirmation</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php } ?>