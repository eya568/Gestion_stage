<!-- Import Excel Modal -->
<div class="modal fade" id="importExcelModal" tabindex="-1" role="dialog" aria-labelledby="importExcelModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importExcelModalLabel">Importer Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="import_file">Sélectionnez un fichier Excel :</label>
                        <input type="file" name="import_file" class="form-control" required />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Importer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-green').click(function() {
            $('#importExcelModal').modal('show');
        });
    });
</script>