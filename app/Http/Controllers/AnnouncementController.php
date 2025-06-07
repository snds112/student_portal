<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AnnouncementController extends Controller
{
    
    public function index($dept = 'general')
    {
        
        $validDepartments = ['general', 'computer_science', 'maths', 'physics', 'chemistry'];

        if (!in_array($dept, $validDepartments)) {
            abort(404); 
        }

        
        $announcements = Announcements::where('dept', $dept)
            ->orderBy('created_at', 'desc')
            ->get();

       
        return view('admin.announcements.index', [
            'announcements' => $announcements,
            'department' => $dept
        ]);
    }
    public function create()
    {
        return view('admin.announcements.create');
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string|max:500',
            'dept' => 'required|in:general,computer_science,maths,physics,chemistry'
        ]);

        
        if (auth('admin')->check()) {
            $validated['admin_id'] = auth('admin')->id();
        }

        Announcements::create($validated);

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement created successfully!');
    }
    public function edit(Announcements $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:500',
            'dept' => 'required|in:general,computer_science,maths,physics,chemistry'
        ]);

        $affectedRows = Announcements::where('id', $id)->update($validated);

        if ($affectedRows === 0) {
            Log::error('Failed to update announcement', ['id' => $id]);
            return back()->with('error', 'Failed to update announcement');
        }

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement updated successfully');
    }
    public function destroy($id)
    {
        
            $announcement = Announcements::findOrFail($id);
          

            $announcement->delete();

            return redirect()->route('announcements.index')
                ->with('success', 'Announcement deleted successfully!');
       
    }
}
