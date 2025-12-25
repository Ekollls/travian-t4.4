<?php

if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\"><?=INS119?></span></div><br>";
}
?>
<form action="process.php" method="post" id="dataform">
<input type="hidden" name="subwdata" value="1">

	<p>
	<span class="f10 c"><?=INS120?></span>
		<table>
			<tr><td><b><?=INS121?></b><?=INS122?></td></tr>
			<tr><td><center><input type="submit" name="Submit" id="Submit" value="Create.."></center></td></tr>
		</table>
	</p>
</form>