
<style>

	.del {width:12px; height:12px; background-image: url(img/Admin/icon/del.gif);}

</style>


<table class="table" style="width:225px">

  <thead>

	<tr>

		<th colspan="2">Reports/Messages</th>

	</tr>

  </thead>

	<tr>

		<td>ID message</td>

		<td><form action="" method="get"><input type="hidden" name="p" value="message"><input type="text" class="fm" name="nid" value="<?php echo $_GET['nid'];?>"> <input type="image" value="submit" src="../img/Admin/b/ok1.gif"></form></td>

	</tr>

	<tr>

		<td>ID report</td>

		<td><form action="" method="get"><input type="hidden" name="p" value="message"><input type="text" class="fm" name="bid" value="<?php echo $_GET['bid'];?>"> <input type="image" value="submit" src="../img/Admin/b/ok1.gif"></form></td>

	</tr>

</table>

<br>



<?php


if($_GET['nid'] && is_numeric($_GET['nid']))

{

	include('msg.php');

}

elseif($_GET['bid']  && is_numeric($_GET['bid']))

{

	include('report.php');

}

?>



