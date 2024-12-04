@include('components.side-bar')

<div class="container-fluid mt-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 p-0" id="sidebar">
      <!-- Sidebar content here -->
    </div>

    <!-- Main Content Area -->
    <div class="col-md-9 col-lg-10">
      <!-- Interface principale : Liste des Étudiants en Soutenance -->
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h2 class="h5 mb-0">Liste des Étudiants en Soutenance De Perfectionnement</h2>
          <button class="btn btn-warning" onclick="imprimerPDF()">
            <i class="bi bi-printer"></i> Imprimer en PDF
          </button>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Étudiant</th>
                <th>Jury 1</th>
                <th>Jury 2</th>
                <th>Société de Stage</th>
                <th>Durée de Stage</th>
                <th>Classe</th>
                <th>Heure</th>
                <th>Date de Soutenance</th>
              </tr>
            </thead>
            <tbody id="soutenancesTable">
              <!-- Les données seront ajoutées ici dynamiquement -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Boutons de Navigation Fixes -->
  <div class="btn-group-vertical position-fixed end-0 bottom-0 mb-3 me-3" role="group">
    <button class="btn btn-primary btn-sm" onclick="openModal()">
      <i class="bi bi-plus-circle"></i> Ajouter
    </button>
    <button class="btn btn-success btn-sm" onclick="switchToNotesInterface()">
      <i class="bi bi-layout-text-sidebar-reverse"></i> Notes
    </button>
  </div>

  <!-- Modal pour le formulaire d'ajout de soutenance -->
  <div class="modal fade" id="soutenanceModal" tabindex="-1" aria-labelledby="soutenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="soutenanceModalLabel">Ajouter une Soutenance</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="soutenanceForm" action="{{ route('soutenances.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="etudiant" class="form-label">Étudiant</label>
              <select class="form-select" id="etudiant">
                <option>Amal Slouma</option>
                <option>Mariemme Ridenne</option>
                <option>Ahmed Ben Salah</option>
                <option>Karim Bouslama</option>
                <option>Sara Bouaziz</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="jury1" class="form-label">Jury 1</label>
              <select class="form-select" id="jury1">
                <option>Prof. Ali Mahjoub</option>
                <option>Prof. Salma Bouzid</option>
                <option>Prof. Karim Jemaa</option>
                <option>Prof. Hedi Neffati</option>
                <option>Prof. Mouna Rekik</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="jury2" class="form-label">Jury 2</label>
              <select class="form-select" id="jury2">
                <option>Prof. Ali Mahjoub</option>
                <option>Prof. Salma Bouzid</option>
                <option>Prof. Karim Jemaa</option>
                <option>Prof. Hedi Neffati</option>
                <option>Prof. Mouna Rekik</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="societe" class="form-label">Société de stage</label>
              <input type="text" class="form-control" id="societe" />
            </div>
            <div class="mb-3">
              <label for="dateDebut" class="form-label">Date de début</label>
              <input type="date" class="form-control" id="dateDebut" />
            </div>
            <div class="mb-3">
              <label for="dateFin" class="form-label">Date de fin</label>
              <input type="date" class="form-control" id="dateFin" />
            </div>
            <div class="mb-3">
              <label for="classe" class="form-label">Classe</label>
              <input type="text" class="form-control" id="classe" />
            </div>
            <div class="mb-3">
              <label for="heure" class="form-label">Heure</label>
              <input type="time" class="form-control" id="heure" />
            </div>
            <div class="mb-3">
              <label for="date" class="form-label">Date de soutenance</label>
              <input type="date" class="form-control" id="date" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-primary" onclick="ajouterSoutenance()">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function openModal() {
    const myModal = new bootstrap.Modal(document.getElementById('soutenanceModal'));
    myModal.show();
  }

  function ajouterSoutenance() {
    // Get form values
    const etudiant = document.getElementById('etudiant').value;
    const jury1 = document.getElementById('jury1').value;
    const jury2 = document.getElementById('jury2').value;
    const societe = document.getElementById('societe').value;
    const dateDebut = document.getElementById('dateDebut').value;
    const dateFin = document.getElementById('dateFin').value;
    const classe = document.getElementById('classe').value;
    const heure = document.getElementById('heure').value;
    const date = document.getElementById('date').value;

    // Calculate stage duration in days
    const duration = calculateDuration(dateDebut, dateFin);

    // Create a new table row
    const table = document.getElementById('soutenancesTable');
    const row = document.createElement('tr');

    row.innerHTML = `
      <td>${etudiant}</td>
      <td>${jury1}</td>
      <td>${jury2}</td>
      <td>${societe}</td>
      <td>${duration}</td>
      <td>${classe}</td>
      <td>${heure}</td>
      <td>${date}</td>
    `;

    // Append the row to the table
    table.appendChild(row);

    // Close the modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('soutenanceModal'));
    modal.hide();

    // Clear the form
    document.getElementById('soutenanceForm').reset();
  }

  function calculateDuration(start, end) {
    if (!start || !end) return 'N/A';
    const startDate = new Date(start);
    const endDate = new Date(end);
    const durationInDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
    return `${durationInDays} jours`;
  }
</script>