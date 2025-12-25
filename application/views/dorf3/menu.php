<?php 
if(!$session->plus){
?>
<div class="contentNavi subNavi ">
	<div title="" class="container active">
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div class="content favor favorActive favorKey0">

			<a id="villageOverViewTab1" href="dorf3.php?s=0" class="tabItem">
			<?=dorf0?> <img src="img/x.gif" class="favorIcon" alt="This tab has been marked as a favorite">
			</a>
		</div>
	</div>

	<script type="text/javascript">
		if ($('villageOverViewTab1')) {
			$('villageOverViewTab1').addEvent('click', function () {
				window.fireEvent('tabClicked', [this, {
					"class": "active",
					"title": false,
					"target": false,
					"id": "villageOverViewTab1",
					"href": "dorf3.php?s=0",
					"onclick": false,
					"enabled": true,
					"text": "<?=dorf0?>",
					"dialog": false,
					"plusDialog": false,
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab1"
				}]);

			});
		}
	</script>
	<div class="container gold normal">
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div class="content favor  favorKey2">

			<a id="villageOverViewTab2" href="#" class="tabItem">
			<?=dorf1?><img src="img/x.gif" class="favorIcon" alt="This tab has been marked as a favorite">
			</a>
		</div>
	</div>

	<script type="text/javascript">
		if ($('villageOverViewTab2')) {
			$('villageOverViewTab2').addEvent('click', function () {
				window.fireEvent('tabClicked', [this, {
					"class": "gold normal",
					"title": "Village Statistics | For this meze, you need a liter in a n Plus",
					"target": false,
					"id": "villageOverViewTab2",
					"href": "#",
					"onclick": false,
					"enabled": true,
					"text": "<?=dorf1?>",
					"dialog": false,
					"plusDialog": {
						"featureKey": "villageStatistics",
						"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
					},
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab2"
				}]);

			});
		}
	</script>

	<div class="container gold normal">
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div class="content favor  favorKey3">

			<a id="villageOverViewTab3" href="#" class="tabItem">
				<?=dorf2?><img src="img/x.gif" class="favorIcon" alt="This tab has been marked as a favorite">
			</a>
		</div>
	</div>

	<script type="text/javascript">
		if ($('villageOverViewTab3')) {
			$('villageOverViewTab3').addEvent('click', function () {
				window.fireEvent('tabClicked', [this, {
					"class": "gold normal",
					"title": "Village Statistics | For this meze, you need a liter in a n Plus",
					"target": false,
					"id": "villageOverViewTab3",
					"href": "#",
					"onclick": false,
					"enabled": true,
					"text": "<?=dorf2?>",
					"dialog": false,
					"plusDialog": {
						"featureKey": "villageStatistics",
						"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
					},
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab3"
				}]);

			});
		}
	</script>

	<div class="container gold normal">
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div class="content favor favorKey4">

			<a id="villageOverViewTab4" href="#" class="tabItem">
			<?=dorf3?><img src="img/x.gif" class="favorIcon" alt="This tab has been marked as a favorite">
			</a>
		</div>
	</div>

	<script type="text/javascript">
		if ($('villageOverViewTab4')) {
			$('villageOverViewTab4').addEvent('click', function () {
				window.fireEvent('tabClicked', [this, {
					"class": "gold normal",
					"title": "Village Statistics | For this meze, you need a liter in a n Plus",
					"target": false,
					"id": "villageOverViewTab4",
					"href": "#",
					"onclick": false,
					"enabled": true,
					"text": "<?=dorf3?>",
					"dialog": false,
					"plusDialog": {
						"featureKey": "villageStatistics",
						"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
					},
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab4"
				}]);

			});
		}
	</script>

	<div class="container gold normal">
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div class="content favor  favorKey5">

			<a id="villageOverViewTab5" href="#" class="tabItem">
			<?=dorf4?> <img src="img/x.gif" class="favorIcon" alt="This tab has been marked as a favorite">
			</a>
		</div>
	</div>

	<script type="text/javascript">
		if ($('villageOverViewTab5')) {
			$('villageOverViewTab5').addEvent('click', function () {
				window.fireEvent('tabClicked', [this, {
					"class": "gold normal",
					"title": "Village statistics | For this feature you need liters in a N Plus",
					"target": false,
					"id": "villageOverViewTab5",
					"href": "#",
					"onclick": false,
					"enabled": true,
					"text": "<?=dorf4?>",
					"dialog": false,
					"plusDialog": {
						"featureKey": "villageStatistics",
						"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
					},
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab5"
				}]);

			});
		}
	</script>

	<div class="clear"></div>
</div>

<?php
}else{
?><div class="contentNavi subNavi ">
    <div class="container <?php if(!isset($_GET['s'])){echo 'active';}else{ echo 'normal';}?>" title="">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorKey0">

            <a class="tabItem" href="<?php if($session->plus){ echo 'dorf3.php';}?>" id="villageOverViewTab1">
                <?=dorf0?> <img class="favorIcon" src="img/x.gif">
            </a>
        </div>
    </div>

    <div class="container  <?php if(!$session->plus){ echo 'gold';}?> <?php if($_GET['s'] == 2){echo 'active';}else{ echo 'normal';}?> ">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorKey2">

            <a class="tabItem" href="<?php if($session->plus){ echo 'dorf3.php?s=2';}?>" id="villageOverViewTab2">
                <?=dorf1?> <img  class="favorIcon" src="img/x.gif">
            </a>
        </div>
    </div>

    <div class="container  <?php if(!$session->plus){ echo 'gold';}?> <?php if($_GET['s'] == 3){echo 'active';}else{ echo 'normal';}?> ">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorKey3">

            <a class="tabItem" href="<?php if($session->plus){ echo 'dorf3.php?s=3';}?>" id="villageOverViewTab3">
                <?=dorf2?> <img  class="favorIcon" src="img/x.gif">
            </a>
        </div>
    </div>

    <div class="container  <?php if(!$session->plus){ echo 'gold';}?> <?php if($_GET['s'] == 4){echo 'active';}else{ echo 'normal';}?> ">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorKey4">

            <a class="tabItem" href="<?php if($session->plus){ echo 'dorf3.php?s=4';}?>" id="villageOverViewTab4">
                <?=dorf3?>											<img  class="favorIcon" src="img/x.gif">
            </a>
        </div>
    </div>


    <div class="container  <?php if(!$session->plus){ echo 'gold';}?> <?php if($_GET['s'] == 5){echo 'active';}else{ echo 'normal';}?> ">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorKey5">

            <a class="tabItem" href="<?php if($session->plus){ echo 'dorf3.php?s=5';}?>" id="villageOverViewTab5">
                <?=dorf4?>											<img  class="favorIcon" src="img/x.gif">
            </a>
        </div>
    </div>

    <div class="clear"></div>
</div>
<?php } ?>