<?php
include_once "application/Account.php";

if(isset($_GET['id']) && !is_numeric($_GET['id'])) die('Hacking Attemp');
if(isset($_GET['vill']) && !is_numeric($_GET['vill'])) die('Hacking Attemp');
if(isset($_GET['t']) && !is_numeric($_GET['t'])) die('Hacking Attemp');
if(isset($_GET['s']) && !is_numeric($_GET['s'])) die('Hacking Attemp');
if(isset($_GET['id'])){$id=$_GET['id']=$database->filterIntValue($database->filterVar($_GET['id']));}

if(isset($_POST["del_x"])  && $session->right['s6']) {

    for($i = 1; $i <= 10; $i++) {
        if(isset($_POST['n' . $i]) && is_numeric($_POST['n'.$i])) {
            $database->removeNotice($_POST['n' . $i]);
        }
    }
}

if(isset($_POST['realAll'])){
    for($i = 1; $i <= 10; $i++) {
        if(isset($_POST['n' . $i]) && is_numeric($_POST['n'.$i])) {
            $database->readNotice($_POST['n' . $i]);
        }
    }

    header("Location: berichte.php".($_POST['page'] ? '?s='.$_POST['page'].'' : '')."");
}

if(isset($_GET['t']) && ($_GET['t']>4 || $_GET['t']<1)){ unset($_GET['t']); }

// op op op
?>


<?php include("application/views/html.php");?>

<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE reports <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> season- buildingsV1">
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
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a></div>
                <div class="contentContainer">
                    <div id="content" class="reports">
                <h1 class="titleInHeader"><?=XUYXUYXUY?></h1>
                <div class="contentNavi subNavi">
                    <div title="" class="container <?php if (!isset($_GET['t'])) { echo "active"; }else{ echo "normal"; } ?>">
                        <div class="background-start">&nbsp;</div>
                        <div class="background-end">&nbsp;</div>
                        <div class="content"><a href="berichte.php" class="tabItem"><?=ot4m0?></a></div>
                    </div>
                    <div title="" class="container <?php if (isset($_GET['t']) && $_GET['t'] == 3) { echo "active"; }else{ echo "normal"; } ?>">
                        <div class="background-start">&nbsp;</div>
                        <div class="background-end">&nbsp;</div>
                        <div class="content"><a href="berichte.php?t=3" class="tabItem"><?=ot4m1?></a></div>
                    </div>
                    <div title="" class="container <?php if (isset($_GET['t']) && $_GET['t'] == 1) { echo "active"; }else{ echo "normal"; } ?>">
                        <div class="background-start">&nbsp;</div>
                        <div class="background-end">&nbsp;</div>
                        <div class="content"><a href="berichte.php?t=1" class="tabItem"><?=ot4m2?></a></div>
                    </div>
                    <div title="" class="container <?php if (isset($_GET['t']) && $_GET['t'] == 4) { echo "active"; }else{ echo "normal"; } ?>">
                        <div class="background-start">&nbsp;</div>
                        <div class="background-end">&nbsp;</div>
                        <div class="content"><a href="berichte.php?t=4" class="tabItem"><?=ot4m3?></a></div>
                    </div>
                    <div title="" class="container <?php if (isset($_GET['t']) && $_GET['t'] == 2) { echo "active"; }else{ echo "normal"; } ?>">
                        <div class="background-start">&nbsp;</div>
                        <div class="background-end">&nbsp;</div>
                        <div class="content"><a href="berichte.php?t=2" class="tabItem"><?=ot4m4?></a></div>

                    </div>
                    <div class="clear"></div>
                </div>
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

 if(isset($id)) {
 $all=$database->getNotice5($id);

		$ally = $all['ally'];
		if($all['uid'] == $session->uid or ($session->alliance==$ally and $ally!=0 and $session->alliance!=0) or $session->access==9){
            $dataarray = explode(",",$all['data']);
            if(!$all['viewed'] && $session->uid==$all['uid'] && !$_SESSION['adminLogin']){
                $database->noticeViewed($all['id']);}
		$type = $all['ntype'];

		switch($type){
case 2: $type=1; break;
case 4: $type=1; break;
case 5: $type=1; break;
case 6: $type =1; break;
case 7: $type =1; break;
case 11: $type =10; break;
case 12: $type =10; break;
case 13: $type =10; break;
case 14: $type =10; break;
case 16: $type =18; break;
case 17: $type =3; break;
case 18: $type =18; break;
case 19: $type =18; break;
case 20: $type =30; break;
case 21: $type =9; break;
case 25:$type =15; break;
case 26:$type =15;break;
case 27:$type =15;break;


}

		include("application/views/Notice/".$type.".php");

		}
	} else {
		include("application/views/Notice/all.php");
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
        <div id="ce"></div>
    </div>
</body>
</html>