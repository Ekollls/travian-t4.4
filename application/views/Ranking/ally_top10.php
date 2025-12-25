    <?php
       $aid=$alliance;
    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }


    $result = $database->GetForAllyTop("ap");
    if(!empty($aid)){$result2 = $database->GetForAllyTop("ap",$aid);}
include("ally_menu.php");
	?>

    <div id="statLeft" class="top10Wrapper">
    <h4 class="round small  top10_offs"><?php echo MEDAL1; ?> <?php echo DNYA; ?></h4>
<table cellpadding="1" cellspacing="1" id="top10_offs" class="top10 row_table_data">
	<thead>
		<tr>
			<td>№</td>
			<td><?php echo OVERVIEW6; ?></td>
			<td><?php echo STATISTIC6; ?></td>
		</tr>
	</thead>
	<tbody>
<?php      $place="?";
    foreach($result as $row)
      {
	  if($row['id']==$aid) {
	  $place=$i;
	  echo "<tr class=\"own hl\">"; } else { echo "<tr>"; }
      echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
      echo "<td class=\"pla\"><a href='allianz.php?aid=".$row['id']."'>".$database->RemoveXSS($row['tag'])."</a></td>";
      echo "<td class=\"val lc\">".$row['ap']."</td>";
      echo "</tr>";
      }
?>
		 <tr>
			<td colspan="3" class="empty"></td>
		</tr>
<?php
 if(!empty($aid)){
       $row=$result2[0];
   echo "<tr class=\"none\">";
      echo "<td class=\"ra fc\">$place.&nbsp;</td>";
	  	echo "<td class=\"pla\">".$database->RemoveXSS($row['tag'])."</td>";
      echo "<td class=\"val lc\">".$row['ap']."</td>";
      echo "</tr>";
           }


?>
         </tbody>
</table>

        <?php $i=1;
        $result = $database->GetForAllyTop("clp");
        if(!empty($aid)){$result2 = $database->GetForAllyTop("clp",$aid);}
        ?>
        <br/>
        <h4 class="round small  top10_climbers"><?php echo MEDAL3; ?> <?php echo DNYA; ?></h4>
        <table cellpadding="1" cellspacing="1" id="top10_climbers" class="top10 row_table_data">
            <thead>

            <tr>
                <td>№</td>
                <td><?php echo OVERVIEW6; ?></td>
                <td><?php echo OVERVIEW4; ?></td>
            </tr>
            </thead>
            <tbody>
            <?php            $place="?";
            foreach($result as $row)
            {
                if($row['id']==$aid) {
                    $place=$i;
                    echo "<tr class=\"own hl\">"; } else { echo "<tr>"; }
                echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
                echo "<td class=\"pla\"><a href='allianz.php?aid=".$row['id']."'>".$database->RemoveXSS($row['tag'])."</a></td>";
                echo "<td class=\"val lc\">".$row['clp']."</td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="3" class="empty"></td>
            </tr>
            <?php
            if(!empty($aid)){
                $row=$result2[0];
                echo "<tr class=\"none\">";
                echo "<td class=\"ra fc\">$place.&nbsp;</td>";
                echo "<td class=\"pla\">".$database->RemoveXSS($row['tag'])."</td>";
                echo "<td class=\"val lc\">".$row['clp']."</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <?php
    $i=1;
    $result = $database->GetForAllyTop("dp");
    if(!empty($aid)){$result2 = $database->GetForAllyTop("dp",$aid);}
    ?>
    <div id="statRight" class="top10Wrapper">
    <h4 class="round small spacer top10_defs"><?php echo MEDAL2; ?> <?php echo DNYA; ?></h4>
    <table cellpadding="1" cellspacing="1" id="top10_defs" class="top10 row_table_data">
        <thead>

        <tr>
            <td>№</td>
            <td><?php echo OVERVIEW6; ?></td>
            <td><?php echo STATISTIC6; ?></td>
        </tr>
        </thead>
        <tbody>
        <?php         $place="?";
        foreach($result as $row)
        {
            if($row['id']==$aid) {
                $place=$i;
                echo "<tr class=\"own hl\">"; } else { echo "<tr>"; }
            echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
            echo "<td class=\"pla\"><a href='allianz.php?aid=".$row['id']."'>".$database->RemoveXSS($row['tag'])."</a></td>";
            echo "<td class=\"val lc\">".$row['dp']."</td>";
            echo "</tr>";
        }
        ?>

        <tr>
            <td colspan="3" class="empty"></td>
        </tr>
        <?php   if(!empty($aid)){
            $row=$result2[0];
            echo "<tr class=\"none\">";
            echo "<td class=\"ra fc\">$place.&nbsp;</td>";
            echo "<td class=\"pla\">".$database->RemoveXSS($row['tag'])."</td>";
            echo "<td class=\"val lc\">".$row['dp']."</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
<br/>
<?php
$i=1;
          $result = $database->GetForAllyTop("RR");
    if(!empty($aid)){$result2 = $database->GetForAllyTop("RR",$aid);}
?>
        <h4 class="round small  top10_climbers"><?php echo MEDAL4; ?> <?php echo DNYA; ?></h4>
<table cellpadding="1" cellspacing="1" id="top10_raiders" class="top10 row_table_data">
	<thead>

		<tr>
			<td>№</td>
			<td><?php echo OVERVIEW6; ?></td>
			<td><?php echo STATISTIC18; ?></td>
		</tr>
	</thead>
	<tbody>
<?php         $place="?";
    foreach($result as $row)
      {
	  if($row['id']==$aid) {
	  $place=$i;
	  echo "<tr class=\"own hl\">"; } else { echo "<tr>"; }
      echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
      echo "<td class=\"pla\"><a href='allianz.php?aid=".$row['id']."'>".$database->RemoveXSS($row['tag'])."</a></td>";
      echo "<td class=\"val lc\">".$row['RR']."</td>";
      echo "</tr>";
      }
?>
		 <tr>
			<td colspan="3" class="empty"></td>
		</tr>
<?php
   if(!empty($aid)){
   $row=$result2[0];

		echo "<tr class=\"none\">";
      echo "<td class=\"ra fc\">$place.&nbsp;</td>";
		echo "<td class=\"pla\">".$database->RemoveXSS($row['tag'])."</td>";
      echo "<td class=\"val lc\">".$row['RR']."</td>";
      echo "</tr>";
      }


?>
         </tbody>
</table>
    </div><div class="clear">&nbsp;</div>
