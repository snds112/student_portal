<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    
    public function index()
    {
        $account = Student::find(Auth::id());
       
       
        return view('student.info', [
            'account' => $account
        ]);
    }
    




   
  
    
   
}
