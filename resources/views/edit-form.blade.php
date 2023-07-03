
@if($People->isNotEmpty())
<div id="edit-form" style="display: none;">
    <h2>Edit Person</h2>
    <form action="{{ route('people.update', $Person->id) }}" method="POST" class="pb-5">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit-person-id" name="person_id">
        <div class="form-group">
            <label for="edit-name">Name:</label>
            <input type="text" class="form-control" id="edit-name" name="name">
        </div>
        <div class="form-group">
            <label for="edit-lname">Last Name:</label>
            <input type="text" class="form-control" id="edit-lname" name="lname">
        </div>
        <div class="form-group">
            <label for="edit-email">Email:</label>
            <input type="text" class="form-control" id="edit-email" name="email">
        </div>
        <button type="submit">Save</button>
        <button type="button" onclick="cancelEdit()">Cancel</button>
    </form>
</div>

<script>
    function editPerson(button) {
        const editButton = button;
        const row = editButton.parentNode.parentNode;
        const id = row.querySelector('button.edit-button').getAttribute('data-id');
        const name = row.querySelector('td:nth-child(1)').textContent.trim();
        const lname = row.querySelector('td:nth-child(2)').textContent.trim();
        const email = row.querySelector('td:nth-child(3)').textContent.trim();

        // Set the values in the edit form
        document.getElementById('edit-person-id').value = id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-lname').value = lname;
        document.getElementById('edit-email').value = email;

        // show the edit form

        document.getElementById('edit-form').style.display = 'block';
    }

    function cancelEdit() {
        const editForm = document.getElementById('edit-form');
        const row = editForm.previousElementSibling;
        row.style.display = '';
        editForm.style.display = 'none';
    }
</script>

@endif

