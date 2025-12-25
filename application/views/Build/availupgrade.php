
<?php 
if($i == 13) $i = 12;
?><div id="contract_building<?php echo $i; ?>" class="contract contractNew contractWrapper">
    <div class="contractText"><?=upgra0?></div>
    <div class="inlineIconList resourceWrapper">
        <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?php echo $uprequire['wood']; ?></span></div>
        <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?php echo $uprequire['clay']; ?></span></div>
        <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?php echo $uprequire['iron']; ?></span></div>
        <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?php echo $uprequire['crop']; ?></span></div>
        <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value"><?php echo $uprequire['pop']; ?></span></div>
    </div>
    <div class="lineWrapper">
        <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?php echo $generator->getTimeFormat($uprequire['time']); ?></span></div>
    


        <?php 
        if($session->gold >= 3 && $building->getTypeLevel(17) >= 1 && $bindicator == 7) {
        // Redux-> add some code to check the total resources need to upgrade compared to total player's resources
        if($village->resourceSUM < ($uprequire['wood'] + $uprequire['clay'] + $uprequire['iron'] + $uprequire['crop'])){
            $isDisabled = TRUE;
        }
        
        ?>
        <button type="button" class="gold exchange <?php echo $isDisabled ? 'disabled': ''; ?>"  onfocus="jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;" id="button<?php echo crc32(array_sum($uprequire)); ?>">
        <div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">Sharing resources</div></div></button>
            <?php
            //echo "&nbsp;&nbsp;<button id='button".crc32(array_sum($uprequire))."' type=\"button\" value=\"npc\" class=\"icon\">&nbsp;<img src=\"img/x.gif\" style=\"margin-top:6px;\" class=\"npc\" alt=\"npc\"></button>";
            ?>
            <script type="text/javascript">
               window.addEvent('domready', function()
                {
                    <?php if(!$isDisabled){ ?>
                    if($('button<?=crc32(array_sum($uprequire))?>'))
                    {
                        $('button<?=crc32(array_sum($uprequire))?>').addEvent('click', function ()
                        {
                            window.fireEvent('buttonClicked', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":<?=(($uprequire['wood']))?>,"r2":<?=(($uprequire['clay']))?>,"r3":<?=(($uprequire['iron']))?>,"r4":<?=(($uprequire['crop']))?>,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"<?=$village->wid;?>"}}}]);
                        });
                    }
                    <?php } ?>
                });
            </script>
            <?php
     } ?>
     </div>
    <div class="contractLink">
<?php
    if($bindicator == 2) {
        echo "<span class=\"none\">".upgra1."</span>";
    }
    else if($bindicator == 3) {
        echo "<span class=\"none\">".upgra1."</span>";
    }
    else if($bindicator == 4) {
        echo "<span class=\"none\">".upgra2."</span>";
    }

    else if($bindicator == 5) {
        echo "<span class=\"none\">".upgra3."</span>";
    }
    else if($bindicator == 6) {
        echo "<span class=\"none\">".upgra4."</span>";
    }
    else if($bindicator == 7) {
        $neededtime = $building->calculateAvaliable($id,$i);
        echo "<span class=\"none\">".upgra5." ".$neededtime[1]."</span>";
    }
    else if($bindicator == 8) {
        echo "<button type=\"button\" value=\"Upgrade level\" class=\"green new\" onclick=\"window.location.href = 'dorf2.php?а=$i&id=$id&c=".$session->checker."'; return false;\">
<div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
<div class=\"button-background\">
    <div class=\"buttonStart\">
        <div class=\"buttonEnd\">
            <div class=\"buttonMiddle\"></div>
        </div>
    </div>
</div><div class=\"button-content\">".upgra6."</div></button>";
    }
    else if($bindicator == 9) {
        echo "<button type=\"button\" value=\"Upgrade level\" class=\"green new\" onclick=\"window.location.href = 'dorf2.php?а=$i&id=$id&c=".$session->checker."'; return false;\">
<div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
<div class=\"button-background\">
    <div class=\"buttonStart\">
        <div class=\"buttonEnd\">
            <div class=\"buttonMiddle\"></div>
        </div>
    </div>
</div><div class=\"button-content\">".upgra6."</div></button> <span class=\"none\">".upgra7."</span>";
    }
    if($bindicator == 88 || $session->goldclub && $building->master==0 && $bindicator < 8) {
        if($bindicate != 88){echo "</br>";}
            echo "<button type=\"button\" value=\"Upgrade level\" class=\"gold\" onclick=\"window.location.href = 'dorf2.php?а=$i&id=$id&c=".$session->checker."'; return false;\">
<div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
<div class=\"button-background\">
    <div class=\"buttonStart\">
        <div class=\"buttonEnd\">
            <div class=\"buttonMiddle\"></div>
        </div>
    </div>
</div>";
echo '<div class="button-content">Construction assisted construction <img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1</span>';

        echo "</div></div></button> ";
    }
    ?>

</div>

