<h1 class="titleInHeader">Plus</h1>
        <div class="contentNavi subNavi">
         
        <div title="" class="container <?php if(!isset($_GET['id'])) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="plus.php" class="tabItem">Buy gold</a></div>
            </div>
            <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 3) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="plus.php?id=3" class="tabItem"> <?=pluss22?></a></div>
            </div>
            
            <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 5) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="plus.php?id=5" class="tabItem">Shipping code</a></div>
            </div>
        <?php if($session->access == 9){ ?>
            <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 6) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="plus.php?id=6" class="tabItem">Generate gold codes</a></div>
            </div>
        <?php } ?>
            <div class="clear"></div>
        </div>