<div class="boxes villageList production">
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
        <table id="production" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="4"> <?php echo PROD_HEADER; ?> </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="ico">
                
                    <div><?php echo $session->bonus1 ? '<img src="img/x.gif" class="productionBoost">' : ''; ?><i class="r1"></i></div>
                </td>
                <td class="res"><?php echo LUMBER; ?>:</td>
                <td class="num"><?php echo number_format($village->getProd("wood")); ?></td>
            </tr>
            <tr>
                <td class="ico">
                    <div><?php echo $session->bonus2 ? '<img src="img/x.gif" class="productionBoost">' : ''; ?><i class="r2"></i></div>
                </td>
                <td class="res"><?php echo CLAY; ?>:</td>
                <td class="num"><?php echo number_format($village->getProd("clay")); ?></td>
            </tr>
            <tr>
                <td class="ico">
                    <div><?php echo $session->bonus3 ? '<img src="img/x.gif" class="productionBoost">' : ''; ?><i class="r3"></i></div>
                </td>
                <td class="res"><?php echo IRON; ?>:</td>
                <td class="num"><?php echo number_format($village->getProd("iron")); ?></td>
            </tr>
            <tr>
                <td class="ico">
                    <div><?php echo $session->bonus4 ? '<img src="img/x.gif" class="productionBoost">' : ''; ?><i class="r4"></i></div>
                </td>
                <td class="res"><?php echo CROP; ?>:			</td>
                <td class="num"><?php echo number_format($village->getProd("crop")); ?>‏</td>
            </tr>
            </tbody>
        </table>
<button type="button" class="gold productionBoostButton" id="buttonP2gQFPKZoe3Fm"><div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">+25%</div></div></button>
<script type="text/javascript" id="buttonP2gQFPKZoe3Fm_script">
    window.addEvent('domready', function()
        {
        if($('buttonP2gQFPKZoe3Fm'))
        {
          $('buttonP2gQFPKZoe3Fm').addEvent('click', function ()
          {
            window.fireEvent('buttonClicked', [this, {"name":"","onclick":"","confirm":"","productionBoostDialog":{"infoIcon":"http:\/\/t4.answers.travian.ir\/index.php?aid=0#go2answer"},"title":"\u0645\u0632\u064a\u062f \u0645\u0646 \u0627\u0644\u0645\u0639\u0644\u0648\u0645\u0627\u062a \u0639\u0646 \u0632\u064a\u0627\u062f\u0629 \u0627\u0644\u0625\u0646\u062a\u0627\u062c","id":"buttonP2gQFPKZoe3Fm"}]);
          });
        }
        });
    </script>    </div>
</div>