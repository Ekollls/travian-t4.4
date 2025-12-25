<?php
include("application/Account.php");

if($_POST){
    if($_POST['Random'] == "random"){
        $_POST['HeroFace'] = rand(0,4);
        $_POST['color'] = rand(0,4);
        $_POST['HeroHair'] = rand(0,5);
        $_POST['HeroEar'] = rand(0,4);
        $_POST['HeroEyebrow'] = rand(0,4);
        $_POST['HeroEye'] = rand(0,4);
        $_POST['HeroNose'] = rand(0,4);
        $_POST['HeroMouth'] = rand(0,3);
        $_POST['HeroBeard'] = rand(0,5);
    }
//print_r($_POST);die;
    $database->editTableField('heroface', 'gender', $_POST['HeroGender'], 'uid', $session->uid);
    $database->editEbaloHero($session->uid,$_POST['HeroBeard'],$_POST['HeroEar'],$_POST['HeroEye'],$_POST['HeroEyebrow'],$_POST['HeroFace'],$_POST['HeroHair'],$_POST['HeroMouth'],$_POST['HeroNose'],$_POST['color']);
    header("Location: hero.php");
}
?>


<?php include("application/views/html.php");?>
<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE hero <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> buildingsV1">
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
<div id="content" class="hero_editor"><h1 class="titleInHeader"><?php echo U0; ?></h1>

<div class="contentNavi subNavi">
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_inventory.php" class="tabItem"><?=herohero0?></a></div>
				</div>
				<div class="container active">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero.php" class="tabItem"><?=herohero1?></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_adventure.php" class="tabItem"><?=herohero2?></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php" class="tabItem"><?=herohero3?></a></div>
				</div><div class="clear"></div>
		</div><script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});

				</script>
<?php
$herodetail = $session->heroD;
$gender=$herodetail['gender'];
if($herodetail['color']==0){
	$color = "black";
}
if($herodetail['color']==1){
	$color = "brown";
}
if($herodetail['color']==2){
	$color = "darkbrown";
}
if($herodetail['color']==3){
	$color = "yellow";
}
if($herodetail['color']==4){
	$color = "red";
}
if($herodetail['gender']==0) {$gstr='male';} else {$gstr='female';}
$gender=$herodetail['gender'];
$geteye = $herodetail['eye'];if ($gender==0) $geteye%=5;
$geteyebrow = $herodetail['eyebrow'];if ($gender==0) $geteyebrow%=5;
$getnose = $herodetail['nose'];if ($gender==0) $getnose%=5;
$getear = $herodetail['ear'];if ($gender==0) $getear%=5;
$getmouth = $herodetail['mouth'];if ($gender==0) $getmouth%=4;
$getbeard = $herodetail['beard']; if ($gender==1) $getbeard=5;
$gethair = $herodetail['hair'];if ($gender==0) $gethair%=5;
$getface = $herodetail['face'];if ($gender==0) $getface%=5;
?>
<div id="heroEditor" class="genderSwitch <?php echo $gstr; ?>">
<div class="hero_head head">
    <div class="tl"><div class="tr"></div></div>
    <div class="bl"><div class="br"></div></div>
    <div class="image">
        <img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/face0.png" alt="" />
        <img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/eye/eye<?php echo $geteye; ?>.png" alt="" />
        <img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/eyebrow/eyebrow<?php echo $geteyebrow.(($gender==0)?'-'.$color:''); ?>.png" alt="" />
        <?php if(!($gender==0 && $gethair==5)){ ?><img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/hair/hair<?php echo $gethair.'-'.$color; ?>.png" alt="" /><?php } ?>
        <img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/face/face<?php echo $getface; ?>.png" alt="" />
        <img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/mouth/mouth<?php echo $getmouth; ?>.png" alt="" />
        <img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/nose/nose<?php echo $getnose; ?>.png" alt="" />
        <img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/ear/ear<?php echo $getear; ?>.png" alt="" />
        <?php if($getbeard!=5){ ?><img style="width:254px; height:330px; position:absolute;left:0px;top:0px;" src="img/hero/<?php echo $gstr; ?>/head/254x330/beard/beard<?php echo $getbeard.'-'.$color; ?>.png" alt="" /><?php } ?>
    </div>
</div>
<div class="attributes">
<div class="boxes boxesColor gender gray">
    <div class="boxes-tl"></div>
    <div class="boxes-tr"></div>
    <div class="boxes-tc"></div>
    <div class="boxes-ml"></div>
    <div class="boxes-mr"></div>
    <div class="boxes-mc"></div>
    <div class="boxes-bl"></div>
    <div class="boxes-br"></div>
    <div class="boxes-bc"></div>
    <div class="boxes-contents cf">
        <div class="gender-container cf">
            <div class="info">
                <div class="headline">
                    <div class="title"><?php echo GENDER;?></div>
                </div>
                <div id="genderButtons">
                    <button <?php if($herodetail['gender']==0){ echo "class=\"icon iconActive disabled\"";} else { echo "class='icon' onclick=\"$('HeroEditorForm').HeroGender.value='0'; $('HeroEditorForm').submit(); return false;\" ";}?> id="heroEditorActivateMale" value="heroEditorActivateMale" type="button">
                        <img alt="heroEditorActivateMale" class="heroEditorActivateMale" src="img/x.gif">
                    </button>
                    <button <?php if($herodetail['gender']==1){ echo "class=\"icon iconActive disabled\"";} else { echo "class='icon' onclick=\"$('HeroEditorForm').HeroGender.value='1'; $('HeroEditorForm').submit(); return false;\" ";}?> id="heroEditorActivateFemale" value="heroEditorActivateFemale" type="button">
                        <img alt="heroEditorActivateFemale" class="heroEditorActivateFemale" src="img/x.gif">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="boxes boxesColor gray">
    <div class="boxes-tl"></div>
    <div class="boxes-tr"></div>
    <div class="boxes-tc"></div>
    <div class="boxes-ml"></div>
    <div class="boxes-mr"></div>
    <div class="boxes-mc"></div>
    <div class="boxes-bl"></div>
    <div class="boxes-br"></div>
    <div class="boxes-bc"></div>
    <div class="boxes-contents cf">
        <div class="container cf" id="attributesContainer">
            <div class="info" id="headProfile">
                <div class="headline switchClosed">
                    <a href="#" class="title"><?php echo JR_HEROHEAD; ?></a>
                    <div class="clear"></div>
                </div>
                <div class="details">
                    <img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face0.png" alt=""/>
                    <img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face1.png" alt=""/>
                    <img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face2.png" alt=""/>
                    <img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face3.png" alt=""/>
                    <img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face4.png" alt=""/>
                    <?php if ($herodetail['gender']==1) {?>
                        <img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroFace.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/face/face5.png" alt=""/>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="info" id="hairColor">
                <div class="headline switchClosed">
                    <a href="#" class="title"><?php echo JR_HEROHAIRCOLOR; ?></a>
                    <div class="clear"></div>
                </div>
                <div class="details">
                    <img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").color.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/color0.png" alt=""/>
                    <img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").color.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/color1.png" alt=""/>
                    <img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").color.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/color2.png" alt=""/>
                    <img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").color.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/color3.png" alt=""/>
                    <img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").color.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/color4.png" alt=""/>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="info" id="hairStyle">
                <div class="headline switchClosed">
                    <a href="#" class="title"><?php echo JR_HEROHAIRSTYLE; ?></a>
                    <div class="clear"></div>
                </div>
                <div class="details">
                    <img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair0.png" alt=""/>
                    <img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair1.png" alt=""/>
                    <img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair2.png" alt=""/>
                    <img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair3.png" alt=""/>
                    <img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair4.png" alt=""/>
                    <?php if($herodetail['gender']==0) {?>
                        <img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hairNone.png" alt=""/>
                    <?php }?>
                    <?php if ($herodetail['gender']==1) {?>
                        <img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroHair.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/hair/hair5.png" alt=""/>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="info" id="ears">
                <div class="headline switchClosed">
                    <a href="#" class="title"><?php echo JR_HEROEARS; ?></a>
                    <div class="clear"></div>
                </div>
                <div class="details">
                    <img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear0.png" alt=""/>
                    <img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear1.png" alt=""/>
                    <img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear2.png" alt=""/>
                    <img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear3.png" alt=""/>
                    <img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear4.png" alt=""/>
                    <?php  if ($herodetail['gender']==1) {?>
                        <img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear5.png" alt=""/>
                        <img id="attribute_button_6" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="6";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear6.png" alt=""/>
                        <img id="attribute_button_7" class="attribute" onclick='$("HeroEditorForm").HeroEar.value="7";' src="img/hero/<?php echo $gstr; ?>/thumb/head/ear/ear7.png" alt=""/>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="info" id="eyebrow">
                <div class="headline switchClosed">
                    <a href="#" class="title"><?php echo JR_HEROEYEBROWS; ?></a>
                    <div class="clear"></div>
                </div>
                <div class="details">
                    <img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow0.png" alt=""/>
                    <img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow1.png" alt=""/>
                    <img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow2.png" alt=""/>
                    <img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow3.png" alt=""/>
                    <img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow4.png" alt=""/>
                    <?php
                    if ($herodetail['gender']==1) {?>
                        <img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow5.png" alt=""/>
                        <img id="attribute_button_6" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="6";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow6.png" alt=""/>
                        <img id="attribute_button_7" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="7";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow7.png" alt=""/>
                        <img id="attribute_button_8" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="8";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow8.png" alt=""/>
                        <img id="attribute_button_9" class="attribute" onclick='$("HeroEditorForm").HeroEyebrow.value="9";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eyebrow/eyebrow9.png" alt=""/>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="info" id="eyes">
                <div class="headline switchClosed">
                    <a href="#" class="title"><?php echo JR_HEROEYES; ?></a>
                    <div class="clear"></div>
                </div>
                <div class="details">
                    <img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye0.png" alt=""/>
                    <img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye1.png" alt=""/>
                    <img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye2.png" alt=""/>
                    <img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye3.png" alt=""/>
                    <img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye4.png" alt=""/>
                    <?php if ($herodetail['gender']==1) {?>
                        <img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye5.png" alt=""/>
                        <img id="attribute_button_6" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="6";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye6.png" alt=""/>
                        <img id="attribute_button_7" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="7";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye7.png" alt=""/>
                        <img id="attribute_button_8" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="8";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye8.png" alt=""/>
                        <img id="attribute_button_9" class="attribute" onclick='$("HeroEditorForm").HeroEye.value="9";' src="img/hero/<?php echo $gstr; ?>/thumb/head/eye/eye9.png" alt=""/>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="info" id="nose">
                <div class="headline switchClosed">
                    <a href="#" class="title"><?php echo JR_HERONOSE; ?></a>
                    <div class="clear"></div>
                </div>
                <div class="details">
                    <img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose0.png" alt=""/>
                    <img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose1.png" alt=""/>
                    <img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose2.png" alt=""/>
                    <img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose3.png" alt=""/>
                    <img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose4.png" alt=""/>
                    <?php if ($herodetail['gender']==1) {?>
                        <img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose5.png" alt=""/>
                        <img id="attribute_button_6" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="6";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose6.png" alt=""/>
                        <img id="attribute_button_7" class="attribute" onclick='$("HeroEditorForm").HeroNose.value="7";' src="img/hero/<?php echo $gstr; ?>/thumb/head/nose/nose7.png" alt=""/>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="info" id="mouth">
                <div class="headline switchClosed">
                    <a href="#" class="title"><?php echo JR_HEROMOUTH; ?></a>
                    <div class="clear"></div>
                </div>
                <div class="details">
                    <img id="attribute_button_0" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth0.png" alt=""/>
                    <img id="attribute_button_1" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth1.png" alt=""/>
                    <img id="attribute_button_2" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth2.png" alt=""/>
                    <img id="attribute_button_3" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth3.png" alt=""/>
                    <?php if ($herodetail['gender']==1) {?>
                        <img id="attribute_button_4" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth4.png" alt=""/>
                        <img id="attribute_button_5" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth5.png" alt=""/>
                        <img id="attribute_button_6" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="6";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth6.png" alt=""/>
                        <img id="attribute_button_7" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="7";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth7.png" alt=""/>
                        <img id="attribute_button_8" class="attribute" onclick='$("HeroEditorForm").HeroMouth.value="8";' src="img/hero/<?php echo $gstr; ?>/thumb/head/mouth/mouth8.png" alt=""/>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>
            <?php if($herodetail['gender']==0) { ?>

                <div class="info" id="beard">
                    <div class="headline switchClosed">
                        <a href="#" class="title"><?php echo JR_HEROBEARD; ?></a>
                        <div class="clear"></div>
                    </div>
                    <div class="details">
                        <img id="attribute_button_5000" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="0";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beard0.png" alt=""/>
                        <img id="attribute_button_5001" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="1";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beard1.png" alt=""/>
                        <img id="attribute_button_5002" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="2";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beard2.png" alt=""/>
                        <img id="attribute_button_5003" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="3";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beard3.png" alt=""/>
                        <img id="attribute_button_5004" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="4";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beard4.png" alt=""/>
                        <img id="attribute_button_5999" class="attribute" onclick='$("HeroEditorForm").HeroBeard.value="5";' src="img/hero/<?php echo $gstr; ?>/thumb/head/beard/beardNone.png" alt=""/>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


<div class="options">
    <form id="HeroEditorForm" method="post" action="hero.php">
        <button type="button" value="" name="" id="btn_login" style="float:right;" class="green " onclick="$('HeroEditorForm').Random.value='random'; $('HeroEditorForm').submit(); return false;">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=herohero6?></div></div>
        </button>
        
        <button type="submit" value="save" name="save" id="btn_login" style="float:left;" class="green ">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?php echo JR_SAVE; ?></div></div>
        </button>
        <input type="hidden" name="uid" value="<?php echo $session->uid; ?>" />
        <input type="hidden" name="HeroFace" value="<?php echo $herodetail['face']; ?>" />
        <input type="hidden" name="color" value="<?php echo $herodetail['color']; ?>" />
        <input type="hidden" name="HeroHair" value="<?php echo $herodetail['hair']; ?>" />
        <input type="hidden" name="HeroEar" value="<?php echo $herodetail['ear']; ?>" />
        <input type="hidden" name="HeroEyebrow" value="<?php echo $herodetail['eyebrow']; ?>" />
        <input type="hidden" name="HeroEye" value="<?php echo $herodetail['eye']; ?>" />
        <input type="hidden" name="HeroNose" value="<?php echo $herodetail['nose']; ?>" />
        <input type="hidden" name="HeroMouth" value="<?php echo $herodetail['mouth']; ?>" />
        <input type="hidden" name="HeroBeard" value="<?php echo $herodetail['beard']; ?>" />
        <input type="hidden" name="HeroGender" value="<?php echo $herodetail['gender']; ?>" />
        <input type="hidden" name="Random" value="" />
    </form>
</div>

</div>
<div class="clear"></div>
</div>
<script type="text/javascript">
    new Travian.Game.Hero.Editor(
        {
            element: 'heroEditor',
            command: 'heroEditor',
           // urlHeroImage: 'hero_image.php?uid=<?php //echo $session->uid; ?>&amp;size=sideinfo&amp;{time}',
            attributes: {"headProfile":<?php echo $herodetail['face']; ?>,"hairColor":<?php echo $herodetail['color']; ?>,"hairStyle":<?php echo $herodetail['hair']; ?>,"ears":<?php echo $herodetail['ear']; ?>,"eyebrow":<?php echo $herodetail['eyebrow']; ?>,"eyes":<?php echo $herodetail['eye']; ?>,"nose":<?php echo $herodetail['nose']; ?>,"mouth":<?php echo $herodetail['mouth']; ?>,"beard":<?php echo $herodetail['beard']; ?>,"gender":"<?php echo $gstr; ?>"},
            elementHeroImage: 'heroImage'
        });
</script>



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