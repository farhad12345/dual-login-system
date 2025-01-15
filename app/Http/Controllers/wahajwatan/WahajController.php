<?php

namespace App\Http\Controllers\wahajwatan;

use Log;
use App\Models\User;
use App\Models\Project;
use App\Models\WahajUser;
use Illuminate\Http\Request;
use App\Models\WahajWatanDetail;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ProjectCreatedNotification;

class WahajController extends Controller
{
    public function loginForm()
    {
        return view('wahajusers.login');
    }

    public function Dashboard()
    {
        $id = session('wahajuser_id');
        if (!$id) {
            return redirect()->route('wahajwatan.login');
        }

        $projects = WahajWatanDetail::where('employee_id', $id)->orderBy('id', 'desc')
        ->paginate(8);
        return view('wahajusers.dashboard', compact('projects'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = WahajUser::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['wahajuser_id' => $user->id]);
            return redirect()->route('wahajwatan.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        session()->forget('wahajuser_id');
        return redirect()->route('wahajwatan.login');
    }
    public function Create()
    {
        $id = session('wahajuser_id');
        return view('wahajusers.create',compact('id'));
    }
    public function Registerform()
    {
        $id = session('wahajuser_id');
        return view('wahajusers.register',compact('id'));
    }
    public function RegisterStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.WahajUser::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = WahajUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status'=>'pending'
        ]);
        return redirect(route('wahajwatan.login', absolute: false))->with('status', 'تم تسجيلك بنجاح. .');;
    }

    public function WahajStore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'record_number' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'origin_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'service' => 'nullable|string',
            'site_link' => 'nullable|string|max:255',
            'property_type' => 'nullable|string',
            'area' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'number_of_floors' => 'nullable|integer',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',

        ]);

        // Check if 'other' property type was selected and set its value
        $propertyType = $request->property_type === 'other' ? $request->other : $request->property_type;


    // Save project data into the database
    $project = WahajWatanDetail::create([
        'employee_id' => $request->employee_id,
        'record_number' => $request->record_number,
        'license_number' => $request->license_number,
        'origin_name' => $request->origin_name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'service' => $request->service,
        'site_link' => $request->site_link,
        'property_type' => $propertyType,
        'area' => $request->area,
        'height' => $request->height,
        'width' => $request->width,
        'number_of_floors' => $request->number_of_floors,
        'state' => $request->state,
        'city' => $request->city,
        'neighborhood' => $request->neighborhood,
        'street' => $request->street,
    ]);

         // Send email to admin
        //  $user = User::where('role','admin')->first();
        //   Mail::to($user->email)->send(new ProjectCreatedNotification($project->toArray()));
        return redirect()->route('wahajwatan.dashboard')->with('success', 'Project created successfully.');
    }
    public function WahajWatanSaveReason(Request $request)
    {
        // Validate the input
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // Find the project to update (you may need to pass a project ID as a hidden field in the form)
        $project = WahajWatanDetail::find($request->input('project_id')); // Adjust as needed
        if (!$project) {
            return back()->withErrors(['error' => 'Project not found']);
        }

        // Save the reason to the database
        $project->reason = $request->input('reason');
        $project->save();

        // Redirect back with a success message
        return back()->with('success', 'تم حفظ السبب بنجاح!');

    }
    public function WahajProjectDestroy($id)
    {
        $project = WahajWatanDetail::findOrFail($id);

        // Delete associated document
        if ($project->document && file_exists(public_path($project->document))) {
            unlink(public_path($project->document)); // Remove the file from the public directory
        }

        $project->delete();

        return redirect()->route('dashboard')->with('success', 'Project deleted successfully.');
    }
    public function wahajwatanProjectDestroy($id)
    {
        $project = WahajWatanDetail::findOrFail($id);

        // Delete associated document
        if ($project->document && file_exists(public_path($project->document))) {
            unlink(public_path($project->document)); // Remove the file from the public directory
        }

        $project->delete();

        return redirect()->route('wahajwatan.dashboard')->with('success', 'Project deleted successfully.');
    }

    public function Edit($id)
    {
        $project = WahajWatanDetail::findOrFail($id);
        $users = WahajUser::get();
        $emp_id = session('wahajuser_id');
        return view('wahajusers.edit', compact('project','users','emp_id'));
    }
    public function ViewWahajProjects($id)
    {
        $projects = WahajWatanDetail::where('employee_id', $id)->with('employee')
        ->orderBy('id', 'desc')
        ->paginate(8);
        return view('admin.wahajprojects.details',compact('projects'));
    }
    public function WahajProjectCreate()
    {
        $users = WahajUser::get();
        return view('admin.wahajprojects.create', compact('users'));
    }
    public function WahajProjectStore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'record_number' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'origin_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'service' => 'nullable|string',
            'site_link' => 'nullable|string|max:255',
            'property_type' => 'nullable|string',
            'area' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'number_of_floors' => 'nullable|integer',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'other' => 'nullable|string|max:255', // Optional field
        ]);

        // Check if 'other' property type was selected and set its value
        $propertyType = $request->property_type === 'other' ? $request->other : $request->property_type;

        // Save the project details
        $project = WahajWatanDetail::create([
            'employee_id' => $request->employee_id,
            'record_number' => $request->record_number,
            'license_number' => $request->license_number,
            'origin_name' => $request->origin_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'service' => $request->service,
            'site_link' => $request->site_link,
            'property_type' => $propertyType,
            'area' => $request->area,
            'height' => $request->height,
            'width' => $request->width,
            'number_of_floors' => $request->number_of_floors,
            'state' => $request->state,
            'city' => $request->city,
            'neighborhood' => $request->neighborhood,
            'street' => $request->street,
        ]);
        // $user = User::where('role','admin')->first();
        // Mail::to($user->email)->send(new ProjectCreatedNotification($project->toArray()));
        return redirect()->route('dashboard')->with('success', 'تم إنشاء المشروع بنجاح.');
    }
    public function WahajProjectEdit($id)
    {
        $project = WahajWatanDetail::findOrFail($id);
        $users = WahajUser::get();
        return view('admin.wahajprojects.edit', compact('project','users'));
    }

    public function WahajProjectUpdate(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'record_number' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'origin_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'service' => 'required|string|max:255',

            'document' => 'nullable|file|mimes:pdf,jpg,png|max:2048', // Optional for file uploads
        ]);

        try {

            $wahajWatanDetail = WahajWatanDetail::findOrFail($id);

            // Update attributes
            $wahajWatanDetail->update([
                'employee_id' => $request->employee_id,
                'record_number' => $request->record_number,
                'license_number' => $request->license_number,
                'origin_name' => $request->origin_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'service' => $request->service,
                'site_link' => $request->site_link,
                'property_type' => $request->property_type,
                'area' => $request->area,
                'height' => $request->height,
                'width' => $request->width,
                'number_of_floors' => $request->number_of_floors,
                'state' => $request->state,
                'city' => $request->city,
                'neighborhood' => $request->neighborhood,
                'street' => $request->street,
                'document' => $request->hasFile('document')
                    ? $request->file('document')->store('documents', 'public') // Store the file
                    : $wahajWatanDetail->document, // Retain the old document if not replaced
            ]);

            return redirect()->route('dashboard')->with('success', 'تم تحديث المشروع بنجاح.');

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error during project update: ' . $e->getMessage());

            return redirect()->route('dashboard')->with('error', 'فشل في تحديث المشروع.');
        }
    }
}
