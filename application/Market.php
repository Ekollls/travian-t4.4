<?php

class Market
{
    public $onsale,$onmarket,$sending,$recieving,$return = array();
    public $maxcarry,$merchant,$used;

    public function procMarket($post)
    {
        $this->loadMarket();
        if(isset($_SESSION['loadMarket']))
        {
            $this->loadOnsale();
            unset($_SESSION['loadMarket']);
        }
        if(isset($post['ft']))
        {
            switch($post['ft'])
            {
                case "mk1":  $this->sendResource($post); break;
                case "mk2": $this->addOffer($post); break;
                case "mk3": $this->tradeResource($post); break;
            }
        }
    }

    public function procRemove($get)
    {
        global $database,$village,$session;

        if(isset($get['t']) && $get['t'] == 1)
        {
            $this->filterNeed($get);
        }
        else if(isset($get['t']) && $get['t'] ==2 && isset($get['a']) && $get['a'] == $session->mchecker && isset($get['del']))
        {
            //GET ALL FIELDS FROM MARKET
            $type = $database->getMarketField($village->wid,"gtype");
            $amt = $database->getMarketFieldId($village->wid,$get['del']);
            $vref = $village->wid;
            $database->getResourcesBack($vref,$type,$amt);
            $database->addMarket($village->wid,$get['del'],0,0,0,0,0,0,1);
            $session->changeChecker();
            header("Location: build.php?id=".$get['id']."&t=2");
            exit();
        }
        if(isset($get['t']) && $get['t'] == 1 && isset($get['a']) && $get['a'] == $session->mchecker && !isset($get['del']))
        {
            $session->changeChecker();
            $this->acceptOffer($get);
        }
    }

    public function merchantAvail()
    {
        return $this->merchant - $this->used;
    }

    private function loadMarket()
    {
        global $session,$bid28,$bid17,$database,$village;

        $this->recieving = $database->getMovement(0,$village->wid,1);
        $this->sending = $database->getMovement(0,$village->wid,0);
        $this->return  = $database->getMovement(2,$village->wid,1);
        $this->merchant = ($database->getTypeLevel(17,0,$village->resarray) > 0)? $bid17[$database->getTypeLevel(17,0,$village->resarray)]['attri'] : 0;
        $this->used = $database->totalMerchantUsed($village->wid);
        $this->onmarket = $database->getMarket($village->wid,0);
        $this->maxcarry = ($session->tribe == 1 || $session->tribe == 7)? 500 : (($session->tribe == 2)? 1000 : 750);
        $this->maxcarry *= TRADER_CAPACITY;
        if($database->getTypeLevel(28,0,$village->resarray) != 0)
        {
            $this->maxcarry *= $bid28[$database->getTypeLevel(28,0,$village->resarray)]['attri'] / 100;
        }
    }





    private function sendResource($post,$auto=0)
    {
        global $database,$village,$session;
        if($session->right['s3']){
        //  print_r($post);
        $wtrans = (isset($post['r1']) && $post['r1'] != "")? $post['r1'] : 0;
        $ctrans = (isset($post['r2']) && $post['r2'] != "")? $post['r2'] : 0;
        $itrans = (isset($post['r3']) && $post['r3'] != "")? $post['r3'] : 0;
        $crtrans = (isset($post['r4']) && $post['r4'] != "")? $post['r4'] : 0;
        $wtrans = str_replace("-", "", $wtrans);
        $ctrans = str_replace("-", "", $ctrans);
        $itrans = str_replace("-", "", $itrans);
        $crtrans = str_replace("-", "", $crtrans);
        $villkO=($auto==0)?($village->wid):($post['vill']);
        $allres=$database->getResVillageField($villkO);
        $availableWood = $allres['wood'];
        $availableClay = $allres['clay'];
        $availableIron = $allres['iron'];
        $availableCrop = $allres['crop'];
if($availableWood >= $wtrans AND $availableClay >= $ctrans AND $availableIron >= $itrans AND $availableCrop >= $crtrans)
        {
        if($post['send3']>3 or $post['send3']<1 or !is_numeric($post['send3'])){$post['send3']=1;}
            $resource = array($wtrans,$ctrans,$itrans,$crtrans);
            $reqMerc = ceil((array_sum($resource)-0.1)/$this->maxcarry);

            if($this->merchantAvail() != 0 && $reqMerc <= $this->merchantAvail())
            {
                $id = $post['getwref'];

                $coor = $database->getCoor($id);
                if($database->getVillageState($id))
                {
                    $timetaken = $database->procDistanceTime($coor,$village->coor,$session->tribe,0);
                    $res = $resource[0]+$resource[1]+$resource[2]+$resource[3];
                    if($res!=0)
                    {

                       // $database->modifyPoints($session->uid,'push',$res);
                        $database->modifyResource($village->wid,$resource[0],$resource[1],$resource[2],$resource[3],0);
                        $ref=$database->addMovement(0,$village->wid,$id,0,time(),time()+$timetaken,$post['send3'],$resource[0],$resource[1],$resource[2],$resource[3],$reqMerc);
                       $database->insertQueue($ref,7,time(),(time()+$timetaken));


                    }
                }
            }
            header("Location: build.php?id=".$post['id']."&forres=".$database->FilterIntValue($post['getwref'])."&t=5");exit();
        }
        }
    }

    private function addOffer($post)
    {
        global $database,$village,$session;


        if($post['rid1'] == $post['rid2'])
        {
            // Trading res for res of same type (invalid)
            header("Location: build.php?id=".$post['id']."&t=2&e2");
            exit();
        }
        elseif($post['m1'] > (2 * $post['m2']))
        {
            // Trade is for more than 2x (invalid)
            header("Location: build.php?id=".$post['id']."&t=2&e2");
            exit();
        }
        elseif($post['m2'] > (2 * $post['m1']))
        {
            // Trade is for less than 0.5x (invalid)
            header("Location: build.php?id=".$post['id']."&t=2&e2");exit();
        }
        else
        {
            $wood = ($post['rid1'] == 1)? $post['m1'] : 0;
            $clay = ($post['rid1'] == 2)? $post['m1'] : 0;
            $iron = ($post['rid1'] == 3)? $post['m1'] : 0;
            $crop = ($post['rid1'] == 4)? $post['m1'] : 0;
            $res=$database->getResVillageField($village->wid);
            $availableWood = $res['wood'];
            $availableClay = $res['clay'];
            $availableIron = $res['iron'];
            $availableCrop = $res['crop'];

if($availableWood >= $wood AND $availableClay >= $clay AND $availableIron >= $iron AND $availableCrop >= $crop)
            {
                $reqMerc = 1;

                if(($wood+$clay+$iron+$crop) > $this->maxcarry)
                {
                    $reqMerc = round(($wood+$clay+$iron+$crop)/$this->maxcarry);

                    if(($wood+$clay+$iron+$crop) > $this->maxcarry*$reqMerc)
                    {
                        $reqMerc += 1;
                    }
                }
                if($this->merchantAvail() != 0 && $reqMerc <= $this->merchantAvail())
                {
                    if($database->modifyResource($village->wid,$wood,$clay,$iron,$crop,0))
                    {
                        $time = 0;
                        if(isset($_POST['d1']))
                        {
                            $time = $_POST['d2'] * 3600;
                        }
                        $alliance = (isset($post['ally']) && $post['ally'] == 1)? $session->alliance : 0;
                        $database->addMarket($village->wid,$post['rid1'],$post['m1'],$post['rid2'],$post['m2'],$time,$alliance,$reqMerc,0);
                    }
                    // Quest
                    if($session->qArrayE1[0] == 7 && $session->qArrayE1[1] == 0){
                        $database->query("UPDATE quests SET economy1='7,1' WHERE userid = ".$session->uid."");
                    }

                    // Enough merchants
                    header("Location: build.php?id=".$post['id']."&t=2");exit();
                }
                else
                {
                    // Not enough merchants
                    header("Location: build.php?id=".$post['id']."&t=2&e3");exit();
                }
            }
            else
            {
                // not enough resources
                header("Location: build.php?id=".$post['id']."&t=2&e1");exit();
            }
        }
    }

    private function acceptOffer($get)
    {
        global $database,$village,$session;

        $infoarray = $database->getMarketInfo($get['g']);

        $myresource = $hisresource = array(1=>0,0,0,0);
        $myresource[$infoarray['wtype']] = $infoarray['wamt'];

        $hisresource[$infoarray['gtype']] = $infoarray['gamt'];
        $hissendid=1;
        $mysendid=1;
        $hiscoor = $database->getCoor($infoarray['vref']);
        $mytime = $database->procDistanceTime($hiscoor,$village->coor,$session->tribe,0,$village->wid);
        $targettribe = $database->getUserField($database->getVillageField($infoarray['vref'],"owner"),"tribe",0);
        $histime = $database->procDistanceTime($village->coor,$hiscoor,$targettribe,0,$infoarray['vref']);
        $ref1=$database->addMovement(0,$village->wid,$infoarray['vref'],$mysendid,time(),$mytime+time(),1,$myresource[1],$myresource[2],$myresource[3],$myresource[4],$infoarray['merchant']);
        $database->insertQueue($ref1,7,time(),$mytime+time());
        $ref2=$database->addMovement(0,$infoarray['vref'],$village->wid,$hissendid,time(),$histime+time(),1,$hisresource[1],$hisresource[2],$hisresource[3],$hisresource[4],$infoarray['merchant']);
        $database->insertQueue($ref2,7,time(),($histime+time()));
        $resource = array(1=>0,0,0,0);
        $resource[$infoarray['wtype']] = $infoarray['wamt'];
        $database->modifyResource($village->wid,$resource[1],$resource[2],$resource[3],$resource[4],0);
        $database->setMarketAcc($get['g']);
        $database->removeAcceptedOffer($get['g']);

        // Quest
        if($session->qArrayE1[0] == 7 && $session->qArrayE1[1] == 0){
            $database->query("UPDATE quests SET economy1='7,1' WHERE userid = ".$session->uid."");
        }

        header("Location: build.php?id=".$get['id']."&t=5");exit();
    }

    private function loadOnsale()
    {
        global $database,$village,$session;

        $displayarray = $database->getMarket($village->wid,1);
        $holderarray = array();
        foreach($displayarray as $value)
        {
            $targetcoor = $database->getCoor($value['vref']);
            $duration = $database->procDistanceTime($targetcoor,$village->coor,$session->tribe,0,$value['vref']);
            if($duration <= $value['maxtime'] || $value['maxtime'] == 0)
            {
                $value['duration'] = $duration;
                array_push($holderarray,$value);
            }
        }

        $this->onsale = $this->array_orderby($holderarray,'duration',SORT_ASC);
    }


   private function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }
    private function filterNeed($get)
    {
        if(isset($get['v']) || isset($get['s']) || isset($get['b']))
        {
            $holder = $holder2 = array();
            if(isset($get['v']) && $get['v'] == "1:1")
            {
                foreach($this->onsale as $equal)
                {
                    if($equal['wamt'] <= $equal['gamt'])
                    {
                        array_push($holder,$equal);
                    }
                }
            }
            else
            {
                $holder = $this->onsale;
            }
            foreach($holder as $sale)
            {
                if(isset($get['s']) && isset($get['b']))
                {
                    if($sale['gtype'] == $get['s'] && $sale['wtype'] == $get['b'])
                    {
                        array_push($holder2,$sale);
                    }
                }
                else if(isset($get['s']) && !isset($get['b']))
                {
                    if($sale['gtype'] == $get['s'])
                    {
                        array_push($holder2,$sale);
                    }
                }
                else if(isset($get['b']) && !isset($get['s']))
                {
                    if($sale['wtype'] == $get['b'])
                    {
                        array_push($holder2,$sale);
                    }
                }
                else
                {
                    $holder2 = $holder;
                }
            }
            $this->onsale = $holder2;
        }
        else
        {
            $this->loadOnsale();
        }
    }

    private function tradeResource($post)
    {
        global $session,$database,$village;
        $wwvillage = $village->resarray;
        if($wwvillage['f99t']!=40)
        {
            if($session->gold >= 3)
            {
if (($post['m2'][0]+$post['m2'][1]+$post['m2'][2]+$post['m2'][3])<=(round($village->awood)+round($village->aclay)+round($village->airon)+round($village->acrop)))
                {
                    $database->setVillageField($village->wid,"wood",$post['m2'][0]);
                    $database->setVillageField($village->wid,"clay",$post['m2'][1]);
                    $database->setVillageField($village->wid,"iron",$post['m2'][2]);
                    $database->setVillageField($village->wid,"crop",$post['m2'][3]);
                    $database->modifyGold($session->uid,3,0);
                    if($session->acData['a5'] < 6){
                        $database->UpdateAchievU($session->uid,"`a5`=a5+2");
                    }
                    header("Location: build.php?id=".$post['id']."&t=3&c");exit();
                }
                else
                {
                    header("Location: build.php?id=".$post['id']."&t=3");exit();
                }
            }
            else
            {
                header("Location: build.php?id=".$post['id']."&t=3");exit();
            }
        }
    }
};

$market = new Market;
