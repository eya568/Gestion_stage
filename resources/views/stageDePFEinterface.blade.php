<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Gestion des Soutenances</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #333;
      padding-bottom: 60px;
    }

    .table-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .hover-effect:hover {
      background-color: #f1f1f1;
    }

    .sidebar {
      background-color: #343a40;
      color: #fff;
      height: 100vh;
      padding: 20px;
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 10px;
      margin-bottom: 5px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .sidebar a:hover {
      background-color: #495057;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
        @include('components.side-bar')
      </nav>

      <!-- Main content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div class="container mt-4">
          <div class="table-container">
            <div class="header d-flex justify-content-between align-items-center">
              <h2>Liste des Soutenances En PFE</h2>
              <button class="btn btn-warning btn-sm" onclick="imprimerPDF()">
                <i class="bi bi-printer"></i> Imprimer en PDF
              </button>
            </div>
            <div class="search-bar my-3">
              <input type="text" class="form-control w-25" id="searchInput" placeholder="Rechercher..." onkeyup="rechercher()" />
            </div>
            <table class="table table-striped hover-effect">

              <thead>
                <tr>
                  <th>Étudiant</th>
                  <th>Encadreur</th>
                  <th>Jury 1</th>
                  <th>Jury 2</th>
                  <th>Société</th>
                  <th>Salle</th> <!-- Add this -->
                  <th>Classe</th>
                  <th>Heure</th>
                  <th>Date de Soutenance</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($soutenances as $soutenance)
                <tr data-id="{{ $soutenance->id }}">
                  <td>{{ $soutenance->etudiant?? 'N/A' }}</td>
                  <td>{{ $soutenance->encadrant }}</td>
                  <td>{{ $soutenance->jury1 }}</td>
                  <td>{{ $soutenance->jury2 }}</td>
                  <td>{{ $soutenance->societe }}</td>
                  <td>{{ $soutenance->salle }}</td>
                  <td>{{ $soutenance->classe }}</td>
                  <td>{{ $soutenance->heure }}</td>
                  <td>{{ $soutenance->date_soutenance }}</td>
                
                  <td>
                    <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">
                      <i class="bi bi-trash"></i>
                    </button>
                    <button class="btn btn-warning btn-sm" onclick="editRow(this)">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </td>

                </tr>
                @endforeach
              </tbody>



            </table>
          </div>

          <!-- Fixed Buttons -->
          <div class="btn-group-fixed d-flex justify-content-end my-3">
            <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#addModal">
              <i class="bi bi-plus-circle"></i> Ajouter
            </button>
            <button class="btn btn-success btn-sm" onclick="">
              <i class="bi bi-layout-text-sidebar-reverse"></i> Notes
            </button>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Modal -->
   <!-- ADD MODAL -->


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
  @if(session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif
  <!-- Edit Modal -->
  <!-- Edit Modal -->
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Modifier une Soutenance</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editForm" method="POST">
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
           


  <!-- JavaScript to Filter Students Based on Selected Class -->


  <!-- Bouton de soumission -->
  <button type="submit" class="btn btn-primary">Ajouter la soutenance</button>
  </form>


  </div>
  </div>
  </div>
  </div>
  <script>
    const students = @json($students);

    // Listen for class selection change
    document.getElementById('classe').addEventListener('change', function() {
      const selectedClassId = this.value; // Get the selected class id
      const studentDropdown = document.getElementById('etudiant');

      // Clear the current student options in the dropdown
      studentDropdown.innerHTML = '<option value="">-- Sélectionner un étudiant --</option>';

      // If a class is selected, filter students by the selected class
      if (selectedClassId) {
        // Filter the students based on the selected class id
        const filteredStudents = students.filter(student => student.classe_id == selectedClassId);

        // Add filtered students to the dropdown
        filteredStudents.forEach(student => {
          const option = document.createElement('option');
          option.value = student.id;
          option.textContent = student.nom;
          studentDropdown.appendChild(option);
        });
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('editForm').addEventListener('submit', function(e) {

      const form = e.target;
      const actionUrl = form.action;
      const formData = new FormData(form);

      fetch(actionUrl, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
          },
          body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
  if (data.success && data.soutenance) {
    // Find the row based on the 'data-id' attribute
    const row = document.querySelector(`tr[data-id='${data.soutenance.id}']`);
    if (row) {
      // Update the table row with the updated soutenance data
      row.querySelector('td:nth-child(1)').textContent = data.soutenance.etudiant;
      row.querySelector('td:nth-child(2)').textContent = data.soutenance.encadrant;
      row.querySelector('td:nth-child(3)').textContent = data.soutenance.jury1;
      row.querySelector('td:nth-child(4)').textContent = data.soutenance.jury2;
      row.querySelector('td:nth-child(5)').textContent = data.soutenance.societe;
      row.querySelector('td:nth-child(6)').textContent = data.soutenance.salle;
      row.querySelector('td:nth-child(7)').textContent = data.soutenance.classe;
      row.querySelector('td:nth-child(8)').textContent = data.soutenance.heure;
      row.querySelector('td:nth-child(9)').textContent = data.soutenance.date_soutenance;
      
      // Close the modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
      modal.hide();

      alert('Soutenance mise à jour avec succès!');
    }
  } 
})


    });

    document.getElementById('addForm').addEventListener('submit', function(e) {


      // Get all form values
      const etudiant = document.getElementById('etudiant').value;
      const encadrant = document.getElementById('encadreur').value;
      const jury1 = document.getElementById('jury1').value;
      const jury2 = document.getElementById('jury2').value;
      const societe = document.getElementById('societe').value;
      const dateDebut = document.getElementById('date_debut').value;
      const dateFin = document.getElementById('date_fin').value;
      const classe = document.getElementById('classe').value;
      const heure = document.getElementById('heure').value;
      const dateSoutenance = document.getElementById('date_soutenance').value;
      const type = document.getElementById('type').value; // Fetch type field



      // Create a new table row
      const table = document.getElementById('soutenancesTable');
      const row = document.createElement('tr');
      row.innerHTML = `
  <td>${etudiant}</td>
  <td>${encadreur}</td>
  <td>${jury1}</td>
  <td>${jury2}</td>
  <td>${societe}</td>
  <td>${classe}</td>
  <td>${heure}</td>
  <td>${date}</td>
  <td>
    <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Supprimer</button>
  </td>
`;

      // Append the new row to the table
      table.appendChild(row);


      // Append the row to the table
      table.appendChild(row);

      // Reset the form
      document.getElementById('addForm').reset();

      // Close the modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('addModal'));
      modal.hide();
    });

    // Function to delete a row
    function deleteRow(button) {
      const row = button.closest('tr');
const soutenanceId = row.getAttribute('data-id'); // Access the data-id attribute

      // Confirm the deletion
      if (confirm('Êtes-vous sûr de vouloir supprimer cette soutenance ?')) {
        // Send a DELETE request to the backend
        fetch(`/soutenances/${soutenanceId}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              row.remove(); // Remove the row from the table
              alert(data.message); // Show success message
            } else {
              alert('Une erreur est survenue lors de la suppression de la soutenance.');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la suppression de la soutenance.');
          });
      }
    }



    function editRow(button) {
      const row = button.closest('tr');
      const soutenanceId = row.dataset.id;

      // Extract data from the table row
      const etudiant = row.querySelector('td:nth-child(1)').textContent.trim();
      const encadrant = row.querySelector('td:nth-child(2)').textContent.trim();
      const jury1 = row.querySelector('td:nth-child(3)').textContent.trim();
      const jury2 = row.querySelector('td:nth-child(4)').textContent.trim();
      const societe = row.querySelector('td:nth-child(5)').textContent.trim();
      const salle = row.querySelector('td:nth-child(6)').textContent.trim();
      const heure = row.querySelector('td:nth-child(7)').textContent.trim();
      const dateSoutenance = row.querySelector('td:nth-child(8)').textContent.trim();

      // Populate modal fields
      document.getElementById('editEtudiant').value = etudiant;
      document.getElementById('editEncadrant').value = encadrant;
      document.getElementById('editJury1').value = jury1;
      document.getElementById('editJury2').value = jury2;
      document.getElementById('editSociete').value = societe;
      document.getElementById('editSalle').value = salle;
      document.getElementById('editHeure').value = heure;
      document.getElementById('editDateSoutenance').value = dateSoutenance;

      // Update form action
      const form = document.getElementById('editForm');
      form.action = `/soutenances/${soutenanceId}`;

      // Show the modal
      const modal = new bootstrap.Modal(document.getElementById('editModal'));
      modal.show();
    }
  </script>



</body>

</html>