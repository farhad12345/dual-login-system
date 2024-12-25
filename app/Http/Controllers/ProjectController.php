<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ProjectCreatedNotification;

class ProjectController extends Controller
{
    // Display a listing of the projects
    public function index()
    {
        $employe_id = Auth()->user()->id;
        $projects = Project::where('employee_id', $employe_id)->with('employee')->get();
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
            // 'completion_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:started,in_progress,completed',
            // 'document' => 'required|file|mimes:pdf,doc,docx',
        ]);
   // Initialize the document path as null
      $documentPath = null;
    // Check if the document file is uploaded
    if ($request->hasFile('document')) {
        $documentFile = $request->file('document');
        $documentPath = $documentFile->getClientOriginalName(); // Get original file name
        $destinationPath = public_path('uploads/documents'); // Target directory
        // Ensure directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        // Move file to target directory
        $documentFile->move($destinationPath, $documentPath);
        // Set the relative path for saving
        $documentPath = 'uploads/documents/' . $documentPath;
    }

    // Save project data into the database
    $project = Project::create([
        'employee_id' => $request->employee_id,
        'company_name' => $request->company_name,
        'service_required' => $request->service_required,
        'start_date' => $request->start_date,
        'days' => $request->days,
        'status' => $request->status,
        'person_name' => $request->person_name,
        'service_type' => $request->service_type,
        'city'=>$request->city,
        'email' => $request->email,
        'ministry' => $request->ministry,
        'country'=>$request->country,
        'person_contact' => $request->person_contact,
        'business_type'=>$request->business_type,
        'commertial_register'=>$request->commertial_register,
        'document' => $documentPath, // Save relative path or null if no file
    ]);

         // Send email to admin
         $user = User::where('role','admin')->first();
          Mail::to($user->email)->send(new ProjectCreatedNotification($project->toArray()));
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
        // Find the project
        $project = Project::findOrFail($id);

        // Validate the request data
        $request->validate([
            'company_name' => 'required|string|max:255',
            'service_required' => 'required|string|max:255',
            'start_date' => 'required|date',
            // 'completion_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:started,in_progress,completed',
            // 'document' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        try {
            // Handle file upload if a new document is provided
            if ($request->hasFile('document')) {
                $documentFile = $request->file('document');
                $documentPath = $documentFile->getClientOriginalName(); // Get the original file name
                $destinationPath = public_path('uploads/documents'); // Target directory

                // Ensure directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Move file to target directory
                $documentFile->move($destinationPath, $documentPath);

                // Delete old document if it exists
                if ($project->document && file_exists(public_path($project->document))) {
                    unlink(public_path($project->document));
                }

                // Set new document path
                $project->document = 'uploads/documents/' . $documentPath;
            }

            // Update other fields safely
            $project->update([
                'employee_id' => $request->employee_id,
                'company_name' => $request->company_name,
                'service_required' => $request->service_required,
                'start_date' => $request->start_date,
                'completion_date' => $request->completion_date,
                'status' => $request->status,
                'person_name' => $request->person_name,
                'service_type' => $request->service_type,
                'person_contact' => $request->person_contact,
                'city' => $request->city,
                'email' => $request->email,
                'country'=>$request->country,
                'ministry' => $request->ministry,
                'business_type'=>$request->business_type,
                'commertial_register'=>$request->commertial_register,
            ]);

            return redirect()->route('employee.dashboard')->with('success', 'Project updated successfully.');

        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error during project update: ' . $e->getMessage());

            return redirect()->route('employee.dashboard')->with('error', 'Failed to update the project.');
        }
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
