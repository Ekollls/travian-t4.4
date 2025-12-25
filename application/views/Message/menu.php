<div class="contentNavi subNavi">
    <div title="" class="<?php if(!isset($_GET['t'])) { echo "container active"; }else{ echo "container normal"; } ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="nachrichten.php" class="tabItem"><?=MSG6?></a></div>
    </div>
    <div title="" class="<?php if(isset($_GET['t']) && $_GET['t'] == 1) { echo "container active"; }else{ echo "container normal"; } ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="nachrichten.php?t=1" class="tabItem"><?=MSG7?></a></div>
    </div>
    <div title="" class="<?php if(isset($_GET['t']) && $_GET['t'] == 2) { echo "container active"; }else{ echo "container normal"; } ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="nachrichten.php?t=2" class="tabItem"><?=MSG8?></a></div>
    </div>
    <div title="" class="<?php if(isset($_GET['t']) && $_GET['t'] == 5) { echo "container active"; }else{ echo "container normal"; } ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="nachrichten.php?t=5" class="tabItem"><?=Ignored;?></a></div>
    </div>

    <div class="clear"></div>
</div>
