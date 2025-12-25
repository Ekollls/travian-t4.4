<?php
if(!isset($aid)) {
$aid = $session->alliance;
}
if($aid==$session->alliance){
$allianceinfo = $database->getAlliance($aid);

$noticeArray = $database->readAlliNotice($aid);

//echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include("alli_menu.php");
?>
    <h4 class="chartHeadline"><?php echo ALLIANCE9; ?></h4>
    <table cellpadding="1" cellspacing="1" id="events"><thead>
<tr>
<td><?php echo ALLIANCE10; ?></td>
<td><?php echo ALLIANCE11; ?></td>
</tr>
</thead>
<tbody>
<?php
foreach($noticeArray as $notice) {
$date = $generator->procMtime($notice['date']);
echo "<tr>";
echo "<td class=event>".$notice['comment']."</td>";
echo "<td class=dat><center>".$date['0']." ".$date['1']."</center></td>";
echo "</tr>";
}
?>
</tbody>
</table>
<?php }?>