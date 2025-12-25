<?php
$gameinstall = 1;

		include ("../../application/config.php");
include ("../../application/Database/db_MYSQL.php");
include ("../../application/Register.php");
			$wid = $database->getBaseID(0,0);
			$uid = 2;

				$database->setFieldTaken($wid);
				$database->addVillage($wid, 2, 'Natureland', '0');
				$database->addResourceFields($wid, $database->getVillageType($wid));
				$database->addUnits($wid);
				$database->addTech($wid);
				$database->addABTech($wid);


$wid = $database->getBaseID(1,1);

if(!empty($_POST['username']) && !empty($_POST['password'])){
    $uid = $regme->register($_POST['username'],md5($_POST['password'].mb_convert_case($_POST['username'],MB_CASE_LOWER,"UTF-8")),"admin@".$_SERVER['HTTP_HOST'],1,0);
}
$frandom0 = rand(0,4);$frandom1 = rand(0,3);$frandom2 = rand(0,4);$frandom3 = rand(0,3);

if($uid) {
    $database->addHeroFace($uid,$frandom0,$frandom1,$frandom2,$frandom3,$frandom3,$frandom2,$frandom1,$frandom0,$frandom2);
    $database->addHero($uid);
    $database->addHeroinventory($uid);
    $database->modifyUnit($wid, array(11), array(1), 1);
    $database->modifyHero2('wref', $wid, $uid, 0);
    $database->addAdventure($wid, $uid,10);
    $database->query("UPDATE users SET access=9 WHERE id='".$uid."'");
}

    $database->setFieldTaken($wid);
    $database->addVillage($wid, $uid, 'Adminland', '1');
    $database->addResourceFields($wid, $database->getVillageType($wid));
    $database->addUnits($wid);
    $database->addTech($wid);
    $database->addABTech($wid);


$gameinstall = 0;
		header("Location: ../index.php?s=5");

