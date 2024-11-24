<div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addClassModalLabel">Ajouter un Classe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form to add a new class -->
                <form id="addClassForm" method="POST" action="{{ route('classes.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="ClassName">Nom du Classe</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="ClassName" 
                            name="classe" 
                            placeholder="Entrez le nom de la classe" 
                            required 
                        />
                    </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
                </form>
        </div>
    </div>
</div>