<?php
$dorf1 = $dorf2 = '';
${'dorf'.$session->link}='active';
?>
            <a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank"
               title="<?php echo SERVER_NAME ?>"></a>
<ul id="navigation">
<li id="n1" class="villageResources">
	<a class="<?php echo $_SESSION['page'] == "dorf1.php" || ($_SESSION['page'] != "dorf1.php" AND $_SESSION['page'] != "dorf2.php") ? 'active' : 'inactive';  ?> " href="dorf1.php" accesskey="1" title="<?php echo HEADER_DORF1; ?>||"></a>
</li>
<li id="n2" class="villageBuildings">
	<a class="<?php echo $_SESSION['page'] == "dorf2.php" ? 'active' : 'inactive';  ?>" href="dorf2.php" accesskey="2" title="<?php echo HEADER_DORF2; ?>||"></a>
</li>
<li id="n3" class="map">
	<a href="karte.php" accesskey="3" title="<?php echo HEADER_MAP; ?>||"></a>
</li>
<li id="n4" class="statistics">
	<a  href="statistiken.php" accesskey="4" title="<?php echo HEADER_STATS; ?>||"></a>
</li>
    <li id="n5" class="reports">
        <a href="berichte.php" accesskey="5" title="<?php echo HEADER_NOTICES; ?>|| <?=newrpt?><?php echo " ".$session->unread['notice'];  ?>"></a>
        <?php
        if($session->unread['notice'] !=0){
            $not = $session->unread['notice'] >= 100 ? "100+" : $session->unread['notice'];
            echo "<div class=\"speechBubbleContainer \">
			<div class=\"speechBubbleBackground\">
				<div class=\"start\">
					<div class=\"end\">
						<div class=\"middle\"></div>
					</div>
				</div>
			</div>
			<div class=\"speechBubbleContent\">".$not."</div>
		</div>";
        }
        ?>
    </li>
    <li id="n6" class="messages">
        <a href="nachrichten.php" accesskey="6" title="<?php echo HEADER_MESSAGES; ?>|| <?=newmsg?><?php echo " ".$session->unread['mes'];  ?>"></a>
        <?php
        if($session->unread['mes'] !=0) {
            $mes = $session->unread['mes'] >= 100 ? "100+" : $session->unread['mes'];
            echo "
<div class=\"speechBubbleContainer \">
			<div class=\"speechBubbleBackground\">
				<div class=\"start\">
					<div class=\"end\">
						<div class=\"middle\"></div>
					</div>
				</div>
			</div>
			<div class=\"speechBubbleContent\">".$mes."</div>
		</div>";
        }
        ?>
    </li>
	<li id="n7" class="gold">
		<a href="#" accesskey="7" onclick="window.fireEvent('startPaymentWizard', {}); this.blur(); return true;" class=""></a>
	</li>
					</ul>

<script type="text/javascript">
	window.addEvent('domready', function()
	{
		Travian.Game.Layout.goldButtonAnimation();
	});
</script>