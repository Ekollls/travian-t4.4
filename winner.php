<?php

include("application/Account.php");
include("application/Lang/en.php");
//$database->isWinner();
if(!$database->Winnerkills()){header("Location:dorf1.php"); exit;}

$fromfile=true;
include("givegoldoutSluShayGruPPySPLIN.php");
## Get Rankings for Ranking Section
## Top 3 Population
$q = "
    SELECT users.id userid, users.username username,users.alliance alliance, (
    SELECT SUM( vdata.pop )
    FROM vdata
    WHERE vdata.owner = userid
    )totalpop, (
        SELECT COUNT( vdata.wref )
    FROM vdata
    WHERE vdata.owner = userid AND type != 99
    )totalvillages, (
    SELECT alidata.tag
    FROM alidata, users
    WHERE alidata.id = users.alliance
    AND users.id = userid
    )allitag
    FROM users
    WHERE users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " and id>5
    ORDER BY totalpop DESC, totalvillages DESC, username ASC";

    $result = $database->query($q);
    foreach($result as $row)
    {
        $datas[] = $row;
    }

    ## Top Attacker
    $q = "
    SELECT users.id userid, users.username username, users.apall,  (
    SELECT COUNT( vdata.wref )
    FROM vdata
    WHERE vdata.owner = userid AND type != 99
    )totalvillages, (
    SELECT SUM( vdata.pop )
    FROM vdata
            WHERE vdata.owner = userid
    )pop
    FROM users
    WHERE users.apall >=0 AND users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " AND users.tribe <= 3
    ORDER BY users.apall DESC, pop DESC, username ASC";

        $result = $database->query($q);
    foreach($result as $row)
    {
        $attacker[] = $row;
    }

    ## Top Defender
    $q = "
    SELECT users.id userid, users.username username, users.dpall,  (
    SELECT COUNT( vdata.wref )
    FROM vdata
    WHERE vdata.owner = userid AND type != 99
    )totalvillages, (
    SELECT SUM( vdata.pop )
    FROM vdata
    WHERE vdata.owner = userid
    )pop
    FROM users
    WHERE users.dpall >=0 AND users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " and id>5
    ORDER BY users.dpall DESC, pop DESC, username ASC";
        $result = $database->query($q);
    foreach($result as $row)
    {
        $defender[] = $row;
    }


	$sql = $database->query("SELECT vref FROM fdata WHERE f99 = '100' and f99t = '40'");
	$vref = $winner = $sql[0]['vref'];

	$sql = $database->query("SELECT name,owner FROM vdata WHERE wref = '".$vref."'");
	$winningvillagename = $sql[0]['name'];
    $owner = $sql[0]['owner'];

	$sql = $database->query("SELECT username,alliance FROM users WHERE id = '".$owner."'");
	$username = $sql[0]['username'];
   $allianceid = $sql[0]['alliance'];

	$sql = $database->query("SELECT name,tag FROM alidata WHERE id = '".$allianceid."'");
	$winningalliance = $sql[0]['name'];
    $winningalliancetag = $sql[0]['tag'];

?>
<?php include("application/views/html.php");?>
<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE village-2 <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> buildingsV1">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">

        <div id="header">

            <?php
            include("application/views/topheader.php");
            include("application/views/toolbar.php");

            ?>

        </div>
        <div id="center">


            <?php include("application/views/sideinfo.php"); ?>

            <div id="contentOuterContainer" class="size1">

                <?php include("application/views/res.php"); ?>
                <div class="contentTitle"><a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="#" target="_blank" title="Travian Answers">&nbsp;</a></div>
                <div class="contentContainer">
                    <div id="content" class="plus">
                        <script type="text/javascript">
                            window.addEvent('domready', function()
                            {
                                $$('.subNavi').each(function(element)
                                {
                                    new Travian.Game.Menu(element);
                                });
                            });
                        </script>

                <div id="content" class="village2" style="font-size: 9pt;">
                    <img class="ww g40 g40_9" src="img/x.gif" align="right"  title=""/>
                    <p style="width:90%" >
					<b><?=$lang_winner['1'];?>,</b>
					<br /><br /><?=$lang_winner['2'];?><br /><br />

					<?=$lang_winner['3'];?> "<?php echo "<a href=\"karte.php?d=$vref&c=".$generator->getMapCheck($vref)."\">$winningvillagename</a>"; ?>", <?=$lang_winner['4'];?>
					<br /><br />

					  <?=$lang_winner['5'];?> "<?php echo "<a href=\"allianz.php?aid=$allianceid\">$winningalliancetag</a>"; ?>", "<?php echo "<a href=\"spieler.php?uid=$owner\">$username</a>"; ?>"
                      <?=$lang_winner['6'];?> "<?php echo "<a href=\"spieler.php?uid=$owner\">$username</a>"; ?>" <?=$lang_winner['7'];?><br /><br />


					"<a href="spieler.php?uid=<?php echo $datas[0]['userid']; ?>" title="<?=$lang_winner['desc1'];?>: <?php echo $datas[0]['totalvillages']; echo "\n";?><?=$lang_winner['desc2'];?>: <?php echo $datas[0]['totalpop']; ?>"><?php echo $datas[0]['username']; ?></a>" <?=$lang_winner['8'];?> "<a href="spieler.php?uid=<?php echo $datas[1]['userid']; ?>" title="<?=$lang_winner['desc1'];?>: <?php echo $datas[1]['totalvillages']; echo "\n";?><?=$lang_winner['desc2'];?>: <?php echo $datas[1]['totalpop']; ?>"><?php echo $datas[1]['username']; ?></a>" <?=$lang_winner['9'];?> "<a href="spieler.php?uid=<?php echo $datas[2]['userid']; ?>" title="Total Villages: <?php echo $datas[2]['totalvillages']; echo "\n";?>Total Population: <?php echo $datas[2]['totalpop']; ?>"><?php echo $datas[2]['username']; ?></a>".<br />
					"<a href="spieler.php?uid=<?php echo $attacker[0]['userid']; ?>" title="<?=$lang_winner['desc3'];?>: <?php echo $attacker[0]['apall'];?>"><?php echo $attacker[0]['username']; ?></a>" <?=$lang_winner['10'];?><br />
					"<a href="spieler.php?uid=<?php echo $defender[0]['userid']; ?>" title="<?=$lang_winner['desc4'];?>: <?php echo $defender[0]['dpall'];?>"><?php echo $defender[0]['username']; ?></a>" <?=$lang_winner['11'];?>


					<br /><br />
					<?=$lang_winner['12'];?>,<br />
					<?=$lang_winner['13'];?>
					</p>


                    <center><a href="dorf1.php">&raquo; <?=$lang_winner['14'];?></a></center>
                    </div>
                        <div class="clear">&nbsp;</div>
                    </div>
                    <div class="clear"></div>


                </div>
                <div class="contentFooter">&nbsp;</div>

            </div>
            <?php
            include("application/views/rightsideinfor.php");
            ?>
            <div class="clear"></div>
        </div>
        <?php

        include("application/views/header.php");
        ?>
    </div>
    <div id="ce"></div>
</div>
</body>
</html>