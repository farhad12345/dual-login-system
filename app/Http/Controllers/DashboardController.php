<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\User;
use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\MawayeedProject;
use App\Models\WahajWatanDetail;
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

        $wahajprojects = WahajWatanDetail::with('employee')
        ->select(
            'wahaj_watan_details.*', // Select all columns from the wahaj_watan_details table
            'wahaj_users.id as user_id', // Employee user ID
            'wahaj_users.name as employee_name' // Employee name
        )
        ->leftJoin('wahaj_users', 'wahaj_watan_details.employee_id', '=', 'wahaj_users.id') // Join with wahaj_users
        ->whereIn('wahaj_watan_details.id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('wahaj_watan_details') // Subquery for the latest record per employee
                ->groupBy('employee_id');
        })
        ->orderBy('wahaj_watan_details.id', 'desc') // Order by latest record
        ->paginate(10); // Paginate results
          //al mawayeed projects query
          $mawayeedprojects = MawayeedProject::with('employee')
          ->select(
              'mayeed_projects.*',
              'mawayeed_users.id as user_id',
              'mawayeed_users.name as employee_name'
          )
          ->leftJoin('mawayeed_users', 'mayeed_projects.employee_id', '=', 'mawayeed_users.id')
          ->whereIn('mayeed_projects.id', function ($query) {
              $query->select(DB::raw('MAX(id)'))
                  ->from('mayeed_projects')
                  ->groupBy('mayeed_projects.employee_id');
          })
          ->orderBy('mayeed_projects.date', 'desc') // Assuming 'date' is the column for sorting
          ->paginate(10);



    // Project Statuses
    $totalEmployees = user::count();
    $acceptedEmployees = User::where('status', 'accepted')->count();
    $pendingEmployees = User::where('status', 'pending')->count();
    $rejectedEmployees = User::where('status', 'rejected')->count();
    $projectsStarted = Project::where('status', 'started')->count();
    $projectsInProgress = Project::where('status', 'in_progress')->count();
    $projectsCompleted = Project::where('status', 'completed')->count();
    $projectsOverdue = Project::whereRaw('DATE_ADD(start_date, INTERVAL days DAY) < ?', [now()])
    ->count();


    // Last Login Activity
    $lastLoginDates = User::selectRaw('DATE(last_login) as date')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->pluck('date');

        $loginCounts = User::selectRaw('COUNT(*) as login_count, DATE(last_login) as date')
        ->groupBy(DB::raw('DATE(last_login)'))
        ->orderBy('date', 'asc')
        ->pluck('login_count', 'date');


            return view('admin.dashboard', compact('projects','wahajprojects','mawayeedprojects' ,'totalEmployees',
            'projectsStarted',
            'projectsInProgress',
            'projectsCompleted',
            'projectsOverdue',
            'lastLoginDates',
            'acceptedEmployees',
            'pendingEmployees',
            'rejectedEmployees',
            'loginCounts'));
    }
    public function adminDashboardListData(Request $request)
    {
        try {
            $projectsQuery = Project::with('employee')
            ->select('projects.*', 'users.id as user_id', 'users.name as employee_name')
            ->leftJoin('users', 'projects.employee_id', '=', 'users.id')
            ->whereIn('projects.id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('projects')
                    ->groupBy('projects.employee_id');
            });

        // Filter for employee name in the `users` table
        if ($request->filled('filterName')) {
            $projectsQuery->where('users.name', 'like', '%' . $request->filterName . '%');
        }

        // Filter for company name in the `projects` table
        if ($request->filled('companyName')) {
            $projectsQuery->where('projects.company_name', 'like', '%' . $request->companyName . '%');
        }

        // Filter for status in the `projects` table
        if ($request->filled('statusFilter')) {
            $projectsQuery->where('projects.status', $request->statusFilter);
        }

        $total = $projectsQuery->count();
        $projects = $projectsQuery->orderBy('projects.id', 'desc')->paginate(10);

            $view = View('admin.projects.projects_html', compact('projects'))->render();
            return response()->json(['status' => 'success', 'html' => $view, 'total' => $total]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'msg' => $e->getMessage() . ':' . $e->getLine()]);
        }
    }
    // public function index(Request $request)
    // {
    //     $query = Project::query();

    //     if ($request->filled('employee_name')) {
    //         $query->whereHas('employee', function ($q) use ($request) {
    //             $q->where('name', 'like', '%' . $request->employee_name . '%');
    //         });
    //     }

    //     if ($request->filled('company_name')) {
    //         $query->where('company_name', 'like', '%' . $request->company_name . '%');
    //     }

    //     if ($request->filled('status')) {
    //         $query->where('status', $request->status);
    //     }

    //     $projects = $query->paginate(10);
    //     return view('admin.projects.index', compact('projects'));
    // }

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
        if ($project->document && file_exists(public_path($project->document))) {
            unlink(public_path($project->document)); // Remove the file from the public directory
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
            'type'=>$request->type,
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
                'type'=>$request->type,
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
        $projects = Project::where('employee_id', $id)
        ->with('employee')
        ->orderByRaw("CASE
            WHEN DATE_ADD(start_date, INTERVAL days DAY) <= CURDATE() THEN 1
            ELSE 0
        END")
        ->get();
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
    public function saveReason(Request $request)
    {
        // Validate the input
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // Find the project to update (you may need to pass a project ID as a hidden field in the form)
        $project = Project::find($request->input('project_id')); // Adjust as needed
        if (!$project) {
            return back()->withErrors(['error' => 'Project not found']);
        }

        // Save the reason to the database
        $project->reason = $request->input('reason');
        $project->save();

        // Fetch the associated employee
        $employee = $project->employee;
        if ($employee && $project->email) {
            $email = $project->email;
            $reason = $project->reason;

            // Validate if the email is valid
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                try {
                    Mail::send('emails.reason_notification', ['employee' => $employee, 'reason' => $reason], function ($message) use ($email) {
                        $message->to($email)
                                ->subject('إشعار: سبب الإجازة')
                                ->from('farhadkhanfarhad367@gmail.com', 'آمرتم');
                    });

                    \Log::info('Email sent to: ' . $email);
                } catch (\Exception $e) {
                    \Log::error('Failed to send email: ' . $e->getMessage());
                }
            } else {
                \Log::warning('Invalid email address: ' . $email);
            }
        } else {
            \Log::warning('Employee or email is missing.');
        }


        // Redirect back with a success message
        return back()->with('success', 'تم حفظ السبب بنجاح وإرسال إشعار إلى الموظف!');
    }

}
