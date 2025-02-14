@extends('layout.adminLayout')

@section('content')
  

    <div class="container mt-5">
   
    <div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white text-center py-3">The PUT method is not supported for route doctors/1/edit. Supported methods: GET, HEAD.
            <h4 class="mb-0 fw-bold">✏️ Edit Doctor</h4>
        </div>
        <div class="card-body">
       
        <form action="{{ isset($patients) ? route('patients.updatesubmit', $patients->id) : route('patients.add') }}" method="POST">
    @csrf
    @if(isset($patients))
        @method('PUT')
    @endif

  
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $patients->user->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $patients->user->email ?? '') }}" {{ isset($patients)}} required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

   
    @if(!isset($patients))
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @endif

  
    <div class="mb-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob', $patients->dob ?? '') }}" required>
        @error('dob')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    
    <div class="mb-3">
        <label class="form-label">Gender</label>
        <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
            <option value="male" {{ old('gender', $patients->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $patients->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender', $patients->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
        </select>
        @error('gender')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-3">
        <label class="form-label">Blood Group</label>
        <input type="text" name="blood_group" class="form-control @error('blood_group') is-invalid @enderror" value="{{ old('blood_group', $patients->blood_group ?? '') }}" required>
        @error('blood_group')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

 
    <div class="mb-3">
        <label class="form-label">Contact</label>
        <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror" value="{{ old('contact', $patients->contact ?? '') }}" required>
        @error('contact')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

 
    <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $patients->address ?? '') }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

   
    <button type="submit" class="btn btn-primary">{{ isset($patients) ? 'Update Patient' : 'Add Patient' }}</button>
</form>
    </div>
</div>


<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('profilePreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
</style>
</div>


@endsection
