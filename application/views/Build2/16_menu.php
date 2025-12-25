		<div class="contentNavi subNavi ">
				<div class="container <?php if(!isset($_GET['t']) || $_GET['t'] == 0){ echo "active";}else{ echo "normal"; }?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor favorKey0 favorActive"><a href="build.php?id=<?php echo $id; ?>" class="tabItem"><?php echo $lang['Build']['Overview']; ?></a></div>
				</div>

				<div class="container <?php if(isset($_GET['t']) && $_GET['t'] == 1){ echo "active";}else{ echo "normal"; }?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor favorKey1"><a href="build.php?t=1&id=<?php echo $id; ?>" class="tabItem"><?=PY2?></a></div>
				</div>
				<div class="container <?php if(isset($_GET['t']) && $_GET['t'] == 2){ echo "active";}else{ echo "normal"; }?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor favorKey1"><a href="build.php?t=2&id=<?php echo $id; ?>" class="tabItem"><?=PY3?></a></div>
				</div>
				<!--<div class="container <?php if(isset($_GET['t']) && $_GET['t'] == 3){ echo "active";}else{ echo "normal"; }?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor favorKey1"><a href="build.php?t=3&id=<?php echo $id; ?>" class="tabItem"></a></div>
				</div>-->

                <div class="container <?php if($session->goldclub!=1){ echo 'gold '; } if(isset($_GET['t']) && $_GET['t']==99){ echo "active";}else{ echo "normal"; }?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor favorKey99"><a <?php if(!$session->goldclub){ echo 'id="buttonr9NmGApXEAEZH"'; }else{ echo 'href="build.php?id=39&amp;t=99"'; }  ?>  class="tabItem"><?=PY17?></a></div>
				</div>
				
				<?php if($session->goldclub!=1){ ?>
				<script type="text/javascript">
						if ($('buttonr9NmGApXEAEZH')) {
							$('buttonr9NmGApXEAEZH').addEvent('click', function () {
								window.fireEvent('tabClicked', [this, {
									"class": "gold normal",
									"title": "List the farms || For this meze you need a gold club.",
									"target": false,
									"id": "buttonr9NmGApXEAEZH",
									"href": "#",
									"onclick": false,
									"enabled": true,
									"text": "List the Farms",
									"dialog": false,
									"plusDialog": false,
									"goldclubDialog": {
										"featureKey": "raidList",
										"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
									},
									"containerId": "",
									"buttonIdentifier": "buttonr9NmGApXEAEZH"
								}]);

							});
						}
					</script>	
				<?php } ?>			
				<?php $disable = true; if($session->goldclub==1 && !$disable){ ?>
                <div class="container <?php if(isset($_GET['t']) && $_GET['t']==100){ echo "active";}else{ echo "normal"; }?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor favorKey1"><a href="build.php?id=39&amp;t=100" class="tabItem"><?=GOLDC?></a></div>
				</div>
				<?php } ?>
</div>