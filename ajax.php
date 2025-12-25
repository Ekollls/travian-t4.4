<?php

//print_r($_GET); die():
//include_once('application/Session.php');
include_once "application/Account.php";
switch($_GET['cmd']) {
    case 'productionBoostPopup':
	//echo $session->bonus1; die();
                if ($session->bonus1 > time()) {
                    $exp2 = $generator->getTimeFormat($session->bonus1 - time());
                    $ACTIVE_WOOD = $lang['Plus']['Plus16'].' '. $exp2 . '';
                }
                if ($session->bonus2 > time()) {
                    $exp3 = $generator->getTimeFormat($session->bonus2 - time());
                    $ACTIVE_CLAY = $lang['Plus']['Plus16'].' '. $exp3 . '';
                }
                if ($session->bonus3 > time()) {
                    $exp4 = $generator->getTimeFormat($session->bonus3 - time());
                    $ACTIVE_IRON = $lang['Plus']['Plus16'].' '. $exp4 . '';
                }
                if ($session->bonus4 > time()) {
                    $exp5 = $generator->getTimeFormat($session->bonus4 - time());
                    $ACTIVE_CROP = $lang['Plus']['Plus16'].' '. $exp5 . '';
                }

               echo '{"response": {"error":false,"errorMsg":null,"data":{"title":"'.$lang['Plus']['popupProd01'].'","gold":"'.$lang['Plus']['Gold'].': <img src=\"img\/x.gif\" class=\"gold\" alt=\"Gold\"\/> <span class=\"bold\">' . $session->gold . '<\/span>","productionBoostChooseText":"'.$lang['Plus']['popupProd02'].':","features":{"productionBoostWood":{"title":"‎‭'.$lang['Plus']['popupProd03'].'","subtitle":"' . $ACTIVE_WOOD . '","subtitleClassExtension":"bonusEndsSoon","button":"<button  type=\"button\" value=\"Activation\" id=\"button5280f45b147c1\" class=\"gold productionBoostButton wood\" title=\"'.$lang['Plus']['Plus13'].'<br\/>'.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].' \" coins=\"5\">\n<div class=\"button-container addHoverClick\">\n<div class=\"button-background\">\n<div class=\"buttonStart\">\n<div class=\"buttonEnd\">\n<div class=\"buttonMiddle\"><\/div>\n<\/div>\n<\/div>\n<\/div>\n<div class=\"button-content\">'.($session->bonus1 > time() ? $lang['Plus']['Plus14'] : $lang['Plus']['Plus13']).'<img src=\"img\/x.gif\" class=\"goldIcon\" alt=\"\" \/><span class=\"goldValue\">'.$config['addonProduction'].'<\/span><\/div>\n<\/div>\n<\/button>\n<script type=\"text\/javascript\">\nwindow.addEvent(\'domready\', function()\n{\nif($(\'button5280f45b147c1\'))\n{\n$(\'button5280f45b147c1\').addEvent(\'click\', function ()\n{\nwindow.fireEvent(\'buttonClicked\', [this, {\"type\":\"button\",\"value\":\"Activation\",\"name\":\"\",\"id\":\"button5280f45b147c1\",\"class\":\"gold productionBoostButton wood\",\"title\":\"Activation now\\u0026lt;br\\\/\\u0026gt;'.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].' : 7\",\"confirm\":\"\",\"onclick\":\"\",\"coins\":5}]);\n});\n}\n});\n<\/script>\n","buttonSubtitle":"'.(!$session->bonus1 ? ''.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].'' : '<input type=\"checkbox\" id=\"productionboostWood\" name=\"productionboostWood[]\" class=\"enumerableElements check checkbox prolongProductionboostWood\" style=\"\" '.($Travian->getAutoRenewal('productionboostWood') ? 'checked=\"checked\"' : '').' value=\"'.($Travian->getAutoRenewal('productionboostWood')).'\" title=\"\"><label for=\"productionboostWood\" class=\"enumerableElementsCheckboxLabel prolongProductionboostWood\" style=\"\">'.$lang['Plus']['Plus12'].'</label>').' <span class=\"bold\"><\/span>"},"productionBoostClay":{"title":"‎‭'.$lang['Plus']['popupProd04'].'","subtitle":"' . $ACTIVE_CLAY . '","subtitleClassExtension":"bonusEndsSoon","button":"<button  type=\"button\" value=\"Activation\" id=\"button5280f45b152e5\" class=\"gold productionBoostButton clay\" title=\"'.$lang['Plus']['Plus13'].' now<br\/>'.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].' \" coins=\"5\">\n<div class=\"button-container addHoverClick\">\n<div class=\"button-background\">\n<div class=\"buttonStart\">\n<div class=\"buttonEnd\">\n<div class=\"buttonMiddle\"><\/div>\n<\/div>\n<\/div>\n<\/div>\n<div class=\"button-content\">'.($session->bonus2 > time() ? $lang['Plus']['Plus14'] : $lang['Plus']['Plus13']).'<img src=\"img\/x.gif\" class=\"goldIcon\" alt=\"\" \/><span class=\"goldValue\">'.$config['addonProduction'].'<\/span><\/div>\n<\/div>\n<\/button>\n<script type=\"text\/javascript\">\nwindow.addEvent(\'domready\', function()\n{\nif($(\'button5280f45b152e5\'))\n{\n$(\'button5280f45b152e5\').addEvent(\'click\', function ()\n{\nwindow.fireEvent(\'buttonClicked\', [this, {\"type\":\"button\",\"value\":\"Activation\",\"name\":\"\",\"id\":\"button5280f45b152e5\",\"class\":\"gold productionBoostButton clay\",\"title\":\"'.$lang['Plus']['Plus13'].' now\\u0026lt;br\\\/\\u0026gt;'.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].' \",\"confirm\":\"\",\"onclick\":\"\",\"coins\":5}]);\n});\n}\n});\n<\/script>\n","buttonSubtitle":"'.(!$session->bonus2 ? ''.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].'' : '<input type=\"checkbox\" id=\"productionboostClay\" name=\"productionboostClay[]\" class=\"enumerableElements check checkbox prolongProductionboostClay\" style=\"\" '.($Travian->getAutoRenewal('productionboostClay') ? 'checked=\"checked\"' : '').' value=\"'.($Travian->getAutoRenewal('productionboostClay')).'\" title=\"\"><label for=\"productionboostClay\" class=\"enumerableElementsCheckboxLabel prolongProductionboostClay\" style=\"\">'.$lang['Plus']['Plus12'].'</label>').'  <span class=\"bold\"><\/span>"},"productionBoostIron":{"title":"'.$lang['Plus']['popupProd05'].'","subtitle":"' . $ACTIVE_IRON . '","subtitleClassExtension":"bonusEndsSoon","button":"<button  type=\"button\" value=\"Activation\" id=\"button5280f45b15be3\" class=\"gold productionBoostButton iron\" title=\"'.$lang['Plus']['Plus13'].'<br\/>'.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].' \" coins=\"5\">\n<div class=\"button-container addHoverClick\">\n<div class=\"button-background\">\n<div class=\"buttonStart\">\n<div class=\"buttonEnd\">\n<div class=\"buttonMiddle\"><\/div>\n<\/div>\n<\/div>\n<\/div>\n<div class=\"button-content\">'.($session->bonus3 > time() ? $lang['Plus']['Plus14'] : $lang['Plus']['Plus13']).'<img src=\"img\/x.gif\" class=\"goldIcon\" alt=\"\" \/><span class=\"goldValue\">'.$config['addonProduction'].'<\/span><\/div>\n<\/div>\n<\/button>\n<script type=\"text\/javascript\">\nwindow.addEvent(\'domready\', function()\n{\nif($(\'button5280f45b15be3\'))\n{\n$(\'button5280f45b15be3\').addEvent(\'click\', function ()\n{\nwindow.fireEvent(\'buttonClicked\', [this, {\"type\":\"button\",\"value\":\"Activation\",\"name\":\"\",\"id\":\"button5280f45b15be3\",\"class\":\"gold productionBoostButton iron\",\"title\":\"'.$lang['Plus']['Plus13'].' now\\u0026lt;br\\\/\\u0026gt;'.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].' \",\"confirm\":\"\",\"onclick\":\"\",\"coins\":5}]);\n});\n}\n});\n<\/script>\n","buttonSubtitle":"'.(!$session->bonus3 ? ''.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].'' : '<input type=\"checkbox\" id=\"productionboostIron\" name=\"productionboostIron[]\" class=\"enumerableElements check checkbox prolongProductionboostIron\" style=\"\" '.($Travian->getAutoRenewal('productionboostIron') ? 'checked=\"checked\"' : '').' value=\"'.($Travian->getAutoRenewal('productionboostIron')).'\" title=\"\"><label for=\"productionboostIron\" class=\"enumerableElementsCheckboxLabel prolongProductionboostIron\" style=\"\">'.$lang['Plus']['Plus12'].'</label>').' <span class=\"bold\"><\/span>"},"productionBoostCrop":{"title":"‎‭'.$lang['Plus']['popupProd06'].'","subtitle":"' . $ACTIVE_CROP . '","subtitleClassExtension":"bonusEndsSoon","button":"<button  type=\"button\" value=\"Activation\" id=\"button5280f45b16407\" class=\"gold productionBoostButton crop\" title=\"'.$lang['Plus']['Plus13'].' now<br\/>'.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].' \" coins=\"5\">\n<div class=\"button-container addHoverClick\">\n<div class=\"button-background\">\n<div class=\"buttonStart\">\n<div class=\"buttonEnd\">\n<div class=\"buttonMiddle\"><\/div>\n<\/div>\n<\/div>\n<\/div>\n<div class=\"button-content\">'.($session->bonus4 > time() ? $lang['Plus']['Plus14'] : $lang['Plus']['Plus13']).'<img src=\"img\/x.gif\" class=\"goldIcon\" alt=\"\" \/><span class=\"goldValue\">'.$config['addonProduction'].'<\/span><\/div>\n<\/div>\n<\/button>\n<script type=\"text\/javascript\">\nwindow.addEvent(\'domready\', function()\n{\nif($(\'button5280f45b16407\'))\n{\n$(\'button5280f45b16407\').addEvent(\'click\', function ()\n{\nwindow.fireEvent(\'buttonClicked\', [this, {\"type\":\"button\",\"value\":\"Activation\",\"name\":\"\",\"id\":\"button5280f45b16407\",\"class\":\"gold productionBoostButton crop\",\"title\":\"'.$lang['Plus']['Plus13'].' now\\u0026lt;br\\\/\\u0026gt;'.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].' \",\"confirm\":\"\",\"onclick\":\"\",\"coins\":5}]);\n});\n}\n});\n<\/script>\n","buttonSubtitle":"'.(!$session->bonus4 ? ''.$lang['Plus']['Plus10'].' :'.$p->pBonus['Duration'].' '.$p->pBonus['Type'].'' : '<input type=\"checkbox\" id=\"productionboostCrop\" name=\"productionboostCrop[]\" class=\"enumerableElements check checkbox prolongProductionboostCrop\" style=\"\" '.($Travian->getAutoRenewal('productionboostCrop') ? 'checked=\"checked\"' : '').' value=\"'.($Travian->getAutoRenewal('productionboostCrop')).'\" title=\"\"><label for=\"productionboostCrop\" class=\"enumerableElementsCheckboxLabel prolongProductionboostCrop\" style=\"\">'.$lang['Plus']['Plus12'].'</label>').'  <span class=\"bold\"><\/span>"}},"furtherInfos":"'.$lang['Plus']['popupProd07'].'"}}}';
                
	
	break;
    case 'premiumFeature':
        if($_POST['featureKey'] == 'plus' && $_POST['context'] == 'infobox'){ echo $p->infobox(1); break; }
        if($_POST['featureKey'] == 'productionboostWood' && $_POST['context'] == 'infobox'){ echo $p->infobox(2); break; }
        if($_POST['featureKey'] == 'productionboostClay' && $_POST['context'] == 'infobox'){ echo $p->infobox(3); break; }
        if($_POST['featureKey'] == 'productionboostIron' && $_POST['context'] == 'infobox'){ echo $p->infobox(4); break; }
        if($_POST['featureKey'] == 'productionboostCrop' && $_POST['context'] == 'infobox'){ echo $p->infobox(5); break; }
        if($_POST['featureKey'] == 'demolishNow'){echo $p->demolishNow($_POST['additionalData']['gid']); break;} 
        if($_POST['featureKey'] == 'upgradeAllResourcesTo20'){echo $p->upAll(); break;} 
        if($_POST['featureKey'] == 'increaseStorage'){echo $p->upStorage(); break;}
        if($_POST['featureKey'] == 'finishTraining'){echo $p->finishTraining(); break;}
        if($_POST['featureKey'] == 'fasterTraining'){echo $p->fasterTraining(); break;}
        if($_POST['featureKey'] == 'smithyUpgradeAllToMax'){echo $p->smithyUpgradeAllToMax(); break;}
        if($_POST['featureKey'] == 'academyResearchAll'){echo $p->academyResearchAll(); break;}
        if($_POST['featureKey'] == 'buyResources0'){echo $p->buyResources(0); break;}
        if($_POST['featureKey'] == 'buyResources1'){echo $p->buyResources(1); break;}
        if($_POST['featureKey'] == 'buyResources2'){echo $p->buyResources(2); break;}
        if($_POST['featureKey'] == 'moreProtection0'){echo $p->moreProtection(0); break;}
        if($_POST['featureKey'] == 'moreProtection1'){echo $p->moreProtection(1); break;}
        if($_POST['featureKey'] == 'moreProtection2'){echo $p->moreProtection(2); break;}
        if($_POST['featureKey'] == 'finishNow'){
            if($session->gold >= 2){
                echo $p->finishNow(); 
            }else{
                include('application/views/gold/notEnough.php');
            }
            
        
        break;
        }

        if($_POST['toggleAutoprolong']){
            $database->query("UPDATE autorenewals SET ".($_POST['featureKey'])." = ".($Travian->getAutoRenewal($_POST['featureKey']) ? 0 : 1)." WHERE userid = ".$session->uid."");
            //echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"paymentWizard"}}}';
            echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","options":{"html":null},"context":null}}}';
        }else{
            if($_POST['context'] == 'productionBoost'){
                switch($_POST['featureKey']){
                    case 'productionboostWood':
                        if($session->gold >= $config['addonProduction']){
                            $database->modifyGold($session->uid, $config['addonProduction'], 0);
                            //if($session->bonus1 == 0){ $Addon = time(); }else{ $Addon = 0; }
                            //$database->query("UPDATE users SET b1 = b1 + ".(PLUS_PRODUCTION + $Addon)." WHERE id = ".$session->uid."");
                            $p->updatePlus(2);
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"productionBoost"}}}';
                        }else{
                            include('application/views/gold/notEnough.php');
                        }
                    break;
                    case 'productionboostClay':
                        if($session->gold >= $config['addonProduction']){
                            $database->modifyGold($session->uid, $config['addonProduction'], 0);
                            $p->updatePlus(3);
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"productionBoost"}}}';
                        }else{
                            include('application/views/gold/notEnough.php');
                        }
                    break;
                    case 'productionboostIron':
                        if($session->gold >= $config['addonProduction']){
                            $database->modifyGold($session->uid, $config['addonProduction'], 0);
                            $p->updatePlus(4);
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"productionBoost"}}}';
                        }else{
                            include('application/views/gold/notEnough.php');
                        }
                    break;
                    case 'productionboostCrop':
                        if($session->gold >= $config['addonProduction']){
                            $database->modifyGold($session->uid, $config['addonProduction'], 0);
                            $p->updatePlus(5);
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"productionBoost"}}}';
                        }else{
                            include('application/views/gold/notEnough.php');
                        }
                    break;
                }
            }elseif($_POST['context'] == 'goldclub'){
                if($session->gold >= $config['goldClub']){
                    if($session->goldclub == 0){
                        $database->modifyGold($session->uid, $config['goldClub'], 0);
                        $database->query("UPDATE users SET goldclub = 1 WHERE id = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":null,"data":{"functionToCall":"reloadUrl","options":{"html":""}}}}';
                        //echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"goldclub"}}}';
                    }
                }else{
                    include('application/views/gold/notEnough.php');
                }
            }elseif($_POST['context'] == 'paymentWizard'){ // 
                switch($_POST['featureKey']){
                    case 'goldclub':
                        if($session->gold >= $config['goldClub']){
                            if($session->goldclub == 0){
                                $database->modifyGold($session->uid, $config['goldClub'], 0);
                                $database->query("UPDATE users SET goldclub = 1 WHERE id = ".$session->uid."");
                                echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"paymentWizard"}}}';
                            }
                        }else{
                            include('application/views/gold/notEnough.php');
                        }
                        
                    break;

                    case 'plus':
                        if($session->gold >= $config['Plus']){
                            $database->modifyGold($session->uid, $config['Plus'], 0);
                            $p->updatePlus(1);
                            
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"paymentWizard"}}}';
                        }else{
                            include('application/views/gold/notEnough.php');
                        }
                    break;

                    case 'productionboostWood':
                        if($session->gold >= $config['addonProduction']){
                            $database->modifyGold($session->uid, $config['addonProduction'], 0);
                            $p->updatePlus(2);
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"paymentWizard"}}}';
                        }else{
                            include('application/views/gold/notEnough.php');
                        }
                    break;

                    case 'productionboostClay':
                        if($session->gold >= $config['addonProduction']){
                            $database->modifyGold($session->uid, $config['addonProduction'], 0);
                            $p->updatePlus(3);
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"paymentWizard"}}}';
                        }
                    break;

                    case 'productionboostIron':
                        if($session->gold >= $config['addonProduction']){
                            $database->modifyGold($session->uid, $config['addonProduction'], 0);
                            $p->updatePlus(4);
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"paymentWizard"}}}';
                        }else{
                            include('application/views/gold/notEnough.php');
                        }
                    break;

                    case 'productionboostCrop':
                        if($session->gold >= $config['addonProduction']){
                            $database->modifyGold($session->uid, $config['addonProduction'], 0);
                            $p->updatePlus(5);
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"paymentWizard"}}}';
                        }else{
                            include('application/views/gold/notEnough.php');
                        }
                    break;
                }
                
            }elseif($_POST['context'] == 'plus'){
                if($session->gold >= $config['Plus']){
                    $database->modifyGold($session->uid, $config['Plus'], 0);
                    $p->updatePlus(1);
                    echo '{"response":{"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"plus"}}}';
                }else{
                    include('application/views/gold/notEnough.php');
                }

                
            }else{
            $_POST['m1'][0]= $database->FilterIntValue($_POST['m1'][0]);
            $_POST['m1'][1]= $database->FilterIntValue($_POST['m1'][1]);
            $_POST['m1'][2]= $database->FilterIntValue($_POST['m1'][2]);
            $_POST['m1'][3]= $database->FilterIntValue($_POST['m1'][3]);
            $_POST['m2'][0]= $database->FilterIntValue($_POST['m2'][0]);
            $_POST['m2'][1]= $database->FilterIntValue($_POST['m2'][1]);
            $_POST['m2'][2]= $database->FilterIntValue($_POST['m2'][2]);
            $_POST['m2'][3]= $database->FilterIntValue($_POST['m2'][3]);

            $vil=$database->getVillage($_SESSION['wid']);
            $gold=$database->getUserGold($session->uid);
            if(!$vil['natar'])
            {
                if($gold >= 3)
                {
                    if (($_POST['m2'][0]+$_POST['m2'][1]+$_POST['m2'][2]+$_POST['m2'][3])<=(round($vil['wood'])+round($vil['clay'])+round($vil['iron'])+round($vil['crop'])))
                    {

                        $database->setNewResourse($_SESSION['wid'],$_POST['m2'][0],$_POST['m2'][1],$_POST['m2'][2],$_POST['m2'][3]);
                        $database->modifyGold($session->uid,3,0);
                        if($session->acData['a5'] < 6){
                            $database->UpdateAchievU($session->uid,"`a5`=a5+2");
                        }
                    }elseif($_POST['m1'][0]<=$vil['wood'] && $_POST['m1'][1]<=$vil['clay'] && $_POST['m1'][2]<=$vil['iron'] && $_POST['m1'][3]<$vil['crop']){ //если зерно inо inремя расчета ушло in минус
                        if ($vil['crop'] > 0) {
                            $crop = $_POST['m1'][3] - $vil['crop']; //разница in кропах которую будет отнимать от распределенного зерна чтобы компенсироinать минус
                        } else {
                            if($_POST['m1'][3]>0){
                                $crop = abs($_POST['m1'][3] - abs($vil['crop']));
                            }else{
                            $crop = abs(abs($_POST['m1'][3]) + abs($vil['crop']));
                            }
                        }
                        $database->setNewResourse($_SESSION['wid'],$_POST['m2'][0],$_POST['m2'][1],$_POST['m2'][2],round($_POST['m2'][3]-$crop));
                        $database->modifyGold($session->uid,3,0);
                        if($session->acData['a5'] < 6){
                            $database->UpdateAchievU($session->uid,"`a5`=a5+2");
                        }
                    }
                    echo '{"response": {"error":false,"errorMsg":null,"data":{"functionToCall":"reloadUrl","options":{"html":""}}}}';
                }
            }
        }
        }
        break;
    case 'exchangeResources':
        include_once("application/Data/buidata.php");
        if($session->gold >= 3){
        $vilres=$database->getResVillageField($_SESSION['wid']);
        $ress=$crop=0;
        $fdata=$database->getResourceLevel($_SESSION['wid']);
        for ($i = 19; $i < 40; $i++){
            if ($fdata['f' . $i . 't'] == 10){$ress += $bid10[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
            if ($fdata['f' . $i . 't'] == 38){$ress += $bid38[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
            if ($fdata['f' . $i . 't'] == 11){$crop += $bid11[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
            if ($fdata['f' . $i . 't'] == 39){$crop += $bid39[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
        }

        if ($ress == 0){$ress = 800 * STORAGE_MULTIPLIER;}
        if ($crop == 0){$crop = 800 * STORAGE_MULTIPLIER;}
        
        // iRedux -> storage multiple function by gold
		$upData = $database->queryFetch('SELECT * FROM `storage` WHERE `uid` = '.$session->uid.' AND `vid` = '.$session->vid.'');
			
		$ress = $ress + ($upData['storagem'] * $bid10[20]['attri'] * STORAGE_MULTIPLIER);
		$crop = $crop + ($upData['storagem'] * $bid11[20]['attri'] * STORAGE_MULTIPLIER);


        // iRedux -> storage multiple function by gold
        /*
		$upData = $database->queryFetch('SELECT * FROM `plusaddons` WHERE `uid` = '.$session->uid.'');
			
		$ress = $ress + ($upData['storage'] * $bid10[20]['attri'] * STORAGE_MULTIPLIER);
		$crop = $crop + ($upData['storage'] * $bid11[20]['attri'] * STORAGE_MULTIPLIER);
*/
        if(!isset($_POST['desired'])){

        $html = '<div id="build" class="exchangeResources"><p class="npc_desc">With a dealer swap, you can distribute Resources however you like.

        The first line shows the current inventory. in a second line, you can choose another distribution. The third line shows the difference between old and new stock.</p><input
        type="hidden" name="t" id="t" value="3"/><input type="hidden" name="a" id="a" value="6"/><input type="hidden"
                                                                                                        name="c" id="c"
                                                                                                        value="021"/><input
        type="hidden" name="d" id="d" value="'.$_SESSION["wid"].'"/>
    <table id="npc" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <td class="all"><a href="#"onclick="Travian.Game.Marketplace.ExchangeResources.fillup(0); return false;">
            <i class="r1"></i></a> <span id="org0" '.($vilres["wood"] > 10000000 ? 'style="font-size:10px"' : '').'>'.$vilres["wood"].'</span></td>
            <td class="all"><a href="#"onclick="Travian.Game.Marketplace.ExchangeResources.fillup(1); return false;">
            <i class="r2"></i></a> <span id="org1" '.($vilres["clay"] > 10000000 ? 'style="font-size:10px"' : '').'>'.$vilres["clay"].'</span></td>
            <td class="all"><a href="#" onclick="Travian.Game.Marketplace.ExchangeResources.fillup(2); return false;">
            <i class="r3"></i></a> <span id="org2" '.($vilres["iron"] > 10000000 ? 'style="font-size:10px"' : '').'>'.$vilres["iron"].'</span></td>
            <td class="all">
                <a href="#"onclick="Travian.Game.Marketplace.ExchangeResources.fillup(3); return false;"><i class="r4"></i></a> 
                <span id="org3" '.($vilres["crop"] > 10000000 ? 'style="font-size:10px"' : '').'>'.$vilres["crop"].'</span>
            </td>
            <td class="deco"></td>
            <td class="sum">left:&nbsp;<span id="org4">'.($vilres["wood"]+$vilres["clay"]+$vilres["iron"]+$vilres["crop"]).'</span></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="sel"><input type="text" class="text" onkeyup="Travian.Game.Marketplace.ExchangeResources.calculateRest();"
                                   name="m2[]" id="m2[0]" size="5" maxlength="30" value="'.$_POST['defaultValues']['r1'].'"/><input type="hidden"
                                                                                                      name="m1[]"
                                                                                                      id="m1[0]"
                                                                                                      value="'.$_POST['defaultValues']['r1'].'"/>
            </td>
            <td class="sel"><input type="text" class="text" onkeyup="Travian.Game.Marketplace.ExchangeResources.calculateRest();"
                                   name="m2[]" id="m2[1]" size="5" maxlength="30" value="'.$_POST['defaultValues']['r2'].'"/><input type="hidden"
                                                                                                      name="m1[]"
                                                                                                      id="m1[1]"
                                                                                                      value="'.$_POST['defaultValues']['r2'].'"/>
            </td>
            <td class="sel"><input type="text" class="text" onkeyup="Travian.Game.Marketplace.ExchangeResources.calculateRest();"
                                   name="m2[]" id="m2[2]" size="5" maxlength="30" value="'.$_POST['defaultValues']['r3'].'"/><input type="hidden"
                                                                                                      name="m1[]"
                                                                                                      id="m1[2]"
                                                                                                      value="'.$_POST['defaultValues']['r3'].'"/>
            </td>
            <td class="sel"><input type="text" class="text" onkeyup="Travian.Game.Marketplace.ExchangeResources.calculateRest();"
                                   name="m2[]" id="m2[3]" size="5" maxlength="30" value="'.$_POST['defaultValues']['r4'].'"/><input type="hidden"
                                                                                                      name="m1[]"
                                                                                                      id="m1[3]"
                                                                                                      value="'.$_POST['defaultValues']['r4'].'"/>
            </td>
            <td class="deco"></td>
            <td class="sum">total:&nbsp;<span id="newsum">'.($_POST['defaultValues']['r1']+$_POST['defaultValues']['r2']+$_POST['defaultValues']['r3']+$_POST['defaultValues']['r4']).'</span></td>
        </tr>
        <tr>
            <td class="rem numberDirection'.DIRECTION.'"><span id="diff0">'.round($vilres["wood"]-$_POST['defaultValues']['r1']).'</span></td>
            <td class="rem numberDirection'.DIRECTION.'"><span id="diff1">'.round($vilres["clay"]-$_POST['defaultValues']['r2']).'</span></td>
            <td class="rem numberDirection'.DIRECTION.'"><span id="diff2">'.round($vilres["iron"]-$_POST['defaultValues']['r3']).'</span></td>
            <td class="rem numberDirection'.DIRECTION.'"><span id="diff3">'.round($vilres["crop"]-$_POST['defaultValues']['r4']).'</span></td>
            <td class="deco"></td>
            <td class="sum">remains:&nbsp;<span id="remain">'.($vilres["wood"]+$vilres["clay"]+$vilres["iron"]+$vilres["crop"]).'</span></td>
        </tr>
        </tbody>
    </table>
    <p id="submitButton" class="disableButtonHandler">
        <button type="submit" value="Redeem" id="npc_market_button" class="gold " title="distribution right now" coins="3">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content">distribution right now<img src="img/x.gif" class="goldIcon" alt=""/><span class="goldValue">3</span>
                </div>
            </div>
        </button>
        <script type="text/javascript">window.addEvent(\'domready\', function(){if($(\'npc_market_button\')){$(\'npc_market_button\').addEvent(\'click\', function (){window.fireEvent(\'buttonClicked\', [this, {"type":"submit","value":"Redeem","name":"","id":"npc_market_button","class":"gold ","title":"Redeem now.","confirm":"","onclick":"","coins":3,"wayOfPayment":{"featureKey":"marketplace","context":"","dataCallback":"returnInputValues"}}]);});}});</script>
    </p>
    <p id="submitText">
        <button type="button" id="button54872383d13d2" class="gold "
                title="distribution Resources remaining"
                onclick="javascript:Travian.Game.Marketplace.ExchangeResources.portion('.$_SESSION['wid'].');">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content">distribution Resources remaining</div>
            </div>
        </button>
        <script type="text/javascript">window.addEvent(
            \'domready\', function(){if($(\'button54872383d13d2\')){$(\'button54872383d13d2\').addEvent(\'click\', function (){window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"Distribute remaining resources.","name":"","id":"button54872383d13d2","class":"gold ","title":"Distribute remaining resources.","confirm":"","onclick":"javascript:Travian.Game.Marketplace.ExchangeResources.portion('.$_SESSION['wid'].');"}]);});}});</script>
    </p>
    <script>Travian.Game.Marketplace.ExchangeResources.initialize('.$ress.', '.$crop.');
        Travian.Game.Marketplace.ExchangeResources.calculateRest();
        function returnInputValues() {
            var inputFields = $$(\'form input\');    var returnObject = {};    Array.each(inputFields, function(element, index)    {    var name = element.get(\'id\');    var curObject = {};                var value = element.get(\'value\');                if (isNaN(value) || void 0 == value) {                    value = 0;                }    curObject[name] = value;    Object.append(returnObject, curObject);    });    return returnObject;}</script>
</div>
        ';

            echo '{"response": {"error":false,"errorMsg":null,"data":{"html":'.json_encode($html).'}}}';
        }else{

            $vilres=$database->getNPCVillageField($_SESSION['wid']);
            $needsum=$_POST['desired'][0]+$_POST['desired'][1]+$_POST['desired'][2]+$_POST['desired'][3];
            $havesum=($vilres["wood"]+$vilres["clay"]+$vilres["iron"]+$vilres["crop"]);
           $next=$lol=$Rmax=$floated=0;
            $Tres=$new=array();
            if($havesum>=$needsum){
                $diff=$havesum;
                while ($diff>=1) {
                    $newdiff=0;
                    $lol++;
                    for ($i = 0; $i <= 3; $i++) {
                        if ($i < 3) {
                            $max = $vilres['maxstore'];
                        } else {
                            $max = $vilres['maxcrop'];
                        }
                        if (!$next) {
                            $Tres[$i] = (($_POST['desired'][$i] + (($havesum - $needsum) / 4)) > $max) ? $max : ($_POST['desired'][$i] + (($havesum - $needsum) / 4));
                            $Tres[$i] = floor($Tres[$i]);
                            if ($Tres[$i] == $max) {
                                $Rmax++;
                            }

                            $diff -= $Tres[$i];

                        } else {
                            if ($Tres[$i] != $max) {
                                $new = (($Tres[$i] + $diff / (4 - $Rmax)) > $max) ? $max : (($Tres[$i] + $diff / (4 - $Rmax)));
$new=floor($new);
                                $newdiff += $new - $Tres[$i];
                                $Tres[$i] = $new;
                                if ($Tres[$i] == $max) {
                                    $Rmax++;
                                }
                            }

                        }

                    }
                    $diff -= $newdiff;
                    $next++;
                    if($lol>5){
                        break;
                    }
                }
            }else{

                for ($i = 0; $i <= 3; $i++) {
                    $Tres[$i] =  floor($_POST['desired'][$i] - ($needsum-$havesum) / 4);
                }
            }
            $gotsum=array_sum($Tres);
            file_put_contents('application/queue2/log.txt', var_export($havesum.'<'.$gotsum, true) . "\r\n\r\n",FILE_APPEND);
            while($havesum>$gotsum){
                for($i=0;$i<=3;$i++){
                    if ($i < 3) {
                        $max = $vilres['maxstore'];
                    } else {
                        $max = $vilres['maxcrop'];
                    }

                if($Tres[$i]<$max){$Tres[$i]+=1; $gotsum+=1;; if($gotsum==$havesum){break;} }
                    file_put_contents('application/queue2/log.txt', var_export($havesum.'<'.$gotsum, true) . "\r\n\r\n",FILE_APPEND);
                }
            }
            echo '
{
	"response": {"error":false,"errorMsg":null,"data":{"distributed":['.round($Tres[0]).','.round($Tres[1]).','.round($Tres[2]).','.round($Tres[3]).'],"resources":['.$vilres["wood"].','.$vilres["clay"].','.$vilres["iron"].','.$vilres["crop"].']}}
}';

        }

    }else{
        include('application/views/gold/notEnough.php');
    }


        break;


    case 'quest':
        /*
Array
(
    [cmd] => quest
    [questTutorialId] => Tutorial_01
    [action] => next
    [ajaxToken] => de3768730d5610742b5245daa67b12cd
)

Array
(
    [cmd] => quest
    [action] => skip
    [ajaxToken] => de3768730d5610742b5245daa67b12cd
)

Array ( [cmd] => quest [questTutorialId] => Tutorial_01 [action] => next [ajaxToken] => de3768730d5610742b5245daa67b12cd )
Array ( [cmd] => quest [questTutorialId] => Tutorial_04 [action] => next [ajaxToken] => de3768730d5610742b5245daa67b12cd )
Array ( [cmd] => quest [questTutorialId] => Battle_01 [ajaxToken] => de3768730d5610742b5245daa67b12cd )        
Array ( [cmd] => quest [questTutorialId] => Tutorial_01 [action] => next [ajaxToken] => de3768730d5610742b5245daa67b12cd )
Array ( [cmd] => quest [questTutorialId] => Economy_01 [action] => next [ajaxToken] => de3768730d5610742b5245daa67b12cd )

Array ( [cmd] => quest [questTutorialId] => AchievementQuestReward_01 [action] => reward [ajaxToken] => de3768730d5610742b5245daa67b12cd )
*/
        //print_r($_POST); die();
        
        if(isset($_POST['action'])){
            if($_POST['action'] == 'skip'){ // No quests
                $database->query("UPDATE quests SET quest = 15, skipped = 1 WHERE userid = ".$session->uid."");
                echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
            }elseif($_POST['action'] == 'next'){

                if($_POST['questTutorialId'] == 'Tutorial_01' && $session->questNum == 1){
                    $database->query("UPDATE quests SET quest = 2 WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }

                if($_POST['questTutorialId'] == 'Tutorial_02' && $session->questNum == 2){
                    if($session->qData['isFinished']){
                        //  clay  1
                        $fData = $database->queryFetch("SELECT * FROM fdata WHERE vref = ".$_SESSION['wid']."");
                        if($fData['f5'] > 0 && $fData['f6'] > 0 && $fData['f16'] > 0 && $fData['f18'] > 0){ $noReward = TRUE; }
                        if(!$noReward){
                            if($fData['f5'] == 0){ $database->query("UPDATE fdata SET f5 = 1 WHERE vref = ".$_SESSION['wid']."");$isDone = True; }
                            if($fData['f6'] == 0 && !$isDone){$database->query("UPDATE fdata SET f6 = 1 WHERE vref = ".$_SESSION['wid']."");$isDone = True;}
                            if($fData['f16'] == 0 && !$isDone){$database->query("UPDATE fdata SET f16 = 1 WHERE vref = ".$_SESSION['wid']."");$isDone = True;}
                            if($fData['f18'] == 0 && !$isDone){$database->query("UPDATE fdata SET f18 = 1 WHERE vref = ".$_SESSION['wid']."");$isDone = True;}

                            $database->recountPop($_SESSION['wid']);
                        }
                        $database->query("UPDATE quests SET quest = 3, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

        
                if($_POST['questTutorialId'] == 'Tutorial_03' && $session->questNum == 3){
                    if($session->qData['isFinished']){
                        $building->finishAll();
                        $database->query("UPDATE quests SET quest = 4, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                
                if($_POST['questTutorialId'] == 'Tutorial_04' && $session->questNum == 4){
                    if($session->qData['isFinished']){
                        $building->finishAll();
                        $database->query("UPDATE quests SET quest = 5, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                if($_POST['questTutorialId'] == 'Tutorial_05' && $session->questNum == 5){
                    if($session->qData['isFinished']){
                        $building->finishAll();

                        for($i=0;$i<19;$i++){
                            if($session->fData['f'.$i.''] == 1 && $session->fData['f'.$i.'t'] == 4){
                                $database->query("UPDATE fdata SET f$i = 2 WHERE vref = ".$_SESSION['wid']."");
                                $database->recountPop($_SESSION['wid']);
                                break;
                            }
                        }
                        
                        $database->query("UPDATE quests SET quest = 6, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                if($_POST['questTutorialId'] == 'Tutorial_06' && $session->questNum == 6){
                    if($session->qData['isFinished']){
                        $database->queryFetch("UPDATE vdata SET clay = clay + ".(200*SPEED)." WHERE wref = ".$_SESSION['wid']."");
                        
                        $database->query("UPDATE quests SET quest = 7, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                if($_POST['questTutorialId'] == 'Tutorial_08' && $session->questNum == 8){
                    if($session->qData['isFinished']){
                        $p->updatePlus(1,86400);
                        //if($session->plus){ $addonT = 0; }else{ $addonT= time(); }
                        //$database->queryFetch("UPDATE users SET plus = plus + ".($addonT+86400)." WHERE id = ".$session->uid."");
                        
                        $database->query("UPDATE quests SET quest = 9, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                if($_POST['questTutorialId'] == 'Tutorial_09' && $session->questNum == 9){
                    if($session->qData['isFinished']){
                        $database->queryFetch("UPDATE users SET gold = gold + 2 WHERE id = ".$session->uid."");
                        
                        $database->query("UPDATE quests SET quest = 10, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                if($_POST['questTutorialId'] == 'Tutorial_10' && $session->questNum == 10){
                    if($session->qData['isFinished']){
                        $database->queryFetch("UPDATE users SET gold = gold + 10 WHERE id = ".$session->uid."");
                        
                        $database->query("UPDATE quests SET quest = 11, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                if($_POST['questTutorialId'] == 'Tutorial_11' && $session->questNum == 11){
                    if($session->qData['isFinished']){
                        foreach($session->vvillages as $uVill){
                            $qUM = $database->queryFetch("SELECT * FROM movement WHERE `from` = ".$uVill['wref']." AND `sort_type` =9 AND `proc` =0 ORDER BY moveid DESC LIMIT 1");
                            if($qUM['endtime']){
                                if(time() < $qUM['endtime']){
                                    $database->query("UPDATE movement SET endtime = ".time()." WHERE moveid =".$qUM['moveid']."");
                                    $database->query("UPDATE queue SET finish = ".time()." WHERE jobID =".$qUM['ref']."");
                                }
                            }
                        }
                        
                        $database->query("UPDATE quests SET quest = 12, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                if($_POST['questTutorialId'] == 'Tutorial_12' && $session->questNum == 12){
                    if($session->qData['isFinished']){
                        $qCH = $database->queryFetch("SELECT * FROM `heroitems` WHERE `btype`=11 AND `uid`=".$session->uid." AND `proc` = 0 LIMIT 1");
                        if($qCH['id']){
                            $database->query("UPDATE `heroitems` SET num = num +10 WHERE id = ".$qCH['id']."");
                        }else{
                            $database->query("INSERT INTO heroitems VALUES(NULL, ".$session->uid.",11,0,10,0)");
                        }
                        

                        $database->query("UPDATE quests SET quest = 13, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                if($_POST['questTutorialId'] == 'Tutorial_13' && $session->questNum == 13){
                    if($session->qData['isFinished']){
                        $database->queryFetch("UPDATE `hero` SET experience = experience + ".(20*SPEED)." WHERE `uid`=".$session->uid."");

                        $database->query("UPDATE quests SET quest = 14, step1 =0, step2 = 0 , isFinished =0 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                if($_POST['questTutorialId'] == 'Tutorial_14' && $session->questNum == 14){
                    if($session->qData['isFinished']){
                        $database->queryFetch("UPDATE vdata SET wood = wood + ".(270*SPEED).", clay = clay + ".(300*SPEED).", iron = iron + ".(270*SPEED).", crop = crop + ".(220*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                        $database->query("UPDATE quests SET quest = 15, step1 =1, step2 = 0 , isFinished =1 WHERE userid = ".$session->uid."");
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    }
                }

                if($_POST['questTutorialId'] == 'Tutorial_15' && $session->questNum == 15){

                    if($session->qData['skipped'] == 1){
                        // Skip quests gives
                        $database->query("UPDATE quests SET quest = 16,skipped=0 WHERE userid = ".$session->uid."");

                        if(!$session->fData['f39']){ $database->query("UPDATE fdata SET f39 = 1,f39t=16 WHERE vref = ".$_SESSION['wid'].""); $database->recountPop($_SESSION['wid']);}
                        
                        for($i=0;$i<19;$i++){
                            if($session->fData['f'.$i.''] == 0 && $session->fData['f'.$i.'t'] == 2){
                                $database->query("UPDATE fdata SET f$i = 1 WHERE vref = ".$_SESSION['wid']."");
                                $database->recountPop($_SESSION['wid']);
                            break;
                            }
                        }

                        for($i=0;$i<19;$i++){
                            if(($session->fData['f'.$i.''] == 0 || $session->fData['f'.$i.''] == 1) && $session->fData['f'.$i.'t'] == 1){
                                $database->query("UPDATE fdata SET f$i = 2 WHERE vref = ".$_SESSION['wid']."");
                                $database->recountPop($_SESSION['wid']);
                            break;
                            }
                        }

                        for($i=0;$i<19;$i++){
                            if(($session->fData['f'.$i.''] == 0 || $session->fData['f'.$i.''] == 1) && $session->fData['f'.$i.'t'] == 4){
                                $database->query("UPDATE fdata SET f$i = 2 WHERE vref = ".$_SESSION['wid']."");
                                $database->recountPop($_SESSION['wid']);
                            break;
                            }
                        }
                        $database->query("UPDATE users SET gold = gold + 10 WHERE id = ".$session->uid."");
                        $p->updatePlus(1,86400);
                        //if($session->plus){ $addonT = 0; }else{ $addonT= time(); }
                        //$database->queryFetch("UPDATE users SET plus = plus + ".($addonT+86400)." WHERE id = ".$session->uid."");
                        
                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                        
                    }else{
                        if($session->qData['isFinished']){
                            $database->query("UPDATE quests SET quest = 16, step1 =0, step2 = 0 , isFinished =0,skipped=0 WHERE userid = ".$session->uid."");
                            echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                        }
                    }
                    
                    $database->query("UPDATE quests SET battle1='1,0',battle2='2,0',economy1='1,0',economy2='2,0',world1='1,0',world2='2,0' WHERE userid = ".$session->uid."");

                }

                // Battle codes
                if($_POST['questTutorialId'] == 'Battle_01' && $session->qArrayB1[1]){
                    $database->queryFetch("UPDATE `hero` SET experience = experience + ".(30*SPEED)." WHERE `uid`=".$session->uid."");

                    $database->query("UPDATE quests SET battle1 = '3,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    
                }

                if($_POST['questTutorialId'] == 'Battle_02' && $session->qArrayB2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(130*SPEED).", clay = clay + ".(150*SPEED).", iron = iron + ".(120*SPEED).", crop = crop + ".(100*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET battle2 = '4,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    
                }
                if($_POST['questTutorialId'] == 'Battle_03' && $session->qArrayB1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(110*SPEED).", clay = clay + ".(140*SPEED).", iron = iron + ".(160*SPEED).", crop = crop + ".(30*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET battle1 = '5,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    
                }
                if($_POST['questTutorialId'] == 'Battle_04' && $session->qArrayB2[1]){
                    $qCH = $database->queryFetch("SELECT * FROM `heroitems` WHERE `btype`=11 AND `uid`=".$session->uid." AND `proc` = 0 LIMIT 1");
                    if($qCH['id']){
                        $database->query("UPDATE `heroitems` SET num = num +150 WHERE id = ".$qCH['id']."");
                    }else{
                        $database->query("INSERT INTO heroitems VALUES(NULL, ".$session->uid.",11,0,150,0)");
                    }

                    $database->query("UPDATE quests SET battle2 = '6,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Battle_05' && $session->qArrayB1[1]){
                    $qCH = $database->queryFetch("SELECT * FROM `heroitems` WHERE `btype`=9 AND `uid`=".$session->uid." AND `proc` = 0 LIMIT 1");
                    if($qCH['id']){
                        $database->query("UPDATE `heroitems` SET num = num +1 WHERE id = ".$qCH['id']."");
                    }else{
                        $database->query("INSERT INTO heroitems VALUES(NULL, ".$session->uid.",9,0,1,0)");
                    }

                    $database->query("UPDATE quests SET battle1 = '7,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Battle_06' && $session->qArrayB2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(120*SPEED).", clay = clay + ".(120*SPEED).", iron = iron + ".(90*SPEED).", crop = crop + ".(50*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET battle2 = '8,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    
                }
                if($_POST['questTutorialId'] == 'Battle_07' && $session->qArrayB1[1]){
                    $database->query("UPDATE units SET u1=u1+2 WHERE vref = ".$_SESSION['wid']."");
                    
                    $database->query("UPDATE quests SET battle1 = '9,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    
                }
                if($_POST['questTutorialId'] == 'Battle_08' && $session->qArrayB2[1]){
                    $database->queryFetch("UPDATE users SET silver = silver +500 WHERE id= ".$session->uid."");

                    $database->query("UPDATE quests SET battle2 = '10,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    
                }
                if($_POST['questTutorialId'] == 'Battle_09' && $session->qArrayB1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(280*SPEED).", clay = clay + ".(120*SPEED).", iron = iron + ".(220*SPEED).", crop = crop + ".(110*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    
                    $database->query("UPDATE quests SET battle1 = '11,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    
                }
                if($_POST['questTutorialId'] == 'Battle_10' && $session->qArrayB2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(240*SPEED).", clay = clay + ".(290*SPEED).", iron = iron + ".(430*SPEED).", crop = crop + ".(240*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET battle2 = '12,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Battle_11' && $session->qArrayB1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(210*SPEED).", clay = clay + ".(170*SPEED).", iron = iron + ".(245*SPEED).", crop = crop + ".(115*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    
                    $database->query("UPDATE quests SET battle1 = '13,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Battle_12' && $session->qArrayB2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(450*SPEED).", clay = clay + ".(435*SPEED).", iron = iron + ".(515*SPEED).", crop = crop + ".(550*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET battle2 = '14,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Battle_13' && $session->qArrayB1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(500*SPEED).", clay = clay + ".(400*SPEED).", iron = iron + ".(700*SPEED).", crop = crop + ".(400*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    
                    $database->query("UPDATE quests SET battle1 = '0,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Battle_14' && $session->qArrayB2[1]){
                    $qCH = $database->queryFetch("SELECT * FROM `heroitems` WHERE `btype`=8 AND `uid`=".$session->uid." AND `proc` = 0 LIMIT 1");
                    if($qCH['id']){
                        $database->query("UPDATE `heroitems` SET num = num +10 WHERE id = ".$qCH['id']."");
                    }else{
                        $database->query("INSERT INTO heroitems VALUES(NULL, ".$session->uid.",8,0,10,0)");
                    }

                    $database->query("UPDATE quests SET battle2 = '0,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }

                // Economy code
                if($_POST['questTutorialId'] == 'Economy_01' && $session->qArrayE1[1]){
                    //
                    $p->updatePlus(2,86400);
                    $p->updatePlus(3,86400);
                    $p->updatePlus(4,86400);
                    $p->updatePlus(5,86400);

                    /*
                    if($session->bonus1){ $addonT = 0; }else{ $addonT= time(); }
                    $database->queryFetch("UPDATE users SET b1 = b1 + ".($addonT+86400)." WHERE id = ".$session->uid."");
                    if($session->bonus2){ $addonT = 0; }else{ $addonT= time(); }
                    $database->queryFetch("UPDATE users SET b2 = b2 + ".($addonT+86400)." WHERE id = ".$session->uid."");
                    if($session->bonus3){ $addonT = 0; }else{ $addonT= time(); }
                    $database->queryFetch("UPDATE users SET b3 = b3 + ".($addonT+86400)." WHERE id = ".$session->uid."");
                    if($session->bonus4){ $addonT = 0; }else{ $addonT= time(); }
                    $database->queryFetch("UPDATE users SET b4 = b4 + ".($addonT+86400)." WHERE id = ".$session->uid."");
                        */
                    $database->query("UPDATE quests SET economy1 = '3,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                    
                }
                if($_POST['questTutorialId'] == 'Economy_02' && $session->qArrayE2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(160*SPEED).", clay = clay + ".(190*SPEED).", iron = iron + ".(150*SPEED).", crop = crop + ".(70*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET economy2 = '4,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Economy_03' && $session->qArrayE1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(250*SPEED).", clay = clay + ".(290*SPEED).", iron = iron + ".(100*SPEED).", crop = crop + ".(130*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    $database->query("UPDATE quests SET economy1 = '5,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Economy_04' && $session->qArrayE2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(400*SPEED).", clay = clay + ".(460*SPEED).", iron = iron + ".(330*SPEED).", crop = crop + ".(270*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    $database->query("UPDATE quests SET economy2 = '6,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Economy_05' && $session->qArrayE1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(240*SPEED).", clay = clay + ".(255*SPEED).", iron = iron + ".(190*SPEED).", crop = crop + ".(160*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    $database->query("UPDATE quests SET economy1 = '7,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Economy_06' && $session->qArrayE2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(600*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    $database->query("UPDATE quests SET economy2 = '8,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Economy_07' && $session->qArrayE1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(100*SPEED).", clay = clay + ".(99*SPEED).", iron = iron + ".(99*SPEED).", crop = crop + ".(99*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    $database->query("UPDATE quests SET economy1 = '9,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Economy_08' && $session->qArrayE2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(400*SPEED).", clay = clay + ".(400*SPEED).", iron = iron + ".(400*SPEED).", crop = crop + ".(200*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    $database->query("UPDATE quests SET economy2 = '10,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Economy_09' && $session->qArrayE1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(620*SPEED).", clay = clay + ".(730*SPEED).", iron = iron + ".(560*SPEED).", crop = crop + ".(230*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    $database->query("UPDATE quests SET economy1 = '11,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Economy_10' && $session->qArrayE2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(880*SPEED).", clay = clay + ".(1020*SPEED).", iron = iron + ".(590*SPEED).", crop = crop + ".(320*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    $database->query("UPDATE quests SET economy2 = '12,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Economy_11' && $session->qArrayE1[1]){
                    for($i=19;$i<39;$i++){
                        if($session->fData['f'.$i.''] == 1 && $session->fData['f'.$i.'t'] == 8){
                            $database->query("UPDATE fdata SET f$i = 2 WHERE vref = ".$_SESSION['wid']."");
                            $database->recountPop($_SESSION['wid']);
                            break;
                        }
                    }
                    $database->query("UPDATE quests SET economy1 = '0,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'Economy_12' && $session->qArrayE2[1]){

                    $p->updatePlus(2,86400);
                    $p->updatePlus(3,86400);
                    $p->updatePlus(4,86400);
                    $p->updatePlus(5,86400);
                    /*if($session->bonus1){ $addonT = 0; }else{ $addonT= time(); }
                    $database->queryFetch("UPDATE users SET b1 = b1 + ".($addonT+86400)." WHERE id = ".$session->uid."");
                    if($session->bonus2){ $addonT = 0; }else{ $addonT= time(); }
                    $database->queryFetch("UPDATE users SET b2 = b2 + ".($addonT+86400)." WHERE id = ".$session->uid."");
                    if($session->bonus3){ $addonT = 0; }else{ $addonT= time(); }
                    $database->queryFetch("UPDATE users SET b3 = b3 + ".($addonT+86400)." WHERE id = ".$session->uid."");
                    if($session->bonus4){ $addonT = 0; }else{ $addonT= time(); }
                    $database->queryFetch("UPDATE users SET b4 = b4 + ".($addonT+86400)." WHERE id = ".$session->uid."");
                    */
                    $database->query("UPDATE quests SET economy2 = '0,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }

                // World code
                if($_POST['questTutorialId'] == 'World_01' && $session->qArrayW1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(90*SPEED).", clay = clay + ".(120*SPEED).", iron = iron + ".(60*SPEED).", crop = crop + ".(30*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    $database->query("UPDATE quests SET world1 = '3,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_02' && $session->qArrayW2[1]){
                    $database->query("UPDATE users SET cp = cp + 100 WHERE id = ".$session->uid."");
                    // add 100 cp not loyality
                    /*
                    if($village->loyalty<=125){
                        $newTotal = $village->loyalty + 100;
                        if($newTotal > 125){
                            $database->setVillageField($village->wid, 'loyalty', 125);
                        }else{
                            $database->setVillageField($village->wid, 'loyalty', $newTotal);
                        }
                    }*/

                    $database->query("UPDATE quests SET world2 = '4,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_03' && $session->qArrayW1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(170*SPEED).", clay = clay + ".(100*SPEED).", iron = iron + ".(130*SPEED).", crop = crop + ".(70*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    $database->query("UPDATE quests SET world1 = '5,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_04' && $session->qArrayW2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(215*SPEED).", clay = clay + ".(145*SPEED).", iron = iron + ".(195*SPEED).", crop = crop + ".(50*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    
                    //
                    $database->query("UPDATE quests SET world2 = '6,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_05' && $session->qArrayW1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(90*SPEED).", clay = clay + ".(160*SPEED).", iron = iron + ".(90*SPEED).", crop = crop + ".(95*SPEED)."  WHERE wref = ".$_SESSION['wid']."");
                    //
                    
                    $database->sendMessage($session->uid, 6, 'wMSGT', 'wMSGI', 0, 0, 0, 0,0);

                    $database->query("UPDATE quests SET world1 = '7,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }

                if($_POST['questTutorialId'] == 'World_06' && $session->qArrayW2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(280*SPEED).", clay = clay + ".(315*SPEED).", iron = iron + ".(200*SPEED).", crop = crop + ".(145*SPEED)."  WHERE wref = ".$_SESSION['wid']."");                    
                    $database->query("UPDATE quests SET world2 = '8,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_07' && $session->qArrayW1[1]){
                    $database->queryFetch("UPDATE users SET gold = gold + 20  WHERE id = ".$session->uid."");

                    $database->query("UPDATE quests SET world1 = '9,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_08' && $session->qArrayW2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(295*SPEED).", clay = clay + ".(210*SPEED).", iron = iron + ".(235*SPEED).", crop = crop + ".(185*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET world2 = '10,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_09' && $session->qArrayW1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(570*SPEED).", clay = clay + ".(470*SPEED).", iron = iron + ".(560*SPEED).", crop = crop + ".(265*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET world1 = '11,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_10' && $session->qArrayW2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(525*SPEED).", clay = clay + ".(420*SPEED).", iron = iron + ".(620*SPEED).", crop = crop + ".(335*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET world2 = '12,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_11' && $session->qArrayW1[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(650*SPEED).", clay = clay + ".(800*SPEED).", iron = iron + ".(740*SPEED).", crop = crop + ".(530*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET world1 = '13,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_12' && $session->qArrayW2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(2650*SPEED).", clay = clay + ".(2150*SPEED).", iron = iron + ".(1810*SPEED).", crop = crop + ".(1320*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET world2 = '14,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_13' && $session->qArrayW1[1]){
                    $database->query("UPDATE users SET cp = cp + 500 WHERE id = ".$session->uid."");

                    $database->query("UPDATE quests SET world1 = '15,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_14' && $session->qArrayW2[1]){
                    $database->queryFetch("UPDATE vdata SET wood = wood + ".(1050*SPEED).", clay = clay + ".(800*SPEED).", iron = iron + ".(900*SPEED).", crop = crop + ".(750*SPEED)."  WHERE wref = ".$_SESSION['wid']."");

                    $database->query("UPDATE quests SET world2 = '0,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }
                if($_POST['questTutorialId'] == 'World_15' && $session->qArrayW1[1]){
                    $p->updatePlus(1,172800);
                    //if($session->plus){ $addonT = 0; }else{ $addonT= time(); }
                    //$database->queryFetch("UPDATE users SET plus = plus + ".($addonT+172800)." WHERE id = ".$session->uid."");

                    $database->query("UPDATE quests SET world1 = '0,0' WHERE userid = ".$session->uid."");
                    echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                }


            }else{
                $achievs=$database->getAchiev($session->uid);
                switch($_POST['questTutorialId']){
                    case "AchievementQuestReward_01":
                    $points=25;
                    //$reward=$achievs['reward1'];
                    $rData = explode(',',$achievs['reward1']);
                    if($rData[1]==0){
                        switch($rData[0]){
                            case 1:
                                $peoples=$database->query("SELECT wref FROM `vdata` WHERE `owner`='".$session->uid."' LIMIT 1");
                                $database->addAdventure($session->vid, $session->uid,5);
                                break;
                            case 2:
                                $database->setCelCp($session->uid,5000);
                                break;
                            case 3:
                                $r1=$r2=$r3=$r4=0;
                                ${'r'.(rand(1,4))}=HOWRES;
                                $database->modifyResource($_SESSION['wid'],$r1,$r2,$r3,$r4,1);
                                break;
                            }
                            
                            $database->query('UPDATE achiev SET reward1 = "'.$rData[0].',1" WHERE uid = '.$session->uid.'');
                        }
                        echo '{"response": {"error":false,"errorMsg":"","data":{"html":""},"reload":true}}';
                    break;
                    case "AchievementQuestReward_02":
                        $rData = explode(',',$achievs['reward2']);

                                $points=50;
                                $reward=$achievs['reward2'];
                                if($rData[1]==0){
                                    switch($rData[0]){
                                        case 1:  $plus="plus"; break;
                                        case 2:  $plus="b1";   break;
                                        case 3: $plus ="b2";  break;
                                        case 4: $plus ="b3";  break;
                                        case 5: $plus ="b4";  break;
                                    }
                                    $row =  $database->query("SELECT `".$plus."` FROM users WHERE `id` = '".$session->uid."'");
                                    $tip=$row[0][$plus];
                                    if ($tip==0 or $tip<time()){
                                        $time=time()+86400;
                                    }
                                    if($tip>time()){
                                        $time= $tip+86400;
                                    }
                                    $q = "UPDATE users SET `".$plus."`='".$time."' where  `id` =  '".$session->uid."'";
                                    $database->query($q);
                                    $database->query('UPDATE achiev SET reward2 = "'.$rData[0].',1" WHERE uid = '.$session->uid.'');
                                }
                                echo '{"response": {"error":false,"errorMsg":"","data":{"html":""},"reload":true}}';
                                break;
                                
                            case "AchievementQuestReward_03":
                                $rData = explode(',',$achievs['reward3']);

                                $points=75;
                                $reward=$achievs['reward3'];
                                if($rData[1]==0){
                                    switch($rData[0]){
                                        case 1:
                                            $peoples=$database->query("SELECT wref FROM `vdata` WHERE `owner`='".$session->uid."' LIMIT 1");
                                            
                                            $database->addAdventure($session->vid, $session->uid,20);
                                            break;
                                        case 2:
                                            $database->addHeroItem($session->uid, 12, 0, 1);
                                            $database->addHeroItem($session->uid, 12, 0, 1);
                                            //дinа inедра
                                            break;
                                        case 3:
                                            $database->setSilver($session->uid,1000,1);
                                            break;
                                    }
                                    $database->query('UPDATE achiev SET reward3 = "'.$rData[0].',1" WHERE uid = '.$session->uid.'');                                }
                                echo '{"response": {"error":false,"errorMsg":"","data":{"html":""},"reload":true}}';
                                break;
                            case "AchievementQuestReward_04":
                                $rData = explode(',',$achievs['reward4']);

                                $points=100;
                                $reward=$achievs['reward4'];
                                if($rData[1]==0){
                                    switch($rData[0]){
                                        case 1:
                                            $database->modifyGold($session->uid,40,1);
                                            break;
                                        case 2:
                                            $database->setSilver($session->uid,4000,1);
                                            //дinа inедра
                                            break;
                                        case 3:
                                            $peoples=$database->query("SELECT wref FROM `vdata` WHERE `owner`='".$session->uid."' LIMIT 1");
                                            $database->addAdventure($session->vid, $session->uid,50);
                                            break;
                                    }
                                    $database->query('UPDATE achiev SET reward4 = "'.$rData[0].',1" WHERE uid = '.$session->uid.'');                                }
                                echo '{"response": {"error":false,"errorMsg":"","data":{"html":""},"reload":true}}';
                                break;

                        }
                /*case 'AchievementQuestReward_01':
                break;*/
            }
        }else{
            if(isset($_POST['questTutorialId'])){
            switch($_POST['questTutorialId']){
                    case 'Tutorial_01':
                        echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(1)).',"infoIcon":"","cssClass":"white questInformation Tutorial_01 tutorial"}}}';
                    break;
                    
                    case 'Tutorial_02':
                        if($session->questNum == 2 && $session->qData['step1'] == 1 && $session->qData['step2'] == 0){
                            $database->query("UPDATE quests SET step2 = 1 WHERE userid = ".$session->uid."");
                            echo '{"response": {"error":false,"errorMsg":"","data":{"html":""},"reload":true}}';
                        }else{
                            $database->query("UPDATE quests SET step1 = 1 WHERE userid = ".$session->uid."");
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(2)).',"infoIcon":"","cssClass":"white questInformation Tutorial_02 tutorial"}}}';
                    }
                    break;

                    case 'Tutorial_03': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(3)).',"infoIcon":"","cssClass":"white questInformation Tutorial_03 tutorial"}}}'; break;
                    case 'Tutorial_04': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(4)).',"infoIcon":"","cssClass":"white questInformation Tutorial_04 tutorial"}}}'; break;
                    case 'Tutorial_05': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(5)).',"infoIcon":"","cssClass":"white questInformation Tutorial_05 tutorial"}}}';break;
                    case 'Tutorial_06': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(6)).',"infoIcon":"","cssClass":"white questInformation Tutorial_06 tutorial"}}}'; break;
                    case 'Tutorial_07': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(7)).',"infoIcon":"","cssClass":"white questInformation Tutorial_07 tutorial"}}}'; break;
                    case 'Tutorial_08': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(8)).',"infoIcon":"","cssClass":"white questInformation Tutorial_08 tutorial"}}}'; break;
                    case 'Tutorial_09': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(9)).',"infoIcon":"","cssClass":"white questInformation Tutorial_09 tutorial"}}}'; break;
                    case 'Tutorial_10': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(10)).',"infoIcon":"","cssClass":"white questInformation Tutorial_10 tutorial"}}}'; break;
                    case 'Tutorial_11': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(11)).',"infoIcon":"","cssClass":"white questInformation Tutorial_11 tutorial"}}}'; break;
                    case 'Tutorial_12': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(12)).',"infoIcon":"","cssClass":"white questInformation Tutorial_12 tutorial"}}}'; break;
                    case 'Tutorial_13': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(13)).',"infoIcon":"","cssClass":"white questInformation Tutorial_13 tutorial"}}}'; break;
                    case 'Tutorial_14': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(14)).',"infoIcon":"","cssClass":"white questInformation Tutorial_14 tutorial"}}}'; break;
                    case 'Tutorial_15': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(15)).',"infoIcon":"","cssClass":"white questInformation Tutorial_15 tutorial"}}}'; break;
                    case 'Battle_01': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(1,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_02': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(2,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_03': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(3,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_04': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(4,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_05': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(5,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_06': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(6,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_07': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(7,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_08': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(8,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_09': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(9,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_10': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(10,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_11': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(11,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_12': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(12,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_13': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(13,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_14': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(14,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Battle_15': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(15,1)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_01': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(1,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_02': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(2,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_03': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(3,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_04': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(4,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_05': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(5,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_06': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(6,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_07': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(7,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_08': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(8,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_09': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(9,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_10': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(10,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_11': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(11,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'Economy_12': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(12,2)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_01': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(1,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_02': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(2,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_03': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(3,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_04': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(4,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_05': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(5,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_06': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(6,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_07': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(7,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_08': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(8,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_09': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(9,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_10': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(10,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_11': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(11,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_12': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(12,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_13': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(13,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_14': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(14,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    case 'World_15': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData(15,3)).',"infoIcon":"","cssClass":""}}}'; break;
                    
                    case 'AchievementQuest_01': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->achQuest(1)).',"infoIcon":"","cssClass":"white questInformation AchievementQuest_01 quest"}}}'; break;
                    case 'AchievementQuest_02': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->achQuest(2)).',"infoIcon":"","cssClass":"white questInformation AchievementQuest_02 quest"}}}'; break;
                    case 'AchievementQuest_03': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->achQuest(3)).',"infoIcon":"","cssClass":"white questInformation AchievementQuest_03 quest"}}}'; break;
                    case 'AchievementQuest_04': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->achQuest(4)).',"infoIcon":"","cssClass":"white questInformation AchievementQuest_04 quest"}}}'; break;
                    case 'AchievementQuest_05': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->achQuest(5)).',"infoIcon":"","cssClass":"white questInformation AchievementQuest_05 quest"}}}'; break;
                    case 'AchievementQuest_06': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->achQuest(6)).',"infoIcon":"","cssClass":"white questInformation AchievementQuest_06 quest"}}}'; break;
                    case 'AchievementQuest_07': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->achQuest(7)).',"infoIcon":"","cssClass":"white questInformation AchievementQuest_07 quest"}}}'; break;
                    case 'AchievementQuest_08': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->achQuest(8)).',"infoIcon":"","cssClass":"white questInformation AchievementQuest_08 quest"}}}'; break;
                    case 'AchievementQuest_09': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->achQuest(9)).',"infoIcon":"","cssClass":"white questInformation AchievementQuest_09 quest"}}}'; break;
                    case 'AchievementQuest_10': echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->achQuest(10)).',"infoIcon":"","cssClass":"white questInformation AchievementQuest_10 quest"}}}'; break;
                    
                    case "AchievementQuestReward_01":
                    case "AchievementQuestReward_02":
                    case "AchievementQuestReward_03":
                    case "AchievementQuestReward_04":
                        preg_match('!\d+!', $_POST['questTutorialId'], $id);
                        echo $quest->dailyReward((int)$id[0]);
                    break;

                        case "Tutorial_01":

                                echo '{"response": {"error":false,"errorMsg":null,"data":{"html":""}}}';
                                break;



                    default:
                    echo '{"response": {"error":false,"errorMsg":null,"data":{"html":""}}}';
                }
            
        }else{
            echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($quest->questData('all')).',"infoIcon":"http://t4.answers.travian.com//index.php?aid=285#go2answer","cssClass":"white questTodoList"}}}';

        }
    }


        break;


    case 'dailyquests':
        $acData = $database->queryFetch("SELECT * FROM achiev WHERE uid = ".$session->uid."");
        $achievs=$database->getAchiev($session->uid);

        $rData1 = explode(',',$achievs['reward1']);
        $rData2 = explode(',',$achievs['reward2']);
        $rData3 = explode(',',$achievs['reward3']);
        $rData4 = explode(',',$achievs['reward4']);
        
        $points['1']=$achievs['a1'];
        $points['2']=$achievs['a2'];
        $points['3']=$acData['a3'];
        $points['4']=$achievs['a4'];
        $points['5']=$achievs['a5'];
        $points['6']=$achievs['a6'];
        $points['7']=$achievs['a7'];

        if($achievs['a8']/5 != 0){
            if(floor($achievs['a8']/5) >= 4 && floor($achievs['a8']/5) < 8){
                $points['8'] = 4;
            }elseif(floor($achievs['a8']/5) >= 8 && floor($achievs['a8']/5) > 4 && floor($achievs['a8']/5) < 12){
                $points['8'] = 8;
            }elseif(floor($achievs['a8']/5) >= 12 && floor($achievs['a8']/5) > 8){
                $points['8'] = 12;
            }else{
                $points['9'] = 0;
            }
        }else{
            $points['8'] = 0;
        }

        if($achievs['a9']/5 != 0){
            if(floor($achievs['a9']/5) >= 4 && floor($achievs['a9']/5) < 8){
                $points['9'] = 4;
            }elseif(floor($achievs['a9']/5) >= 8 && floor($achievs['a9']/5) > 4 && floor($achievs['a9']/5) < 12){
                $points['9'] = 8;
            }elseif(floor($achievs['a9']/5) >= 12 && floor($achievs['a9']/5) > 8){
                $points['9'] = 12;
            }else{
                $points['9'] = 0;
            }
        }else{
            $points['9'] = 0;
        }

        $points['10']=$achievs['a10'];

        $done= 'class="hook done" title=" '.questday0.' "';
        $notdone= 'class="hook working" title="'.questday1.' "';
        $hide='class="hook hide"';
        $astatus[1]= $acData['a1'] == 5 ? $done : $hide;
        $astatus[2]= $acData['a2'] == 9 ? $done : (($acData['a2'] > 0) ? $notdone:$hide);
        $astatus[3]= $acData['a3'] == 9 ? $done : (($acData['a3'] > 0) ? $notdone:$hide);
        $astatus[4]= $acData['a4'] == 5 ? $done : $hide;
        $astatus[5]= $acData['a5'] == 6 ? $done : (($acData['a5'] > 0) ? $notdone:$hide);
        $astatus[6]= $acData['a6'] == 12 ? $done : (($acData['a6'] > 0) ? $notdone:$hide);
        $astatus[7]= $acData['a7'] == 15 ? $done : (($acData['a7'] > 0) ? $notdone:$hide);
        $astatus[8]= $acData['a8'] == 60 ? $done : (($acData['a8'] > 0) ? $notdone:$hide);
        $astatus[9]= $acData['a9'] == 60 ? $done : (($acData['a9'] > 0) ? $notdone:$hide);
        $astatus[10]= $acData['a10'] == 15 ? $done : (($acData['a10'] > 0) ? $notdone:$hide);

        $sum=array_sum($points);

        $database->query("UPDATE `achiev` SET `points`='".$sum."' WHERE `uid`='".$session->uid."'");
        if($_COOKIE['lang']=='en'){
            $group=($achievs['a7']==0)?" onclick=\"window.location.href = 'dorf".$_SESSION['dorf'].".php?visit=1'; window.open ('https://www.facebook.com/groups/1661431057497115/');\"":"";
        }else{
            $group=($achievs['a7']==0)?" onclick=\"window.location.href = 'dorf".$_SESSION['dorf'].".php?visit=1'; window.open ('https://www.facebook.com/groups/1661431057497115/');\"":"";
        }
        $title1=(!$rData1[1])?questday4."<br/>
        <ul>
            <li>".questday5."</li>


            <li>".questday6."</li>

            <li>".questday7."</li>

        </ul>":"".questday40."<br /> ".constant("questday".($rData1[0]+4));
$title2= (!$rData2[1])?questday8."<br/>
<ul>
    <li>".questday9."</li>

    <li>".questday10."</li>

    <li>".questday11."</li>

    <li>".questday12."</li>

    <li>".questday13."</li>

</ul>":"reward :<br /> ".constant("questday".($rData2[0]+8));
        $title3=(!$rData3[1])?questday14."<br/>
<ul>
    <li>".questday15."</li>

    <li>".questday16."</li>

    <li>".questday17."</li>

</ul>":"reward :<br /> ".constant("questday".($rData3[0]+13));
        $title4=(!$rData4[1])?questday18."<br/>
<ul>
    <li>".questday19."</li>

    <li>".questday20." </li>
    <li>".questday21." </li>

</ul>":"".questday40."<br /> ".constant("questday".($rData4[0]+18));
$html = json_encode("<div class=\"questWrapper achievements mainDialog\">
<div class=\"birthdayRibbonContainer\">
    <div class=\"headline\"> ".questday2."</div>
</div>
<div class=\"clear\"></div>
<div class=\"pointsAndAchievements\">
    <div class=\"achievementPoints\">
        <div class=\"points\"> ".$sum."</div>
        <div class=\"pointstext\"> ".questday3."</div>
    </div>
    <div id=\"achievementRewardList\">
        <div class=\"verticalLine\"></div>
        <div class=\"achievementArrow\"><img src=\"img/x.gif\"/></div>
        <div class=\"achievement\" title=\"".$title1."\">
        
        ".(($sum>=25 && $rData1[1]==0) ? "
        <a data-questid=\"AchievementQuestReward_01\" data-category=\"achievementrewards\" class=\"quest\" href=\"#\">
        <div class=\"bigSpeechBubble rewardReady\">
            <img src=\"img/x.gif\" alt=\"\">
        </div>":(($sum>=25 && $rData1[1]>0)?"
        <div class=\"hook points_25\">
            <img src=\"img/x.gif\" alt=\"\">
        </div>":""))."
        <div class=\"pointAmount points_25\"> 25
    </div>
    <img src=\"img/x.gif\" class=\"points_25 ".(($sum<25)?('in'):(''))."active\" />
    </a>
</div>
<div class=\"achievementArrow\"><img src=\"img/x.gif\"/></div>
<div class=\"achievement\" title=\"".$title2."
\">
        ".(($sum>=50 && $rData2[1]==0)?"
        <a data-questid=\"AchievementQuestReward_02\" data-category=\"achievementrewards\" class=\"quest\" href=\"#\">
        <div class=\"bigSpeechBubble rewardReady\">
                                    <img src=\"img/x.gif\" alt=\"\">
                                </div>":(($sum>=50 && $rData2[1]>0)?"
                            <div class=\"hook points_50\">
                                <img src=\"img/x.gif\" alt=\"\">
                            </div>
                            ":""))."
<div class=\"pointAmount points_50\">                                50                            </div>
<img src=\"img/x.gif\" class=\"points_50 ".(($sum<50)?('in'):(''))."active\" />     </a>                   </div>
<div class=\"achievementArrow\"><img src=\"img/x.gif\"/></div>
<div class=\"achievement\" title=\"".$title3."
\">
        ".(($sum>=75 && $rData3[1]==0)?"
        <a data-questid=\"AchievementQuestReward_03\" data-category=\"achievementrewards\" class=\"quest\" href=\"#\">
        <div class=\"bigSpeechBubble rewardReady\">
                                    <img src=\"img/x.gif\" alt=\"\">
                                </div>":(($sum>=75 && $rData3[1]>0)?"
                            <div class=\"hook points_75\">
                                <img src=\"img/x.gif\" alt=\"\">
                            </div>
                            ":""))."
<div class=\"pointAmount points_75\">                                75                            </div>
<img src=\"img/x.gif\" class=\"points_75 ".(($sum<75)?('in'):(''))."active\" />         </a>               </div>
<div class=\"achievementArrow\"><img src=\"img/x.gif\"/></div>
<div class=\"achievement\" title=\"".$title4."
\">
        ".(($sum>=100 && $rData4[1]==0)?"
        <a data-questid=\"AchievementQuestReward_04\" data-category=\"achievementrewards\" class=\"quest\" href=\"#\">
        <div class=\"bigSpeechBubble rewardReady\">
                                    <img src=\"img/x.gif\" alt=\"\">
                                </div>":(($sum>=100 && $rData4[1]>0)?"
                            <div class=\"hook points_100\">
                                <img src=\"img/x.gif\" alt=\"\">
                            </div>
                           ":""))."
<div class=\"pointAmount points_100\">                                100                            </div>
<img src=\"img/x.gif\" class=\"points_100 ".(($sum<100)?'in':'')."active\" />                </a>        </div>        </div>    </div>
<div class=\"clear\"></div>
<hr class=\"achievementLine\"/>
<div class=\"achievement\" ><h1 class=\"questList\">".questday22."</h1>

    <div class=\"nextReset\">".questday23."</div>
    <table id=\"achievementQuestList\">
        <tr class=\"\">
            <td class=\"hook\"><img src=\"img/x.gif\" ".$astatus[1]."/></td>
            <td class=\"steps\">".($acData['a1'] / 5)."/1</td>
            
            <td class=\"questName\">
            ".($acData['a1'] < 5 ? '<a href="#" class="quest" data-category="achievementquests" data-questid="AchievementQuest_01">' : '')."
            ".$lang['Daily']['01']."
            ".($acData['a1'] < 5 ? '</a>' : '')."
            </td>
            <td class=\"points\">+ ".$points['1']." / 5</td>
        </tr>
        <tr class=\"zebra\">
            <td class=\"hook\"><img src=\"img/x.gif\" ".$astatus[2]."/></td>
            <td class=\"steps\">".($acData['a2'] / 3)."/3</td>
            <td class=\"questName\">
            ".($acData['a2'] < 9 ? '<a href="#" class="quest" data-category="achievementquests" data-questid="AchievementQuest_02">' : '')."
            ".$lang['Daily']['02']."
            ".($acData['a2'] < 9 ? '</a>' : '')."
            </td>
            <td class=\"points\">+ ".$points['2']." / 9</td>
        </tr>
        <tr class=\"\">
            <td class=\"hook\"><img src=\"img/x.gif\" ".$astatus[3]."/></td>
            <td class=\"steps\">".($acData['a3'] / 3)."/3</td>
            <td class=\"questName\">
            ".($acData['a3'] < 9 ? '<a href="#" class="quest" data-category="achievementquests" data-questid="AchievementQuest_03">' : '')."
            ".$lang['Daily']['03']."
            ".($acData['a3'] < 9 ? '</a>' : '')."
            </td>
            <td class=\"points\">+ ".$points['3']." / 9</td>
        </tr>
        <tr class=\"zebra\">
            <td class=\"hook\"><img src=\"img/x.gif\" ".$astatus[4]."/></td>
            <td class=\"steps\">".($acData['a4'] / 5)."/1</td>
            <td class=\"questName\">
            ".($acData['a4'] < 5 ? '<a href="#" class="quest" data-category="achievementquests" data-questid="AchievementQuest_04">' : '')."
            ".$lang['Daily']['04']."
            ".($acData['a4'] < 5 ? '</a>' : '')."
            </td>
            <td class=\"points\">+ ".$points['4']." / 5</td>
        </tr>
        <tr class=\"\">
            <td class=\"hook\"><img src=\"img/x.gif\" ".$astatus[5]."/></td>
            <td class=\"steps\">".($achievs['a5']/2)."/3</td>
            <td class=\"questName\">
            ".($acData['a5'] < 6 ? '<a href="#" class="quest" data-category="achievementquests" data-questid="AchievementQuest_05">' : '')."
            ".$lang['Daily']['05']."
            ".($acData['a5'] < 6 ? '</a>' : '')."
            </td>
            <td class=\"points\">+ ".$points['5']." / 6</td>
        </tr>
        <tr class=\"zebra\">
            <td class=\"hook\"><img src=\"img/x.gif\" ".$astatus[6]."/></td>
            <td class=\"steps\">".($acData['a6']/4)."/3</td>
            <td class=\"questName\">
            ".($acData['a6'] < 12 ? '<a href="#" class="quest" data-category="achievementquests" data-questid="AchievementQuest_06">' : '')."
            ".$lang['Daily']['06']."
            ".($acData['a6'] < 12 ? '</a>' : '')."
            </td>
            <td class=\"points\">+ ".$points['6']." / 12</td>
        </tr>
        <tr class=\"\">
            <td class=\"hook\"><img src=\"img/x.gif\" ".$astatus[7]."/></td>
            <td class=\"steps\">".($acData['a7']/5)."/3</td>
            <td class=\"questName\">
            ".($acData['a7'] < 15 ? '<a href="#" class="quest" data-category="achievementquests" data-questid="AchievementQuest_07">' : '')."
            ".$lang['Daily']['07']."
            ".($acData['a7'] < 15 ? '</a>' : '')."
            </td>
            <td class=\"points\">+ ".$points['7']." / 15</td>
        </tr>
    <tr class=\"zebra\">
            <td class=\"hook\"><img src=\"img/x.gif\" ".$astatus[8]."/></td>
            <td class=\"steps\">".floor($achievs['a8']/20)."/3</td>
            <td class=\"questName\">
            ".($acData['a8'] < 12 ? '<a href="#" class="quest" data-category="achievementquests" data-questid="AchievementQuest_08">' : '')."
            ".$lang['Daily']['08']."
            ".($acData['a8'] < 12 ? '</a>' : '')."
            </td>
            <td class=\"points\">+ ".($points['8'])." / 12</td>
        </tr>
        <tr class=\"\">
            <td class=\"hook\"><img src=\"img/x.gif\" ".$astatus[9]."/></td>
            <td class=\"steps\">".floor($achievs['a9']/20)."/3</td>
            <td class=\"questName\">
            ".($acData['a9'] < 60 ? '<a href="#" class="quest" data-category="achievementquests" data-questid="AchievementQuest_09">' : '')."
            ".$lang['Daily']['09']."
            ".($acData['a9'] < 60 ? '</a>' : '')."
            </td>
            <td class=\"points\">+ ".($points['9'])." / 12</td>
        </tr>
    <tr class=\"zebra\">
            <td class=\"hook\"><img src=\"img/x.gif\" ".$astatus[10]."/></td>
            <td class=\"steps\">".($achievs['a10']/5)."/3</td>
            <td class=\"questName\">
            ".($acData['a10'] < 15 ? '<a href="#" class="quest" data-category="achievementquests" data-questid="AchievementQuest_10">' : '')."
            ".$lang['Daily']['10']."
            ".($acData['a10'] < 15 ? '</a>' : '')."
            </td>
            <td class=\"points\">+ ".($points['10'])." / 15</td>
        </tr>
    </table>
</div></div>
<script type=\"text/javascript\">

Travian.Game.Quest.bindListDelegation('achievementQuestList');
Travian.Game.Quest.bindListDelegation('achievementRewardList');
Travian.Tip.refresh();
</script>");
        echo '
{
	"response": {"error":false,"errorMsg":null,"data":{"html":'.$html.'}}
}';
        break;
    case 'silverExchange' :
        if($_SESSION['s4']){
            $silver=$_POST['s'];
            if(!intval($_POST['s'])){exit;}
            $goldblya=floor($silver/200);

            if($silver>=200 && $session->silver>=$silver){

                $golds = "+ ".$goldblya;
                $silvers = "- ".$goldblya*200;
                $database->query("UPDATE users SET gold = gold ".$golds.", silver = silver ".$silvers."  WHERE id = '".$session->uid."'");
                echo '{"response":{"error":false,"errorMsg":null,"data":{"oldSilver":'.$session->silver.',"result":true,"type":"SilverToGold","silver":'.$silver.',"gold":'.$goldblya.',"newSilver":'.($_SESSION['silver']-$goldblya*200).',"newGold":'.($_SESSION['gold']+$goldblya).',"message":{"type":"info","message":"\u003Cimg src=\u0022img\/x.gif\u0022 class=\u0022silver\u0022 alt=\u0022\u0627\u0644\u0641\u0636\u0647\u0022 title=\u0022\u0627\u0644\u0641\u0636\u0647\u0022 \/\u003E '.($goldblya*200).' \u062a\u062d\u0648\u064a\u0644 \u0625\u0644\u0649 \u003Cimg src=\u0022img\/x.gif\u0022 class=\u0022gold\u0022 alt=\u0022\u0627\u0644\u0630\u0647\u0628\u0022 title=\u0022\u0627\u0644\u0630\u0647\u0628\u0022 \/\u003E '.$goldblya.'"}}}}';
            }
            
        }
        break;


    case 'heroSetAttributes':
        $uid=$session->uid;
        $heroD=$database->WowSoQueryH($uid);

        $att=$prod=$abon=$dbon=0;
        $att=intval($database->FilterIntValue($_POST['attributes']['power']));
        $abon=intval($database->FilterIntValue($_POST['attributes']['offBonus']));
        $dbon=intval($database->FilterIntValue($_POST['attributes']['defBonus']));
        $prod=intval($database->FilterIntValue($_POST['attributes']['productionPoints']));
        if(!in_array($_POST['resource'],array(0,1,2,3,4))){ echo 'Burn motherfucker,burn.';die;}
        if(($att > 0 OR  $abon > 0 OR $dbon > 0 OR $prod > 0) AND ($att >= 0 and  $abon >= 0 and $dbon >= 0 and $prod >= 0) ){
            $points=$att+$abon+$dbon+$prod;
            $availiblepoint=$heroD['level']*4;
            $freepoints=$availiblepoint-($heroD['power']+$heroD['offBonus']+$heroD['defBonus']+$heroD['product']);
            $ost=$freepoints-$points;

            if($ost>=0 && $ost!=$freepoints){

                if(($heroD['power']+$att)<100){
                    $database->query("UPDATE hero SET `power` = `power`+".$att." WHERE `uid` = '" . $uid . "'");
                }elseif($att>0){ $database->query("UPDATE hero SET `power` = 100 WHERE `uid` = '" . $uid . "'");}
                if(($heroD['offBonus']+$abon)<100){
                    $database->query("UPDATE hero SET `offBonus` = `offBonus`+".$abon." WHERE `uid` = '" . $uid . "'");
                }elseif($abon>0){$database->query("UPDATE hero SET `offBonus` = 100 WHERE `uid` = '" . $uid . "'");}
                if(($heroD['defBonus']+$dbon)<100){
                    $database->query("UPDATE hero SET `defBonus` = `defBonus`+".$dbon." WHERE `uid` = '" . $uid . "'");
                }elseif($dbon>0){$database->query("UPDATE hero SET `defBonus` = 100 WHERE `uid` = '" . $uid . "'");}
                if(($heroD['product']+$prod)<100){
                    $database->query("UPDATE hero SET `product` = `product`+".$prod." WHERE `uid` = '" . $uid . "'");}
                else{$database->query("UPDATE hero SET `product` = 100 WHERE `uid` = '" . $uid . "'");}
            }


        }
        if($_POST['attackBehaviour']=='fight'){
            $database->modifyHero2('hide', 0, $session->uid, 0);
        }
        if($_POST['attackBehaviour']=='hide'){
            $database->modifyHero2('hide', 1, $session->uid, 0);
        }

        for($i=0;$i<=4;$i++){
            if($_POST['resource'] == $i){
                if($session->qData['quest'] == 6 && $session->qData['step1'] == 1){
                    if($i == 2){
                        $database->query("UPDATE quests SET step2 = 1,isFinished=1 WHERE userid = ".$session->uid."");
                    }
                }
                
                $database->modifyHero2('r'.$i, 1, $session->uid, 0);
            }else{
                $database->modifyHero2('r'.$i, 0, $session->uid, 0);
            }


        }
        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
        //echo '{"response": {"error":false,"errorMsg":null,"data":{"functionToCall":"reloadUrl","options":{"html":""}}}}';
        //header('Location: hero_inventory.php');
        break;
    case 'buyplus':
		//print_r($_GET); die();
        session_start();
        $id=$_GET['id'];
        $uid=$session->uid;
        if($_SESSION['s4']){
        //include_once("application/Database.php");
        $gol= $database->query("SELECT `gold` FROM users WHERE `id`='".$uid."'");
        $gold=$gol[0]['gold'];
        switch($id) {
			case 6: $cost=COSTCP;break;
            case 8:  $type="plus"; $cost=20; break;
            case 9:  $type="b1";   $cost=5; break;
            case 10: $type ="b2";  $cost=5; break;
            case 11: $type ="b3";  $cost=5; break;
            case 12: $type ="b4";  $cost=5; break;
            case 13: $cost=COSTRES; break;
			case 14: if(FINISH_ALL){ $cost=FINISH_ALL_COST; } break;
			case 15: $cost=750;break;
			case 16: $cost=0;break;
           
        }
        if($gold-$cost>=0){
            if($session->acData['a5'] < 6){
                $database->UpdateAchievU($uid,"`a5`=a5+2");
            }
            if($id>7 && $id<13){
                $database->buyPlus($type,$cost,$uid,$gold);
            }elseif($id==13){
               // if(in_array($_GET['r'],array(HOWRES,10000000,50000000,300000000))){
                if($_GET['r']==HOWRES){
                   // switch($_GET['r']){
                     //   case HOWRES:
                    $costs=COSTRES;
                    //break;
                     //   case 10000000:$costs=30;break;
                     //   case 50000000:$costs=100;break;
                     //   case 300000000:$costs=300;break;
                   // }
                    $database->buyRes($uid,$gold,$_SESSION['wid'],$costs,$_GET['r']);
                }
            }elseif ($id == 6) {
                $database->buyCp($uid);
            }elseif ($id == 14) {
                if(FINISH_ALL){ 
                    $database->fastTraining($uid,$_SESSION['wid']);
                }
			}elseif ($id == 15) {
				for($tralivali = 0; $tralivali < 14; $tralivali++) {
				$database->buyPlus("plus",0,$uid,$gold);
				$database->buyPlus("b1",0,$uid,$gold);
				$database->buyPlus("b2",0,$uid,$gold);
				$database->buyPlus("b3",0,$uid,$gold);
				$database->buyPlus("b4",0,$uid,$gold);
				}
				$database->setAccountType($uid,1);
			}elseif ($id == 16){
				$database->setAccountType($uid,2);
			}
        }
        echo '{"response": {"error":false,"errorMsg":null,"data":{}}}';
        }
        break;
    case 'viewTileDetails':
        $x = $_POST['x'];
        $y = $_POST['y'];
        ob_start(); // begin collecting output

        include 'application/views/Map/vildialog.php';
        $html = ob_get_clean(); // retrieve output from myfile.php, stop buffering
        echo json_encode( array('response' => array('data'=>array('html' => $html))) );
        break;
    case 'changeVillageName':
        $_POST['name']=$database->RemoveXSS($_POST['name']);
        if(str_replace(" ","",$_POST['name'])!=''){
            $_POST['name'] = str_replace( ',', ' ', $_POST['name'] );
            $p=array('N'=>$_POST['name'],'D'=>$_POST['did']);
            $database->query("UPDATE vdata SET `name` = :N where `wref` = :D",$p);

            if($session->qArrayW2[0] == 2 && $session->qArrayW2[1] == 0){
                $database->query("UPDATE quests SET world2='2,1' WHERE userid = ".$session->uid."");
                echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
            }else{
                echo json_encode( array('response' => array('data' => array('name'=>$_POST['name'],'bname'=>$_POST['name']))) );
            }
        }
        break;

    case 'heroEditor':

        //echo '{"response":{"error":false,"errorMsg":null,"data":{"attributes":{"headProfile":54,"hairColor":1501,"hairStyle":1001,"ears":2000,"eyebrow":7001,"eyes":4000,"nose":3001,"mouth":6003,"beard":5003,"gender":"male"},"html":"<img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"http:\/\/vip4.ttwars.com\/\/img\/hero\/male\/head\/254x330\/face0.png\" alt=\"\" \/>\n            <img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"http:\/\/vip4.ttwars.com\/\/img\/hero\/male\/head\/254x330\/eye\/eye0.png\" alt=\"\" \/>\n            <img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"http:\/\/vip4.ttwars.com\/\/img\/hero\/male\/head\/254x330\/eyebrow\/eyebrow1-brown.png\" alt=\"\" \/>\n            <img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"http:\/\/vip4.ttwars.com\/\/img\/hero\/male\/head\/254x330\/hair\/hair1-brown.png\" alt=\"\" \/>\n            <img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"http:\/\/vip4.ttwars.com\/\/img\/hero\/male\/head\/254x330\/face\/face4.png\" alt=\"\" \/>\n            <img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"http:\/\/vip4.ttwars.com\/\/img\/hero\/male\/head\/254x330\/mouth\/mouth3.png\" alt=\"\" \/>\n            <img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"http:\/\/vip4.ttwars.com\/\/img\/hero\/male\/head\/254x330\/nose\/nose1.png\" alt=\"\" \/>\n            <img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"http:\/\/vip4.ttwars.com\/\/img\/hero\/male\/head\/254x330\/ear\/ear0.png\" alt=\"\" \/>            <img style=\"width:254px; height:330px; position:absolute;left:0px;top:0px;\" src=\"http:\/\/vip4.ttwars.com\/\/img\/hero\/male\/head\/254x330\/beard\/beard3-brown.png\" alt=\"\" \/>"}}}';
        /*
        Random -> Array ( [cmd] => heroEditor [action] => random [attribs] => Array ( [headProfile] => 2 [hairColor] => 1 [hairStyle] => 4 [ears] => 3 [eyebrow] => 4 [eyes] => 0 [nose] => 0 [mouth] => 1 [beard] => 4 [gender] => male ) [ajaxToken] => de3768730d5610742b5245daa67b12cd )
        Save -> Array ( [cmd] => heroEditor [action] => save [attribs] => Array ( [headProfile] => 2 [hairColor] => 1 [hairStyle] => 4 [ears] => 3 [eyebrow] => 4 [eyes] => 0 [nose] => 0 [mouth] => 1 [beard] => 4 [gender] => male ) [ajaxToken] => de3768730d5610742b5245daa67b12cd )
        //print_r($_POST); die();
        */
        //include_once("application/Database.php");
        $herodetail = $heroD=$database->WowSoQueryH($session->uid);
        $getcolor = $herodetail['color'];
        if($herodetail['gender']==0) {$gstr='male';} else {$gstr='female';}
        $gender=$herodetail['gender'];
        $geteye = $herodetail['eye'];if ($gender==0) $geteye%=5;
        $geteyebrow = $herodetail['eyebrow'];if ($gender==0) $geteyebrow%=5;
        $getnose = $herodetail['nose'];if ($gender==0) $getnose%=5;
        $getear = $herodetail['ear'];if ($gender==0) $getear%=5;
        $getmouth = $herodetail['mouth'];if ($gender==0) $getmouth%=4;
        $getbeard = $herodetail['beard']; if ($gender==1) $getbeard=5;
        $gethair = $herodetail['hair'];if ($gender==0) $gethair%=5;
        $getface = $herodetail['face'];if ($gender==0) $getface%=5;
        $head = $_POST['attribs']['headProfile'];
        $color = $_POST['attribs']['hairColor'];
        $hair = $_POST['attribs']['hairStyle'];
        $ear = $_POST['attribs']['ears'];
        $eyebrow = $_POST['attribs']['eyebrow'];
        $eye = $_POST['attribs']['eyes'];
        $nose = $_POST['attribs']['nose'];
        $mouth = $_POST['attribs']['mouth'];
        $beard = $_POST['attribs']['beard'];
        if($beard == 5999) $beard = -1; // some fix
        if($head != $getface){					$atrface = $head;					if ($gender==0) $atrface%=5;				}
        else{					$atrface = $getface;				}
        if($hair != $gethair){					$atrhair = $hair;					if ($gender==0) $atrhair%=5;				}
        else{					$atrhair = $gethair;				}
        if($ear != $getear){					$atrear = $ear;					if ($gender==0) $atrear%=5;				}
        else{					$atrear = $getear;				}
        if($eye != $geteye){					$atreye = $eye;					if ($gender==0) $atreye%=5;				}
        else{					$atreye = $geteye;				}
        if($mouth != $getmouth){					$atrmouth = $mouth;					if ($gender==0) $atrmouth%=5;				}
        else{					$atrmouth = $getmouth;				}
        if($beard != $getbeard){					$atrbeard = $beard;					if ($gender==0) $atrbeard%=5;				}
        else{					$atrbeard = $getbeard;				}
        if($nose != $getnose){					$atrnose = $nose;					if ($gender==0) $atrnose%=5;				}
        else{					$atrnose = $getnose;				}
        if($eyebrow != $geteyebrow){					$atreyebrow = $eyebrow;					if ($gender==0) $atreyebrow%=5;				}
        else{					$atreyebrow = $geteyebrow;				}
        if($color != $getcolor){					$atrcolor = $color;		}
        else{					$atrcolor = $getcolor;				}
        if($atrcolor==0){
            $color = "black";
        }
        if($atrcolor==1){
            $color = "brown";
        }
        if($atrcolor==2){
            $color = "darkbrown";
        }
        if($atrcolor==3){
            $color = "yellow";
        }
        if($atrcolor==4){
            $color = "red";
        }
        include_once("application/views/Ajax/heroeditor.tpl");
        
        break;

    case 'overlay':
        if($session->qData['quest'] == 14 && $session->qData['step1'] == 0){ // Quest
            $database->query("UPDATE quests SET step1 = 1,isFinished = 1 WHERE userid = ".$session->uid."");
        }

        include_once("application/views/Ajax/overlay.tpl");
        break;
    case 'upall':
        if(($village->resarray['f99t'] == 40) or ($village->resarray['f99t'] == 40) or ($village->resarray['f99t'] == 40) or ($village->resarray['f99t'] == 40)) {
            $isWW = TRUE;
        }else{
            $isWW = False;
        }
        
                    //include_once("application/Database.php");
                    //include_once("application/Village.php");
                    //echo '<pre>';
                    //print_r($GLOBALS);
                    //echo '</pre>';
                    if($session->gold >= MAX_LEVEL_COST && !$isWW){
                    $FIELD_ID = intval($_GET['a']);
                    $RPA_LEVEL = $village->resarray['f' . $FIELD_ID];
                    $FIELD_BID = $village->resarray['f' . $FIELD_ID . 't'];
                    $maxLvL = sizeof($GLOBALS['bid' . $FIELD_BID]);
                    if ($FIELD_BID <= 4) {
                        $maxLvL--;
                        if (!$village->capital) {
                            $maxLvL = 10;
                        }
                    }
                    if ($maxLvL > 20) {
                        return;
                    }
                    $bindicate = $building->canBuild($FIELD_ID, $village->resarray['f' . $FIELD_ID . 't']);
                    echo 'Bindicate = '. $bindicate.'<br>';
                    if (!in_array($FIELD_BID, array(40, 25, 26,44)) && !in_array($bindicate, array(1, 10, 11))) {
                        if ($maxLvL - $RPA_LEVEL) {
                            $pop = $cp = 0;
                            for ($i = 1 + $RPA_LEVEL; $i <= $maxLvL; ++$i) {
                                $pop += $GLOBALS['bid' . $FIELD_BID][$i]['pop'];
                                $cp += $GLOBALS['bid' . $FIELD_BID][$i]['cp'];
                            }
//echo 'o';
                            $database->modifyPop($village->wid, $pop, 0);
                            $database->addCP($village->wid, $cp / SPEED);
                            $database->modifyFieldType($village->wid, $FIELD_ID, $FIELD_BID);
                            $database->modifyFieldLevel($village->wid, $FIELD_ID, $maxLvL - $RPA_LEVEL, TRUE);
                            $database->query("DELETE FROM bdata WHERE field = ".$FIELD_ID.""); // iRedux - Fix
                                                        #############################
    $time=time();
    $ip=$_SERVER['REMOTE_ADDR'];
    $uid=$session->uid;
    $golduse = MAX_LEVEL_COST;    
    $infa="Level Max,$time,$golduse,$ip";    
    $database->addPalevo($uid,$infa,3);
    ###################################
    $database->modifyGold($session->uid, $golduse, 0);
                        }
                    }
                    if ($FIELD_ID >= 19) {
                        header("Location: dorf2.php");
                        exit;
                    } else {
                        header("Location: dorf1.php");
                        exit;
                    }
                }else{
                    header('Location: dorf1.php'); exit();

                }
            break;
            case 'uplvl20':
                //include_once("application/Database.php");
                //include_once("application/Village.php");
                //include_once("application/Building.php");
                //echo '<pre>';
                //print_r($GLOBALS);
                //echo '</pre>';
                $tropa = intval($database->RemoveXSS($_GET['a']));
                $time=time();
                $ip=$_SERVER['REMOTE_ADDR'];
                $uid=$session->uid;
                $golduse = 100;    
                $infa="Trop Max,$time,$golduse,$ip";    
                $database->addPalevo($uid,$infa,3);
###################################
                $database->modifyGold($session->uid, $golduse, 0);
                $database->query("UPDATE `abdata` SET `a".$tropa."` = '20' WHERE `abdata`.`vref` = ".$village->wid."");
                $database->UpdateAchievU($session->uid,"`a8`=1");
                
                
                //REDIRECIONA
$builds = $village->resarray;
for($i=19;$i<=40;$i++){
	if($builds['f'.$i.'t']==12){
        $id2=$i;
        break;
	}
}
                header("Location: build.php?id=$id2");

                exit;
                break;
				
				case 'hasClass':
				echo '{"response": {"error":false,"errorMsg":null,"data":{}}}';
                break;
                
                case 'goldclubPopup':
                echo '{"response":{"error":false,"errorMsg":null,"data":{"title":"\u0646\u0627\u062f\u064a \u0627\u0644\u0630\u0647\u0628","gold":"\u0627\u0644\u0630\u0647\u0628: <img src=\"img\\\/x.gif\" class=\"gold\" alt=\"\u0627\u0644\u0630\u0647\u0628\" \/> <span class=\"bold\">'.$session->gold.'<\/span>","subHeadLine":"\u0645\u0646 \u0623\u062c\u0644 \u0627\u0633\u062a\u062e\u062f\u0627\u0645 \u0647\u0630\u0647 \u0627\u0644\u0645\u064a\u0632\u0629\u060c \u062a\u062d\u062a\u0627\u062c \u0625\u0644\u0649 \u062a\u0641\u0639\u064a\u0644 \u0646\u0627\u062f\u064a \u0627\u0644\u0630\u0647\u0628!","goldButton":"<button type=\"button\" class=\"gold '.($session->goldclub ? 'disabled' : 'prosButton goldclub').'\" '.(!$session->goldclub ? 'id=\"buttonGVHL4pncxUPYc\"' : '').' title=\"\" coins=\"'.$config['goldClub'].'\" ><div class=\"button-container addHoverClick\">\n\t\t<div class=\"button-background\">\n\t\t\t<div class=\"buttonStart\">\n\t\t\t\t<div class=\"buttonEnd\">\n\t\t\t\t\t<div class=\"buttonMiddle\"><\/div>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t<\/div>\n\t\t<div class=\"button-content\">\u0641\u0639\u0644<img src=\"img\/x.gif\" class=\"goldIcon\" alt=\"\" \/><span class=\"goldValue\">'.$config['goldClub'].'<\/span><\/div><\/button>\n    '.(!$session->goldclub ? '<script type=\"text\/javascript\" id=\"buttonGVHL4pncxUPYc_script\">\n    window.addEvent(\'domready\', function()\n        {\n        if($(\'buttonGVHL4pncxUPYc\'))\n        {\n          $(\'buttonGVHL4pncxUPYc\').addEvent(\'click\', function ()\n          {\n            window.fireEvent(\'buttonClicked\', [this, {\"type\":\"button\",\"value\":\"\\u0641\\u0639\\u0644\",\"confirm\":\"\",\"onclick\":\"\",\"title\":\"\",\"coins\":'.$config['goldClub'].',\"id\":\"buttonGVHL4pncxUPYc\"}]);\n          });\n        }\n        });\n    <\/script>' : '').'","buttonSubtitle":"\u0648\u0642\u062a \u0627\u0644\u0645\u0643\u0627\u0641\u0623\u0629: <b>\u0643\u0627\u0645\u0644 \u0627\u0644\u062c\u0648\u0644\u0629<\/br>","goldclubPopupButtonExtraFeatures":"\u0628\u0627\u0644\u0625\u0636\u0627\u0641\u0629 \u0625\u0644\u0649 \u0630\u0644\u0643\u060c \u0633\u064a\u0643\u0648\u0646 \u0644\u062f\u064a\u0643 \u0627\u0644\u0648\u0635\u0648\u0644 \u0625\u0644\u0649 \u0627\u0644\u0645\u064a\u0632\u0627\u062a \u0627\u0644\u062a\u0627\u0644\u064a\u0629:","features":{"troopEscape":{"title":"\u062a\u0647\u0631\u064a\u0628 \u0627\u0644\u0642\u0648\u0627\u062a","text":"\u0648\u064a\u0645\u0643\u0646 \u0623\u0646 \u062a\u0623\u0645\u0631 \u0627\u0644\u0642\u0648\u0627\u062a \u0627\u0644\u062e\u0627\u0635\u0629 \u0641\u064a \u0639\u0627\u0635\u0645\u062a\u0643 \u0628\u0627\u0644\u0647\u0631\u0648\u0628 \u062a\u0644\u0642\u0627\u0626\u064a\u0627 \u0645\u0646 \u0627\u0644\u0642\u0631\u064a\u0629 \u0642\u0628\u0644 \u0627\u0644\u0647\u062c\u0645\u0627\u062a \u0639\u0628\u0631 \u0646\u0642\u0637\u0629 \u0627\u0644\u062a\u062c\u0645\u0639."},"raidList":{"title":"\u0642\u0627\u0626\u0645\u0629 \u0627\u0644\u0645\u0632\u0627\u0631\u0639","text":"\u0641\u064a \u0646\u0642\u0637\u0629 \u062a\u062c\u0645\u0639\u060c \u064a\u0645\u0643\u0646\u0643 \u0627\u0633\u062a\u062e\u062f\u0627\u0645 \u0642\u0627\u0626\u0645\u0629 \u0627\u0644\u0645\u0632\u0631\u0639\u0629 \u0644\u0625\u062f\u0627\u0631\u0629 \u0627\u0644\u0647\u062c\u0645\u0627\u062a \u0639\u0644\u0649 \u0623\u0644\u0645\u0632\u0627\u0631\u0639."},"tradeThreeTimes":{"title":"\u0627\u0644\u0645\u062e\u0637\u0637 \u0627\u0644\u062a\u062c\u0627\u0631\u064a","text":"\u064a\u0645\u0643\u0646\u0643 \u0625\u0639\u062f\u0627\u062f \u0634\u062d\u0646\u0627\u062a \u0627\u0644\u0645\u0648\u0627\u0631\u062f \u0641\u064a \u0627\u0644\u0648\u0642\u062a \u0627\u0644\u0645\u0646\u0627\u0633\u0628 \u0648\u0627\u0644\u0645\u0646\u062a\u0638\u0645\u0629 \u0628\u064a\u0646 \u0627\u0644\u0642\u0631\u0649 \u0627\u0644\u062e\u0627\u0635\u0629 \u0628\u0643."},"cropFinder":{"title":"\u0645\u0633\u062a\u0643\u0634\u0641 \u0627\u0644\u062d\u0642\u0648\u0644 (9 \u0648 15) \u0639\u0644\u0649 \u0627\u0644\u062e\u0631\u064a\u0637\u0629","text":"\u0648\u0638\u064a\u0641\u0629 \u0627\u0644\u0628\u062d\u062b \u0627\u0644\u0645\u062a\u0643\u0627\u0645\u0644\u0629 \u0639\u0644\u0649 \u0627\u0644\u062e\u0631\u064a\u0637\u0629 \u064a\u0633\u0645\u062d \u0644\u0643 \u0644\u0625\u064a\u062c\u0627\u062f \u0642\u0645\u062d\u064a\u0627\u062a \u0645\u0639 \u0632\u064a\u0627\u062f\u0629 \u0625\u0646\u062a\u0627\u062c \u0627\u0644\u0642\u0645\u062d \u0648\u0627\u0644\u0648\u0627\u062d\u0627\u062a \u0648\u0627\u0644\u0645\u0643\u0627\u0641\u0623\u0629."},"messageArchive":{"title":"\u0627\u0644\u0625\u0631\u0634\u064a\u0641","text":"\u064a\u0645\u0643\u0646 \u0623\u0631\u0634\u0641\u0629 \u0627\u0644\u0631\u0633\u0627\u0626\u0644 \u0648\u0627\u0644\u062a\u0642\u0627\u0631\u064a\u0631 \u0627\u0644\u0647\u0627\u0645\u0629 \u0648\u0633\u0647\u0648\u0644\u0629 \u0627\u0644\u0648\u0635\u0648\u0644 \u0625\u0644\u064a\u0647\u0627 \u0644\u0627\u062d\u0642\u0627."}},"furtherInfos":"\u0633\u064a\u062a\u064a\u062d <B>\u0646\u0627\u062f\u064a \u0627\u0644\u0630\u0647\u0628<\/b> \u062a\u0634\u063a\u064a\u0644 \u0647\u0630\u0647 \u0627\u0644\u0645\u064a\u0632\u0627\u062a \u0627\u0636\u063a\u0637 \u0639\u0644\u0649 \"i\" \u0644\u0645\u0639\u0644\u0648\u0645\u0627\u062a \u0623\u062e\u0631\u0649 .."}}}';
                break;
                case 'paymentProviders':
                    $html = '<div class="methodsPage visible">
                    <div class="methodItem" title="PayPal">
                        <input type="hidden" class="providerId" value="5"\/><img src="img/provider/paypal.png" alt="PayPal">
                    </div>
                    <div class="methodItem" title="Pay by bank">
                        <input type="hidden" class="providerId" value="11"\/><img src="img/provider/Logo-ARB.png" alt="Bank">
                    </div>
                    </div>';
                    echo '{"response": {"error":false,"errorMsg":null,"data":{"html":'.json_encode($html).'}}}';
                break;

                case 'paymentWizard':
                    $html = '';
                    /* Array ( [cmd] => paymentWizard [goldProductId] => 7 [goldProductLocation] => [location] => [activeTab] => buyGold [ajaxToken] => de3768730d5610742b5245daa67b12cd )
                    */
                    //print_r($_POST); die();
                if($_POST['activeTab'] == 'buyGold'){
                    $html .= '<div id="paymentWizardContainer">
                    <div id="paymentWizard" class="buyGold" style="height:824px">
                        <input class="paymentWizardAnswersLink hide" type="hidden" name="answersLink" value="">
                
                        <div class="contentWrapper">
                            <script type="text/javascript">
                    function ShopUIV2() {
                        this.allowSlidePackages = true;
                        this.allowSlidePaymentMethods = true;
                        this.goldPackagesPages = [];
                        this.goldPackagesPagesSize = 0;
                        this.paymentMethodsPages = [];
                        this.paymentMethodsPageSize = 0;
                        this.selectedPaymentMethod = false;
                        this.rtl = false;
                        this.initialize = function () {
                            var b = this;
                            if ($$(".paymentWizardDirectionRTL").length > 0) {
                                this.rtl = true
                            }
                            this.slidingContentInnerPackage = $$("#packageSlider .slidingContentInner")[0];
                            b.slidingContentOuterPackage = $$("#packageSlider .slidingContentOuter")[0];
                            b.slidingContentOuterWidthPackage = b.slidingContentOuterPackage.getDimensions();
                            b.slidingContentOuterWidthPackage = parseInt(b.slidingContentOuterWidthPackage.x);
                            b.slidingContentInnerPackage.set("tween", {
                                duration: 500,
                                transition: "linear",
                                link: "cancel",
                                onComplete: function () {
                                    b.allowSlidePackages = true
                                }
                            });
                            this.slidingContentInnerPaymentMethods = $$("#paymentMethodsSlider .slidingContentInner")[0];
                            b.slidingContentOuterPaymentMethods = $$("#paymentMethodsSlider .slidingContentOuter")[0];
                            b.slidingContentOuterWidthPaymentMethods = b.slidingContentOuterPaymentMethods.getDimensions();
                            b.slidingContentOuterWidthPaymentMethods = parseInt(b.slidingContentOuterWidthPaymentMethods.x);
                            b.slidingContentInnerPaymentMethods.set("tween", {
                                duration: 500,
                                transition: "linear",
                                link: "cancel",
                                onComplete: function () {
                                    b.allowSlidePaymentMethods = true
                                }
                            });
                            var a = 0;
                            $$("#packageSlider .productsPage").each(function (d) {
                                b.goldPackagesPages[a] = d;
                                if (b.goldPackagesPagesSize == 0) {
                                    var c = d.getStyle("width");
                                    c = parseInt(c.replace("px", ""));
                                    b.goldPackagesPagesSize = c
                                }
                                a++
                            });
                            b.initializePaymentMethods();
                            setTimeout(function () {
                                b.packageSliderButtonCheck();
                                b.paymentMethodsSliderButtonCheck();
                                b.bindEvents();
                                b.updateResultBox();
                                setTimeout(function () {
                                    $$("#packageSlider .package.hideForLoading").removeClass("hideForLoading")
                                }, 500)
                            }, 250)
                        };
                        this.initializePaymentMethods = function () {
                            var b = this;
                            $$("#paymentMethodsSlider .loading")[0].removeClass("hide");
                            var a = parseInt($$(".package.selected input.goldProductId")[0].get("value"));
                            $$("#paymentMethodsSlider .slidingContent")[0].empty();
                            b.updateResultBox();
                            Travian.ajax({
                                data: {cmd: "paymentProviders", selectedPackage: a}, onSuccess: function (d) {
                                    $$("#paymentMethodsSlider .slidingContent")[0].set("html", d.html);
                                    if (!b.rtl) {
                                        b.slidingContentInnerPaymentMethods.setStyle("margin-left", 0)
                                    } else {
                                        b.slidingContentInnerPaymentMethods.setStyle("margin-right", 0)
                                    }
                                    b.paymentMethodsPages = [];
                                    b.paymentMethodsPageSize = 0;
                                    var c = 0;
                                    $$(".methodsPage").each(function (f) {
                                        b.paymentMethodsPages[c] = f;
                                        if (b.paymentMethodsPageSize == 0) {
                                            var e = f.getStyle("width");
                                            e = parseInt(e.replace("px", ""));
                                            b.paymentMethodsPageSize = e
                                        }
                                        c++
                                    });
                                    $$("#paymentMethodsSlider .methodItem").each(function (g) {
                                        g.addEvent("click", b.methodItemClickEvent);
                                        if (b.selectedPaymentMethod !== false) {
                                            if (parseInt(g.getChildren()[0].get("value")) == b.selectedPaymentMethod) {
                                                $$("#paymentMethodsSlider .methodItem").removeClass("selected");
                                                g.addClass("selected");
                                                for (var e = 0; e < b.paymentMethodsPages.length; e++) {
                                                    if (b.paymentMethodsPages[e] == g.getParent()) {
                                                        var f = e * b.paymentMethodsPageSize;
                                                        if (f == 0) {
                                                            f = 1
                                                        }
                                                        b.allowSlidePaymentMethods = false;
                                                        $$("#paymentMethodsSlider .methodsPage").removeClass("visible").addClass("hidden");
                                                        b.paymentMethodsPages[e].removeClass("hidden").addClass("visible");
                                                        if (!b.rtl) {
                                                            b.slidingContentInnerPaymentMethods.tween("margin-left", f * -1)
                                                        } else {
                                                            b.slidingContentInnerPaymentMethods.tween("margin-right", f * -1)
                                                        }
                                                        b.updateResultBox()
                                                    }
                                                }
                                            }
                                        }
                                    });
                                    b.paymentMethodsSliderButtonCheck();
                                    $$("#paymentMethodsSlider .loading")[0].addClass("hide")
                                }
                            })
                        };
                        this.packageSliderButtonCheck = function () {
                            var a = this;
                            if (typeof a.goldPackagesPages[0] != "undefined") {
                                if (a.goldPackagesPages[0].hasClass("visible")) {
                                    if (!$$("#packageSlider .slideArea.area1")[0].hasClass("inactive")) {
                                        $$("#packageSlider .slideArea.area1")[0].addClass("inactive")
                                    }
                                } else {
                                    $$("#packageSlider .slideArea.area1")[0].removeClass("inactive")
                                }
                                if (a.goldPackagesPages[a.goldPackagesPages.length - 1].hasClass("hidden")) {
                                    if ($$("#packageSlider .slideArea.area2")[0].hasClass("inactive")) {
                                        $$("#packageSlider .slideArea.area2")[0].removeClass("inactive")
                                    }
                                } else {
                                    $$("#packageSlider .slideArea.area2")[0].addClass("inactive")
                                }
                            }
                        };
                        this.paymentMethodsSliderButtonCheck = function () {
                            var a = this;
                            if (typeof a.paymentMethodsPages[0] != "undefined") {
                                if (a.paymentMethodsPages[0].hasClass("visible")) {
                                    if (!$$("#paymentMethodsSlider .slideArea.area1")[0].hasClass("inactive")) {
                                        $$("#paymentMethodsSlider .slideArea.area1")[0].addClass("inactive")
                                    }
                                } else {
                                    $$("#paymentMethodsSlider .slideArea.area1")[0].removeClass("inactive")
                                }
                                if (a.paymentMethodsPages[a.paymentMethodsPages.length - 1].hasClass("hidden")) {
                                    if ($$("#paymentMethodsSlider .slideArea.area2")[0].hasClass("inactive")) {
                                        $$("#paymentMethodsSlider .slideArea.area2")[0].removeClass("inactive")
                                    }
                                } else {
                                    $$("#paymentMethodsSlider .slideArea.area2")[0].addClass("inactive")
                                }
                            }
                        };
                        this.bindEvents = function () {
                            var a = this;
                            $$("#packageSlider .slideArea.area1").addEvent("click", function () {
                                a.packageSlideLeft()
                            });
                            $$("#packageSlider .slideArea.area2").addEvent("click", function () {
                                a.packageSlideRight()
                            });
                            $$("#packageSlider .package").addEvent("click", function () {
                                if (!this.hasClass("selected")) {
                                    $$(".package").removeClass("selected");
                                    this.addClass("selected");
                                    a.initializePaymentMethods()
                                }
                            });
                            $$("#phonePackages .package").addEvent("click", function () {
                                if (!this.hasClass("selected")) {
                                    $$(".package").removeClass("selected");
                                    this.addClass("selected");
                                    a.initializePaymentMethods()
                                }
                            });
                            $$("#paymentMethodsSlider .slideArea.area1").addEvent("click", function () {
                                a.paymentMethodsSlideLeft()
                            });
                            $$("#paymentMethodsSlider .slideArea.area2").addEvent("click", function () {
                                a.paymentMethodsSlideRight()
                            });
                            $$("#paymentMethodsSlider .methodItem").addEvent("click", a.methodItemClickEvent);
                            $$("#paymentMethodsSlider").addEvent("click", function () {
                                a.updateResultBox();
                                a.saveSelectedPaymentMethod()
                            });
                            $$("#overview .resultBox .activeButton").addEvent("click", function () {
                                a.buyNowAction()
                            });
                            $$(".buyGoldLocation").addEvent("change", function () {
                                a.changeLocation()
                            });
                            $$("#vouchers .package").addEvent("click", function () {
                                voucherPopup()
                            })
                        };
                        this.methodItemClickEvent = function () {
                            if (!this.hasClass("inactive") && !this.hasClass("defect")) {
                                $$("#paymentMethodsSlider .methodItem").removeClass("selected");
                                this.addClass("selected")
                            }
                        };
                        this.updateResultBox = function () {
                            $$(".resultBox #packageGoldAmount .goldUnits")[0].set("html", $$(".package.selected .goldUnits")[0].get("html"));
                            $$(".resultBox #goldBalanceNew")[0].set("html", (parseInt($$(".package.selected .goldUnits")[0].get("html")) + parseInt($$(".accountBalance span")[0].get("html"))));
                            $$(".resultBox #priceToPay")[0].set("html", $$(".package.selected .price")[0].get("html"));
                            if ($$("#paymentMethodsSlider .methodItem.selected")[0]) {
                                $$(".resultBox .inactiveButton").addClass("hide");
                                $$(".resultBox .activeButton").removeClass("hide")
                            } else {
                                $$(".resultBox .activeButton").addClass("hide");
                                $$(".resultBox .inactiveButton").removeClass("hide")
                            }
                        };
                        this.saveSelectedPaymentMethod = function () {
                            var a = this;
                            if ($$("#paymentMethodsSlider .methodItem.selected")[0]) {
                                a.selectedPaymentMethod = parseInt($$("#paymentMethodsSlider .methodItem.selected input.providerId")[0].get("value"))
                            }
                        };
                        this.packageSlideLeft = function () {
                            var g = this;
                            if (g.allowSlidePackages) {
                                var f = "";
                                var a = "";
                                var b = false;
                                for (var c = g.goldPackagesPages.length - 1; c >= 0; c--) {
                                    if (g.goldPackagesPages[c].hasClass("visible")) {
                                        f = g.goldPackagesPages[c];
                                        b = true
                                    }
                                    if (b && g.goldPackagesPages[c].hasClass("hidden")) {
                                        a = g.goldPackagesPages[c];
                                        break
                                    }
                                }
                                if (a != "") {
                                    var e = 0;
                                    if (!g.rtl) {
                                        e = g.slidingContentInnerPackage.getStyle("margin-left")
                                    } else {
                                        e = g.slidingContentInnerPackage.getStyle("margin-right")
                                    }
                                    e = parseInt(e.replace("px", ""));
                                    var d = (e + g.goldPackagesPagesSize);
                                    if (d == 0) {
                                        d = 1
                                    }
                                    f.removeClass("visible").addClass("hidden");
                                    a.removeClass("hidden").addClass("visible");
                                    g.allowSlidePackages = false;
                                    if (!g.rtl) {
                                        g.slidingContentInnerPackage.tween("margin-left", d)
                                    } else {
                                        g.slidingContentInnerPackage.tween("margin-right", d)
                                    }
                                }
                            }
                            g.packageSliderButtonCheck()
                        };
                        this.packageSlideRight = function () {
                            var g = this;
                            if (g.allowSlidePackages) {
                                var f = "";
                                var a = "";
                                var b = false;
                                for (var c = 0; c < g.goldPackagesPages.length; c++) {
                                    if (g.goldPackagesPages[c].hasClass("visible")) {
                                        f = g.goldPackagesPages[c];
                                        b = true
                                    }
                                    if (g.goldPackagesPages[c].hasClass("hidden")) {
                                        if (b) {
                                            a = g.goldPackagesPages[c];
                                            break
                                        }
                                    }
                                }
                                if (a != "") {
                                    var e = 0;
                                    if (!g.rtl) {
                                        e = g.slidingContentInnerPackage.getStyle("margin-left")
                                    } else {
                                        e = g.slidingContentInnerPackage.getStyle("margin-right")
                                    }
                                    e = parseInt(e.replace("px", "")) * -1;
                                    var d = (e + g.goldPackagesPagesSize) * -1;
                                    f.removeClass("visible").addClass("hidden");
                                    a.removeClass("hidden").addClass("visible");
                                    g.allowSlidePaymentMethods = false;
                                    if (!g.rtl) {
                                        g.slidingContentInnerPackage.tween("margin-left", d)
                                    } else {
                                        g.slidingContentInnerPackage.tween("margin-right", d)
                                    }
                                }
                            }
                            g.packageSliderButtonCheck()
                        };
                        this.paymentMethodsSlideLeft = function () {
                            var g = this;
                            if (g.allowSlidePaymentMethods) {
                                var f = "";
                                var a = "";
                                var b = false;
                                for (var c = g.paymentMethodsPages.length - 1; c >= 0; c--) {
                                    if (g.paymentMethodsPages[c].hasClass("visible")) {
                                        f = g.paymentMethodsPages[c];
                                        b = true
                                    }
                                    if (b && g.paymentMethodsPages[c].hasClass("hidden")) {
                                        a = g.paymentMethodsPages[c];
                                        break
                                    }
                                }
                                if (a != "") {
                                    var e = 0;
                                    if (!g.rtl) {
                                        e = g.slidingContentInnerPaymentMethods.getStyle("margin-left")
                                    } else {
                                        e = g.slidingContentInnerPaymentMethods.getStyle("margin-right")
                                    }
                                    e = parseInt(e.replace("px", ""));
                                    var d = (e + g.paymentMethodsPageSize);
                                    if (d == 0) {
                                        d = 1
                                    }
                                    f.removeClass("visible").addClass("hidden");
                                    a.removeClass("hidden").addClass("visible");
                                    g.allowSlidePaymentMethods = false;
                                    if (!g.rtl) {
                                        g.slidingContentInnerPaymentMethods.tween("margin-left", d)
                                    } else {
                                        g.slidingContentInnerPaymentMethods.tween("margin-right", d)
                                    }
                                }
                            }
                            g.paymentMethodsSliderButtonCheck()
                        };
                        this.paymentMethodsSlideRight = function () {
                            var g = this;
                            if (g.allowSlidePaymentMethods) {
                                var f = "";
                                var a = "";
                                var b = false;
                                for (var c = 0; c < g.paymentMethodsPages.length; c++) {
                                    if (g.paymentMethodsPages[c].hasClass("visible")) {
                                        f = g.paymentMethodsPages[c];
                                        b = true
                                    }
                                    if (g.paymentMethodsPages[c].hasClass("hidden")) {
                                        if (b) {
                                            a = g.paymentMethodsPages[c];
                                            break
                                        }
                                    }
                                }
                                if (a != "") {
                                    var e = 0;
                                    if (!g.rtl) {
                                        e = g.slidingContentInnerPaymentMethods.getStyle("margin-left")
                                    } else {
                                        e = g.slidingContentInnerPaymentMethods.getStyle("margin-right")
                                    }
                                    e = parseInt(e.replace("px", "")) * -1;
                                    var d = (e + g.paymentMethodsPageSize) * -1;
                                    f.removeClass("visible").addClass("hidden");
                                    a.removeClass("hidden").addClass("visible");
                                    g.allowSlidePaymentMethods = false;
                                    if (!g.rtl) {
                                        g.slidingContentInnerPaymentMethods.tween("margin-left", d)
                                    } else {
                                        g.slidingContentInnerPaymentMethods.tween("margin-right", d)
                                    }
                                }
                            }
                            g.paymentMethodsSliderButtonCheck()
                        };
                        this.buyNowAction = function () {
                            if ($$("#overview .resultBox .inactiveButton.hide")[0]) {
                                var e = parseInt($$(".package.selected input.goldProductId")[0].get("value"));
                                var b = parseInt($$("#paymentMethodsSlider .methodItem.selected input.providerId")[0].get("value"));
                                var d = 800;
                                var f = 600;
                                if ($$("#paymentMethodsSlider .methodItem.selected input.popupWidth")[0]) {
                                    d = $$("#paymentMethodsSlider .methodItem.selected input.popupWidth")[0]
                                }
                                if ($$("#paymentMethodsSlider .methodItem.selected input.popupHeight")[0]) {
                                    f = $$("#paymentMethodsSlider .methodItem.selected input.popupHeight")[0]
                                }
                                var a = (screen.width - d) / 2;
                                var c = (screen.height - f) / 2;
                                window.open("tgpay.php?product=" + e + "&provider=" + b, "tgpay", "scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=" + d + ",height=" + f + ",left=" + a + ",top=" + c)
                            }
                        };
                        this.changeLocation = function () {
                            var a = $$("select.buyGoldLocation")[0].getSelected()[0].get("value");
                            window.fireEvent("startPaymentWizard", {
                                data: {
                                    cmd: "paymentWizard",
                                    goldProductId: "",
                                    goldProductLocation: a,
                                    location: "",
                                    activeTab: "buyGold",
                                    formData: {}
                                }
                            })
                        };
                        this.selectPackage = function (e) {
                            var d = this;
                            var f = $$(".package input[value=" + e + "]")[0];
                            e = f.getParent();
                            var a = e.getParent();
                            if (a.id != "phonePackages") {
                                if (a.hasClass("hidden")) {
                                    for (var b = 0; b < d.goldPackagesPages.length; b++) {
                                        if (d.goldPackagesPages[b] == a) {
                                            var c = b * d.goldPackagesPagesSize;
                                            if (c == 0) {
                                                c = 1
                                            }
                                            d.allowSlidePackages = false;
                                            $$("#packageSlider .productsPage").removeClass("visible").addClass("hidden");
                                            d.goldPackagesPages[b].removeClass("hidden").addClass("visible");
                                            if (!d.rtl) {
                                                d.slidingContentInnerPackage.tween("margin-left", c * -1)
                                            } else {
                                                d.slidingContentInnerPackage.tween("margin-right", c * -1)
                                            }
                                        }
                                    }
                                }
                            }
                            $$(".package").removeClass("selected");
                            e.addClass("selected")
                        }
                    }
                </script>
                <div class="buyGoldContent paymentWizardDirection'.strtoupper(DIRECTION).'">
                    <div id="packageSlider"><h1>'.$lang['Plus']['Packages'].'</h1>
                        <div class="slideArea area1 inactive">
                            <div class="arrowL inactive"></div>
                        </div>
                        <div class="slideArea area2">
                            <div class="arrowR inactive"></div>
                        </div>
                        <div class="slidingContentOuter">
                            <div class="slidingContentInner">
                                <div class="slidingContent">
                                    <div class="productsPage visible">
                                    <div class="fakeProductHelper"></div>';

                                    $i = 0;
                                    foreach(array_reverse($packages) as $pack){
                                        $i++;
                                        if($i > 5){
                                            
                                         break;
                                        }
                                        if($_POST['goldProductId'] == $pack['id']){
                                            $addon = "selected";
                                        }else{ $addon = ''; }
                                        $html .= '<div class="package size'.$i.' '.($i == 1 ? 'selected' : '').' '.$addon.'">
                                        <input type="hidden" class="goldProductId" value="'.$pack['id'].'">
                                        <div class="goldProductTextWrapper">
                                            <div class="goldUnits">'.$pack['gold'].'</div>
                                            <div class="goldUnitsTypeText">'.$lang['Plus']['Gold'].'</div>
                                            <div class="footerLine"><span class="price">'.$pack['cost'].' '.$pack['currency'].'&nbsp;*</span></div>
                                        </div>
                                        <div class="goldProductImageWrapper"><img src="img/product/'.$pack['img'].'" width="100" height="114" alt="Package F"></div>
                                        </div>
                                        ';
                                    }
                                    $html .= '</div>';
                                    if($i > 5){
                                        $html .= '<div class="productsPage hidden">
                                        <div class="fakeProductHelper"></div>';
                                        $x = $xx = 0;
                                        foreach(array_reverse($packages) as $pack){
                                            $x++;
                                            if($x > 5){
                                                $xx++;
                                                if($_POST['goldProductId'] == $pack['id']){
                                                    $addon = "selected";
                                                }else{ $addon = ''; }
        
                                                $html .= '<div class="package size'.$xx.' '.$addon.'">
                                                <input type="hidden" class="goldProductId" value="'.$pack['id'].'">
                                                <div class="goldProductTextWrapper">
                                                    <div class="goldUnits">'.$pack['gold'].'</div>
                                                    <div class="goldUnitsTypeText">'.$lang['Plus']['Gold'].'</div>
                                                    <div class="footerLine"><span class="price">'.$pack['cost'].' '.$pack['currency'].'&nbsp;*</span></div>
                                                </div>
                                                <div class="goldProductImageWrapper"><img src="img/product/'.$pack['img'].'" width="100" height="114" alt="Package F"></div>
                                                </div>
                                                ';
                                            }
                                        }

    
                                    }
                            $html .= ' </div></div>
                            </div>
                        </div>
                    </div>
                    <div id="paymentMethodsSlider"><h1>'.$lang['Plus']['PaymentOP'].'</h1>
                        <div class="loading hide"></div>
                        <div class="slideArea area1 inactive">
                            <div class="arrowL inactive"></div>
                        </div>
                        <div class="slideArea area2 inactive">
                            <div class="arrowR inactive"></div>
                        </div>
						
                        <div class="slidingContentOuter">
                            <div class="slidingContentInner" style="margin-right: 0px;">
                                <div class="slidingContent"><div class="methodsPage visible"><div class="methodItem"><input type="hidden" class="providerId" value="5"><img src="img/provider/paypal.png" alt="PayPal"></div></div></div>
                            </div>
                        </div>
                    </div>
                    <div id="overview">
                        <div class="priceNotificationBox">'.$lang['Plus']['PayNotice'].'</div>
                        <div class="priceNotificationBox" style="color:red;font-weight:bold">'.$lang['Plus']['PayNotice2'].'</div>
                        <br>
                        <h1>'.$lang['Plus']['Overview'].'</h1>
                        <table class="resultBox">
                            <tbody><tr>
                                <td>'.$lang['Plus']['Pay01'].'</td>
                                <td id="packageGoldAmount"><span class="goldUnits"></span> '.$lang['Plus']['Gold'].'</td>
                            </tr>
                            <tr>
                                <td>'.$lang['Plus']['Pay02'].'</td>
                                <td><span id="goldBalanceNew"></span> '.$lang['Plus']['Gold'].'</td>
                            </tr>
                            <tr>
                                <td>'.$lang['Plus']['Pay03'].'</td>
                                <td id="priceToPay"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="inactiveButton">
                                        <button type="button" value="'.$lang['Plus']['Pay04'].'" id="buttonxu8itpQTzeYcR" class="green disabled ">
                                            <div class="button-container addHoverClick">
                                                <div class="button-background">
                                                    <div class="buttonStart">
                                                        <div class="buttonEnd">
                                                            <div class="buttonMiddle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-content">'.$lang['Plus']['Pay04'].'</div>
                                            </div>
                                        </button>
                                        <script type="text/javascript" id="buttonxu8itpQTzeYcR_script">window.addEvent(\'domready\', function () {
                                                if ($(\'buttonxu8itpQTzeYcR\')) {
                                                    $(\'buttonxu8itpQTzeYcR\').addEvent(\'click\', function () {
                                                        window.fireEvent(\'buttonClicked\', [this, {
                                                            "type": "button",
                                                            "value": "Buy now",
                                                            "name": "",
                                                            "id": "buttonxu8itpQTzeYcR",
                                                            "class": "green disabled ",
                                                            "title": "'.$lang['Plus']['Pay04'].'",
                                                            "confirm": "",
                                                            "onclick": ""
                                                        }]);
                                                    });
                                                }
                                            });</script>
                                    </div>
                                    <div class="activeButton hide">
                                        <button type="button" value="'.$lang['Plus']['Pay04'].'" id="buttonF8GLwwC4UNPAx" class="green ">
                                            <div class="button-container addHoverClick">
                                                <div class="button-background">
                                                    <div class="buttonStart">
                                                        <div class="buttonEnd">
                                                            <div class="buttonMiddle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-content">'.$lang['Plus']['Pay04'].'</div>
                                            </div>
                                        </button>
                                        <script type="text/javascript" id="buttonF8GLwwC4UNPAx_script">
                                            window.addEvent(\'domready\', function () {
                                                if ($(\'buttonF8GLwwC4UNPAx\')) {
                                                    $(\'buttonF8GLwwC4UNPAx\').addEvent(\'click\', function () {
                                                        window.fireEvent(\'buttonClicked\', [this, {
                                                            "type": "button",
                                                            "value": "Buy now",
                                                            "name": "",
                                                            "id": "buttonF8GLwwC4UNPAx",
                                                            "class": "green ",
                                                            "title": "'.$lang['Plus']['BuyButton'].' right now",
                                                            "confirm": "",
                                                            "onclick": ""
                                                        }]);
                                                    });
                                                }
                                            });</script>
                                    </div>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div id="paymentMethodsSlider">
                        <hr>
                        <h1>'.$lang['Plus']['Redeem01'].':</h1>
                        <p style="font-size: 13px;">
                        '.$lang['Plus']['Redeem02'].':
                        </p>
                        <table id="brought_in" cellpadding="1" cellspacing="1">
                            <tbody>
                            </tbody><thead>
                            <tr>
                                <td>'.$lang['Plus']['Redeem01'].':</td>
                            </tr>
                            </thead>
                            <tbody><tr>
                                <td>
                                '.$lang['Plus']['Redeem03'].':
                                    <input type="text" class="text" value="" style="width: 50%" id="redeemCode">
                
                                    <button id="redeemCodeButton" type="submit" class="gold">
                                        <div class="button-container addHoverClick">
                                            <div class="button-background">
                                                <div class="buttonStart">
                                                    <div class="buttonEnd">
                                                        <div class="buttonMiddle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-content">'.$lang['Plus']['Redeem04'].'</div>
                                        </div>
                                    </button>
                                    <script type="text/javascript" id="redeemCodeButton_script">
                                        window.addEvent(\'domready\', function () {
                                            if ($(\'redeemCodeButton\')) {
                                                $(\'redeemCodeButton\').addEvent(\'click\', function () {
                                                    var redeemCode = $$("#redeemCode")[0].get("value").trim();
                                                    var errors = {
                                                        invalidCode: "'.$lang['Plus']['RedeeminvalidCode'].'",
                                                        codeIsUsed: "'.$lang['Plus']['RedeemcodeIsUsed'].'",
                                                        redeemSuccess: "'.$lang['Plus']['RedeemredeemSuccess'].'",
                                                        tooManyTries: "'.$lang['Plus']['RedeemtooManyTries'].'",
                                                        unknownError: "'.$lang['Plus']['RedeemunknownError'].'"
                                                    };
                                                    Travian.ajax({
                                                        data: {
                                                            cmd: "redeemCode",
                                                            redeemCode: redeemCode,
                                                        },
                                                        onSuccess: function (a) {
                                                            if (a.result == true) {
                                                                errors.redeemSuccess.dialog({
                                                                    buttonOk: true, overlayCancel: false, onOkay: function () {
                                                                        window.location.reload();
                                                                    }
                                                                });
                                                            } else {
                                                                errors[a.errorMsg].dialog();
                                                            }
                                                            $$("#redeemCodeButton").set("disabled", false);
                                                            $$("#redeemCodeButton").removeClass("disabled");
                                                        },
                                                        onFailure: function (a) {
                                                            \'Request failed!\'.dialog({
                                                                buttonOk: true, overlayCancel: false, onOkay: function () {
                                                                    window.location.reload();
                                                                }
                                                            });
                                                            $$("#redeemCodeButton").set("disabled", false);
                                                            $$("#redeemCodeButton").removeClass("disabled");
                                                        }
                                                    });
                                                    window.fireEvent(\'buttonClicked\', [this, {
                                                        "type": "submit",
                                                        "class": "gold",
                                                        "id": "redeemCodeButton"
                                                    }]);
                                                });
                                            }
                                        });
                                    </script>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                     </div>
                    <div class="clear"></div>
                        <script type="text/javascript">
                            window.addEvent(\'domready\', function () {
                                var shopUIV2 = new ShopUIV2();
                                shopUIV2.initialize();
                                var selectedPage = 1;
                                if (selectedPage > 1) {
                                    for (var i = 1; i < selectedPage; ++i) {
                                        shopUIV2.packageSlideRight();
                                    }
                                }
                            })
                        </script>
                </div>		
                </div>';

                }elseif($_POST['activeTab'] == 'pros'){
                    
                    if($session->qArrayW1[0] == 7 && $session->qArrayW1[1] == 0){
                        $database->query("UPDATE quests SET world1='7,1' WHERE userid = ".$session->uid."");
                    }
                    $html .= '<div id="paymentWizard" class="pros">
                    <input class="paymentWizardAnswersLink hide" type="hidden" name="answersLink" value="">
            
                    <div class="contentWrapper">
                        <div class="contentBorder infoArea">
                <div class="contentBorder-tl"></div>
                <div class="contentBorder-tr"></div>
                <div class="contentBorder-tc"></div>
                <div class="contentBorder-ml"></div>
                <div class="contentBorder-mr"></div>
                <div class="contentBorder-mc"></div>
                <div class="contentBorder-bl"></div>
                <div class="contentBorder-br"></div>
                <div class="contentBorder-bc"></div>
                <div class="contentBorder-contents cf">
                    <div class="premiumFeature Goldclub " style="display: block;">
                        <h4>'.$lang['Plus']['Plus01'].' </h4>
            
                        <div class="premiumFeatureDescription">
                        '.$lang['Plus']['Plus07'].'
                        </div>
                        <img class="prosGoldclubImage" src="img/x.gif">
                    </div>
                    <div class="premiumFeature Plus hide" style="display: none;">
                        <h4>'.$lang['Plus']['Plus02'].' </h4>
            
                        <div class="premiumFeatureDescription">
                            '.$lang['Plus']['Plus08'].'
                        </div>
                        <img class="prosPlusImage" src="img/x.gif">
                    </div>
                    <div class="premiumFeature ProductionboostWood hide" style="display: none;">
                        <h4>'.$lang['Plus']['Plus03'].' </h4>
            
                        <div class="premiumFeatureDescription">
                            '.$lang['Plus']['Plus09'].'
                        </div>
                        <img class="prosProductionboostWoodImage" src="img/x.gif">
                    </div>
                    <div class="premiumFeature ProductionboostClay hide" style="display: none;">
                        <h4>'.$lang['Plus']['Plus04'].'</h4>
            
                        <div class="premiumFeatureDescription">
                            '.$lang['Plus']['Plus09'].'
                        </div>
                        <img class="prosProductionboostClayImage" src="img/x.gif">
                    </div>
                    <div class="premiumFeature ProductionboostIron hide" style="display: none;">
                        <h4>'.$lang['Plus']['Plus05'].'</h4>
            
                        <div class="premiumFeatureDescription">
                            '.$lang['Plus']['Plus09'].'
                        </div>
                        <img class="prosProductionboostIronImage" src="img/x.gif">
                    </div>
                    <div class="premiumFeature ProductionboostCrop hide" style="display: none;">
                        <h4>'.$lang['Plus']['Plus06'].'</h4>
            
                        <div class="premiumFeatureDescription">
                            '.$lang['Plus']['Plus09'].'
                        </div>
                        <img class="prosProductionboostCropImage" src="img/x.gif">
                    </div>
                </div>
            </div>
            <div class="contentBorder contentArea">
                <div class="contentBorder-tl"></div>
                <div class="contentBorder-tr"></div>
                <div class="contentBorder-tc"></div>
                <div class="contentBorder-ml"></div>
                <div class="contentBorder-mr"></div>
                <div class="contentBorder-mc"></div>
                <div class="contentBorder-bl"></div>
                <div class="contentBorder-br"></div>
                <div class="contentBorder-bc"></div>
                <div class="contentBorder-contents cf">
                    <div class="paymentPopupDialogWrapper">
                        <h4 class="subHeadline">'.$lang['Plus']['Plus15'].':</h4>
            
                        <div class="featureCollection" id="featureCollectionWrapper">
                            <div class="feature featureBooking ">
                                <div class="dynamicContent " style="display: block;">
                                    <img src="img/x.gif" class="highlightArrow" alt="">
                                </div>
                                <input type="hidden" class="premiumFeatureName hide" name="featureName" value="Goldclub">
            
                                <div class="featureContent">
                                    <h3 class="featureTitle">'.$lang['Plus']['Plus01'].'</h3>
            
                                    <div class="featureButton">
                                        <button type="button" class="gold prosButton goldclub '.($session->goldclub ? 'disabled' :'').'" title="" coins="'.$config['goldClub'].'" id="buttonCTc5zRDd35lUS"><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.$lang['Plus']['Plus13'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['goldClub'].'</span></div></div></button>
                '.($session->goldclub ? '' : '<script type="text/javascript" id="buttonCTc5zRDd35lUS_script">
                window.addEvent(\'domready\', function()
                    {
                    if($(\'buttonCTc5zRDd35lUS\'))
                    {
                      $(\'buttonCTc5zRDd35lUS\').addEvent(\'click\', function ()
                      {
                        window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0641\u0639\u0644","confirm":"","onclick":"","title":"","coins":100,"id":"buttonCTc5zRDd35lUS"}]);
                      });
                    }
                    });
                </script>').'
                						</div>
                                    <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Plus10'].':<span class="bold">'.$lang['Plus']['Plus11'].'</span></div>
                                </div>
                            </div>
                            <div class="feature featureBooking ">
                                <div class="dynamicContent hide" style="display: none;">
                                    <img src="img/x.gif" class="highlightArrow" alt="">
                                </div>
                                <input type="hidden" class="premiumFeatureName hide" name="featureName" value="Plus">
            
                                <div class="featureContent">
                                    <h3 class="featureTitle">'.$lang['Plus']['Plus02'].' </h3>
                                    '.($session->plus ? '<div class="featureRemainingTime featureSubtitle subtitle"><span class="renewalActive"> '.$lang['Plus']['Plus16'].' '.$generator->getTimeFormat($session->plust - time()).'.</span></div>' : '').'

                                                            <div class="featureButton">
                                        <button type="button" class="gold prosButton plus" coins="'.$config['Plus'].'" id="buttonNONXgnG7xruHL"><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.($session->plus ? $lang['Plus']['Plus14'] : $lang['Plus']['Plus13']).'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['Plus'].'</span></div></div></button>
                <script type="text/javascript" id="buttonNONXgnG7xruHL_script">
                window.addEvent(\'domready\', function()
                    {
                    if($(\'buttonNONXgnG7xruHL\'))
                    {
                      $(\'buttonNONXgnG7xruHL\').addEvent(\'click\', function ()
                      {
                        window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0641\u0639\u0644","confirm":"","onclick":"","title":" \u062a\u0641\u0639\u064a\u0644 \u0627\u0644\u0622\u0646 &lt;br&gt; \u0627\u0644\u0648\u0642\u062a :  &lt;span class=&quot;bold&quot;&gt;12&lt;\/span&gt; \u0633\u0627\u0639\u0647 \u064a\u0648\u0645","coins":10,"id":"buttonNONXgnG7xruHL"}]);
                      });
                    }
                    });
                </script>						</div>
                <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">
                
                '.($session->plus ? '
                    <input type="checkbox" id="plus" name="plus[]" class="enumerableElements check checkbox prolongPlus" style="" '.($Travian->getAutoRenewal('plus') ? 'checked="checked"' : '').' value="'.($Travian->getAutoRenewal('plus')).'" title="">
                    <label for="plus" class="enumerableElementsCheckboxLabel prolongProductionboostPlus" style="">'.$lang['Plus']['Plus12'].'</label>
                ' : ''.$lang['Plus']['Plus10'].' : <span class="bold">'.$p->plus['Duration'].'</span> '.$p->plus['Type'].'').'
                    </div>
                </div>
                            </div>
                            <div class="feature featureBooking premiumFeatureProductionBoost">
                                <div class="dynamicContent hide" style="display: none;">
                                    <img src="img/x.gif" class="highlightArrow" alt="">
                                </div>
                                <input type="hidden" class="premiumFeatureName hide" name="featureName" value="ProductionboostWood">
            
                                <div class="featureContent">
                                    <h3 class="featureTitle">'.$lang['Plus']['Plus03'].'</h3>
                                    '.($session->bonus1 ? '<div class="featureRemainingTime featureSubtitle subtitle"><span class="renewalActive"> '.$lang['Plus']['Plus16'].' '.$generator->getTimeFormat($session->bonus1 - time()).'.</span></div>' : '').'

                                                            <div class="featureButton">
                                        <button type="button" class="gold prosButton productionboostWood" coins="5" id="buttonQZR4F6fpB8qGm"><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.($session->bonus1 ? $lang['Plus']['Plus14'] : $lang['Plus']['Plus13']).'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['addonProduction'].'</span></div></div></button>
                <script type="text/javascript" id="buttonQZR4F6fpB8qGm_script">
                window.addEvent(\'domready\', function()
                    {
                    if($(\'buttonQZR4F6fpB8qGm\'))
                    {
                      $(\'buttonQZR4F6fpB8qGm\').addEvent(\'click\', function ()
                      {
                        window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0641\u0639\u0644","confirm":"","onclick":"","title":"\u062a\u0641\u0639\u064a\u0644 \u0627\u0644\u0622\u0646 &lt;br&gt; \u0645\u062f\u0629 \u0627\u0644\u0632\u064a\u0627\u062f\u0629 \u0623\u064a\u0627\u0645 &lt;span class=&quot;bold&quot;&gt;15&lt;\/span&gt; \u0633\u0627\u0639\u0647","coins":5,"id":"buttonQZR4F6fpB8qGm"}]);
                      });
                    }
                    });
                </script>						</div>
                        <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">
                        '.($session->bonus1 ? '
                        <input type="checkbox" id="productionboostWood" name="productionboostWood[]" class="enumerableElements check checkbox prolongProductionboostWood" style="" '.($Travian->getAutoRenewal('productionboostWood') ? 'checked="checked"' : '').' value="'.($Travian->getAutoRenewal('productionboostWood')).'" title="">
                        <label for="productionboostWood" class="enumerableElementsCheckboxLabel prolongProductionboostWood" style="">'.$lang['Plus']['Plus12'].'</label>
                        ' : '
                        '.$lang['Plus']['Plus10'].' : <span class="bold">'.$p->pBonus['Duration'].'</span> '.$p->pBonus['Type'].'').'
                        </div>
                                                        </div>
                            </div>
                            <div class="feature featureBooking premiumFeatureProductionBoost">
                                <div class="dynamicContent hide" style="display: none;">
                                    <img src="img/x.gif" class="highlightArrow" alt="">
                                </div>
                                <input type="hidden" class="premiumFeatureName hide" name="featureName" value="ProductionboostClay">
            
                                <div class="featureContent">
                                    <h3 class="featureTitle">'.$lang['Plus']['Plus04'].'</h3>
                                    '.($session->bonus2 ? '<div class="featureRemainingTime featureSubtitle subtitle"><span class="renewalActive"> '.$lang['Plus']['Plus16'].' '.$generator->getTimeFormat($session->bonus2 - time()).'.</span></div>' : '').'

                                                            <div class="featureButton">
                                        <button type="button" class="gold prosButton productionboostClay" coins="5" id="buttons3QB0zqhU67l4"><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.($session->bonus2 ? $lang['Plus']['Plus14'] : $lang['Plus']['Plus13']).'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['addonProduction'].'</span></div></div></button>
                <script type="text/javascript" id="buttons3QB0zqhU67l4_script">
                window.addEvent(\'domready\', function()
                    {
                    if($(\'buttons3QB0zqhU67l4\'))
                    {
                      $(\'buttons3QB0zqhU67l4\').addEvent(\'click\', function ()
                      {
                        window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0641\u0639\u0644","confirm":"","onclick":"","title":"\u062a\u0641\u0639\u064a\u0644 \u0627\u0644\u0622\u0646 &lt;br&gt; \u0645\u062f\u0629 \u0627\u0644\u0632\u064a\u0627\u062f\u0629 \u0623\u064a\u0627\u0645 &lt;span class=&quot;bold&quot;&gt;15&lt;\/span&gt; \u0633\u0627\u0639\u0647","coins":5,"id":"buttons3QB0zqhU67l4"}]);
                      });
                    }
                    });
                </script>						</div>
                    <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">
                    '.($session->bonus2 ? '
                    <input type="checkbox" id="productionboostClay" name="productionboostClay[]" class="enumerableElements check checkbox prolongProductionboostClay" style="" '.($Travian->getAutoRenewal('productionboostClay') ? 'checked="checked"' : '').' value="'.($Travian->getAutoRenewal('productionboostClay')).'" title="">
                    <label for="productionboostClay" class="enumerableElementsCheckboxLabel prolongProductionboostClay" style="">'.$lang['Plus']['Plus12'].'</label>
                    ' : '

                    '.$lang['Plus']['Plus10'].' : <span class="bold">'.$p->pBonus['Duration'].'</span> '.$p->pBonus['Type'].'').'						</div>
                    </div>
                            </div>
                            <div class="feature featureBooking premiumFeatureProductionBoost">
                                <div class="dynamicContent hide" style="display: none;">
                                    <img src="img/x.gif" class="highlightArrow" alt="">
                                </div>
                                <input type="hidden" class="premiumFeatureName hide" name="featureName" value="ProductionboostIron">
            
                                <div class="featureContent">
                                    <h3 class="featureTitle">'.$lang['Plus']['Plus05'].'</h3>
                                    '.($session->bonus3 ? '<div class="featureRemainingTime featureSubtitle subtitle"><span class="renewalActive"> '.$lang['Plus']['Plus16'].' '.$generator->getTimeFormat($session->bonus3 - time()).'.</span></div>' : '').'
                                                            <div class="featureButton">
                                        <button type="button" class="gold prosButton productionboostIron" coins="5" id="buttonWq0JYwPbp42mU"><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.($session->bonus3 ? $lang['Plus']['Plus14'] : $lang['Plus']['Plus13']).'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['addonProduction'].'</span></div></div></button>
                <script type="text/javascript" id="buttonWq0JYwPbp42mU_script">
                window.addEvent(\'domready\', function()
                    {
                    if($(\'buttonWq0JYwPbp42mU\'))
                    {
                      $(\'buttonWq0JYwPbp42mU\').addEvent(\'click\', function ()
                      {
                        window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0641\u0639\u0644","confirm":"","onclick":"","title":"\u062a\u0641\u0639\u064a\u0644 \u0627\u0644\u0622\u0646 &lt;br&gt; \u0645\u062f\u0629 \u0627\u0644\u0632\u064a\u0627\u062f\u0629 \u0623\u064a\u0627\u0645 &lt;span class=&quot;bold&quot;&gt;15&lt;\/span&gt; \u0633\u0627\u0639\u0647","coins":5,"id":"buttonWq0JYwPbp42mU"}]);
                      });
                    }
                    });
                </script>						</div>
                <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">
                '.($session->bonus3 ? '
                <input type="checkbox" id="productionboostIron" name="productionboostIron[]" class="enumerableElements check checkbox prolongProductionboostIron" style="" '.($Travian->getAutoRenewal('productionboostIron') ? 'checked="checked"' : '').' value="'.($Travian->getAutoRenewal('productionboostIron')).'" title="">
                <label for="productionboostIron" class="enumerableElementsCheckboxLabel prolongProductionboostIron" style="">'.$lang['Plus']['Plus12'].'</label>
                ' : '

                '.$lang['Plus']['Plus10'].' : <span class="bold">'.$p->pBonus['Duration'].'</span> '.$p->pBonus['Type'].'').'
                </div>
                                                        </div>
                            </div>
                            <div class="feature featureBooking premiumFeatureProductionBoost">
                                <div class="dynamicContent hide" style="display: none;">
                                    <img src="img/x.gif" class="highlightArrow" alt="">
                                </div>
                                <input type="hidden" class="premiumFeatureName hide" name="featureName" value="ProductionboostCrop">
            
                                <div class="featureContent">
                                    <h3 class="featureTitle">'.$lang['Plus']['Plus06'].'</h3>
                                    '.($session->bonus4 ? '<div class="featureRemainingTime featureSubtitle subtitle"><span class="renewalActive"> '.$lang['Plus']['Plus16'].' '.$generator->getTimeFormat($session->bonus4 - time()).'.</span></div>' : '').'
                                                            <div class="featureButton">
                                        <button type="button" class="gold prosButton productionboostCrop" coins="5" id="button01hem2nXq0JLs"><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.($session->bonus4 ? $lang['Plus']['Plus14'] : $lang['Plus']['Plus13']).'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['addonProduction'].'</span></div></div></button>
                <script type="text/javascript" id="button01hem2nXq0JLs_script">
                window.addEvent(\'domready\', function()
                    {
                    if($(\'button01hem2nXq0JLs\'))
                    {
                      $(\'button01hem2nXq0JLs\').addEvent(\'click\', function ()
                      {
                        window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0641\u0639\u0644","confirm":"","onclick":"","title":"\u062a\u0641\u0639\u064a\u0644 \u0627\u0644\u0622\u0646 &lt;br&gt; \u0645\u062f\u0629 \u0627\u0644\u0632\u064a\u0627\u062f\u0629 \u0623\u064a\u0627\u0645 &lt;span class=&quot;bold&quot;&gt;15&lt;\/span&gt; \u0633\u0627\u0639\u0647","coins":5,"id":"button01hem2nXq0JLs"}]);
                      });
                    }
                    });
                </script>						</div>
            <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">
            '.($session->bonus4 ? '
            <input type="checkbox" id="productionboostCrop" name="productionboostCrop[]" class="enumerableElements check checkbox prolongProductionboostCrop" style="" '.($Travian->getAutoRenewal('productionboostCrop') ? 'checked="checked"' : '').' value="'.($Travian->getAutoRenewal('productionboostCrop')).'" title="">
            <label for="productionboostCrop" class="enumerableElementsCheckboxLabel prolongProductionboostCrop" style="">'.$lang['Plus']['Plus12'].'</label>
            ' : '

            '.$lang['Plus']['Plus10'].' : <span class="bold">'.$p->pBonus['Duration'].'</span> '.$p->pBonus['Type'].'').'
            </div>
                                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		</div>
            ';
                }elseif($_POST['activeTab'] == 'plusSupport'){
                    $html .= '<div id="paymentWizard" class="plusSupport">
                    <input class="paymentWizardAnswersLink hide" type="hidden" name="answersLink" value="">
            
                    <div class="contentWrapper">
                        <div class="contentBorder infoArea">
                <div class="contentBorder-tl"></div>
                <div class="contentBorder-tr"></div>
                <div class="contentBorder-tc"></div>
                <div class="contentBorder-ml"></div>
                <div class="contentBorder-mr"></div>
                <div class="contentBorder-mc"></div>
                <div class="contentBorder-bl"></div>
                <div class="contentBorder-br"></div>
                <div class="contentBorder-bc"></div>
                <div class="contentBorder-contents cf"><img src="img/x.gif" class="mentor vid_2" alt="Adviser">
                </div>
            </div>
            <div class="ocntentBorder contentArea">
                <div class="contentBorder-tl"></div>
                <div class="contentBorder-tr"></div>
                <div class="contentBorder-tc"></div>
                <div class="contentBorder-ml"></div>
                <div class="contentBorder-mr"></div>
                <div class="contentBorder-mc"></div>
                <div class="contentBorder-bl"></div>
                <div class="contentBorder-br"></div>
                <div class="contentBorder-bc"></div>
                <div class="contentBorder-contents cf">
                    <div class="plusSupportContent">
                        <h4>'.$lang['Plus']['plusSupport01'].'</h4>
            
                        <div class="boxes roundedContentBox">
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
                                <h5>'.$lang['Plus']['plusSupport02'].'</h5>
            
                                <div class="boxContent">'.$lang['Plus']['plusSupport03'].'</div>
                                <div class="footer"><a href="http://t4.answers.travian.com/index.php?aid=259#go2answer" target="_blank">'.$lang['Plus']['plusSupport04'].'</a>
                                </div>
                            </div>
                        </div>
                        <div class="boxes roundedContentBox">
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
                                <h5>'.$lang['Plus']['plusSupport05'].'</h5>
            
                                <div class="boxContent">'.$lang['Plus']['plusSupport06'].'</div>
                                <div class="footer"><a href="nachrichten.php?t=1&id=6">'.$lang['Plus']['plusSupport07'].'</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="plusSupportFooter">
                        <h5>'.$lang['Plus']['plusSupport08'].'</h5>
            
                        <div class="hint">'.$lang['Plus']['plusSupport09'].'</div>
                    </div>
                </div>
            </div>		</div>';
                }elseif($_POST['activeTab'] == 'openOrders'){
                    $html .= '<div id="paymentWizard" class="openOrders">
                    <input class="paymentWizardAnswersLink hide" type="hidden" name="answersLink" value="">
            
                    <div class="contentWrapper">
                        <div class="buyGoldContainer"><div id="openOrders"><h4>'.$lang['Plus']['oRders01'].'</h4>
            <table cellpadding="1" cellspacing="1" id="open_orders" class=" lang_'.DIRECTION.'">
                <thead>
                <tr>
                    <th>'.$lang['Plus']['oRders02'].'</th>
                    <th>'.$lang['Plus']['oRders03'].'</th>
                    <th>'.$lang['Plus']['oRders04'].'</th>
                    <th>'.$lang['Plus']['oRders05'].'</th>
                    <th>'.$lang['Plus']['oRders06'].'</th>
                </tr>
                </thead>
                <tbody>
                
                ';
                   
                if($database->queryFetch("SELECT COUNT(*) AS num FROM payments WHERE idUser = ".$session->uid."")['num'] == 0){
                    $html .=    '<tr><td colspan="6" class="noData">'.$lang['Plus']['oRders07'].'</td></tr>';
                }else{
                    $qu = $database->query("SELECT * FROM payments WHERE idUser = ".$session->uid." ORDER BY id DESC");
                    foreach($qu as $payed){
                        $html .= '
                        <tr>
                        <td>'.date('m/d/Y H:i:s', $payed['dTrans']).'</td>
                        <td>'.($payed['idTrans'] ? $lang['Plus']['oRders08'] : $lang['Plus']['oRders09']).'</td>
                        <td>'.$payed['idTrans'].'</td>
                        <td>'.$payed['gAmount'].'</td>
                        <td>'.$payed['cost'].' USD</td>
                        </tr>
                        ';
                    }
                }
                $html .= '
                </tbody>
            </table></div></div>		</div>';
                }elseif($_POST['activeTab'] == 'paymentFeatures' && $config['plusFeatures']){
                    $html .= '<div id="paymentWizard" class="paymentFeatures">
                    <input class="paymentWizardAnswersLink hide" type="hidden" name="answersLink" value="">
            
                    <div class="contentWrapper">
                        <div class="contentBorder infoArea">
                <div class="contentBorder-tl"></div>
                <div class="contentBorder-tr"></div>
                <div class="contentBorder-tc"></div>
                <div class="contentBorder-ml"></div>
                <div class="contentBorder-mr"></div>
                <div class="contentBorder-mc"></div>
                <div class="contentBorder-bl"></div>
                <div class="contentBorder-br"></div>
                <div class="contentBorder-bc"></div>
                <div class="contentBorder-contents cf">
                        <a href="#" onclick="jQuery(\'.paymentWizardMenu\').addClass(\'hide\');jQuery(\'.buyGoldInfoStep\').removeClass(\'active\');jQuery(\'.buyGoldInfoStep#1\').addClass(\'active\');jQuery(\'.paymentWizardMenu#generalOptions\').removeClass(\'hide\');">
                            <div class="buyGoldInfoStep active" id="1">
                                <div class="buyGoldInfoStepNumber">1</div>
                                <div class="buyGoldInfoStepLabel">'.$lang['Plus']['General'].':
                                </div>
                                <div class="buyGoldInfoStepContent">'.$lang['Plus']['GSetting'].'</div>
                            </div>
                        </a>
                        <a href="#" onclick="jQuery(\'.paymentWizardMenu\').addClass(\'hide\');jQuery(\'.buyGoldInfoStep\').removeClass(\'active\');jQuery(\'.buyGoldInfoStep#2\').addClass(\'active\');jQuery(\'.paymentWizardMenu#buyResources\').removeClass(\'hide\');">
                            <div class="buyGoldInfoStep " id="2">
                                <div class="buyGoldInfoStepNumber">2</div>
                                <div class="buyGoldInfoStepLabel">'.$lang['Plus']['Troops'].':
                                </div>
                                <div class="buyGoldInfoStepContent">'.$lang['Plus']['BuyRes'].'</div>
                            </div>
                        </a>
                        <a href="#" onclick="jQuery(\'.paymentWizardMenu\').addClass(\'hide\');jQuery(\'.buyGoldInfoStep\').removeClass(\'active\');jQuery(\'.buyGoldInfoStep#3\').addClass(\'active\');jQuery(\'.paymentWizardMenu#moreProtection\').removeClass(\'hide\');">
                            <div class="buyGoldInfoStep " id="3">
                                <div class="buyGoldInfoStepNumber">3</div>
                                <div class="buyGoldInfoStepLabel">'.$lang['Plus']['Protection'].':
                                </div>
                                <div class="buyGoldInfoStepContent">'.$lang['Plus']['PPacks'].'</div>
                            </div>
                        </a>
                        <!--
                        <a href="#" onclick="jQuery(\'.paymentWizardMenu\').addClass(\'hide\');jQuery(\'.buyGoldInfoStep\').removeClass(\'active\');jQuery(\'.buyGoldInfoStep#4\').addClass(\'active\');jQuery(\'.paymentWizardMenu#power\').removeClass(\'hide\');">
                            <div class="buyGoldInfoStep " id="4">
                                <div class="buyGoldInfoStepNumber">4</div>
                                <div class="buyGoldInfoStepLabel">Power</div>
                                <div class="buyGoldInfoStepContent">Reward attack/Defense</div>
                            </div>
                        </a>-->
                            <script type="text/javascript">
                        function productPurchased(data) {
                                var dialog = new Travian.Dialog.Dialog({preventFormSubmit: true});
                            if (data.type === \'animal\') {
                                dialog.setContent(\'Wild has been purchased\');
                            } else if (data.type === \'troops\') {
                                dialog.setContent(\'Troops has been purchased\');
                            } else {
                                dialog.setContent(\'Resources has been purchased\');
                            }
                            dialog.show();
                            jQuery(".accountBalance span")[0].html(data.newGold);
                        }
                    </script>
                </div>
            </div>
            <div class="contentBorder contentArea">
                <div class="contentBorder-tl"></div>
                <div class="contentBorder-tr"></div>
                <div class="contentBorder-tc"></div>
                <div class="contentBorder-ml"></div>
                <div class="contentBorder-mr"></div>
                <div class="contentBorder-mc"></div>
                <div class="contentBorder-bl"></div>
                <div class="contentBorder-br"></div>
                <div class="contentBorder-bc"></div>
                <div class="contentBorder-contents cf">
                    <div class="paymentPopupDialogWrapper">
                        <div class="paymentWizardMenu " id="generalOptions">
                    <!-- <div class="feature featureBooking "><input type="hidden" class="premiumFeatureName hide" name="featureName" value="upgradeAllResourcesTo20"><div class="featureContent"><h3 class="featureTitle">'.$lang['Plus']['GS01'].'</h3><div class="featureRemainingTime featureSubtitle subtitle"><span class="">'.$lang['Plus']['GS01'].'</span></div><div class="featureButton">
                    <button type="button" class="gold prosButton upgradeAllResourcesTo20 '.(!$p->checkupAll() ? 'disabled' : '').'" coins="200" id="buttonW1" onclick=""><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.(MAX_LEVEL_COST * 18).'</span></div></div>
                    </button>
                    '.($p->checkupAll() ? '<script type="text/javascript" id="buttonW1_script">
                    window.addEvent(\'domready\', function () {
                        if ($(\'buttonW1\')) {
                            $(\'buttonW1\').addEvent(\'click\', function () {
                                window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"upgradeAllResourcesTo20","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.(MAX_LEVEL_COST * 18).',"id":"buttonW1"}]);
                            });
                        }
                    });</script>' : '').'
                    
                    </div>
                    <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Deliver'].': <span class="bold">'.$lang['Plus']['Immidiate'].'</span>    </div></div></div> -->

                    '.($config['storageUpgrade'] ? '<div class="feature featureBooking "><input type="hidden" class="premiumFeatureName hide" name="featureName" value="increaseStorage"><div class="featureContent"><h3 class="featureTitle">'.$lang['Plus']['GS02'].'</h3><div class="featureRemainingTime featureSubtitle subtitle"><span class="">'.$lang['Plus']['GS02I'].'</span></div><div class="featureButton"><button type="button" class="gold prosButton increaseStorage" coins="'.$config['storageUpgrade'].'" id="buttonV2" onclick=""><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['storageUpgrade'].'</span></div></div></button>
                <script type="text/javascript" id="buttonV2_script">

                window.addEvent(\'domready\', function () {
                    if ($(\'buttonV2\')) {
                        $(\'buttonV2\').addEvent(\'click\', function () {
                            window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"increaseStorage","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.$config['storageUpgrade'].',"id":"buttonV2"}]);
                        });
                    }
                });
                </script></div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Deliver'].': <span class="bold">'.$lang['Plus']['Immidiate'].'</span>    </div></div></div>' : '').'
                    
                
                <!--
				<div class="feature featureBooking "><input type="hidden" class="premiumFeatureName hide" name="featureName" value="finishTraining"><div class="featureContent"><h3 class="featureTitle">'.$lang['Plus']['GS03'].'</h3><div class="featureRemainingTime featureSubtitle subtitle"><span class="">'.$lang['Plus']['GS03I'].'</span></div><div class="featureButton"><button type="button" class="gold prosButton finishTraining" coins="1" id="buttonH3" onclick=""><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.FINISH_ALL_COST.'</span></div></div></button>
                <script type="text/javascript" id="buttonH3_script">
                window.addEvent(\'domready\', function () {
                    if ($(\'buttonH3\')) {
                        $(\'buttonH3\').addEvent(\'click\', function () {
                            window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"finishTraining","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.FINISH_ALL_COST.',"id":"buttonH3"}]);
                    });
                }
            });
            </script></div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Deliver'].': <span class="bold">'.$lang['Plus']['Immidiate'].'</span>    </div></div></div> -->
            
            '.($config['25pFaster'] ? '<div class="feature featureBooking "><input type="hidden" class="premiumFeatureName hide" name="featureName" value="fasterTraining"><div class="featureContent"><h3 class="featureTitle">'.$lang['Plus']['GS04'].'</h3><div class="featureRemainingTime featureSubtitle subtitle"><span class="">'.$lang['Plus']['GS04I'].'</span></div><div class="featureButton"><button type="button" class="gold prosButton fasterTraining" coins="'.$config['25pFaster'].'" id="buttonn4" onclick=""><div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['25pFaster'].'</span></div></div></button>
        <script type="text/javascript" id="buttonn4_script">
        window.addEvent(\'domready\', function () {
            if ($(\'buttonn4\')) {
                $(\'buttonn4\').addEvent(\'click\', function () {
                    window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"fasterTraining","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.$config['25pFaster'].',"id":"buttonn4"}]);
            });
        }
    });
        </script></div>
        '.($p->pAData('fasterTraining') > time() ? '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle"><span class="renewalActive">Expired in <span class="timer" counting="down" value="'.($p->pAData('fasterTraining')-time()).'">'.$generator->getTimeFormat($p->pAData('fasterTraining')-time()).'</span>.</span></div>' : 
        '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Plus10'].': <span class="bold">12</span>  '.$lang['Plus']['Hour'].'  </div>').'</div></div>' : '').'
        
        '.($config['allSmithy'] ? '<div class="feature featureBooking "><input type="hidden" class="premiumFeatureName hide" name="featureName" value="smithyUpgradeAllToMax"><div class="featureContent"><h3 class="featureTitle">'.$lang['Plus']['GS05'].'</h3><div class="featureRemainingTime featureSubtitle subtitle"><span class="">'.$lang['Plus']['GS05I'].'</span></div><div class="featureButton"><button type="button" class="gold prosButton smithyUpgradeAllToMax" coins="'.$config['allSmithy'].'" id="buttonI5" onclick=""><div class="button-container addHoverClick">
        <div class="button-background">
            <div class="buttonStart">
                <div class="buttonEnd">
                    <div class="buttonMiddle"></div>
                </div>
            </div>
        </div>
        <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['allSmithy'].'</span></div></div></button>
    <script type="text/javascript" id="buttonI5_script">
        window.addEvent(\'domready\', function () {
            if ($(\'buttonI5\')) {
                $(\'buttonI5\').addEvent(\'click\', function () {
                    window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"smithyUpgradeAllToMax","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.$config['allSmithy'].',"id":"buttonI5"}]);
            });
        }
        });
    </script></div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Deliver'].': <span class="bold">'.$lang['Plus']['Immidiate'].'</span>    </div></div></div>' : '').'
    
    '.($config['searchAll'] ? '<div class="feature featureBooking "><input type="hidden" class="premiumFeatureName hide" name="featureName" value="academyResearchAll"><div class="featureContent"><h3 class="featureTitle">'.$lang['Plus']['GS06'].'</h3><div class="featureRemainingTime featureSubtitle subtitle"><span class="">'.$lang['Plus']['GS06I'].'</span></div><div class="featureButton">
    <button type="button" '.($p->academyAll() ? '' : 'title="We searched for the collection Units in the village."').' class="gold prosButton academyResearchAll '.($p->academyAll() ? '' : 'disabled').'" coins="'.$config['searchAll'].'" id="buttonL6" onclick=""><div class="button-container addHoverClick">
        <div class="button-background">
            <div class="buttonStart">
                <div class="buttonEnd">
                    <div class="buttonMiddle"></div>
                </div>
            </div>
        </div>
        <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['searchAll'].'</span></div></div></button>
    '.($p->academyAll() ? '<script type="text/javascript" id="buttonL6_script">
    window.addEvent(\'domready\', function () {
        if ($(\'buttonL6\')) {
            $(\'buttonL6\').addEvent(\'click\', function () {
                window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"academyResearchAll","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.$config['searchAll'].',"id":"buttonL6"}]);
        });
    }
});
    </script>' : '').'
    </div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Deliver'].': <span class="bold">'.$lang['Plus']['Immidiate'].'</span>    </div></div></div>' : '').' </div>

                    <div class="paymentWizardMenu hide" id="buyResources">
                    '.($config['resources01'] ? '<div class="feature featureBooking " style="height: 58px"><input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyResources0"><div class="featureContent"><table style="width: 80%; border: 0"><tbody><tr style="border: 0;"><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r1"></i>&nbsp;<span class="value ">'.number_format($config['resources01A']).'</span></div></td><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r2"></i>&nbsp;<span class="value ">'.number_format($config['resources01A']).'</span></div></td></tr><tr style="border: 0;"><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r3"></i>&nbsp;<span class="value ">'.number_format($config['resources01A']).'</span></div></td><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r4"></i>&nbsp;<span class="value ">'.number_format($config['resources01A']).'</span></div></td></tr></tbody></table><div class="featureButton"><button type="button" class="gold prosButton buyResources0" coins="'.$config['resources01'].'" id="buttonY7" onclick=""><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['resources01'].'</span></div></div></button>
                    <script type="text/javascript" id="buttonY7_script">
                    window.addEvent(\'domready\', function () {
                    if ($(\'buttonY7\')) {
                        $(\'buttonY7\').addEvent(\'click\', function () {
                            window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"buyResources0","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.$config['resources01'].',"id":"buttonY7"}]);
                    });
                    }
                    });
                    </script></div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Deliver'].': <span class="bold">'.$lang['Plus']['Immidiate'].'</span>  </div></div></div>' : '').'

                    '.($config['resources02'] ? '<div class="feature featureBooking " style="height: 58px"><input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyResources1"><div class="featureContent"><table style="width: 80%; border: 0"><tbody><tr style="border: 0;"><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r1"></i>&nbsp;<span class="value ">'.number_format($config['resources02A']).'</span></div></td><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r2"></i>&nbsp;<span class="value ">'.number_format($config['resources02A']).'</span></div></td></tr><tr style="border: 0;"><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r3"></i>&nbsp;<span class="value ">'.number_format($config['resources02A']).'</span></div></td><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r4"></i>&nbsp;<span class="value ">'.number_format($config['resources02A']).'</span></div></td></tr></tbody></table><div class="featureButton"><button type="button" class="gold prosButton buyResources1" coins="'.$config['resources02'].'" id="buttong8" onclick=""><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['resources02'].'</span></div></div></button>
                <script type="text/javascript" id="buttong8_script">
                window.addEvent(\'domready\', function () {
                    if ($(\'buttong8\')) {
                        $(\'buttong8\').addEvent(\'click\', function () {
                            window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"buyResources1","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.$config['resources02'].',"id":"buttong8"}]);
                    });
                }
            });
                </script></div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Deliver'].': <span class="bold">'.$lang['Plus']['Immidiate'].'</span>  </div></div></div>' : '').'

                '.($config['resources03'] ? '<div class="feature featureBooking " style="height: 58px"><input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyResources2"><div class="featureContent"><table style="width: 80%; border: 0"><tbody><tr style="border: 0;"><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r1"></i>&nbsp;<span class="value ">'.number_format($config['resources03A']).'</span></div></td><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r2"></i>&nbsp;<span class="value ">'.number_format($config['resources03A']).'</span></div></td></tr><tr style="border: 0;"><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r3"></i>&nbsp;<span class="value ">'.number_format($config['resources03A']).'</span></div></td><td style="border: 0; height: 20%;"><div class="inlineIcon resources"><i class="r4"></i>&nbsp;<span class="value ">'.number_format($config['resources03A']).'</span></div></td></tr></tbody></table><div class="featureButton"><button type="button" class="gold prosButton buyResources2" coins="'.$config['resources03'].'" id="buttonI9" onclick=""><div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['resources03'].'</span></div></div></button>
            <script type="text/javascript" id="buttonI9_script">
            window.addEvent(\'domready\', function () {
                if ($(\'buttonI9\')) {
                    $(\'buttonI9\').addEvent(\'click\', function () {
                        window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"buyResources2","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.$config['resources03'].',"id":"buttonI9"}]);
                });
            }
        });
            </script></div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Deliver'].': <span class="bold">'.$lang['Plus']['Immidiate'].'</span>  </div></div></div>' : '').'
                
                </div>
            <div class="paymentWizardMenu hide" id="power">
            '.($config['protect01'] ? '' : '').'
                
                
                <div class="feature featureBooking "><input type="hidden" class="premiumFeatureName hide" name="featureName" value="defBonus"><div class="featureContent"><h3 class="featureTitle">+ 15% Defense Bonus</h3><div class="featureRemainingTime featureSubtitle subtitle"><span class="">Increase force when accompanying the Hero</span></div><div class="featureButton"><button type="button" class="gold prosButton defBonus" coins="100" id="buttonR11" onclick=""><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span></div></div></button>
                <script type="text/javascript" id="buttonR11_script">
                jQuery(function()
                    {
                      jQuery(\'#buttonR11\').click(function (event)
                      {
                        jQuery(window).trigger(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"defBonus","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":100,"id":"buttonR11"}]);
                      });
                    });
                </script></div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Plus10'].': <span class="bold">10</span>  '.$lang['Plus']['Hour'].'  </div></div></div>                                    </div>
                <div class="paymentWizardMenu hide" id="moreProtection">';
                    if($session->protect){
                        $html .= '<h5 class="round">'.$lang['Plus']['PR03'].' '.$generator->getTimeFormat(($session->protection-time())).' '.$lang['Plus']['PR04'].'</h5>';
                    }else{
                        $html .= '<h5 class="round">'.$lang['Plus']['PR05'].'</h5>';
                    }
                    
                    $html .= '<br>
                    '.($config['protect01'] ? '<div class="feature featureBooking "><input type="hidden" class="premiumFeatureName hide" name="featureName" value="moreProtection0"><div class="featureContent"><h3 class="featureTitle">'.$lang['Plus']['PR01'].'</h3><div class="featureRemainingTime featureSubtitle subtitle"><span class="">'.$lang['Plus']['PR02'].'</span></div><div class="featureButton"><button type="button" class="gold prosButton moreProtection0" coins="'.$config['protect01'].'" id="buttonb12" onclick=""><div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['protect01'].'</span></div></div></button>
                <script type="text/javascript" id="buttonb12_script">
                window.addEvent(\'domready\', function () {
                    if ($(\'buttonb12\')) {
                        $(\'buttonb12\').addEvent(\'click\', function () {
                            window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"moreProtection0","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.$config['protect01'].',"id":"buttonb12"}]);
                    });
                }
            });
                </script></div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Plus10'].': <span class="bold">1</span>  '.$lang['Plus']['Hour'].'  </div></div></div>' : '').'
                    
                '.($config['protect02'] ? '<div class="feature featureBooking "><input type="hidden" class="premiumFeatureName hide" name="featureName" value="moreProtection1"><div class="featureContent"><h3 class="featureTitle">'.$lang['Plus']['PR01'].'</h3><div class="featureRemainingTime featureSubtitle subtitle"><span class="">'.$lang['Plus']['PR02'].'</span></div><div class="featureButton"><button type="button" class="gold prosButton moreProtection1" coins="'.$config['protect02'].'" id="buttonT13" onclick=""><div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['protect02'].'</span></div></div></button>
            <script type="text/javascript" id="buttonT13_script">
            window.addEvent(\'domready\', function () {
                if ($(\'buttonT13\')) {
                    $(\'buttonT13\').addEvent(\'click\', function () {
                        window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"moreProtection1","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.$config['protect02'].',"id":"buttonT13"}]);
                });
            }
        });
            </script></div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Plus10'].': <span class="bold">3</span>  '.$lang['Plus']['Hour'].'  </div></div></div>' : '').'
                
            '.($config['protect03'] ? '<div class="feature featureBooking "><input type="hidden" class="premiumFeatureName hide" name="featureName" value="moreProtection2"><div class="featureContent"><h3 class="featureTitle">'.$lang['Plus']['PR01'].'</h3><div class="featureRemainingTime featureSubtitle subtitle"><span class="">'.$lang['Plus']['PR02'].'</span></div><div class="featureButton"><button type="button" class="gold prosButton moreProtection2" coins="'.$config['protect03'].'" id="buttonq14" onclick=""><div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content">'.$lang['Plus']['BuyButton'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$config['protect03'].'</span></div></div></button>
        <script type="text/javascript" id="buttonq14_script">
        window.addEvent(\'domready\', function () {
            if ($(\'buttonq14\')) {
                $(\'buttonq14\').addEvent(\'click\', function () {
                    window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"\u0634\u0631\u0627\u0621","confirm":"","onclick":"","wayOfPayment":{"featureKey":"moreProtection2","context":"paymentWizard"},"title":"\u0634\u0631\u0627\u0621","coins":'.$config['protect03'].',"id":"buttonq14"}]);
            });
        }
    });
        </script></div><div class="featureDuration featureRenewal featureButtonSubtitle subtitle">'.$lang['Plus']['Plus10'].': <span class="bold">6</span>  '.$lang['Plus']['Hour'].'  </div></div></div>' : '').'
                
                
                </div>
                                </div>
                </div>
            </div>
                    </div>';
                }
                $html .= '<div class="header">
                            <ul>
                                <li '.($_POST['activeTab'] == 'buyGold' ? 'class="active"' : '').'>
                                    <a href="#" class="tabButton buyGold" onclick="return false;">
                                        <div class="tabBtnBGPart start">
                                            <div class="tabBtnBGPart end">
                                                <div class="tabBtnBGPart middle"></div>
                                            </div>
                                        </div>
                                        <div class="text">'.$lang['Plus']['Buy'].'</div>
                                        <img src="img/x.gif" class="tabBtnImg">
                                    </a>
                
                                    <div class="tabBorder"></div>
                                </li>
                                <li '.($_POST['activeTab'] == 'pros' ? 'class="active"' : 'style="margin-top: -1px; height: 33px;"').'>
                                    <a href="#" class="tabButton pros" onclick="return false;">
                                        <div class="tabBtnBGPart start">
                                            <div class="tabBtnBGPart end">
                                                <div class="tabBtnBGPart middle"></div>
                                            </div>
                                        </div>
                                        <div class="text">'.$lang['Plus']['Features'].'</div>
                                        <img src="img/x.gif" class="tabBtnImg">
                                    </a>
                
                                    <div class="tabBorder"></div>
                                </li>
                                <li '.($_POST['activeTab'] == 'plusSupport' ? 'class="active"' : 'style="margin-top: -1px; height: 33px;"').'>
                                    <a href="#" class="tabButton plusSupport" onclick="return false;">
                                        <div class="tabBtnBGPart start">
                                            <div class="tabBtnBGPart end">
                                                <div class="tabBtnBGPart middle"></div>
                                            </div>
                                        </div>
                                        <div class="text">'.$lang['Plus']['Support'].'</div>
                                        <img src="img/x.gif" class="tabBtnImg">
                                    </a>
                
                                    <div class="tabBorder"></div>
                                </li>
                                <li '.($_POST['activeTab'] == 'openOrders' ? 'class="active"' : 'style="margin-top: -1px; height: 33px;"').'>
                                    <a href="#" class="tabButton openOrders" onclick="return false;">
                                        <div class="tabBtnBGPart start">
                                            <div class="tabBtnBGPart end">
                                                <div class="tabBtnBGPart middle"></div>
                                            </div>
                                        </div>
                                        <div class="text">'.$lang['Plus']['Orders'].'</div>
                                        <img src="img/x.gif" class="tabBtnImg">
                                    </a>
                                    <div class="tabBorder"></div>
                                </li>
                                '.($config['plusFeatures'] ? '<li '.($_POST['activeTab'] == 'paymentFeatures' ? 'class="active"' : 'style="margin-top: -1px; height: 33px;"').'>
                                <a href="#" class="tabButton paymentFeatures" onclick="return false;">
                                    <div class="tabBtnBGPart start">
                                        <div class="tabBtnBGPart end">
                                            <div class="tabBtnBGPart middle"></div>
                                        </div>
                                    </div>
                                    <div class="text"><img src="img/starGold.png" style="vertical-align: middle;width: 22px;">&nbsp;'.$lang['Plus']['PFeatures'].'							</div>
                                    <!--  <img src="img/x.gif" class="tabBtnImg"> -->
                                </a>

                                <div class="tabBorder"></div>
                                </li>' : '').'
                                
                                                <li class="clear"></li>
                            </ul>
                        </div>
                        <div class="headerPlayerInfo">
                                '.($_POST['activeTab'] == 'buyGold' ? '<div id="locationSelector">'.$lang['Plus']['Location'].':<select name="location" class="buyGoldLocation"><option value="2" selected="">International - English</option></select></div>' : '').'
                                <div class="accountBalance v2">
                                '.$lang['Plus']['Gold'].': <img src="img/x.gif" class="gold" alt="'.$lang['Plus']['Gold'].'">
                                <span>'.$session->gold.'</span>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    </div>';
                    echo '{"response": {"error":false,"errorMsg":null,"data":{"html":'.json_encode($html).'}}}';

                break;

                case 'getGoldAmount':
                    echo '{"response":{"error":false,"errorMsg":null,"data":{"goldAmount":'.$session->gold.'}}}';
                break;

                case 'bb':
                    $input = $_POST['text'];
                    include('application/BBCode.php');
                    echo '{"response":{"error":false,"errorMsg":null,"data":{"text":'.json_encode(stripslashes(nl2br($bbcoded))).'}}}';
                break;

                case 'redeemCode':
            
                    $_POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
                    $Q = $database->query("SELECT * FROM codes WHERE codeNum = '".$_POST['redeemCode']."'");
                    if(count($Q) > 0){
                        if($Q[0]['isUsed']){
                            $Error = 'codeIsUsed';
                        }else{
                            $database->query("UPDATE codes SET isUsed = 1, idUser = ".$session->uid." WHERE id = ".$Q[0]['id']."");
                            $database->modifyGold($session->uid,$Q[0]['goldAmount'],1);
                            $Error = 'redeemSuccess';
                        }
                    }else{
                        $Error = 'invalidCode';
                    }

                    echo '{"response":{"error":false,"errorMsg":null,"data":{"result":false,"errorMsg":"'.$Error.'"}}}';
                break;

                case 'plusPopup':
                    echo '{"response":{"error":false,"errorMsg":null,"data":{"title":"'.$lang['Plus']['popupPlus01'].'","gold":"'.$lang['Plus']['Gold'].': <img src=\"img\/x.gif\" class=\"gold\" alt=\"'.$lang['Plus']['Gold'].'\"\/> <span class=\"bold\">'.$session->gold.'<\/span>","subHeadLine":"'.$lang['Plus']['popupPlus02'].'","goldButton":"<button type=\"button\" class=\"gold \" title=\"'.$lang['Plus']['popupPlus19'].'||'.$lang['Plus']['popupPlus20'].' '.$p->plus['Duration'].' '.$p->plus['Type'].'\" coins=\"'.$config['Plus'].'\" id=\"buttongL7H8r7odsrtQ\"><div class=\"button-container addHoverClick\">\n\t\t<div class=\"button-background\">\n\t\t\t<div class=\"buttonStart\">\n\t\t\t\t<div class=\"buttonEnd\">\n\t\t\t\t\t<div class=\"buttonMiddle\"><\/div>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t<\/div>\n\t\t<div class=\"button-content\">'.($session->plus ? $lang['Plus']['Plus14'] : $lang['Plus']['Plus13']).'<img src=\"img\/x.gif\" class=\"goldIcon\" alt=\"\" \/><span class=\"goldValue\">'.$config['Plus'].'<\/span><\/div><\/button>\n    <script type=\"text\/javascript\" id=\"buttongL7H8r7odsrtQ_script\">\n    window.addEvent(\'domready\', function()\n        {\n        if($(\'buttongL7H8r7odsrtQ\'))\n        {\n          $(\'buttongL7H8r7odsrtQ\').addEvent(\'click\', function ()\n          {\n            window.fireEvent(\'buttonClicked\', [this, {\"type\":\"button\",\"value\":\"\\u0641\\u0639\\u0644\",\"confirm\":\"\",\"onclick\":\"\",\"title\":\" \\u062a\\u0641\\u0639\\u064a\\u0644 \\u0627\\u0644\\u0622\\u0646 &lt;br&gt; \\u0627\\u0644\\u0648\\u0642\\u062a :  &lt;span class=&quot;bold&quot;&gt;'.(PLUS_TIME / (60*60)).'&lt;\\\/span&gt; \\u0633\\u0627\\u0639\\u0647 \\u064a\\u0648\\u0645\",\"coins\":10,\"id\":\"buttongL7H8r7odsrtQ\"}]);\n          });\n        }\n        });\n    <\/script>","buttonSubtitle":"'.$lang['Plus']['Plus10'].': <span class=\"bold\"><span class=\"bold\">'.$p->plus['Duration'].'<\/span> '.$p->plus['Type'].'<\/span>","plusPopupButtonExtraFeatures":"'.$lang['Plus']['popupPlus03'].':","features":{"attackWarning":{"title":"'.$lang['Plus']['popupPlus04'].'","text":"'.$lang['Plus']['popupPlus05'].'"},"buildingQueue":{"title":"'.$lang['Plus']['popupPlus06'].'","text":"'.$lang['Plus']['popupPlus07'].'"},"directLinks":{"title":"'.$lang['Plus']['popupPlus16'].'","text":"'.$lang['Plus']['popupPlus17'].'"},"linkList":{"title":"'.$lang['Plus']['popupPlus08'].'","text":"'.$lang['Plus']['popupPlus09'].'"},"villageStatistics":{"title":"'.$lang['Plus']['popupPlus10'].'","text":"'.$lang['Plus']['popupPlus11'].'"},"fullScreen":{"title":"'.$lang['Plus']['popupPlus12'].'","text":"'.$lang['Plus']['popupPlus13'].'"},"tradeMulti":{"title":"'.$lang['Plus']['popupPlus14'].'","text":"'.$lang['Plus']['popupPlus15'].'"}},"furtherInfos":"'.str_replace('%s','<b>'.$p->plus['Duration'].'</b> '.$p->plus['Type'],$lang['Plus']['popupPlus18']).'"}}}';
                break;

                case 'hasClass':
                    echo '{"response": {"error":false,"errorMsg":null,"data":{}}}';
                break;
                
                case 'mapPositionData':
                    include('application/views/Ajax/mapPosition.php');
                break;


                case 'preferences':
                    //print_r($_POST); die();
                    /*
                    Array ( [cmd] => preferences [key] => travian_toggle_infobox 
                    [value] => collapsed [ajaxToken] => de3768730d5610742b5245daa67b12cd )
                    */
                    //if($_POST['key'] == 'travian_toggle_infobox'){

                    //}else{
                        if($session->questNum == 2 && $session->qData['step1'] == 0){
                            $database->query("UPDATE quests SET step1 = 1 WHERE userid = ".$session->uid."");
                            echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                        }

                        if($session->questNum == 2 && $session->qData['step1'] == 1 && $session->qData['step2'] == 1 && $session->qData['step3'] == 0){
                            //$database->query("UPDATE quests SET step3 = 1 WHERE userid = ".$session->uid."");
                            $database->query("UPDATE quests SET isFinished = 1 WHERE userid = ".$session->uid."");
                            echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}';
                        }

                        echo '{"response":{"error":false,"errorMsg":null,"data":[]}}';
                    //}
                break;

                case 'prepareMarketplace':
                    echo '{"response":{"error":false,"errorMsg":null,"data":{"errorMessage":"\u0627\u0644\u0625\u062d\u062f\u0627\u062b\u064a\u0627\u062a \u063a\u064a\u0631 \u0635\u062d\u064a\u062d\u0629","notice":"","button":"","formular":""}}}';
                break;

                case 'finishNowPopup': 
                    //if($session->gold >= 2){
                        echo $ajax->finishNowPopup(); 
                    //}
                    /*else{
                        include('application/views/gold/notEnough.php');
                    }*/
                    
                break;

                case 'ignoreList':       
                    //print_r($_POST); die(); 
                    if($_POST['method'] == 'render_ignore_list'){
                        $i=0;
                        $igList = $database->query("SELECT * FROM `ignore` WHERE `uid` = ".$session->uid." ORDER BY id DESC");
                        $outData = $outDatan = array();
                        $html = '<div id="ignore-list-columns">';
                            foreach($igList as $igData){
                                $i++;
                                $outDatan[] = $i;
                                $outData[] = $igData;                                
                            }
                            if($i != 0){
                                $html .= '
                                <table class="column column1">
                                <tbody>';
                                for($x=1;$x<=10;$x++){
                                    if($outDatan[$x-1] == $x){
                                        $uData = $database->getUserInfo($outData[$x-1]['uignored']);
                                        $html .= '
                                        <tr>
                                            <td class="end"><button type="submit" class="icon " onclick="unignoreUser('.$uData['id'].');"><img src="img/x.gif" class="del unignore-user" alt="del unignore-user"></button></td>
                                            <td><a href="spieler.php?uid='.$uData['id'].'">'.$uData['username'].'</a></td>
                                            <td class="end">&nbsp;</td>
                                        </tr>';    
                                    }else{
                                        $html .= '
                                        <tr>
                                            <td class="end">&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="end">&nbsp;</td>
                                        </tr>
                                        ';
                                    }
                                }
                                $html .= '</tbody></table>';
                                $html .= '
                                <table class="column column2">
                                <tbody>';
                                for($x=11;$x<=20;$x++){
                                    if($outDatan[$x-1] == $x){
                                        $uData = $database->getUserInfo($outData[$x-1]['uignored']);
                                        $html .= '
                                        <tr>
                                            <td class="end"><button type="submit" class="icon " onclick="unignoreUser('.$uData['id'].');"><img src="img/x.gif" class="del unignore-user" alt="del unignore-user"></button></td>
                                            <td><a href="spieler.php?uid='.$uData['id'].'">'.$uData['username'].'</a></td>
                                            <td class="end">&nbsp;</td>
                                        </tr>';    
                                    }else{
                                        $html .= '
                                        <tr>
                                            <td class="end">&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="end">&nbsp;</td>
                                        </tr>
                                        ';
                                    }
                                }
                                $html .='</tbody></table>';
                            }
                        $html .= '</div>';

                        $html .= '<div class="clear"></div><div><table><tfoot><tr><td colspan="6">'.$i.'/20</td></tr><tr><td colspan="6">'.Ignored01.'</td></tr></tfoot></table></div>';
                        echo '{"response":{"error":false,"errorMsg":null,"data":{"result":'.json_encode($html).'}}}';
                        //echo '{"response":{"error":false,"errorMsg":null,"data":{"result":"<div id=\'ignore-list-columns\'><\/div><div class=\"clear\"><\/div><div><table><tfoot><tr><td colspan=\"6\">0\/20<\/td><\/tr><tr><td colspan=\"6\">\u0644\u062a\u062c\u0627\u0647\u0644 \u0627\u0644\u0631\u0633\u0627\u0626\u0644 \u0645\u0646 \u0644\u0627\u0639\u0628 \u0645\u0639\u064a\u0646\u060c \u0627\u0646\u062a\u0642\u0644 \u0625\u0644\u0649 \u0645\u0644\u0641\u0647 \u0627\u0644\u0634\u062e\u0635\u064a \u0648\u0627\u0646\u0642\u0631 \u0639\u0644\u0649 \"\u062a\u062c\u0627\u0647\u0644\"!<\/td><\/tr><\/tfoot><\/table><\/div>"}}}';
                    }elseif($_POST['method'] == 'stop_ignore_target_player'){

                        if($database->getUserInfo($_POST['params']['targetPlayer'])['id']){
                            if($database->queryFetch('SELECT COUNT(*) AS num FROM `ignore` WHERE `uid` = '.$session->uid.' AND `uignored` = '.$_POST['params']['targetPlayer'].'')['num'] != 0){
                                $database->query('DELETE FROM `ignore` WHERE `uid` = '.$session->uid.' AND `uignored` = '.$_POST['params']['targetPlayer'].'');
                            }
                            //echo '{"response":{"error":false,"errorMsg":null,"data":{"result":"<a class=\"message messageStatus messageStatusUnread\" href=\"nachrichten.php?t=1&amp;id='.$_POST['params']['targetPlayer'].'\">'.rMessage.'<\/a><br \/><br \/><a href=\"\" id=\"ignore-player-button\" data-player-ignored=\"false\" data-uid=\"'.$_POST['params']['targetPlayer'].'\" title=\"'.Ignored02.'\">'.Ignored02.'<\/a>"}}}';
                        }

                        if($_POST['renderIgnoreList'] == 'true'){
                            $i=0;
                            $igList = $database->query("SELECT * FROM `ignore` WHERE `uid` = ".$session->uid."");
                            $outData = array();
                            $html = '<div id="ignore-list-columns">';
                                foreach($igList as $igData){
                                    $i++;
                                    $outDatan[] = $i;
                                    $outData[] = $igData;                                
                                }
                                if($i != 0){
                                    $html .= '
                                    <table class="column column1">
                                    <tbody>';
                                    for($x=1;$x<=10;$x++){
                                        if($outDatan[$x-1] == $x){
                                            $uData = $database->getUserInfo($outData[$x-1]['uignored']);
                                            $html .= '
                                            <tr>
                                                <td class="end"><button type="submit" class="icon " onclick="unignoreUser('.$uData['id'].');"><img src="img/x.gif" class="del unignore-user" alt="del unignore-user"></button></td>
                                                <td><a href="spieler.php?uid='.$uData['id'].'">'.$uData['username'].'</a></td>
                                                <td class="end">&nbsp;</td>
                                            </tr>';    
                                        }else{
                                            $html .= '
                                            <tr>
                                                <td class="end">&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td class="end">&nbsp;</td>
                                            </tr>
                                            ';
                                        }
                                    }
                                    $html .= '</tbody></table>';
                                    $html .= '
                                    <table class="column column2">
                                    <tbody>';
                                    for($x=10;$x<=20;$x++){
                                        if($outDatan[$x-1] == $x){
                                            $uData = $database->getUserInfo($outData[$x-1]['uignored']);
                                            $html .= '
                                            <tr>
                                                <td class="end"><button type="submit" class="icon " onclick="unignoreUser('.$uData['id'].');"><img src="img/x.gif" class="del unignore-user" alt="del unignore-user"></button></td>
                                                <td><a href="spieler.php?uid='.$uData['id'].'">'.$uData['username'].'</a></td>
                                                <td class="end">&nbsp;</td>
                                            </tr>';    
                                        }else{
                                            $html .= '
                                            <tr>
                                                <td class="end">&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td class="end">&nbsp;</td>
                                            </tr>
                                            ';
                                        }
                                    }
                                    $html .='</tbody></table>';
                                }
                            $html .= '</div>';
    
                            $html .= '<div class="clear"></div><div><table><tfoot><tr><td colspan="6">0/20</td></tr><tr><td colspan="6">'.Ignored01.'</td></tr></tfoot></table></div>';
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"result":'.json_encode($html).'}}}';    
                        }else{
                            echo '{"response":{"error":false,"errorMsg":null,"data":{"result":"<a class=\"message messageStatus messageStatusUnread\" href=\"nachrichten.php?t=1&amp;id='.$_POST['params']['targetPlayer'].'\">'.rMessage.'<\/a><br \/><br \/><a href=\"\" id=\"ignore-player-button\" data-player-ignored=\"false\" data-uid=\"'.$_POST['params']['targetPlayer'].'\" title=\"'.Ignored02.'\">'.Ignored02.'<\/a>"}}}';

                        }
                    }else{
                        if($_POST['method'] == 'render_player_message_ignore_buttons'){
                            if($database->queryFetch('SELECT COUNT(*) AS num FROM `ignore` WHERE `uid` = '.$session->uid.' AND `uignored` = '.$_POST['params']['targetPlayer'].'')['num'] == 0){
                                echo '{"response":{"error":false,"errorMsg":null,"data":{"result":"<a class=\"message messageStatus messageStatusUnread\" href=\"nachrichten.php?t=1&amp;id='.$_POST['params']['targetPlayer'].'\">'.rMessage.'<\/a><br \/><br \/><a href=\"\" id=\"ignore-player-button\" data-player-ignored=\"false\" data-uid=\"'.$_POST['params']['targetPlayer'].'\" title=\"'.Ignored02.'\">'.Ignored02.'<\/a>"}}}';
                            }else{
                                echo '{"response":{"error":false,"errorMsg":null,"data":{"result":"<span class=\"notice\">'.Ignored03.'<\/span><br \/><a href=\"\" id=\"ignore-player-button\" data-player-ignored=\"true\" data-uid=\"'.$_POST['params']['targetPlayer'].'\" title=\"'.Ignored05.'\">'.Ignored04.'<\/a>"}}}';
                            }
                            
                        }else{
                            if($_POST['method'] == 'ignore_target_player'){
                                // check if limit 20
                                if($database->queryFetch('SELECT COUNT(*) AS num FROM `ignore` WHERE `uid` = '.$session->uid.'')['num'] == 20){
                                    echo '{"response":{"error":true,"errorMsg":"reached the maximum limit","data":[]}}';
                                }else{
                                    // check if there is already player with this id.
                                    if($database->getUserInfo($_POST['params']['targetPlayer'])['id']){
                                        if($database->queryFetch('SELECT COUNT(*) AS num FROM `ignore` WHERE `uid` = '.$session->uid.' AND `uignored` = '.$_POST['params']['targetPlayer'].'')['num'] == 0){
                                            $database->query("INSERT INTO `ignore` VALUES(NULL, ".$session->uid.", ".$_POST['params']['targetPlayer'].")");

                                            echo '{"response":{"error":false,"errorMsg":null,"data":{"result":"<span class=\"notice\">'.Ignored03.'<\/span><br \/><a href=\"\" id=\"ignore-player-button\" data-player-ignored=\"true\" data-uid=\"'.$_POST['params']['targetPlayer'].'\" title=\"'.Ignored05.'\">'.Ignored04.'<\/a>"}}}';
                                        }
                                    }
                                }
                            }

                        }
                    }
                break;
                case 'autoComplete':
                    $sValue = htmlspecialchars(stripslashes(trim($_POST['search'][0])));
                    $usList = $database->query("SELECT * FROM `users` WHERE `username` LIKE '%$sValue%'");
                    $resp = '{"response":[';
                        $x=0;
                        foreach($usList as $usData){
                            if($x > 0){$resp .= ',';}
                            $resp .= '"'.$usData['username'].'"';
                            $x++;
                        }
                    $resp .= ']}';

                    echo $resp;
                break;

                case 'checkRecipient':
                    $uName = htmlspecialchars(stripslashes(trim($_POST['recipients'][0])));
                    $usData = $database->queryFetch("SELECT `id` FROM `users` WHERE `username` = '".$uName."'");
                    if($usData['id'] || $uName = '[ally]; [ally]'){
                        // check if ignored
                        if($uName != '[ally]; [ally]'){
                            $cIgnore = $database->queryFetch('SELECT COUNT(*) AS num FROM `ignore` WHERE `uignored` = '.$session->uid.' AND `uid` = '.$usData['id'].'')['num'];
                        }

                        if($cIgnore != 0 && $session->access !=9 && $uName != '[ally]; [ally]'){
                            echo '{"response":{"error":true,"errorMsg":"You cannot send messages for this player, the player has added you to Black List","data":[]}}';
                        }else{
                            $varray = $database->getProfileVillages($session->uid);
                            $totalpop = 0;
                            foreach($varray as $vil) {
                                $totalpop += $vil['pop'];
                            }

                            if($totalpop < 100 && $session->access != 9){
                                echo '{"response":{"error":true,"errorMsg":"You cannot send messages if your population is less than 100","data":[]}}';
                            }else{
                                echo '{"response":{"error":false,"errorMsg":"","data":[]}}';
                            }

                            
                        }
                    }else{
                        echo '{"response":{"error":true,"errorMsg":"error","data":[]}}';
                    }
                    
                break; 

                case 'raidList':
                    switch($_POST['action']){
                        case 'actionAddListForm':
                            $html = '<div id="raidListCreate">
                            <h4>Create a new list</h4>
                        
                            <form action="?" method="post">
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
                                        <input type="hidden" name="action" value="addList">
                                        <table cellpadding="1" cellspacing="1" class="transparent">
                                            <tbody><tr>
                                                <th>name:</th>
                                                <td>
                                                    <input class="text" id="name" name="listName" type="text">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>village:</th>
                                                <td>
                                                    <select id="did" name="did">';
                                                    foreach($session->vvillages as $vil) { 
                                                        if($vil['wref'] == $village->wid){
                                                            $select = 'selected="selected"';
                                                        }else{
                                                            $select = '';
                                                        }
                                                        $html .= "<option value=\"".$vil['wref']."\" ".$select.">".$vil['name']."</option>";
                                                    }
                                            $html .= '</td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                </div>
                                <span id="error" class="error"></span>
                                <br>
                                <button type="button" value="OK" id="buttonfF9BNzkGyFEj7" class="green " onclick="Travian.Game.RaidList.createNewList()">
                                    <div class="button-container addHoverClick">
                                        <div class="button-background">
                                            <div class="buttonStart">
                                                <div class="buttonEnd">
                                                    <div class="buttonMiddle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-content">OK</div>
                                    </div>
                                </button>
                                <script type="text/javascript">
                                    window.addEvent(\'domready\', function () {
                                        if ($(\'buttonfF9BNzkGyFEj7\')) {
                                            $(\'buttonfF9BNzkGyFEj7\').addEvent(\'click\', function () {
                                                window.fireEvent(\'buttonClicked\', [this, {
                                                    "type": "button",
                                                    "value": "OK",
                                                    "name": "",
                                                    "id": "buttonfF9BNzkGyFEj7",
                                                    "class": "green ",
                                                    "title": "",
                                                    "confirm": "",
                                                    "onclick": "Travian.Game.RaidList.createNewList()"
                                                }]);
                                            });
                                        }
                                    });
                                </script>
                            </form>
                        </div>';
                        break;

                        case 'actionAddList':
                            if(empty($_POST['listName']) || empty($_POST['did'])){
                                echo $ajax->error('Add a name to the list'); exit();
                            }else{
                                if(strlen($_POST['listName']) > 12){
                                    echo $ajax->error('Name list length too long'); exit();
                                }else{
                                    if($farm->addList($_POST)){
                                        echo '{"response": {"error":false,"errorMsg":"Token invalid","data":{"html":""},"reload":true}}'; 
                                        exit();
                                    }
                                }
                            }
                        break;
                    }

                    echo '{"response":{"error":false,"errorMsg":null,"data":{"html":'.json_encode($html).'}}}';
                break;

                case 'demolishNowPopup':
                    //print_r($_POST); die();
                    $html = '<div id="demolishNowDialog"><p>Would you respond to Confirmation of demolishing this building completely? This is a building from your village.</p>
                    <div class="buttonWrapper"><button type="submit" class="gold " coins="'.DEMOLISH_FULL.'" id="buttonalA6HUXzDkKj3"><div class="button-container addHoverClick">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-content"><img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.DEMOLISH_FULL.'</span></div></div></button>
                    <script type="text/javascript" id="buttonalA6HUXzDkKj3_script">
                    window.addEvent(\'domready\', function()
                        {
                        if($(\'buttonalA6HUXzDkKj3\'))
                        {
                          $(\'buttonalA6HUXzDkKj3\').addEvent(\'click\', function ()
                          {
                            window.fireEvent(\'buttonClicked\', [this, {"value":"\u0625\u0646\u0647\u064a","name":"","class":"gold ","confirm":"","onclick":"","wayOfPayment":{"featureKey":"demolishNow","context":"demolishNow","dataCallback":"getGid"},"title":"\u0647\u0644 \u062a\u0631\u064a\u062f \u0628\u0627\u0644\u062a\u0623\u0643\u064a\u062f \u0647\u062f\u0645 \u0647\u0630\u0627 \u0627\u0644\u0645\u0628\u0646\u0649 \u062a\u0645\u0627\u0645\u0627\u061f \u0633\u064a\u062a\u0645 \u0625\u0632\u0627\u0644\u0629 \u0647\u0630\u0627 \u0627\u0644\u0645\u0628\u0646\u0649 \u0645\u0646 \u0642\u0631\u064a\u062a\u0643.","coins":'.DEMOLISH_FULL.',"id":"buttonalA6HUXzDkKj3"}]);
                          });
                        }
                        });
                    </script></div>
                </div>';
                    echo '{"response": {"error":false,"errorMsg":null,"data":{"html":'.json_encode($html).'}}}';
                break;

                case 'infoboxDelete':
                    $news->delNew($_POST['id']);
                    echo '{"response": {"error":false,"errorMsg":"","data":{"html":""},"reload":true}}';
                break;

				default:
				echo '{"response": {"error":false,"errorMsg":null,"data":{}}}';
                break;
                


}





