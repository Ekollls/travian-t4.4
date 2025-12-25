<?php
if($session->qData['quest'] == 12 && $session->qData['step1'] == 1 && $session->qData['step2'] == 0){ // Quest
	$database->query("UPDATE quests SET step2 = 1,isFinished=1 WHERE userid = ".$session->uid."");
	header('Location: berichte.php?id='.$_GET['id'].'');
}

$dataarray = explode(",",$all['data']);
$outputList='';
?>

<div id="reportWrapper">
    <div class="header">
                    <div class="headline withoutQuickNavigation">
                    <div class="subject"><?=$all['topic']?>.</div>
            </div>
                <div class="time">
				<?php $date = $generator->procMtime($all['time']); ?>
            <div class="text"><?php echo $date[0]."<span> ".REPORT_AT." ".$date[1]; ?></div>
        </div>

		<div class="toolList">
		<?php //if($session->plus){ ?>
			<form method="post" action="berichte.php">
			<input name="n1" value="<?php echo $_GET['id']; ?>"  type="hidden">
				<button type="submit" id="deleteReportButton" class="icon "><i class="reportButton delete"></i>
				</button>
			</form>
		<?php //} ?>

		<div class="clear"></div>
		</div>

    </div>
	<div class="body">
		<img src="img/x.gif" class="reportImage adventure<?php if($dataarray[1]!='dead'){ ?>Victory<?php }else{ ?>Lose<?php } ?>">
		<div class="adventureReport" style="margin-top:-4px;">
			<div class="adventureHeader">
				<div class="headline">
					<div class="from">
						<i class="tribeIcon bigTribe<?php echo $session->tribe; ?>"> </i>
						<img class="roleIcon" src="img/svg/combat/svgAttack.svg" alt="">
						<h2>adventure</h2>
					</div>
					<div class="to">
						<svg viewBox="0 0 20 20" preserveAspectRatio="none">
							<path d="M0 0L20 10L0 20z"></path>
						</svg>
					</div>
				</div>
			</div>
			<table class="additionalInformation">
		<tbody class="infos">
		<tr><td class="empty" colspan="12"></td></tr>
		<tr>
			<th><?=REPORT_INFORMATION?></th>
			<td class="dropItems" colspan="11">
            <?php if($dataarray[1]!='dead'){ ?>
				<img src="img/x.gif" class="iExperience" title="Experience:">
				+<?php echo number_format($dataarray[5]); ?>
				<img src="img/x.gif" class="injury" title="Injury:">
				-<?php echo round($dataarray[4]); ?>%
            <?php }else{
            		echo '<img src="img/x.gif" class="adventureDifficulty0" title="'.punktxuev8.'">'.$dataarray[2];
                  }
            ?>
            	
			</td>
		</tr>
			</tbody>
<?php if($dataarray[1]!='dead'){ ?>
	<tbody class="goods">
		<tr><td class="empty" colspan="12"></td></tr>
		<tr>
			<th><?=REPORT_BOUNTY?>:</th>
			<td colspan="11">
            <?php
           	if($dataarray[1]){
            	$typeArray = array("","helmet","body","leftHand","rightHand","shoes","horse","bandage25","bandage33","cage","scroll","ointment","bucketOfWater","bookOfWisdom","lawTables","artWork");
                $btype = $dataarray[1];
                $type = $dataarray[2];
				if($btype < 16){
				$typeArray = array("","helmet","body","leftHand","rightHand","shoes","horse","bandage25","bandage33","cage","scroll","ointment","bucketOfWater","bookOfWisdom","lawTables","artWork");
				echo '<img src="img/x.gif" class="reportInfo itemCategory itemCategory_'.$typeArray[$btype].'" title="'.$Travian->getItemData($btype, $type)['name'].'">';
				echo ' '.$Travian->getItemData($btype, $type)['name'].' ('.$dataarray[3].'x)';
				}else if($btype == 16){
				echo '<img src="img/x.gif" class="unit u'.(($session->tribe-1)*10+$type).'" title="'.constant('U'.(($session->tribe-1)*10+$type)).'">';
				echo ' ('.round($dataarray[3]).'x)';
							$outputList .= "<div class=\"reportInfoIcon\"><img title=\"(".$dataarray[3]."x)\" src=\"img/x.gif\" class=\"unit u".(($session->tribe-1)*10+$type)."\"\"></div>";
				}else{
				echo '<img src="img/x.gif" class="silver" title="'.$lang['Report']['Silver'].'">';
					echo $lang['Report']['Silver'].' ('.$dataarray[3].'x)';
				}
            }else{		
            	echo $dataarray[2];
				//TODO: УБРАТЬ ЭТУ ХУЙНЮ!!!!
            }
            ?>
			</td>
		</tr>
	</tbody>
<?php } ?>
</table>					<div class="clear"></div>
				</div>
			</div>
		</div>
