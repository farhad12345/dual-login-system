<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Display a listing of the projects
    public function index()
    {
        $projects = Project::with('employee')->get();
        return view('projects.index', compact('projects'));
    }

    // Show the form for creating a new project
    public function create()
    {
        return view('projects.create');
    }

    // Store a newly created project in storage
    public function store(Request $request)
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

        return redirect()->route('employee.dashboard')->with('success', 'Project created successfully.');
    }

    // Display the specified project
    public function show($id)
    {
        $project = Project::with('employee')->findOrFail($id);
        return view('projects.show', compact('project'));
    }

    // Show the form for editing the specified project
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    // Update the specified project in storage
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'service_required' => 'required|string|max:255',
            'start_date' => 'required|date',
            'completion_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:started,in_progress,completed',
            'document' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        if ($request->hasFile('document')) {
            // Delete old document
            if ($project->document) {
                Storage::delete($project->document);
            }
            $documentPath = $request->file('document')->store('documents');
            $project->document = $documentPath;
        }

        $project->update([
            'company_name' => $request->company_name,
            'service_required' => $request->service_required,
            'start_date' => $request->start_date,
            'completion_date' => $request->completion_date,
            'status' => $request->status,
        ]);

        return redirect()->route('employee.dashboard')->with('success', 'Project updated successfully.');
    }

    // Remove the specified project from storage
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Delete associated document
        if ($project->document) {
            Storage::delete($project->document);
        }

        $project->delete();

        return redirect()->route('employee.dashboard')->with('success', 'Project deleted successfully.');
    }
}
