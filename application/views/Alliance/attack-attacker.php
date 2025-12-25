<?php
$limit = "ntype!=0 AND ntype!=4 AND ntype!=5 AND ntype!=6 AND ntype!=7 AND ntype!=8 AND ntype!=9 AND ntype!=10 AND ntype!=11 AND ntype!=12 AND ntype!=13 AND ntype!=14 AND ntype!=15 and ntype!=20 and ntype!=21  and ntype!=25 and ntype!=26 and ntype!=27";
//"  ntype!=8 AND ntype!=9 AND ntype!=10 AND ntype!=11 AND ntype!=12 AND ntype!=13 AND ntype!=14 AND ntype!=15 and ntype!=20 and ntype!=21  and ntype!=25 and ntype!=26 and ntype!=27"
$sql = $database->GetAllyNoticeforAlly($limit,$session->alliance);
$query = count($sql);
$outputList = '';
$name = 1;
if($query == 0) {
    $outputList .= "<td colspan=\"4\" class=\"none\">There are no reports available.</td>";
}else{
foreach($sql as $row){
	$dataarray = explode(",",$row['data']);
    for($i=49;$i>=1;$i--){
        $row['topic'] = preg_replace("/REP_С".$i."/",constant('REP_С'.$i),$row['topic']);
        $row['data'] = preg_replace("/REP_С".$i."/",constant('REP_С'.$i),$row['data']);
        $row['data']= preg_replace("/Bd_".$i."_Bd/",$database->procResType($i),$row['data']);
    }
    $id = $row["id"];
    $uid = $row["uid"];
    $ally = $row["ally"];
    $ntype = $row["ntype"];
    $time = $row["time"];



    $outputList .= "<tr>";
	$outputList .= "<td class=\"sub\">";
if($ntype==4 || $ntype==5 || $ntype==6 || $ntype==7){
    $type2 = '32';
}else{
    $type2 = '31';
}

    $type =  $ntype;
    if($type==25 or $type==26 or $type==27){
        $type-=21;
    }
//print_r($dataarray);
	$outputList .= "<a href=\"allianz.php?s=3&f=".$type2."\">";
    $outputList .= "<img src=\"img/x.gif\" class=\"iReport iReport$type\" title=\"icon\">";

    $outputList .= "</a>";
    $outputList .= "<div><a href=\"berichte.php?id=".$id."\">";
    if($ntype==0){ $nn = REPORT1; }else{ $nn = REPORT2; }
    $userid=$dataarray[37];
    $outputList .= $row['topic'];
    $getUserAlly = $database->getUserField($userid,'alliance',0);
    $getAllyName = $database->RemoveXSS($database->getAllianceName($getUserAlly));

    if($getUserAlly==$session->alliance || !$getUserAlly){
    	$allyName = "-";
    }else{
    	$allyName = "<a href=\"allianz.php?aid=".$getUserAlly."\">".$getAllyName."</a>";
    }

    $outputList .= "<td class=\"al\">".$allyName."</td>";
    $date = $generator->procMtime($time);
    $outputList .= "<td class=\"dat\">".$date[0]." ".date('H:i',$time)."</td>";
	$outputList .= "</tr>";

	$name++;
}
}
?>
<table cellpadding="1" cellspacing="1" id="offs">
<thead>
<tr>
<td><?php echo OVERVIEW1; ?></td>
<td><?php echo OVERVIEW6; ?></td>
<td><?php echo ALLIANCE11; ?></td>
</tr>
</thead>

<tbody>
<?php echo $outputList; ?>
</tbody>
</table>