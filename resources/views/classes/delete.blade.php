<div class="modal fade" id="deleteClassModal" tabindex="-1" role="dialog" aria-labelledby="deleteClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteClassModalLabel">Supprimer la Classe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer la classe <strong>{{ $class->classe }}</strong> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('classes.destroy', $class->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
