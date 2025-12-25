<?php
	$att_tribe = $session->tribe;
	  	$tr=($att_tribe-1);
	  	if($tr==0){$tr="";}
	  	for($t=1;$t<=11;$t++) {
	  	$Unit[$t]=$village->unitarray['u'.$t];
	}
	
	if(isset($_GET['nid'])){
		$rData = $database->queryFetch('SELECT * FROM ndata WHERE id = '.$_GET['nid'].'');
		$rArray = explode(",",$rData['data']);
		$start = ($dataarray[4]-1)*10+1;
		for($i=5,$x=1;$i<=14;$i++) {
			if($Unit[$x] > $rArray[$i]){ // if have enough
				$u[$x] = $rArray[$i];
			}else{ // if haven't enough just put the max
				$u[$x] = $Unit[$x];
			}
			$x++;
		}
	}

?>

<form method="POST" name="snd" action="build.php?t=2&id=39">


		<table id="troops" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="line-first column-first large"><img class="unit u<?php echo $tr ?>1" src="img/x.gif" title="<?php echo constant('U'.$tr.'1'); ?>" onclick="document.snd.t1.value=''; return false;" alt=""> <input class="text" <?php if ($Unit[1]<=0) {echo 'class="text disabled" disabled="disabled"';} else {echo 'class="text"'; }?> name="t1" value="<?php if($u[1]){ echo $u[1]; } ?>" maxlength="<?=MAXLENGHT?>" type="text">
		<?php
        if ($Unit[1]>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t1.value=".$Unit[1]."; return false;\">(".$Unit[1].")</a></td>";
        }else{
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>

        <td class="line-first large"><img class="unit u<?php echo $tr;?>4" src="img/x.gif" title="<?php echo constant('U'.$tr.'4'); ?>" alt=""> <input class="text" <?php if ($Unit[4]<=0) {echo ' disabled="disabled"';}?> name="t4" value="<?php if($u[4]){ echo $u[4]; } ?>" maxlength="<?=MAXLENGHT?>" type="text">
		<?php
        if ($Unit[4]>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t4.value=".$Unit[4]."; return false;\">(".$Unit[4].")</a></td>";
        }else{
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
        <td class="line-first regular"><img class="unit u<?php echo $tr;?>7" src="img/x.gif" title="<?php echo constant('U'.$tr.'7'); ?>" alt=""> <input class="text" <?php if ($Unit[7]<=0) {echo ' disabled="disabled"';}?> name="t7" value="<?php if($u[7]){ echo $u[7]; } ?>" maxlength="<?=MAXLENGHT?>" type="text">
		<?php
        if ($Unit[7]>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t7.value=".$Unit[7]."; return false;\">(".$Unit[7].")</a></td>";
        }else{
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>


        <td class="line-first column-last small"><img class="unit u<?php echo $tr;?>9" src="img/x.gif" title="<?php echo constant('U'.$tr.'9'); ?>" alt=""> <input class="text" <?php if ($Unit[9]<=0) {echo ' disabled="disabled"';}?> name="t9" value="<?php if($u[9]){ echo $u[9]; } ?>" maxlength="<?=MAXLENGHT?>" type="text">
		<?php
        if ($Unit[9]>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t9.value=".$Unit[9]."; return false;\">(".$Unit[9].")</a></td>";
        }else{
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
	</tr>
	<tr>
		<td class="column-first large"><img class="unit u<?php echo $tr;?>2" src="img/x.gif" title="<?php echo constant('U'.$tr.'2'); ?>" alt=""> <input class="text" <?php if ($Unit[2]<=0) {echo ' disabled="disabled"';}?> name="t2" value="<?php if($u[2]){ echo $u[2]; } ?>" maxlength="<?=MAXLENGHT?>" type="text">
		<?php
        if ($Unit[2]>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t2.value=".$Unit[2]."; return false;\">(".$Unit[2].")</a></td>";
        }else{
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>

		<td class="large"><img class="unit u<?php echo $tr;?>5" src="img/x.gif" title="<?php echo constant('U'.$tr.'5'); ?>" alt=""> <input class="text" <?php if ($Unit[5]<=0) {echo ' disabled="disabled"';}?> name="t5" value="<?php if($u[5]){ echo $u[5]; } ?>" maxlength="<?=MAXLENGHT?>" type="text">
		<?php
        if ($Unit[5]>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t5.value=".$Unit[5]."; return false;\">(".$Unit[5].")</a></td>";
        }else{
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="regular"><img class="unit u<?php echo $tr;?>8" src="img/x.gif" title="<?php echo constant('U'.$tr.'8'); ?>" alt=""> <input class="text" <?php if ($Unit[8]<=0) {echo ' disabled="disabled"';}?> name="t8" value="<?php if($u[8]){ echo $u[8]; } ?>" maxlength="<?=MAXLENGHT?>" type="text">
		<?php
        if ($Unit[8]>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t8.value=".$Unit[8]."; return false;\">(".$Unit[8].")</a></td>";
        }else{
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="column-last small"><img class="unit u<?php echo $att_tribe;?>0" src="img/x.gif" title="<?php echo constant('U'.$tr.'0'); ?>" alt=""> <input class="text" <?php if ($village->unitarray['u10']<=0) {echo ' disabled="disabled"';}?> name="t10" value="<?php if($u[10]){ echo $u[10]; } ?>" maxlength="<?=MAXLENGHT?>" type="text">
		<?php
        if ($village->unitarray['u10']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t10.value=".$village->unitarray['u10']."; return false;\">(".$village->unitarray['u10'].")</a></td>";
        }else{
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
	</tr>
	<tr>
		<td class="line-last column-first large"><img class="unit u<?php echo $tr;?>3" src="img/x.gif" title="<?php echo constant('U'.$tr.'3'); ?>" alt=""> <input class="text" <?php if ($Unit[3]<=0) {echo ' disabled="disabled"';}?> name="t3" value="<?php if($u[3]){ echo $u[3]; } ?>" maxlength="<?=MAXLENGHT?>" type="text">
		<?php
        if ($Unit[3]>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t3.value=".$Unit[3]."; return false;\">(".$Unit[3].")</a></td>";
        }else{
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="line-last large"><img class="unit u<?php echo $tr;?>6" src="img/x.gif" title="<?php echo constant('U'.$tr.'6'); ?>" alt=""> <input class="text" <?php if ($Unit[6]<=0) {echo ' disabled="disabled"';}?> name="t6" value="<?php if($u[6]){ echo $u[6]; } ?>" maxlength="<?=MAXLENGHT?>" type="text">
		<?php
        if ($Unit[6]>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t6.value=".$Unit[6]."; return false;\">(".$Unit[6].")</a></td>";
        }else{
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="line-last regular"></td>
		<td class="line-last column-last small"><?php
        if ($Unit[11]>0){
        echo "<img class=\"unit uhero\" src=\"img/x.gif\" title=\"".U0."\" alt=\"Hero\"> <input class=\"text\" name=\"t11\" value=\"".($rArray[15] ? 1 : '')."\" maxlength=\"6\" type=\"text\">   ";
            echo "<a href=\"#\" onclick=\"document.snd.t11.value=".$Unit[11]."; return false;\">(".$Unit[11].")</a></td>";
        }
        ?></td>
			<td class="line-last column-last"></td>		</tr>
</tbody></table>

