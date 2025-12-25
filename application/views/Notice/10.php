<div id="reportWrapper">
    <div class="header">
                    <div class="headline withoutQuickNavigation">
                    <div class="subject"><?php echo $database->getVillageField($dataarray[1],"name"); ?> <?=rpts7?> <a class="village" href="karte.php?d=<?=$dataarray[6]?>"><?=$dataarray[7]?></a> </div>
            </div>
                <div class="time">
				<?php
                 $date = $generator->procMtime($all['time']);?>

            <div class="text"><?= $date[0]." ".$date[1]; ?></div>
        </div>
        <div class="toolList">
        </div>
    </div>
    <div class="body">
	<img src="img/x.gif" class="reportImage trade" alt="">
<div class="tradeReport" style="margin-top:-10px;">
    <div class="tradeHeader">
        <div class="headline">
            <h2 class="from">sender</h2>
            <h2 class="to">
                <svg viewBox="0 0 20 20" preserveAspectRatio="none">
                    <path d="M0 0L20 10L0 20z"></path>
                </svg>
                recipient</h2>
        </div>
        <div class="participants">
            <div class="from">
                &nbsp;<a class="player" href="spieler.php?uid=<?php echo $database->getUserField($dataarray[0],"id",0); ?>"><?php echo $database->getUserField($dataarray[0],"username",0); ?></a><br><span>From</span><br><a class="village" href="karte.php?d=<?php echo $dataarray[1]."&amp;c=".$generator->getMapCheck($dataarray[1]); ?>"><?php echo $database->getVillageField($dataarray[1],"name"); ?></a>            </div>
            <div class="to">
                &nbsp;<a class="player" href="spieler.php?uid=<?=$dataarray[8]?>"><?=$dataarray[9]?></a><br><span>to</span><br><a class="village" href="karte.php?d=<?=$dataarray[6]?>"><?=$dataarray[7]?></a>            </div>
        </div>
    </div>

    <table cellpadding="0" cellspacing="0" id="trade">
	<tbody class="goods">
        <tr>
            <td class="empty" colspan="2"></td>
        </tr>
        <tr>
            <th>Resources</th>
            <td>
		
	<div class="inlineIconList resourceWrapper rArea">
	<div class="inlineIcon resources"><i class="r1"></i><span class="value "><?php echo number_format($dataarray[2]); ?></span></div>
	<div class="inlineIcon resources"><i class="r2"></i><span class="value "><?php echo number_format($dataarray[3]); ?></span></div>
	<div class="inlineIcon resources"><i class="r3"></i><span class="value "><?php echo number_format($dataarray[4]); ?></span></div>
	<div class="inlineIcon resources"><i class="r4"></i><span class="value "><?php echo number_format($dataarray[5]); ?></span></div>

	</td>
		</tr>
		<tr>
			<td class="empty" colspan="2"></td>
		</tr>
		<tr>


		</tr>
	</tbody>
</table>					<div class="clear"></div>
	</div>
</div>
</div>
