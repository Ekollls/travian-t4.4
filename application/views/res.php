
<?php
$start_time = time();
$timelimit = 2;

$troopStarvesEvery = 1;
$ncrop = 0;

$wood = round(($village->awood * 100) / $village->maxstore);
$clay = round(($village->aclay * 100) / $village->maxstore);
$iron = round(($village->airon * 100) / $village->maxstore);
$crop = round(($village->acrop * 100) / $village->maxcrop);

?>


<span id="warehouse" style="display: none;" ><?=$village->maxstore ?></span>
<span id="granary" style="display: none;" ><?=$village->maxcrop ?></span>
<ul id="stockBar">
    <li id="stockBarWarehouseWrapper" class="stock" title="<?=WAREHOUSE?>">
		<i class="warehouse"></i>
        <span class="value" id="stockBarWarehouse" <?php if($village->maxstore > 10000000){ echo 'style="font-size:9px;"'; } ?>><?php echo $village->maxstore; ?></span>
    </li>
    <li id="stockBarResource1" class="stockBarButton" title="<?=WOOD?>||<?=PROD_HEADER?> : <?php echo $village->getProd("wood"); ?>">
        <div class="begin"></div>
        <div class="middle">
            <i class="r1"></i>
            <span id="l1" class="value" <?php if($village->awood > 10000000){ echo 'style="font-size:9px;"'; } ?>><?php echo round($village->awood); ?></span>
            <div class="barBox">
                <div id="lbar1" class="bar" style="width:<?php echo $wood;?>%;"></div>
            </div>
            <a href="dorf3.php" title="<?=WOOD?>||<?=PROD_HEADER?> : <?php echo $village->getProd("wood"); ?>"><img src="img/x.gif" alt="" /></a>
        </div>
        <div class="end"></div>
    </li>
    <li id="stockBarResource2" class="stockBarButton" title="<?=CLAY?>||<?=PROD_HEADER?> : <?php echo $village->getProd("clay"); ?>">
        <div class="begin"></div>
        <div class="middle">
            <i class="r2"></i>
            <span id="l2" class="value" <?php if($village->aclay > 10000000){ echo 'style="font-size:9px;"'; } ?>><?php echo round($village->aclay); ?></span>
            <div class="barBox">
                <div id="lbar2" class="bar" style="width:<?php echo $clay;?>%;"></div>
            </div>
            <a href="dorf3.php" title="<?=CLAY?>||<?=PROD_HEADER?> : <?php echo $village->getProd("clay"); ?>"><img src="img/x.gif" alt="" /></a>
        </div>
        <div class="end"></div>
    </li>
    <li id="stockBarResource3" class="stockBarButton" title="<?=IRON?>||<?=PROD_HEADER?> : <?php echo $village->getProd("iron"); ?>">
        <div class="begin"></div>
        <div class="middle">
            <i class="r3"></i>
            <span id="l3" class="value" <?php if($village->airon > 10000000){ echo 'style="font-size:9px;"'; } ?>><?php echo round($village->airon); ?></span>
            <div class="barBox">
                <div id="lbar3" class="bar" style="width:<?php echo $iron;?>%;"></div>
            </div>
            <a href="dorf3.php" title="<?=IRON?>||<?=PROD_HEADER?> : <?php echo $village->getProd("iron"); ?>"><img src="img/x.gif" alt="" /></a>
        </div>
        <div class="end"></div>
    </li>

    <li id="stockBarGranaryWrapper" class="stock" title="<?=CROP?> ">
        <i class="granary"></i>
        <span class="value" id="stockBarGranary" <?php if($village->maxcrop > 10000000){ echo 'style="font-size:9px;"'; } ?>><?php echo $village->maxcrop; ?></span>
    </li>

    <li id="stockBarResource4" class="stockBarButton">
        <div class="begin"></div>
        <div class="middle">
            <i class="r4"></i>
            <span id="l4" class="value" <?php if($village->acrop > 10000000){ echo 'style="font-size:9px;"'; } ?>><?php echo round($village->acrop); ?></span>
            <div class="barBox">
                <div id="lbar4" class="bar" style="width:<?php echo $crop;?>%;"></div>
            </div>
            <a href="dorf3.php"  title="<?=CROP?>||<?=PROD_HEADER?> : <?php echo $village->getProd("crop"); ?>"><img src="img/x.gif" alt="" /></a>
        </div>
        <div class="end"></div>
    </li>
    <li id="stockBarFreeCropWrapper"  class="stockBarButton r5">
        <div class="begin"></div>
        <div class="middle">
        <i class="r5"></i>
        <span id="stockBarFreeCrop" class="value" style="font-size: 8px;"><?php echo $village->getProd("crop"); ?></span>
            <a href="production.php?t=5" title="crop free || crop backup: <?php echo number_format($village->getProd("crop")); ?><br>Click here for more information"><img src="img/x.gif" alt=""></a>
        </div>
        <div class="end"></div>
    </li>

    
</ul>



<?php
$totalproduction = $village->allcrop; // all crops + bakery + grain mill
$crop = floor($village->acrop);
?>


<script type="text/javascript">
    var resources = new Object();

    resources.production = {
        "l1": <?php echo $village->getProd("wood"); ?>,"l2": <?php echo $village->getProd("clay"); ?>,"l3": <?php echo $village->getProd("iron"); ?>,"l4": <?php echo $village->getProd("crop"); ?>,"l5": <?php echo ($village->allcrop); ?>	};
    resources.storage = {
        "l1": <?php echo $village->awood; ?>,"l2": <?php echo $village->aclay; ?>,"l3": <?php echo $village->airon; ?>,"l4": <?php echo $village->acrop; ?>	};
    resources.maxStorage = {
        "l1": <?php echo $village->maxstore; ?>,"l2": <?php echo $village->maxstore; ?>,"l3": <?php echo $village->maxstore; ?>,"l4": <?php echo $village->maxcrop; ?>	};

    $$('li.stockBarButton').each(function(element)
    {
        Travian.addMouseEvents(element, element);
    });

    var stockBarWarehouse   = $('stockBarWarehouse');
    var stockBarGranary     = $('stockBarGranary');
    var stockBarFreeCrop = $('stockBarFreeCrop');
    var numberFormatter = new Travian.Formatter({forceDecimal:false});

    stockBarWarehouse.set('html', numberFormatter.getFormattedNumber(parseInt(stockBarWarehouse.get('html'))));
    stockBarGranary.set('html', numberFormatter.getFormattedNumber(parseInt(stockBarGranary.get('html'))));

</script>