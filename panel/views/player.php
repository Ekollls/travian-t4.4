<div class="card">
<?php

$id = $_GET['uid'];

if(isset($id))

{

	include("../application/Ranking.php");

	$varmedal = $database->getProfileMedal($id);

	$user = $database->getUserArray($id,1);

	$varray = $database->getProfileVillages($id);

	$refreshicon  = "<img src=\"data:image/png;base64,

	iVBORw0KGgoAAAANSUhEUgAAAAkAAAAKCAIAAADpZ+PpAAAAAXNSR0IArs4c6QAAAARnQU1BAACx

	jwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAEQSURBVChTY/gPBkevHfRrtjMsU9bJ05+5eylE

	kAGI117fKFsqYzhTNeSQY8xhP8vJJmVrK3eeP8Bw58kt03rTkHnRxdvrnKd4m83SCTtsaLZI1K7H

	mGH2xpnHLh+GGPL7/7/S1dVKU2Usd6roTZBh+Pj3M0QCCL78+Fw6v1ooR1myWU2zzpjBb2Ko8xwf

	91l+gRNDLzw6f+nepcsPrl14cPXW8wcMWqVaEYdtPdZYubUHww0AMs5cusygU68UtVUr87CPWbdd

	9Ly83TcO7Lq2I7ozoXfZTAalCjWZemnlaYo2u0wVFkoJdwoyZDOZNDi//vqRwbkjac+dC827p2h3

	Gyh3S6m0a0Qszrnz6RnQWAAxV5tT/VAiNQAAAABJRU5ErkJggg==\">";

	if($user)

	{

		$totalpop = 0;

		foreach($varray as $vil){
			$totalpop += $vil['pop'];
		}

		?>

		<div class="card-header"><?php include('search2.php'); ?></div>
		<div class="card-body">
		<?php


		$deletion = $user['deleting'];

		if($deletion>time())

		{

			include("playerdeletion.php");

		}



		include("playerinfo.php");

		if($_SESSION['access'] == 9){ include("playeradditionalinfo.php");}

		echo "<br />";



		include ("villages.php"); ?>



		<div style="float: left;">

			<?php

				include ('punish.php');

			?>

		</div>

		<div style="float: right;">

			<?php

			if($_SESSION['access'] == ADMIN)

								{	include ('add_village.php'); }

			?>

		</div>





		<?php //include("gold_log.php");

	}

	else

	{

		include("404.php");

	}

}

?>
</div></div>