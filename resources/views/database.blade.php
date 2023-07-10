@extends('/components/layout')



@section('content')

@include('add-user')

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


@endif


@include('edit-form')

@endsection


