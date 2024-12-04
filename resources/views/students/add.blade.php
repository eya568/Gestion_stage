<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Ajouter un Étudiant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form id="addStudentForm" method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="studentCIN">CIN</label>
                        <input type="text" class="form-control" id="studentCIN" name="cin" required />
                    </div>
                    <div class="form-group">
                        <label for="studentName">Nom</label>
                        <input type="text" class="form-control" id="studentName" name="nom" required />
                    </div>
                    <div class="form-group">
                        <label for="studentFirstName">Prénom</label>
                        <input type="text" class="form-control" id="studentFirstName" name="prenom" required />
                    </div>
                    <div class="form-group">
                        <label for="classe">Classe</label>
                        <select name="classe_id" id="classe" class="form-control" required>
                            <option value="" disabled selected>Choisir une classe</option>
                            @foreach ($classes as $classe)
                            <option value="{{ $classe->id }}"
                                {{ isset($selectedClasse) && $selectedClasse == $classe->id ? 'selected' : '' }}>
                                {{ $classe->classe }}
                            </option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
            </form>
        </div>
    </div>
</div>