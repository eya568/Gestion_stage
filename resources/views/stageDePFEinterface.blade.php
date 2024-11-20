<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des Soutenances</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        color: #333;
        padding-bottom: 60px;
      }
      .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
      }
      .btn-custom {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        padding: 8px 12px;
      }
      .btn-group-fixed {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: flex;
        gap: 10px;
        z-index: 1000;
      }
      .btn-print {
        font-size: 14px;
        color: #fff;
        background-color: #ff9800;
        border: none;
      }
      .btn-print:hover {
        background-color: #e68900;
      }
      .table-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      }
      .hover-effect {
        transition: background-color 0.3s;
      }
      .hover-effect:hover {
        background-color: #f1f1f1;
      }
      .hidden {
        display: none;
      }
      .search-bar {
        margin-bottom: 15px;
        display: flex;
        justify-content: flex-end;
      }
    </style>
  </head>
  <body>
    <!-- Interface principale : Liste des Étudiants en Soutenance -->
    <div class="container mt-4" id="mainInterface">
      <div class="table-container">
        <div class="header">
          <h2>Liste des Soutenance En PFE</h2>
          <button class="btn btn-print btn-custom" onclick="imprimerPDF()">
            <i class="bi bi-printer"></i> Imprimer en PDF
          </button>
        </div>
        <div class="search-bar">
          <input
            type="text"
            class="form-control w-25"
            id="searchInput"
            placeholder="Rechercher..."
            onkeyup="rechercher()"
          />
        </div>
        <table class="table table-striped hover-effect">
          <thead>
            <tr>
              <th>Étudiant</th>
              <th>Encadreur</th>
              <th>Jury 1</th>
              <th>Jury 2</th>
              <th>Société de Stage</th>
              <th>Durée de Stage</th>
              <th>Classe</th>
              <th>Heure</th>
              <th>Date de Soutenance</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="soutenancesTable">
            <!-- Les données seront ajoutées ici dynamiquement -->
          </tbody>
        </table>
      </div>
      <!-- Boutons pour navigation -->
      <div class="btn-group-fixed">
        <button class="btn btn-primary btn-custom" onclick="openModal()">
          <i class="bi bi-plus-circle"></i> Ajouter
        </button>
        <button
          class="btn btn-success btn-custom"
          onclick="switchToNotesInterface()"
        >
          <i class="bi bi-layout-text-sidebar-reverse"></i> Notes
        </button>
      </div>
    </div>

    <!-- Interface séparée : Ajouter des Notes de Soutenance -->
    <div class="container mt-4 hidden" id="notesInterface">
      <div class="table-container">
        <div class="header">
          <h2>Les Notes de Soutenance de PFE</h2>
          <button class="btn btn-print btn-custom" onclick="extraireListe()">
            <i class="bi bi-printer"></i> Imprimer en PDF
          </button>
        </div>
        <div class="search-bar">
          <input
            type="text"
            class="form-control w-25"
            id="searchNotesInput"
            placeholder="Rechercher..."
            onkeyup="rechercherNotes()"
          />
        </div>
        <table class="table table-striped hover-effect">
          <thead>
            <tr>
              <th>Étudiant</th>
              <th>Jury 1</th>
              <th>Jury 2</th>
              <th>Société de Stage</th>
              <th>Note de Soutenance</th>
              <th>Validation</th>
            </tr>
          </thead>
          <tbody id="notesTable">
            <!-- Les données seront ajoutées ici dynamiquement -->
          </tbody>
        </table>
      </div>
      <!-- Bouton pour revenir à la liste principale -->
      <div class="btn-group-fixed">
        <button
          class="btn btn-secondary btn-custom"
          onclick="switchToMainInterface()"
        >
          <i class="bi bi-arrow-left-circle"></i> Retour
        </button>
      </div>
    </div>

    <!-- Modal pour le formulaire d'ajout de soutenance -->
    <div
      class="modal fade"
      id="soutenanceModal"
      tabindex="-1"
      aria-labelledby="soutenanceModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="soutenanceModalLabel">
              Ajouter / Modifier une Soutenance
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form id="soutenanceForm">
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
                <label for="encadreur" class="form-label">Encadreur</label>
                <select class="form-select" id="encadreur">
                  <option>Dr. Ali Ben Aissa</option>
                  <option>Dr. Mouna Rekik</option>
                  <option>Dr. Karim Jemaa</option>
                  <option>Dr. Hedi Neffati</option>
                  <option>Dr. Salma Bouzid</option>
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
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Fermer
            </button>
            <button
              type="button"
              class="btn btn-primary"
              onclick="saveSoutenance()"
            >
              Enregistrer
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      let selectedRow = null;

      function openModal() {
        selectedRow = null;
        document.getElementById('soutenanceForm').reset();
        const modal = new bootstrap.Modal(
          document.getElementById('soutenanceModal')
        );
        modal.show();
      }

      function saveSoutenance() {
        const etudiant = document.getElementById('etudiant').value;
        const encadreur = document.getElementById('encadreur').value;
        const jury1 = document.getElementById('jury1').value;
        const jury2 = document.getElementById('jury2').value;
        const societe = document.getElementById('societe').value;
        const dateDebut = document.getElementById('dateDebut').value;
        const dateFin = document.getElementById('dateFin').value;
        const classe = document.getElementById('classe').value;
        const heure = document.getElementById('heure').value;
        const date = document.getElementById('date').value;

        if (selectedRow) {
          selectedRow.innerHTML = `
          <td>${etudiant}</td>
          <td>${encadreur}</td>
          <td>${jury1}</td>
          <td>${jury2}</td>
          <td>${societe}</td>
          <td>De ${dateDebut} à ${dateFin}</td>
          <td>${classe}</td>
          <td>${heure}</td>
          <td>${date}</td>
          <td>
            <i class="bi bi-pencil-square" onclick="editSoutenance(this)"></i>
            <i class="bi bi-trash" onclick="confirmDelete(this)"></i>
          </td>
        `;
          updateNotesTable();
        } else {
          const table = document.getElementById('soutenancesTable');
          const row = table.insertRow();
          row.innerHTML = `
          <td>${etudiant}</td>
          <td>${encadreur}</td>
          <td>${jury1}</td>
          <td>${jury2}</td>
          <td>${societe}</td>
          <td>De ${dateDebut} à ${dateFin}</td>
          <td>${classe}</td>
          <td>${heure}</td>
          <td>${date}</td>
          <td>
            <i class="bi bi-pencil-square" onclick="editSoutenance(this)"></i>
            <i class="bi bi-trash" onclick="confirmDelete(this)"></i>
          </td>
        `;
          addNoteEntry(etudiant, jury1, jury2, societe);
        }

        const modal = bootstrap.Modal.getInstance(
          document.getElementById('soutenanceModal')
        );
        modal.hide();
      }

      function addNoteEntry(etudiant, jury1, jury2, societe) {
        const notesTable = document.getElementById('notesTable');
        const row = notesTable.insertRow();
        row.innerHTML = `
        <td>${etudiant}</td>
        <td>${jury1}</td>
        <td>${jury2}</td>
        <td>${societe}</td>
        <td><input type="text" class="form-control" placeholder="Note"></td>
        <td>
          <select class="form-select">
            <option>Validée</option>
            <option>Non validée</option>
          </select>
        </td>
      `;
      }

      function updateNotesTable() {
        // Clear existing notes
        document.getElementById('notesTable').innerHTML = '';
        const rows = document.querySelectorAll('#soutenancesTable tr');
        rows.forEach((row) => {
          const cells = row.children;
          addNoteEntry(
            cells[0].textContent,
            cells[2].textContent,
            cells[3].textContent,
            cells[4].textContent
          );
        });
      }

      function editSoutenance(icon) {
        selectedRow = icon.parentElement.parentElement;
        const cells = selectedRow.children;
        document.getElementById('etudiant').value = cells[0].textContent;
        document.getElementById('encadreur').value = cells[1].textContent;
        document.getElementById('jury1').value = cells[2].textContent;
        document.getElementById('jury2').value = cells[3].textContent;
        document.getElementById('societe').value = cells[4].textContent;
        const [dateDebut, dateFin] = cells[5].textContent.split(' à ');
        document.getElementById('dateDebut').value = dateDebut.trim();
        document.getElementById('dateFin').value = dateFin.trim();
        document.getElementById('classe').value = cells[6].textContent;
        document.getElementById('heure').value = cells[7].textContent;
        document.getElementById('date').value = cells[8].textContent;

        const modal = new bootstrap.Modal(
          document.getElementById('soutenanceModal')
        );
        modal.show();
      }

      function confirmDelete(icon) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette soutenance ?')) {
          const row = icon.parentElement.parentElement;
          row.remove();
          updateNotesTable();
        }
      }

      function rechercher() {
        const input = document
          .getElementById('searchInput')
          .value.toLowerCase();
        const rows = document.querySelectorAll('#soutenancesTable tr');
        rows.forEach((row) => {
          const studentName = row.cells[0].textContent.toLowerCase();
          row.style.display = studentName.includes(input) ? '' : 'none';
        });
      }

      function rechercherNotes() {
        const input = document
          .getElementById('searchNotesInput')
          .value.toLowerCase();
        const rows = document.querySelectorAll('#notesTable tr');
        rows.forEach((row) => {
          const studentName = row.cells[0].textContent.toLowerCase();
          row.style.display = studentName.includes(input) ? '' : 'none';
        });
      }

      function switchToNotesInterface() {
        document.getElementById('mainInterface').classList.add('hidden');
        document.getElementById('notesInterface').classList.remove('hidden');
      }

      function switchToMainInterface() {
        document.getElementById('notesInterface').classList.add('hidden');
        document.getElementById('mainInterface').classList.remove('hidden');
      }

      function imprimerPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.text('Liste des Étudiants en Soutenance', 10, 10);
        const table = document.querySelector('#mainInterface table');
        doc.autoTable({ html: table });
        doc.save('soutenances.pdf');
      }

      function extraireListe() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.text('Liste des Notes de Soutenance', 10, 10);
        const table = document.querySelector('#notesInterface table');
        doc.autoTable({ html: table });
        doc.save('notes_soutenances.pdf');
      }
    </script>
  </body>
</html>
