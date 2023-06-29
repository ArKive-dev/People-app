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

<h1>Customers</h1>

<form action="customers" method="POST" class="pb-5">
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
  <button type="submit" class="btn btn-primary">Add Customer</button>
  @csrf
</form>
@if($Customers->isNotEmpty())
<table>
<thead>
        <tr>
            <th colspan="5">
                <div class="table-search">
                    <form class="d-flex" role="search" method="POST" action="{{ route('customers.search') }}">
                        @csrf
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
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
    @foreach ($Customers as $Customer)
    <tr>
      <td>
        <input type="text" name="name" value="{{ $Customer->name }}" disabled>
      </td>
      <td>
        <input type="text" name="lname" value="{{ $Customer->lname }}" disabled>
      </td>
      <td>
        <input type="text" name="email" value="{{ $Customer->email }}" disabled>
      </td>
      <td>
      <button onclick="editCustomer(this)" id="edit">Edit Customer</button>
      <form action="customers/{{ $Customer->id }}" method="POST" class="pb-5">
        @csrf @method('PUT')
        <button type="submit" id="save" style="display:none;">Save Customer</button> <!-- // Hidden button to save -->
        </form>
      </td>
      <td>
        <form action="customers/{{ $Customer->id }}" method="POST" class="pb-5">
        @csrf @method('DELETE')
        <button type="submit" class="">Delete Customer</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif


<script>
  function editCustomer(button) {

    const edit = document.getElementById('edit');
    edit.style.display = 'none'
    const save = document.getElementById('save');
    save.style.display  = 'block'
    const row = button.parentNode.parentNode;
    const inputs = row.querySelectorAll('input[type="text"]');
    inputs.forEach((input) => {
      input.disabled = !input.disabled;
    });
  }
</script>

@endsection
