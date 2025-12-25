<?php
include_once "application/Account.php";
$_SESSION['dorf']=$session->link=2;
if(isset($_GET['visit'])){
    //$database->UpdateAchievU($session->uid,"`a7`=1"); //ачиinка за группу
    header("Location:dorf2.php");
    exit;
}


$building->procBuild($_GET);
$_SESSION['dorf']=2;

if (isset($_GET['pivo'])) {

    $wid = $village->wid;

    $vwood = $village->awood;
    $vclay = $village->aclay;
    $viron = $village->airon;
    $vcrop = $village->acrop;

    if (38700 < $vwood && 16800 < $vclay && 59400 < $viron && 13400 < $vcrop) {
        $lvl = $village->resarray;
        $lvll = 0;
        for ($i = 16; $i <= 38; $i++) {
            if ($lvl['f' . $i . 't'] == 35) {
                $lvll = $lvl['f' . $i];
            }
        }
        if($lvll){
        $bre = $bid35[$lvll]['attri'];

        $database->breweryparty($bre, $wid, $session->uid);
        }
    }
}
?>
<!DOCTYPE html >

<?php include("application/views/html.php");?>
<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE  village2  perspectiveBuildings <?php echo DIRECTION; ?> season- buildingsV3">
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
                    <div id="content" class="village2">
                     <div   class="villageMapWrapper">



            <?php include("application/views/dorf2.php");

            ?>

                     </div>
                        <?php
                        if ($building->NewBuilding) {
                            include("application/views/Building.php");
                        }
                        ?>
                        <div class="clear"></div>
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
    </div>
    <div id="ce"></div>
</div>
</body>
</html>