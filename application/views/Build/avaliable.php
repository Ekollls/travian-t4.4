<?php

if($session->qData['quest'] == 8 && $session->qData['step1'] == 0){ // Quest
    $database->query("UPDATE quests SET step1 = 1 WHERE userid = ".$session->uid."");
    header('Location: build.php?id='.$id.'');
}

if($session->qData['quest'] == 9 && $session->qData['step1'] == 0 && $id == 39){ // Quest
    $database->query("UPDATE quests SET step1 = 1 WHERE userid = ".$session->uid."");
    header('Location: build.php?id='.$id.'');
}

// iRedux -> need to add code to check last Iteration in a loop to not print <hr>
if(!isset($id)){$id=0;}
$buildcostr=$database->getJobs1($village->wid);
if(!isset($_GET['category'])){$_GET['category']=1;}
$buildingsArray = array(
    array(15, 26, 23, 10, 11, 18, 17, 25, 26, 34, 27, 24, 28, 35, 38, 39, 41, 44, 45), // cranny, 
    array(31, 32, 33, 37, 19, 22, 12, 20, 21, 14, 36,42,43),
    array(8, 5, 6, 7, 9)
);

if($id == 39 || $id == 40){
    $_GET['category'] = 2;
}
switch($session->tribe){
    case 1:
        $tribeCss = "roman";
        break;
    case 2:
        $tribeCss = "teuton";
        break;
    case 3:
        $tribeCss = "gaul";
        break;
    case 6:
        $tribeCss = "egyptian";
        break;
    case 7:
        $tribeCss = "hun";
        break;
}
?>
<div class="contentNavi subNavi ">
    <div class="container infrastructure <?php if((isset($_GET['category']) && $_GET['category'] == 1) || !isset($_GET['category'])){ echo'active'; }else{ echo 'normal'; } ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content">

            <a id="buttonx1" href="build.php?id=<?php echo $id; ?>&category=1"" class="tabItem">
                Infrastructure                                                        </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#buttonx1')) {
            jQuery('#buttonx1').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "infrastructure active",
                    "title": "Infrastructure",
                    "target": false,
                    "id": "buttonx1",
                    "href": "build.php?id=<?php echo $id; ?>&category=1",
                    "onclick": false,
                    "enabled": true,
                    "text": "Infrastructure",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "buttonx1"
                }]);

            });
        }
    </script>

    <div class="container military <?php if((isset($_GET['category']) && $_GET['category'] == 2)){ echo'active'; }else{ echo 'normal'; } ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content">

            <a id="buttonw2" href="build.php?id=<?php echo $id; ?>&category=2"" class="tabItem">
                Army buildings                                                        </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#buttonw2')) {
            jQuery('#buttonw2').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "military normal",
                    "title": "Army buildings",
                    "target": false,
                    "id": "buttonw2",
                    "href": "build.php?id=<?php echo $id; ?>&category=2",
                    "onclick": false,
                    "enabled": true,
                    "text": "Army buildings",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "buttonw2"
                }]);

            });
        }
    </script>

    <div class="container resources <?php if((isset($_GET['category']) && $_GET['category'] == 3)){ echo'active'; }else{ echo 'normal'; } ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content">

            <a id="buttonL3" href="build.php?id=<?php echo $id; ?>&category=3"" class="tabItem">
                Resource buildings                                                        </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#buttonL3')) {
            jQuery('#buttonL3').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "resources normal",
                    "title": "Resource buildings",
                    "target": false,
                    "id": "buttonL3",
                    "href": "build.php?id=<?php echo $id; ?>&category=3",
                    "onclick": false,
                    "enabled": true,
                    "text": "Resource buildings",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "buttonL3"
                }]);

            });
        }
    </script>

    <div class="clear"></div>
</div>


<h1 class="titleInHeader"><?=build437?></h1>
<div id="build" class="gid0">
<?php
for($i=5,$x=0;$i<=45;$i++){
    $bindicator = $building->canBuild($id,$i);
    $uprequire = $building->resourceRequired($id,$i);
    
    $true[$i]=$building->AvalibleBuilds($i,$buildcostr);
        if($true[$i] && ($id!=39 && $id!=40 || ($id==39 && $i==16 || $id==40 && (in_array($i, array(31,32,33,42,43)))))){        
            if(in_array($i, $buildingsArray[$_GET['category']-1])){
            if($i == 12) $i = 13;
            if($x!=0){ echo '<hr>'; }
            $x++;
        ?>
        <div class="buildingWrapper">
        <h2><?=$lang['buildings'][$i]?></h2>

        <div class="build_desc">
          <a href="#" onclick="return Travian.Game.iPopup(<?php echo $i; ?>,4);" class="build_logo">
             <img class="build_logo building big white g<?php echo $i; ?> <?php echo $tribeCss ?>" src="img/x.gif" alt="<?=$lang['buildings'][$i]?>">
          </a>
            <?=$lang['desc'][$i][0]?>
        </div>


            <?php
            $bid = $i;
            include("availupgrade.php");
            ?>
              <div class="clear"></div>
            </div>
        </div>
        

    <?php
        }else{
            if($id == 39 || $id == 40){
                $x++;
                if($id == 39) $i = 16;
                if($id == 40) $i = '3'.$session->tribe.'';

            ?>
                <div class="buildingWrapper">
                <h2><?=$lang['buildings'][$i]?></h2>

                <div class="build_desc">
                <a href="#" onclick="return Travian.Game.iPopup(<?php echo $i; ?>,4);" class="build_logo">
                    <img class="build_logo building big white g<?php echo $i; ?> <?php echo $tribeCss ?>" src="img/x.gif" alt="<?=$lang['buildings'][$i]?>">
                </a>
                    <?=$lang['desc'][$i][0]?>
                </div>


                    <?php
                    $bid = $i;
                    include("availupgrade.php");
                    ?>
                    <div class="clear"></div>
                    </div>
                </div>

            <?php
            break;
            }
        }
    }
}

if($x ==0){ echo'<div class="none">Buildings cannot be constructed at a time. Most buildings need basic requirements for their construction, see the guide</div>'; }


if($id != 39 && $id != 40) {
?>
<h4 class="round spacer"><?=build438?></h4>

<?php
for($i=5,$x=0;$i<=45;$i++){
    
        if($building->soonBuilds($i,$buildcostr) && !$true[$i]){
            if(in_array($i, $buildingsArray[$_GET['category']-1])){
            $uprequire = $building->resourceRequired($id,$i);
            if($x!=0){ echo '<hr>'; }
            $x++;
            if($i == 12) $i = 13;

?>
        <div class="buildingWrapper">
        <h2><?=$lang['buildings'][$i]?></h2>
        <div class="build_desc">
          <a href="#" onclick="return Travian.Game.iPopup(<?php echo $i; ?>,4);" class="build_logo">
             <img class="build_logo building big white g<?php echo $i; ?> <?php echo $tribeCss ?>" src="img/x.gif" alt="<?=$lang['buildings'][$i]?>">
          </a>
            <?=$lang['desc'][$i][0]?>
        </div>
        <div id="contract_building<?php echo $i; ?>" class="contract contractNew contractWrapper">
        <div class="inlineIconList resourceWrapper">
            <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?php echo $uprequire['wood']; ?></span></div>
            <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?php echo $uprequire['clay']; ?></span></div>
            <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?php echo $uprequire['iron']; ?></span></div>
            <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?php echo $uprequire['crop']; ?></span></div>
            <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value"><?php echo $uprequire['pop']; ?></span></div>
        </div>
        <div class="lineWrapper">
            <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?php echo $generator->getTimeFormat($uprequire['time']); ?></span></div>
        </div>
        <div class="contractText"><?=build439?>:</div>
        <span class="buildingCondition">
        <?php 
        
        $x=0;
        foreach($manual->getBuildRequirements($i) as $build => $level){
                if($build){
                    if($x!=0){ echo ', '; }
                    echo '<a onclick="return Travian.Game.iPopup('.$build.',4);">'.($level ? $lang['buildings'][$build] : '<strike>'.$lang['buildings'][$build].'</strike>');
                    echo '</a>';
                    if($level){echo ' level '.$level.'';}
                    $x++;
                }
                if($i == 44){$onlyHuns = TRUE;}
        }
        if($onlyHuns){echo ', Only for a Hun';}
        if($x == 0){echo 'nothing';}
    ?>
            <?php
            /*$need ='';
            $to= count($lang['descs'][$i]);
            $j=0;
            foreach($lang['descs'][$i] as $llang){
                $j++;
                $need.= " <a>".$lang['buildings'][$llang[0]]."</a> ".build440." ".$llang[1];
                if($j!=$to){$need.=",";}
            }
            echo $need;
            */
            ?>   
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        </div>
<?php 
        }
    }
}
if($x ==0){ echo'<div class="none">A collection of buildings was searched. <br> You may upgrade your Own buildings to even higher levels.</div>'; }

   ?>
   
    </div>

<?php
}else{
    echo "</div>";
}
?>

