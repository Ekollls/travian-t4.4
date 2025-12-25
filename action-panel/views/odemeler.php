<?php
if(!defined("HLXGUVENLIK"))
	exit('OLDU');
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<?php
$odemeler = $database->query('SELECT * FROM odemeler');
?>

<style>
.del {width:12px; height:12px; background-image: url(img/Admin/icon/del.gif);}
</style>


<div class="card">
	<div class="card-header">ÖDEME LOG (<?php echo count($odemeler);?>)</div>
	<div class="card-body table-responsive">
<table class="table" id="odemeler">
	<thead>
	<tr>
		<th>ANAHTAR</th>
		<th>OYUNCU EMAİL</th>
		<th>AÇIKLAMA</th>
		<th>ÜRÜN</th>
		<th>MİKTAR</th>
		<th>TARİH</th>
		<th>IP</th>
	</tr>
	</thead>

<?php



if($odemeler){

	foreach($odemeler as $odeme){
		echo '
		<tr>
				<td>'.$odeme["anahtar"].'</td>
				<td>'.$odeme["email"].'</td>
				<td>'.$odeme["aciklama"].'</td>
				<td>'.$odeme["tip"].'</td>
				<td>'.$odeme["miktar"].'</td>
				<td>'.date("d-m-Y H:i:s",$odeme["time"]).'</td>
				<td>'.$odeme["ip"].'</td>
		</tr>
		';
	}

}



?>



</table>
</div>
</div>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {
    $('#odemeler').DataTable();
} );
</script>