<div id="goldSilver">
	<div class="gold">
		<img src="img/x.gif" alt="<?php echo HEADER_GOLD; ?>" title="<?php echo HEADER_GOLD; ?>" class="gold"  />
		<span id="ajaxReplaceableGoldAmount_2" class="ajaxReplaceableGoldAmount"><?php echo $session->gold; ?></span>
	</div>
	<div class="silver">
		<a href="hero_auction.php"><img src="img/x.gif" alt="<?php echo HEADER_SILVER; ?>" title="<?php echo HEADER_SILVER; ?>" class="silver" /></a>
		<span class="ajaxReplaceableSilverAmount"><?php echo "$session->silver"; ?></span>
	</div>
</div>
	<ul id="outOfGame" class="<?php echo DIRECTION; ?>">
		<li class="profile">
			<a href="spieler.php">
				<img src="img/x.gif" title="<?=$lang['Toolbar']['01'];?>">
			</a>
		</li>
		<li class="options">
						<a href="options.php">
					<img src="img/x.gif" title="<?=$lang['Toolbar']['02'];?>">
				</a>
		</li>
		<li class="forum">
			<a target="_blank" href="#">
			<img src="img/x.gif" title="<?=$lang['Toolbar']['03'];?>">
			</a>
		</li>
		<li class="help">
			<a href="nachrichten.php?t=1&id=6">
				<img src="img/x.gif" alt="<?=HELP?>" title="<?=$lang['Toolbar']['04'];?>">
			</a>
		</li>
       
		<li class="logout ">
			<a href="logout.php">
				<img src="img/x.gif" alt="<?=LOGOUT?>" title="<?=$lang['Toolbar']['05'];?>">
			</a>
		</li>

		<li class="clear">&nbsp;</li>
		
		
	</ul>

	
	<script type="text/javascript">
	$$('#outOfGame li.logout a').addEvent('click', function(){
		Travian.WindowManager.getWindows().each(function($dialog){
			Travian.WindowManager.unregister($dialog);
		});
	});
	</script>



