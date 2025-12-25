<?php

include("../application/Account.php");
if($session->access != 9){
	header('Location: ../dorf1.php'); die();
}else{
	$_SESSION['access'] = 9;
	include("../application/panel/database.php");

	class timeFormatGenerator{
		public function getTimeFormat($time){
			$min = 0;
			$hr = 0;
			$days = 0;
			while ($time >= 60): $time -= 60; $min += 1; endwhile;
			while ($min  >= 60): $min  -= 60; $hr  += 1; endwhile;
			while ($hr   >= 24): $hr   -= 24; $days +=1; endwhile;
			if ($min < 10){
				$min = "0".$min;
			}
			if($time < 10){
				$time = "0".$time;
			}
			return $days ." day ".$hr."h ".$min."m ".$time."s";
		}

	}

	$timeformat = new timeFormatGenerator;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<link REL="shortcut icon" HREF="../favicon.ico"/>
		<title>Admin Panel</title>
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min-<?php echo DIRECTION; ?>.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style-<?php echo DIRECTION; ?>.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="js/jquery.min.js"></script>
		<script language="javascript">
			function aktiv() {this.srcElement.className='fl1'; }
			function inaktiv() {event.srcElement.className='fl2'; }
			function del(e,id){
			if(e == 'did'){ var conf = confirm('Dou you really want delete village id '+id+'?'); }
			if(e == 'unban'){ var conf = confirm('Dou you really want unban player '+id+'?'); }
			if(e == 'stopDel'){ var conf = confirm('Dou you really want stop deleting user '+id+'?'); }
			if(conf){return true;}else{return false;}
			}
		</script>
		<script type="text/javascript">
			function showStuff(id) {
				document.getElementById(id).style.display = 'block';
			}
			function hideStuff(id) {
				document.getElementById(id).style.display = 'none';
			}
		</script>
		<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

		
	</head>
	
	<body>
	<?php 
		require_once('navbar.php'); 
	?>
		<div id="content" class="p-4 p-md-5 pt-5">
			<?php
									if($_POST or $_GET){
										if($_GET['p'] and $_GET['p']!="search"){
											$filename = 'views/'.$_GET['p'].'.php';
											if(file_exists($filename)){
												include($filename);
											}else{
												include('views/404.php');
											}
										}else{
											include('views/search.php');
										}
										if($_POST['p'] and $_POST['s']){
											$filename = 'views/results_'.$_POST['p'].'.php';
											if(file_exists($filename)){
												include($filename);
											}else{
												include('views/404.php');
											}
										}
									}else{
										include('views/home.php');
									}
									?>
				</div>
			</div>
			</div>
			</div>
			<script src="js/popper.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/main.js"></script>

	</body>
</html>

<?php } ?>