<?php 
if(isset($_GET['add']) || isset($_GET['edit'])){
    isset($_GET['add']) ? $title = 'New news' : $title = 'Modification news';
    isset($_GET['add']) ? $button = 'add' : $button = 'Modification';
    if($_GET['edit']){
        $nData = $database->queryFetch('SELECT * FROM pnews WHERE id = '.$_GET['edit'].'');
    }
?>
<div class="card">
    <div class="card-header"><?php echo $title; ?> <a href="?p=news"><button class="btn btn-primary float-right">Return</button></a></div>
    <div class="card-body">
    <?php 
        if(isset($_POST['ncontent'])){
            if($_POST['ncontent']){
                if($_POST['edit']){
                    $database->query('UPDATE pnews SET ncontent = "'.addslashes($_POST['ncontent']).'" WHERE id ='.$_POST['edit'].'');
                    header('Location: ?p=news&edit='.$nData['id'].'');
                }else{
                    $database->query('INSERT INTO pnews VALUES(NULL, 0, 0, "'.addslashes($_POST['ncontent']).'",0 )');
                    echo '<div class="alert alert-success">Add news has been successful.</div>';
                }
            }
        }
    ?>
        <form action="" method="post">
        <?php 
            if(isset($_GET['edit'])){
                echo '<input name="edit" value="'.$nData['id'].'" type="hidden">';
            }
        ?>
            <div class="form-group">
                <textarea name="ncontent"><?php if(isset($_GET['edit'])){ echo $nData['ncontent']; } ?></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><?php echo $button; ?></button>
            </div>
        </form>
    </div>

    <script>CKEDITOR.replace('ncontent');</script>

</div>
    <?php
}else{
    if(isset($_GET['del'])){
        if(is_numeric($_GET['del'])){
            $database->query('DELETE FROM pnews WHERE id = '.$_GET['del'].'');
            header('Location: ?p=news');
        }
    }
    if(isset($_GET['hide'])){
        if(is_numeric($_GET['hide'])){
            $database->query('UPDATE `pnews` SET `hidden` = 1 WHERE id = '.$_GET['hide'].'');
            header('Location: ?p=news');
        }
    }
    if(isset($_GET['show'])){
        if(is_numeric($_GET['show'])){
            $database->query('UPDATE `pnews` SET `hidden` = 0 WHERE id = '.$_GET['show'].'');
            header('Location: ?p=news');
        }
    }
?>
<div class="card">
    <div class="card-header">
    List <b>News</b> <a href="?p=news&add"><button class="btn btn-primary float-right">New news</button></a>
    </div>

    <div class="card-body">
        <div class="table">
        <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" width="70%">news</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
        <?php $x=0; $q = $database->query('SELECT * FROM pnews WHERE uid = 0 AND nid = 0 ORDER BY id DESC'); foreach($q as $n){ $x++; ?>
            <tr>
                <th scope="row"><?php echo $x; ?></th>
                <td><?php echo $n['ncontent']; ?></td>
                <td>
                <a href="?p=news&edit=<?php echo $n['id']; ?>"><button class="btn btn-primary">Modification</button></a>
                    <a href="?p=news&del=<?php echo $n['id']; ?>"><button class="btn btn-danger">delete</button></a>
                    <a href="?p=news&<?php echo $n['hidden'] ? 'show' : 'hide'; ?>=<?php echo $n['id']; ?>"><button class="btn btn-<?php echo $n['hidden'] ? 'success' : 'danger'; ?>"><?php echo $n['hidden'] ? 'show' : 'Hide'; ?></button></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
    </div>
</div>
<?php } ?>