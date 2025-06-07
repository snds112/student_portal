<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class WishlistsController extends Controller
{
    
    public function index()
    {
        
        $student = Student::find(Auth::id());
        $projects = $student->wishlistProjects;
        return view('student.wishlists.index', [
            'projects' => $projects
            
        ]);
    }
   

    public function edit()
    {
        $student = Student::find(Auth::id());
        $selectedProjects = $student->wishlistProjects;
        $projects = Project::whereNotIn('id', $selectedProjects->pluck('id'))
    ->orderBy('created_at', 'desc')
    ->get();
        return view('student.wishlists.edit', compact('projects','selectedProjects'));
    }

    public function update(Request $request)
{
    $selectedProjects = json_decode($request->input('selected_projects'), true);

     $student = Student::find(Auth::id());
     $student->wishlistProjects()->sync($selectedProjects);
    

    return redirect()->route('wishlists.index')->with('success', 'Wishlist updated.');
}


    
}
