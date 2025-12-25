<div class="card">
    <div class="card-header">Plus Settings</div>
    <div class="card-body">
    <?php 
        if(isset($_POST['update'])){
            if(is_numeric($_POST['goldClub']) && 
            is_numeric($_POST['Plus']) && 
            is_numeric($_POST['PLUS_TIME']) && 
            is_numeric($_POST['addonProduction']) &&
            is_numeric($_POST['PLUS_PRODUCTION']) &&
            is_numeric($_POST['plusFeatures']) &&
            is_numeric($_POST['storageUpgrade']) &&
            is_numeric($_POST['25pFaster']) &&
            is_numeric($_POST['allSmithy']) &&
            is_numeric($_POST['searchAll']) &&
            is_numeric($_POST['resources01']) &&
            is_numeric($_POST['resources02']) &&
            is_numeric($_POST['resources03']) &&
            is_numeric($_POST['resources01A']) &&
            is_numeric($_POST['resources02A']) &&
            is_numeric($_POST['resources03A']) &&
            is_numeric($_POST['protect01']) &&
            is_numeric($_POST['protect02']) &&
            is_numeric($_POST['protect03'])){
                foreach($_POST as $key => $value){
                    if($key!='update'){
                        $panel->sUpdate($key, $value);
                    }
                }
                header('Location: index.php?p=plus&m');
            }else{ header('Location: index.php?p=plus&d'); }
        }
        if(isset($_GET['m'])){
            echo '<div class="alert alert-success">Modification has been completed </div>';
        }elseif(isset($_GET['d'])){
            echo '<div class="alert alert-danger">All entries must be numbers.</div>';
        }
            ?>
        <form action="" method="post">
        <input type="hidden" name="update" value="setting">
        <div class="form-group">
            <label>club gold</label>
            <input class="form-control" name="goldClub" value="<?php echo $config['goldClub']; ?>">
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Plus account price</label>
                <input class="form-control" name="Plus" value="<?php echo $config['Plus']; ?>">
            </div>
                <div class="col-md-6">
                    <label>duration plus</label>
                    <select name="PLUS_TIME" class="form-control">
                        <option <?php if(PLUS_TIME == 43200){ echo "selected"; } ?> value="43200">12 hour</option>
                        <option <?php if(PLUS_TIME == 86400){ echo "selected"; } ?> value="86400">24 hour</option>
                        <option <?php if(PLUS_TIME == 172800){ echo "selected"; } ?> value="172800">2 days</option>
                        <option <?php if(PLUS_TIME == 259200){ echo "selected"; } ?> value="259200">3 days</option>
                        <option <?php if(PLUS_TIME == 345600){ echo "selected"; } ?> value="345600">4 days</option>
                        <option <?php if(PLUS_TIME == 432000){ echo "selected"; } ?> value="432000">5 days</option>
                        <option <?php if(PLUS_TIME == 518400){ echo "selected"; } ?> value="518400">6 days</option>
                        <option <?php if(PLUS_TIME == 604800){ echo "selected"; } ?> value="604800">7 days</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Plus Resources price</label>
                    <input class="form-control" name="addonProduction" value="<?php echo $config['addonProduction']; ?>">
                </div>
                <div class="col-md-6">
                    <label>duration Resources</label>
                    <select name="PLUS_PRODUCTION" class="form-control">
                        <option <?php if(PLUS_PRODUCTION == 43200){ echo "selected"; } ?> value="43200">12 hour</option>
                        <option <?php if(PLUS_PRODUCTION == 86400){ echo "selected"; } ?> value="86400">24 hour</option>
                        <option <?php if(PLUS_PRODUCTION == 172800){ echo "selected"; } ?> value="172800">2 days</option>
                        <option <?php if(PLUS_PRODUCTION == 259200){ echo "selected"; } ?> value="259200">3 days</option>
                        <option <?php if(PLUS_PRODUCTION == 345600){ echo "selected"; } ?> value="345600">4 days</option>
                        <option <?php if(PLUS_PRODUCTION == 432000){ echo "selected"; } ?> value="432000">5 days</option>
                        <option <?php if(PLUS_PRODUCTION == 518400){ echo "selected"; } ?> value="518400">6 days</option>
                        <option <?php if(PLUS_PRODUCTION == 604800){ echo "selected"; } ?> value="604800">7 days</option>
                    </select>
                </div>
            </div>
            <hr>
            <h6>Plus Settings in a<small class="alert-danger">* Set a rate of 0 for private downtime</small></h6> 
            <br><div class="form-group">
                <label>Turn on / disable features of Plus</label>
                <select name="plusFeatures" class="form-control">
                    <option <?php if($config['plusFeatures'] == 0){ echo "selected"; } ?> value="0">disable</option>
                    <option <?php if($config['plusFeatures'] == 1){ echo "selected"; } ?> value="1">enable</option>
                </select>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label>storage upgrade</label>
                    <input name="storageUpgrade" class="form-control" value="<?php echo $config['storageUpgrade']; ?>">
                </div>
                <div class="col-md-6">
                    <label>training 25% faster</label>
                    <input name="25pFaster" class="form-control" value="<?php echo $config['25pFaster']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Full smithy</label>
                    <input name="allSmithy" class="form-control" value="<?php echo $config['allSmithy']; ?>">
                </div>
                <div class="col-md-6">
                    <label>Search all units</label>
                    <input name="searchAll" class="form-control" value="<?php echo $config['searchAll']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Resources first package price</label>
                    <input name="resources01" class="form-control" value="<?php echo $config['resources01']; ?>">
                </div>
                <div class="col-md-6">
                    <label>Resources second package price</label>
                    <input name="resources02" class="form-control" value="<?php echo $config['resources02']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Resources third package price</label>
                <input name="resources03" class="form-control" value="<?php echo $config['resources03']; ?>">
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label>Resources first package quantity</label>
                    <input name="resources01A" class="form-control" value="<?php echo $config['resources01A']; ?>">
                </div>
                <div class="col-md-6">
                    <label>Resources second package quantity</label>
                    <input name="resources02A" class="form-control" value="<?php echo $config['resources02A']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Resources third package quantity</label>
                <input name="resources03A" class="form-control" value="<?php echo $config['resources03A']; ?>">
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label>1 hour protection</label>
                    <input name="protect01" class="form-control" value="<?php echo $config['protect01']; ?>">
                </div>
                <div class="col-md-6">
                    <label>3 hour protection</label>
                    <input name="protect02" class="form-control" value="<?php echo $config['protect02']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label> 6 hour protection</label>
                <input name="protect03" class="form-control" value="<?php echo $config['protect03']; ?>">
            </div>

            <hr>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Modification</button>
            </div>
        </form>
    </div>
</div>