<div class="Modal playNowModal overlay" id="overlay" role="none" style="display:none">
				<div class="mobileCloseButton" role="none">
					<svg class="modalClose" viewbox="-6 -6 20 20">
					<path d="M2,18.4c6-12.3,14.4-18,14.4-18" transform="scale(.5)"></path>
					<path d="M0.2,2.2C8.8,7,16.1,16.7,16.1,16.7" transform="scale(.5)"></path></svg>
				</div>
				<div id="Login" class="popupBox">
					<div class="box default">
						<div class="boxTitle">
							<svg>
							<defs>
								<filter class="filter" id="blurMe">
									<fegaussianblur in="SourceGraphic" stddeviation="2"></fegaussianblur>
								</filter>
								<lineargradient id="gradient" x1="0" x2="0" y1="0" y2="1">
									<stop offset="0%" style="stop-color: rgb(73, 34, 8);"></stop>
									<stop offset="90%" style="stop-color: rgb(182, 131, 99);"></stop>
									<stop offset="100%" style="stop-color: rgb(182, 131, 99);"></stop>
								</lineargradient>
								<path class="shape" d="M.5 27.6s15.7-6.3 25.7-9c11-3 17-3.5 26.1-3.7 16.2.7 16.9.8 24.7 1 6.1 0 6.6-.6 16.7-.6h13.7s12.8-.8 21.9-2c16.6-2.1 23.8-1 35.3.4 26.2 3.5 39.4 6.5 42.9 7.8.3-3.3.6-5.3.7-7.6.2-3.9.1-4.7.3-13.9C205.5 0 0 .8 0 .8s.3 8.7.3 11.7c0 2.3.4 6.8.5 9.6 0 3.5-.3 5.5-.3 5.5z" fill="inherit" id="shape" style="fill: url(&quot;#gradient&quot;) none;"></path>
								<path class="shapes" d="M.5 27.6s15.7-6.3 25.7-9c11-3 17-3.5 26.1-3.7 16.2.7 16.9.8 24.7 1 6.1 0 6.6-.6 16.7-.6h13.7s12.8-.8 21.9-2c16.6-2.1 23.8-1 35.3.4 26.2 3.5 39.4 6.5 42.9 7.8.3-3.3.6-5.3.7-7.6.2-3.9.1-4.7.3-13.9C205.5 0 0 .8 0 .8s.3 8.7.3 11.7c0 2.3.4 6.8.5 9.6 0 3.5-.3 5.5-.3 5.5z" fill="inherit" id="shape" style="fill: url(&quot;#gradient&quot;) none;"></path>
							</defs><svg>
							<g>
								<svg>
								<use xlink:href="#shape"></use></svg>
								<pattern height="28" id="pattern" patternunits="userSpaceOnUse" preserveaspectratio="xMidYMin slice" viewbox="0 0 209 28" width="28" x="86" y="0">
									<use xlink:href="#shape"></use>
								</pattern>
								<rect height="28" style="fill: url(&quot;#pattern&quot;) none;" width="100%"></rect><svg><svg>
								<use xlink:href="#shape"></use></svg></svg>
							</g></svg></svg>
							<h1><span>Choose server to PLAY!</span></h1>
						</div>
						<div class="content">
							<div class="boxBody">
								<div class="worldSelection shown">
									<div class="transformWrapper">
										<div class="worldGroup">
<?php
$db = mysqli_connect("localhost", "eminf", "indokus12", "s4travian");
$count_users = mysqli_num_rows($db->query("SELECT * FROM `users` WHERE `id` > 4"));
$count_online = mysqli_num_rows($db->query("SELECT * FROM `users` WHERE " . time() . "-`timestamp` < (60*60) AND tribe!=5 AND tribe!=0"));
$t = strtotime('18.01.2021 18:00:00');
if($t > time()){$count_online = 0;}
$timeserver = round((time() - $t) / 86400);
$da = mysqli_fetch_array($db->query("SELECT * FROM `config` WHERE 1"));
$winn = $da['winmoment'];
?>
											<div class="world default" role="none" data-url="http://s4.travianprox.com/login.php">
												<h2>Server &times;X5</h2>
												<p>Total Players: <strong><font color=#00FF00><?php echo $count_users; ?></font></strong> Online Players: <strong><font color=#00FF00><?php echo $count_online; ?></font></strong></p>
												<p class="spacer"></p>
												<div class="serverTime" title="Server age">
													<svg class="clock" viewBox="0 0 74 74"><circle cx="37" cy="37" r="33"></circle><path d="M33.67 13v27.33h26"></path></svg>
													<span><?php if($t <= time()){if($winn == 0){echo $timeserver.' days ago';}else{echo 'Server finished';}}else{echo 'Start '.date("d.m.Y G:i:s", $t);} ?></span>
												</div>
											</div>
<?php
$db = mysqli_connect("localhost", "eminf", "indokus12", "s5travian");
$count_users = mysqli_num_rows($db->query("SELECT * FROM `users` WHERE `id` > 4"));
$count_online = mysqli_num_rows($db->query("SELECT * FROM `users` WHERE " . time() . "-`timestamp` < (60*60) AND tribe!=5 AND tribe!=0"));
$t = strtotime('22.01.2021 18:00:00');
if($t > time()){$count_online = 0;}
$timeserver = round((time() - $t) / 86400);
$da = mysqli_fetch_array($db->query("SELECT * FROM `config` WHERE 1"));
$winn = $da['winmoment'];
?>
											<div class="world default" role="none" data-url="http://s5.travianprox.com/login.php">
												<h2>Server &times;X25</h2>
												<p>Total Players: <strong><font color=#00FF00><?php echo $count_users; ?></font></strong> Online Players: <strong><font color=#00FF00><?php echo $count_online; ?></font></strong></p>
												<p class="spacer"></p>
												<div class="serverTime" title="Server age">
													<svg class="clock" viewBox="0 0 74 74"><circle cx="37" cy="37" r="33"></circle><path d="M33.67 13v27.33h26"></path></svg>
													<span><?php if($t <= time()){if($winn == 0){echo $timeserver.' days ago';}else{echo 'Server finished';}}else{echo 'Start '.date("d.m.Y G:i:s", $t);} ?></span>
												</div>
											</div>
<?php
$db = mysqli_connect("localhost", "eminf", "indokus12", "s1travian");
$count_users = mysqli_num_rows($db->query("SELECT * FROM `users` WHERE `id` > 4"));
$count_online = mysqli_num_rows($db->query("SELECT * FROM `users` WHERE " . time() . "-`timestamp` < (60*60) AND tribe!=5 AND tribe!=0"));
$t = strtotime('03.02.2021 19:00:00');
if($t > time()){$count_online = 0;}
$timeserver = round((time() - $t) / 86400);
$da = mysqli_fetch_array($db->query("SELECT * FROM `config` WHERE 1"));
$winn = $da['winmoment'];
?>
											<div class="world default" role="none" data-url="http://s1.travianprox.com/login.php">
												<h2>Server &times;X10</h2>
												<p>Total Players: <strong><font color=#00FF00><?php echo $count_users; ?></font></strong> Online Players: <strong><font color=#00FF00><?php echo $count_online; ?></font></strong></p>
												<p class="spacer"></p>
												<div class="serverTime" title="Server age">
													<svg class="clock" viewBox="0 0 74 74"><circle cx="37" cy="37" r="33"></circle><path d="M33.67 13v27.33h26"></path></svg>
													<span><?php if($t <= time()){if($winn == 0){echo $timeserver.' days ago';}else{echo 'Server finished';}}else{echo 'Start '.date("d.m.Y G:i:s", $t);} ?></span>
												</div>
											</div>
<?php
$db = mysqli_connect("localhost", "eminf", "indokus12", "s2travian");
$count_users = mysqli_num_rows($db->query("SELECT * FROM `users` WHERE `id` > 4"));
$count_online = mysqli_num_rows($db->query("SELECT * FROM `users` WHERE " . time() . "-`timestamp` < (60*60) AND tribe!=5 AND tribe!=0"));
$t = strtotime('27.01.2021 18:00:00');
if($t > time()){$count_online = 0;}
$timeserver = round((time() - $t) / 86400);
$da = mysqli_fetch_array($db->query("SELECT * FROM `config` WHERE 1"));
$winn = $da['winmoment'];
?>
											<div class="world default" role="none" data-url="http://s2.travianprox.com/login.php">
												<h2>Server &times;X75</h2>
												<p>Total Players: <strong><font color=#00FF00><?php echo $count_users; ?></font></strong> Online Players: <strong><font color=#00FF00><?php echo $count_online; ?></font></strong></p>
												<p class="spacer"></p>
												<div class="serverTime" title="Server age">
													<svg class="clock" viewBox="0 0 74 74"><circle cx="37" cy="37" r="33"></circle><path d="M33.67 13v27.33h26"></path></svg>
													<span><?php if($t <= time()){if($winn == 0){echo $timeserver.' days ago';}else{echo 'Server finished';}}else{echo 'Start '.date("d.m.Y G:i:s", $t);} ?></span>
												</div>
											</div>
<?php
$db = mysqli_connect("localhost", "eminf", "indokus12", "s3travian");
$count_users = mysqli_num_rows($db->query("SELECT * FROM `users` WHERE `id` > 4"));
$count_online = mysqli_num_rows($db->query("SELECT * FROM `users` WHERE " . time() . "-`timestamp` < (60*60) AND tribe!=5 AND tribe!=0"));
$t = strtotime('17.02.2021 18:00:00');
if($t > time()){$count_online = 0;}
$timeserver = round((time() - $t) / 86400);
$da = mysqli_fetch_array($db->query("SELECT * FROM `config` WHERE 1"));
$winn = $da['winmoment'];
?>
											<div class="world default" role="none" data-url="http://s3.travianprox.com/login.php">
												<h2>Server &times;X100</h2>
												<p>Total Players: <strong><font color=#00FF00><?php echo $count_users; ?></font></strong> Online Players: <strong><font color=#00FF00><?php echo $count_online; ?></font></strong></p>
												<p class="spacer"></p>
												<div class="serverTime" title="Server age">
													<svg class="clock" viewBox="0 0 74 74"><circle cx="37" cy="37" r="33"></circle><path d="M33.67 13v27.33h26"></path></svg>
													<span><?php if($t <= time()){if($winn == 0){echo $timeserver.' days ago';}else{echo 'Server finished';}}else{echo 'Start '.date("d.m.Y G:i:s", $t);} ?></span>
												</div>
											</div>
										
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>