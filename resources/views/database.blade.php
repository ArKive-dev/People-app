@extends('/components/layout')

@section('content')

<style>
  table {
    width: 100%;
    border-collapse: collapse;
  }

  th,
  td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
  }

  /* Button styles */
  button {
    padding: 6px 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
  }

  button:hover {
    background-color: #45a049;
  }
</style>

<h1>People</h1>

<form action="{{ route('people.store') }}" method="POST" class="pb-5">
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="lname">Last Name</label>
    <input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname">
    @error('lname')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="email">E-Mail:</label>
    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Add Person</button>
  @csrf
</form>

@if($People->isNotEmpty())
<table>
<thead>
<tr>
  <th colspan="5">
    <div class="table-search">
      <form class="d-flex" role="search" method="POST" action="{{ route('people.search') }}">
        @csrf
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        <a href="{{ route('database') }}" class="btn btn-outline-secondary">Clear</a>
      </form>
    </div>
  </th>
</tr>
<tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>
</thead>

<tbody>
@foreach ($People as $Person)
<tr>
    <td>{{ $Person->name }}</td>
    <td>{{ $Person->lname }}</td>
    <td>{{ $Person->email }}</td>
    <td>
        <button onclick="editPerson(this)" data-id="{{ $Person->id }}" class="edit-button">Edit Person</button>
    </td>
    <td>
        <form action="{{ route('people.destroy', $Person->id) }}" method="POST" class="pb-5">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Person</button>
        </form>
    </td>
</tr>
@endforeach
{{ $People->links('pagination::bootstrap-4') }}

</tbody>
</table>

<!-- Form for editing a person -->
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

@endsection
