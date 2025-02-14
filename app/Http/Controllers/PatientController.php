<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Patient;
use App\Models\Treatment;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Diagnosis;

class PatientController extends Controller
{
//     public function get_list(){
//         $patients = Patient::join('users', 'users.id', '=', 'patients.user_id')
//         ->select('patients.*', 'users.name as user_name')
//         ->paginate(10); 
 
//         return view('admin.patient', compact('patients'));
//     }

//     public function editpatients(Request $request, $id = null)
//         {
    
//                 $patients = null;

//                 if ($id) {
//                     // Fetch doctor details if ID exists (Edit Mode)
//                     $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')
//                         ->select('patients.*', 'users.name as user_name', 'users.email as user_email')
//                         ->findOrFail($id);
//                 }

//                 return view('admin.manage_patients', compact('patients'));

//         }




// public function updatespatients(Request $request, $id)
// {
//     // Find the patient
//     $patient = Patient::findOrFail($id);

//     // Check if the patient has a related user
//     if (!$patient->user) {
//         return redirect()->route('manage.patient')->with('error', 'User not found for this patient.');
//     }

//     // Validate the request
//     $request->validate([
//         'name' => ['required', 'string', 'max:255'],
//         'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($patient->user->id)],
//         'password' => ['sometimes', 'nullable', 'string', 'min:6'],
//         'dob' => ['required', 'date'],
//         'gender' => ['required', 'in:male,female,other'],
//         'blood_group' => ['required', 'string', 'max:5'],
//         'contact' => ['required', 'string', 'regex:/^[0-9]{10}$/'],
//         'address' => ['required', 'string', 'max:500'],
//     ]);

//     // Update user details
//     $patient->user->update([
//         'name' => $request->name,
//         'email' => $request->email,
//     ]);

//     // If password is provided, update it
//     if ($request->filled('password')) {
//         $patient->user->update([
//             'password' => bcrypt($request->password),
//         ]);
//     }

//     // Update patient details
//     $patient->update([
//         'dob' => $request->dob,
//         'gender' => $request->gender,
//         'blood_group' => $request->blood_group,
//         'contact' => $request->contact,
//         'address' => $request->address,
//     ]);

//     return redirect()->route('manage.patient')->with('success', 'Patient updated successfully.');
// }



// public function createpatients(Request $request)
// {
//     // Validate input data
//     $request->validate([
//         'name' => ['required', 'string', 'max:255'],
//         'email' => ['required', 'email', 'unique:users,email'],
//         'dob' => ['required', 'date'],
//         'gender' => ['required', 'in:male,female,other'],
//         'blood_group' => ['required', 'string', 'max:5'],
//         'contact' => ['required', 'string', 'regex:/^[0-9]{10}$/'],
//         'address' => ['required', 'string', 'max:500'],
//     ]);

   
//         // Begin Transaction
     

//         // Create user
//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//         ]);

//         $patient = Patient::create([
//             'user_id' => $user->id,
//             'dob' => $request->dob,
//             'gender' => $request->gender,
//             'blood_group' => $request->blood_group,
//             'contact' => $request->contact,
//             'address' => $request->address,
//         ]);

       

//         return redirect()->route('manage.patient')->with('success', 'Patient added successfully.');
    
// }
    public function treatment_dashboard(Request $request){
        
  
            $treatment = Treatment::get();
 
            return view('patient.treatment', compact('treatment'));
    
    
        
            }

    public function diagnosis_dashboard(Request $request){

        $patientsWithDoctors = Treatment::get();
       
        return view('patient.diagnoses', compact('patientsWithDoctors'));

        }
        
    
}