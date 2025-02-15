@extends('layout.adminLayout')

@section('content')
        <style>
            .th{
                color:white;
            }

            .bg-gradient-primary {
                background: linear-gradient(45deg, #007bff, #0056b3);
            }
            .table {
                border-radius: 10px;
                overflow: hidden;
            }
            .avatar {
                transition: transform 0.3s ease-in-out;
            }
            .avatar:hover {
                transform: scale(1.1);
            }
            .delete-btn:hover {
                background-color: #dc3545 !important;
                color: white !important;
            }
        </style>

    <div class="container mt-5">
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
                <h3 class="text-primary">Doctors List</h3>
                <a href="{{ route('doctors.update') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Add Doctor
                </a>
            </div>
   
    <table class="table table-hover table-bordered align-middle text-center shadow-lg">
        <thead class="bg-gradient-primary text-white">
            <tr class ="th">
                <th scope="col">#</th>
                <th scope="col">Profile</th>
                <th scope="col">Name</th>
                <th scope="col">Specialization</th>
                <th scope="col">Contact</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-light">
            @foreach ($doctors as $index => $doctor)
            <tr>
                <td class="fw-bold">{{ $index + 1 }}</td>
                <td>
                    <img src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" 
                         class="avatar avatar-sm rounded-circle border border-primary" width="50">
                </td>
                <td class="text-primary fw-semibold">{{ $doctor->user->name }}</td>
                <td class="text-success">{{ $doctor->specialization }}</td>
                <td class="text-muted">{{ $doctor->contact }}</td>
                <td>
                    <a href="{{ route('doctors.update', $doctor->id) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger delete-btn">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection
