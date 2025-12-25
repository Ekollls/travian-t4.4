<map name="rx" id="rx">
    <?php
    if(DIRECTION == 'rtl'){
        $coorarray = array(1=>"277,88,28","187,89,28","119,101,28","335,127,28","222,140,28","165,147,28","80,145,28","395,178,28","314,179,28","124,179,28","37,179,28","387,239,28","314,229,28","178,265,28","56,234,28","283,319,28","192,324,28","102,301,28");
    }else{
        $coorarray = array(1=>"137,88,28","227,89,28","295,101,28","79,127,28","192,140,28","249,147,28","334,145,28","19,178,28","100,179,28","290,179,28","377,179,28","27,239,28","100,229,28","236,265,28","358,234,28","131,319,28","222,324,28","312,301,28");
    }
                
    $stylecoorarray = array(1=>array(180,80),array(269,81),array(338,93),array(122,119),array(235,132),array(292,139),array(377,137),array(62,170),array(143,171),array(333,171),array(420,171),array(70,231),array(143,221),array(279,257),array(401,226),array(174,311),array(265,316),array(355,293));
                        
$canornot=array();

    $demolition = $database->getDemolition($village->wid);
            
    for($i=1;$i<=18;$i++) {
        $loopsame = $building->isCurrent($i)?1:0;
        $doublebuild = 0;
        $canornot[$i]=$building->canBuild($i,$village->resarray['f'.$i.'t'],$demolition);
        if($canornot[$i]!=1 && $canornot[$i]!=10){
        if ($loopsame>0 && $building->isLoop($i)) {$doublebuild = 1;}
        $uprequire  = $building->resourceRequired($i,$village->resarray['f'.$i.'t'],($loopsame > 0 ? 2:1)+$doublebuild);
        $level_b= $village->resarray['f'.$i]+($loopsame > 0 ? 2:1)+$doublebuild;
        $bindicate = $building->canBuild($i,$village->resarray['f'.$i.'t'],$demolition);                
            if($_COOKIE['builder']=="Off" || $building->isMax($village->resarray['f'.$i.'t'],$i) || $session->goldclub == 0){
        echo '<area href="build.php?id='.$i.'" coords="'.$coorarray[$i].'" shape="circle" title="<div style=\'color:#FFF\'><b>'.constant('B'.$village->resarray['f'.$i.'t']).'</b> '.LVL.' '.$village->resarray['f'.$i].'</div> ';
            }else{
                echo '<area href="dorf1.php?а='.$i.'&c='.$session->checker.'" coords="'.$coorarray[$i].'" shape="circle" title="<div style=\'color:#FFF\'><b>'.constant('B'.$village->resarray['f'.$i.'t']).'</b> '.LVL.' '.$village->resarray['f'.$i].'</div> ';

            }
                if($bindicate!=10 && $bindicate!=1) echo htmlentities(sprintf(UPGRADECOST,($village->resarray['f'.$i]+($loopsame > 0 ? 2:1)+$doublebuild)).':<br/>
				<div class=\'inlineIconList resourceWrapper\'>
 <span class=\'inlineIcon resources\'> <i class=\'r1\'></i> '.$uprequire['wood'].' </span>
 <span class=\'inlineIcon resources\'> <i class=\'r2\'></i> '.$uprequire['clay'].' </span>
 <span class=\'inlineIcon resources\'> <i class=\'r3\'></i> '.$uprequire['iron'].' </span>
 <span class=\'inlineIcon resources\'> <i class=\'r4\'></i> '.$uprequire['crop'].' </span> 
 </div></div>');
        echo '"/>';
        }elseif($canornot[$i]==1){
            echo '<area href="build.php?id='.$i.'" coords="'.$coorarray[$i].'" shape="circle" title="<div style=\'color:#FFF\'><b>'.constant('B'.$village->resarray['f'.$i.'t']).'</b> '.LVL.' '.$village->resarray['f'.$i].'</div>"/>';
        }elseif($canornot[$i]==10){
            echo '<area href="build.php?id='.$i.'" coords="'.$coorarray[$i].'" shape="circle" title="<div style=\'color:#FFF\'><b> 2 </div>"/>';
        }
    }
	//250,191,32
    ?>
    <area href="dorf2.php" coords="197,191,32" shape="circle" title="<?php echo BUILDINGS; ?>">
</map>
    <img id="resfeld" usemap="#rx" src="img/x.gif" alt="">
<div id="village_map" class="f<?php echo $village->type; ?>">

    <?php
    for($i=1;$i<=18;$i++) {
        if($village->resarray['f'.$i.'t'] != 0) {
            $text = "";
            $onconstr=$building->isCurrent($i)+$building->isLoop($i);
            $style = ''.(DIRECTION == 'rtl' ? 'right': 'left').':'.($stylecoorarray[$i][0]-1).'px;top:'.($stylecoorarray[$i][1]-2).'px;';

            //if($village->resarray['f'.$i] != 0) {
            echo "<div class='level colorLayer ".(($onconstr>0)?'underConstruction':'')." ".(($canornot[$i]==8 || $canornot[$i]==9)?'good':(($canornot[$i]==10 || $canornot[$i]==1)?'maxLevel':'notNow'))." gid".$village->resarray['f'.$i.'t']." level".($village->resarray['f'.$i])."' style=\"".$style." \"><div class=\"labelLayer\">".($village->resarray['f'.$i]==0?'':$village->resarray['f'.$i])."</div></div> ";
            //}
        }
    }
    ?>

</div>
