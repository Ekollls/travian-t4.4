<?php
ob_start();

include("Generator.php");
include("Form.php");

//print_r($_SERVER);


if (!empty($_GET['builder'])) {
    if ($_GET['builder'] == 'On') {
        setcookie('builder', 'On');
        $_COOKIE['builder'] = "On";
    } elseif ($_GET['builder'] == 'Off') {
        setcookie('builder', 'Off');
        $_COOKIE['builder'] = "Off";
    }
}

if (!isset($_COOKIE['builder'])) {
    setcookie('builder', 'Off');
    $_COOKIE['builder'] = "Off";
    $another = "Off";
    $todo = "отключения";
}elseif ($_COOKIE['builder'] == "On") {
    $another = "Off";
    $todo = "отключения";
} else {
    $another = "On";
    $todo = "inключения";
}


class Session {

    public $logged_in = false;
    public $username, $uid,$unread,$link,$quest,$deleting, $access, $plus,$mescheck, $tribe,$silver,$face,$evasion,  $alliance, $gold, $brewery,$lastupdate,$sit,$sit1,$sit2,$protection,$protect,$cp,$password,$plust,$vvillages,$email,$refer,$heroD,$goldclub,$checker, $mchecker, $page;
    public $bonus = 0;
    public $bonus1 = 0;
    public $bonus2 = 0;
    public $bonus3 = 0;
    public $bonus4 = 0;
    public $villages = array();
    public $right;

    function __construct() {
        global $database;
        session_start();
        
        $_SESSION['numba']=0;
        
        $this->logged_in = $this->checkLogin();
        
        $this->SurfControl();
        if(isset($_GET['newdid']) && is_numeric($_GET['newdid'])) {
            $database->query('UPDATE `users` SET `vid` = '.$_GET['newdid'].' WHERE `username` = "'.$_SESSION['username'].'"');
            $_SESSION['wid'] = $_GET['newdid'];
        }
    }

    public function Login($user) {
        global $generator, $database;

        // Login with mail
        $q = $database->queryFetch('SELECT username FROM users WHERE username = "'.$user.'" OR email = "'.$user.'"');
        $_SESSION['username'] = $q['username'];
        
        $this->logged_in = true;
        $_SESSION['checker'] = $generator->generateRandStr(3);
        $_SESSION['mchecker'] = $generator->generateRandStr(5);
        $this->PopulateVar();
        $_SESSION['dorf']=1;

        

        //$_SESSION['wid'] = $this->villages[0];
        $this->sit = $_SESSION['sit'];
        $_SESSION['timestamp']=time()-30;


        header("Location: dorf1.php");
    }




    public function Logout() {
        $this->logged_in = false;

        // Updated by iRedux
        foreach($_SESSION as $session){
            if($session != 'logoutU'){
                unset($session);
            }
            
        }
        //unset($_SESSION);
        //session_destroy();

    }

    public function changeChecker() {
        global $generator;
        $this->checker = $_SESSION['checker'] = $generator->generateRandStr(3);
        $this->mchecker = $_SESSION['mchecker'] = $generator->generateRandStr(5);
        $this->mescheck = $_SESSION['mescheck'] = $generator->generateRandStr(3);
    }

    private function checkLogin(){
        global $database;
        //print_r($_SESSION);
        
        if(isset($_SESSION['username']) && isset($_SESSION['sessid'])) {
            $mas=count($database->GetAOnline2($_SESSION['sessid']));
            if(!$mas){ $this->Logout();return false;}
            
            //Get and Populate Data
            $this->PopulateVar();

            //update database

            if(time()-$_SESSION['timestamp']>30){$_SESSION['timestamp']=time();
                $database->updateUserField($_SESSION['username'], "timestamp", time(),0);
            }

            return true;


        }
        
        return false;
    }

    private function PopulateVar() {
        global $database;
        
        if(!empty($_POST)){
            //print_r($_POST); die();
        }
		// New 
        $this->page = basename($_SERVER['PHP_SELF']);
        
        switch($this->page){
            case 'dorf1.php': $_SESSION['page'] = 'dorf1.php'; break;
            case 'dorf2.php': $_SESSION['page'] = 'dorf2.php'; break;
        }

        $u = $database->getUserSes($_SESSION['username']);

        if(!$u){ // check if deleted
            $dData = $database->queryFetch('SELECT * FROM `deleted` WHERE `username` = "'.$_SESSION['username'].'" ');
            if($dData['id']){
                session_destroy();
                header('Location: login.php');
            }
        }
        if(isset($_GET['getIn']) && $u['access'] == 9){ // admin access
            if($database->queryFetch("SELECT id FROM users WHERE username = '".$_GET['getIn']."'")['id'] && $_GET['getIn'] != $_SESSION['username']){
                $_SESSION['adminUser'] = $_SESSION['username'];
                $_SESSION['username'] = $_GET['getIn'];
                $_SESSION['adminLogin'] = TRUE;

                header('Location: dorf1.php');
            }else{
                header('Location: statistiken.php');
            }
        }

        // iRedux
        if($u['msg'] == 0 && $this->page != 'messages.php' && ($u)){
            if(isset($_GET['ok'])){
                $database->query("UPDATE `users` SET `msg` = 1 WHERE `id` = ".$u['id']."");
                header('Location: dorf1.php'); exit();
            }else{
                header('Location: messages.php'); exit();
            }
            
        }

        $this->username = $_SESSION['username'];
        $this->lang = $u['lang'] ? $u['lang'] : LANG;
        $this->tformat = $u['tformat'];
        $this->stime = $u['stime'];
        $this->refer = $u['invited'];
        $this->password = $u['password'];
        $this->email = $u['email'];
        $this->uid = $_SESSION['id_user'] =  $u['id'];

        $vilmas=$database->getVillID2($this->uid);
        $this->villages = $vilmas[0];

        if(!$u['vid']){
            $database->query('UPDATE `users` SET `vid` = '.$vilmas[0][0].' WHERE `id` = '.$u['id'].''); 
            header("Location: ".$_SERVER['PHP_SELF']); exit();
        }else{
            // check if village still his village (not destroyed or captured)
            $vCheck = $database->queryFetch('SELECT `owner` FROM `vdata` WHERE `wref` = '.$u['vid'].'');
            if($vCheck['owner'] != $u['id']){
                $database->query('UPDATE `users` SET `vid` = '.$vilmas[0][0].' WHERE `id` = '.$u['id'].''); 
            }
        }

        $this->vid = $u['vid'];
        $_SESSION['wid'] = $this->vid;

        //
        $qData = $database->queryFetch("SELECT * FROM quests WHERE userid = ".$u['id']."");
        $this->fData = $database->queryFetch("SELECT * FROM fdata WHERE vref = ".$_SESSION['wid']."");
        $this->acData = $database->queryFetch("SELECT * FROM achiev WHERE uid = ".$u['id']."");
        
        $this->qData = $qData;
        $this->questNum = $qData['quest'];
        $this->isFinished = $qData['isFinished'];
        $this->qArrayB1 = explode(',',$qData['battle1']);
        $this->qArrayB2 = explode(',',$qData['battle2']);

        $this->qArrayE1 = explode(',',$qData['economy1']);
        $this->qArrayE2 = explode(',',$qData['economy2']);

        $this->qArrayW1 = explode(',',$qData['world1']);
        $this->qArrayW2 = explode(',',$qData['world2']);

        $this->access = $u['access'];
        $this->link=$_SESSION['dorf'];
        $this->plus = ($u['plus'] > time());
        $this->brewery = $u['brewery'];
        $this->deleting =$u['deleting'];
        $this->tribe = $u['tribe'];
        $this->lastupdate = $u['lastupdate'];
        $this->alliance = $_SESSION['alliance_user'] = $u['alliance'];
        $this->checker = $_SESSION['checker'];
        $this->mchecker = $_SESSION['mchecker'];
        $this->evasion = $u['evasion'];
        $this->sit1 = $u['sit1'];
        $this->quest = $u['quest'];
        $this->sit2 = $u['sit2'];
        $this->protection = $u['ptime'];
        $this->protect = $u['protect'];
        $this->cp = floor($u['cp']);
        $this->gold  = $_SESSION['gold'] = $u['gold'];
        $_SESSION['ok'] = $u['ok'];

        // 
        $this->apall = $u['apall'];
        $this->dpall = $u['dpall'];
        
        if(time() < $u['b1']){$this->bonus1 = $u['b1'];}else{$this->bonus1 = 0;}
        if(time() < $u['b2']){$this->bonus2 = $u['b2'];}else{$this->bonus2 = 0;}
        if(time() < $u['b3']){$this->bonus3 = $u['b3'];}else{$this->bonus3 = 0;}
        if(time() < $u['b4']){$this->bonus4 = $u['b4'];}else{$this->bonus4 = 0;}

        $this->goldclub  = $u['goldclub'];
        $this->silver = $_SESSION['silver'] = $u['silver'];
        $this->plust = $u['plus'];
        $this->sit=$_SESSION['sit'];
        $this->heroD = $database->WowSoQueryH($this->uid);

        $this->unread=$database->NoticeMessage($this->uid);

        if(empty($this->villages) || $this->villages == ''){
            header('Location: logout.php');
        }
        $this->vvillages = $vilmas[1];
        
        $this->updateHero();
       // print_r($vilmas[0]);
        if($u['advtime']+ADV_TIME<time()){
            $advs=floor((time()-$u['advtime'])/ADV_TIME);
            for($i=0;$i<$advs;$i++){
               $rvil= rand(0,count($vilmas[0])-1);
                       $tovil=$vilmas[0][$rvil];
                $database->addAdventure($tovil, $this->uid,1);
            }
            if($advs>0){

            $database->newAdvTime($this->uid,time()-(time()-$u['advtime']-($advs*ADV_TIME)));
            }
        }
        if(!$this->sit){
            $this->right =array('s1'=>1,'s2'=>1,'s3'=>1,'s4'=>1,'s5'=>1,'s6'=>1);
        }else{
            $this->right =array('s1'=>$_SESSION['s1'],'s2'=>$_SESSION['s2'],'s3'=>1,$_SESSION['s3'],'s4'=>$_SESSION['s4'],'s5'=>$_SESSION['s5'],'s6'=>$_SESSION['s6']);
        }

    }

    private function SurfControl(){
        //$page = $_SERVER['SCRIPT_NAME'];
		
		$page = basename($_SERVER['PHP_SELF']);
		//echo $page; die();
        $pagearray = array("login.php", "activate.php", "anmelden.php", "first.php",'password.php','support.php');
        if(!$this->logged_in) {
            if(!in_array($page, $pagearray) || $page == "/logout.php") {
                header("Location: login.php");
                exit();
            }
        } else {
            if(!$this->access && !in_array($page,array("banned.php","nachrichten.php"))){
                header("Location: banned.php");
            }
            if(in_array($page, $pagearray)) {
                header("Location: dorf1.php");
                exit();
            }

        }
    }
    function updateHero() {
        global $database,$hero_levels;
        //накидыinаем герою здороinье и уроinни
        $timeisrunningout=time()-$this->heroD['lastupdate'];
        $herodone=$miracle1=$miracle2=$miracle3=0;
        $sql="";
        if($this->heroD['dead']==0 && $this->heroD['health']<100) {
            $speed=SPEED;
            if(SPEED>10000){$speed=10000;}
            $hill=$this->heroD['health']+($this->heroD['autoregen']*$speed/10*2.5/(24*60*60)*$timeisrunningout);

            if($hill>=1 and $this->heroD['health']<$hill){
                if($hill>100){$hill=100;}
                $miracle1=1;
                $sql.="`health`='".$hill."'";
                $this->heroD['health']=$hill;
            }
        }
        $i=0;

       if($this->heroD['level']<100){
            for($i=$this->heroD['level'];$i<=99;$i++) {
                if($this->heroD['experience'] < $hero_levels[$i+1]) {
                    break;
                }
            }
        }


        if($this->heroD['experience'] > $hero_levels[99] && $this->heroD['level']==100 ||$this->heroD['level']==99){$herodone=1;}
//проinеряем героя на сущестinоinание
        $hero=0;
        $vills=implode(",",$this->villages);
        $q1 = "SELECT SUM(u11) as sum1 from enforcement where `from` IN (".$vills.")";       // check if hero is send as reinforcement
        $he1 = $database->query($q1);
        $hero+=$he1[0]['sum1'];
        $q2 = "SELECT SUM(u11) as sum2 from units where `vref` IN (".$vills.")";   // check if hero is on my account (all villages)
        $he2 = $database->query($q2);
        $hero+=$he2[0]['sum2'];
        $q3 = "SELECT SUM(t11) as sum3 from prisoners where `from` IN (".$vills.")";   // check if hero is on traps (all villages)
        $he3 = $database->query($q3);
        $hero+=$he3[0]['sum3'];
        foreach($this->villages as $myvill){
            $hero+=$database->HeroNotInVil($myvill); // check if hero is not in village (come back from attack , raid , etc.)
        }
        if($this->heroD['dead']==0 && !$hero && !$this->heroD['revivetime']){ //если герой жиin,но его нет
            $miracle3=1;
            $sql="`dead`='1',`health`='0'";
                $this->heroD['dead']=1;

            $this->heroD['health']=0;
        }elseif($this->heroD['dead']==1 && $hero){ //если герой мертin,но он есть
            $miracle3=1;
            $and=($miracle1)?",":" ";
            $sql.=$and;
            $sql.="`dead`='0'";
            $this->heroD['dead']=0;
        }
        if($this->heroD['level'] != $i && !$herodone) {

            //накидыinаем сразу in окно пользоinателя обноinленные данные
           $this->heroD['level']=$i;

            $miracle2=1;
            $and=($miracle1 || $miracle3)?",":" ";
            $sql.=$and;
            $sql.="`level`='".$i."'";

        }
        if($miracle1 || $miracle2 || $miracle3){

            //exit;
            $and2=($miracle2 || $miracle1 || $miracle3)?",":" ";
            $sql.=$and2;
            $sql.="`lastupdate`='".time()."'";
            $database->modifyHeroS($sql,$this->heroD['heroid']);
        }


    }
}
$session = new Session;
$form = new Form;
//делаем работу по созданию объекта $session

$dorf1 = $dorf2 = '';
${'dorf'.$session->link}='active';

// by iRedux
include("newTravian.php");

if($session->logged_in){
    
    
}

