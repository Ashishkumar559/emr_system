@extends('layout.adminLayout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white text-center py-3">
            <h4 class="mb-0 fw-bold">{{ isset($record) ? '✏️ Edit Record' : '➕ Add Record' }}</h4>
        </div>
        <div class="card-body">

          
        <form action="{{ isset($record) && count($record) > 0 ? route('diagnoses.updatesubmit', $record[0]->id) : route('diagnoses.add') }}" method="POST">

                @csrf
                @if(isset($record))
                    @method('PUT') 
                @endif

                <label class="form-label">Patient</label>
                <select name="patient_id" class="form-control" required>
                    <option value="">Select Patient</option>
                    @foreach($get_doctor as $patient)
                        <option value="{{ $patient->id }}" 
                            {{ old('patient_id', $record->patient_id ?? '') == $patient->id ? 'selected' : '' }}>
                            {{ $patient->name }}
                        </option>
                    @endforeach
                </select>

                <label class="form-label">Doctor</label>
                <select name="doctor_id" class="form-control" required>
                    <option value="">Select Doctor</option>
                    @foreach($get_diagnosis as $doctor)
                        <option value="{{ $doctor->id }}" 
                            {{ old('doctor_id', $record->doctor_id ?? '') == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>

                <div class="mb-3">
                    <label class="form-label">Specialization</label>
                    <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $record[0]->specialization ?? '') }}" required>
                    @error('specialization')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Diagnosis</label>
                    <input type="text" name="diagnosis" class="form-control" value="{{ old('diagnosis', $record[0]->diagnosis ?? '') }}" required>
                    @error('diagnosis')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Symptoms</label>
                    <textarea name="symptoms" class="form-control" required>{{ old('symptoms', $record[0]->symptoms ?? '') }}</textarea>
                    @error('symptoms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact</label>
                    <input type="text" name="contact" class="form-control" value="{{ old('contact', $record[0]->contact ?? '') }}" required>
                    @error('contact')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Blood Group</label>
                    <input type="text" name="blood_group" class="form-control" value="{{ old('blood_group', $record[0]->blood_group ?? '') }}" required>
                    @error('blood_group')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" required>{{ old('address', $record[0]->address ?? '') }}</textarea>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($record[0]) ? 'Update Record' : 'Add Record' }}</button>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
</style>
@endsection
