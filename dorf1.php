<?php
$start = microtime(true);
include_once "application/Account.php";
$_SESSION['dorf']=$session->link=1;
if(isset($_GET['visit'])){
    //$database->UpdateAchievU($session->uid,"`a7`=1"); //ачиinка за группу
    header("Location:dorf1.php");
    exit;
}
$building->procBuild($_GET);
?>


<?php include("application/views/html.php");?>
<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE village1  perspectiveResources <?php echo DIRECTION; ?> season- buildingsV1">
<div id="reactDialogWrapper"></div>
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>

<div id="background">
    <div id="bodyWrapper">

        <div id="header">
            <?php
            include("application/views/topheader.php");
            include("application/views/toolbar.php");
            ?>
        </div>
        <div id="center">

            <?php
            include("application/views/sideinfo.php");?>


            <div id="contentOuterContainer" class="size1">
                <?php   include("application/views/res.php");

                ?>
                <div class="contentTitle">
                    &nbsp;</div>
                <div class="contentContainer">
                    <div id="content" class="village1">
<?php
             include("application/views/field.php");
if(!isset($timer)){
                        $timer = 1;
}
                        if ($building->NewBuilding) {
                            include("application/views/Building.php");
                        }
                        ?>
                        <div id="map_details">
                            <div class="movements">
                                <?php
                                include("application/views/movement.php");
                                ?></div>
                            <?php
                            include("application/views/production.php");
                            include("application/views/troops.php");
                            echo '<div class="clear"></div>';
                            echo '</div>';
                            ?>



                        </div></div>
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