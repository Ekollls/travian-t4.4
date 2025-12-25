<script language="JavaScript">
    var haendler = <?php echo $market->merchantAvail(); ?>;
    var carry = <?php echo $market->maxcarry; ?>;
</script>
<div class="boxes boxesColor gray traderCount"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><?=MERCHANTS?>   <?php echo $market->merchantAvail(); ?> / <?php echo $market->merchant; ?></div>
</div><div class="clear"></div>
<?php
$checkexist=false;
if(isset($_POST['x']) && $_POST['x']!="" && $_POST['y']!="" && is_numeric($_POST['x']) && is_numeric($_POST['y'])){
    $allres = $_POST['r1']+$_POST['r2']+$_POST['r3']+$_POST['r4'];
	$getwref = $database->getBaseID($_POST['x'],$_POST['y']);
	$checkexist = $database->checkVilExist($getwref);
}

if($checkexist){
$villageOwner = $database->getVillageField($getwref,'owner');
$userAccess = $database->getUserField($villageOwner,'access',0);
}
$maxcarry = $market->maxcarry;
$maxcarry *= $market->merchantAvail();

if(isset($_POST['ft'])=='check' && $allres!=0 && $allres <= $maxcarry && $_POST['x']!="" && $_POST['y']!="" && $checkexist && $session->right['s3']){
?>
<form method="POST" name="snd" action="build.php?id=<?php echo $id; ?>&t=5">
    <input type="hidden" name="ft" value="mk1">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="send3" value="<?php echo $_POST['send3']; ?>">
    <table id="send_select" class="send_res" cellpadding="1" cellspacing="1">
    <tr>
    <td class="ico"><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /></td>
<td class="nam"> <?=TVRN12?></td>
<td class="val"><input class="text disabled" type="text" name="r1" id="r1" value="<?php echo $_POST['r1']; ?>" readonly="readonly"></td>
<td class="max"> / <span class="none"><B><?php echo $market->maxcarry; ?></B></span> </td>
</tr>
    <tr>
<td class="ico"><img class="r2" src="img/x.gif" alt="Clay" title="Clay" /></td>
<td class="nam"> <?=TVRN13?></td>
<td class="val"><input class="text disabled" type="text" name="r2" id="r2" value="<?php echo $_POST['r2']; ?>" readonly="readonly"></td>
<td class="max"> / <span class="none"><b><?php echo$market->maxcarry; ?></b></span> </td>
</tr>
    <tr>
<td class="ico"><img class="r3" src="img/x.gif" alt="Iron" title="Iron" /></td>
<td class="nam"> <?=TVRN14?></td>
<td class="val"><input class="text disabled" type="text" name="r3" id="r3" value="<?php echo $_POST['r3']; ?>" readonly="readonly">
    </td>
<td class="max"> / <span class="none"><b><?php echo $market->maxcarry; ?></b></span> </td>
</tr>
    <tr>
<td class="ico"><img class="r4" src="img/x.gif" alt="Crop" title="Crop" /></td>
<td class="nam"> <?=TVRN15?></td>
<td class="val"> <input class="text disabled" type="text" name="r4" id="r4" value="<?php echo $_POST['r4']; ?>" readonly="readonly">
    </td>
<td class="max"> / <span class="none"><B><?php echo $market->maxcarry; ?></B></span></td>
</tr>
        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>
    </table>
<table id="target_validate" class="res_target" cellpadding="1" cellspacing="1">
    <tbody><tr>
    <th><?=TVRN5?>:</th>
    <?php
    if($_POST['x']!="" && $_POST['y']!="" && is_numeric($_POST['x']) && is_numeric($_POST['y'])){
    $getwref = $database->getBaseID($_POST['x'],$_POST['y']);
    $getvilname = $database->getVillageField($getwref, "name");
    $getvilowner = $database->getVillageField($getwref, "owner");
    $getvilcoor['y'] = $_POST['y'];
    $getvilcoor['x'] = $_POST['x'];
    $time = $database->procDistanceTime($getvilcoor,$village->coor,$session->tribe,0,$village->wid);
    }


    ?>
        <td class="vil"><a href="karte.php?d=<?php echo $getwref; ?>&c=<?php echo $generator->getMapCheck($getwref); ?>"><?php echo $getvilname; ?>(<?php echo $getvilcoor['x']; ?>|<?php echo $getvilcoor['y']; ?>)<span class="clear"></span></a></td>
</tr>
    <tr>
    <th><?=OVERVIEW1?>:</th>
    <td><a href="spieler.php?uid=<?php echo $getvilowner; ?>"><?php echo $database->getUserField($getvilowner,'username',0); ?></a></td>
</tr>
    <tr>
    <th><?=ratusha12?>:</th>
    <td><?php echo $generator->getTimeFormat($time); ?></td>
</tr>
    <tr>
    <th><?=MERCHANTS?>:</th>
    <td><?php
        $resource = array($_POST['r1'],$_POST['r2'],$_POST['r3'],$_POST['r4']);
        echo ceil((array_sum($resource)-0.1)/$market->maxcarry); ?></td>
</tr>

    <tr>
<td colspan="2">
    </td>
</tr>

</tbody></table>
<input type="hidden" name="getwref" value="<?php echo $getwref; ?>">
    <div class="clear"></div>
    <p>
        <button type="submit" value="ok" name="s1" id="btn_ok" class="green" tabindex="8">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=market13?></div>
            </div>
        </button>
    </p></form>
<?php }else{

?>
<form method="POST" name="snd" action="build.php?id=<?php echo $id; ?>&t=5">
    <input type="hidden" name="ft" value="check">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <table id="send_select" class="send_res" cellpadding="1" cellspacing="1">
        <tbody><tr>
            <td class="ico"><a href="#" onclick="upd_res(1,1); return false;"> <i class="r1"></i></a></td>
            <td class="nam">
                wood            </td>
            
            <td class="max ">/
                <a id="addRessourcesLink1" href="#" onclick="marketPlace.addRessources(1);return false;"> <?php echo $market->maxcarry; ?></a>
            </td>

                            <td class="val">
                    <input class="text" type="text" name="r1" id="r1" value="<?php echo $_POST['r1']; ?>" maxlength="20" onchange="marketPlace.validateAndVisualizeMerchantCapacity(1)" tabindex="1">
                </td>
            
        </tr>

        <tr>
            <td class="ico"><a href="#" onclick="upd_res(2,1); return false;"> <i class="r2"></i>
                </a></td>
            <td class="nam">
                clay            </td>

                        <td class="max ">/
                <a id="addRessourcesLink2" href="#" onclick="marketPlace.addRessources(2);return false;"> <?php echo $market->maxcarry; ?></a>
            </td>
                            <td class="val">
                    <input class="text" type="text" name="r2" id="r2" value="<?php echo $_POST['r2']; ?>" maxlength="20" onchange="marketPlace.validateAndVisualizeMerchantCapacity(2)" tabindex="2">
                </td>
                    </tr>

        <tr>
            <td class="ico"><a href="#" onclick="upd_res(3,1); return false;"> <i class="r3"></i>
                </a></td>
            <td class="nam">
                Iron            </td>
                        <td class="max ">/
                <a id="addRessourcesLink3" href="#" onclick="marketPlace.addRessources(3);return false;"> <?php echo $market->maxcarry; ?></a>
            </td>
                            <td class="val">
                    <input class="text" type="text" name="r3" id="r3" value="<?php echo $_POST['r3']; ?>" maxlength="20" onchange="marketPlace.validateAndVisualizeMerchantCapacity(3)" tabindex="3">
                </td>
                    </tr>

        <tr>
            <td class="ico"><a href="#" onclick="upd_res(4,1); return false;"> <i class="r4"></i>
                </a></td>
            <td class="nam">
                Crop            </td>
                        <td class="max ">/
                <a id="addRessourcesLink4" href="#" onclick="marketPlace.addRessources(4);return false;"><?php echo $market->maxcarry; ?></a>
            </td>
                            <td class="val">
                    <input class="text" type="text" name="r4" id="r4" value="<?php echo $_POST['r4']; ?>" maxlength="20" onchange="marketPlace.validateAndVisualizeMerchantCapacity(4)" tabindex="4">
                </td>
                    </tr>

        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div id="merchantsNeeded">
                Merchants: <span id="merchantsNeededNumber">0</span>
                </div>
            </td>
                        <td>
                <div class="merchantCapacity ">
                    / <span id="merchantCapacityValue"><?php echo $market->maxcarry; ?></span>
                </div>
            </td>
                            <td>
                    <div class="merchantCapacityVisualization ">
                        <div id="sumResources">0</div>
                    </div>
                </td>
                    </tr>
    </tbody></table>



<div class="destination"><div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">

    <table cellpadding="0" cellspacing="0" class="transparent compact">
    <tbody>
    <tr>
    <td>
    <span class="or"><?=COORDIANTES?></span>
<?php
if(isset($_GET['z'])){
$coor = $database->getCoor($database->filterintvalue($_GET['z']));
}
elseif(isset($_GET['forres'])){

$coor = $database->getCoor($database->filterintvalue($_GET['forres']));
}
else{
$coor['x'] = "";
$coor['y'] = "";
}

?>		<div class="coordinatesInput">

<div class="yCoord">
    <label for="yCoordInput">X:</label>
<input class="text coordinates x " type="text" name="x" value="<?=$coor['x']?>" maxlength="4" tabindex="7">
    </div>
            <div class="xCoord">
                <label for="xCoordInput">Y:</label>
                <input class="text coordinates y " type="text" name="y" value="<?=$coor['y']?>" maxlength="4" tabindex="6">
            </div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</td>
</tr>
</tbody>
</table>

</div></div>
<div class="clear"></div>
    <?php if($session->goldclub == 1){?>
    <p>Trade route <select class="markgos" name="send3"><option value="1" selected="selected">1x</option><option value="2">2x</option><option value="3">3x</option></select></p>
<?php
}else{
?>
<input type="hidden" name="send3" value="1">
    <?php
    }
    ?>
    </div>
    <div class="clear"></div>
    <p><?=market14?> <b><?php echo $market->maxcarry; ?></b> <?=market15?></p>
    <p>
    <div id="button">
        <div id="prepareError" class="error"></div>

        <button type="submit" value="send" id="enabledButton" class="green prepare" onclick="if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}" tabindex="10" onfocus="jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content">Send</div>
            </div>
        </button>
        <script type="text/javascript">
                        
            jQuery(function () {
                jQuery('#enabledButton').click(function (event) {
                    jQuery(window).trigger('buttonClicked', [this, {
                        "type": "submit",
                        "value": "Send",
                        "name": "",
                        "id": "enabledButton",
                        "class": "green prepare",
                        "title": "",
                        "confirm": "",
                        "onclick": "if($(this).hasClass(\u0027disabled\u0027)){(new DOMEvent(event)).stop(); return false;} else {}",
                        "tabindex": 10,
                        "onfocus": "jQuery(\u0027button\u0027, \u0027input[type!=hidden]\u0027, \u0027select\u0027).set(\u0027focus\u0027, true); (new DOMEvent(event)).stop(); return false;"
                    }]);
                });
            });
        </script>

        <div class="clear"></div>
    </div>
    <p class="note" id="note"></p>

</form>
<?php
$error = '';
if(isset($_POST['ft'])=='check'){

	if(!$checkexist){
		$error = '<span class="error"><b>'.market16.'</b></span>';
	}elseif($getwref == $village->wid){
		$error = '<span class="error"><b>'.market17.'</b></span>';
	}elseif($userAccess == '0' or $userAccess == '8' or $userAccess == '9'){
		$error = '<span class="error"><b>'.market18.'</b></span>';
    }elseif($_POST['r1']==0 && $_POST['r2']==0 && $_POST['r3']==0 && $_POST['r4']==0){
		$error = '<span class="error"><b>'.market19.'</b></span>';
    }elseif(!$_POST['x'] && !$_POST['y'] && !$_POST['dname']){
		$error = '<span class="error"><b>'.market20.'</b></span>';
    }elseif($allres > $maxcarry){
		$error = '<span class="error"><b>'.market21.'</b></span>';
    }
    echo $error;
}
?>
<script type="text/javascript">
    function customReload() {
        window.marketPlace.reloadMarketPlace();
    }

    function upd_res(resNr, max) {
        var currentRes = window.resources.storage['l' + resNr];
        var merchantMax =  <?php echo $market->maxcarry; ?>;
        var resource = jQuery('#r' + resNr);
        var inputRes = parseInt((max) ? currentRes : resource.val()) || 0;

        resource.val(res_max(inputRes, currentRes, merchantMax, 0));

        var prepare = jQuery('.prepare');
        if (prepare.length > 0) {
            prepare.attr('disabled', false);
            prepare.removeClass('disabled');
        }

        window.marketPlace.visualizeMerchantCapacity();
    }

    function res_max(_merchantRes, _actualRes, _merchantMax, _carry) {
        var res = Number(_merchantRes) + _carry;
        if (res > _actualRes) {
            res = _actualRes;
        }
        if (res > _merchantMax) {
            res = _merchantMax;
        }
        if (res === 0) {
            res = '';
        }
        return res;
    }

    jQuery(function () {
        jQuery('#r1').focus();
        window.marketPlace = new Travian.Game.Marketplace({
            merchantsAvailable: <?php echo $market->merchantAvail(); ?>,
            capacityPerMerchant:  <?php echo $market->maxcarry; ?>,
            autoCompleter: true,
            merchantsMax: <?php echo $market->merchant; ?>        });
        window.marketPlace.visualizeMerchantCapacity();

        var form = jQuery('#marketSend');
        form.on('submit', function (e) {
            e.preventDefault();
            Travian.Game.Marketplace.updateVillageListLinks(this);
            window.marketPlace.prepare();
        });
    });
</script>
<script type="application/javascript">
    jQuery(function(){
        Travian.Game.Marketplace.onLoad();
    });
</script>

<p>
<?php }
if(!isset($timer)){
$timer = 1;
}
if(count($market->recieving) > 0) {
    echo "<h4>".market22.":</h4>";
    foreach($market->recieving as $recieve) {
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        $villageowner = $database->getVillageField($recieve['from'],"owner");
        echo "<thead><tr><td><a href=\"spieler.php?uid=$villageowner\">".$database->getUserField($villageowner,"username",0)."</a></td>";
        echo "<td><a href=\"karte.php?d=".$recieve['from']."&c=".$generator->getMapCheck($recieve['from'])."\">Transport from ".$database->getVillageField($recieve['from'],"name")."</a> <div style='float:right;'>x".$send['send']."</div></td>";
        echo "</tr></thead><tbody><tr><th>".market23."</th><td>";
        echo "<div class=\"in\"><span id=timer$timer>".$generator->getTimeFormat($recieve['endtime']-time())."</span> h</div>";
        $datetime = $generator->procMtime($recieve['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
            echo "on ".$datetime[0]." ";
        }
        echo "at ".$datetime[1]."</div>";
        echo "</td></tr></tbody> <tr class=\"res\"> <th>".market24."</th> <td colspan=\"2\"><span class=\"f10\">";
        echo "<img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".$recieve['wood']." | <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$recieve['clay']." | <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$recieve['iron']." | <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$recieve['crop']."</td></tr></tbody>";
        echo "</table>";
        $timer +=1;
    }
}
if(count($market->sending) > 0) {
    echo "<h4>".market25."</h4>";
    foreach($market->sending as $send) {
        $villageowner = $database->getVillageField($send['to'],"owner");
        $ownername = $database->getUserField($villageowner,"username",0);
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        echo "<thead><tr> <td><a href=\"spieler.php?uid=$villageowner\">$ownername</a></td>";
        echo "<td><a href=\"karte.php?d=".$send['to']."&c=".$generator->getMapCheck($send['to'])."\">Transfer to ".$database->getVillageField($send['to'],"name")."</a> x".($send['send'] ? $send['send'] : '1')."</td>";
        echo "</tr></thead> <tbody><tr> <th>".market23."</th> <td>";
        echo "<div class=\"in\"><span id=timer$timer>".$generator->getTimeFormat($send['endtime']-time())."</span></div>";
        $datetime = $generator->procMtime($send['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
            echo "".$datetime[0]." ";
        }
        echo "in  ".$datetime[1]."</div>";
        echo "</td> </tr> <tr class=\"res\"> <th>".market24."</th><td>";
        echo "<i class=\"r1\" title=\"wood\" /></i> ".number_format($send['wood'])." | <i class=\"r2\" title=\"clay\" /></i> ".number_format($send['clay'])." | <i class=\"r3\" title=\"Iron\" /></i> ".number_format($send['iron'])." | <i class=\"r4\" title=\"crop\" /></i> ".number_format($send['crop'])."</td></tr></tbody>";
        echo "</table>";
        $timer += 1;
    }
}
if(count($market->return) > 0) {
    echo "<h4>".market26.":</h4>";
    foreach($market->return as $return) {
        $villageowner = $database->getVillageField($return['from'],"owner");
        $ownername = $database->getUserField($villageowner,"username",0);
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        echo "<thead><tr> <td><a href=\"spieler.php?uid=$villageowner\">$ownername</a></td>";
        echo "<td><a href=\"karte.php?d=".$return['from']."&c=".$generator->getMapCheck($return['from'])."\">Back from ".$database->getVillageField($return['from'],"name")."</a> x".($send['send'] ? $send['send'] : '1')."</td>";
        echo "</tr></thead> <tbody><tr> <th>".market23."</th> <td>";
        echo "<div class=\"in\"><span id=timer".$timer.">".$generator->getTimeFormat($return['endtime']-time())."</span></div>";
        $datetime = $generator->procMtime($return['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
            echo "".$datetime[0]." ";
        }
        echo "In ".$datetime[1]."</div>";
        echo "</td> </tr> <tr class=\"res\"> <th>".market24."</th>";
        echo "<td><span class=\"none\"><i class=\"r1\" title=\"wood\" /></i> ".number_format($return['wood'])." | <i class=\"r2\" title=\"clay\" /></i> ".number_format($return['clay'])." | <i class=\"r3\" title=\"Iron\" /></i> ".number_format($return['iron'])." | <i class=\"r4\" title=\"crop\" /></i> ".number_format($return['crop'])."</span></td></tr></tbody>";

        echo "</tbody></table>";
        $timer += 1;
    }
}