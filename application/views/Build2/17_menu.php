<div class="contentNavi"></div>
<div class="contentNavi subNavi">
				<div <?php if(!isset($_GET['t'])) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=<?php echo $id; ?>" class="tabItem">Overview</a></div>
				</div>
				<div <?php if(isset($_GET['t']) && $_GET['t'] == 5) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=<?php echo $id; ?>&amp;t=5" class="tabItem"><?php echo SendResouces; ?></a></div>
				</div>
				<div <?php if(isset($_GET['t']) && $_GET['t'] == 1) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=<?php echo $id; ?>&amp;t=1" class="tabItem"><?php echo Buyma; ?></a></div>
				</div>
				<div <?php if(isset($_GET['t']) && $_GET['t'] == 2) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=<?php echo $id; ?>&amp;t=2" class="tabItem"><?php echo Offerma; ?></a></div>
				</div>
                <?php  $test=1;  if($test != 1 && $session->gold >= 3) { ?>
                <div <?php if(isset($_GET['t']) && $_GET['t'] == 3) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=<?php echo $id; ?>&amp;t=3" class="tabItem"><?php echo ONPCtrading; ?></a></div>
				</div>
                <?php } ?>
				<?php if($test != 1 && $session->goldclub == 1 && count($database->getProfileVillages($session->uid)) > 1) {
				?>
				
				<div <?php if(isset($_GET['t']) && $_GET['t'] == 4) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=<?php echo $id; ?>&amp;t=4" class="tabItem"><?=market0?></a></div>
				</div>
				<?php
				}
				?>
</div>
