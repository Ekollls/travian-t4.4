
<?php 
$html = '<div id="smallestPackageDialog">
You don t have to in a From gold to use this feature!	<div id="smallestPackageData">
    <div class="package size1 hideForLoading">
        <input type="hidden" class="goldProductId" value="1">
        <div class="goldProductTextWrapper">
            <div class="goldUnits">'.$packages[0]['gold'].'</div>
            <div class="goldUnitsTypeText">gold</div>
            <div class="footerLine"><span class="price">'.$packages[0]['cost'].' '.$packages[0]['currency'].'&nbsp;*</span></div>
        </div>
        <div class="goldProductImageWrapper"><img src="img/product/'.$packages[0]['img'].'" width="100" height="114" alt="Package A"></div>
    </div>
</div>
<span class="buyGoldQuestion">Buy right now?</span>
<div>
    <button type="submit" value="Buy gold" id="buttontOphouP10TsMd" class="green " onclick="openPaymentWizard(true); return false;">
        <div class="button-container addHoverClick ">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content">Buy gold</div>
        </div>
    </button>
    <script type="text/javascript">
        window.addEvent(\'domready\', function () {
            if ($(\'buttontOphouP10TsMd\')) {
                $(\'buttontOphouP10TsMd\').addEvent(\'click\', function () {
                    window.fireEvent(\'buttonClicked\', [this, {
                        "type": "submit",
                        "value": "Purchase gold",
                        "name": "",
                        "id": "buttontOphouP10TsMd",
                        "class": "green ",
                        "title": "Buy gold",
                        "confirm": "",
                        "onclick": "openPaymentWizard(true); return false;"
                    }]);
                });
            }
        });
    </script>
</div>
<a class="changeGoldPackage arrow" href="#" onclick="openPaymentWizard(false); return false;">Choose another package</a>
<script>

    function openPaymentWizard(withPackage) {
        var options = {callback: \'openPaymentWizardWithProsTab\'};
        if (withPackage) {
            options = Object.merge(options, {goldProductId: \'7\'});
        }
        Travian.Game.WayOfPaymentEventListener.WayOfPaymentObject.openPaymentWizard(options);
    }
</script>
</div>';
echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"renderDialog","options":{"dialogOptions":{"infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=368#go2answer","saveOnUnload":false,"draggable":false,"buttonOk":false,"context":"smallestPackage"},"html":'.json_encode($html).'}}}}';
