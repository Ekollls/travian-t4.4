<?php
$dataarray = explode(",",$all['data']);
$outputList='';
?>
<div id="reportWrapper">
    <div class="header">
        <div class="headline withoutQuickNavigation">

        <div class="subject"><?=$all['topic']?>.</div>
        </div>

        <div class="time">
            <?php $date = $generator->procMtime($all['time']); ?>
            <div class="text"><?= $date[0]." ".$date[1]; ?></div>
        </div>
    </div>



    <div class="body">
        <img src="img/x.gif" class="reportImage usedCages" alt="">
        <div class="animalReport">

        <div class="animalHeader" style="margin-top:-8px;">
        <div class="headline">
            <div class="from">
                <i class="tribeIcon bigTribe4"> </i>
                <img class="roleIcon" src="img/svg/combat/svgDefend.svg" alt="">
                <h2>Natar</h2>
            </div>
            <div class="to">
                <svg viewBox="0 0 20 20" preserveAspectRatio="none">
                    <path d="M0 0L20 10L0 20z"></path>
                </svg>
            </div>
        </div>
        <div class="participants">
        <?php $oCoor = $database->getCoor($dataarray[11]); ?>

            From oasis <a class="" href="karte.php?x=<?php echo $oCoor['x']; ?>&amp;y=<?php echo $oCoor['y']; ?>">&lrm;&#8237;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(<?php echo $oCoor['x']; ?></span><span class="coordinatePipe">|</span><span class="coordinateY"><?php echo $oCoor['y']; ?>)</span></span>&#8236;&lrm;</a>        </div>
    </div>

    <table id="attacker" class="attacker" cellpadding="0" cellspacing="0">
    <tbody class="units ">

    <tr><th class="coords"></th>

                    <?php
                    $class="";
                    for($i=31;$i<=40;$i++) {
                        if($i==40){$class=' last';}
                        echo "<td class='$class'><img src=\"img/x.gif\" title=\"".constant('U'.$i)."\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
                    }
?></tbody>
                <tbody class="units last">
                <?php
                    echo "</tr><tr><th>".rpts0."</th>";
                    $class="";
                    for($i=1;$i<=10;$i++) {
                        if($i==10){$class='last';}
                        if($dataarray[$i] == 0) {
                            echo "<td class=\"none  $class\">0</td>";
                        }
                        else {
                            echo "<td class=".$class.">".$dataarray[$i]."</td>";
                        }
                    }

                    echo "</tr></tbody>";
                    echo '</table>';
                    

                    ?>
                    	</div>
			</div>
</div>