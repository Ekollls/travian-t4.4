<div class="clear"></div>
<?php
if($_REQUEST["cancel"] == "1") {
	$database->delDemolition($village->wid);
	$database->DeleteQueue("`if1`='".$village->wid."' and `type`='9'");
	header("Location: build.php?id=".$_GET['id']."&s=15");

}
if(!empty($_REQUEST["demolish"]) && $_REQUEST["c"] == $session->mchecker) {
	
	if($_REQUEST["type"] != null && !isset($_REQUEST['tozero']) || $_REQUEST['tozero']==0) 	{
		$type = $_REQUEST['type'];
		$infa=$database->addDemolition($village->wid,$type,$village->resarray);
		$session->changeChecker();
		$database->insertQueue($infa[0],9,time(),$infa[1],$village->wid);
		header("Location: build.php?id=".$_GET['id']."&s=15");
	}elseif($_REQUEST['tozero']==1){
        $_REQUEST['type']=$database->FilterIntValue($_REQUEST['type']);
        if($_REQUEST['type']>=19 && $_REQUEST['type']<=40 && $session->gold>=DEMOLISH_FULL){
			$database->query("UPDATE fdata SET `f".$_REQUEST['type']."`=0,`f".$_REQUEST['type']."t`=0 WHERE `vref`='".$village->wid."'");
			$database->recountPop($village->wid);
			if($session->acData['a5'] < 6){
				$database->UpdateAchievU($session->uid,"`a5`=a5+2");
			}
            $database->modifyGold($session->uid,DEMOLISH_FULL,0);
        }
        header("Location: build.php?id=".$_GET['id']."&s=15");
    }

}

if($village->resarray['f'.$id] >= 10) {
	?>
	<h4 class="round">Building demolition:</h4>
	<p>If you don't need a building, you can demolish From here:</p>

	<?php
	//echo "<h2>".gz0."</h2><p>".gz1."</p>";
	$VillageResourceLevels = $village->resarray;
	$DemolitionProgress = $database->getDemolition($village->wid);
	if (!empty($DemolitionProgress)) {
		$Demolition = $DemolitionProgress[0];
		echo "<b>";
		echo "<a href='build.php?id=".$id."&cancel=1'><img src='img/x.gif' class='del' title='cancel' alt='cancel'></a> ";
		echo "".gz2." ".$building->procResType($VillageResourceLevels['f'.$Demolition['buildnumber'].'t']).": <span class='timer' counting='down' value='".($Demolition['timetofinish']-time())."'>".$generator->getTimeFormat($Demolition['timetofinish']-time())."</span>";
		?>
		<a href="?buildingFinish=1" onclick="return confirm <?=gz3?>;" title="Finish all construction and research orders in this village immediately for 2 Gold?"><img class="clock" alt="Finish all construction and research orders in this village immediately for 2 Gold?" src="img/x.gif"/></a>
			<?php
		echo "</b>";
	} else {
		echo "
		<form action=\"build.php?id=".$_GET['id']."&s=15&amp;demolish=1&amp;cancel=0&amp;c=".$session->mchecker."\" method=\"POST\" style=\"display:inline\">
		<select name=\"type\" id=\"demolish\" class=\"demolish\">";
		for ($i=19; $i<=41; $i++) {
			if ($VillageResourceLevels['f'.$i] >= 1 && !$building->isCurrent($i) && !$building->isLoop($i)) {
				echo "<option value=".$i.">".$i.". ".$building->procResType($VillageResourceLevels['f'.$i.'t'])." (lvl ".$VillageResourceLevels['f'.$i].")</option>";
			}
		}
		echo "</select>";
        echo "";
        echo " <button type=\"submit\"  id=\"btn_demolish\" class=\"green\"> <div class=\"button-container addHoverClick\">
  <div class=\"button-background\">
   <div class=\"buttonStart\">
    <div class=\"buttonEnd\">
     <div class=\"buttonMiddle\"></div>
    </div>
   </div>
  </div>
  <div class=\"button-content\">" . gz4 . "</div></div></button>";
  ?>
<div class="demolishNow">
        <button type="button" class="gold " coins="<?php echo DEMOLISH_FULL; ?>" id="buttonRIqnOWSTsTeLO"><div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">Completely demolished<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue"><?php echo DEMOLISH_FULL; ?></span></div></div></button>
    <script type="text/javascript" id="buttonRIqnOWSTsTeLO_script">
    window.addEvent('domready', function()
        {
        if($('buttonRIqnOWSTsTeLO'))
        {
          $('buttonRIqnOWSTsTeLO').addEvent('click', function ()
          {
            window.fireEvent('buttonClicked', [this, {"type":"button","dialog":{"saveOnUnload":false,"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"data":{"cmd":"demolishNowPopup","additional":{"gidCallback":"getGid"},"context":"demolishNow","infoIcon":"http:\\\/\\\/t4.answers.travian.com\\\/index.php?aid=%%answers.demolishNow (en)%%#go2answer"}},"title":"\u0647\u062f\u0645 \u0627\u0644\u0645\u0628\u0646\u0649 \u0627\u0644\u0645\u062d\u062f\u062f \u061f \u0633\u064a\u062a\u0645 \u062d\u0630\u0641\u0647 \u0646\u0647\u0627\u0626\u064a\u0627\u064b \u0645\u0646 \u0627\u0644\u0642\u0631\u064a\u0629","coins":2,"id":"buttonRIqnOWSTsTeLO"}]);
          });
        }
        });
    </script>    </div>
	    <script type="text/javascript">
        function getGid() {
            var gidSelect = $('demolish');
            return {additionalData: {gid: gidSelect.options[gidSelect.selectedIndex].value}};
        }
    </script>

  <?php
  echo "</form>";
    }
}
?>
