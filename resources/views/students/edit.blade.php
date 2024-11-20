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
            @if(isset($student))

            <div class="modal-body">
                <form action="{{ route('students.update', ['student' => $student->id]) }}" method="POST" id="editStudentForm">
                    @csrf
                    @method('PATCH')
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
                        <input type="text" class="form-control" id="editStudentClass" name="classe" required />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
                @else
                <p>No student to edit.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function editStudent(student) {
        // Fill form inputs with the student's data
        document.getElementById('editStudentId').value = student.id;
        document.getElementById('editStudentCIN').value = student.cin;
        document.getElementById('editStudentName').value = student.nom;
        document.getElementById('editStudentFirstName').value = student.prenom;
        document.getElementById('editStudentClass').value = student.classe;

        // Update the form action dynamically with the student ID
        const form = document.getElementById('editStudentForm');
        form.action = `/students/${student.id}`; // Make sure the ID is inserted into the URL

        // Show the modal
        $('#editStudentModal').modal('show');
    }
    document.addEventListener("DOMContentLoaded", function() {
        // Attach a click event listener to all elements with the class "editStudentBtn"
        document.querySelectorAll('.editStudentBtn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Get the student ID from the button's data-id attribute
                const studentId = this.getAttribute('data-id');

                // Fetch student data using AJAX (assuming you have an API route set up)
                fetch(`/students/${studentId}/edit`)
                    .then(response => response.json())
                    .then(student => {
                        // Populate modal fields with student data
                        document.getElementById('editStudentId').value = student.id;
                        document.getElementById('editStudentCIN').value = student.cin;
                        document.getElementById('editStudentName').value = student.nom;
                        document.getElementById('editStudentFirstName').value = student.prenom;
                        document.getElementById('editStudentClass').value = student.classe;

                        // Update the form action dynamically with the student ID
                        const form = document.getElementById('editStudentForm');
                        form.action = `/students/${student.id}`;

                        // Show the modal
                        $('#editStudentModal').modal('show');
                    })
                    .catch(error => console.error('Error fetching student data:', error));
            });
        });
    });
</script>