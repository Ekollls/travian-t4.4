<?php
include_once "application/Account.php";
include ("application/Profile.php");
$profile->procProfile($_POST);
if(isset($_GET['uid']) && !is_numeric($_GET['uid'])) die('Hacking Attemp');


if(!isset($_GET['uid']) && !isset($_GET['s'])){
    $_GET['uid']=$session->uid;
}

if(isset($_GET['s'])){
$database->isWinner();
}
?>


<?php include("application/views/html.php");?>

<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE spieler <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> buildingsV1">
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
                    <div id="content" class="player">


<?php
if(isset($_GET['uid'])) {

  $user = $database->getUserArray($database->filterIntValue($database->filterVar($_GET['uid'])),1);
    ?><h1 class="titleInHeader"><?php echo $lang['profile'][1]." - ".$user['username']; ?></h1>
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
                        if($user['id']==$session->uid){
                            include("application/views/Profile/menu.php");
                        }
  if(isset($user['id'])){
   include("application/views/Profile/overview.php");
  } else {
   header("Location: dorf1.php");
  }


}
else if (isset($_GET['s'])) {

 if($_GET['s'] == 1) {

    echo  '<h1 class="titleInHeader">'.$lang['Profile']['00'].'</h1>';
    include("application/views/Profile/menu.php");
    include("application/views/Profile/profile.php");
 }
 if($_GET['s'] == 2) {
    echo  '<h1 class="titleInHeader">List the Relationships</h1>';
  include("application/views/Profile/preference.php");
 }



 if($_GET['s'] > 2 or $session->sit == 1) {
 header("Location: ".$_SERVER['PHP_SELF']."?uid=".$session->uid);
 }
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