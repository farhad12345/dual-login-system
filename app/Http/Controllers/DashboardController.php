<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Mail\ProjectCreatedNotification;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        //  $users = User::where('role','employee')->get();
        // $users = User::where('role', 'employee')
        // ->leftJoin('projects', 'users.id', '=', 'projects.employee_id')
        // ->select('users.*', \DB::raw('MAX(projects.created_at) as latest_project'))
        // ->groupBy('users.id')
        // ->orderByDesc('latest_project') // Order by the latest project date (NULL values go last)
        // ->with(['projects' => function ($query) {
        //     $query->latest('created_at')->limit(1); // Fetch the latest project for each user
        // }])
        // ->get();

        $projects = Project::with('employee')
        ->select('projects.*', 'users.id as user_id', 'users.name as employee_name')
        ->leftJoin('users', 'projects.employee_id', '=', 'users.id')
        ->whereIn('projects.id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('projects')
                ->groupBy('projects.employee_id');
        })
        ->orderBy('projects.id', 'desc')
        ->paginate(10);

            return view('admin.dashboard', compact('projects'));
    }

    public function employeeDashboard()
    {

        $employe_id = Auth()->user()->id;
        $user = User::findOrFail($employe_id);
        if ($user->status !== 'accepted') {
            // Redirect to login page with an error message
            return redirect()->route('employee-login')->with('error', 'يرجى الانتظار حتى يتم الموافقة على حسابك من قبل المسؤول.');
        }
        $projects = Project::where('employee_id', $employe_id)->with('employee')
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('employee.dashboard', compact('projects'));
    }

    public function ViewProjects($id)
    {
        $projects = Project::where('employee_id', $id)->with('employee')
        ->orderBy('id', 'desc')
        ->paginate(8);
        return view('admin.projects.details',compact('projects'));
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
    public function UserDelete($id)
    {
        $project = User::findOrFail($id);
        $project->delete();

        return redirect()->route('dashboard')->with('success', 'تم حذف المستخدم بنجاح.');
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
            'days' => 'required',
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
        $project= Project::create([
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
            'person_contact' => $request->person_contact,
            'business_type'=>$request->business_type,
            'country'=>$request->country,
            'commertial_register'=>$request->commertial_register,
            'document' => $documentPath, // Save relative path or null if no file
        ]);
        $user = User::where('role','admin')->first();
        Mail::to($user->email)->send(new ProjectCreatedNotification($project->toArray()));
        return redirect()->route('dashboard')->with('success', 'تم إنشاء المشروع بنجاح.');
    }

    public function ProjectUpdate(Request $request, $id)
{
    // Find the project
    $project = Project::findOrFail($id);

    // Validate the request data
    $request->validate([
        'company_name' => 'required|string|max:255',
        'service_required' => 'required|string|max:255',
        'start_date' => 'required|date',
        'days' => 'required',
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
                'days' => $request->days,
                'email' => $request->email,
                'ministry' => $request->ministry,
                'country'=>$request->country,
                'business_type'=>$request->business_type,
                'commertial_register'=>$request->commertial_register,
        ]);

        return redirect()->route('dashboard')->with('success', 'تم تحديث المشروع بنجاح.');

    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error('Error during project update: ' . $e->getMessage());

        return redirect()->route('dashboard')->with('error', 'فشل في تحديث المشروع.');
    }
}
    public function ProjectEdit($id)
    {
        $project = Project::findOrFail($id);
        $users = User::where('role', 'employee','users')->get();
        return view('admin.projects.edit', compact('project','users'));
    }
    public function UpdateUserStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $user->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'تم تحديث حالة المستخدم بنجاح.');
    }



    public function CompanyDetails($id)
    {
        $projects = Project::where('employee_id', $id)->with('employee')->get();
        return view('admin.projects.companydetails',compact('projects'));
    }
    public function UsersList()
    {
        $users = User::orderBy('id', 'desc')
        ->paginate(10);
        return view('admin.users',compact('users'));
    }

    public function Employecreate()
    {

        return view('admin.createEmploye');
    }

    public function EmployeStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>'employee',
            'status'=>'accepted'
        ]);

        return redirect()->route('dashboard')->with('success', 'تم تحديث المشروع بنجاح.');

    }
}
