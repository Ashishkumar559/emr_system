<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use App\Models\Treatment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Diagnosis;
use App\Models\Patient;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
  
        $doctors = Doctor::join('users', 'users.id', '=', 'doctors.user_id')
        ->select('doctors.*', 'users.name as user_name')
        ->paginate(10); 


        return view('admin.doctors', compact('doctors'));
    
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        if ($doctor->user) {
            $doctor->user->delete();
        }

        return redirect(url('/admin/dashboard'))->with('success', 'Doctor deleted successfully.');

    }

    public function editdoctors(Request $request, $id = null)
    {

            $doctor = null;

            if ($id) {
                $doctor = Doctor::join('users', 'doctors.user_id', '=', 'users.id')
                    ->select('doctors.*', 'users.name as user_name', 'users.email as user_email')
                    ->findOrFail($id);
            }

            return view('admin.manage_doctor', compact('doctor'));

    }

    public function updatesdoctor(Request $request, $id)
    {
  
        $doctor = Doctor::findOrFail($id);

        $request->validate([
         'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $doctor->user_id . ',id',
        'specialization' => 'required|string|max:255',
        'contact' => 'required|string|max:20',
        ]);
    
 
        $doctor->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);


        $doctor->update([
            'specialization' => $request->specialization,
            'contact' => $request->contact,
        ]);

        return redirect(url('/admin/dashboard'))->with('success', 'Doctor updated successfully.');
    }

    public function add(Request $request)
    {
     

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'specialization' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
        ]);
       
     
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'doctor',
        ]);
    
    
        $doctor = Doctor::create([
            'user_id' => $user->id,
            'specialization' => $request->specialization,
            'contact' => $request->contact,
        ]);
    
        return redirect(url('/admin/dashboard'))->with('success', 'Doctor created successfully.');
    }


    public function get_list()
    {
        $patients = Patient::join('users', 'users.id', '=', 'patients.user_id')
        ->select('patients.*', 'users.name as user_name')
        ->paginate(10); 
 
        return view('admin.patient', compact('patients'));
    }

    public function editpatients(Request $request, $id = null)
    {
    
        $patients = null;

        if ($id) {
        
            $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')
                ->select('patients.*', 'users.name as user_name', 'users.email as user_email')
                ->findOrFail($id);
        }

        return view('admin.manage_patients', compact('patients'));

    }

    public function updatespatients(Request $request, $id)
    {
    
        $patient = Patient::findOrFail($id);

        if (!$patient->user) {
            return redirect()->route('manage.patient')->with('error', 'User not found for this patient.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($patient->user->id)],
            'password' => ['sometimes', 'nullable', 'string', 'min:6'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'in:male,female,other'],
            'blood_group' => ['required', 'string', 'max:5'],
            'contact' => ['required', 'string', 'regex:/^[0-9]{10}$/'],
            'address' => ['required', 'string', 'max:500'],
        ]);

        $patient->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $patient->user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $patient->update([
            'dob' => $request->dob,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'contact' => $request->contact,
            'address' => $request->address,
        ]);

        return redirect()->route('manage.patient')->with('success', 'Patient updated successfully.');
    }



    public function createpatients(Request $request)
    {
    
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'dob' => ['required', 'date'],
            'password' => ['required'],
            'gender' => ['required', 'in:male,female,other'],
            'blood_group' => ['required', 'string', 'max:5'],
            'contact' => ['required', 'string', 'regex:/^[0-9]{10}$/'],
            'address' => ['required', 'string', 'max:500'],
        ]);

    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'patient',
            ]);

            $patient = Patient::create([
                'user_id' => $user->id,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'blood_group' => $request->blood_group,
                'contact' => $request->contact,
                'address' => $request->address,
            ]);

        

            return redirect()->route('manage.patient')->with('success', 'Patient added successfully.');
        
    }

    public function past_history(Request $request){
       
       
        $patientHistory = Patient::all(); 
        $diagnosis = Diagnosis::all();
        $treatment = Treatment::all();
                                       
            return view('admin.past_history', compact('patientHistory','diagnosis','treatment'));

    }





    
    // public function downloadPDF()
    // {
        
        // $data = DB::table('patients')
    // ->join('users as patient_user', 'patients.user_id', '=', 'patient_user.id') // Get patient name
    // ->leftJoin('diagnoses', 'patients.id', '=', 'diagnoses.patient_id')
    // ->leftJoin('doctors', 'diagnoses.doctor_id', '=', 'doctors.id')
    // ->leftJoin('users as doctor_user', 'doctors.user_id', '=', 'doctor_user.id') // Get doctor name
    // ->leftJoin('treatments', 'diagnoses.id', '=', 'treatments.diagnosis_id') // Correct way to join treatments
    // ->leftJoin('allergies', 'patients.id', '=', 'allergies.patient_id') // Optional allergy data
    // ->select(
        // 'patient_user.name as patient_name',
        // 'patients.dob',
        // 'patients.gender',
        // 'patients.blood_group',
        // 'diagnoses.diagnosis',
        // 'diagnoses.symptoms',
        // 'doctor_user.name as doctor_name',
        // 'treatments.treatment_plan',
        // 'treatments.medications',
        // 'treatments.follow_up_instructions',
        // DB::raw('GROUP_CONCAT(allergies.allergy_name) as allergies') // Fetch allergies as a comma-separated string
    // )
    // ->groupBy(
        // 'patient_user.name', 'patients.dob', 'patients.gender', 'patients.blood_group',
        // 'diagnoses.diagnosis', 'diagnoses.symptoms', 'doctor_user.name',
        // 'treatments.treatment_plan', 'treatments.medications', 'treatments.follow_up_instructions'
    // )
    // ->first(); // Fetch only one recor
    // 
        // if (!$data) {
            // return redirect()->back()->with('error', 'No patient history found.');
        // }
    // 
        // $pdf = Pdf::loadView('patient_history', compact('data'));
        // return $pdf->download('patient_history.pdf');
    // }
    
   









}
