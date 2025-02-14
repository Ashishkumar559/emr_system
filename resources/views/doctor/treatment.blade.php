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

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="text-primary">Tritment List</h3>
                <a href="{{ route('treatment.update') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Add Tritment
                </a>
            </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Treatment plan</th>
                        <th>medications</th>
                        <th>follow_up_instructions</th>
                        <!-- <th>Diagnosis</th>
                        <th>Symptoms</th>
                        <th>Contact</th>
                        <th>Blood Group</th>
                        <th>Address</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($treatment as $data)
                    <tr>
                        <td>{{ $data->treatment_plan }}</td>
                        <td>{{ $data->medications }}</td>
                        <td>{{ $data->follow_up_instructions }}</td>
                        <!-- <td>{{ $data->specialization }}</td>
                        <td>{{ $data->diagnosis }}</td>
                        <td>{{ $data->symptoms }}</td>
                        <td>{{ $data->contact }}</td>
                        <td>{{ $data->blood_group }}</td>
                        <td>{{ $data->address }}</td> -->
                        <td>
                            <a href="{{ route('treatment.update', $data->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                          
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
</style>
@endsection
