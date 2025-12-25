

<?php
if($village->resarray['f'.$id] >= 3 && $session->alliance == 0) {
include("18_create.php");
}
if($session->alliance != 0) {
echo "
<table cellpadding=\"1\" cellspacing=\"1\" id=\"ally_info\" class=\"transparent\"><div class=\"clear\"></div>
        <h4 class=\"round\">".posl0."</h4>
	<tbody><tr>
		<th>".posl1.":</th>
		<td>".$alliance->allianceArray['tag']."</td>
	</tr>
	<tr>
		<th>".posl2."</th>
		<td>".$alliance->allianceArray['name']."</td>

	</tr>
	<tr>
		<td colspan=\"2\"><a href=\"allianz.php\" class=\"arrow\">".posl3."</a></td>
	</tr></tbody>
	</table>";
    }
    else {
    ?>
    <div class="clear"></div>
    <h4 class="round"><?=posl4?></h4>
<table cellpadding="1" cellspacing="1" id="join" class="transparent">
<form method="post" action="build.php">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="a" value="2">

<thead></thead>
<tbody><tr>
	<?php
    if($alliance->gotInvite) {
    	foreach($alliance->inviteArray as $invite) {
        	 echo "
             <div>
             <button type=\"button\" value=\"npc\" class=\"icon\" onclick=\"window.location.href = 'build.php?id=".$id."&a=2&d=".$invite['id']."'; return false;\"><img class=\"del\" src=\"img/x.gif\" alt=\"Törlés\" title=\"Törlés\" /></button>
        <a href=\"allianz.php?aid=".$invite['alliance']."\">&nbsp;".$database->getAllianceName($invite['alliance'])."</a>
       <button type=\"button\"  class=\"green\" onclick=\"window.location.href = 'build.php?id=".$id."&a=3&d=".$invite['id']."'; return false;\">
 <div class=\"button-container addHoverClick\">
  <div class=\"button-background\">
   <div class=\"buttonStart\">
    <div class=\"buttonEnd\">
     <div class=\"buttonMiddle\"></div>
    </div>
   </div>
  </div>
  <div class=\"button-content\">".posl5."</div></div></button></div>";
        }
        }
    else {
		echo "<td colspan=\"3\" class=\"none\">".posl6."</td>";
        }
        ?>
	</tr></tbody></table>
    <?php
        if($alliance->gotInvite) {
        echo "<p class=\"error2\" style=\"color: #DD0000\">".$form->getError("ally_accept")."</p>";
        } 
    }
?>

