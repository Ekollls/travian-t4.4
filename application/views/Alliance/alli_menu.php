<?php if($session->alliance == $aid) {
    ?>
    <div class="contentNavi subNavi">
        <div title="" class="container <?php if(!isset($_GET['ss']) && !isset($_GET['s']) || $_GET['s'] == 1) { echo "active"; }else{ echo "normal"; } ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content"><a href="allianz.php" class="tabItem"><?=PROFM1?></a></div>
        </div>
        <div title="" class="container <?php if(isset($_GET['s'])  && $_GET['s'] == 4) { echo "active"; }else{ echo "normal"; } ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content"><a href="allianz.php?s=4" class="tabItem"><?=ally8?></a></div>
        </div>
        <div title="" class="container <?php if(isset($_GET['s']) && $_GET['s'] == 3) { echo "active"; }else{ echo "normal"; } ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content"><a href="allianz.php?s=3" class="tabItem"><?=ally9?></a></div>
        </div>
        <?php if($session->sit == 0){?>
        <div title="" class="container <?php if(isset($_GET['ss']) || isset($_GET['s']) && $_GET['s'] == 5) { echo "active"; }else{ echo "normal"; } ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content"><a href="allianz.php?s=5" class="tabItem"><?=ally10?></a></div>
        </div><?php } ?><div class="clear"></div>
    </div>

<?php
}
?>