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
        return view('wishlists.index', [
            'projects' => $projects
            
        ]);
    }
   




    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:100',
    //         'description' => 'required|string|max:500',
           
    //     ]);

        
    //     if (auth('admin')->check()) {
    //         $validated['admin_id'] = auth('admin')->id();
    //     }

    //     Project::create($validated);

    //     return redirect()->route('projects.index')
    //         ->with('success', 'Project created successfully!');
    // }
    public function edit()
    {
        $student = Student::find(Auth::id());
        $selectedProjects = $student->wishlistProjects;
        $projects = Project::whereNotIn('id', $selectedProjects->pluck('id'))
    ->orderBy('created_at', 'desc')
    ->get();
        return view('wishlists.edit', compact('projects','selectedProjects'));
    }

    public function update(Request $request)
{
    $selectedProjects = json_decode($request->input('selected_projects'), true);

     $student = Student::find(Auth::id());
     $student->wishlistProjects()->sync($selectedProjects);
    

    return redirect()->route('wishlists.index')->with('success', 'Wishlist updated.');
}


    // public function update(Request $request, $id)
    // {
    //       $validated = $request->validate([
    //         'title' => 'required|string|max:100',
    //         'description' => 'required|string|max:500',
           
    //     ]);


    //     $affectedRows = Project::where('id', $id)->update($validated);

    //     if ($affectedRows === 0) {
    //         Log::error('Failed to update project', ['id' => $id]);
    //         return back()->with('error', 'Failed to update project');
    //     }

    //     return redirect()->route('projects.index')
    //         ->with('success', 'Project updated successfully');
    // }
    // public function destroy($id)
    // {
        
    //         $project = Project::findOrFail($id);
          

    //         $project->delete();

    //         return redirect()->route('projects.index')
    //             ->with('success', 'Project deleted successfully!');
       
    // }
}
