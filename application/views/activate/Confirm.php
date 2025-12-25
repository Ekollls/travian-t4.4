<div id="contentOuterContainer" class="size1">
                                <div class="contentTitle">
                                                        </div>
                <div class="contentContainer">
                    <div id="content" class="activate">
                        <h1 class="titleInHeader"><?php echo $lang['Register']['33']; ?></h1>
                        <a id="backButton" class="contentTitleButton" href="activate.php?page=sector"></a>
<div class="activationScreen">
    <form method="post" action="activate.php?page=confirmation">
        <div id="presentation" class="confirmation">
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
                    <path class="outer" d="M10 10 V310 H530 V10 Z"></path>
                    <path class="inner" filter="url(#inset)" d="M10 10 V310 H530 V10 Z"></path>
                </g>
            </svg>
            <div id="activationMapContainer">
                <div id="map" class="">
                    <input type="radio" name="sector" value="nw" id="sector_nw" disabled="disabled"<?php if($_SESSION['sector'] == 'nw'){ echo ' checked="checked"';} ?>>
                    <label for="sector_nw"><?php echo $lang['Register']['30']; ?></label>
                    <input type="radio" name="sector" value="no" id="sector_no" disabled="disabled"<?php if($_SESSION['sector'] == 'no'){ echo ' checked="checked"';} ?>>
                    <label for="sector_no"><?php echo $lang['Register']['29']; ?></label>
                    <input type="radio" name="sector" value="sw" id="sector_sw" disabled="disabled"<?php if($_SESSION['sector'] == 'sw'){ echo ' checked="checked"';} ?>>
                    <label for="sector_sw"><?php echo $lang['Register']['32']; ?></label>
                    <input type="radio" name="sector" value="so" id="sector_so" disabled="disabled"<?php if($_SESSION['sector'] == 'so'){ echo ' checked="checked"';} ?>>
                    <label for="sector_so"><?php echo $lang['Register']['31']; ?></label>
                </div>
            </div>
            <div id="selectedTribe" class="tribe<?php echo $_SESSION['vid']; ?>">
                <input type="hidden" name="vid" value="<?php echo $_SESSION['vid']; ?>">
                <div class="character"></div>
                <h2 class="tribeName"><?php echo constant('TRIBE'.$_SESSION['vid']); ?></h2>
            </div>
        </div>
        <div class="acceptChallenge">
        <?php echo $lang['Register']['34']; ?>
        </div>
        <div class="buttonContainer">
            <button type="submit" value="<?php echo $lang['Register']['PlayNow']; ?>" id="buttonpM9itmXZJoXun" class="green ">
                <div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?php echo $lang['Register']['PlayNow']; ?></div>
                </div>
            </button>
            <script type="text/javascript" id="buttonpM9itmXZJoXun_script">
                window.addEvent('domready', function() {
                    if($('buttonpM9itmXZJoXun')) {
                        $('buttonpM9itmXZJoXun').addEvent('click', function () {
                            window.fireEvent('buttonClicked', [this, {"type":"submit","value":"<?php echo $lang['Register']['PlayNow']; ?>","name":"","id":"buttonpM9itmXZJoXun","class":"green ","title":"","confirm":"","onclick":""}]);
                        });
                    }
                });
            </script>
            <div id="sparkles">
                <div class="sparkles1"></div>
                <div class="sparkles2"></div>
                <div class="sparkles3"></div>
                <div class="sparkles4"></div>
                <div class="sparkles5"></div>
                <div class="sparkles6"></div>
            </div>
        </div>
    </form>
</div>                        <div class="clear"></div>
                    </div>
                    <div class="clear">&nbsp;</div>
                </div>
                <div class="contentFooter"></div>
            </div>