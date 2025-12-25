<?php
$bid = $village->resarray['f'.$id.'t'];
$bindicate = $building->canBuild($id,$bid);
//$wwlevel = $village->resarray['f'.$id];
$wwlevel = $village->resarray['f'.$id]+($loopsame > 0 ? 2:1)+$doublebuild;
if($wwlevel > 50){
    $needed_plan = 1;
}else{
    $needed_plan = 0;
}

$wwbuildingplan = 0;
$plan=$database->checkArtefactsEffects($session->uid,$village->wid,11);
if($plan > 0){
    $wwbuildingplan = 1;
}

if($session->alliance != 0){
$alli_users = $database->getUserByAlliance($session->alliance);
    foreach($alli_users as $users){
        $plan = $database->checkArtefactsEffects($users['id'],0,11);
        if($plan > 0){
            $wwbuildingplan += 1;
        }
    }
}

$bid = $village->resarray['f'.$id.'t'];
$bindicate = $building->canBuild($id,$bid);

$uprequire = $building->resourceRequired($id,$village->resarray['f'.$id.'t'],1+$loopsame+$doublebuild+$master);
?>
	<div id="contractSpacer"></div>
	<div id="contract" class="contractWrapper">
			<div class="inlineIconList resourceWrapper">
			<div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?php echo $uprequire['wood']; ?></span></div>
			<div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?php echo $uprequire['clay']; ?></span></div>
			<div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?php echo $uprequire['iron']; ?></span></div>
			<div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?php echo $uprequire['crop']; ?></span></div>
			<div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value"><?php echo $uprequire['pop']; ?></span></div>
		</div>
	</div>
	<div class="culturePointsAndPopulation ">
                <div class="wrapper">
                    <div class="unit">
                        <i class="culturePoints_medium"></i>
                        <span class="value"><?php echo $Travian->getAllpop($village->resarray['f'.$_GET['id'].'t'], $village->resarray['f'.$id])[1]; ?></span>
                        <?php 
                            // iRedux - Fix
                            $popAdd = ${'bid40'}[$village->resarray['f'.$_GET['id']]+($loopsame > 0 ? 2:1)]['pop'];
                            $cpAdd = ${'bid40'}[$village->resarray['f'.$_GET['id']]+($loopsame > 0 ? 2:1)]['cp'];
                        ?>
                        <span class="delta">(&#8237;+&#8237;<?php echo $cpAdd; ?>&#8236;&#8236;)</span>
                    </div>
                    <div class="unit">
                        <i class="population_medium"></i>
                        <span class="value"><?php echo $Travian->getAllpop($village->resarray['f'.$_GET['id'].'t'], $village->resarray['f'.$id])[0]; ?></span>
                        <span class="delta">(&#8237;+&#8237;<?php echo $popAdd; ?>&#8236;&#8236;)</span>
                    </div>
                </div>
            </div>
            <div class="upgradeButtonsContainer <?php if(MAX_LEVEL){ echo'section2Enabled'; }?>">
                <div class="section1">

            <div class="clear"></div>
            
<?php
if($wwbuildingplan>$needed_plan){ // >


if($bindicate == 1) {
    echo "<p><span class=\"none\">".UPG0."</span></p>";
} else if($bindicate == 10) {
    echo "<p><span class=\"none\">".ww5."</span></p>";
} else if($bindicate == 11) {
    echo "<p><span class=\"none\">Здание находится на сносе.</span></p>";
} else {

$time=time();


    $wood = round($village->awood);
    $clay = round($village->aclay);
    $iron = round($village->airon);
    $crop = round($village->acrop);

    $totalres = $uprequire['wood']+$uprequire['clay']+$uprequire['iron']+$uprequire['crop'];
    $availres = $wood+$clay+$iron+$crop;
    if($availres >= $totalres){ $style = "npc"; } else { $style = "npc_inactive"; $disable = "disabled=\"disabled\""; }
?>
    <?php
    if($bindicate == 2) {
        echo "<span class=\"none\">".UPG5."</span>";
        ?>
    <?php

    }
    else if($bindicate == 3) {
        echo "<span class=\"none\">".UPG6."</span>";

        ?>
    <?php

    }
    else if($bindicate == 4) {
        echo "<span class=\"none\">Нехinатает еды. Разinиinайте фермы.</span>";
    }
    else if($bindicate == 5) {
        echo "<span class=\"none\">Upgrade Warehouse.</span>";
    }
    else if($bindicate == 6) {
        echo "<span class=\"none\">Разinиinайте Амбар.</span>";
    }
    else if($bindicate == 7) {
        $neededtime = $building->calculateAvaliable($id,$village->resarray['f'.$id.'t'],1+$loopsame+$doublebuild+$master);
        if($neededtime==0){echo "<span class=\"none\">Enough resources Never</span>";}else{
            echo "<span class=\"none\">Enough resources  ".$neededtime[0]." in  ".$neededtime[1]."</span>";}
    }
    else if($bindicate == 8) {
            echo "<button type=\"submit\" value=\"Upgrade level\" class=\"green small\" onclick=\"window.location.href = 'dorf2.php?а=$id&c=$session->checker'; return false;\">
     <div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
    <div class=\"button-background\">
        <div class=\"buttonStart\">
            <div class=\"buttonEnd\">
                <div class=\"buttonMiddle\"></div>
            </div>
        </div>
    </div><div class=\"button-content\">".UPG11." ";

        echo $village->resarray['f'.$id]+1;
        echo " </div></div></button>";
    }

    else if($bindicate == 9) {

        echo "<button type=\"submit\" value=\"Upgrade level\" class=\"green small\" onclick=\"window.location.href = 'dorf2.php?а=$id&c=$session->checker'; return false;\">
     <div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
    <div class=\"button-background\">
        <div class=\"buttonStart\">
            <div class=\"buttonEnd\">
                <div class=\"buttonMiddle\"></div>
            </div>
        </div>
    </div><div class=\"button-content\">".UPG11." ";

        echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1);
        echo "</div></div></button> <span class=\"none\">".upgra7."</span>";
    }
    if($bindicate == 88 || $session->goldclub && $building->master==0 && $bindicate < 8) {
        if($bindicate != 88){echo "</br>";}
        if($id <= 18) {
            echo "<button type=\"button\" value=\"Upgrade level\" class=\"green\" onclick=\"window.location.href = 'dorf1.php?а=$id&c=$session->checker'; return false;\">
    	<div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
    <div class=\"button-background\">
        <div class=\"buttonStart\">
            <div class=\"buttonEnd\">
                <div class=\"buttonMiddle\"></div>
            </div>
        </div>
    </div><div class=\"button-content\">".C6." ";
        }
        else {
            echo "<button type=\"button\" value=\"Upgrade level\" class=\"gold builder\" onclick=\"window.location.href = 'dorf2.php?а=$id&c=$session->checker'; return false;\">
            <div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
                <div class=\"button-background\">
                    <div class=\"buttonStart\">
                        <div class=\"buttonEnd\">
                            <div class=\"buttonMiddle\"></div>
                        </div>
                    </div>
                </div><div class=\"button-content\">".UPG12." ";
        }
        //echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1)+$doublebuild;
        echo '<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1</span>';
        echo "</div></div></button>";
    }elseif($bindicate < 8){echo "<br><br>";}
    }
    ?>
            <div class="inlineIcon duration">
                <i class="clock_medium"></i>
                <?php echo '<span class="value ">'.$generator->getTimeFormat($uprequire['time']*2).'</span>'; ?>
            </div> 
    <?php 
	}else{
        if($needed_plan == 0){
            echo "<span class=\"none\" style=\"padding:5px;\">".ww9."</span>";
        }else{
            echo "<span class=\"none\" style=\"padding:5px;\">".ww8."</span>";
        }
	}

?>
    </div>
</div>
