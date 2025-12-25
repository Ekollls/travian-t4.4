<div id="contentOuterContainer" class="size1">
                                <div class="contentTitle">
                                                        </div>
                <div class="contentContainer">
                    <div id="content" class="activate">
                        <h1 class="titleInHeader"><?php echo $lang['Register']['27']; ?></h1><a id="backButton" class="contentTitleButton" href="activate.php?page=vid"></a>
<div class="activationScreen">
<?php echo $lang['Register']['28']; ?>
    <form method="post" action="activate.php?page=sector">

        <div id="presentation" class="sectors">

            <div id="activationMapContainer">

                <div id="map" class="">

                    <input type="radio" name="sector" value="nw" id="sector_nw">
                    <label for="sector_nw"><?php echo $lang['Register']['30']; ?></label>

                    <input type="radio" name="sector" value="no" id="sector_no">
                    <label for="sector_no"><?php echo $lang['Register']['29']; ?></label>

                    <input type="radio" name="sector" value="sw" id="sector_sw" checked="checked">
                    <label for="sector_sw" data-text="<?php echo $lang['Register']['SRECOMMENDED']; ?>"><?php echo $lang['Register']['32']; ?></label>

                    <input type="radio" name="sector" value="so" id="sector_so">
                    <label for="sector_so"><?php echo $lang['Register']['31']; ?></label>

                </div>

            </div>


        </div>

        <div class="buttonContainer">
            <button type="submit" value="<?php echo $lang['Register']['Confirm']; ?>" id="buttonGmBfOvFRA0upi" class="orange ">
                <div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?php echo $lang['Register']['Confirm']; ?></div>
                </div>
            </button>
            <script type="text/javascript" id="buttonGmBfOvFRA0upi_script">
                window.addEvent('domready', function() {
                    if($('buttonGmBfOvFRA0upi')) {
                        $('buttonGmBfOvFRA0upi').addEvent('click', function () {
                            window.fireEvent('buttonClicked', [this, {"type":"submit","value":"<?php echo $lang['Register']['Confirm']; ?>","name":"","id":"buttonGmBfOvFRA0upi","class":"orange ","title":"","confirm":"","onclick":""}]);
                        });
                    }
                });
            </script>

        </div>

    </form>
</div>                        <div class="clear"></div>
                    </div>
                    <div class="clear">&nbsp;</div>
                </div>
                <div class="contentFooter"></div>
            </div>