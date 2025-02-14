<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
  
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'type' => 'required|in:admin,doctor,patient'
        ]);
    
        $user = User::where('email', $request->email)
                    ->where('role', $request->type)
                    ->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'User not found or role mismatch']);
        }
        
      
        if ($user->password === $request->password) {
            Auth::login($user);
        
            if ($user->role === 'admin') {
                return redirect(url('/admin/dashboard'));
            } elseif ($user->role === 'doctor') {
                return redirect(url('/doctor/dashboard'));
            } elseif ($user->role === 'patient') {
                return redirect(url('/patient/dashboard'));
            }
        }
        
        
            return back()->withErrors(['password' => 'Invalid password']);
    }

}
