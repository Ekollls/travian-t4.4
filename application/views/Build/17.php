

<?php
$_SESSION['loadMarket'] = 1;
if(!isset($_POST['action']) && !isset($_GET['action'])){
    include("application/Market.php");
$market->procMarket($_POST);
$market->procRemove($_GET);
}
 //include("17_menu.php");

if(!isset($_GET['t']) || !in_array($_GET['t'],array(1,2,3,4,5))){
    ?>
    <div class="clear"></div>
    <h4 class="round"><?php echo $lang['Build']['Market01']; ?></h4>
    <div class="whereAreMyMerchants">
    <?php //Market Object ( [onsale] => Array ( ) [onmarket] => Array ( [0] => Array ( [id] => 1 [vref] => 23838 [gtype] => 1 [gamt] => 100 [wtype] => 2 [wamt] => 200 [accept] => 0 [maxtime] => 0 [alliance] => 0 [merchant] => 1 ) [1] => Array ( [id] => 2 [vref] => 23838 [gtype] => 1 [gamt] => 1000 [wtype] => 2 [wamt] => 2000 [accept] => 0 [maxtime] => 0 [alliance] => 0 [merchant] => 1 ) ) [sending] => Array ( ) [recieving] => Array ( ) [return] => Array ( ) [maxcarry] => 1000000 [merchant] => 3 [used] => 2 ) التجارة الحرة: ‎1/3 ‎
 ?>
    <?php echo $lang['Build']['Market02']; ?>: &lrm;<?php echo $market->merchantAvail(); ?>/<?php echo $market->merchant; ?>    &lrm;<br>
    <?php echo $lang['Build']['Market03']; ?>: &lrm;<?php echo count($market->onmarket); ?>/<?php echo $market->merchant; ?>    &lrm;<br>
    <?php echo $lang['Build']['Market04']; ?>: &lrm;<?php echo count($market->return) + count($market->sending); ?>/<?php echo $market->merchant; ?>    &lrm;
</div>
<div class="npcMerchant"><?php echo $lang['Build']['Market05']; ?><br>
    <button type="button" class="gold exchange " id="buttonm7"><div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content"><?php echo $lang['Build']['Market06']; ?></div></div></button>
        <script type="text/javascript">
        window.addEvent('domready', function()
        {
            if($('buttonm7')){
                $('buttonm7').addEvent('click', function ()
                {
                    window.fireEvent('buttonClicked', [this, {"type":"button","value":"Exchange resources","name":"","id":"button5487115a9b649","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"tid":"1","nr":"1","btyp":"1","r1":1,"r2":1,"r3":1,"r4":1,"supply":"1","pzeit":0,"max1":0,"max2":0,"max3":0,"max4":0,"max":0},"did":"<?=$village->wid;?>"}}}]);
                });
            }
        });
        </script>

</div>

    <?php
    //include("17_0.php");
}else{
    include("application/views/Build/".$village->resarray['f'.$_GET['id'].'t']."_".$_GET['t'].".php");
}


