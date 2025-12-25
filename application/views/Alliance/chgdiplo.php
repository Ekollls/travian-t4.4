<?php
if(!isset($aid)) {
    $aid = $session->alliance;
}
    if($aid==$session->alliance){
    $allianceinfo = $database->getAlliance($aid);
    //echo "<h1>".$database->RemoveXSS($allianceinfo['tag'])." - ".$database->RemoveXSS($allianceinfo['name'])."</h1>";
    include("alli_menu.php");
?>
<h4 class="round"><?php echo ALLIANCE13;?></h4>
   <form method="POST" action="allianz.php?ss=5">
        <input type="hidden" name="a" value="6"> <input type="hidden" name="o" value="6"> <input type="hidden" name="s" value="5">

       <div class="option diplomacy">
           <table cellpadding="1" cellspacing="1" class="option transparent">
            <tbody>
                <tr>
                    <th><?php echo OVERVIEW6;?></th>

                    <td><input class="ally text" type="text" name="a_name" maxlength="15"></td>
                </tr>

                <tr>
                    <td colspan="2" class="empty"></td>
                </tr>

                <tr>
                    <td colspan="2"><label><input class="radio" type="radio" name="dipl" value="1"><?php echo ALLIANCE14;?></label></td>
                </tr>

                <tr>
                    <td colspan="2"><label><input class="radio" type="radio" name="dipl" value="2"><?php echo ALLIANCE15;?></label></td>
                </tr>

                <tr>
                    <td colspan="2"><label><input class="radio" type="radio" name="dipl" value="3"><?php echo ALLIANCE16;?></label></td>
                </tr>
            </tbody>
        </table>
           <p class="option">
               <input type="hidden" name="a" value="6">
               <button type="submit" value="ok" name="s1" id="btn_ok" class="green">
                   <div class="button-container addHoverClick ">
                       <div class="button-background">
                           <div class="buttonStart">
                               <div class="buttonEnd">
                                   <div class="buttonMiddle"></div>
                               </div>
                           </div>
                       </div><div class="button-content"><?= SAVE ?></div>
                   </div>
               </button>
           <p class="error"></p>
           </p>
       </div>
   </form>
<div class="boxes boxesColor gray infos"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">			<div class="title">


                    <?php echo ALLIANCE17;?></div>
        <div class="text"><?php echo ALLIANCE18; ?></div>

    </div>
</div>		<div class="clear"></div>

<h4 class="round"><?php echo ALLIANCE19;?></h4>

<table cellpadding="1" cellspacing="1" class="option own transparent">
    <tbody>

        <tbody>
        <tr>
        <?php
        $alliance = $session->alliance;

        if(count($database->diplomacyOwnOffers($alliance))){
            foreach($database->diplomacyOwnOffers($alliance) as $key => $value){
                if($value['type'] == 1){
                    $type = ALLIANCE22;
                } else if($value['type'] == 2){
                    $type = ALLIANCE23;
                } else if($value['type'] == 3){
                    $type = ALLIANCE24;
                }
                echo "<tr><td class=\"abo\"><form method=\"post\" action=\"allianz.php\"><input type=\"hidden\" name=\"o\" value=\"101\"><input type=\"hidden\" name=\"id\" value=\"".$value['id']."\"><button type=\"submit\" value=\"del\" class=\"icon\"><img src=\"img/x.gif\" class=\"del\" alt=\"Cancel\"></button></form></td>";
                echo '<td><a href="allianz.php?aid='.$value['alli2'].'">'.$type.' '.$database->getAllianceName($value['alli2']).'</a></td></tr>';

            }
        } else {
            echo '<tr><td class="noData">'.ally12.'</td></tr>';
        }
        ?>
    </tbody>
</table>

<h4 class="round"><?php echo ALLIANCE20;?></h4>


<table width="100px" border="0" class="option foreign transparent">


        <tbody>
             <?php
        unset($type);
        $alliance = $session->alliance;

        if(count($database->diplomacyInviteCheck($alliance))){
            foreach($database->diplomacyInviteCheck($alliance) as $key => $row){
                if($row['type'] == 1){
                     $type = ALLIANCE22;
                } else if($row['type'] == 2){
                     $type = ALLIANCE23;
                } else if($row['type'] == 3){
                     $type = ALLIANCE24;
                }
                echo '<td><form method="post" action="allianz.php"><input type="hidden" name="o" value="102"><input type="hidden" name="id" value="'.$row['id'].'"><input type="hidden" name="alli1" value="'.$row['alli1'].'"><button type="submit" value="del" class="icon"><img src="img/x.gif" class="del" alt="Decline"></button></form></td>';
                echo '<td><a href="allianz.php?aid='.$row['alli1'].'">'.$type.' '.$database->getAllianceName($row['alli1']).'</a></td>';

                echo '<td><form method="post" action="allianz.php"><input type="hidden" name="o" value="103"><input type="hidden" name="id" value="'.$row['id'].'"><input type="hidden" name="alli2" value="'.$row['alli2'].'"><button type="submit" value="ok" name="s1" id="btn_ok" class="green"><div class="button-container addHoverClick ">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div><div class="button-content">Accept</div></div></button></form></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
            }
        } else {
            echo '<tr><td class="noData">'.ally12.'</td></tr>';
        }
        ?>
        </tbody>
    </table>
<h4 class="round"><?php echo ALLIANCE21;?></h4>
<table cellpadding="1" cellspacing="1" class="option existing transparent">

        <tbody>
             <?php
        unset($type);
        unset($row);
        $alliance = $session->alliance;

        if(count($database->diplomacyExistingRelationships($alliance))){
            foreach($database->diplomacyExistingRelationships($alliance) as $key => $row){
               if($row['type'] == 1){
                     $type = ALLIANCE22;
                } else if($row['type'] == 2){
                     $type = ALLIANCE23;
                } else if($row['type'] == 3){
                     $type = ALLIANCE24;
                }
                echo '<tr><td class="abo"><form method="post" action="allianz.php"><input type="hidden" name="o" value="104"><input type="hidden" name="id" value="'.$row['id'].'"><input type="hidden" name="alli2" value="'.$row['alli2'].'"><button type="submit" value="del" class="icon"><img src="img/x.gif" class="del" alt="delete"></button></form></td>';
                echo '<td>'.$type.' <a href="allianz.php?aid='.$row['alli1'].'">'.$database->getAllianceName($row['alli1']).'</a></td></tr>';
            }
        } elseif(count($database->diplomacyExistingRelationships2($alliance))){
            foreach($database->diplomacyExistingRelationships2($alliance) as $key => $row){
        if($row['type'] == 1){
                     $type = ALLIANCE22;
                } else if($row['type'] == 2){
                     $type = ALLIANCE23;
                } else if($row['type'] == 3){
                     $type = ALLIANCE24;
                }
                echo '<tr><td class="abo"><form method="post" action="allianz.php"><input type="hidden" name="o" value="104"><input type="hidden" name="id" value="'.$row['id'].'"><input type="hidden" name="alli2" value="'.$row['alli1'].'"><button type="submit" value="del" class="icon"><img src="img/x.gif" class="del" alt="delete"></button></form></td>';
                echo '<td>'.$type.' <a href="allianz.php?aid='.$row['alli2'].'">'.$database->getAllianceName($row['alli2']).'</a></td></tr>';
            }
        }else {
            echo '<tr><td class="noData">'.ally12.'</td></tr>';
        }
          }
        ?>
        </tbody>
</table>
