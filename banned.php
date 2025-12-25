<?php


include_once "application/Account.php";



if($session->access == BANNED){
?>
    
    
<?php include("application/views/html.php");?>


<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE statistics <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> season- buildingsV1">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">

        <div id="header">

            <?php
            include("application/views/topheader.php"); // mehdi jan injaro man edit kardam bordam tu hamin file ke berim baghie ja ha ham include konim!
            include("application/views/toolbar.php"); // mehdi jan injaro man edit kardam bordam tu hamin file ke berim baghie ja ha ham include konim!

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
                    <div id="content" class="statistics">
<?php
include("application/views/ban_msg.php");
?>


                    </div>
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
        <div id="ce"></div>
    </div>
</body>
    </html>


<?php
}
else{header("Location: dorf1.php");  exit();}?>
