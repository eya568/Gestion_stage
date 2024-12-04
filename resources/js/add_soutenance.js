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
          const row = document.querySelector(tr[data - id] = "${data.soutenance.id}");
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
    const soutenanceId = row.dataset.id; // Assuming you set data-id on each row

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