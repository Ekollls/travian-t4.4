<div class="card">
    <div class="card-header">The Forces empty the oases</div>
    <div class="card-body">
        <?php 
            if($_POST['eOasis']){
                $panel->emptyO();
                echo '<div class="alert alert-success">Oases have been emptied From Wild.</div>';
            }
        ?>
        <input type="button" style="width:100%" name="btn" value="Empty" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-primary" />
        <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Confirmation
                </div>
                <div class="modal-body">
                    are you sure?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <form action="" method="post">
                        <input type="hidden" name="eOasis" value="1">
                        <button href="#" type="submit" class="btn btn-danger danger">Confirmation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>