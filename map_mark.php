<?php

set_time_limit(0);
ini_set('memory_limit', '-1');
session_start();
ob_start("ob_gzhandler");
include("application/Database.php");
//file_put_contents('application/queue2/error_log.txt', var_export('hm', true) . "\r\n\r\n",FILE_APPEND);
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
SELECT w.*,v.owner,u_vil.alliance
    FROM ((wdata as w
     LEFT JOIN vdata as v ON v.wref = w.id)
     LEFT JOIN users as u_vil ON v.owner = u_vil.id)
        where w.id IN(".$maparray0.")
         ORDER BY FIND_IN_SET(w.id,'".$maparray2."')"
);
$dipxyi=array();
if($_SESSION['alliance_user']){
    $dipxyi=$database->getAlliDiS($_SESSION['alliance_user']);
}

@mkdir("mmark/");

$hash = md5(json_encode($maparray).$_GET['w'].",".$_GET['h'].$_SESSION['id_user'].implode(',',$dipxyi));
$file = "mmark/".$hash.".gif";

/*if(file_exists($file)) {
//if(false){


    header('Content-type: image/gif');
    header('Cache-Control: public,max-age=600');
    header('Pragma:');
    echo file_get_contents(	$file );
    //  unlink($file);
}else{*/
    for($i=0;$i<=($nob*$nob)-1;$i++) {
        $targetalliance = 0;
        $tribe = 0;
        if($maparray[$i]['occupied'] > 0) {
            $targetalliance = $maparray[$i]['alliance'];
        }



        $borderclass = 'border';

        $friend=$war=$neutral=$podkrep=0;

        if($maparray[$i]['owner']==$_SESSION['id_user']){
            $borderclass .= 'own';}else
            if($_SESSION['alliance_user'] && $targetalliance){

                foreach($dipxyi as $alli){
                    if($alli['alli1']==$targetalliance || $alli['alli2']==$targetalliance){

                        switch($alli['type']){
                            case 1:
                                $borderclass .= 'confed';
                                break;
                            case 2:
                                $borderclass .= 'nap';
                                break;
                            case 3: $borderclass .= 'atwar';
                                break;

                        }
                    }
                }
            }else{

                $borderclass .= 'neutr';

            }

        array_push($queue,$borderclass);




    }




    $img = imagecreatetruecolor($_GET['w'],$_GET['h']);
    $lgreen = imagecolorallocate($img, 195,237,174);

    imagefill($img, 0, 0, $lgreen);
    imagealphablending($img, true);
    $transparentcolour = imagecolorallocate($img, 195,237,174);
    imagecolortransparent($img, $transparentcolour);
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



        if($block!='border'){
            imagecopyresized($img, imagecreatefromgif('img/m/'. $block.'.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60); //обinодка
        }else{
            imagecopyresized($img, imagecreatefromgif('img/m/borderneutr.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60); //обinодка
        }
        $x += $bw;
        $n++;

        if( $n % $nx == 0 ) { $y += $bh;$x = 0; };

    }
    //  die;

    imagegif($img,null,IMGQUALITY);
    imagedestroy($img);
    header('Content-type: image/gif');
    //echo file_get_contents($file);


//}