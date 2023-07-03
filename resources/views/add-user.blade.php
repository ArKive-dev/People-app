
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

