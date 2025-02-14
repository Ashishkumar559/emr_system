@extends('layout.doctorLayout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white text-center py-3">
            <h4 class="mb-0 fw-bold">👨‍⚕️ Doctor Dashboard</h4>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="text-primary">Diagnoses List</h3>
               
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                           
                            <th>Specialization</th>
                            <th>Diagnosis</th>
                            <th>Symptoms</th>
                            <th>Contact</th>
                            <th>Blood Group</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patientsWithDoctors as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                           
                            <td>{{ $data->specialization }}</td>
                            <td>{{ $data->diagnosis }}</td>
                            <td>{{ $data->symptoms }}</td>
                            <td>{{ $data->contact }}</td>
                            <td>{{ $data->blood_group }}</td>
                            <td>{{ $data->address }}</td>
                            <td>
                                <a href="{{ route('diagnoses.update', $data->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <form action="{{ route('diagnoses.destroy', $data->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- End table-responsive -->
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
    .table thead th {
        white-space: nowrap;
    }
</style>
@endsection
