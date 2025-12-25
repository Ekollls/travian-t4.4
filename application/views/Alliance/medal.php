<?php
$gpack= GP_LOCATE;
$profiel = preg_replace("/\[war]/s",''.ALLIANCE24.':<br>'.$database->getAllianceWar($aid), $profiel, 1);
$profiel = preg_replace("/\[ally]/s",''.ALLIANCE32.':<br>'.$database->getAllianceDipProfile($aid,1), $profiel, 1);
$profiel = preg_replace("/\[nap]/s",''.ALLIANCE23.':<br>'.$database->getAllianceDipProfile($aid,2), $profiel, 1);
$profiel = preg_replace("/\[diplomatie]/s",''.ALLIANCE32.':<br>'.$database->getAllianceDipProfile($aid,1).'<br>'.ALLIANCE23.':<br>'.$database->getAllianceDipProfile($aid,2).'<br>'.ALLIANCE24.':<br>'.$database->getAllianceWar($aid), $profiel, 1);

    	$days=DNYA;
    	$whatka=MEDAL20;
    	$ochki=STATISTIC6;
foreach($varmedal as $medal) {

switch ($medal['categorie']) {
    case "1":
        $titel=MEDAL1;
        $titel=$titel." ".$days;
        break;
    case "2":
       $titel=MEDAL2;
        $titel=$titel." ".$days;
        break;
    case "3":
        $titel=MEDAL3;
         $titel=$titel." ".$days;
        break;
    case "4":
        $titel=MEDAL4;
        $titel=$titel." ".$days;
        break;    }


$profiel = preg_replace("/\[#".$medal['id']."]/is",'<img src="'.$gpack.'/t/'.$medal['img'].'.gif" border="0" title="'.OVERVIEW36.': '.$titel.'<br />'.$ochki.': '.$medal['points'].'<br />'.$whatka.': '.$medal['week'].'">', $profiel, 1);

}




