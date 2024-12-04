 <!-- Edit Modal -->
 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Modifier une Soutenance</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editForm" action="{{ route('soutenances.update', $soutenance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Étudiant Dropdown -->
            <div class="mb-3">
              <label for="editEtudiant" class="form-label">Étudiant</label>
              <select name="etudiant" id="editEtudiant" class="form-select">
                <option value="">-- Sélectionner un étudiant --</option>
                @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->nom }}</option>
                @endforeach
              </select>
            </div>

            <!-- Encadrant -->
            <div class="mb-3">
              <label for="editEncadrant" class="form-label">Encadrant</label>
              <select name="encadrant" id="editEncadrant" class="form-select">
                <option value="">-- Sélectionner un encadrant --</option>
                @foreach($teachers as $teacher)
                <option value="{{ $teacher->nom }}">{{ $teacher->nom }}</option>
                @endforeach
              </select>
            </div>

            <!-- Jury 1 -->
            <div class="mb-3">
              <label for="editJury1" class="form-label">Jury 1</label>
              <select name="jury1" id="editJury1" class="form-select">
                <option value="">-- Sélectionner Jury 1 --</option>
                @foreach($teachers as $teacher)
                <option value="{{ $teacher->nom }}">{{ $teacher->nom }}</option>
                @endforeach
              </select>
            </div>

            <!-- Jury 2 -->
            <div class="mb-3">
              <label for="editJury2" class="form-label">Jury 2</label>
              <select name="jury2" id="editJury2" class="form-select">
                <option value="">-- Sélectionner Jury 2 --</option>
                @foreach($teachers as $teacher)
                <option value="{{ $teacher->nom }}">{{ $teacher->nom }}</option>
                @endforeach
              </select>
            </div>

            <!-- Société de Stage -->
            <div class="mb-3">
              <label for="editSociete" class="form-label">Société de Stage</label>
              <input type="text" name="societe" id="editSociete" class="form-control">
            </div>

            <!-- Salle -->
            <div class="mb-3">
              <label for="editSalle" class="form-label">Salle</label>
              <input type="text" name="salle" id="editSalle" class="form-control">
            </div>

            <!-- Heure -->
            <div class="mb-3">
              <label for="editHeure" class="form-label">Heure</label>
              <input type="time" name="heure" id="editHeure" class="form-control">
            </div>

            <!-- Date de Soutenance -->
            <div class="mb-3">
              <label for="editDateSoutenance" class="form-label">Date de Soutenance</label>
              <input type="date" name="date_soutenance" id="editDateSoutenance" class="form-control">
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Ajouter une Soutenance</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addForm" action="{{ route('soutenances.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" id="type" value="PFE">

            <!-- Classe Dropdown -->
            <div class="mb-3">
              <label for="classe" class="form-label">Classe</label>
              <select name="classe" id="classe" class="form-select">
                <option value="">-- Sélectionner une classe --</option>
                @foreach($classes as $classe)
                <option value="{{ $classe->id }}" {{ old('classe') == $classe->id ? 'selected' : '' }}>{{ $classe->classe }}</option>
                @endforeach
              </select>
              @error('classe')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <!-- Étudiant Dropdown -->
            <div class="mb-3">
              <label for="etudiant" class="form-label">Étudiant</label>
              <select name="etudiant" id="etudiant" class="form-select">
                <option value="">-- Sélectionner un étudiant --</option>
                @foreach($students as $student)
                <option value="{{ $student->id }}" data-classe="{{ $student->classe_id }}" {{ old('etudiant') == $student->id ? 'selected' : '' }}>{{ $student->nom }}</option>
                @endforeach
              </select>
              @error('etudiant')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Encadrant -->
            <div class="mb-3">
              <label for="encadrant" class="form-label">Encadrant</label>
              <select name="encadrant" id="encadrant" class="form-select">
                <option value="">-- Sélectionner un encadrant --</option>
                @foreach($teachers as $teacher)
                <option value="{{ $teacher->nom }}" {{ old('encadrant') == $teacher->nom ? 'selected' : '' }}>{{ $teacher->nom }}</option>
                @endforeach
              </select>
              @error('encadrant')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Jury 1 -->
            <div class="mb-3">
              <label for="jury1" class="form-label">Jury 1</label>
              <select name="jury1" id="jury1" class="form-select">
                <option value="">-- Sélectionner Jury 1 --</option>
                @foreach($teachers as $teacher)
                <option value="{{ $teacher->nom }}" {{ old('jury1') == $teacher->nom ? 'selected' : '' }}>{{ $teacher->nom }}</option>
                @endforeach
              </select>
              @error('jury1')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Jury 2 -->
            <div class="mb-3">
              <label for="jury2" class="form-label">Jury 2</label>
              <select name="jury2" id="jury2" class="form-select">
                <option value="">-- Sélectionner Jury 2 --</option>
                @foreach($teachers as $teacher)
                <option value="{{ $teacher->nom }}" {{ old('jury2') == $teacher->nom ? 'selected' : '' }}>{{ $teacher->nom }}</option>
                @endforeach
              </select>
              @error('jury2')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Société de Stage -->
            <div class="mb-3">
              <label for="societe" class="form-label">Société de Stage</label>
              <input type="text" name="societe" id="societe" class="form-control" value="{{ old('societe') }}" />
              @error('societe')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Dates -->
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="date_debut" class="form-label">Date de Début</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ old('date_debut') }}" />
                @error('date_debut')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="date_fin" class="form-label">Date de Fin</label>
                <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ old('date_fin') }}" />
                @error('date_fin')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Salle -->
            <div class="mb-3">
              <label for="salle" class="form-label">Salle</label>
              <input type="text" name="salle" id="salle" class="form-control" value="{{ old('salle') }}" />
              @error('salle')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Heure -->
            <div class="mb-3">
              <label for="heure" class="form-label">Heure</label>
              <input type="time" name="heure" id="heure" class="form-control" value="{{ old('heure') }}" />
              @error('heure')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Date de Soutenance -->
            <div class="mb-3">
              <label for="date_soutenance" class="form-label">Date de Soutenance</label>
              <input type="date" name="date_soutenance" id="date_soutenance" class="form-control" value="{{ old('date_soutenance') }}" required />
              @error('date_soutenance')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary">Ajouter la Soutenance</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>