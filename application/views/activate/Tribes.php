<div id="contentOuterContainer" class="size1">
                                <div class="contentTitle">
                                                        </div>
                <div class="contentContainer">
                    <div id="content" class="activate">
                        <h1 class="titleInHeader"><?php echo $lang['Register']['00']; ?></h1><div class="activationScreen">
                        <?php echo $lang['Register']['01']; ?>
    <form method="post" action="">
        <div id="presentation">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 540 250">
                <filter id="inset" x="0" y="0">
                    <feGaussianBlur stdDeviation="20" result="blur"></feGaussianBlur>
                    <feComposite in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1" result="shadowDiff"></feComposite>
                    <feFlood flood-color="#bb8050"></feFlood>
                    <feComposite in2="shadowDiff" operator="in"></feComposite>
                    <feComposite in2="SourceGraphic" operator="over" result="firstfilter"></feComposite>
                    <feFlood flood-color="#bb8050"></feFlood>
                    <feComposite in2="shadowDiff" operator="in"></feComposite>
                    <feComposite in2="firstfilter" operator="over" result="secondfilter"></feComposite>
                    <feFlood flood-color="#bb8050"></feFlood>
                    <feComposite in2="shadowDiff" operator="in"></feComposite>
                    <feComposite in2="secondfilter" operator="over"></feComposite>
                </filter>
                <g class="descriptionBoxWithArrow">
                    <path class="outer" d="M10 10 V230 H63.20028200282003 l20 20 l20 -20 H530 V10 Z" data-original="M10 10 V230 H20 l20 20 l20 -20 H530 V10 Z"></path>
                    <path class="inner" filter="url(#inset)" d="M10 10 V230 H63.20028200282003 l20 20 l20 -20 H530 V10 Z" data-original="M10 10 V230 H20 l20 20 l20 -20 H530 V10 Z"></path>
                </g>
            </svg>

            <div id="tribeSelectors">
                <input type="radio" name="vid" value="3" id="tribe3" checked="checked">
                <label class="selector" for="tribe3"></label>
                <div class="tribeDescription" data-text="<?php echo $lang['Register']['Recommended']; ?>">
                    <h2><?php echo $lang['Register']['02']; ?></h2>
                    <ul>
                        <li><?php echo $lang['Register']['03']; ?></li>
                        <li><?php echo $lang['Register']['04']; ?></li>
                        <li><?php echo $lang['Register']['05']; ?></li>
                        <li><?php echo $lang['Register']['06']; ?></li>
                    </ul>
                </div>
                <input type="radio" name="vid" value="1" id="tribe1">
                <label class="selector" for="tribe1"></label>
                <div class="tribeDescription">
                    <h2><?php echo $lang['Register']['07']; ?></h2>
                    <ul>
                        <li><?php echo $lang['Register']['08']; ?></li>
                        <li><?php echo $lang['Register']['09']; ?></li>
                        <li><?php echo $lang['Register']['10']; ?></li>
                        <li><?php echo $lang['Register']['11']; ?></li>
                    </ul>
                </div>
                <input type="radio" name="vid" value="2" id="tribe2">
                <label class="selector" for="tribe2"></label>
                <div class="tribeDescription">
                    <h2><?php echo $lang['Register']['12']; ?></h2>
                    <ul>
                        <li><?php echo $lang['Register']['13']; ?></li>
                        <li><?php echo $lang['Register']['14']; ?></li>
                        <li><?php echo $lang['Register']['15']; ?></li>
                        <li><?php echo $lang['Register']['16']; ?></li>
                    </ul>
                </div>
                <?php if(TRI5BES): ?>
                    <input type="radio" name="vid" value="6" id="tribe6">
                    <label class="selector" for="tribe6" data-text="New"></label>
                    <div class="tribeDescription">
                        <h2><?php echo $lang['Register']['17']; ?></h2>
                        <ul>
                            <li><?php echo $lang['Register']['18']; ?></li>
                            <li><?php echo $lang['Register']['19']; ?></li>
                            <li><?php echo $lang['Register']['20']; ?></li>
                            <li><?php echo $lang['Register']['21']; ?></li>
                        </ul>
                    </div>
                    <!--- ADD NEW ICON --->
                    <input type="radio" name="vid" value="7" id="tribe7">
                    <label class="selector" for="tribe7" data-text="New"></label>
                    <div class="tribeDescription">
                        <h2><?php echo $lang['Register']['22']; ?></h2>
                        <ul>
                            <li><?php echo $lang['Register']['23']; ?></li>
                            <li><?php echo $lang['Register']['24']; ?></li>
                            <li><?php echo $lang['Register']['25']; ?></li>
                            <li><?php echo $lang['Register']['26']; ?></li>
                        </ul>
                    </div>
                <?php endif; ?>
                    <!--- ADD NEW ICON --->
                            </div>
        </div>
        <div class="buttonContainer">
            <button type="submit" value="<?php echo $lang['Register']['Confirm']; ?>" id="buttonEdtoC6b43XVyv" class="orange ">
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
            <script type="text/javascript" id="buttonEdtoC6b43XVyv_script">
                window.addEvent('domready', function() {
                    if($('buttonEdtoC6b43XVyv')) {
                        $('buttonEdtoC6b43XVyv').addEvent('click', function () {
                            window.fireEvent('buttonClicked', [this, {"type":"submit","value":"<?php echo $lang['Register']['Confirm']; ?>","name":"","id":"buttonEdtoC6b43XVyv","class":"orange ","title":"","confirm":"","onclick":""}]);
                        });
                    }
                });
            </script>
        </div>
    </form>
</div>

<script type="text/javascript">
    window.addEvent('domready', function() {
        new Travian.Game.Activation();
    });
</script>

<div id="tpixeliframe_loading" style="display: none; z-index: 1000; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; background-color: rgb(0, 0, 0); opacity: 0.4;"></div>
<script type="text/javascript">
    //<!--
    var tg_load_handler = function() {
        document.getElementById("tpixeliframe_loading").style.display = "none";
    };
    tg_load_handler.delay(1000);

    window.onload = function() {
        tg_iframe = document.getElementById("tpixeliframe");
        tg_iframe.onload = tg_load_handler;
    };
    document.getElementById("tpixeliframe_loading").style.display = "block";
    //-->
</script>                        <div class="clear"></div>
                    </div>
                    <div class="clear">&nbsp;</div>
                </div>
                <div class="contentFooter"></div>
            </div>