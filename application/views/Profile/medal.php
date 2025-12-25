<?php
	$gpack= GP_LOCATE;

//de bird
if($displayarray['ptime'] > time() && $displayarray['protect']!=0){
    $uurover = $generator->getTimeFormat(($displayarray['ptime'])-time());
    $profiel = preg_replace("/\[#0]/is",'<img src="'.$gpack.'/t/tn.gif" border="0" title="You have to stay'.$uurover.' hour From Protectors of beginners." >', $profiel, 1);
} else {
    $geregistreerd=date('Y/m/d', ($displayarray['ptime']));
    $tregistreerd=date('H:i', ($displayarray['ptime']));
    $profiel = preg_replace("/\[#0]/is",'<img src="'.$gpack.'/t/tnd.gif" border="0" title="Record player in a '.$geregistreerd.' '.$tregistreerd.'">', $profiel, 1);
}


//natar image
if($displayarray['username'] == "Natars"){
    $profiel = preg_replace("/\[#natars]/is",'<img src="img/ww100.png" border="0">', $profiel, 1);
}

    $podryad=MEDAL19;
	$times=TIMES;
	$podryad=$times." ".$podryad;
	$titel=BONUS;
	$days=DNYA;
	$woord=$lang['profile'][12];
	$whatka=OVERVIEW39;
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
        break;
    case "5":
        $titel=MEDAL5;
        $titel=$titel." ".$days;
        break;
    case "6":
     $titel0=MEDAL6;

          $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "7":
            $titel0=MEDAL7;

        $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "8":
                   $titel0=MEDAL8;

         $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "9":
                    $titel0=MEDAL9;
       $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "10":
                $titel=MEDAL10;
        $titel=$titel." ".$days;
        break;
    case "11":
                            $titel0=MEDAL11;
       $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "12":
                            $titel0=MEDAL12;
      $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
            case "17":
                $titel=MEDAL17;
        $titel=$titel." ".$days;
        break;
                    case "18":
                $titel=MEDAL18;
        $titel=$titel." ".$days;
        break;


}

    if(isset($bonus[$medal['id']])){

        $profiel = preg_replace("/\[#".$medal['id']."]/is",'<img class="medal '.$medal['img'].'" src="img/x.gif" title="'.$titel.'
<br />'.$lang['profile'][10].': '.$medal['week'].'">', $profiel, 1);
    } else {
        $profiel = preg_replace("/\[#".$medal['id']."]/is",'<img class="medal '.$medal['img'].'" src="img/x.gif" title="'.$lang['profile'][9].': '.$titel.'<br />'.$lang['profile'][10].': '.$medal['week'].'<br />'.$lang['profile'][11].': '.$medal['plaats'].'<br />'.$woord.': '.$medal['points'].'<br />">', $profiel, 1);
    }
}





