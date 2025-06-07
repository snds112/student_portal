<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function Psy\debug;

class ProjectsController extends Controller
{
    
    public function index()
    {
    
        $projects = Project::orderBy('created_at', 'desc')->get();
       
        return view('admin.projects.index', [
            'projects' => $projects
            
        ]);
    }
    public function create()
    {
        return view('admin.projects.create');
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
           
        ]);

        
        if (auth('admin')->check()) {
            $validated['admin_id'] = auth('admin')->id();
        }

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }
    public function edit(Project $project)
    {
       
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
          $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
           
        ]);


        $affectedRows = Project::where('id', $id)->update($validated);

        if ($affectedRows === 0) {
            Log::error('Failed to update project', ['id' => $id]);
            return back()->with('error', 'Failed to update project');
        }

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }
    public function destroy($id)
    {
        
            $project = Project::findOrFail($id);
          

            $project->delete();

            return redirect()->route('projects.index')
                ->with('success', 'Project deleted successfully!');
       
    }
}
