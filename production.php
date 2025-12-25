<?php

include("application/Account.php");
if(!isset($_GET['t']) || !is_numeric($_GET['t']) || $_GET['t'] > 5){$_GET['t'] = 1;}
?>


<?php include("application/views/html.php");?>
<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE production <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> buildingsV1">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">

        <div id="header">
            <?php
            include("application/views/topheader.php");
            include("application/views/toolbar.php");
            ?>
        </div>
        <div id="center">


            <?php include("application/views/sideinfo.php"); ?>

            <div id="contentOuterContainer" class="size1">

                <?php include("application/views/res.php"); ?>
                <div class="contentTitle"><a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a></div>
                <div class="contentContainer">
                <div id="content" class="production">
                    <h1 class="titleInHeader">Overview On production</h1><div class="contentNavi subNavi ">
                    <div title="" class="container <?php echo $_GET['t'] == 1 ? 'active' : 'normal'; ?>">
                        <div class="background-start">&nbsp;</div>
                        <div class="background-end">&nbsp;</div>
                        <div class="content">

                            <a id="buttonz1" href="production.php?t=1" class="tabItem"><?php echo $lang['dorf']['D1']; ?></a>
                        </div>
                    </div>

                    <script type="text/javascript">
                        if (jQuery('#buttonz1')) {
                            jQuery('#buttonz1').click(function (event) {
                                jQuery(window).trigger('tabClicked', [this, {
                                    "class": "active",
                                    "title": false,
                                    "target": false,
                                    "id": "buttonz1",
                                    "href": "production.php?t=1",
                                    "onclick": false,
                                    "enabled": true,
                                    "text": "<?php echo $lang['dorf']['D1']; ?>",
                                    "dialog": false,
                                    "plusDialog": false,
                                    "goldclubDialog": false,
                                    "containerId": "",
                                    "buttonIdentifier": "buttonz1"
                                }]);

                            });
                        }
                    </script>

                    <div title="" class="container <?php echo $_GET['t'] == 2 ? 'active' : 'normal'; ?>">
                        <div class="background-start">&nbsp;</div>
                        <div class="background-end">&nbsp;</div>
                        <div class="content">

                            <a id="buttonQ2" href="production.php?t=2" class="tabItem"><?php echo $lang['dorf']['D2']; ?></a>
                        </div>
                    </div>

                    <script type="text/javascript">
                        if (jQuery('#buttonQ2')) {
                            jQuery('#buttonQ2').click(function (event) {
                                jQuery(window).trigger('tabClicked', [this, {
                                    "class": "normal",
                                    "title": false,
                                    "target": false,
                                    "id": "buttonQ2",
                                    "href": "production.php?t=2",
                                    "onclick": false,
                                    "enabled": true,
                                    "text": "<?php echo $lang['dorf']['D2']; ?>",
                                    "dialog": false,
                                    "plusDialog": false,
                                    "goldclubDialog": false,
                                    "containerId": "",
                                    "buttonIdentifier": "buttonQ2"
                                }]);

                            });
                        }
                    </script>

                    <div title="" class="container <?php echo $_GET['t'] == 3 ? 'active' : 'normal'; ?>">
                        <div class="background-start">&nbsp;</div>
                        <div class="background-end">&nbsp;</div>
                        <div class="content">

                            <a id="buttonv3" href="production.php?t=3" class="tabItem"><?php echo $lang['dorf']['D3']; ?></a>
                        </div>
                    </div>

                    <script type="text/javascript">
                        if (jQuery('#buttonv3')) {
                            jQuery('#buttonv3').click(function (event) {
                                jQuery(window).trigger('tabClicked', [this, {
                                    "class": "normal",
                                    "title": false,
                                    "target": false,
                                    "id": "buttonv3",
                                    "href": "production.php?t=3",
                                    "onclick": false,
                                    "enabled": true,
                                    "text": "<?php echo $lang['dorf']['D3']; ?>",
                                    "dialog": false,
                                    "plusDialog": false,
                                    "goldclubDialog": false,
                                    "containerId": "",
                                    "buttonIdentifier": "buttonv3"
                                }]);

                            });
                        }
                    </script>

                    <div title="" class="container <?php echo $_GET['t'] == 4 ? 'active' : 'normal'; ?>">
                        <div class="background-start">&nbsp;</div>
                        <div class="background-end">&nbsp;</div>
                        <div class="content">

                            <a id="buttonA4" href="production.php?t=4" class="tabItem"><?php echo $lang['dorf']['D4']; ?></a>
                        </div>
                    </div>

                    <script type="text/javascript">
                        if (jQuery('#buttonA4')) {
                            jQuery('#buttonA4').click(function (event) {
                                jQuery(window).trigger('tabClicked', [this, {
                                    "class": "normal",
                                    "title": false,
                                    "target": false,
                                    "id": "buttonA4",
                                    "href": "production.php?t=4",
                                    "onclick": false,
                                    "enabled": true,
                                    "text": "<?php echo $lang['dorf']['D4']; ?>",
                                    "dialog": false,
                                    "plusDialog": false,
                                    "goldclubDialog": false,
                                    "containerId": "",
                                    "buttonIdentifier": "buttonA4"
                                }]);

                            });
                        }
                    </script>

                    <div title="" class="container <?php echo $_GET['t'] == 5 ? 'active' : 'normal'; ?>">
                        <div class="background-start">&nbsp;</div>
                        <div class="background-end">&nbsp;</div>
                        <div class="content">

                            <a id="buttonW5" href="production.php?t=5" class="tabItem"><?php echo $lang['dorf']['D5']; ?></a>
                        </div>
                    </div>

                    <script type="text/javascript">
                        if (jQuery('#buttonW5')) {
                            jQuery('#buttonW5').click(function (event) {
                                jQuery(window).trigger('tabClicked', [this, {
                                    "class": "normal",
                                    "title": false,
                                    "target": false,
                                    "id": "buttonW5",
                                    "href": "production.php?t=5",
                                    "onclick": false,
                                    "enabled": true,
                                    "text": "<?php echo $lang['dorf']['D5']; ?>",
                                    "dialog": false,
                                    "plusDialog": false,
                                    "goldclubDialog": false,
                                    "containerId": "",
                                    "buttonIdentifier": "buttonW5"
                                }]);

                            });
                        }
                    </script>

                    <div class="clear"></div>
                </div>
                <?php if($_GET['t'] != 5){ ?>
                <div class="productionContainer">
                    <div class="productionPerHour">
                        <h4>Production hour:</h4>
                        <table cellspacing="1" cellpadding="1" class="row_table_data">
                            <thead>
                            <tr>
                                <td>Field Resources</td>
                                <td>Produce</td>
                                <td>Premium</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i=1;$i<=18;$i++) { 
                                if($session->fData['f'.$i.'t'] == $_GET['t']) {
                                    $zavod = $session->fData['f'.$i];
                                    $base+= ${'bid'.$_GET['t']}[$fdataarr[[$i]]]['prod'];
                                ?>
                            <tr>
                                <td>Woodcutter level <?php echo $session->fData['f'.$i]; ?></td>
                                <td class="numberCell"><?php echo $base /100 * (${'bid'.$_GET['t']}[$zavod]['attri']); ?></td>
                                <td class="numberCell">0</td>
                            </tr>
                            <?php }} ?>
                            <tr class="productionSum">
                                <td>total</td>
                                <td class="numberCell">105,000</td>
                                <td class="numberCell">0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="productionBoostSpeechBubble">
                        <div class="fluidSpeechBubble-container">
                            <div class="fluidSpeechBubble">
                                <div class="fluidSpeechBubble-tl"></div>
                                <div class="fluidSpeechBubble-tr"></div>
                                <div class="fluidSpeechBubble-tc"></div>
                                <div class="fluidSpeechBubble-ml"></div>
                                <div class="fluidSpeechBubble-mr"></div>
                                <div class="fluidSpeechBubble-mc"></div>
                                <div class="fluidSpeechBubble-bl"></div>
                                <div class="fluidSpeechBubble-br"></div>
                                <div class="fluidSpeechBubble-bc"></div>
                                <div class="speechArrowBack"></div>
                                <div class="fluidSpeechBubble-contents cf">
                                    <h5>Bonus                        :</h5>
                                    <table cellspacing="0" cellpadding="0" class="row_table_data">
                                        <tbody>
                                        <tr class="inactive">
                                            <td>Woodcutter level 0:</td>
                                            <td class="numberCell">0%&lrm;</td>
                                        </tr>                        <tr class="inactive">
                                            <td>واحات                                (×0)
                                            </td>
                                            <td class="numberCell">
                                                &lrm;0%&lrm;
                                            </td>
                                        </tr>
                                                                <tr>
                                            <td class="bold">جمع مكافآت</td>
                                            <td class="bold numberCell">0                                %&lrm;
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="total productionContainer">
                    <div class="productionPerHourTotal">
                        <h4>Total production in a hour            :</h4>
                        <table cellspacing="0" cellpadding="0" class="row_table_data">
                            <tbody>
                            <tr>
                                <td>إنتاج</td>
                                <td class="numberCell">105,000</td>
                            </tr>
                            <tr>
                                <td>علاوة</td>
                                <td class="numberCell">0</td>
                            </tr>
                            <tr>
                                <td>إنتاج Hero</td>
                                <td class="numberCell">120,000</td>
                            </tr>
                            <tr class="subtotal">
                                <td class="bold">رصد مؤقت                    =
                                </td>
                                                <td class="numberCell bold">225,000</td>
                            </tr>

                            <tr class="inactive">
                                <td>
                                    +25%&lrm; إنتاج    (غر نشط)</td>
                                <td class="numberCell">56,250</td>
                            </tr>
                            <tr class="total bold">
                                <td class="bold">total</td>
                                <td class="numberCell bold">225,000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="productionBoostResourceSpeechBubble">
                        <div class="fluidSpeechBubble-container">
                            <div class="fluidSpeechBubble">
                                <div class="fluidSpeechBubble-tl"></div>
                                <div class="fluidSpeechBubble-tr"></div>
                                <div class="fluidSpeechBubble-tc"></div>
                                <div class="fluidSpeechBubble-ml"></div>
                                <div class="fluidSpeechBubble-mr"></div>
                                <div class="fluidSpeechBubble-mc"></div>
                                <div class="fluidSpeechBubble-bl"></div>
                                <div class="fluidSpeechBubble-br"></div>
                                <div class="fluidSpeechBubble-bc"></div>
                                <div class="speechArrowBack"></div>
                                <div class="fluidSpeechBubble-contents cf">
                                    <form id="fluidSpeechBubble" method="post" action="">
                                        <p>إنتاج hour بما in a ذلك Bonus                            : <span class="bold">281,250</span>
                                        </p>

                                        <div>
                                            <button type="button" class="gold  productionBoostButton wood" coins="50" id="buttonn6" onclick=""><div class="button-container addHoverClick">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-content">فعل<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">50</span></div></div></button>
                    <script type="text/javascript" id="buttonn6_script">
                    jQuery(function()
                        {
                        jQuery('#buttonn6').click(function (event)
                        {
                            jQuery(window).trigger('buttonClicked', [this, {"type":"button","value":"\u0641\u0639\u0644","confirm":"","onclick":"","wayOfPayment":{"featureKey":"productionboostWood","context":"production"},"title":"\u062a\u0641\u0639\u064a\u0644 \u0627\u0644\u0622\u0646 &lt;br&gt; \u0645\u062f\u0629 \u0627\u0644\u0632\u064a\u0627\u062f\u0629 \u0623\u064a\u0627\u0645 &lt;span class=&quot;bold&quot;&gt;4&lt;\/span&gt; \u0627\u064a\u0627\u0645","coins":50,"id":"buttonn6"}]);
                        });
                        });
                    </script>                        </div>
                                        <div class="productionBoostSpeechBubbleFurtherInfo">
                                            <p>تزد علاوة إنتاج From إنتاج مورد <span class="underlined">لكل</span> قراكم.</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="clear"></div>
            <?php }else{  ?>
            <div class="cropBalanceContainer">
                <div class="productionBoostSpeechBubble">
                <div class="productionBoostResourceSpeechBubble">
                    <div class="fluidSpeechBubble-container">
                        <div class="fluidSpeechBubble">
                            <div class="fluidSpeechBubble-tl"></div>
                            <div class="fluidSpeechBubble-tr"></div>
                            <div class="fluidSpeechBubble-tc"></div>
                            <div class="fluidSpeechBubble-ml"></div>
                            <div class="fluidSpeechBubble-mr"></div>
                            <div class="fluidSpeechBubble-mc"></div>
                            <div class="fluidSpeechBubble-bl"></div>
                            <div class="fluidSpeechBubble-br"></div>
                            <div class="fluidSpeechBubble-bc"></div>
                            <div class="speechArrowBack"></div>
                            <div class="fluidSpeechBubble-contents cf">
                                <form id="fluidSpeechBubble" method="post" action="">
                                <p>إنتاج hour بما in a ذلك Bonus: <span class="bold">316,198</span></p>

                <div>
                <button type="button" class="gold  productionBoostButton crop" coins="50" id="buttonU6" onclick=""><div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content">فعل<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">50</span></div></div></button>
            <script type="text/javascript" id="buttonU6_script">
            jQuery(function()
                {
                jQuery('#buttonU6').click(function (event)
                {
                    jQuery(window).trigger('buttonClicked', [this, {"type":"button","value":"\u0641\u0639\u0644","confirm":"","onclick":"","wayOfPayment":{"featureKey":"productionboostCrop","context":"production"},"title":"\u062a\u0641\u0639\u064a\u0644 \u0627\u0644\u0622\u0646 &lt;br&gt; \u0645\u062f\u0629 \u0627\u0644\u0632\u064a\u0627\u062f\u0629 \u0623\u064a\u0627\u0645 &lt;span class=&quot;bold&quot;&gt;4&lt;\/span&gt; \u0627\u064a\u0627\u0645","coins":50,"id":"buttonU6"}]);
                });
                });
            </script>                            </div>
                                    <div class="productionBoostSpeechBubbleFurtherInfo">
                                        <p>Production Bonus Increases From Supplier Production <span class="underlined">All</span> your villages.</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="balanceCropBalancePart">
                <table cellspacing="0" cellpadding="0" class="row_table_data">
                    <tbody>
                    <tr>
                        <td>Production of buildings and oases</td>
                        <td class="numberCell">133,000</td>
                    </tr>
                    <tr>
                        <td>Population and Building orders</td>
                        <td class="numberCell">-54                    &lrm;
                        </td>
                    </tr>
                    <tr class="subtotal">
                        <td class="bold">Wheat crops</td>
                        <td class="bold numberCell">132,946</td>
                    </tr>
                    <tr>
                        <td>Incomplete Building Commands</td>
                        <td class="numberCell">0</td>
                    </tr>
                    <tr>
                        <td>Production Hero</td>
                        <td class="numberCell">120,006</td>
                    </tr>
                    <tr class="inactive">
                        <td>
                            +25%&lrm;Production (passif)</td>
                        <td class="numberCell">63,252</td>
                    </tr>
                    <tr class="subtotal">
                        <td class="bold">Temporary balance =
                        </td>
                        <td class="numberCell bold">252,952</td>
                    </tr>
                    </tbody>
                </table>
            </div>
                <div class="balanceCropBalancePart balanceTroops">
                <div class="boxes boxesColor gray">
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
                        <div class="switchDown  " id="ownBalanceTroops">
                            <div class="switchDownCloseStateContainer ">
                                <div class="switchClosed headline">consumption Forces Own</div>
                                <div class="switchDownContent">
                                    <span class="bold">-6&lrm;</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="switchDownOpenStateContainer hide">
                                <div class="switchOpened headline">consumption Forces Own</div>
                                <div class="clear"></div>
                                <div class="switchDownContent">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="troopLabel">
                                                - in the village</td>
                                            <td class="numberCell">-6&lrm;</td>
                                        </tr>
                                        <tr>
                                            <td class="troopLabel">
                                                - in a oasis or reinforcements</td>
                                            <td class="numberCell">0&lrm;</td>
                                        </tr>
                                        <tr>
                                            <td class="troopLabel">
                                                - عل road</td>
                                            <td class="numberCell">0&lrm;</td>
                                        </tr>
                                        <tr>
                                            <td class="troopLabel">
                                                - مأسور</td>
                                            <td class="numberCell">0                                        &lrm;
                                            </td>
                                        </tr>
                                        <tr class=" inactive">
                                            <td class="troopLabel">مكافأة قطع أثرة</td>
                                            <td class="numberCell">0</td>
                                        </tr>
                                                                                                        <tr class="subtotal">
                                            <td class="bold">total</td>
                                            <td class="numberCell bold">-6</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            jQuery(function () {
                                new Travian.Game.SwitchDown('#ownBalanceTroops');
                            });
                        </script>
                    </div>
                </div>
            </div>
                <div class="balanceCropBalancePart balanceTroops">
                <div class="boxes boxesColor gray">
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
                        <div class="switchDown  " id="foraignBalanceTroops">
                            <div class="switchDownCloseStateContainer ">
                                <div class="switchClosed headline">استهلاك Forces معززة</div>
                                <div class="switchDownContent">
                                    <span class="bold">0&lrm;</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="switchDownOpenStateContainer hide">
                                <div class="switchOpened headline">استهلاك Forces معززة</div>
                                <div class="clear"></div>
                                <div class="switchDownContent">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="troopLabel">
                                                - in a village</td>
                                            <td class="numberCell">0</td>
                                        </tr>
                                        <tr>
                                            <td class="troopLabel">
                                                - in a واحة أو reinforcementات From قرى Own</td>
                                            <td class="numberCell">0</td>
                                        </tr>
                                        <tr class=" inactive">
                                            <td class="troopLabel">مكافأة قطع أثرة</td>
                                            <td class="numberCell">0</td>
                                        </tr>
                                                                                                        <tr class="subtotal">
                                            <td class="bold">total</td>
                                            <td class="numberCell bold">0</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            jQuery(function () {
                                new Travian.Game.SwitchDown('#foraignBalanceTroops');
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="balanceCropBalancePart">
                <table cellspacing="0" cellpadding="0" class="row_table_data">
                    <tbody>
                    <tr class="total">
                        <td class="bold">إحتاط crop                    =
                        </td>
                        <td class="bold numberCell">252,946</td>
                    </tr>
                    </tbody>
                </table>
            </div>
                <div class="clear"></div>
            </div>
            <?php } ?>

                                    </div>
                                    
    <div class="clear"></div>


                </div>
                <div class="contentFooter">&nbsp;</div>

            </div>
            <?php
            include("application/views/rightsideinfor.php");
            ?>
            <div class="clear"></div>
        </div>
        <?php

        include("application/views/header.php");
        ?>
    </div>
    <div id="ce"></div>
</div>
</body>
</html>
<?php 

?>