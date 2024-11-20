<!-- Lien vers Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Lien vers Font Awesome pour les icônes -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<!-- Trigger Button for Popup Modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#editStudentModal">
  <i class="fas fa-user-edit mr-2"></i>Modifier Enseignant
</button>

<!-- Edit Student Modal Popup -->
<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <!-- Modal Header with custom background color -->
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="editStudentModalLabel">
          <i class="fas fa-user-edit mr-2"></i>Modifier Enseignant
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal Body -->
      <form action="{{ route('updateEnseignant', $data['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="studentCIN"><i class="fas fa-id-card mr-2"></i>CIN</label>
            <input type="text" name="cin" value="{{ $data['cin'] }}" class="form-control" id="studentCIN" required>
          </div>
          <div class="form-group">
            <label for="studentName"><i class="fas fa-user mr-2"></i>Nom</label>
            <input type="text" name="nom" value="{{ $data['nom'] }}" class="form-control" id="studentName" required>
          </div>
          <div class="form-group">
            <label for="studentFirstName"><i class="fas fa-user mr-2"></i>Prénom</label>
            <input type="text" name="prenom" value="{{ $data['prenom'] }}" class="form-control" id="studentFirstName" required>
          </div>
          <div class="form-group">
            <label for="studentEmail"><i class="fas fa-envelope mr-2"></i>Email</label>
            <input type="email" name="email" value="{{ $data['email'] }}" class="form-control" id="studentEmail" required>
          </div>
          <div class="form-group">
            <label for="studentSpecialite"><i class="fas fa-graduation-cap mr-2"></i>Spécialité</label>
            <input type="text" name="specialite" value="{{ $data['specialite'] }}" class="form-control" id="studentSpecialite" required>
          </div>
        </div>
        <!-- Modal Footer with customized button colors -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-2"></i>Annuler
          </button>
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save mr-2"></i>Enregistrer les modifications
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- jQuery and Bootstrap JavaScript (necessary for the modal) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>