<?php
/*
    By iRedux - https://www.facebook.com/opito8
*/
Class News{
    function __construct(){
        $this->pCheck();
        //$this->nEnd();
    }

    function pCheck(){
        global $database, $session;
        if($session->plust < (time() + 43200) && $session->plust > time()){ $this->addNotice(1);}
        if($session->bonus1 < (time() + 43200) && $session->bonus1 > time()){ $this->addNotice(2);}
        if($session->bonus2 < (time() + 43200) && $session->bonus2 > time()){ $this->addNotice(3);}
        if($session->bonus3 < (time() + 43200) && $session->bonus3 > time()){ $this->addNotice(4);}
        if($session->bonus4 < (time() + 43200) && $session->bonus4 > time()){ $this->addNotice(5);}
    }

    // Not needed anymore but leave it for now
    function nEnd(){
        /*global $database, $session;

        $pnData = $database->query("SELECT * FROM pnews WHERE uid = ".$session->uid."");
        foreach($pnData as $uNews){
            switch($uNews['nid']){
                case 1: if($session->plust > (time() + 43200) || time() > $session->plust){ $isDelete = TRUE; } break;
                case 2: if($session->bonus1 > (time() + 43200) || time() > $session->bonus1){ $isDelete = TRUE; } break;
                case 3: if($session->bonus2 > (time() + 43200) || time() > $session->bonus2){ $isDelete = TRUE; } break;
                case 4: if($session->bonus3 > (time() + 43200) || time() > $session->bonus3){ $isDelete = TRUE; } break;
                case 5: if($session->bonus4 > (time() + 43200) || time() > $session->bonus4){ $isDelete = TRUE; } break;
            }

            if($isDelete){
                $database->query('DELETE FROM pnews WHERE id = '.$uNews['id'].'');
            }
        }*/
        
    }

    function nSum(){
        global $database, $session;
        
        $pNSum = $database->queryNumRow('SELECT * FROM pnews WHERE `uid` = '.$session->uid.' AND `hidden` = 0');
        $gNSum = $database->queryNumRow('SELECT * FROM pnews WHERE `uid` = 0 AND `nid` = 0 AND `hidden` = 0');

        return $pNSum + $gNSum;
    }

    function delNew($id){
        global $database, $session;
        
        $nData = $database->queryFetch('SELECT * FROM `pnews` WHERE `id` = '.$id.' AND `uid` = '.$session->uid.'');
        if($nData['id']){
            $database->query('UPDATE pnews SET `hidden` = 1 WHERE `id` = '.$id.'');
            return TRUE;
        }else{
            return False;
        }
    }

    // 1 -> plus , 2 -> wood , 3 -> clay , 4 -> iron , 5 -> crop
    function addNotice($type){
        global $database, $session;

        $cNotice = $database->queryFetch('SELECT * FROM `pnews` WHERE `nid` = '.$type.' AND `uid` = '.$session->uid.'');
        if(!$cNotice['id']){
            $database->query('INSERT INTO pnews VALUES(NULL, '.$session->uid.', '.$type.', "", 0)');
        }
    }

    function getNews(){
        global $database, $session, $generator, $lang, $config;
        $n = '';

        $gNews = $database->query('SELECT * FROM `pnews` WHERE `uid` = 0 AND `nid` = 0 AND `hidden` = 0');
        foreach($gNews as $gnew){
            $n .= '<li><p>'.$gnew['ncontent'].'</p></li>';
        }

        $q = $database->query('SELECT * FROM `pnews` WHERE `uid` = '.$session->uid.' AND `hidden` = 0');
        foreach($q as $new){
            $uData = $database->queryFetch('SELECT * FROM `users` WHERE `id` = '.$new['uid'].'');
            switch($new['nid']){
                case 1: $t = $uData['plus'] - time(); $t > 0 ? $t = $t : $t = ''; break;
                case 2: $t = $uData['b1'] - time(); $t > 0 ? $t = $t : $t = ''; break;
                case 3: $t = $uData['b2'] - time(); $t > 0 ? $t = $t : $t = ''; break;
                case 4: $t = $uData['b3'] - time(); $t > 0 ? $t = $t : $t = ''; break;
                case 5: $t = $uData['b4'] - time(); $t > 0 ? $t = $t : $t = ''; break;
            }

            $n .= '<li>';
            // Addon
            $t > 0 ? $cons = $new['nid'] : $cons = $new['nid'].'F';

            $n .= '<p><a class="infoboxDeleteButton" href="#" data-id="'.$new['id'].'"><img src="img/x.gif" class="del" alt="del"></a>'.$lang['News'][$cons].' '.($t ? '<span class="timer" counting="down" value="'.$t.'">'.($generator->getTimeFormat($t)).'</span> '.$lang['News']['Hour'].'.' : '').'</p>';
            $n .= $this->genButton($new['nid']);
            $n .= '</li>';
        }

        return $n;
    }

    function genButton($type){
        global $config, $lang;
        switch($type){
            case 1: $fKey = 'plus'; $gold = $config['Plus']; break;
            case 2: $tName = 'wood'; $fKey = 'productionboostWood'; $gold = $config['addonProduction']; break;
            case 3: $tName = 'clay'; $fKey = 'productionboostClay'; $gold = $config['addonProduction']; break;
            case 4: $tName = 'iron'; $fKey = 'productionboostIron'; $gold = $config['addonProduction']; break;
            case 5: $tName = 'crop'; $fKey = 'productionboostCrop'; $gold = $config['addonProduction']; break;
        }

        switch($type){
            case 1: $addTime = (PLUS_TIME / (60*60)); break;
            case 2: case 3: case 4: case 5: $addTime = (PLUS_PRODUCTION / (60*60)); break;
        }

        $btnID = $this->generateRandomString(12);
        return '<button type="button" class="gold  productionBoostButton '.$tName.'" title="'.$lang['News']['Button01'].'||'.$lang['News']['Button02'].': '.$addTime.' '.$lang['News']['Button03'].'" coins="'.$gold.'" id="buttone'.$btnID.'"><div class="button-container addHoverClick">
        <div class="button-background">
            <div class="buttonStart">
                <div class="buttonEnd">
                    <div class="buttonMiddle"></div>
                </div>
            </div>
        </div>
        <div class="button-content">'.$lang['News']['Button04'].'<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$gold.'</span></div></div></button>
        <script type="text/javascript" id="buttone'.$btnID.'_script">
            window.addEvent(\'domready\', function(){
                if($(\'buttone'.$btnID.'\')){
                $(\'buttone'.$btnID.'\').addEvent(\'click\', function (){
                    window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"Extend","confirm":"","onclick":"","wayOfPayment":{"featureKey":"'.$fKey.'","context":"infobox"},"title":"'.$lang['News']['Button01'].' &lt;br&gt; '.$lang['News']['Button02'].': &lt;span class=&quot;bold&quot;&gt;'.$addTime.'&lt;\/span&gt; '.$lang['News']['Button03'].'","coins":'.$config['addonProduction'].',"id":"buttone'.$btnID.'"}]);
                });
                }
                });
        </script>';
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}

$news = new News;