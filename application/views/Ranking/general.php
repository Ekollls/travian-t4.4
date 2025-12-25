<?php

   $tribe1 = $database->getUserByTribe(1);
   $tribe2 = $database->getUserByTribe(2);
   $tribe3 = $database->getUserByTribe(3);
   $tribes = array($tribe1,$tribe2,$tribe3);
   $users = $tribe1+$tribe2+$tribe3 +1; ?>
<h4 class="round"><?php echo STATISTIC39;?></h4>

<table>
		<tbody><tr></tr></tbody><thead>
			<tr><td colspan="2"><font face="verdana" color="Black" font="" size="3">Win Gold and Real money in some Rounds</font></td>
		</tr></thead>
		
		<tbody><tr></tr></tbody><tbody>
			<tr><td><img src="/images/winner.png" style="width: 70px;"></td>
			<td><font face="verdana" color="Black" font="" size="2">1st player that he build the world wonder to level <b>100</b> will receive <b>2000</b>&nbsp;<img src="img/x.gif" class="gold"></font></td>
		</tr><tr>
			<td><img src="/images/attacker.png" style="width: 70px;"></td>
			<td><font face="verdana" color="Black" font="" size="2">For the 1st place attecker the prize will be <b>500</b>&nbsp;<img src="img/x.gif" class="gold"></font></td>
		</tr>
		<tr>
			<td><img src="/images/defender.png" style="width: 70px;"></td>
			<td><font face="verdana" color="Black" font="" size="2">For the 1st place defender the prize will be <b>500</b>&nbsp;<img src="img/x.gif" class="gold"></font></td>
		</tr>
		<tr>
			<td><img src="/images/pop.png" style="width: 70px;"></td>
			<td><font face="verdana" color="Black" font="" size="2">For the player with the bigger account population the prize will be <b>500</b>&nbsp;<img src="img/x.gif" class="gold"></font></td>
		</tr>
		<tr>
			<td><img src="/images/alliance.png" style="width: 70px;"></td>
			<td><font face="verdana" color="Black" font="" size="2">All players that they participated in the winner's alliance will receive <b>100</b>&nbsp;<img src="img/x.gif" class="gold"></font></td>
		</tr>
		<tr>
			<td colspan="2"><font face="verdana" color="grey" font="" size="1">You will receive the coupon with the prize after the end of the round by email. All the coupons will expiring after 180 days from the day you received the email.</font></td>
		</tr></tbody>
		
</table>
    <h4 class="round spacer">Server Information</h4>

<?php 
if(ARTEFACTS>time()) {
   $time=$generator->getTimeFormat((ARTEFACTS-time()));
   $art = "<span class=\"timer\" counting=\"down\" value=\"".(ARTEFACTS-time())."\">".$time."</span> hour";
}
if(WW_PLAN>time()) {
   $time=$generator->getTimeFormat((WW_PLAN-time()));
   $plan = '<li><p>';
   $plan .= "<span class=\"timer\" counting=\"down\" value=\"".(WW_PLAN-time())."\">".$time."</span> hour.<br/>";
   $plan .= '</p></li>';
}
?>
    <table cellpadding="1" cellspacing="1" id="world_tribes" class="world">
        <tbody>
        <tr class="hover">
                <td>Remaining time until medals distribution:</td>
                <td><span class="timer" counting="down" value="<?php echo MEDALS - (time() - $database->config()['lastmedal']); ?>"><?php echo $generator->getTimeFormat(MEDALS - (time() - $database->config()['lastmedal'])); ?></span> hour</td>
            </tr>
            <tr class="hover">
                <td>Remaining time until oasis troops respawn:</td>
                <td><span class="timer" counting="down" value="<?php echo oMonsters - (time() - $database->config()['lastioasisUpdate']); ?>">
<?php 
echo $generator->getTimeFormat(oMonsters - (time() - $database->config()['lastioasisUpdate'])); ?>
</span> hour</td>
            </tr>
            <tr class="hover">
                <td>Artefacts release time:</td>
                <td><?php if(ARTEFACTS>time()) { echo "<span class=\"timer\" counting=\"down\" value=\"".(ARTEFACTS-time())."\">".$time."</span> hour"; }else{ echo 'Artefacts released'; }?></td>
            </tr>
            <tr class="hover">
                <td>Building plans release time:</td>
                <td><?php if(WW_PLAN>time()) { echo "<span class=\"timer\" counting=\"down\" value=\"".(WW_PLAN-time())."\">".$time."</span> hour"; }else{ echo 'Building plans released'; }?></td>
            </tr>
        </tbody>
    </table>
	
	

