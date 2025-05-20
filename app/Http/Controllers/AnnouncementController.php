<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display announcements based on department
     */
    public function index($dept = 'general')
    {
        // Validate the department parameter
        $validDepartments = ['general', 'computer_science', 'maths', 'physics', 'chemistry'];
        
        if (!in_array($dept, $validDepartments)) {
            abort(404); // Return 404 if invalid department
        }

        // Get announcements for the specified department
        $announcements = Announcements::where('dept', $dept)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        // Pass to view with department name
        return view('announcements', [
            'announcements' => $announcements,
            'department' => $dept
        ]);
    }
}