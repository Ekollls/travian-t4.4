<?php
include_once "application/Account.php";
if($session->goldclub==0){header("Location:dorf".$session->link.".php");}
?>




<?php include("application/views/html.php");?>

<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE cropfinder <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> buildingsV1">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
<div id="headerBar"></div>
<div id="bodyWrapper">

<div id="header">

    <?php
    include("application/views/topheader.php");
    include("application/views/toolbar.php");

    ?>

</div>
<div id="center">


<?php include("application/views/sideinfo.php"); ?>

<div id="contentOuterContainer" class="size1">

<?php include("application/views/res.php"); ?>
<div class="contentTitle"><a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a></div>

<div class="contentContainer">
<div id="content" class="cropfinder">
<h1 class="titleInHeader"><?php echo FINDER11; ?></h1>
<?php

if(is_numeric($_POST['x']) AND is_numeric($_POST['y'])) { $coor2['x'] = $_POST['x']; $coor2['y'] = $_POST['y']; }
else { $wref2 = $village->wid; $coor2 = $database->getCoor($wref2); }
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>?s" method="post">
    <div class="boxes boxesColor gray" >
        <div class="boxes-tl"></div>
        <div class="boxes-tr"></div>
        <div class="boxes-tc"></div>
        <div class="boxes-ml"></div>
        <div class="boxes-mr"></div>
        <div class="boxes-mc"></div>
        <div class="boxes-bl"></div>
        <div class="boxes-br"></div>
        <div class="boxes-bc"></div>
        <div class="boxes-contents cf">
            <table class="transparent">
        <thead>
        <tr>
            <td colspan='2' style="width:10%"><?php echo FINDER3;?></td>
            <td colspan='3' style="width:40%"><?php echo FINDER4;?></td>
            <td><?php echo FINDER5;?></td>
            <td><?php echo FINDER6;?></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>x:<input type="text" class="text" name="x" value="<?php print $coor2['x']; ?>" size="1" /></td>
            <td>y:<input type="text" class="text" name="y" value="<?php print $coor2['y']; ?>"  size="1" /></td>
            <td><input type="radio" class="radio" name="type" value="15" <?php if($_POST['type'] == 15 ) { print 'checked="checked"'; } ?> /> 15<img src="img/x.gif" class="r4" alt="<?php echo CROP_COM; ?>" title="<?php echo CROP_COM; ?>" /></td>
            <td><input type="radio" class="radio" name="type" value="9" <?php if($_POST['type'] == 9) { print 'checked="checked"'; } ?> /> 9<img src="img/x.gif" class="r4" alt="<?php echo CROP_COM; ?>" title="<?php echo CROP_COM; ?>" /></td>
            <td><input type="radio" class="radio" name="type" value="both" <?php if($_POST['type'] == 'both') { print 'checked="checked"'; } ?> /> 15<img src="img/x.gif" class="r4" alt="<?php echo CROP_COM; ?>" title="<?php echo CROP_COM; ?>" />&9<img src="img/x.gif" class="r4" alt="<?php echo CROP_COM; ?>" title="<?php echo CROP_COM; ?>" /></td>
            <td><select name="oasissize"  class="dropdown">
                    <option value="any" <?php if($_POST['oasissize'] == 'any') { print 'selected="selected"'; } ?>>-</option>
                    <option value="25" <?php if($_POST['oasissize'] == 25) { print 'selected="selected"'; }?>>+25%</option>
                    <option value="50" <?php if($_POST['oasissize'] == 50) { print 'selected="selected"'; }?>>+50%</option>
                    <option value="75" <?php if($_POST['oasissize'] == 75) { print 'selected="selected"'; }?>>+75%</option>
                    <option value="100" <?php if($_POST['oasissize'] == 100) { print 'selected="selected"'; }?>>+100%</option>
                    <option value="125" <?php if($_POST['oasissize'] == 125) { print 'selected="selected"'; }?>>+125%</option>
                    <option value="150" <?php if($_POST['oasissize'] == 150) { print 'selected="selected"'; }?>>+150 - ∞%</option>
                </select></td>

            <td><input type="checkbox"  name="unoccupied" value="1" <?php if($_POST['unoccupied'] == 1){ print 'checked="checked"';}?>><?php echo FINDER7;?></td>
        </tbody>
    </table>
            </div>
        </div>
    <br /><br />
    <button type="submit" value="ok" name="s1" id="btn_ok" class="green ">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?php echo FINDER2; ?></div></div></button>
</form>
<br>
<?php


if($_POST['type'] == 15 and $_POST['unoccupied']==0){
    $type15 = $database->query("SELECT id,x,y,occupied FROM wdata WHERE fieldtype = 6 and type_of=''");}
elseif($_POST['type'] == 15 and $_POST['unoccupied']==1){
    $type15 = $database->query("SELECT id,x,y,occupied FROM wdata WHERE fieldtype = 6 and occupied=0 and type_of=''");}
if($_POST['type'] == 9 and $_POST['unoccupied']==0){
    $type9 = $database->query("SELECT id,x,y,occupied FROM wdata WHERE fieldtype = 1 and type_of=''");}
elseif($_POST['type'] == 9 and $_POST['unoccupied']==1){
    $type9 = $database->query("SELECT id,x,y,occupied FROM wdata WHERE fieldtype = 1 and occupied=0 and type_of=''");}
if($_POST['type'] == 'both' and $_POST['unoccupied']==0){
    $type_both = $database->query("SELECT id,x,y,occupied,fieldtype FROM wdata WHERE (fieldtype = 1 OR fieldtype = 6) and type_of=''");}
elseif($_POST['type'] == 'both' and $_POST['unoccupied']==1){
    $type_both = $database->query("SELECT id,x,y,occupied,fieldtype FROM wdata WHERE ((`fieldtype` = '1' AND `occupied` = '0') OR (`fieldtype` = '6' AND `occupied` = '0')) and type_of=''");}

if(is_numeric($_POST['x']) AND is_numeric($_POST['y'])) {
    $coor['x'] = $_POST['x'];
    $coor['y'] = $_POST['y'];
} else {
    $wref = $village->wid;
    $coor = $database->getCoor($wref);
}

if($_POST['type'] == 15) {
    ?>
    <h4 class="round">Fields crop</h4>
    <table cellpadding="1" cellspacing="1" id="croplist">
        <thead>
        <tr>
            <th colspan='5'>15</th>
        </tr>
        <tr>
            <td><?php echo FINDER8;?></td>
            <td><?php echo FINDER9;?></td>
            <td><?php echo FINDER4;?></td>
            <td><?php echo FINDER5;?></td>
            <td><?php echo FINDER10;?></td>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($type15)){
            foreach($type15 as $row) {
                $dist = $database->getDistance($coor['x'], $coor['y'], $row['x'], $row['y']);
                $rows[$dist] = $row;
            }
            ksort($rows);
            foreach($rows as $dist => $row) {
                $x=$row['x'];
                $y=$row['y'];
                $xm7 = ($x-7) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-6 : $x-7;
                $xm3 = ($x-3) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-2 : $x-3;
                $xm2 = ($x-2) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-1 : $x-2;
                $xm1 = ($x-1) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX : $x-1;
                $xp1 = ($x+1) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX : $x+1;
                $xp2 = ($x+2) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+1 : $x+2;
                $xp3 = ($x+3) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+2: $x+3;
                $xp7 = ($x+7) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+6: $x+7;
                $ym7 = ($y-7) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-6 : $y-7;
                $ym3 = ($y-3) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-2 : $y-3;
                $ym2 = ($y-2) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-1 : $y-2;
                $ym1 = ($y-1) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX : $y-1;
                $yp1 = ($y+1) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX : $y+1;
                $yp2 = ($y+2) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+1 : $y+2;
                $yp3 = ($y+3) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+2: $y+3;
                $yp7 = ($y+7) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+6: $y+7;
                $xarray = array($xm3,$xm2,$xm1,$x,$xp1,$xp2,$xp3);
                $yarray = array($ym3,$ym2,$ym1,$y,$yp1,$yp2,$yp3);
                $maparray = array();
                $xcount = 0;
                $maparray = '';
                $maparray2 = '';
                for($i=0; $i<=6; $i++){
                    if($xcount != 7){
                        $maparray .= '\''.$database->getBaseID($xarray[$xcount],$yarray[$i]).'\',';
                        $maparray2 .= $database->getBaseID($xarray[$xcount],$yarray[$i]).',';
                        if($i==6){
                            $i = -1;
                            $xcount +=1;
                        }
                    }
                }
                $maparray = (substr($maparray, 0, -1));
                $query2 = "SELECT
                    wdata.oasistype AS map_oasis
                    FROM wdata
                    where oasistype>2 and wdata.id IN ($maparray)
                    ORDER BY FIND_IN_SET(wdata.id,'$maparray2')";
                $result2 = $database->query($query2);
                $croppercents=0;
                foreach($result2 as $donnees){
                    $ot=$donnees['map_oasis'];
                    if($ot==3 || $ot==6 || $ot==9 || $ot==11){
                        $croppercents+=25;}
                    if($ot==12){
                        $croppercents+=50;}
                }
                if($_POST['oasissize']=="any" or $_POST['oasissize']==$croppercents  or ($_POST['oasissize']==150 and $croppercents>=150)){
                    echo "<tr>";
                    if($row['occupied'] == 0) {
                        echo "<td class=\"dist\">".$database->getDistance($coor['x'], $coor['y'], $row['x'], $row['y'])."</font></td>";
                        echo "<td class=\"aligned_coords\"><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">(".$row['x']."|".$row['y'].")</a></td>";
                        echo "<td class=\"typ\"><i class=\"r4\"></i> 15</font></td>";
                        echo "<td class=\"oase\"><i class=\"r4\"></i> ".$croppercents."%+</td>";
                        echo "<td class=\"owned\">-</td>";
                    } else {
                        $vilain=$database->getUserNameByVilID($row['id']);
                        echo "<td class=\"dist\"><font color=\"red\">".$database->getDistance($coor['x'], $coor['y'], $row['x'], $row['y'])."</font></td>";
                        echo "<td class=\"aligned_coords\"><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">(".$row['x']."|".$row['y'].")</a></td>";
                        echo "<td class=\"typ\"><font color=\"red\"><i class=\"r4\"></i> 15</font></td>";
                        echo "<td class=\"oase\"><i class=\"r4\"></i> ".$croppercents."%+</td>";
                        echo "<td class=\"owned\"><a href=\"spieler.php?uid=".$vilain['id']."\"><a href=\"spieler.php?uid=".$vilain['id']."\">".$vilain['username']."</a></td>";}
                }
            }
        }

        ?>
        </tbody></table>




<?php
} else if($_POST['type'] == 9) {
    ?>
    <h4 class="round">Fields crop</h4>
    <table cellpadding="1" cellspacing="1" id="croplist">
        <thead>
        <tr>
            <th colspan='5'>9</th>
        </tr>
        <tr>
            <td><?php echo FINDER8;?></td>
            <td><?php echo FINDER9;?></td>
            <td><?php echo FINDER4;?></td>
            <td><?php echo FINDER5;?></td>
            <td><?php echo FINDER10;?></td>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($type9)){
            foreach($type9 as $row) {
                $dist = $database->getDistance($coor['x'], $coor['y'], $row['x'], $row['y']);
                $rows[$dist] = $row;
            }

            ksort($rows);
            foreach($rows as $dist => $row) {

                $x=$row['x'];
                $y=$row['y'];
                $xm7 = ($x-7) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-6 : $x-7;
                $xm3 = ($x-3) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-2 : $x-3;
                $xm2 = ($x-2) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-1 : $x-2;
                $xm1 = ($x-1) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX : $x-1;
                $xp1 = ($x+1) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX : $x+1;
                $xp2 = ($x+2) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+1 : $x+2;
                $xp3 = ($x+3) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+2: $x+3;
                $xp7 = ($x+7) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+6: $x+7;
                $ym7 = ($y-7) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-6 : $y-7;
                $ym3 = ($y-3) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-2 : $y-3;
                $ym2 = ($y-2) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-1 : $y-2;
                $ym1 = ($y-1) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX : $y-1;
                $yp1 = ($y+1) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX : $y+1;
                $yp2 = ($y+2) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+1 : $y+2;
                $yp3 = ($y+3) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+2: $y+3;
                $yp7 = ($y+7) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+6: $y+7;
                $xarray = array($xm3,$xm2,$xm1,$x,$xp1,$xp2,$xp3);
                $yarray = array($ym3,$ym2,$ym1,$y,$yp1,$yp2,$yp3);
                $maparray = array();
                $xcount = 0;
                $maparray = '';
                $maparray2 = '';
                for($i=0; $i<=6; $i++){
                    if($xcount != 7){
                        $maparray .= '\''.$database->getBaseID($xarray[$xcount],$yarray[$i]).'\',';
                        $maparray2 .= $database->getBaseID($xarray[$xcount],$yarray[$i]).',';
                        if($i==6){
                            $i = -1;
                            $xcount +=1;
                        }
                    }
                }
                $maparray = (substr($maparray, 0, -1));
                $query2 = "SELECT
                    wdata.oasistype AS map_oasis
                    FROM wdata
                    where oasistype>2 and wdata.id IN (".$maparray.")
                    ORDER BY FIND_IN_SET(wdata.id,'".$maparray2."')";
                $result2 = $database->query($query2);

                $croppercents=0;
                foreach($result2 as $donnees){
                    $ot=$donnees['map_oasis'];
                    if($ot==3 || $ot==6 || $ot==9 || $ot==11){
                        $croppercents+=25;}
                    if($ot==12){
                        $croppercents+=50;}
                }

                if($_POST['oasissize']=="any" or $_POST['oasissize']==$croppercents  or ($_POST['oasissize']==150 and $croppercents>=150)){
                    echo "<tr>";
                    if($row['occupied'] == 0) {
                        echo "<td class=\"dist\">".$database->getDistance($coor['x'], $coor['y'], $row['x'], $row['y'])."</font></td>";
                        echo "<td class=\"aligned_coords\"><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">(".$row['x']."|".$row['y'].")</a></td>";
                        echo "<td class=\"typ\"><i class=\"r4\"></i> 9</font></td>";
                        echo "<td class=\"oase\"><i class=\"r4\"></i> ".$croppercents."%+</td>";
                        echo "<td class=\"owned\">-</td>";
                    } else {
                        $vilain=$database->getUserNameByVilID($row['id']);
                        echo "<td class=\"dist\"><font color=\"red\">".$database->getDistance($coor['x'], $coor['y'], $row['x'], $row['y'])."</font></td>";
                        echo "<td class=\"aligned_coords\"><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">(".$row['x']."|".$row['y'].")</a></td>";
                        echo "<td class=\"typ\"><font color=\"red\"><i class=\"r4\"></i> 9</font></td>";
                        echo "<td class=\"oase\"><i class=\"r4\"></i> ".$croppercents."%+</td>";
                        echo "<td class=\"owned\"><a href=\"spieler.php?uid=".$vilain['id']."\"><a href=\"spieler.php?uid=".$vilain['id']."\">".$vilain['username']."</a></td>";}
                }
            }
        }

        ?>

        </tbody></table>
<?php
}
else if($_POST['type'] == 'both') {
    ?>
    <h4 class="round">Fields crop</h4>

    <table cellpadding="1" cellspacing="1" id="croplist">
        <thead>
        <tr>
            <th colspan='5'>9 & 15</th>
        </tr>
        <tr>
            <td><?php echo FINDER8;?></td>
            <td><?php echo FINDER9;?></td>
            <td><?php echo FINDER4;?></td>
            <td><?php echo FINDER5;?></td>
            <td><?php echo FINDER10;?></td>
        </tr>
        </thead>
        <tbody>
        <?php
        unset($rows);
        if(!empty($type_both)){
            foreach($type_both as $row) {
                $dist = $database->getDistance($coor['x'], $coor['y'], $row['x'], $row['y']);
                $rows[$dist] = $row;
            }

            ksort($rows);
            foreach($rows as $dist => $row) {
                if($row['fieldtype'] == 1) {
                    $field = '9 ';
                } elseif($row['fieldtype'] == 6) {
                    $field = '15 ';
                }

                $x=$row['x'];
                $y=$row['y'];
                $xm3 = ($x-3) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-2 : $x-3;
                $xm2 = ($x-2) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-1 : $x-2;
                $xm1 = ($x-1) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX : $x-1;
                $xp1 = ($x+1) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX : $x+1;
                $xp2 = ($x+2) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+1 : $x+2;
                $xp3 = ($x+3) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+2: $x+3;
                $xp7 = ($x+7) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+6: $x+7;
                $ym7 = ($y-7) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-6 : $y-7;
                $ym3 = ($y-3) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-2 : $y-3;
                $ym2 = ($y-2) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-1 : $y-2;
                $ym1 = ($y-1) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX : $y-1;
                $yp1 = ($y+1) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX : $y+1;
                $yp2 = ($y+2) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+1 : $y+2;
                $yp3 = ($y+3) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+2: $y+3;
                $xarray = array($xm3,$xm2,$xm1,$x,$xp1,$xp2,$xp3);
                $yarray = array($ym3,$ym2,$ym1,$y,$yp1,$yp2,$yp3);
                $maparray = array();
                $xcount = 0;
                $maparray = '';
                $maparray2 = '';
                for($i=0; $i<=6; $i++){
                    if($xcount != 7){
                        $maparray .= '\''.$database->getBaseID($xarray[$xcount],$yarray[$i]).'\',';
                        $maparray2 .= $database->getBaseID($xarray[$xcount],$yarray[$i]).',';
                        if($i==6){
                            $i = -1;
                            $xcount +=1;
                        }
                    }
                }
                $maparray = (substr($maparray, 0, -1));
                $query2 = "SELECT
wdata.oasistype AS map_oasis
FROM wdata
where oasistype>2 and wdata.id IN (".$maparray.")
ORDER BY FIND_IN_SET(wdata.id,'".$maparray2."')";
                $result2 = $database->query($query2);
//echo "<br>for vil ".$row['id']."<br>";
                $croppercents=0;
                foreach($result2 as $donnees){
                    $ot=$donnees['map_oasis'];
                    if($ot==3 || $ot==6 || $ot==9 || $ot==11){
                        $croppercents+=25;}
                    if($ot==12){
                        $croppercents+=50;}
                }

//echo $croppercents."%";

//print_r($donnees['map_oasis']);
//echo "<br>for vil ".$row['id']."<br>";
                if($_POST['oasissize']=="any" or $_POST['oasissize']==$croppercents  or ($_POST['oasissize']==150 and $croppercents>=150)){
                    echo "<tr>";
                    if($row['occupied'] == 0) {
                        echo "<td class=\"dist\">".$database->getDistance($coor['x'], $coor['y'], $row['x'], $row['y'])."</font></td>";
                        echo "<td class=\"aligned_coords\"><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">(".$row['x']."|".$row['y'].")</a></td>";
                        echo "<td class=\"typ\"><i class=\"r4\"></i> ".$field."</font></td>";
                        echo "<td class=\"oase\"><i class=\"r4\"></i> ".$croppercents."%+</td>";
                        echo "<td class=\"owned\">-</td>";
                    } else {
                        $vilain=$database->getUserNameByVilID($row['id']);
                        echo "<td class=\"dist\"><font color=\"red\">".$database->getDistance($coor['x'], $coor['y'], $row['x'], $row['y'])."</font></td>";
                        echo "<td class=\"aligned_coords\"><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">(".$row['x']."|".$row['y'].")</a></td>";
                        echo "<td class=\"typ\"><font color=\"red\"><i class=\"r4\"></i> ".$field."</font></td>";
                        echo "<td class=\"oase\"><i class=\"r4\"></i> ".$croppercents."%+</td>";
                        echo "<td class=\"owned\"><a href=\"spieler.php?uid=".$vilain['id']."\"><a href=\"spieler.php?uid=".$vilain['id']."\">".$vilain['username']."</a></td>";}
                }

            }
        }

        ?>

        </tbody></table>
<?php } ?>

<div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>


</div>
<div class="contentFooter">&nbsp;</div>

</div>
<?php
include("application/views/rightsideinfor.php");
?>
<div class="clear"></div>
</div>
<?php

include("application/views/header.php");
?>
</div>
<div id="ce"></div>
</div>


</body>
</html>

