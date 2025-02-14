@extends('layout.adminLayout')

@section('content')

<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Patient History</h1>

    @if(isset($patientHistory) && count($patientHistory) > 0)
        <div class="card shadow-lg p-4">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Blood Group</th>
                        <th>Diagnosis</th>
                        <th>Symptoms</th>
                        <th>Doctor</th>
                        <th>Treatment Plan</th>
                        <th>Medications</th>
                        <th>Follow-up</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patientHistory as $patient)
                        @php
                            $patientDiagnosis = $diagnosis->where('patient_id', $patient->id)->first();
                            $patientTreatment = $treatment->where('patient_id', $patient->id)->first();
                        @endphp
                        <tr>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->dob }}</td>
                            <td>{{ ucfirst($patient->gender) }}</td>
                            <td>{{ $patient->blood_group }}</td>
                            <td>{{ $patientDiagnosis->diagnosis ?? 'N/A' }}</td>
                            <td>{{ $patientDiagnosis->symptoms ?? 'N/A' }}</td>
                            <td>{{ $patientDiagnosis->doctor_name ?? 'N/A' }}</td>
                            <td>{{ $patientTreatment->treatment_plan ?? 'N/A' }}</td>
                            <td>{{ $patientTreatment->medications ?? 'N/A' }}</td>
                            <td>{{ $patientTreatment->follow_up_instructions ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center">No patient history found.</div>
    @endif
</div>

@endsection
