<?php

	$cur=$building->isCurrent($id);
    $loop=$building->isLoop($id);
	$loopsame = ($cur || $loop)?1:0;
	$doublebuild = ($cur && $loop)?1:0;
?>
<h1 class="titleInHeader"><?=$lang['buildings'][40]?> <span class="level"> <?=LEVEL?> <?=$village->resarray['f'.$id]?></span></h1>
<div id="build" class="gid40" class="gid40 level<?=$village->resarray['f'.$id]?>">
<div id="descriptionAndInfo">
<div class="build_desc"><?=ww0?></div>								
							
<div id="build" class="gid40">

    </div>


	</div>
    <div class="roundedCornersBox big ">
	<div class="stickyImage">
		<a class="build_logo" onclick="return Travian.Game.iPopup(40, 4);" href="#">
			<img class="build_logo big black g40" alt="<?=$lang['buildings'][40]?>" src="img/x.gif">
		</a>
	</div>

	<h4><?=$lang['buildings'][40]?></h4>

    <form action="build.php?id=99" method="POST">

    <?php
        $wwname = $village->resarray['wwname'];
        if($village->resarray['f'.$id] < 0){
            echo '<br>';
            echo ''.ww1.' <center><br />'.ww2.' <input class="text" type="text" name="wwname" id="wwname" disabled="disabled" value="'.$wwname.'" maxlength="20"></center><p class="btn"><input type="image" value="" tabindex="9" name="s1" disabled="disabled" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>';
        } else if($village->resarray['f'.$id] > 0 and $village->resarray['f'.$id] < 11) {
            echo '<br>';
            echo '<center>'.ww2.' <input class="text" type="text" name="wwname" id="wwname" value="'.$wwname.'" maxlength="20">';
            echo " <button type=\"submit\" value=\"Upgrade level\" class=\"green small\" >
            <div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
            <div class=\"button-background\">
                <div class=\"buttonStart\">
                    <div class=\"buttonEnd\">
                        <div class=\"buttonMiddle\"></div>
                    </div>
                </div>
            </div><div class=\"button-content\">تغيير</div></div></button></center><br/>";
        } else if ($village->resarray['f'.$id] > 10){
            echo '<br><center>';
            echo ''.ww2.'<input class="text" type="text" name="wwname" id="wwname" disabled="disabled" value="'.$wwname.'" maxlength="20"></center>';
            echo '<br>';
        }?>
            </form>
            <?php
            if(isset($_GET['n'])) {
                //echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="Red"><b>'.ww4.'</b></font>';
            }
                ?>

        <?php
        include("wwupgrade.php");
        ?>


</div>

<!--

	<div id="contractSpacer"></div>
	<div id="contract" class="contractWrapper">
			<div class="inlineIconList resourceWrapper">
			<div class="inlineIcon resource"><i class="r1Big"></i><span class="value value">8710</span></div>
			<div class="inlineIcon resource"><i class="r2Big"></i><span class="value value">10890</span></div>
			<div class="inlineIcon resource"><i class="r3Big"></i><span class="value value">7620</span></div>
			<div class="inlineIcon resource"><i class="r4Big"></i><span class="value value">2180</span></div>
			<div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value">2</span></div>
		</div>
	</div>
	
	<div class="culturePointsAndPopulation ">
                <div class="wrapper">
                    <div class="unit">
                        <i class="culturePoints_medium"></i>
                        <span class="value">184</span>
                    <span class="delta">(&#8237;+&#8237;2&#8236;&#8236;)</span>
                    </div>
                    <div class="unit">
                        <i class="population_medium"></i>
                        <span class="value">28</span>
                        <span class="delta">(&#8237;+&#8237;38&#8236;&#8236;)</span>
                    </div>
                </div>
            </div>
<div class="upgradeButtonsContainer section2Enabled">
                <div class="section1">

            <div class="clear"></div>
        
<button type="button" value="Upgrade level" class="green build" onclick="window.location.href = 'dorf2.php?а=20&amp;c=jj7'; return false;">
<div class="button-container addHoverClick" style="margin:1px -3px;">
    <div class="button-background">
        <div class="buttonStart">
            <div class="buttonEnd">
                <div class="buttonMiddle"></div>
            </div>
        </div>
    </div><div class="button-content">Upgrade to level 20 </div></div></button><p></p>
<div class="inlineIcon duration">

<i class="clock_medium"></i>
<span class="value ">00:00:29</span>
</div>  


</div>
</div>
    -->
</div>