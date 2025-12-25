<div class="card mb-2">
    <div class="card-header">Dates server</div>
    <div class="card-body">
    <?php 
        if(isset($_POST['update'])){
            if(is_numeric($_POST['OPENING']) 
            && is_numeric($_POST['ARTEFACTS']) 
            && is_numeric($_POST['WW_PLAN'])){
                foreach($_POST as $key => $value){
                    if($key!='update'){
                        $panel->sUpdate($key, $value);
                    }
                }
                header('Location: index.php?p=natars&m');
            }else{ header('Location: index.php?p=natars&d'); }
        }

        if(isset($_GET['m'])){
            echo '<div class="alert alert-success">Settings Modification was successful</div>';
        }elseif(isset($_GET['d'])){
            echo '<div class="alert alert-danger">All entries must be numbers.</div>';
        }
    ?>
        <form action="" method="post">
        <input type="hidden" name="update" value="setting">
            <div class="form-group">
                <label>date Opening server</label>
                <input class="form-control" name="OPENING" type="text" value="<?php echo OPENING; ?>">
                <small><?php echo date('Y/m/d h:s', OPENING); ?></small>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label>date spawn artefacts</label>
                    <input class="form-control" name="ARTEFACTS" type="text" value="<?php echo ARTEFACTS; ?>">
                    <small><?php echo date('Y/m/d h:s', ARTEFACTS); ?></small>
                </div>
                <div class="col-md-6">
                    <label>date plan Building</label>
                    <input class="form-control" name="WW_PLAN" type="text" value="<?php echo WW_PLAN; ?>">
                    <small><?php echo date('Y/m/d h:s', WW_PLAN); ?></small>
                </div>
            </div>
        <hr>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Modification</button>
        </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Important</div>
    <div class="card-body">
        history time server: <?php echo date('Y/m/d h:s', time()); ?><br>
        history time second: <?php echo time(); ?>
        <br>
        <br>
    The format used for dates is <b>Timestamp</b>.<br>
        To get the timing format used, you can use one of these sites.
    <br>
    <a href="https://www.unixtimestamp.com/index.php">https://www.unixtimestamp.com/index.php</a><br>
    <a href="https://www.timestampconvert.com/">https://www.timestampconvert.com/</a><br>
    </div>
</div>