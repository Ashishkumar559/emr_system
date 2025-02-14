@extends('layout.doctorLayout')

@section('content')
   

    <div class="container mt-5">
   
    <div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white text-center py-3">The PUT method is not supported for route doctors/1/edit. Supported methods: GET, HEAD.
            <h4 class="mb-0 fw-bold">✏️ Edit Doctor</h4>
        </div>
        <div class="card-body">
       
    <form action="{{ isset($doctor) ? route('doctors.updatesubmit', $doctor->id) : route('doctors.add') }}" method="POST">
            @csrf
            @if(isset($doctor))
                @method('POST')
            @endif

            <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->user_name ?? '') }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->user_email ?? '') }}" {{ isset($doctor) ? 'readonly' : '' }} required>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    @if(!isset($doctor))
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Specialization</label>
        <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $doctor->specialization ?? '') }}" required>
        @error('specialization')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Contact</label>
        <input type="text" name="contact" class="form-control" value="{{ old('contact', $doctor->contact ?? '') }}" required>
        @error('contact')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">{{ isset($doctor) ? 'Update Doctor' : 'Add Doctor' }}</button>
    </form>


        </div>
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
