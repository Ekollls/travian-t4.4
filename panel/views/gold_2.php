<?php



include_once("../../config.php");









if(isset($_GET['g']))
	{

		echo '<br /><br /><font color="Red"><b>Забрали голд , ебать ты жадный</font></b>';

	}else{

$id = $_POST['id'];



  echo $_POST['gold'];

  $gold=$_POST['gold'];

mysql_query("UPDATE users SET gold = gold - $gold WHERE id = ".$id."");



mysql_query($q);

       header("Location: ../../../panel/index.php?p=player&uid=$id");

    echo '<br /><br /><font color="Red"><b>Забрали голд , ебать ты жадный</font></b>';

}



?>