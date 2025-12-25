<div class="contentNavi tabNavi">
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == 'buy') { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=buy" class="tabItem"><?=HEROAC30?></a></div>
				</div>
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == sell) { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=sell" class="tabItem"><?=HEROAC31?></a></div>
				</div>
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == bids) { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=bids" class="tabItem"><?=HEROAC32?></a></div>
				</div><div class="clear"></div>
</div>