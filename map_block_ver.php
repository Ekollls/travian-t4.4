<?php
set_time_limit(0);
ini_set('memory_limit', '-1');
session_start();
include("application/Database.php");

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
echo $control['version'];