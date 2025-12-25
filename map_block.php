<?php
set_time_limit(0);
ini_set('memory_limit', '-1');
session_start();
ob_start("ob_gzhandler");
include("application/Database.php");

error_reporting(0);
$queue = array();


$x0 = $_GET['tx0'];
$y0 = $_GET['ty0'];
$x1 = $_GET['tx1'];
$y1 = $_GET['ty1'];

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


if($database->count_files("mcache/")>MAX_FILES){
    $folder="mcache/";
    unset($folder);
}
@mkdir("mcache/");

$hash=md5($x0.$x1.$y0.$y1.$nob);
foreach($maparray as $m){
    if(!isset($m['pop']) || $m['pop']<0 ){
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
//$control=$database->MapVersionControl($x0,$x1,$y0,$y1);
//if(count($control)){
//    if($control['hash']!=$hash){
//        $database->MapVersionUpdate($x0,$x1,$y0,$y1,$hash);
//    }
//}else{
//    $database->MapVersionStartControl($x0,$x1,$y0,$y1,$hash);
//}

$file = "mcache/".$hash.".jpg";
$nareadis=22;

if(file_exists($file)) {
//if(false){


    header('Content-type: image/jpeg');
    if(isset($_GET['cache'])){
        header('Cache-Control: public,max-age=6000');
    }else{
        header('Cache-Control: public,max-age=20');
    }
    header('Pragma:');
    echo file_get_contents(	$file );
  //  unlink($file);
}else{
    for($i=0;$i<=($nob*$nob)-1;$i++) {
		//echo $maparray[$i]['id']; die();

		
        $maparray[$i]['zerodis'] = sqrt(($maparray[$i]['x']*$maparray[$i]['x'])+($maparray[$i]['y']*$maparray[$i]['y']));
        if ($maparray[$i]['zerodis']<=$nareadis) {$maparray[$i]['isgraytile']=true;} else {$maparray[$i]['isgraytile']=false;}

        $tribe = 0;
        if($maparray[$i]['occupied'] > 0) {
            $tribe = $maparray[$i]['tribe'];
        }

        $bgimgclass0 = 'tilespbgimg';
        $bgimgclass1 = $bgimgclass2='';

        if($tribe==4){$tribe=1;}
        
        $popclass = 't'.$tribe.'p';

        if($maparray[$i]['isgraytile']){
            if ($maparray[$i]['x']==-1 && $maparray[$i]['y']==1){$bgimgclass2 = ' 1';
            }elseif ($maparray[$i]['x']==0 && $maparray[$i]['y']==1){$bgimgclass2 = ' 2';
            }elseif ($maparray[$i]['x']==1 && $maparray[$i]['y']==1){$bgimgclass2 = ' 3';
            }elseif ($maparray[$i]['x']==-2 && $maparray[$i]['y']==0){$bgimgclass2 = ' 4';
            }elseif ($maparray[$i]['x']==-1 && $maparray[$i]['y']==0){$bgimgclass2 = ' 5';
            }elseif ($maparray[$i]['x']==0 && $maparray[$i]['y']==0){
                $bgimgclass2 = ' 6';
                $wallclass = '';
                $popclass = 'pop';
            }elseif ($maparray[$i]['x']==1 && $maparray[$i]['y']==0){$bgimgclass2 = ' 7';
            }elseif ($maparray[$i]['x']==2 && $maparray[$i]['y']==0){$bgimgclass2 = ' 8';
            }elseif ($maparray[$i]['x']==-2 && $maparray[$i]['y']==-1){$bgimgclass2 = ' 9';
            }elseif ($maparray[$i]['x']==-1 && $maparray[$i]['y']==-1){$bgimgclass2 = ' 10';
            }elseif ($maparray[$i]['x']==0 && $maparray[$i]['y']==-1){$bgimgclass2 = ' 11';
            }elseif ($maparray[$i]['x']==1 && $maparray[$i]['y']==-1){$bgimgclass2 = ' 12';
            }elseif ($maparray[$i]['x']==2 && $maparray[$i]['y']==-1){$bgimgclass2 = ' 13';
            }elseif ($maparray[$i]['x']==-2 && $maparray[$i]['y']==-2){$bgimgclass2 = ' 14';
            }elseif ($maparray[$i]['x']==-1 && $maparray[$i]['y']==-2){$bgimgclass2 = ' 15';
            }elseif ($maparray[$i]['x']==0 && $maparray[$i]['y']==-2){$bgimgclass2 = ' 16';
            }elseif ($maparray[$i]['x']==1 && $maparray[$i]['y']==-2){$bgimgclass2 = ' 17';
            }elseif ($maparray[$i]['x']==2 && $maparray[$i]['y']==-2){$bgimgclass2 = ' 18';
            }else{
                for($rc=0;$rc<3;$rc++){
                    for($tc=0;$tc<3;$tc++){
                        $cx = $maparray[$i]['x']+$tc-1;
                        $cy = $maparray[$i]['y']-$rc+1;
                        $cdis = sqrt(($cx*$cx)+($cy*$cy));
                        if ($cdis<=$nareadis) {	$bgimgclass0 .= '1';} else {$bgimgclass0 .= '0';}
                    }
                }
            }
        }
if($bgimgclass0=='tilespbgimg100110100' || $bgimgclass0=='tilespbgimg001011001' || $bgimgclass0=='tilespbgimg111010000'){
    $maparray[$i]['isgraytile']=false;
    $bgimgclass0='tilespbgimg';
}
        if(!isset($maparray[$i]['pop']) || $maparray[$i]['pop']<0){
            $popclass = 'pop';
        } elseif($maparray[$i]['pop']<100){
            $popclass .= '99';
        } elseif($maparray[$i]['pop']<250){
            $popclass .= '249';
        } elseif($maparray[$i]['pop']<500){
            $popclass .= '499';
        } else {
            $popclass .= '500';
        }


$lol=0;
        $bgimgclass1 = $maparray[$i]['image'];
        if($maparray[$i]['fieldtype']==0 && $maparray[$i]['o_ow']!=2){	// oases
            
			$oasis = $database->getOasisInfo($maparray[$i]['id']);
			if($oasis['conqured'] != 0){	
				$bgimgclass1 ='img/m/'.$maparray[$i]['image'].'o.gif';
			}else{
				$bgimgclass1 ='img/m/'.$maparray[$i]['image'].'.gif';
			}
			
            $bgimgclass2 = 'img/m/gressland/grassland0-shit.png';

            
		}elseif($maparray[$i]['oasistype']==0){
            $bgimgclass1 = 'img/m/gressland/grassland'.(substr($bgimgclass1, 1)).'.png';
			$lol=1;
        }else{ 
			$bgimgclass1 ='img/m/'.$maparray[$i]['image'].'.gif';
		}
        $oaimg='';
        if($maparray[$i]['type_of']){

            $oaimg=array('img/m/'.$maparray[$i]['type_of'].'/'.$maparray[$i]['type_of'].$maparray[$i]['oasisimg'].'.png',explode('_',$maparray[$i]['partimg']));

        }
        //print_r(array($bgimgclass1, $popclass,$lol,$oaimg,$maparray[$i]['isgraytile'],$bgimgclass0,$bgimgclass2)); die;
      //  if($maparray[$i]['x']==0 && $maparray[$i]['y']==-22){print_r(array($bgimgclass1, $popclass,$lol,$oaimg,$maparray[$i]['isgraytile'],$bgimgclass0,$bgimgclass2));}
        array_push($queue,array($bgimgclass1, $popclass,$lol,$oaimg,$maparray[$i]['isgraytile'],$bgimgclass0,$bgimgclass2));




    }

//die;

//die;
$img = imagecreatetruecolor($_GET['w'],$_GET['h']);
$lgreen = imagecolorallocate($img, 195,237,174);

imagefill($img, 0, 0, $lgreen);
//block backgrounds
    $x = 0;
    $y = 0;
    $n = 0;
    $nx = $nob;
    $ny = $nob;
    $bw = $_GET['w']/$nx;
    $bh = $_GET['h']/$ny;

//print_r($queue);die;
    foreach($queue as $block) {


       if(!$block[4]) {
            if(!$block[2] && empty($block[3])){ 
                imagecopyresized($img, imagecreatefromgif($block[0]), $x, $y, 0, 0, $bw, $bh, 60, 60);
        }else{
                imagecopyresized($img, imagecreatefrompng($block[0]), $x, $y, 0, 0, $bw, $bh, 60, 60);
    }
        }
        if($block[4]) {
            imagecopyresized($img, imagecreatefrompng('img/m/grey.png'), $x, $y, 0, 0, $bw, $bh, 60, 60);
        }
        if($block[5]!='tilespbgimg'){
            imagecopyresized($img, imagecreatefromgif('img/m/'. $block[5] .'.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60);
        }elseif(!empty($block[6])){
            switch($block[6]){
                case 1: imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 60, 0, $bw, $bh, 60, 60);
                    break;
                case 2:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 120, 0, $bw, $bh, 60, 60);
                    break;
                case 3:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 180, 0, $bw, $bh, 60, 60);
                    break;
                case 4:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 0, 60, $bw, $bh, 60, 60);
                    break;
                case 5:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 60, 60, $bw, $bh, 60, 60);
                    break;
                case 6:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 120, 60, $bw, $bh, 60, 60);

                    break;
                case 7:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 180, 60, $bw, $bh, 60, 60);
                    break;
                case 8:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 240, 60, $bw, $bh, 60, 60);
                    break;
                case 9:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 0, 120, $bw, $bh, 60, 60);
                    break;
                case 10:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 60, 120, $bw, $bh, 60, 60);
                    break;
                case 11:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 120, 120, $bw, $bh, 60, 60);
                    break;
                case 12:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 180, 120, $bw, $bh, 60, 60);
                    break;
                case 13:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 240, 120, $bw, $bh, 60, 60);
                    break;
                case 14:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 0, 180, $bw, $bh, 60, 60);
                    break;
                case 15:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 60, 180, $bw, $bh, 60, 60);
                    break;
                case 16:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 120, 180, $bw, $bh, 60, 60);
                    break;
                case 17:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 180, 180, $bw, $bh, 60, 60);
                    break;
                case 18:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 240, 180, $bw, $bh, 60, 60);
                    break;
            }
        }

        if($block[1]!='pop'){
            imagecopyresized($img, imagecreatefromgif('img/m/'. $block[1] .'.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60);
        }
        if(!empty($block[3])){ // oasis
            if(!$block[4]) {
                imagecopyresized($img, imagecreatefrompng($block[6]), $x, $y, 0, 0, $bw, $bh, 60, 60); // oasis iRedux code
            }
            imagecopyresized($img, imagecreatefrompng($block[3][0]), $x, $y, $block[3][1][0], $block[3][1][1], $bw, $bh, 60, 60); //если это оазис
            imagecopyresized($img, imagecreatefromgif($block[0]), $x, $y, 0, 0, $bw, $bh, 60, 60); //иконка оазоin

        }

        $x += $bw;
        $n++;

        if( $n % $nx == 0 ) { $y += $bh;$x = 0; };

    }
    //die;

    imagejpeg($img,$file,IMGQUALITY);
    imagedestroy($img);
    header('Content-type: image/jpeg');
    if(isset($_GET['cache'])){
        header('Cache-Control: public,max-age=6000');
    }else{
        header('Cache-Control: public,max-age=20');
    }
    header('Pragma:');
    echo file_get_contents($file);


}