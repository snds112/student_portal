<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Project;
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


    public function list_students()
    {
        $accounts = Student::all();


        return view('admin.students.list', [
            'accounts' => $accounts
        ]);
    }

    public function single_student($id)
    {
        $account = Student::find($id);
        
        $projects = $account->wishlistProjects;
       

        return view('admin.students.single', [
            'account' => $account,
            'projects' => $projects
        ]);
    }
}
