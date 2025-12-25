<h1><?php echo PROFHEAD; ?></h1>

<?php
$rights=$database->SitterRights($session->uid);

if($session->sit == 0){
?>
<form action="options.php?s=2" method="POST">
<input type="hidden" name="ft" value="p3">
<input type="hidden" name="uid" value="<?php echo $session->uid; ?>" />
    <h4 class="round"><?php echo ACC1; ?></h4>
    <table cellpadding="1" cellspacing="1" id="change_pass" class="account transparent">
<thead></thead><tbody>
<tr>
    <th><?php echo ACC2; ?></th>
    <td><input class="text" type="password" name="pw1" maxlength="30" /></td>
</tr>

<tr>
    <th><?php echo ACC3; ?></th>
    <td><input class="text" type="password" name="pw2" maxlength="30" /></td>
</tr>
<tr>
    <th><?php echo ACC3; ?></th>
    <td><input class="text" type="password" name="pw3" maxlength="30" /></td>
</tr></tbody></table>
<?php
if($form->getError("pw") != "") {
echo "<span class=\"error\">".$form->getError('pw')."</span>";
}
?>    <?php /*
<table cellpadding="1" cellspacing="1" id="change_mail" class="account"><thead><tr>
        <th colspan="2"><?php echo ACC4; ?></th>

    </tr></thead>

    <tbody><tr>
        <td class="note" colspan="2"><?php echo ACC5; ?></td></tr>
    <tr>
        <th><?php echo ACC6; ?></th>
        <td><input class="text" type="text" name="email_alt" /></td>
    </tr>
    <tr>

        <th><?php echo ACC7; ?></th>
        <td><input class="text" type="text" name="email_neu" /></td>
    </tr></tbody></table>
<?php
if($form->getError("email") != "") {
echo "<span class=\"error\">".$form->getError('email')."</span>";
}
*/?>
    <h4 class="round spacer"><?php echo ACC8; ?></h4>

    <div class="text"><?php echo ACC9; ?></div>
    <script type="text/javascript">
        function cloneName(obj, id)
        {
            $(id).innerHTML = obj.value.stripTags();
        }

    </script>

    <table class="sitters transparent">
        <tbody><tr>
            <th>
                <div class="boxes boxesColor lightGreen">
                    <div class="boxes-tl"></div>
                    <div class="boxes-tr"></div>
                    <div class="boxes-tc"></div>
                    <div class="boxes-ml"></div>
                    <div class="boxes-mr"></div>
                    <div class="boxes-mc"></div>
                    <div class="boxes-bl"></div>
                    <div class="boxes-br"></div>
                    <div class="boxes-bc"></div>
                    <div class="boxes-contents cf"><span><?= ACC21 ?> 1</span></div>
                </div>
            </th><td>
                <?php
                if(!$session->sit1) {
                echo "<input class=\"text\" type=\"text\" name=\"v1\" maxlength=\"15\">";
                }
                if($session->sit1) {

                echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = 'options.php?s=3&e=2&id=".$session->sit1."&a=".$session->checker."&type=1'; return false;\"><img src=\"img/x.gif\" class=\"del\" alt=\"helyettes\"></button>";
                echo "&nbsp;".$database->getUserField($session->sit1,"username",0)."";

                }
                ?></td>
        </tr>
        <tr>
            <th>
                <div class="boxes boxesColor orange"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf"><span><?=ACC21?> 2</span>	</div>
                </div>
            </th><td>
                <?php
                if($session->sit2 == 0) {
                    echo "<input class=\"text\" type=\"text\" name=\"v2\" maxlength=\"15\">";
                }
                if($session->sit2 != 0) {

                    echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = 'options.php?s=3&e=2&id=".$session->sit2."&a=".$session->checker."&type=2'; return false;\"><img src=\"img/x.gif\" class=\"del\" alt=\"helyettes\"></button>";
                    echo "&nbsp;".$database->getUserField($session->sit2,"username",0)."";

                }
                ?></td>
        </tr>
        </tbody></table>
<?php
if($session->sit1!=0){
$rights1=$database->SitterRights($session->sit1);
}else{
    for($i=1;$i<=6;$i++){
    $rights1['s'.$i]=0;
    }
}
if($session->sit2!=0){
$rights2=$database->SitterRights($session->sit2);
}else{
    for($i=21;$i<=26;$i++){
        $rights1['s'.$i]=0;
    }
}
?>
<table cellspacing="1" cellpadding="1" class="sitters2 spacer">
    <tbody>
    <tr class="sitterHead">
        <th><?=PLAYER?></th>

        <td id="sitterName0" class="name"></td>


        <td id="sitterName1" class="name"></td>

    </tr>
    <tr>
        <th><?=accsit0?></th>
        <td><input type="checkbox" class="check" <?=($rights['s1']==1)?'checked="checked"':'';?> name="s1" value="<?=$rights['s1'] ?>"></td>
        <td><input type="checkbox" class="check" <?=($rights['s21']==1)?'checked="checked"':'';?> name="s21" value="<?=$rights['s21']?>"></td>
    </tr>
    <tr>
        <th><?=accsit1?></th>
        <td><input type="checkbox" class="check" <?=($rights['s2']==1)?'checked="checked"':'';?> name="s2" value="<?=$rights['s2'] ?>"></td>
        <td><input type="checkbox" class="check" <?=($rights['s22']==1)?'checked="checked"':'';?> name="s22" value="<?=$rights['s22'] ?>"></td>
    </tr>
    <tr>
        <th><?=accsit2?></th>
        <td><input type="checkbox" class="check" <?=($rights['s3']==1)?'checked="checked"':'';?> name="s3" value="<?=$rights['s3']?>"></td>
        <td><input type="checkbox" class="check" <?=($rights['s23']==1)?'checked="checked"':'';?> name="s23" value="<?=$rights['s23'] ?>"></td>
    </tr>
    <tr>
        <th><?=accsit3?></th>
        <td><input type="checkbox" class="check" <?=($rights['s4']==1)?'checked="checked"':'';?> name="s4" value="<?=$rights['s4']?>"></td>
        <td><input type="checkbox" class="check" <?=($rights['s24']==1)?'checked="checked"':'';?> name="s24" value="<?=$rights['s24'] ?>"></td>
    </tr>
    <tr>
        <th><?=accsit4?></th>
        <td><input type="checkbox" class="check" <?=($rights['s5']==1)?'checked="checked"':'';?> name="s5" value="<?=$rights['s5']?>"></td>
        <td><input type="checkbox" class="check" <?=($rights['s25']==1)?'checked="checked"':'';?> name="s25" value="<?=$rights['s25'] ?>"></td>
    </tr>
    <tr>
        <th><?=accsit5?></th>
        <td><input type="checkbox" class="check" <?=($rights['s6']==1)?'checked="checked"':'';?> name="s6" value="<?=$rights['s6']?>"></td>
        <td><input type="checkbox" class="check" <?=($rights['s26']==1)?'checked="checked"':'';?> name="s26" value="<?=$rights['s26'] ?>"></td>
    </tr>
    </tbody>
</table>

    <h4 class="round spacer"><?=ACC20?></h4>


    <table class="sitters transparent">
        <tbody><tr>
            <th>
                <div class="boxes boxesColor lightGreen"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf"><span><?=ACC21?> 1				</span>	</div>
                </div>
            </th><td>
<?php
$sitee = $database->getSitee($session->uid);


    if(count($sitee[0])){

        echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = 'options.php?s=3&e=3&id=".$session->uid."&owner=".$sitee[0]['id']."&a=".$session->checker."&type=1'; return false;\"><img src=\"img/x.gif\" class=\"del\" alt=\"helyettes\"></button>";
        echo "&nbsp;".$sitee[0]['username']."";
    }else{
       echo "<span class=\"none\">".ACC11."</span>";
    }


?>
</td></tr>


        <tr>
            <th>
                <div class="boxes boxesColor orange"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf"><span><?=ACC21?> 2</span>	</div>
                </div>
            </th><td>
                <?php
                if(count($sitee[1])){

                    echo "<button type=\"button\" value=\"del\" class=\"icon\" onclick=\"window.location.href = 'options.php?s=3&e=3&id=".$session->uid."&owner=".$sitee[1]['id']."&a=".$session->checker."&type=2'; return false;\"><img src=\"img/x.gif\" class=\"del\" alt=\"helyettes\"></button>";
                    echo "&nbsp;".$sitee[1]['username']."";
                }else{
                    echo "<span class=\"none\">".ACC11."</span>";
                }

                ?></td>
        </tr>
        </tbody></table>
<table cellspacing="1" cellpadding="1" class="sitters2 spacer">
    <tbody>
    <tr class="sitterHead">
        <th><?=PLAYER?></th>

        <td id="sitterName0" class="name"></td>


        <td id="sitterName1" class="name"></td>

    </tr>
    <tr>
        <th><?=accsit0?></th>
        <td><input type="checkbox" class="check" <?=($rights1['s1']==1)?'checked="checked"':'';?>  disabled="disabled"></td>
        <td><input type="checkbox" class="check" <?=($rights2['s21']==1)?'checked="checked"':'';?> disabled="disabled"></td>
    </tr>
    <tr>
        <th><?=accsit1?></th>
        <td><input type="checkbox" class="check" <?=($rights1['s2']==1)?'checked="checked"':'';?>  disabled="disabled"></td>
        <td><input type="checkbox" class="check" <?=($rights2['s22']==1)?'checked="checked"':'';?>  disabled="disabled"></td>
    </tr>
    <tr>
        <th><?=accsit2?></th>
        <td><input type="checkbox" class="check" <?=($rights1['s3']==1)?'checked="checked"':'';?>  disabled="disabled"></td>
        <td><input type="checkbox" class="check" <?=($rights2['s23']==1)?'checked="checked"':'';?>  disabled="disabled"></td>
    </tr>
    <tr>
        <th><?=accsit3?></th>
        <td><input type="checkbox" class="check" <?=($rights1['s4']==1)?'checked="checked"':'';?>  disabled="disabled"></td>
        <td><input type="checkbox" class="check" <?=($rights2['s24']==1)?'checked="checked"':'';?>  disabled="disabled"></td>
    </tr>
    <tr>
        <th><?=accsit4?></th>
        <td><input type="checkbox" class="check" <?=($rights1['s5']==1)?'checked="checked"':'';?>  disabled="disabled"></td>
        <td><input type="checkbox" class="check" <?=($rights2['s25']==1)?'checked="checked"':'';?>  disabled="disabled"></td>
    </tr>
    <tr>
        <th><?=accsit5?></th>
        <td><input type="checkbox" class="check" <?=($rights1['s6']==1)?'checked="checked"':'';?>  disabled="disabled"></td>
        <td><input type="checkbox" class="check" <?=($rights2['s26']==1)?'checked="checked"':'';?> disabled="disabled"></td>
    </tr>
    </tbody>
</table>

<?php
/*
if($form->getError("email") != "") {
echo "<span class=\"error\">".$form->getError('email')."</span>";
}*/
?>
    <h4 class="round spacer"><?php echo ACC13; ?></h4>
    <table cellpadding="1" cellspacing="1" id="del_acc" class="account transparent"><tbody>
<tr>
    <td class="note" colspan="2"><?php echo ACC14; ?></td>
</tr><tr>
<?php
$timestamp = $session->deleting;
if($timestamp) {
echo "<td colspan=\"2\" class=\"count\">";
//if($timestamp > time()+12*3600) {
    ?>
<button type="button" class="icon" onclick="window.location.href = 'options.php?s=3&delcancel=1'; return false;">
<img src="img/x.gif" class="del" alt="del"></button>
    <?php
/*echo "<a href=\"options.php?s=3&delcancel=1\"><img
		class=\"del\" src=\"img/x.gif\" alt=\"Cancel process\"
		title=\"Cancel process\" /> </a>";*/
        //}
		$time=$generator->getTimeFormat(($timestamp-time()));
         echo ACC19; ?> <span class="timer" counting="down" value="<?php echo ($timestamp-time()); ?>"><?php echo $time;?></span></td><?php
}
else {
?>
<th><?php echo ACC15; ?></th>
        <td class="del_selection">
            <label><input class="radio" type="radio" name="del" value="1" /> <?php echo ACC17; ?></label>
            <label><input class="radio" type="radio" name="del" value="0" checked /> <?php echo ACC18; ?></label>
        </td>
    </tr>
    <tr>
        <th><?php echo ACC16; ?></th>

        <td><input class="text" type="password" name="del_pw" maxlength="20" /></td>
        <?php
        }
        ?>
    </tr></tbody></table>
    <?php
if($form->getError("del") != "") {
echo "<span class=\"error\">".$form->getError("del")."</span>";
}
?>
    <br />

    <div class="save_button">
        <button type="submit" class="green">
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
    </div>
</form>

<?php }