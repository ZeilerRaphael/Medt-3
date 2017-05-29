<!-- Modal -->
<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Löschen</h4>
            </div>
            <div class="modal-body">
                Wollen sie die Zeile wirklich löschen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary remove">Löschen</button>
            </div>
        </div>
    </div>
</div>

<!-- Adjust Modal -->
<div class="modal fade" id="ModalAdjust" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Änderungen</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <form class="form-inline" method ="POST">
                            <div class="form-group">
                                <input id="pname" type="text" class="form-control" name ="pname" value= "Keine Ahnung">
                            </div>
                            <div class="form-group">
                                <input id="pdesc" type="text" class="form-control" name ="pdesc" value="Keine Ahnung">
                            </div>
                            <div class="form-group">
                                <input id="created" type="date" class="form-control" name ="created" value= "Hoffentilcih bald">
                            </div>
                        </form>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save">Speichern</button>
            </div>
        </div>
    </div>
</div>