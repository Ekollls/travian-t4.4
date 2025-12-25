<?php include("views/Plus/pmenu.php"); ?>
<div class="card">
<div class="card-header">تولد أكواد</div>
<div class="card-body"><?php
    function generateRandStr($length)
    {
        $randstr = "";
        for ($i = 0; $i < $length; $i++) {
            $randnum = mt_rand(0, 61);
            if ($randnum < 10) {
                $randstr .= chr($randnum + 48);
            } else if ($randnum < 36) {
                $randstr .= chr($randnum + 55);
            } else {
                $randstr .= chr($randnum + 61);
            }
        }
        return $randstr;
    }

    if(isset($_GET['del'])){
        $database->query("DELETE FROM codes WHERE id = ".$_GET['del']."");
        echo 'تم delete كود بنجاح <br><br>';
        //header('Location: index.php?p=codes');
    }
    if(isset($_POST) && !empty($_POST)){
        $_POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
        if(is_numeric($_POST['goldAmount']) && is_numeric($_POST['codeNum'])){
            
            if($_POST['goldAmount'] > 0){
                echo '<div class="alert alert-success">List the أكواد:<br>';
                for($i=1;$i<=$_POST['codeNum'];$i++){
                    $code = generateRandStr(10);
                    $database->query("INSERT into codes (codeNum,goldAmount) VALUES('".$code."', ".$_POST['goldAmount'].")");
                    echo $code;
                    echo '<br>';
                }
                echo '</div>';
            }else{
                $isError++;
                $Error = 'مدخلات خاطئة';
            }
        }else{
            $isError++;
            $Error = 'مدخلات خاطئة';
        }
    }
?>

<?php if($isError){ ?>
    <b style="color:red;"><?php echo $Error; ?></b> <br>
<?php } ?>
<form action="" method="post">
<div class="form-group">
        <label>quantity gold</label>
        <input name="goldAmount" class="form-control" type="number" autocomplete="off">
    </div>
    <div class="form-group">
        <label>number أكواد</label>
        <input name="codeNum" class="form-control" type="number" value="1" autocomplete="off">
    </div>

    <div class="form-group">
        <button class="btn btn-primary">تولد</button>
    </div>
</form>
</div>
</div>

<table cellpadding="1" cellspacing="1" class="table mt-5 mb-5" class="inbox">
    <thead>
    <tr>
			<th colspan="10">List the أكواد</th>
		</tr>

        <tr>
            <th>#</th>
            <th>كود</th>
            <th>gold</th>
            <th>حة</th>
            <th>player</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
    <?php $codes = $database->query("SELECT * FROM codes ORDER BY id DESC"); 
    if(count($codes) > 0){
        foreach($codes as $code){
         ?>
        <tr>
        <td><?php echo $code['id']; ?></td>
        <td><?php echo $code['codeNum']; ?></td>
        <td><?php echo $code['goldAmount']; ?></td>
        <td><?php echo $code['isUsed'] ? 'مستعمل' : 'غر مستعمل'; ?></td>
        <td><?php echo  $code['isUsed'] ? '<a href="spieler.php?uid='.$code['idUser'].'">'.$database->getUserInfo($code['idUser'])['username'].'</a>' : '-'; ?></td>
        <td><a href="index.php?p=codes&del=<?php echo $code['id']; ?>"><button class="btn btn-danger">delete</button></a></td>
        </tr>
    <?php 
        }
        }else{
            echo '<tr><td colspan="6">لا وجد أكواد بعد.</td></tr>';
        } ?>
    </tbody>
</table>

