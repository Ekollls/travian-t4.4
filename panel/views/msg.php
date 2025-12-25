<?php
$msg = $database->getMessage($_GET['nid'],3);

if($msg)

{ ?>



	<link href="../gpack/lang/ar-AE/lang.css?f4b7c" rel="stylesheet" type="text/css">





	<br />



	<div id="content" class="messages">
	<div class="paper">
	<div class="layout">
		<div class="paperTop">
			<div class="paperContent">




    <div id="sender">
	<div class="header label">sender:</div>
        <div class="header text">
                <a href="spieler.php?uid=<?php echo $database->getUserField($msg[0]['owner'],'id',0);?>"><?php echo $database->getUserField($msg[0]['owner'],'username',0);?></a>
                    </div>
        <div class="clear"></div>
    </div>
	<div class="header label">Sent to:</div>
        <div class="header text">
                <a href="spieler.php?uid=<?php echo $database->getUserField($msg[0]['target'],'id',0);?>"><?php echo $database->getUserField($msg[0]['target'],'username',0);?></a>
                    </div>
        <div class="clear"></div>
		
    <div id="subject">
        <div class="header label">Title:</div>
        <div class="header text"><?php echo $msg[0]['topic'];?></div>
    <div class="clear"></div>
</div>


    <div id="time">
        <div class="header label">Sent:</div>
        <div class="header text"><?php echo date('d.m.y',$msg[0]['time']);?> <?php echo date('H:i:s',$msg[0]['time']);?></div>
		
					
        <div class="clear"></div>
    </div>
    <div class="separator"></div>
	<div id="message"><?php 

$input = $msg[0]['message'];

$alliance = $msg[0]['alliance'];

$player = $msg[0]['player'];

$coor = $msg[0]['coor'];

$report = $msg[0]['report'];

include("../application/BBCode.php");

echo stripslashes(nl2br($bbcoded));

?></div>
    <div id="answer">
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="paperBottom"></div>
	</div>
</div>


</div><?php

}

else

{

	echo "Message ID ".$_GET['nid']." doesn't exist!";

}

?>