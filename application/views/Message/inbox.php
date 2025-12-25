
<form method="post" action="nachrichten.php" name="msg">
<input name="page" hidden value="<?php echo $_GET['s']; ?>">
    <table cellpadding="1" cellspacing="1" id="overview" class="inbox">
        <thead>
<tr>
<th colspan="2"><?=MSG0?></th>
<th>sender</th>
<th class="sent"><?=MSG2?></th>
</tr>
        </thead>
        <tbody>



    <?php

    if(isset($_GET['s'])) {
    $s = $_GET['s'];
    }
    else {
    $s = 0;
    }
      $name = 1;
    for($i=(1+$s);$i<=(10+$s);$i++) {
    if(count($message->inbox1) >= $i) {
    if($message->inbox1[$i-1]['owner'] <= 6) {
    echo "<tr class=\"sup\">";
    }
    else {
    echo "<tr>";
    }
    echo "<td class=\"sel\"><input class=\"check\" type=\"checkbox\" name=\"n".$name."\" value=\"".$message->inbox1[$i-1]['id']."\" /></td>
        <td class=\"subject\">
            <a href=\"nachrichten.php?id=".$message->inbox1[$i-1]['id']."\"></a>";
    echo '<div class="subjectWrapper">';
    echo "<a href=\"nachrichten.php?id=".$message->inbox1[$i-1]['id']."\">";
    echo "<img src=\"img/x.gif\" class=\"messageStatus messageStatus".($message->inbox1[$i-1]['viewed'] == 0 ? 'Unread' : 'Read')."\" alt=\"\">";
    if($message->inbox1[$i-1]['topic'] == 'wMSGT'){
        echo $lang['Msgs']['wMSGT'];
    }else{
        echo $database->RemoveXSS($message->inbox1[$i-1]['topic']);
    }
    
    echo '</a></div>';
    echo '</td>';
    
    $date = $generator->procMtime($message->inbox1[$i-1]['time']);
    $dData = $database->queryFetch("SELECT uid,username FROM deleted WHERE uid = ".$message->inbox1[$i-1]['owner']."");
    
    if($dData['uid']){
        // Player has been deleted
        echo '<td class="send"><span class="none">'.$dData['username'].'</span></td>';
    }else{
        if($message->inbox1[$i-1]['owner'] <= 1) {
            if(!$message->inbox1[$i-1]['owner']){
                //echo $building->getTypeLevel(18);
                echo "<td class=\"send none\">in</td>"; 
            }else{
                echo "<td class=\"send\"><a><u>".$database->RemoveXSS($database->getUserField($message->inbox1[$i-1]['owner'],'username',0))."</u></a></td>";
            }
        }else {
        echo "<td class=\"send\"><a target=\"_top\" href=\"spieler.php?uid=".$message->inbox1[$i-1]['owner']."\">".$database->RemoveXSS($database->getUserField($message->inbox1[$i-1]['owner'],'username',0))."</a></td>";
        }
    }
        echo "<td class=\"dat\">".$date[0]." ".$date[1]."</td></tr>";
        }
        $name++;
    }
    if(count($message->inbox1) == 0) {
    echo "<td colspan=\"4\" class=\"none\">".MSG3."</td>";
    }
    ?>
        </tbody></table>


<div class="footer">
    <?php //if($session->plus) {  ?>
        <div class="markAll" style="margin-right: 7px;float: right;">
            <input class="check" type="checkbox" id="sAll" onclick="
				$(this).up('form').getElements('input[type=checkbox]').each(function(element)
				{
					element.checked = this.checked;
				}, this);
			">
            <span><label for="sAll"><?=MSG4?></label></span>
        </div>
    <?php //} ?>

    <div class="paginator">
    
    <?php
        if(!isset($_GET['s']) && count($message->inbox1) < 10) {
            echo "&laquo;&raquo;";
        }
        else if (!isset($_GET['s']) && count($message->inbox1) > 10) {
            echo "&laquo;".STATISTIC34." | <a href=\"?s=10\">".STATISTIC35."&raquo;</a>";
        }
        else if(isset($_GET['s']) && count($message->inbox1) > $_GET['s']) {
            if(count($message->inbox1) > ($_GET['s']+10) && $_GET['s']-10 < count($message->inbox1) && $_GET['s'] != 0) {
                echo "<a href=\"?s=".($_GET['s']-10)."\">&laquo;".STATISTIC34."</a> | <a href=\"?s=".($_GET['s']+10)."\"> ".STATISTIC35."&raquo;</a>";
            }
            else if(count($message->inbox1) > $_GET['s']+10) {
                echo "&laquo;".STATISTIC34." | <a href=\"?s=".($_GET['s']+10)."\"> ".STATISTIC35."&raquo;</a>";
            }
            else {
                echo "<a href=\"?s=".($_GET['s']-10)."\">&laquo;".STATISTIC34."</a> | ".STATISTIC35."&raquo;";
            }
        }
        ?>

        </div>
    <tbody>
    <div class="clear"></div>
    
</div>

<button name="realAll" type="submit" value="realAll" id="realAll" class="green">
        <div class="button-container addHoverClick ">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content">
                <?php echo markASRead; ?></div></div>
    </button>


<?php if(!$session->sit && $session->right['s6']) { ?>
        <button name="delmsg_x" type="submit" value="del" id="del" class="green delete">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?= MSG5 ?></div>
            </div>
        </button>

        <?php   } ?>
    <input name="ft" value="m3" type="hidden" />

    </form>
