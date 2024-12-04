<!-- Delete Class Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Supprimer la Classe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer la classe <strong id="className"></strong> et tous les étudiants associés ? Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                <!-- Form to submit delete request -->
                <form id="deleteClassForm" method="POST" action="{{ route('classes.destroy', ':classId') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to dynamically set the class ID and name in the modal
    function setDeleteClassData(classId, className) {
        const form = document.getElementById('deleteClassForm');
        const classNameSpan = document.getElementById('className');

        // Update the form action with the class ID
        form.action = form.action.replace(':classId', classId);

        // Update the modal content with the class name
        classNameSpan.textContent = className;
    }
</script>
