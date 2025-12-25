
<div class="boxes buildingList">
    <div class="boxes-tl"></div>
    <div class="boxes-tr"></div>
    <div class="boxes-tc"></div>
    <div class="boxes-ml"></div>
    <div class="boxes-mr"></div>
    <div class="boxes-mc"></div>
    <div class="boxes-bl"></div>
    <div class="boxes-br"></div>
    <div class="boxes-bc"></div>
    <div class="boxes-contents cf">
        <h5><?=BUILDING_BUILDING;?></h5>
        <div class="finishNow"><button type="button" class="gold " id="buttonTdNYVlGP9Z7EJ"><div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?=BUILDING_COMPLETE;?></div></div></button>
    <script type="text/javascript" id="buttonTdNYVlGP9Z7EJ_script">
    window.addEvent('domready', function()
        {
        if($('buttonTdNYVlGP9Z7EJ'))
        {
          $('buttonTdNYVlGP9Z7EJ').addEvent('click', function ()
          {
            window.fireEvent('buttonClicked', [this, {"type":"button","dialog":{"saveOnUnload":false,"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"data":{"cmd":"finishNowPopup","context":"finishNow","infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=372#go2answer"}},"id":"buttonTdNYVlGP9Z7EJ"}]);
          });
        }
        });
    </script></div>


        <?php


        if(!isset($timer)) {
        $timer = 1;
        }
        $mas=array();
        $j=0;
        foreach($building->buildArray as $jobss) {
            $mas[$jobss['type']]=$j;
            $j++;
        }

		$BuildingList = array();
        $jj=0;
        foreach($building->buildArray as $jobs) {
            echo '<ul>';
            echo "<li>";
            if($mas[$jobs['type']]==$jj){
                echo "<a href=\"?d=".$jobs['id']."&а=0&c=$session->checker\">";
                echo "<img src=\"img/x.gif\" class=\"del\" title=\"".BUILDING_CANCEL."\" alt=\"".BUILDING_CANCEL."\" /></a><div class=\"name\">";}else{
                echo "<a style='cursor:default'><img src=\"img/x.gif\" class=\"del inactive\"/></a><div class=\"name\">";
            }

            if($jobs['master'] == 0){
                echo $building->procResType($jobs['type'])." <span class=\"lvl\">".BUILDING_LEVEL." ".$jobs['level']."</span>";
                if($jobs['loopcon'] == 0) { $BuildingList[] = $jobs['field']; }
                if($jobs['loopcon'] == 1) {
                    //echo " (".BUILDING_QUEUE.")";
                }
                echo "</div><div class=\"buildDuration\"><span class=\"timer\" counting=\"down\" value=\"".($jobs['timestamp']-time())."\">";
                echo $generator->getTimeFormat($jobs['timestamp']-time());

                echo "</span> ".BUILDING_TIMER." ".date('H:i', $jobs['timestamp'])."</div><div class=\"clear\"></div></li>";
                $timer +=1;

            }else{
                echo "<span class=\"none\">".$building->procResType($jobs['type'])."</span> <span class=\"lvl\">".$jobs['level']."</span> <small><span class=\"none\">".BUILDING_ARCHITECT." <font color=\"#B3B3B3\">(Cost: <img src=\"img/x.gif\" alt=\"\" class=\"gold\"> 1)</font></span></small></div><div class=\"clear\"></div></li>";
            }
                $jj++;
                echo '</ul>';
            }
        ?>


    </div>
</div>
<script type="text/javascript">var bld=[{"stufe":1,"gid":"1","aid":"3"}]</script>
