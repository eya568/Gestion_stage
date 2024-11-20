<div
  class="modal fade"
  id="addStudentModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="addStudentModalLabel"
  aria-hidden="true">
  <form action="{{route('addEnseignant')}} " method="post">
    @csrf
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStudentModalLabel">
            Ajouter un Étudiant
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="studentCIN">CIN</label>
            <input
              type="text"
              name="cin"
              class="form-control"
              id="studentCIN"
              required />
          </div>
          <div class="form-group">
            <label for="studentCIN">Nom</label>
            <input
              type="text"
              name="name"
              class="form-control"
              id="studentCIN"
              required />
          </div>
          <div class="form-group">
            <label for="studentFirstName">Prénom</label>
            <input
              type="text"
              name="prenom"
              class="form-control"
              id="studentFirstName"
              required />
          </div>
          <div class="form-group">
            <label for="studentClass">Email</label>
            <input
              type="text"
              name="email"
              class="form-control"
              id="studentClass"
              required />
          </div>
          <div class="form-group">
            <label for="studentClass">Specialite</label>
            <input
              type="text"
              name="specialite"
              class="form-control"
              id="studentClass"
              required />
          </div>

        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-dismiss="modal">
            Annuler
          </button>
          <button type="button" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </div>
</div>
</form>