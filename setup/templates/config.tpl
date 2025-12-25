<?php

if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\"><?=INS10?></span></div><br>";
}


?>
<div class="b-articlesmall">
    <form name="hf" onsubmit="return false;">
        <table>
           <tr><td><?=INS11?></td><td><?=INS12?></td><td><?=INS13?></td><td> </td><td><?=INS14?></td><td><?=INS15?></td><td><?=INS16?></td><td></td></tr>
            <tr><td><input type="text" size="1" maxlength=2 value="1" name="mm">  </td>
                <td><input type="text" size=1 maxlength=2 value="1" name="dd"></td>
                <td><input type="text" size=3 maxlength=4 value="1970" name="yyyy"></td>
<td></td>
                <td><input type="text" size=3 maxlength=2 value="0" name="hh"> </td>
                <td><input type="text" size=3 maxlength=2 value="0" name="mn"></td>
                <td><input type="text" size=3 maxlength=2 value="0" name="ss"></td>
                <td> <input type="button" title="Дату in Timestamp" value="Дату in Timestamp" onClick="HumanToEpoch();"></td>
            </tr></table>
        <div id="result2"> </div>
    </form>
    <br /></div>
<form action="process.php" method="post" id="dataform">

    <p>
    <table><tr>
            <td><span class="f9 c6"><?=INS17?></span></td><td width="140"><input type="text" name="servername" id="servername" value="test"></td></tr><tr>

            <td><span class="f9 c6"><?=INS18?></span></td><td><input name="speed" type="text" id="speed" value="100" size="2"></td></tr><tr>
            <td><span class="f9 c6"><?=INS19?></span></td><td width="140"><input type="text" name="incspeed" id="incspeed" value="100" size="2"></td></tr><tr>

            <td><span class="f9 c6"><?=INS20?></span></td><td width="140"><input type="text" name="tradercap" id="tradercap" value="1" size="2"></td></tr>
        <td><span class="f9 c6"><?=TA2?></span></td><td width="140"><input type="text" name="cranny" id="tradercap" value="1" size="2"></td></tr>
            <td><span class="f9 c6"><?=INS21?></span></td><td>
                <select name="wmax">
                    <option value="25"><?=INS21M?></option>
                    <option value="50"><?=INS22?></option>
                    <option value="100" selected="selected"><?=INS23?></option>
                    <option value="150"><?=INS24?></option>
                    <option value="200"><?=INS25?></option>
                    <option value="250"><?=INS26?></option>
                    <option value="300"><?=INS27?></option>
                    <option value="350"><?=INS28?></option>
                    <option value="400"><?=INS29?></option>
                </select>
            </td></tr>

        <td><span class="f9 c6"><?=INS30?></span></td><td><input name="homepage" type="text" id="homepage" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/"></td></tr>

        <td><span class="f9 c6"><?=INS31?></span></td><td>
            <select name="beginner">
                <option value="7200"><?=INS31M?></option>
                <option value="10800"><?=INS32?></option>
                <option value="18000"><?=INS33?></option>
                <option value="28800"><?=INS34?></option>
                <option value="36000"><?=INS35?></option>
                <option value="43200" selected="selected"><?=INS36?></option>
                <option value="86400"><?=INS37?></option>
                <option value="172800"><?=INS38?></option>
                <option value="259200"><?=INS39?></option>
                <option value="432000"><?=INS40?></option>
            </select>
        </td></tr>


        <td><span class="f9 c6"><?=INS41?></span></td><td width="140"><input type="text" name="storage_multiplier" id="storage_multiplier" value="1"></td></tr><tr>
            <td><span class="f9 c6"><?=INS42?></span></td><td width="140"><input type="text" name="ts_threshold" id="ts_threshold" value="20"></td></tr><tr>
            <td><span class="f9 c6"><?=INS129?></span></td><td width="140"><input type="text" name="adv" id="advent" value="10"></td>



    </table>
    </p>

    <p>
        <span class="f10 c"><?=INS43?></span>
    <table>

        <td><span class="f9 c6"><?=INS44?></span></td><td>
            <select name="admin_rank">
                <option value="True" selected="selected"><?=INS45?></option>
                <option value="False"><?=INS46?></option>
            </select>
        </td>
    </table>
    </p>

    <p>
        <span class="f10 c"><?=INS47?></span>
    <table><tr>
            <td><span class="f9 c6"><?=INS48?></span></td><td><input name="sserver" type="text" id="sserver" value="localhost"></td></tr><tr>
            <td><span class="f9 c6"><?=INS49?></span></td><td><input name="suser" type="text" id="suser" value="root"></td></tr><tr>
            <td><span class="f9 c6"><?=INS50?></span></td><td><input type="password" name="spass" id="spass"></td></tr><tr>
            <td><span class="f9 c6"><?=INS51?></span></td><td><input type="text" name="sdb" id="sdb" value="travian"></td></tr><tr>

    </table>
    </p>
<br />
    <span class="f10 c"><?=INS52?></span>
    <table>
        <td><span class="f9 c6"><?=INS53?></span></td><td>
            <select name="plus_time">
                <option value="(3600*12)"><?=INS54?></option>
                <option value="(3600*24)"><?=INS55?></option>
                <option value="(3600*24*2)"><?=INS56?></option>
                <option value="(3600*24*3)"><?=INS57?></option>
                <option value="(3600*24*4)"><?=INS58?></option>
                <option value="(3600*24*5)"><?=INS59?></option>
                <option value="(3600*24*6)"><?=INS60?></option>
                <option value="(3600*24*7)" selected="selected"><?=INS61?></option>
            </select>
        </td></tr>
        <td><span class="f9 c6"><?=INS62?></span></td><td>
            <select name="plus_production">
                <option value="(3600*12)"><?=INS63?></option>
                <option value="(3600*24)"><?=INS64?></option>
                <option value="(3600*24*2)"><?=INS65?></option>
                <option value="(3600*24*3)"><?=INS66?></option>
                <option value="(3600*24*4)"><?=INS67?></option>
                <option value="(3600*24*5)"><?=INS68?></option>
                <option value="(3600*24*6)"><?=INS69?></option>
                <option value="(3600*24*7)" selected="selected"><?=INS70?></option>
            </select>
        </td></tr>

        <tr><td><span class="f9 c6"><?=INS81?></span></td><td width="140"><input type="text" name="defgold" id="start_time" value="999999"></td></tr>
    </table>



    <p>


    </p>
    <br />
    <span class="f10 c"><?=INS84?></span>
    <table>
        <tr><td><span class="f9 c6"><?=INS85?><small><?=INS86?> </small></span></td><td width="140"><input type="text" name="opening" id="start_time" value="<?php echo time(); ?>"></td></tr>
        <tr><td><span class="f9 c6"><?=INS87?><small><?=INS88?> </small></span></td><td width="140"><input type="text" name="ARTEFACTS" id="start_time" value="<?php echo time()+3600*24*4; ?>"></td></tr>
        <tr><td><span class="f9 c6"><?=INS89?><small><?=INS90?></small></span></td><td width="140"><input type="text" name="WW_TIME" id="start_time" value="<?php echo time()+3600*24*5; ?>"></td></tr>
        <tr><td><span class="f9 c6"><?=INS91?><small><?=INS92?></small></span></td><td width="140"><input type="text" name="WW_PLAN" id="start_time" value="<?php echo time()+3600*24*6; ?>"></td></tr>

        <tr>        <td><span class="f9 c6"><?=INS92M?></span></td><td><select name="village_expand">
                    <option value="1" selected="selected"><?=INS93?></option>
                    <option value="0"><?=INS94?></option>
                </select></td></tr>
        <tr><td><span class="f9 c6"><?=INS95?></span></td><td width="140"><select name="QUEST">
                    <option value="True" selected="selected"><?=INS96?></option>
                    <option value="False"><?=INS97?></option>
                </select></td></tr>
        <tr><td><span class="f9 c6"><?=INS98?><br/><small><?=INS107?><br /><?=INS110?></small></span></td><td width="140"><input type="text" name="MAX_FILES" id="start_time" value="1000"></td></tr>
        <tr><td><span class="f9 c6"><?=INS99?><br/><small><br /><?=INS108?></small></span></td><td width="140"><input type="text" name="MAX_FILESH" id="start_time" value="3000"></td></tr>
        <tr><td><span class="f9 c6"><?=INS100?><br/><small><?=INS109?><br /><?=INS111?></span></td><td width="140"><input type="text" name="IMGQUALITY" id="start_time" value="50"></td></tr>
        <tr><td><span class="f9 c6"><?=INS101?></span></td><td width="140"><select name="MOMENT_TRAIN">
                    <option value="True"><?=INS102?></option>
                    <option value="False" selected="selected"><?=INS103?></option>
                </select></td></tr>


        <tr><td><span class="f9 c6"><?=INS104?></span></td><td width="140"><input type="text" name="auctime" id="start_time" value="10800"></td></tr>


        <tr><td><span class="f9 c6"><?=INS105?></span></td><td width="140"><input type="text" name="oasisx" id="start_time" value="1"></td></tr>
    </table>


    <center>
        <input type="submit" name="Submit" id="Submit" value="Submit">
        <input type="hidden" name="subconst" value="1"></center>
</form>

