<?php
$FLs=$database->getVilUFl($village->wid,$session->uid); //inсе фармсписки для этой деры
foreach($FLs as $a){
$arrayka[]=$a['id'];
}
$eiddata = $database->getRaidList($_GET['eid']);
if(!in_array($eiddata['lid'],$arrayka)){ die("Это не inаш лист,сударь!");}
$lid2=$eiddata['lid'];
if(isset($_GET['action']) == 'editSlot' && $_GET['eid']) {

$x = $eiddata['x'];
$y = $eiddata['y'];
$t1 = $eiddata['t1'];$t2 = $eiddata['t2'];$t3 = $eiddata['t3'];$t4 = $eiddata['t4'];$t5 = $eiddata['t5'];$t6 = $eiddata['t6'];$t7 = $eiddata['t7'];$t8 = $eiddata['t8'];$t9 = $eiddata['t9'];$t10 = $eiddata['t10'];
}

if(isset($_POST['action']) == 'editSlot' && $_POST['eid']) {

if($session->tribe==3){ $_POST['t3']=0;}else{$_POST['t4']=0;}
$troops = $_POST['t1']+$_POST['t2']+$_POST['t3']+$_POST['t4']+$_POST['t5']+$_POST['t6']+$_POST['t7']+$_POST['t8']+$_POST['t9']+$_POST['t10'];
if($_POST['x']!='' && $_POST['y']!=''){
    $_POST['x']=$database->filterVar($_POST['x']);
    $_POST['y']=$database->filterVar($_POST['y']);
    $Wref = $database->getBaseID($_POST['x'], $_POST['y']);
    echo "дереinня ".$Wref."   ";
    $exist = $database->getVillageState($Wref);
    if(!$exist){
        $errormsg .= farmlist16;
    }elseif($Wref==$village->wid){
        $errormsg .= farmlist14;
    }elseif($_POST['x']=='' || $_POST['y']==''){
    	$errormsg .= farmlist16;
    }elseif($troops == 0){
     	$errormsg .= farmlist15;
    }else{

		$coor = $village->coor;
			

            $distance = $database->getDistance($coor['x'], $coor['y'], $_POST['x'], $_POST['y']);
            
		$database->editSlotFarm($_GET['eid'], $_POST['lid'], $Wref, $_POST['x'], $_POST['y'], $distance, $_POST['t1'], $_POST['t2'], $_POST['t3'], $_POST['t4'], $_POST['t5'], $_POST['t6'], $_POST['t7'], $_POST['t8'], $_POST['t9'], $_POST['t10']);
        
        header("Location: build.php?id=39&t=99");
        exit;
}
}else{
    $errormsg .= farmlist15;
}
}


?>

<script type="text/javascript">
	var targets = {};

	function fillTargets()
	{
		var targetId = $('target_id');

		targetId.empty();

		var option = new Element('option',
		{
			'html': 'Select village'
		});
		targetId.insert(option);

		$each(targets[lid], function(data)
		{
			var option = new Element('option',
			{
				'value': data.did,
				'html': data.name
			});
			targetId.insert(option);
		});
	}

	function getTargetsByLid()
	{
		var lidSelect = $('lid');
		lid = lidSelect.getSelected()[0].value;

		if (targets[lid])
		{
			fillTargets();
		}
		else
		{
			Travian.ajax(
			{
				data:
				{
					cmd: 'raidListTargets',
					'lid': lid
				},
				onSuccess: function(data)
				{
					targets[data.lid] = data.targets;
					fillTargets();
				}
			});

		}
	}



	var lid = <?php echo $_GET['lid']; ?>targets[lid] = {};

</script>

<div id="raidListSlot">
	<h4><?=farmlist17?></h4>
<font color="#FF0000"><b>    
<?php echo $errormsg; ?>
</b></font>
	
	<form id="edit_form" action="build.php?id=39&t=99&action=showSlot&eid=<?php echo $_GET['eid']; ?>" method="post">
		<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">

		<input type="hidden" name="action" value="editSlot">
		<input type="hidden" name="eid" value="<?php echo $_GET['eid']; ?>">
        <input type="hidden" name="lid" value="<?php echo $lid2; ?>">
			
			<table cellpadding="1" cellspacing="1" class="transparent">
				<tbody><tr>
					<th><?=farmlist18?></th><?php echo $_GET["lid"]; ?>
					<td>
						<select onchange="getTargetsByLid();" id="lid" name="lid">
<?php
$sql = $FLs;
foreach($sql as $row){
$lid = $row["id"];
$lname = $row["name"];
$lowner = $row["owner"];
$lwref = $row["wref"];
$lvname = $village->vname;

	if($lid==$lid2){ $selected = 'selected=""'; }else{ $selected = ''; }
	echo '<option value="'.$lid.'" '.$selected.'>'.$lvname.' - '.$lname.'</option>';
}
?>	
						</select>
					</td>
				</tr>
				<tr>
					<th><?=farmlist19?></th>
					<td class="target">
						
			<div class="coordinatesInput">
				<div class="xCoord">
					<label for="xCoordInput">X:</label>
					<input value="<?php echo $x; ?>" name="x" id="xCoordInput" class="text coordinates x ">
				</div>
				<div class="yCoord">
					<label for="yCoordInput">Y:</label>
					<input value="<?php echo $y; ?>" name="y" id="yCoordInput" class="text coordinates y ">
				</div>
				<div class="clear"></div>
			</div>

					</td>
				</tr>
			</tbody></table>
			</div>
				</div>

            <?php
            for($i=1;$i<=10;$i++){
                $spy='';
                if($i==3 && $session->tribe==3 || $i==4 && $session->tribe!=3){
                    $spy='disabled="disabled"';}

                $u=($session->tribe-1)*10+$i;
                echo '				<div class="troopGroup">
					<label for="t'.$i.'"><img class="unit u'.$u.'" title="" src="img/x.gif"></label>
					<input class="text troop" id="t'.$i.'" type="text" name="t'.$i.'" value="'.${'t'.$i}.'" '.$spy.'>
				</div>';
            }

            ?>



        <button type="submit" value="save" name="save" id="save" class="green">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?= SAVE ?></div>
            </div>
        </button>
        &nbsp;
        <button type="button" value="delete" name="delete" id="delete" class="green" onclick="return (function(){
            ('Are you sure that you want to delete this list?').dialog(
            {
            onOkay: function(dialog, contentElement)
            {
            window.location.href = 'build.php?id=39&t=99&action=deleteSlot&eid=<?php echo $_GET['eid']; ?>'}
            });
            return false;
            })()">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?= farmlist20 ?></div>
            </div>
        </button>
    </form>
</div>