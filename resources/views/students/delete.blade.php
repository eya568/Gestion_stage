<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la Suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cet étudiant ? Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                <!-- Form to submit delete request -->
                <form id="deleteStudentForm" method="POST" action="{{ route('students.destroy', ':studentId') }}">
                    @csrf
                    @method('DELETE')
                    <!-- Hidden field to pass the current class filter -->
                    <input type="hidden" name="classe" value="{{ request('classe') }}">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to dynamically set the student ID in the form's action URL
    function setDeleteStudentId(studentId) {
        const form = document.getElementById('deleteStudentForm');
        form.action = form.action.replace(':studentId', studentId);
    }
</script>