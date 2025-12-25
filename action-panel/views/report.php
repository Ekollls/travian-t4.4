<?php

$sql = "SELECT * FROM ndata WHERE id = ".$_GET['bid']."";


$rep = $database->queryFetch($sql);

if($rep)

{

	$att = $database->getUserArray($rep['uid'],1);

	?>

	<h1>From is not finished</h1>

	<div id="content" class="reports" style="padding: 0;">

	<?php

		//include("report/0.php");

	?>

	</div>

	<?php

}

else

{

	echo "Report ID ".$_GET['bid']." doesn't exist!";

}

?>