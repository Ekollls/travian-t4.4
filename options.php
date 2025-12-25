<?php
include_once "application/Account.php";
if($session->sit == 1) {
    header("Location: dorf".$session->link.".php");
}
include ("application/Profile.php");

$profile->procProfile($_POST);
$profile->procSpecial($_GET);
if(isset($_GET['uid']) && !is_numeric($_GET['uid'])) die('Hacking Attemp');
if(isset($_GET['delcancel']) && $_GET['delcancel']==1){
    //if((($session->deleting)-time())>42300){
        $profile->cancelDeleting();
    //}
}



if(isset($_GET['s'])){
    $database->isWinner();
}
?>


<?php include("application/views/html.php");?>

<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE options <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> buildingsV1">
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
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a></div>
                <div class="contentContainer">
                    <div id="content" class="options">

                            <script type="text/javascript">
                                window.addEvent('domready', function()
                                {
                                    $$('.subNavi').each(function(element)
                                    {
                                        new Travian.Game.Menu(element);
                                    });
                                });
                            </script>

                            <div class="contentNavi subNavi">
                            <div title="" class="container <?php if(!isset($_GET['s'])) { echo "active"; }else{ echo "normal"; } ?>">
                                    <div class="background-start">&nbsp;</div>
                                    <div class="background-end">&nbsp;</div>
                                    <div class="content"><a href="options.php" class="tabItem"><?php echo $lang['main']['options'][1]; ?></a></div>
                                </div>
                                <div title="" class="container <?php if(isset($_GET['s']) && is_numeric($_GET['s']) && $_GET['s'] == 2){ echo "active"; }else{ echo "normal"; } ?>">
                                    <div class="background-start">&nbsp;</div>
                                    <div class="background-end">&nbsp;</div>
                                    <div class="content"><a href="options.php?s=2" class="tabItem"><?=PROFM4?></a></div>
                                </div>

                                <div class="clear"></div>
                            </div>
                        <?php

                        if(isset($_GET['s']) && is_numeric($_GET['s']) && $_GET['s'] == 2){
                                include("application/views/Profile/account.php");
                        }else{
                            include("application/views/Profile/goptions.php");
                        }


                        ?>

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