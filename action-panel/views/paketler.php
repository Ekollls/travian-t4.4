<?php
if(!defined("HLXGUVENLIK"))
	exit('OLDU');
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<?php

$paketler = $database->query('SELECT * FROM paketler');
?>

<style>
.del {width:12px; height:12px; background-image: url(img/Admin/icon/del.gif);}
</style>


<div class="card">
	<div class="card-header">PAKETLER (<?php echo count($paketler);?>) </div>
	<div class="card-body table-responsive">
		<div class="col-sm-12 text-center">
			<button class="btn btn-primary btn-hlx" data-action="yeniPaket">PAKET EKLE</button>
		</div>
<table class="table" id="paketler">
	<thead>
	<tr>
		<th>PAKET ADI</th>
		<th>FİYAT</th>
		<th>MİKTAR</th>
		<th>BONUS</th>
		<th>PAKET TİP</th>
		<th>EYLEM</th>
	</tr>
	</thead>
<tbody>
<?php



if($paketler){

	foreach($paketler as $paket){
		echo '
		<tr>
				<td>'.$paket["paketadi"].'</td>
				<td>'.$paket["fiyat"].' TL</td>
				<td>'.$paket["miktar"].'</td>
				<td>'.($paket["cark"]?$paket["cark"]." Hediye Çark Çevirme":"Yok").'</td>
				<td>'.($paket["tip"]=="gold"?"Altın Paketi":"Çark Paketi").'</td>
				<td><button class="btn btn-sm btn-success btn-hlx" data-action="paketCek" data-id="'.$paket["id"].'"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger btn-hlx" data-action="paketSil" data-id="'.$paket["id"].'"><i class="fas fa-trash"></i></button></td>
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
			<input type="hidden" name="ajaxAction" id="ajaxAction" value="paketKaydet">
			<div class="form-group">
				<label>Paket Adı</label>
				<input type="text" name="paketadi" id="paketadi" class="form-control" placeholder="1 Altın +1 Çark Çevirme" required>
			</div>
			<div class="form-group">
				<label>Paket Fiyatı</label>
				<input type="number" class="form-control" name="fiyat" id="fiyat" step="0.1" required>
			</div>
			<div class="form-group">
				<label>Miktar</label>
				<input type="number" class="form-control" name="miktar" id="miktar" step="1" required>
			</div>
			<div class="form-group">
				<label>Çark Bonus Adet</label>
				<input type="number" class="form-control" name="cark" id="cark" step="1" required>
			</div>
			<div class="form-group">
				<label>Paket Tipi</label>
				<select class="custom-select mr-sm-2" name="tip" id="tip" required>
					<option value="gold">Altın Paketi</option>
					<option value="cark">Çark Paketi</option>
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
		$('#paketler').DataTable();
	} );
	$(document).on('click','.btn-hlx', function (e) {
		switch($(this).data('action')){
			case 'yeniPaket':
				$('.modal-title').text('YENİ PAKET EKLE');
				$('#paketadi').val('');
				$('#fiyat').val('');
				$('#miktar').val('');
				$('#cark').val('');
				$('#tip').val('gold');
				$('#id').val(0);
				$('#paketForm').modal('show');
			break;
			case 'paketCek':
				$.ajax({
					method: "POST",
					url: "ajax.php",
					data: {"ajaxAction":"paketCek","id":$(this).data('id')},
					success: function(data){
						data= jQuery.parseJSON(data);
						if(data.status){
							$('.modal-title').text('PAKET DÜZENLE');
							$('#paketadi').val(data.data.paketadi);
							$('#fiyat').val(data.data.fiyat);
							$('#miktar').val(data.data.miktar);
							$('#cark').val(data.data.cark);
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
			break;
			case 'paketSil':
				if (confirm("Paket Silinsin Mi?") == true) {
					$.ajax({
						method: "POST",
						url: "ajax.php",
						data: {"ajaxAction":"paketSil","id":$(this).data('id')},
						success: function(data){
							data= jQuery.parseJSON(data);
							if(data.status){
								location.reload();
							}else{
								alert(data.message);
							}
						},
						error: function(xhr){
							alert(xhr.responseJSON.message);
						}
					});
				}
			break;
			default :
				return false;
			break;
		}
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