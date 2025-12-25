
<div class="row p-3">
    <div class="col-sm-12 text-center">
        <button class="btn btn-primary hlx-action" data-action="serverEkle">Server Ekle</button>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        SERVERLAR
    </div>
    <div class="card-body">
        <table id="serverTablo">
            <thead>
                <tr>
                    <th>SERVER</th>
                    <th>URL</th>
                    <th>İŞLEM</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="serverModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <form id="swKayit">
        <div class="modal-body">
        <input type="hidden" name="id" value="0" id="swID">
        <input type="hidden" name="ajaxAction" value="kaydet">
        <label for="names" class="form-label">Server Adı</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" id="names" name="name" class="form-control" placeholder="Server" aria-label="Server" aria-describedby="basic-addon1">
        </div>
        <label for="basic-url" class="form-label">Server URL</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3"><?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")?>://</span>
            <input type="text" class="form-control" id="basic-url" name="server" aria-describedby="basic-addon3 basic-addon2">
            <span class="input-group-text" id="basic-addon2">.<?=$_SERVER['HTTP_HOST']?></span>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal</button>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </div>
      </form>
    </div>
  </div>
</div>