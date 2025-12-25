<div class="card">
    <div class="card-header">
    Server settings
    </div>
    <div class="card-body">
    <?php 
        if(isset($_POST['update'])){
            if(is_numeric($_POST['SPEED']) &&
            is_numeric($_POST['INCREASE_SPEED']) &&
            is_numeric($_POST['STORAGE_MULTIPLIER']) &&
            is_numeric($_POST['CRANNY_CAP']) &&
            is_numeric($_POST['TRAPPER_CAPACITY']) &&
            is_numeric($_POST['DEFAULT_GOLD']) &&
            is_numeric($_POST['OASISX']) &&
            is_numeric($_POST['MOMENT_TRAIN']) &&
            is_numeric($_POST['PROTECTIOND']) &&
            is_numeric($_POST['ADV_TIME']) &&
            is_numeric($_POST['AUCTIONTIME']) 
            ){
                foreach($_POST as $key => $value){
                    if($key!='update'){
                        $panel->sUpdate($key, $value);
                    }
                }
                header('Location: index.php?p=setting&m');
            }else{ header('Location: index.php?p=setting&d'); }
        }

        if(isset($_GET['m'])){
            echo '<div class="alert alert-success">Settings Modification was successful</div>';
        }elseif(isset($_GET['d'])){
            echo '<div class="alert alert-danger">There are wrong entries.</div>';
        }

    ?>
        <form action="" method="post">
        <input type="hidden" name="update" value="setting">
        <div class="form-group row">
        <div class="col-md-6">
                <label>titre server</label>
                <input class="form-control" name="SERVER_NAME" type="text" value="<?php echo SERVER_NAME; ?>" required>
            </div>
            <div class="col-md-6">
                <label>link server</label>
                <input class="form-control" name="HOMEPAGE" type="text" value="<?php echo HOMEPAGE; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label>mail server - send activation messages</label>
            <input class="form-control" name="adminMail" value="<?php echo adminMail; ?>" required>
        </div>

        <div class="form-group">
            <label>speed server</label>
            <input class="form-control" name="SPEED" value="<?php echo SPEED; ?>" required>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>speed Forces</label>
                <input class="form-control" name="INCREASE_SPEED" value="<?php echo INCREASE_SPEED; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label>storage</label>
                <input class="form-control" name="STORAGE_MULTIPLIER" value="<?php echo STORAGE_MULTIPLIER; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>cranny</label>
                <input class="form-control" name="CRANNY_CAP" value="<?php echo CRANNY_CAP; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label>traps</label>
                <input class="form-control" name="TRAPPER_CAPACITY" value="<?php echo TRAPPER_CAPACITY; ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>gold start</label>
                <input class="form-control" name="DEFAULT_GOLD" value="<?php echo DEFAULT_GOLD; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label>Oasis proportions</label>
                <input class="form-control" name="OASISX" value="<?php echo OASISX; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Prompt training in a second</label>
                <select name="MOMENT_TRAIN" class="form-control">
                    <option <?php if(MOMENT_TRAIN == 1){ echo "selected"; } ?> value="1">yes</option>
                    <option <?php if(MOMENT_TRAIN == 0){ echo "selected"; } ?> value="0">no</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Protection duration</label>
                <select name="PROTECTIOND" class="form-control">
                    <option <?php if(PROTECTIOND == 0){ echo "selected"; } ?> value="1">No Protec</option>
                    <option <?php if(PROTECTIOND == 43200){ echo "selected"; } ?> value="43200">12 hour</option>
                    <option <?php if(PROTECTIOND == 86400){ echo "selected"; } ?> value="86400">24 hour</option>
                    <option <?php if(PROTECTIOND == 172800){ echo "selected"; } ?> value="172800">2 days</option>
                    <option <?php if(PROTECTIOND == 259200){ echo "selected"; } ?> value="259200">3 days</option>
                    <option <?php if(PROTECTIOND == 345600){ echo "selected"; } ?> value="345600">4 days</option>
                    <option <?php if(PROTECTIOND == 432000){ echo "selected"; } ?> value="432000">5 days</option>
                    <option <?php if(PROTECTIOND == 518400){ echo "selected"; } ?> value="518400">6 days</option>
                    <option <?php if(PROTECTIOND == 604800){ echo "selected"; } ?> value="604800">7 days</option>
                </select>
            </div>
        </div>
        <hr>
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Adventures Daily number</label>
                    <input name="ADV_TIME" value="<?php echo $sData['ADV_TIME']; ?>" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>duration auction seconds</label>
                    <input name="AUCTIONTIME" value="<?php echo AUCTIONTIME; ?>" class="form-control">
                </div>
            </div>
        <hr>
        <div class="form-group">
            <button class="btn btn-primary">save</button>
        </div>
        </form>
    </div>
</div>