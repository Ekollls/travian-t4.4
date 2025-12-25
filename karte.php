<?php
include_once "application/Account.php";
if(isset($_GET['d']) && !is_numeric($_GET['d'])) die('Hacking Attemp');
if(isset($_GET['c'])){$c=$_GET['c'];}

ob_start("ob_gzhandler");

?>


<?php include("application/views/html.php");?>


<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE <?php if(!isset($_GET['d'])){ echo 'map'; }else{ echo 'positionDetails'; } ?> <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> season- buildingsV1">
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
                <div class="contentTitle">
                    <a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a>						</div>
                <div class="contentContainer">
                <?php
if(!isset($_GET['d'])){
	include("application/views/Map/newmap.php");
}else{
    include("application/views/Map/vilview.php");
}

?>

                </div>
                <div class="clear">&nbsp;</div>

                <div class="contentFooter"></div>
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
