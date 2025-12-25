<h1 class="titleInHeader"><?=XTRAVIAN.RU?> <font color="#71D000"><?=P?></font><font color="#FF6F0F"><?=L?></font><font  color="#71D000"><?=U?></font><font color="#FF6F0F"><?=S?></font></h1>
        <div class="contentNavi subNavi">
         
            <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 3) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="plus.php?id=3" class="tabItem"> <?=pluss22?></a></div>
            </div>
              <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 6) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="plus.php?id=6" class="tabItem"> <?php echo "Банк"; ?></a></div>
            </div>
            <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 5) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="plus.php?id=5" class="tabItem"> <?=pluss23?></a></div>
            </div>
            <div class="clear"></div>
        </div>