<?php
if(isset($_GET['abort']) && !is_numeric($_GET['abort'])) die('Hacking Attemp');
if(isset($_POST['maxBid']) && !is_numeric($_POST['maxBid'])) die('Hacking Attemp');
if(isset($_GET['a']) && !is_numeric($_GET['a'])) die('Hacking Attemp');
if(isset($_POST['amount']) && !is_numeric($_POST['amount'])) die('Hacking Attemp');
if(isset($_POST['id']) && !is_numeric($_POST['id'])) die('Hacking Attemp');
if(isset($_POST['maxBid'])){$_POST['maxBid']=preg_replace("/[^0-9]/", "", $_POST['maxBid']);}
if(isset($_POST['amount'])){$_POST['amount']=preg_replace("/[^0-9]/", "", $_POST['amount']);}
if(isset($_POST['id'])){$_POST['id']=preg_replace("/[^0-9]/", "", $_POST['id']);}
include("application/Account.php");

if(isset($_POST['gold']) || isset($_POST['silver'])){
    $_POST['gold'] = preg_replace("/[^0-9]/", "", $_POST['gold']);
    $_POST['silver'] = preg_replace("/[^0-9]/", "", $_POST['silver']);


    if(!isset($_POST['gold']) || empty($_POST['gold'])){$_POST['gold']=0;}
    if(!isset($_POST['silver']) || empty($_POST['silver'])){$_POST['silver']=0;}
    // if(isset($_POST['gold']) && !is_numeric($_POST['gold']) || isset($_POST['silver']) && !is_numeric($_POST['gold'])){die("Ошибка прост))");}
    $gold = $_POST['gold'];
    $silver = $_POST['silver'];
//print_r($_POST);

    $uid = $session->uid;

    if($gold>=1 && $session->gold>=$gold){
        $silvers = "+ ".$gold*100;
        $golds = "- ".$gold;
        $session->gold-=$gold;
        $session->silver+=$gold*100;
        $yep=1;
    }
    if($yep){
        $database->query("UPDATE users SET gold = gold ".$golds.", silver = silver ".$silvers."  WHERE id = '".$uid."'");}



}
$database->auctionComplete();

$Afinished[0]['finished'] =0;
foreach($session->vvillages as $v){
    $q = $database->query("SELECT * FROM movement WHERE `proc`='1' and sort_type = 9 and `from`='".$v['wref']."'");
    foreach($q as $qq){
        $Afinished[0]['finished']++;
        echo $qq['id'];
    }
}
?>


<?php include("application/views/html.php");?>
<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE hero_auction <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> buildingsV1">
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


            <?php include("application/views/sideinfo.php");  ?>

            <div id="contentOuterContainer" class="size1">

                <?php include("application/views/res.php"); ?>
                <div class="contentTitle"><a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a></div>
                <div class="contentContainer">
                    <div id="content" class="hero_auction"><h1 class="titleInHeader"><?php echo U0; ?></h1>
<?php if($session->deleting){
    echo $lang['Errors']['Error01'];
}else{
 ?>
        <div class="contentNavi subNavi">
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_inventory.php" class="tabItem"><?=herohero0?></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero.php" class="tabItem"><?=herohero1?></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_adventure.php" class="tabItem"><?=herohero2?></a></div>
				</div>
				<div class="container active">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php" class="tabItem"><?=herohero3?></a></div>
				</div><div class="clear"></div>
		</div><script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>

<?php
/*
switch(SPEED){
    case SPEED<=10:
        $needadv=10;
        break;
    case SPEED<=50:
        $needadv=20;
        break;
    case SPEED<=100:
        $needadv=30;
        break;
    case SPEED>100:
        $needadv=50;
        break;
}*/
//$Afinished[0]['finished']=60;
$needadv = 10;
if($Afinished[0]['finished']>=$needadv){
    ?>
    <form method="post" action="hero_auction.php">
                    <div class="boxes boxesColor gray silverExchange">
    <div class="boxes-tl"></div>
    <div class="boxes-tr"></div>
    <div class="boxes-tc"></div>
    <div class="boxes-ml"></div>
    <div class="boxes-mr"></div>
    <div class="boxes-mc"></div>
    <div class="boxes-bl"></div>
    <div class="boxes-br"></div>
    <div class="boxes-bc"></div>
    <div class="boxes-contents cf"><div id="silverExchange" class="silverExchange">
        <h4><?=exchange0?></h4>
        <div class="exchangeLine">

                <div class="directionButtons">
                    <button class="directionButton GoldToSilver active"><img src="img/x.gif" class="gold" alt="Золото"><img src="img/x.gif" class="arrow" alt=""><img src="img/x.gif" class="silver" alt="Серебро"></button>
                    <button class="directionButton SilverToGold"><img src="img/x.gif" class="silver" alt="Серебро"><img src="img/x.gif" class="arrow" alt=""><img src="img/x.gif" class="gold" alt="Золото"></button>
                </div>
                <div class="exchangeTypeGoldToSilver exchangeType active">
                    <button type="submit" value="GoldToSilver" id="button544ba9ec29b7f" class="gold " coins="1">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content"><?=exchange1?><img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1</span></div>
                        </div>
                    </button>


                    <div class="exchangeItem formularDirection<?php echo DIRECTION; ?>">
                        <span class="silverExchangeFormularTerm"><img src="img/x.gif" class="gold" alt="Золото"></span>
                        <span class="silverExchangeFormularTerm"><input id="exchangeGoldToSilverInput" class="goldInput text" name="gold" value="1" type="text"></span>
                        <span class="silverExchangeFormularTerm">×</span>
                        <span class="silverExchangeFormularTerm">100</span>
                        <span class="silverExchangeFormularTerm">=</span>
                        <span class="silverExchangeFormularTerm resultTerm"><img src="img/x.gif" class="silver" alt="Серебро"><span class="silverResult">100</span></span>
                    </div>

                </div>
                <div class="exchangeTypeSilverToGold exchangeType">
                    <button type="submit" value="SilverToGold" id="button544ba9ec29ca8" class="green ">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content"><?=exchange1?></div>
                        </div>
                    </button>


                    <div class="exchangeItem formularDirection formularDirection<?php echo DIRECTION; ?>">
                        <span class="silverExchangeFormularTerm"><img src="img/x.gif" class="silver" alt="silver"></span>
                        <span class="silverExchangeFormularTerm"><input id="exchangeSilverToGoldInput" class="silverInput text" name="silver" value="200" type="text"></span>
                        <span class="silverExchangeFormularTerm">÷</span>
                        <span class="silverExchangeFormularTerm">200</span>
                        <span class="silverExchangeFormularTerm">=</span>
                        <span class="silverExchangeFormularTerm resultTerm"><img src="img/x.gif" class="gold" alt="gold"><span class="goldResult">1</span></span>
                    </div>

                </div>

            </form>
        </div>
        <div class="clear"></div>
        <div class="exchangeMessageLine">
            &nbsp;	</div>
    </div>

    <script type="text/javascript">
        function getExchangeCoins()
        {
            var input = $('exchangeGoldToSilverInput');
            var gold = 0;
            if(typeof input.get('value') !== 'undefined')
            {
                gold = parseInt(input.get('value'));
            }
            if (gold == 0)
            {
                return false;
            }
            return {coins: gold};
        }

        // check if pasted text is an integer and update exchangeValue, otherwise discard it
        function checkGoldSilverPaste(e, inputElement, exchange)
        {
            var pastedText = undefined;
            if (window.clipboardData && window.clipboardData.getData) { // IE
                pastedText = window.clipboardData.getData('Text');
            } else if (e.clipboardData && e.clipboardData.getData) {
                pastedText = e.clipboardData.getData('text/plain');
            }

            if(!isNaN(pastedText) && (parseInt(pastedText) == pastedText))
            {
                // update exchange gold value on submit button
                exchange.updateExchangeValue(parseInt(inputElement.value + '' + pastedText));
            }
        }

        $$('#silverExchange form').addEvent('submit', function(e){
            e.stop();
        });

        window.addEvent('domready', function()
        {

            var goldToSilverExchange = new Travian.Game.Hero.SilverExchange(
                {
                    exchangeOptions:
                    {
                        directionType: 'GoldToSilver',
                        showExchangeTypeElement: $$('#silverExchange .directionButtons .GoldToSilver')[0],
                        inputElement: $$('#silverExchange .exchangeTypeGoldToSilver input')[0],
                        resultValueElements:
                            [
                                {
                                    setType:'html',
                                    element: $$('#silverExchange .exchangeTypeGoldToSilver .silverResult')[0]
                                }
                            ],
                        inputValueElements:
                            [
                                {
                                    setType:'html',
                                    element: $$('#silverExchange .exchangeTypeGoldToSilver button.gold .goldValue')[0]
                                },
                                {
                                    setType:'coins',
                                    element: $$('#silverExchange .exchangeTypeGoldToSilver button.gold')[0]
                                }
                            ],
                        baseMultiplier: 100,
                        maxAmount: <?=$session->gold?>,
                        submitButton: $$('#silverExchange .exchangeTypeGoldToSilver button.gold')[0],
                        handleMaxFunction: function(targetValue)
                        {
                            this.showMessageByKey('notEnoughGold');
                            return targetValue;
                        }
                    },
                    messages :
                    {
                        notEnoughGold:
                        {
                            type : 'error', message:"<?=exchange2?>"
                        },
                        autoCorrect:
                        {
                            type : 'notice', message:"<?=exchange3?>"
                        },
                        disabledSubmitTooltip:
                        {
                            type : 'tooltip', message:"<?=exchange4?>"
                        },
                        enabledSubmitTooltip:
                        {
                            type : 'tooltip', message:"<?=exchange5?>"
                        },
                        maxAmountTooltip:
                        {
                            type : 'tooltip', message:"<?=exchange6?>"
                        }
                    }
                });

            var silverToGoldExchange = new Travian.Game.Hero.SilverExchange(
                {
                    exchangeOptions:
                    {
                        directionType: 'SilverToGold',
                        showExchangeTypeElement:$$('#silverExchange .directionButtons .SilverToGold')[0],
                        inputElement:$$('#silverExchange .exchangeTypeSilverToGold input')[0],
                        resultValueElements:
                            [
                                {
                                    setType:'html',
                                    element: $$('#silverExchange .exchangeTypeSilverToGold .goldResult')[0]
                                }
                            ],
                        baseMultiplier:0.005,
                        maxAmount:<?=$session->silver?>,
                        submitButton: $$('#silverExchange .exchangeTypeSilverToGold button.green')[0],
                        submitButtonClickListener: null,
                        handleMaxFunction: function(targetValue)
                        {
                            targetValue = this.options.exchangeOptions.maxAmount;
                            this.options.exchangeOptions.inputElement.set('value', targetValue);
                            this.showMessageByKey('autoCorrect');
                            return targetValue;
                        }
                    },

                    messages :
                    {
                        notEnoughGold:
                        {
                            type : 'error',
                            message:"<?=exchange2?>"
                        },
                        autoCorrect:
                        {
                            type : 'notice',
                            message:"<?=exchange3?>"
                        },
                        disabledSubmitTooltip:
                        {
                            type : 'tooltip',
                            message:"<?=exchange7?>"
                        },
                        enabledSubmitTooltip:
                        {
                            type : 'tooltip',
                            message:"<?=exchange8?>"
                        }
                    }
                });

            silverToGoldExchange.addEvent(
                'changeMaxAmounts',
                function(eventData)
                {
                    goldToSilverExchange.setMaxAmounts(eventData);
                });

            window.showFinishedExchangeGoldToSilver = function(options, context)
            {
                if (options.message)
                {
                    goldToSilverExchange.showMessage(options.message);
                }
                goldToSilverExchange.overrideGoldAndSilver(options.oldGold, options.oldSilver, options.newGold, options.newSilver);
                silverToGoldExchange.setMaxAmounts(options);
            }

            // check paste value
            $$('#silverExchange .exchangeTypeGoldToSilver input')[0].onpaste = function(e) {
                checkGoldSilverPaste(e, this, goldToSilverExchange);
                return false; // Prevent the default handler from running.
            };

            // check paste value
            $$('#silverExchange .exchangeTypeSilverToGold input')[0].onpaste = function(e) {
                checkGoldSilverPaste(e, this, silverToGoldExchange);
                return false; // Prevent the default handler from running.
            };

            // nach dem alle listener korrekt gesetzt wurden einmal den Input wert aktualisieren.
            goldToSilverExchange.updateExchangeValue(1);

        });
    </script>
    </div>
</div>

    <?php
if($_GET['action']=='sell' && $_GET['abort']){
	$database->delAuction($_GET['abort']);

}

if($_GET['action']=='sell' && $_POST['a']=='e45'){
    $sql = $database->query("SELECT id FROM auction WHERE `finish` = '0' and owner = '".$session->uid."'");
    $query = count($sql);
	if($query < 5){
		$data = $database->getItemData($_POST['id']);
        if($session->uid!=$data['uid']){ echo "пахнет чем-то хакерским"; exit;}
        if($data['num']<$_POST['amount'] && $_POST['amount']<=0 ){ exit;}
        if($data['proc']==0){
        $itemid = $_POST['id'];
        if($data['num']==1 || ($data['num']-$data['type'])==$_POST['amount']){
            $database->query("DELETE FROM heroitems WHERE `id`='".$data['id']."'");

        }
        if($data['num']==1 || ($data['num']-$data['type'])>=$_POST['amount']){
            // quest
            if($session->qArrayB1[0] == 9 && $session->qArrayB1[1] == 0){
                $database->query("UPDATE quests SET battle1='9,1' WHERE userid = ".$session->uid."");
            }
		    $database->addAuction($session->uid, $itemid, $data['btype'], $data['type'], $_POST['amount']);
	    }
    }
    }
}

if(isset($_POST['a']) && $_POST['action']=='buy' || isset($_POST['a']) && $_POST['action']=='bids'){
$bidError = '';
$getBidData = $database->getBidData($_POST['a']);
    if($getBidData['newsilver']==0){
        $getBidData['newsilver']=$getBidData['silver'];
    }
$total_silver = $getBidData['newsilver'] + $session->silver;
	if($_POST['maxBid'] <= $getBidData['newsilver']){
		$bidError .= "Too low bid. You need to offer at least ".($getBidData['newsilver']+1)." silver.";
	}elseif($_POST['maxBid'] > $session->silver || ($_POST['uid'] == $session->uid && $_POST['maxBid'] > $total_silver)){
		$bidError .= "You haven't enough silver for this bid.";
	}else{
		if($database->checkBid($_POST['a'], $_POST['maxBid'])){ //точно хinатит ли серы на покупку
            if($getBidData['uid']!=0){
                $database->setSilver($getBidData['uid'],$getBidData['newsilver'],1);
            }
				$database->setSilver($session->uid,$_POST['maxBid'],0);
				$database->addBid($_POST['a'], $session->uid, $_POST['maxBid']);
				$database->setNewSilver($_POST['a'],$_POST['maxBid']);

			if(isset($_POST['page'])){ $page = "&page=".$_POST['page']; }else{ $page = ""; }
            if($_POST['action']=='bids'){ $ssss = 'bids'; } elseif($_POST['action']=='buy'){ $ssss = 'buy'; }
            
            // quest
            if($session->qArrayB1[0] == 9 && $session->qArrayB1[1] == 0){
                $database->query("UPDATE quests SET battle1='9,1' WHERE userid = ".$session->uid."");
            }
            
			header("Location: ?action=".$ssss."".$page."&a=".$_POST['a']);
		}else{
				$bidError .= "Your bid is lower than the other player's one.";

			if(isset($_POST['page'])){ $page = "&page=".$_POST['page']; }else{ $page = ""; }
			if($_POST['action']=='bids'){ $ssss = 'bids'; } elseif($_POST['action']=='buy'){ $ssss = 'buy'; }
			header("Location: ?action=".$ssss."".$page."&a=".$_POST['a']);
		}
	}
	
}
include("application/views/Auction/menu.php");

}else{
    include("application/views/Auction/menu.php");

    ?>
                        <div id="auction">
                            <div class="auctionAdventureBarText">
                                <?php echo $lang['Errors']['Error02']; ?>
                            </div>
                            <div class="auctionAdventureBarNumbers">
                                (<?=$Afinished[0]['finished']."/".$needadv?> )
                            </div>
                            <div class="clear"></div>
                            <div class="auctionAdventureBar">
                                <div class="bar" style="width:<?=min(array(($Afinished[0]['finished']/$needadv*100),100))?>%;"></div>
                            </div>
</div>
                        <?php
}
if(isset($_GET['action'])){
	if($_GET['action'] == 'buy'){
		include("application/views/Auction/buy.php");
	} elseif($_GET['action'] == 'sell'){
		include("application/views/Auction/sell.php");
	} elseif($_GET['action'] == 'bids'){
		include("application/views/Auction/bids.php");
	}
} else {
		include("application/views/Auction/buy.php");
	}

}
?>

                        <div class="clear">&nbsp;</div>
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

