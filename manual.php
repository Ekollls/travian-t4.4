<?php

include("application/Account.php");
include("application/Data/unitdata.php");
include("application/Data/buidata.php");
include("application/Manual.php");


if(isset($_GET['typ']) && isset($_GET['gid'])){
    header('Location: manual.php?typ='.$_GET['typ'].'&s='.$_GET['gid'].'');
}
?>



<?php include("application/views/html.php");?>
<body class="manual ar-AE buildingsV1">
<?php if(!isset($_GET['typ']) && !isset($_GET['s'])){ ?>
<div id="troops">
	<h3>
        <img src="img/x.gif" class="unit uunits"> <?php echo $lang['Manual']['Units']; ?></h3>
	<div class="contentNavi tabNavi ">
		<div title="" class="container category1 active">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a id="buttonN1" onclick="showTroops(1)"" class="tabItem"><?php echo TRIBE1;  ?></a></div>
		    </div><div title="" class="container category2 normal">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a id="buttonC2" onclick="showTroops(2)"" class="tabItem"><?php echo TRIBE2;  ?></a></div>
		</div><div title="" class="container category3 normal">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a id="buttonQ3" onclick="showTroops(3)"" class="tabItem"><?php echo TRIBE3;  ?></a></div>
                            
		</div><div title="" class="container category6 normal">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a id="buttonc4" onclick="showTroops(6)"" class="tabItem"><?php echo TRIBE6;  ?></a></div>
		</div><div title="" class="container category7 normal">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a id="buttonh5" onclick="showTroops(7)"" class="tabItem"><?php echo TRIBE7;  ?></a></div>
		</div>		<div class="clear"></div>
	</div>
	<ul class="troops1"><?php for($i=1;$i<=10;$i++){ echo '<li><img src="img/x.gif" class="unit u'.$i.'"><a href="manual.php?typ=1&amp;s='.$i.'">'.constant('U'.$i).'</a></li>'; }?></ul>
    <ul class="troops2 hide"><?php for($i=11;$i<=20;$i++){ echo '<li><img src="img/x.gif" class="unit u'.$i.'"><a href="manual.php?typ=1&amp;s='.$i.'">'.constant('U'.$i).'</a></li>'; }?></ul>
    <ul class="troops3 hide"><?php for($i=21;$i<=30;$i++){ echo '<li><img src="img/x.gif" class="unit u'.$i.'"><a href="manual.php?typ=1&amp;s='.$i.'">'.constant('U'.$i).'</a></li>'; }?></ul>
    <ul class="troops6 hide">
    <?php for($i=51;$i<=60;$i++){
        echo '<li><img src="img/x.gif" class="unit u'.$i.'"><a href="manual.php?typ=1&amp;s='.$i.'">'.constant('U'.$i).'</a></li>';
    }
    ?>
    </ul>
    <ul class="troops7 hide">
    <?php for($i=61;$i<=70;$i++){
        echo '<li><img src="img/x.gif" class="unit u'.$i.'"><a href="manual.php?typ=1&amp;s='.$i.'">'.constant('U'.$i).'</a></li>';
    }
    ?>
    </ul></div>

<div id="buildings">
	<h3><img src="img/x.gif" class="gebIcon"> <?php echo $lang['Manual']['Building']; ?></h3>

	<div class="contentNavi tabNavi ">


		<div title="" class="container category1 active">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a id="buttonu6" onclick="showBuildings(1)"" class="tabItem"><?php echo $lang['Manual']['Building1']; ?></a></div>
		</div><div title="" class="container category2 normal">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a id="buttons7" onclick="showBuildings(2)"" class="tabItem"><?php echo $lang['Manual']['Building2']; ?></a></div>
		</div><div title="" class="container category3 normal">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content"><a id="buttonv8" onclick="showBuildings(3)"" class="tabItem"><?php echo $lang['Manual']['Building3']; ?></a></div>
		</div>	</div>

	<div class="clear"></div>

	<ul class="buildings1"><li>
            <img src="img/x.gif" class="gebIcon g10Icon">
            <a href="manual.php?typ=4&amp;s=10"><?php echo $lang['buildings'][10]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g11Icon">
            <a href="manual.php?typ=4&amp;s=11"><?php echo $lang['buildings'][11]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g15Icon">
            <a href="manual.php?typ=4&amp;s=15"><?php echo $lang['buildings'][15]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g17Icon">
            <a href="manual.php?typ=4&amp;s=17"><?php echo $lang['buildings'][17]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g18Icon">
            <a href="manual.php?typ=4&amp;s=18"><?php echo $lang['buildings'][18]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g23Icon">
            <a href="manual.php?typ=4&amp;s=23"><?php echo $lang['buildings'][23]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g24Icon">
            <a href="manual.php?typ=4&amp;s=24"><?php echo $lang['buildings'][24]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g25Icon">
            <a href="manual.php?typ=4&amp;s=25"><?php echo $lang['buildings'][25]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g26Icon">
            <a href="manual.php?typ=4&amp;s=26"><?php echo $lang['buildings'][26]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g27Icon">
            <a href="manual.php?typ=4&amp;s=27"><?php echo $lang['buildings'][27]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g28Icon">
            <a href="manual.php?typ=4&amp;s=28"><?php echo $lang['buildings'][28]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g34Icon">
            <a href="manual.php?typ=4&amp;s=34"><?php echo $lang['buildings'][34]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g35Icon">
            <a href="manual.php?typ=4&amp;s=35"><?php echo $lang['buildings'][35]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g38Icon">
            <a href="manual.php?typ=4&amp;s=38"><?php echo $lang['buildings'][38]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g39Icon">
            <a href="manual.php?typ=4&amp;s=39"><?php echo $lang['buildings'][39]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g40Icon">
            <a href="manual.php?typ=4&amp;s=40"><?php echo $lang['buildings'][40]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g41Icon">
            <a href="manual.php?typ=4&amp;s=41"><?php echo $lang['buildings'][41]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g44Icon">
            <a href="manual.php?typ=4&amp;s=44"><?php echo $lang['buildings'][44]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g45Icon">
            <a href="manual.php?typ=4&amp;s=45"><?php echo $lang['buildings'][45]; ?></a></li>
        <li></li></ul><ul class="buildings2 hide"><li>
            <img src="img/x.gif" class="gebIcon g13Icon">
            <a href="manual.php?typ=4&amp;s=13"><?php echo $lang['buildings'][12]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g14Icon">
            <a href="manual.php?typ=4&amp;s=14"><?php echo $lang['buildings'][14]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g16Icon">
            <a href="manual.php?typ=4&amp;s=16"><?php echo $lang['buildings'][16]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g19Icon">
            <a href="manual.php?typ=4&amp;s=19"><?php echo $lang['buildings'][19]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g20Icon">
            <a href="manual.php?typ=4&amp;s=20"><?php echo $lang['buildings'][20]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g21Icon">
            <a href="manual.php?typ=4&amp;s=21"><?php echo $lang['buildings'][21]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g22Icon">
            <a href="manual.php?typ=4&amp;s=22"><?php echo $lang['buildings'][22]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g29Icon">
            <a href="manual.php?typ=4&amp;s=29"><?php echo $lang['buildings'][29]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g30Icon">
            <a href="manual.php?typ=4&amp;s=30"><?php echo $lang['buildings'][30]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g31Icon">
            <a href="manual.php?typ=4&amp;s=31"><?php echo $lang['buildings'][31]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g32Icon">
            <a href="manual.php?typ=4&amp;s=32"><?php echo $lang['buildings'][32]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g33Icon">
            <a href="manual.php?typ=4&amp;s=33"><?php echo $lang['buildings'][33]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g42Icon">
            <a href="manual.php?typ=4&amp;s=42"><?php echo $lang['buildings'][42]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g43Icon">
            <a href="manual.php?typ=4&amp;s=43"><?php echo $lang['buildings'][43]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g36Icon">
            <a href="manual.php?typ=4&amp;s=36"><?php echo $lang['buildings'][36]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g37Icon">
            <a href="manual.php?typ=4&amp;s=37"><?php echo $lang['buildings'][37]; ?></a></li>
        <li></li></ul><ul class="buildings3 hide"><li>
            <img src="img/x.gif" class="gebIcon g1Icon">
            <a href="manual.php?typ=4&amp;s=1"><?php echo $lang['buildings'][1]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g2Icon">
            <a href="manual.php?typ=4&amp;s=2"><?php echo $lang['buildings'][2]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g3Icon">
            <a href="manual.php?typ=4&amp;s=3"><?php echo $lang['buildings'][3]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g4Icon">
            <a href="manual.php?typ=4&amp;s=4"><?php echo $lang['buildings'][4]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g5Icon">
            <a href="manual.php?typ=4&amp;s=5"><?php echo $lang['buildings'][5]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g6Icon">
            <a href="manual.php?typ=4&amp;s=6"><?php echo $lang['buildings'][6]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g7Icon">
            <a href="manual.php?typ=4&amp;s=7"><?php echo $lang['buildings'][7]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g8Icon">
            <a href="manual.php?typ=4&amp;s=8"><?php echo $lang['buildings'][8]; ?></a></li>
        <li></li><li>
            <img src="img/x.gif" class="gebIcon g9Icon">
            <a href="manual.php?typ=4&amp;s=9"><?php echo $lang['buildings'][9]; ?></a></li>
        <li></li></ul></div>
<script type="text/javascript">
	jQuery('#troops .troops1').removeClass('hide');
	jQuery('#buildings .buildings1').removeClass('hide');

	function resetContent(menu) {
		jQuery('#' + menu + ' ul').addClass('hide');

		jQuery('#' + menu + ' .container').removeClass('active');
		jQuery('#' + menu + ' .container').addClass('normal');
	}

	function showTroops(vid) {
		resetContent('troops');
        jQuery('#troops .troops' + vid).removeClass('hide');
        // iRedux - Fixed
		jQuery('#troops .contentNavi .category' + vid).removeClass('normal');
		jQuery('#troops .contentNavi .category' + vid).addClass('active');
	}

	function showBuildings(category) {
		resetContent('buildings');
		jQuery('#buildings .buildings' + category).removeClass('hide');
		jQuery('#buildings .contentNavi .category' + category).removeClass('normal');
		jQuery('#buildings .contentNavi .category' + category).addClass('active');
	}
</script>
<?php }else{ ?>
    <?php if($_GET['typ'] == 1){ ?>
        <?php include_once("application/views/Manual/Troop.php") ?>
    <?php }else{ 
        if($_GET['s'] == 13){
            header('Location: manual.php?typ=4&s=12');
        }
        if($_GET['s'] > 45){
            header('Location: manual.php');  exit();
        }
        ?>
        <?php include_once("application/views/Manual/Building.php") ?>
    <?php } ?>
    <div class="answers">
        <a class="a arrow" href="https://t4answers.arabictra.com//copyable/public/index.php?aid=152#go2answer"
           target="_blank" title="<?php echo $lang['Manual']['TAnswers']; ?>"><?php echo $lang['Manual']['Answers']; ?></a>
    </div>
<?php } ?>
<div id="anwersQuestionMark">
	<a href="https://t4answers.arabictra.com/?lang=ae&amp;/copyable/public/index.php?aid=268#go2answer" target="_blank" title="">
		&nbsp;</a>
</div><div style="position: absolute; top: 0px; left: 0px; display: none; z-index: 10000;"><div class="tip"><div class="tip-container"><div class="tl"></div><div class="tr"></div><div class="tc"></div><div class="ml"></div><div class="mr"></div><div class="mc"></div><div class="bl"></div><div class="br"></div><div class="bc"></div><div class="tip-contents"><div class="title elementTitle"></div><div class="text elementText"></div></div></div></div></div></body>