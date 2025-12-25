<div id="build" class="gid37">
<?php
$oasisarray = $village->oasisowned;
if ($_GET['gid'] == 37 && isset($_GET['del'])) {
    $oas = $database->FilterIntValue($_GET['del']);
    foreach ($oasisarray as $oa) {
        if ($oa['wref'] == $oas) {
            $database->removeOases($oas);
        }
    }
    header("Location: build.php?id=" . $id . "&land");
    exit();
}
?>    <div class="clear"></div>    <h4><?= TVRN0 ?> <?php
echo $village->vname;
?> <?= TVRN1 ?></h4>    <table id="oasesOwned" cellpadding="1" cellspacing="1">        <thead>        <tr>            <td><?= TVRN2 ?></td>            <td><?= TVRN3 ?></td>            <td><?= TVRN4 ?></td>            <td><?= TVRN5 ?></td>            <td><?= TVRN6 ?></td>        </tr>        </thead>        <tbody>        <?php
$sql   = $village->oasisowned;
$query = count($sql);
if ($query > 0) {
    foreach ($sql as $row) {
        $wref        = $row["wref"];
        $type        = $row["type"];
        $lastupdated = $row["lastupdated"];
        $loyalty     = $row["loyalty"];
?>                <tr>                    <td class="type">
<a onclick=" window.location.href = 'build.php?gid=37&c=<?php echo $generator->getMapCheck($wref);?>&del=<?php echo $wref; ?>'">                            <img class="del" src="img/x.gif">                        </a>                        <?php
        switch ($type) {
            case 1:
            case 2:
            case 3:
                $tname = TVRN12;
                break;
            case 4:
            case 5:
            case 6:
                $tname = TVRN13;
                break;
            case 7:
            case 8:
            case 9:
                $tname = TVRN14;
                break;
            case 10:
            case 11:
            case 12:
                $tname = TVRN15;
                break;
        }
?>                        <a href="karte.php?d=<?php
        echo $wref;
?>&c=<?php
        echo $generator->getMapCheck($wref);
?>"><?php
        echo $tname;
?></a>                    </td>                    <td class="zp"><?php
        echo $loyalty;
?>%</td>                    <td class="owned"><?php
        echo date('y.m.d.', $lastupdated);
?> <?php
        echo date('H:i', $lastupdated);
?></td>                    <td class="coords">                        <?php
        $coor = $database->getCoor($wref);
        switch ($type) {
            case 1:
                $tt = "<span><i class=\"r1\"></i> 25%</span>";
                break;
            case 2:
                $tt = "<span><i class=\"r1\"></i> 50%</span>";
                break;
            case 3:
                $tt = "<span><i class=\"r1\"></i> 25%</span><span><i class=\"r4\"></i> 25%</span>";
                break;
            case 4:
                $tt = "<span><i class=\"r2\"></i> 25%</span>";
                break;
            case 5:
                $tt = "<span><i class=\"r2\"></i> 50%</span>";
                break;
            case 6:
                $tt = "<span><i class=\"r2\"></i> 25%</span><span><i class=\"r4\"></i> 25%</span>";
                break;
            case 7:
                $tt = "<span><i class=\"r3\"></i> 25%</span>";
                break;
            case 8:
                $tt = "<span><i class=\"r3\"></i> 50%</span>";
                break;
            case 9:
                $tt = "<span><i class=\"r3\"></i> 25%</span><span><i class=\"r4\"></i> 25%</span>";
                break;
            case 10:
            case 11:
                $tt = "<span><i class=\"r4\"></i> 25%</span>";
                break;
            case 12:
                $tt = "<span><i class=\"r4\"></i> 50%</span>";
                break;
        }
?>                        <a class="" href="karte.php?x=<?php
        echo $coor['x'];
?>&amp;y=<?php
        echo $coor['y'];
?>">                <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesrtl">                <span class="coordinatesWrapper">              <span class="coordinateX">(<?php
        echo $coor['x'];
?></span>                <span class="coordinatePipe">|</span>                      <span class="coordinateY"><?php
        echo $coor['y'];
?>)</span>                </span></span>                            <span class="clear"></span></a>                    </td>                    <td class="res"><?php
        echo $tt;
?></td>                </tr>            <?php
    }
}
?>        </tbody>    </table>    <?php
if ($query == 0) {
    echo '<div class="nextOases none">1. ' . TVRN7 . '</div><div class="nextOases none">2. ' . TVRN8 . '</div><div class="nextOases none">3. ' . TVRN9 . '</div>';
}
if ($query == 1) {
    echo '<div class="nextOases none">2. ' . TVRN8 . '</div><div class="nextOases none">3. ' . TVRN9 . '</div>';
} elseif ($query == 2) {
    echo '<div class="nextOases none">3. ' . TVRN9 . '</div>';
} else {
    echo '';
}
?>    <h4 class="spacer"><?= TVRN10 ?></h4>    <table id="oasesSurround" cellpadding="1" cellspacing="1">        <thead>        <tr>            <td><?= TVRN2 ?></td>            <td><?= TVRN11 ?></td>            <td><?= sokr1 ?></td>            <td><?= TVRN5 ?></td>            <td><?= TVRN6 ?></td>        </tr>        </thead>        <tbody>        <?php
$x        = $village->coor['x'];
$y        = $village->coor['y'];
$xm3      = ($x - 3) < -WORLD_MAX ? $x + WORLD_MAX + WORLD_MAX - 2 : $x - 3;
$xm2      = ($x - 2) < -WORLD_MAX ? $x + WORLD_MAX + WORLD_MAX - 1 : $x - 2;
$xm1      = ($x - 1) < -WORLD_MAX ? $x + WORLD_MAX + WORLD_MAX : $x - 1;
$xp1      = ($x + 1) > WORLD_MAX ? $x - WORLD_MAX - WORLD_MAX : $x + 1;
$xp2      = ($x + 2) > WORLD_MAX ? $x - WORLD_MAX - WORLD_MAX + 1 : $x + 2;
$xp3      = ($x + 3) > WORLD_MAX ? $x - WORLD_MAX - WORLD_MAX + 2 : $x + 3;
$ym3      = ($y - 3) < -WORLD_MAX ? $y + WORLD_MAX + WORLD_MAX - 2 : $y - 3;
$ym2      = ($y - 2) < -WORLD_MAX ? $y + WORLD_MAX + WORLD_MAX - 1 : $y - 2;
$ym1      = ($y - 1) < -WORLD_MAX ? $y + WORLD_MAX + WORLD_MAX : $y - 1;
$yp1      = ($y + 1) > WORLD_MAX ? $y - WORLD_MAX - WORLD_MAX : $y + 1;
$yp2      = ($y + 2) > WORLD_MAX ? $y - WORLD_MAX - WORLD_MAX + 1 : $y + 2;
$yp3      = ($y + 3) > WORLD_MAX ? $y - WORLD_MAX - WORLD_MAX + 2 : $y + 3;
$xarray   = array(
    $xm3,
    $xm2,
    $xm1,
    $x,
    $xp1,
    $xp2,
    $xp3
);
$yarray   = array(
    $ym3,
    $ym2,
    $ym1,
    $y,
    $yp1,
    $yp2,
    $yp3
);
$xcount   = 0;
$maparray = '';
for ($i = 0; $i <= 6; $i++) {
    if ($xcount != 7) {
        $maparray .= '\'' . $database->getBaseID($xarray[$xcount], $yarray[$i]) . '\',';
        if ($i == 6) {
            $i = -1;
            $xcount += 1;
        }
    }
}
$maparray = (substr($maparray, 0, -1));
$getoasis = $database->query("SELECT w.id,w.x,w.y,o.type,o.conqured,o.owner FROM wdata as w left JOIN odata as o ON o.wref = w.id where w.oasistype>0 and w.id  IN ($maparray)");
foreach ($getoasis as $row2) {
    echo "<tr><td class=\"type\">";
    switch ($row2['type']) {
        case 1:
        case 2:
        case 3:
            $tname = TVRN12;
            break;
        case 4:
        case 5:
        case 6:
            $tname = TVRN13;
            break;
        case 7:
        case 8:
        case 9:
            $tname = TVRN14;
            break;
        case 10:
        case 11:
        case 12:
            $tname = TVRN15;
            break;
    }
    echo "<a href=\"karte.php?d=" . $row2['id'] . "&c=" . $generator->getMapCheck($row2['id']) . "\">" . $tname . "</a></td>";
    if ($row2['owner'] == 3) {
        $oOwner = "-";
    } else {
        $oOwner = $database->getUserField($row2['owner'], "username", 0);
    }
    echo "<td class=\"nam\">" . $oOwner . "</td>";
    if ($row2['conqured'] == 0) {
        $oVillage = "-";
    } else {
        $tempVillage = $database->getVillage($row2['conqured']);
        $oVillage    = $tempVillage['name'];
    }
    echo "<td class=\"vil\">" . $oVillage . "</td>";
    echo "<td class=\"coords\">";
    echo "<a href=\"karte.php?d=" . $row2['id'] . "\">                  <span class=\"coordinates coordinatesWrapper coordinatesAligned coordinatesrtl\"><span class=\"coordinatesWrapper\">                  <span class=\"coordinateX\">(" . $row2['x'] . "</span>                  <span class=\"coordinatePipe\">|</span>                  <span class=\"coordinateY\">" . $row2['y'] . ")</span></span></span><span class=\"clear\">‎</span></a>";
    echo "</td>";
    switch ($row2['type']) {
        case 1:
            $ttt = "<span><i class=\"r1\"></i> 25%</span>";
            break;
        case 2:
            $ttt = "<span><i class=\"r1\"></i> 50%</span>";
            break;
        case 3:
            $ttt = "<span><i class=\"r1\"></i> 25%</span><span><i class=\"r4\"></i> 25%</span>";
            break;
        case 4:
            $ttt = "<span><i class=\"r2\"></i> 25%</span>";
            break;
        case 5:
            $ttt = "<span><i class=\"r2\"></i> 50%</span>";
            break;
        case 6:
            $ttt = "<span><i class=\"r2\"></i> 25%</span><span><i class=\"r4\"></i> 25%</span>";
            break;
        case 7:
            $ttt = "<span><i class=\"r3\"></i> 25%</span>";
            break;
        case 8:
            $ttt = "<span><i class=\"r3\"></i> 50%</span>";
            break;
        case 9:
            $ttt = "<span><i class=\"r3\"></i> 25%</span><span><img class='r4' src='img/x.gif' title='Búza'> 25%</span>";
            break;
        case 10:
        case 11:
            $ttt = "<span><i class=\"r4\"></i> 25%</span>";
            break;
        case 12:
            $ttt = "<span><i class=\"r4\"></i> 50%</span>";
            break;
    }
    echo "<td class=\"res\">" . $ttt . "</td>";
    echo "</tr>";
}
?>        </tbody>    </table></div>