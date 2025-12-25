<?php
session_start();
include("application/Account.php");
$language = $session->lang;
include("application/Lang/" . $language . "/Lang.php");
if($_GET){
	if(isset($_GET['cmd'])){
		header('Content-Type:application/json; charset=UTF-8;');
		switch($_GET['cmd']) {
			case 'mapInfo':
                $block="";
               foreach($_POST['data'] as $p){
                $x0 = $p['position']['x0'];
                $y0 = $p['position']['y0'];
                $x1 = $p['position']['x1'];
                $y1 = $p['position']['y1'];

//$database->query("INSERT IGNORE into map_images values (0,'".$x0."','".$y0."','".$x1."','".$y1."',0)");

                $nob = $x1 - $x0 + 1;

                $checkzoom= abs(abs($x1)-abs($x0))+1;

                if($checkzoom<10){$nob=10;}
                if($checkzoom>13 && $checkzoom<24){$nob=20;}
                $noc = $nob/2;

                $x = $x0+$noc;
                $y = $y0+$noc-1;

                $yarray = $xarray = $ids = array();


                for($i=$noc;$i>=-$noc;$i--){
                    $tmp = $y+$i;
                    if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;
                    if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;
                    $yarray[] = $tmp;
                }

                for($i=-$noc;$i<=$noc;$i++){
                    $tmp = $x+$i;
                    if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;
                    if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;
                    $xarray[] = $tmp;
                }

                $maparray0=$maparray2='';
                for($i=0;$i<=$nob-1;$i++) {
                    for($j=0;$j<=$nob-1;$j++) {
                        $id=$database->getBaseID($xarray[$j],$yarray[$i]);
                        $maparray0 .= '\''.$id.'\',';
                        $maparray2 .= $id.',';
                    }
                }


                $maparray0 = (substr($maparray0, 0, -1));

                $maparray=$database->query("
SELECT w.*,IF(v.owner IS NULL, o.owner,v.owner) as owner,IF(v.pop IS NULL,0, v.pop) as pop,IF(o.owner IS NULL,0, o.owner) as o_ow,IF(u_vil.tribe IS NULL,0,u_vil.tribe) as tribe
    FROM (((wdata as w
     LEFT JOIN vdata as v ON v.wref = w.id)
     LEFT JOIN odata as o ON o.wref = w.id )
     LEFT JOIN users as u_vil ON v.owner = u_vil.id)
        where w.id IN(".$maparray0.")
         ORDER BY FIND_IN_SET(w.id,'".$maparray2."')"
                );

                $hash=md5($x0.$x1.$y0.$y1.$nob);
                foreach($maparray as $m){
                    if(!isset($m['pop']) || $m['pop']<=0){
                        $popclass = 'pop';
                    } elseif($m['pop']<100){
                        $popclass .= '99';
                    } elseif($m['pop']<250){
                        $popclass .= '249';
                    } elseif($m['pop']<500){
                        $popclass .= '499';
                    } else {
                        $popclass .= '500';
                    }
                    $hash=md5($hash.$m['owner'].$m['o_ow'].$m['tribe'].$m['occupied'].$popclass);
                }
                $control=$database->MapVersionControl($x0,$x1,$y0,$y1);
                if(count($control)){
                    if($control['hash']!=$hash){
                        $database->MapVersionUpdate($x0,$x1,$y0,$y1,$hash);
                        $control['version']++;
                    }
                }else{
                    $database->MapVersionStartControl($x0,$x1,$y0,$y1,$hash);
                    $control['version']=0;
                }
                   $block.= '"'.$x0.'":{"'.$y0.'":{"'.$x1.'":{"'.$y1.'":{"version":"'.$control["version"].'&cache"}}}},';
               }
                $block = (substr($block, 0, -1));
               $block = '"blocks":{'.$block.'';
              //  file_put_contents('application/queue2/_log.txt', var_export($_POST, true) . "\r\n\r\n",FILE_APPEND);
				echo '{"response": {"error":false,"errorMsg":null,"data":{"elements":[],'.$block.'}}}}';

             //  echo '{response: {"error":false,"errorMsg":null,"data":{"elements":[],"blocks":[]}}}';
			break;
			case 'mapPositionData':
				$tiles = array();

				$x = $_POST['data']['x'];
				$y = $_POST['data']['y'];

$yarray = array();
for($i=5;$i>=-5;$i--){
	$tmp = $y+$i;
	if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;
	if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;
	$yarray[] = $tmp;
}

$xarray = array();
for($i=-5;$i<=5;$i++){
	$tmp = $x+$i;
	if($tmp<-WORLD_MAX) $tmp = (2*WORLD_MAX)+$tmp+1;
	if($tmp>WORLD_MAX) $tmp = (-2*WORLD_MAX)+$tmp-1;
	$xarray[] = $tmp;
}

$maparray = array();
for($i=0;$i<=9;$i++) {
    for($j=0;$j<=9;$j++) {
        $maparray0 .= '\''.$database->getBaseID($xarray[$j],$yarray[$i]).'\',';
	}
}
                $maparray0 = (substr($maparray0, 0, -1));
                $maparray=$database->query("
SELECT w.*,IF(v.owner IS NULL, o.owner,v.owner) as owner,IF(v.pop IS NULL,0, v.pop) as pop,IF(v.name IS NULL,'oasis', v.name) as name,
IF(u_vil.alliance IS NULL,u_oasis.alliance,u_vil.alliance) as alliance,IF(u_vil.tribe IS NULL,u_oasis.tribe,u_vil.tribe) as tribe,IF(u_vil.username IS NULL,u_oasis.username,u_vil.username) as username,
u_oasis.username as o_user,IF(v.owner IS NULL, a_oas.tag , a.tag) as tag
    FROM ((((((wdata as w
     LEFT JOIN vdata as v ON v.wref = w.id)
     LEFT JOIN odata as o ON o.wref = w.id )
     LEFT JOIN users as u_oasis ON o.owner = u_oasis.id)
     LEFT JOIN users as u_vil ON v.owner = u_vil.id)
     LEFT JOIN alidata as a ON a.id = u_vil.alliance)
     LEFT JOIN alidata as a_oas ON a_oas.id = u_oasis.alliance)
        where w.id IN(".$maparray0.")");



for($i=0;$i<=99;$i++) {
    $targetalliance = 0;
    $tribe = -1;
    $username = $oasisowner = $tribename = $text= '';
    if($maparray[$i]['type_of']=='' || $maparray[$i]['oasistype']>0) {

        if ($maparray[$i]['occupied'] > 0) {
            $targetalliance = $maparray[$i]['alliance'];
            $tribe = $maparray[$i]['tribe'];
            $username = $oasisowner = $maparray[$i]['username'];
        }


        $targettitle = '';
        if ($tribe > 0) {
            $tribename = constant('TRIBE' . $tribe);
        }
        if ($maparray[$i]['oasistype'] == 0) {
            switch ($maparray[$i]['fieldtype']) {
                case 1:
                    $tt = "<br>3-3-3-9";
                    break;
                case 2:
                    $tt = "<br>3-4-5-6";
                    break;
                case 3:
                    $tt = "<br>4-4-4-6";
                    break;
                case 4:
                    $tt = "<br>4-5-3-6";
                    break;
                case 5:
                    $tt = "<br>5-3-4-6";
                    break;
                case 6:
                    $tt = "<br>1-1-1-15";
                    break;
                case 7:
                    $tt = "<br>4-4-3-7";
                    break;
                case 8:
                    $tt = "<br>3-4-4-7";
                    break;
                case 9:
                    $tt = "<br>4-3-4-7";
                    break;
                case 10:
                    $tt = "<br>3-5-4-6";
                    break;
                case 11:
                    $tt = "<br>4-3-5-6";
                    break;
                case 12:
                    $tt = "<br>5-4-3-6";
                    break;
            }
        } else {
            switch ($maparray[$i]['oasistype']) {
                case 1:
                    $tt = "<br><i class=\"r1\"></i> " . WOOD . " 25%";
                    break;
                case 2:
                    $tt = "<br><i class=\"r1\"></i> " . WOOD . " 50%";
                    break;
                case 3:
                    $tt = "<br><i class=\"r1\"></i> " . WOOD . " 25%<br><i class=\"r4\"></i> " . CROP . " 25%";
                    break;
                case 4:
                    $tt = "<br><i class=\"r2\"></i> " . CLAY . " 25%";
                    break;
                case 5:
                    $tt = "<br><i class=\"r2\"></i> " . CLAY . " 50%";
                    break;
                case 6:
                    $tt = "<br><i class=\"r2\"></i> " . CLAY . " 25%<br><i class=\"r4\"></i> " . CROP . " 25%";
                    break;
                case 7:
                    $tt = "<br><i class=\"r3\"></i> " . IRON . " 25%";
                    break;
                case 8:
                    $tt = "<br><i class=\"r3\"></i> " . IRON . " 50%";
                    break;
                case 9:
                    $tt = "<br><i class=\"r3\"></i> " . IRON . " 25%<br><i class=\"r4\"></i> " . CROP . " 25%";
                    break;
                case 10:
                case 11:
                    $tt = "<br><i class=\"r4\"></i> " . CROP . " 25%";
                    break;
                case 12:
                    $tt = "<br><i class=\"r4\"></i> " . CROP . " 50%";
                    break;
            }
        }

        if ($targetalliance != 0) {
            $allyname = $maparray[$i]['tag'];
        } else {
            $allyname = '';
        }

        $uinfo = $maparray[$i]['o_user'];
        $targetXYText = '(' . $maparray[$i]['x'] . "|" . $maparray[$i]['y'] . ')';
        if ($maparray[$i]['fieldtype'] > 0 && $maparray[$i]['occupied'] == 1) {
            $targettitle = "<font color='white'><b>" . $maparray[$i]['name'] . "</b></font><br>" . $targetXYText . "<br>" . PLAYER . ": " . $username . "<br>" . POPULATION . ": " . $maparray[$i]['pop'] . "<br>" . ALLIANCE . ": " . $allyname . "<br>" . TRIBE . ": " . $tribename . "";
        }
        if ($maparray[$i]['oasistype'] == 0 && $maparray[$i]['occupied'] == 0) {
            $targettitle = "<font color='white'><b>" . ABANDONEDVALLEY . " " . $tt . "</b></font><br>" . $targetXYText;
        }
		if ($maparray[$i]['fieldtype'] == 0){
			$oasis = $database->getOasisInfo($maparray[$i]['id']);
			
			if($oasis['conqured'] != 0){
				$uinfo = $database->getUserArray($oasis['owner'],1);
				$targettitle = "<font color='white'><b>" . OCCUPIEDOASIS . "</b></font><br />" . $targetXYText . "<br />" . $tt . "<br>" . PLAYER . ": " . $uinfo['username'] . "<br>" . ALLIANCE . ": " . ($uinfo['alliance'] == 0 ? '-' : $database->RemoveXSS($database->getUserAlliance($oasis['owner']))) . "<br>" . TRIBE . ": " . constant('TRIBE'.$uinfo['tribe']) . "";
			}else{
				$targettitle = "<font color='white'><b>" . UNOCCUPIEDOASIS . "</b></font><br />" . $targetXYText . $tt . "";
			}
		}
		/*
        if ($maparray[$i]['fieldtype'] == 0 && $maparray[$i]['oasistype'] > 0 && $maparray[$i]['occupied'] == 0) {
            $targettitle = "<font color='white'><b>" . UNOCCUPIEDOASIS . "</b></font><br />" . $targetXYText . $tt . "";
        } elseif ($maparray[$i]['fieldtype'] == 0 && $maparray[$i]['oasistype'] > 0 && $maparray[$i]['occupied'] > 0) {
            $targettitle = "<font color='white'><b>" . OCCUPIEDOASIS . "</b></font><br />" . $targetXYText . "<br />" . $tt . "<br>" . PLAYER . ": " . $uinfo . "<br>" . ALLIANCE . ": " . $allyname . "<br>" . TRIBE . ": " . $tribename . "";

        }*/

        $text = $targettitle;
    }else{
        $text= '(' . $maparray[$i]['x'] . "|" . $maparray[$i]['y'] . ')';
    }

			array_push($tiles,	array("x"=>$maparray[$i]['x'],"y"=>$maparray[$i]['y'],"c"=>'',"t"=>$text));

}


				echo json_encode( array('response' => array('error'=>false,'errorMsg'=>null,'data' => array("tiles"=>$tiles))) );
				break;
		}
	}

}
