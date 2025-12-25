<?php
if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\"><?=INS126?></span></div><br>";
}
?>
<form action="process.php" method="post" id="dataform">
<input type="hidden" name="substruc" value="1">

	<p>
	<span class="f10 c"><?=INS127?></span>
		<table>
			<tr><td><?=INS128?>!</td></tr>
			<tr><td><center><input type="submit" name="Submit" id="Submit" value="Create.."></center></td></tr>
		</table>
	</p>
</form>
