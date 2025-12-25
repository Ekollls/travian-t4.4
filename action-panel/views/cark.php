<?php
if(!defined("HLXGUVENLIK"))
	exit('OLDU');
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<?php

$carkHediyeler = $database->query('SELECT * FROM oduller');
?>

<style>
.del {width:12px; height:12px; background-image: url(img/Admin/icon/del.gif);}
</style>


<div class="card">
	<div class="card-header">ÖDÜLLER (<?php echo count($carkHediyeler);?>) </div>
	<div class="card-body table-responsive">
<table class="table" id="oduller">
	<thead>
	<tr>
		<th>ÖDÜL</th>
		<th>MİKTAR</th>
		<th>ÇIKMA ORANI</th>
		<th>ÖDÜL TİP</th>
		<th>EYLEM</th>
	</tr>
	</thead>
<tbody>
<?php



if($carkHediyeler){

	foreach($carkHediyeler as $cark){
		switch($cark['tip']){
			case 'gold':
				$tipi='ALTIN';
			break;
			case 'silver':
				$tipi='GÜMÜŞ';
			break;
			case 'cark':
				$tipi='ÇARK';
			break;
			default:
				$tipi='PASS';
			break;
		}
		echo '
		<tr>
				<td>'.$cark["odul"].'</td>
				<td>'.$cark["miktar"].'</td>
				<td>'.$cark["oran"].'</td>
				<td>'.$tipi.'</td>
				<td><button class="btn btn-sm btn-success btn-hlx" data-id="'.$cark["id"].'"><i class="fas fa-edit"></i></button></td>
		</tr>
		';
	}

}



?>

</tbody>

</table>
</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="paketForm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form id="islemForm">
		<div class="modal-body">
			<input type="hidden" name="id" id="id" value="0">
			<input type="hidden" name="ajaxAction" id="ajaxAction" value="odulKaydet">
			<div class="form-group">
				<label>ÖDÜL ADI</label>
				<input type="text" name="odul" id="odul" class="form-control" placeholder="100 Altın" required>
			</div>
			<div class="form-group">
				<label>ÖDÜL MİKTARI</label>
				<input type="number" class="form-control" name="miktar" id="miktar" step="1" required>
			</div>
			<div class="form-group">
				<label>ÇIKMA ORANI</label>
				<input type="number" class="form-control" name="oran" id="oran" step="1" required>
			</div>
			<div class="form-group">
				<label>Paket Tipi</label>
				<select class="custom-select mr-sm-2" name="tip" id="tip" required>
					<option value="gold">ALTIN</option>
					<option value="cark">ÇARK</option>
					<option value="silver">GÜMÜŞ</option>
					<option value="pass">PASS (ÖDÜL ALMAYACAK)</option>
				</select>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Kaydet</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
		</div>
	  </form>
    </div>
  </div>
</div>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script> 
	function setTwoNumberDecimal(event) {
		this.value = parseFloat(this.value).toFixed(2);
	}
	$(document).ready(function() {
		$('#oduller').DataTable();
	} );
	$(document).on('click','.btn-hlx', function (e) {
		$.ajax({
		method: "POST",
		url: "ajax.php",
		data: {"ajaxAction":"odulCek","id":$(this).data('id')},
		success: function(data){
			data= jQuery.parseJSON(data);
			if(data.status){
				$('.modal-title').text('ÖDÜL DÜZENLE');
				$('#odul').val(data.data.odul);
				$('#miktar').val(data.data.miktar);
				$('#oran').val(data.data.oran);
				$('#tip').val(data.data.tip);
				$('#id').val(data.data.id);
				$('#paketForm').modal('show');
			}else{
				alert(data.message);
			}
		},
		error: function(xhr){
			alert(xhr.responseJSON.message);
		}
	});
	});
	
	$( "#islemForm").submit(function( event ) {
		event.preventDefault();
		$.ajax({
			url: "ajax.php",
			type: 'POST',
			data: $(this).serialize(),
			success: function (data) {
				data= jQuery.parseJSON(data);
				if(data.status){
					location.reload(); 
				}else{
					alert(data.message);
				}
			},
			error: function (hata) {
				alert("Beklenmedik Bir Hata Meydana Geldi!");
			}
		});
	});
</script>