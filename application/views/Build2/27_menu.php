
<?php
if(isset($_GET['show'])){
    $artefact = $database->getArtefactDetails($database->FilterIntValue($_GET['show']));
    if($artefact['size'] ==1){
        $isSM = TRUE;
    }

    if($artefact['size'] ==3 || $artefact['size'] ==2){
        $isBG = TRUE;
    }
}
?>
<div class="contentNavi subNavi">
    <div <?php if(!isset($_GET['t']) && $_GET['id'] == $id && !$isSM && !$isBG) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="build.php?id=<?php echo $id; ?>" title="<?=PROFM1?>" class="tabItem"><?=PROFM1?></a></div>
    </div>
    <div <?php if(isset($_GET['t']) && $_GET['t'] == 5) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="build.php?id=<?php echo $id; ?>&t=5" title="Artefacts around" class="tabItem">Artefacts around</a></div>
    </div>
    <div <?php if(isset($_GET['t']) && $_GET['t'] == 2 || $isSM) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="build.php?id=<?php echo $id; ?>&t=2" title="<?=sokr18?>" class="tabItem"><?=sokr18?></a></div>
    </div>
    <div <?php if(isset($_GET['t']) && $_GET['t'] == 3 || $isBG) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="build.php?id=<?php echo $id; ?>&t=3" title="<?=sokr20?>" class="tabItem"><?=sokr20?></a></div>
    </div>
    <div class="clear"></div>
</div>