<?php

include_once "application/Account.php";
if(!$session->right['s5']){
    header("Location:dorf".$session->link.".php");
}

include ("application/Message.php");
if(isset($_GET['t']) && !is_numeric($_GET['t'])) die('Hacking Attemp');
if(isset($_GET['id']) && !is_numeric($_GET['id'])) die('Hacking Attemp');
$message->procMessage($_POST);
if($_GET['t'] == 1){
$database->isWinner();
}



?>


<?php include("application/views/html.php");?>


<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE messages  perspectiveBuildings <?php echo DIRECTION; ?> buildingsV1 ">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">

        <div id="header">
            <div id="mtop">
                <?php
                include("application/views/topheader.php");
                include("application/views/toolbar.php");

                ?>


            </div>
        </div>
        <div id="center">
            <?php include("application/views/sideinfo.php"); ?>
            <div id="contentOuterContainer" class="size1">
                <?php include("application/views/res.php"); ?>
                <div class="contentTitle">&nbsp;</div>
                <div class="contentContainer">
                    <div id="content" class="messages">

                        <h1 class="titleInHeader"><?php echo HEADER_MESSAGES; ?></h1>
                    <?php
                    include("application/views/Message/menu.php");
                    ?>
                    <script type="text/javascript">
                        window.addEvent('domready', function()
                        {
                            $$('.subNavi').each(function(element)
                            {
                                new Travian.Game.Menu(element);
                            });
                        });
                    </script>
<?php
if(isset($_GET['id']) && !isset($_GET['t'])) {
	$message->loadMessage($_GET['id']);
	include("application/views/Message/read.php");
}
else if(isset($_GET['t'])) {
	switch($_GET['t']) {
		case 1:
		if(isset($_GET['id'])) {
		$id = $database->filterIntValue($database->filterVar($_GET['id']));
		}
		include("application/views/Message/write.php");
		break;
		case 2:
        include("application/views/Message/sent.php");
        break;
        
		case 5:
		include("application/views/Message/ignoreList.php");
		break;
    
		default:
		include("application/views/Message/inbox.php");
		break;
	}
}
else {
	include("application/views/Message/inbox.php");
}
			?>

                        <div id="map_details">



                            <div class="clear"></div>

                        </div>

                        <div class="clear"></div>

                        <div class="clear">&nbsp;</div>							</div>							<div class="clear"></div>

                </div> 						<div class="contentFooter">&nbsp;</div>

            </div>
            <?php
            include("application/views/rightsideinfor.php");

            ?>
            <div class="clear"></div>
        </div>
        <?php

        include("application/views/header.php");
        ?>

        <div id="ce"></div>
    </div>
</body>
</html>

