<div class="contentNavi tabNavi">
    <div class="container <?php if(!isset($_GET) || $_GET['id']==1) {echo "active";}else{echo "normal";} ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="statistiken.php?id=1" class="tabItem"><?=PROFM1?></a></div>
    </div>
    <div class="container <?php if($_GET['id']==31) {echo "active";}else{echo "normal";} ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="statistiken.php?id=31" class="tabItem"><?=OTPRAV3?></a></div>
    </div>
    <div class="container <?php if($_GET['id']==32) {echo "active";}else{echo "normal";} ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="statistiken.php?id=32" class="tabItem"><?=STATISTIC37?></a></div>
    </div>
    <div class="container <?php if($_GET['id']==7) {echo "active";}else{echo "normal";} ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="statistiken.php?id=7" class="tabItem"><?=STATISTIC9?> 10</a></div>
    </div><div class="clear"></div>
</div>