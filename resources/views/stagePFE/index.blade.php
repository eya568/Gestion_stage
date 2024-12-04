@extends('layouts.stage')

@section('content')
<!-- Main content -->

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
                        <th>Salle</th>
                        <th>Classe</th>
                        <th>Heure</th>
                        <th>Date de Soutenance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="soutenancesTable">
                    @foreach($soutenances as $soutenance)
                    <tr data-id="{{ $soutenance->id }}">
                        <td>{{ $soutenance->etudiantRelation->nom ?? 'N/A' }}</td>
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
            <button class="btn btn-success btn-sm">
                <i class="bi bi-layout-text-sidebar-reverse"></i> Notes
            </button>
        </div>
</main>

@section('modals')
@include('stagePFE.add')
@include('stagePFE.delete')
@include('stagePFE.edit')
@endsection

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

    // Handle the Edit form submission
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();

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
            if (data.success) {
                // Update the table row dynamically
                const row = document.querySelector(`tr[data-id="${data.soutenance.id}"]`);
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
            } else {
                alert('Une erreur s\'est produite lors de la mise à jour.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Une erreur s\'est produite lors de la mise à jour.');
        });
    });

    // Handle the Add form submission
    document.getElementById('addForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Get all form values
        const etudiant = document.getElementById('etudiant').value;
        const encadrant = document.getElementById('encadreur').value;
        const jury1 = document.getElementById('jury1').value;
        const jury2 = document.getElementById('jury2').value;
        const societe = document.getElementById('societe').value;
        const classe = document.getElementById('classe').value;
        const heure = document.getElementById('heure').value;
        const dateSoutenance = document.getElementById('date_soutenance').value;

        // Create a new table row with the form values
        const table = document.getElementById('soutenancesTable');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${etudiant}</td>
            <td>${encadrant}</td>
            <td>${jury1}</td>
            <td>${jury2}</td>
            <td>${societe}</td>
            <td>${classe}</td>
            <td>${heure}</td>
            <td>${dateSoutenance}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Supprimer</button>
            </td>
        `;

        // Append the new row to the table
        table.appendChild(row);

        // Reset the form
        document.getElementById('addForm').reset();

        // Close the modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('addModal'));
        modal.hide();
    });

    // Function to delete a row
    function deleteRow(button) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette soutenance ?')) {
            button.closest('tr').remove();
        }
    }
</script>

@endsection
