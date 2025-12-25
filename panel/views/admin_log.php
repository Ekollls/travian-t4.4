<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

	<head>



  <link REL="shortcut icon" HREF="favicon.ico"/>



	<title><?php if($_SESSION['access'] == ADMIN){ echo 'Admin Control Panel - TravianX'; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'Multihunter Control Panel - TravianX'; } ?></title>



	<link rel=stylesheet type="text/css" href="../img/Admin/admin.css">



	<link rel=stylesheet type="text/css" href="../img/Admin/acp.css">





	<meta http-equiv="content-type" content="text/html; charset=UTF-8">



	<meta http-equiv="imagetoolbar" content="no">



</head>

<?php

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!"); ?>



<?php

        $type=1;

        $id=$session->uid;

		$no = count($database->getPalevo($type,0,$id));

        $log = $database->getPalevo($type,0,$id);

		for($i=0;$i<$no;$i++) {

			$dataarray = explode(",",$log[$i]['infa']);

		$admid = $log[$i]['uid'];





		?>
<!--


		-----------------------------------<br>

<!--		<b>Log ID:</b> <?php echo $log[$i]['id']; ?><br />

		<b>Admin:</b> <?php $user = $database->getUserField($admid,"username",0);

       { echo '<a href="index.php?p=player&uid='.$admid.'">'.$user.'</a>'; }

			?><br />

		<b>Log:</b> <?php echo $dataarray[0]; ?><br />

		<b>Date:</b> <?php echo date("d.m.Y H:i:s",$dataarray[1]+3600*2); ?><br />

-->




	<?php  }  ?>