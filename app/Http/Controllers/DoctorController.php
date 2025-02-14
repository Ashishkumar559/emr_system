<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Diagnosis;
use App\Models\Patient;


class DoctorController extends Controller

{


    public function edittreatment(Request $request,$id = null){
        
        $treatment = null;

        $get_diagnosis = Diagnosis::join('users', 'diagnoses.patient_id', '=', 'users.id')
        ->select(['diagnoses.id', 'users.name'])
        ->get();

    
        $get_doctor = Doctor::join('users', 'doctors.user_id', '=', 'users.id')
            ->select(['doctors.id', 'users.name'])
            ->get();

       
        if ($id) {
            $treatment = Treatment::findOrFail($id);
        }

        return view('doctor.manage_treatment', compact('treatment', 'get_doctor', 'get_diagnosis'));
    }

    public function get_treatment_list (Request $request){

    $treatment = Treatment::get();
 
        return view('doctor.treatment', compact('treatment'));
    }

    // ;;asdfasdftreat

        public function doctor_dashboard(Request $request){


            $patientsWithDoctors = DB::table('diagnoses')
            ->join('doctors', 'diagnoses.doctor_id', '=', 'doctors.id')
            ->join('patients', 'diagnoses.patient_id', '=', 'patients.id')
            ->join('users as doctor_users', 'doctors.user_id', '=', 'doctor_users.id') 
            ->join('users as patient_users', 'patients.user_id', '=', 'patient_users.id') 
            ->get();
    
            return view('doctor.diagnoses', compact('patientsWithDoctors'));
            
        }

        public function editdiagnoses(Request $request, $id = null)
        {
    
                $record = null;
               
                $get_patient = Patient::join('users', 'patients.user_id', '=', 'users.id')
                    ->select(['patients.id', 'users.name'])
                    ->get();

                
                $get_doctor = Doctor::join('users', 'doctors.user_id', '=', 'users.id')
                    ->select(['doctors.id', 'users.name'])
                    ->get();



                if ($id) {
                    $record = DB::table('diagnoses')
                    ->join('doctors', 'diagnoses.doctor_id', '=', 'doctors.id')
                    ->join('patients', 'diagnoses.patient_id', '=', 'patients.id')
                    
                    ->where('diagnoses.id', $id) // Specify 'diagnoses.id' explicitly
                    
                    ->get(); // Use first() instead of get() if expecting a single record
                
             
                }

                return view('doctor.manage_diagnoses', compact('record', 'get_patient', 'get_doctor'));

        // }manage_diagnoses.blade
            }

        public function index()
        {
            $doctors = Doctor::with('user')->get(); // Fix relationship
            return view('admin.doctors', compact('doctors'));
        }
    
 
        public function create()
        {
            return view('doctors.create');
        }
    
    
        // public function store(Request $request)
        // {
        //     $request->validate([
        //         'name' => 'required|string|max:255',
        //         'email' => 'required|email|unique:users,email',
        //         'password' => 'required|string|min:8',
        //         'specialization' => 'required|string|max:255',
        //         'contact' => 'required|string|max:20',
        //     ]);
    
        //     // Create user
        //     $user = User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => bcrypt($request->password),
        //         'role' => 'doctor',
        //     ]);
    
        //     // Create doctor
        //     Doctor::create([
        //         'user_id' => $user->id,
        //         'specialization' => $request->specialization,
        //         'contact' => $request->contact,
        //     ]);
    
        //     return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
        // }



    public function updatesdiagnoses(Request $request, $id)
    {

        $request->validate([
            'specialization' => 'required|string|max:255',
            'diagnosis' => 'required|string|max:255',
            'symptoms' => 'required|string',
            'contact' => 'required|string|max:15',
            'blood_group' => 'required|string|max:10',
            'address' => 'required|string',
        ]);
        // dd("dsfds");


    
        $diagnosis = Diagnosis::find($id);

        if (!$diagnosis) {
            return redirect()->route('doctor.dashboard')->with('error', 'Record not found!');
        
        }
        $diagnosis->update([
            'specialization' => $request->specialization,
            'diagnosis' => $request->diagnosis,
            'symptoms' => $request->symptoms,
            'contact' => $request->contact,
            'blood_group' => $request->blood_group,
            'address' => $request->address,
        ]);

        return redirect()->route('doctor.dashboard')->with('success', 'Diagnosis updated successfully!');
        
    }


    public function createDiagnoses(Request $request)
    {
        
        $request->validate([
        
            'diagnosis' => 'required|string|max:255',
            'symptoms' => 'required|string',
            'patient_id' =>'required',
            'doctor_id' => 'required',
            'blood_group' => 'required|string|max:10',
            'address' => 'required|string',
        ]);

    
        $diagnosis = Diagnosis::create([
        
            'diagnosis' => $request->diagnosis,
            'symptoms' => $request->symptoms,
            'doctor_id' =>$request->doctor_id,
            'patient_id' =>$request->patient_id,
        
        ]);

        return redirect()->route('doctor.dashboard')->with('success', 'Diagnosis created successfully!');
    }
    
      
        public function show(Doctor $doctor)
        {
            return view('doctors.show', compact('doctor'));
        }
    

        public function create_doctor(Request $request){
            dd("adfasfd");
        }

}
