<!DOCTYPE html>
<html>
<head>
    <title>Patient History</title>
</head>
<body>
    <h1>Patient History</h1>
    <p><strong>Name:</strong> {{ $patientHistory->user->name }}</p>
    <p><strong>DOB:</strong> {{ $patientHistory->dob }}</p>
    <p><strong>Gender:</strong> {{ $patientHistory->gender }}</p>
    <p><strong>Blood Group:</strong> {{ $patientHistory->blood_group }}</p>

    <h2>Diagnoses</h2>
    @foreach($patientHistory->diagnoses as $diagnosis)
        <p><strong>Diagnosis:</strong> {{ $diagnosis->diagnosis }}</p>
        <p><strong>Symptoms:</strong> {{ $diagnosis->symptoms }}</p>
        <p><strong>Doctor:</strong> {{ $diagnosis->doctor->user->name }}</p>

        <h3>Treatments</h3>
        @foreach($diagnosis->treatments as $treatment)
            <p><strong>Treatment Plan:</strong> {{ $treatment->treatment_plan }}</p>
            <p><strong>Medications:</strong> {{ $treatment->medications }}</p>
            <p><strong>Follow-up Instructions:</strong> {{ $treatment->follow_up_instructions }}</p>
        @endforeach
        <hr>
    @endforeach
</body>
</html>