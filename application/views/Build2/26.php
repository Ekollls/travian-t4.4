<?php
if(time() - $_SESSION['time_p'] > 5) {
$_SESSION['time_p'] = '';
$_SESSION['error_p'] = '';
}

if(isset($_POST) AND $_GET['action'] == 'change_capital' && $village->natar==0) {
$pass = $_POST['pass'];
$query = $database->query("SELECT * FROM `users` WHERE `id` = '" . $session->uid."'");
$data = $query[0];
if($data['password'] == md5($pass.mb_convert_case($session->username,MB_CASE_LOWER,"UTF-8"))) {
$data1 = $database->getcapital($session->uid);
if(count($data1)){
$data2 = $database->getResourceLevel($data1['wref']);
if($data2['vref'] != $village->wid) {
for($i = 1; $i<=18; ++$i) {
if($data2['f' . $i] > 10) {
$database->setVillageLevel($data2['vref'],"f".$i."",10);
}
}

for($i=19; $i<=40; ++$i) {
if($data2['f' . $i . 't'] == 34) {
$database->setVillageLevel($data2['vref'],"f".$i."t",'0');
$database->setVillageLevel($data2['vref'],"f".$i,'0');
}
}
    $database->query("DELETE FROM training where unit > 60 and `vref`='".$village->wid."'"); //удаляем тренироinки для бк

for($i=19; $i<=40; ++$i) {
if($data2['f' . $i . 't'] == 29 or $data2['f' . $i . 't'] == 30 or $data2['f' . $i . 't'] == 38 or $data2['f' . $i . 't'] == 39 or $data2['f' . $i . 't'] == 42) {

$database->setVillageLevel($village->wid,"f".$i."t",'0');
$database->setVillageLevel($village->wid,"f".$i,'0');
}
}
$database->setVillageField($data1['wref'],"capital",0);
}
}

$database->setVillageField($village->wid,"capital",1);
} else {
$error = '<br/><font color="red">'.dvrc0.'</font><br/>';
$_SESSION['error_p'] = $error;
$_SESSION['time_p'] = time();
print '
<script language="javascript">location.href = "build.php?id=' . $building->getTypeField(26) . '&confirm=yes";</script>';
}
}
?>


    <?php
if ($building->getTypeLevel(26) > 0) {
    //include("25_menu.php");
    if(!isset($_GET['t']) || !in_array($_GET['t'],array(1,2,3,4))){

        if($village->resarray['f'.$id] >= 10){
            include("25_train.php");
        }
        else{
            echo '
    <div class="c">'.dvrc1.'
    </div>
    ';
        }
        $query = $database->query("SELECT * FROM `vdata` WHERE `owner` = '" . $session->uid . "' AND `capital` = 1");
        $data = $query[0];
        if($data['wref'] == $village->wid) {
            ?>
            <p class="none"><?=dvrc2?></p>
        <?php
        } elseif($village->natar==0) {
            if($_GET['confirm'] == '') {
                print '<p><a href="?id=' . $building->getTypeField(26) . '&confirm=yes">&raquo Change Capital</a></p>';
            } else {
                print '<p>'.dvrc3.'<br/><b>'.dvrc4.'</b>.<br/>'.dvrc5.'<br/>

    <form method="post" action="build.php?id=' . $building->getTypeField(26) . '&action=change_capital">
        ' . $_SESSION['error_p'] . '
        '.dvrc8.' <input type="password" name="pass"/><br/>

<button type="submit" value="ok" name="s1" id="btn_train" value="ok" class="green">
  <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div><div class="button-content">' . dvrc6 . '</div>
    </div>
</button>
</form>
    </p>';
            }
        }
    }else{
        include("application/views/Build/".$village->resarray['f'.$_GET['id'].'t']."_".$_GET['t'].".php");
    }



    } else {
    echo "<b>".dvrc7."</b>";
    }

    ?>
