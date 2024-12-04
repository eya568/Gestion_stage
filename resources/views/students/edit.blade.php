<!-- Edit Student Modal -->
<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel">Modifier un Étudiant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editStudentForm" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Champ caché pour l'ID de l'étudiant -->
                    <input type="hidden" id="editStudentId" name="id" />

                    <div class="form-group">
                        <label for="editStudentCIN">CIN</label>
                        <input type="text" class="form-control" id="editStudentCIN" name="cin" required />
                    </div>

                    <div class="form-group">
                        <label for="editStudentName">Nom</label>
                        <input type="text" class="form-control" id="editStudentName" name="nom" required />
                    </div>

                    <div class="form-group">
                        <label for="editStudentFirstName">Prénom</label>
                        <input type="text" class="form-control" id="editStudentFirstName" name="prenom" required />
                    </div>

                    <div class="form-group">
                        <label for="editStudentClass">Classe</label>
                        <select class="form-control" id="editStudentClass" name="classe_id" required>
                            <option value="" disabled>Choisir une classe</option>
                            @foreach ($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->classe }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Attache un événement de clic sur tous les boutons de modification
        document.querySelectorAll('.editStudentBtn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // ID de l'étudiant
                const studentId = this.getAttribute('data-id');

                // Appel AJAX pour récupérer les données de l'étudiant
                fetch(`/students/${studentId}/edit`)
                    .then(response => {
                        if (!response.ok) throw new Error("Erreur lors de la récupération des données");
                        return response.json();
                    })
                    .then(student => {
                        // Remplir le formulaire avec les données récupérées
                        document.getElementById('editStudentId').value = student.id;
                        document.getElementById('editStudentCIN').value = student.cin;
                        document.getElementById('editStudentName').value = student.nom;
                        document.getElementById('editStudentFirstName').value = student.prenom;
                        document.getElementById('editStudentClass').value = student.classe_id;

                        // Mettre à jour l'action du formulaire
                        const form = document.getElementById('editStudentForm');
                        form.action = `/students/${student.id}`;
                    })
                    .catch(error => console.error('Erreur:', error));
            });
        });
    });
</script>