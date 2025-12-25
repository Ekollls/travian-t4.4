<?php 
    if($session->access != 9){ 
        header('Location: ../dorf1.php'); die(); 
    }


?>
    <script src="../gpack/time.js" type="text/javascript"></script>

<div class="card">
    <div class="card-header"><?php echo $lang['Admin']['install01']; ?></div>
    <div class="card-body">
    <?php 
    if(isset($_GET['done'])){
        echo '<div class="alert alert-success">Done</div>';
    }
        if(isset($_POST['install'])){
            echo $panel->install($_POST);
        }
    ?>
    <div class="b-articlesmall">
    <form name="hf" onsubmit="return false;">
        <table>
           <tr>
           <td><?=INS11?></td>
           <td><?=INS12?></td>
           <td><?=INS13?></td>
           <td> </td>
           <td><?=INS14?></td>
           <td><?=INS15?></td>
           <td><?=INS16?></td>
           <td></td></tr>
            <tr><td><input type="text" size="1" class="form-control" maxlength=2 value="1" name="mm">  </td>
                <td><input type="text" size=1 class="form-control" maxlength=2 value="1" name="dd"></td>
                <td><input type="text" size=3 class="form-control" maxlength=4 value="1970" name="yyyy"></td>
                <td></td>
                <td><input type="text" size=3 class="form-control" maxlength=2 value="0" name="hh"> </td>
                <td><input type="text" size=3 class="form-control" maxlength=2 value="0" name="mn"></td>
                <td><input type="text" size=3 class="form-control" maxlength=2 value="0" name="ss"></td>
                <td> <input type="button" title="Date To Tiemstamp" class="btn btn-primary" value="Date To Tiemstamp" onClick="HumanToEpoch();"></td>
            </tr></table>
        <div id="result2"> </div>
    </form>
<hr>
        <form action="" method="post">
        <div class="form-group">
                <label><?php echo $lang['Admin']['install02']; ?></label>
                <input type="number" name="OPENING" class="form-control">
            </div>
            <div class="form-group">
                <label><?php echo $lang['Admin']['install03']; ?></label>
                <input type="number" name="ARTEFACTS" class="form-control">
            </div>
            <div class="form-group">
                <label><?php echo $lang['Admin']['install04']; ?></label>
                <input type="number" name="WW_PLAN" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" name="install" class="btn btn-primary"><?php echo $lang['Admin']['install05']; ?></button>
            </div>
        </form>
    </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header"><?php echo $lang['Admin']['install09']; ?></div>
    <div class="card-body">
        <ul>
            <li><?php echo $lang['Admin']['install07']; ?></li>
            <li><?php echo $lang['Admin']['install08']; ?></li>
            <div class="ml-4">
                <li>artefacts.txt</li>
                <li>ww_plans.txt</li>
            </div>

        </ul>
    </div>
</div>