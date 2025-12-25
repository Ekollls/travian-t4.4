<?php
include("Data/buidata.php");
include("Data/cp.php");
include("Data/cel.php");
include("Data/resdata.php");
include("Data/unitdata.php");
include 'queue.php';

class Village {

    public $type;
    public $coor = array();
    public $awood,$aclay,$airon,$acrop,$resourceSUM,$pop,$maxstore,$maxcrop,$cp,$tech,$oasisowned,$currentcel,$starvupdate,$loyalty,$allcrop,$enforce;
    public $wid,$vname,$capital,$natar;
    public $resarray = array();
    public $unitarray,$unitall1 = array();
    private $production = array();
    private $ocounter = array();

    function __construct() {
        global $session;
        if(empty($_SESSION)){$session->logout(); exit; }


        if(isset($_SESSION['wid']) and  in_array($_SESSION['wid'],$session->villages)) {
            $this->wid = $_SESSION['wid'];
        }
        else {
            $this->wid = $session->villages[0];
            $_SESSION['wid'] = $session->villages[0];
        }

        $this->LoadTown();
        $this->VillageControl();


    }

    public function getProd($type) {
        return $this->production[$type];
    }



    private function LoadTown()
    {
        global $database,$session;
        $database->trainingComplete($this->wid);
        $info=$database->WowSoQueryV($this->wid);
        if($info['owner'] != $session->uid)
        {
            unset($_SESSION['wid']);
        }
        if(!isset($this->wid) or empty($this->wid)){$session->Logout(); exit;}

        $this->resarray = $this->unitarray = $this->tech = $info;
        $this->coor = array('x'=>$info['vx'],'y'=>$info['vy']);
        $this->type = $info['vtype'];
        $this->oasisowned = $database->getOasis($this->wid);
        $this->ocounter = $database->sortOasis($this->oasisowned);
        $this->enforce=$database->getEnf($this->wid);
        if($session->heroD['wref']!=$this->wid && $this->unitarray['u11']){
            $database->modifyHeroByOwner("wref",$this->wid,$session->uid,0);
        }
        $this->unitall1 = $database->getAllUnits($this->wid,0,1,$session->tribe,$this->unitarray,$this->oasisowned,$this->enforce);
        $this->cp=$info['cp'];
        $this->capital = $info['capital'];
        $this->natar = $info['natar'];
        $this->currentcel = $info['celebration'];
        $this->wid = $info['wref'];
        $this->vname = $info['name'];
        $this->pop = $info['pop'];
        $infvil=array('loyalty'=>$info['loyalty'],'pop'=>$info['pop'],'lastupdate'=>$info['lastupdate'],'maxstore'=>$info['maxstore'],'maxcrop'=>$info['maxcrop'],'uid'=>$info['owner'],'lastup'=>$session->lastupdate);
        $usin=array(); $usin['tribe']=$session->tribe;    $usin['b1']=$session->bonus1; $usin['b2']=$session->bonus2; $usin['b3']=$session->bonus3; $usin['b4']=$session->bonus4;
        $procinf=$database->processProduction($this->wid,$this->resarray,$infvil,$this->ocounter,$usin,$this->unitall1,$session->heroD);
        $this->awood = $procinf[0][0];
        $this->aclay = $procinf[0][1];
        $this->airon = $procinf[0][2];
        $this->acrop = $procinf[0][3];
        $this->resourceSUM = round($this->awood+$this->aclay+$this->airon+$this->acrop);
        $this->production['wood'] = $procinf[1]['woodp'];
        $this->production['clay'] = $procinf[1]['clayp'];
        $this->production['iron'] = $procinf[1]['ironp'];
        $this->production['crop'] = $procinf[1]['cropp'];
        $this->allcrop = $procinf[1]['crop+'];
        $this->maxstore = $procinf[0]['maxstore'];
        $this->maxcrop = $procinf[0]['maxcrop'];
        $this->loyalty = $procinf[0]['loyalty'];

        // Fix
        if($this->acrop<0){$this->starvationInVil();}
    }
   private function starvationInVil() {
        global $database,$session;

        if($this->acrop<0 && $this->getProd("crop")<0){
            $skolko=round($this->acrop);
            $killunits=0;
            $reinfthere=$reinfthereo=$reinfthereo1=$reinfthere1=1;
            if($skolko<0){
                while($skolko<0){
                    // get enforce other player from oasis
                    if($reinfthereo1){ $reinfthereo1 = false;
                        $q = "SELECT e.*,o.conqured,o.wref, o.owner as ownero, v.owner as ownerv FROM enforcement as e LEFT JOIN odata as o ON e.vref=o.wref LEFT JOIN vdata as v ON e.from=v.wref where o.conqured='".$this->wid."' AND o.owner<>v.owner";
                        $enforceoasis = $database->query($q);
                    }else{$enforceoasis = array();}
                    $maxcount=0;
                    $totalunits=0;

                    if(count($enforceoasis)>0){
                        foreach ($enforceoasis as $enforce){
                            $tribe=$database->getUserField($enforce['ownerv'],'tribe',0);
                            for($i=1;$i<=10;$i++){
                                $uni=($tribe-1)*10+$i;
                                if($enforce['u'.$i] > $maxcount){
                                    $maxcount = $enforce['u'.$i];
                                    $maxtype = $uni;
                                    $enf = $enforce['id'];
                                }
                                $totalunits += $enforce['u'.$i];
                            }
                            if($totalunits == 0 && $enforce['u11']>0){
                                $maxcount = $enforce['u11'];
                                $maxtype = "hero";
                            }
                            $reinfthereo1=true;
                        }
                    }else{ //own troops from oasis
                        if($reinfthereo){ $reinfthereo = false;
                            $q = "SELECT e.*,o.conqured,o.wref, o.owner as ownero, v.owner as ownerv FROM enforcement as e LEFT JOIN odata as o ON e.vref=o.wref LEFT JOIN vdata as v ON e.from=v.wref where o.conqured='".$this->wid."' AND o.owner=v.owner";
                            $enforceoasis = $database->query($q);
                        }else{$enforceoasis = array();}
                        if(count($enforceoasis)>0){

                            foreach ($enforceoasis as $enforce){
                                $tribe=$database->getUserField($enforce['ownerv'],'tribe',0);
                                for($i=1;$i<=10;$i++){
                                    $uni=($tribe-1)*10+$i;
                                    if($enforce['u'.$i] > $maxcount){
                                        $maxcount = $enforce['u'.$i];
                                        $maxtype = $i;
                                        $maxutype = $uni;
                                        $enf = $enforce['id'];
                                    }
                                    $totalunits += $enforce['u'.$i];
                                }
                                if($totalunits == 0 && $enforce['u11']>0){
                                    $maxcount = $enforce['u11'];
                                    $maxutype = "hero";
                                    $maxtype = 11;
                                }
                                $reinfthereo=true;
                            }
                        }else{ //get enforce other player from village
                            if($reinfthere1){ $reinfthere1 = false;
                                $q = "SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM enforcement as e LEFT JOIN vdata as v ON e.from=v.wref LEFT JOIN vdata as v1 ON e.vref=v1.wref where e.vref='".$this->wid."' AND v.owner<>v1.owner";
                                $enforcearray = $database->query($q);
                            }else{$enforcearray = array();}
                            if(count($enforcearray)>0){
                                foreach ($enforcearray as $enforce){
                                    $tribe=$database->getUserField($enforce['ownerv'],'tribe',0);
                                    for($i=1;$i<=10;$i++){
                                        $uni=($tribe-1)*10+$i;
                                        if($enforce['u'.$i] > $maxcount){
                                            $maxcount = $enforce['u'.$i];
                                            $maxtype = $i;
                                            $maxutype = $uni;
                                            $enf = $enforce['id'];
                                        }
                                        $totalunits += $enforce['u'.$i];
                                    }
                                    if($totalunits == 0 && $enforce['u11']>0){
                                        $maxcount = $enforce['u11'];
                                        $maxutype = "hero";
                                        $maxtype = 11;
                                    }
                                    $reinfthere1=true;
                                }
                            }else{ //get own reinforcement from other village
                                if($reinfthere){ $reinfthere = false;
                                    $q = "SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM enforcement as e LEFT JOIN vdata as v ON e.from=v.wref LEFT JOIN vdata as v1 ON e.vref=v1.wref where e.vref='".$this->wid."' AND v.owner=v1.owner";
                                    $enforcearray = $database->query($q);
                                }else{$enforcearray = array();}
                                if(count($enforcearray)>0){
                                    foreach ($enforcearray as $enforce){
                                        $tribe=$database->getUserField($enforce['ownerv'],'tribe',0);
                                        for($i=1;$i<=10;$i++){
                                            $uni=($tribe-1)*10+$i;
                                            if($enforce['u'.$i] > $maxcount){
                                                $maxcount = $enforce['u'.$i];
                                                $maxtype = $i;
                                                $maxutype = $uni;
                                                $enf = $enforce['id'];
                                            }
                                            $totalunits += $enforce['u'.$i];
                                        }
                                        if($totalunits == 0 && $enforce['u11']>0){
                                            $maxcount = $enforce['u11'];
                                            $maxutype = "hero";
                                            $maxtype = 11;
                                        }
                                        $reinfthere=true;
                                    }
                                }else{ //get own unit
                                    $unitarray = $database->getUnit($this->wid);

                                    for($i=1;$i<=10;$i++){
                                        $uni=($session->tribe-1)*10+$i;
                                        if($unitarray['u'.$i] > $maxcount){
                                            $maxcount = $unitarray['u'.$i];
                                            $maxtype = $i;
                                            $maxutype = $uni;
                                        }
                                        $totalunits += $unitarray['u'.$i];
                                    }
                                    if($totalunits == 0){
                                        $maxcount = $unitarray['u11'];
                                        $maxutype = "hero";
                                        $maxtype = 11;
                                    }
                                }
                            }
                        }
                    }

                    // counting

                    $golod = false;
                    if($skolko<0){$golod=true;}
                    if($golod){
                        $difcrop = abs($skolko); //crop eat up over time
                        $oldcrop = $skolko;

                        if($difcrop > 0){
                            global ${'u'.$maxutype};
                            $hungry=${'u'.$maxutype};
                            if ($hungry['crop']>0 && $oldcrop <0) {

                                $killunits = round($difcrop/$hungry['crop']);
                            }else{ $killunits=0;}

                            if($killunits > 0){

                                if (isset($enf)){
                                    if($killunits < $maxcount){

                                        $database->modifyEnforce($enf, array($maxtype), array($killunits), 0);
                                        if($maxutype == "hero"){
                                            $uid = $database->getVillageField($enf,"owner");
                                            $database->modifyHeroByOwner("dead", 1, $uid);
                                        }
                                    }else{
                                        $killunits = $maxcount;
                                        $database->modifyEnforce($enf, array($maxtype), array($killunits), 0);
                                        $database->checkReinf($enf);
                                        if($maxutype == "hero"){
                                            $uid = $database->getVillageField($enf,"owner");
                                            $database->modifyHeroByOwner("dead", 1, $uid);
                                        }
                                    }
                                }else{
                                    if($killunits < $maxcount){

                                        $database->modifyUnit($this->wid, array($maxtype), array($killunits), 0);
                                        if($maxutype == "hero"){
                                            $database->modifyHeroByOwner("dead", 1, $session->uid);
                                        }
                                    }elseif($killunits > $maxcount){
                                        $killunits = $maxcount;
                                        $database->modifyUnit($this->wid, array($maxtype), array($killunits), 0);
                                        if($maxutype == "hero"){
                                            $database->modifyHeroByOwner("dead", 1, $session->uid);
                                        }
                                    }
                                }
                            }
                            $crop=$killunits*$hungry['crop'];
                            $skolko+=$crop;
                            $database->modifyResource($this->wid,0,0,0,$crop,1);
                        }
                    }

                    if($skolko>0 ||  $killunits ==0){
                        $this->acrop = $skolko;
                        break;
                    }
                }
            }
        }
    }
    function unitsInVillage(){
        global $session;

            $enfoarray = $this->enforce;
            $owtribe = $session->tribe;

        for($i=1;$i<=40;$i++){$ownunit['u'.$i]=0;}
        for($i=1;$i<=10;$i++) {

            $ownunit['u'.(($owtribe-1)*10+$i)] = $this->unitarray['u'.$i];

        }

        $ownunit['hero']=$this->unitarray['u11'];

        if(count($enfoarray) > 0) {
            foreach($enfoarray as $enforce) {

                for($i=1;$i<=10;$i++) {
                    if(!$enforce['tribe']) $enforce['tribe']=4;  // iRedux - Fixed
                    $ownunit['u'.(($enforce['tribe']-1)*10+$i)] += $enforce['u'.$i];
                }

                $ownunit['hero'] += $enforce['u11'];
            }
        }
        return $ownunit;
    }
    function VillageControl()
    {
        global $database;

        if ($this->capital)
        {

            for($i=1;$i<=40;$i++)
            {
                if($this->resarray['f'.$i] > 20)
                {
                    $katoki="f".$i."";
                    $database->query("UPDATE fdata SET ".$katoki."='20' WHERE vref='".$this->wid."' ");
                }

                if($this->resarray['f'.$i.'t'] == 29 && $this->resarray['f'.$i] > 0 or $this->resarray['f'.$i.'t'] == 30 && $this->resarray['f'.$i] > 0)
                {
                    $nokatoki = 'f'.$i.'t';
                    $nokatokii="f".$i."";
                    $database->query("UPDATE fdata SET `".$nokatoki."`='0',`".$nokatokii."` = '0' WHERE vref='".$this->wid."'  ");
                }
            }
        }



    }


}

$village = new Village;
