<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $projects = Project::with('employee')->get();
        return view('admin.dashboard', compact('projects'));
    }

    public function employeeDashboard()
    {
        $employe_id = Auth()->user()->id;
        $projects = Project::where('employee_id', $employe_id)->with('employee')->get();
        return view('employee.dashboard', compact('projects'));
    }
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Delete associated document
        if ($project->document) {
            Storage::delete($project->document);
        }

        $project->delete();

        return redirect()->route('dashboard')->with('success', 'Project deleted successfully.');
    }
    //admin project Create
    public function ProjectCreate()
    {
        $users = User::where('role', 'employee')->get();
        return view('admin.projects.create', compact('users'));
    }
    public function ProjectStore(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'service_required' => 'required|string|max:255',
            'start_date' => 'required|date',
            'completion_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:started,in_progress,completed',
            'document' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $documentPath = $request->file('document')->store('documents', 'public');

        Project::create([
            'employee_id' => $request->employee_id,
            'company_name' => $request->company_name,
            'service_required' => $request->service_required,
            'start_date' => $request->start_date,
            'completion_date' => $request->completion_date,
            'status' => $request->status,
            'document' => $documentPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Project created successfully.');
    }
}
