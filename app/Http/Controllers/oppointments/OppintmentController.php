<?php

namespace App\Http\Controllers\oppointments;

use App\Models\User;
use App\Models\MawayeedUser;
use Illuminate\Http\Request;
use App\Models\MawayeedProject;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ProjectCreatedNotification;

class OppintmentController extends Controller
{
    public function loginForm()
    {
        return view('almawayeed.login');
    }

    public function Dashboard()
    {
        $id = session('mawayeeduser_id');
        if (!$id) {
            return redirect()->route('almawayeed.login');
        }

        $projects = MawayeedProject::where('employee_id', $id)->orderBy('id', 'desc')
        ->paginate(8);
        return view('almawayeed.dashboard', compact('projects'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = MawayeedUser::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['mawayeeduser_id' => $user->id]);
            return redirect()->route('almawayeed.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        session()->forget('mawayeeduser_id');
        return redirect()->route('almawayeed.login');
    }
    public function Create()
    {
        $id = session('mawayeeduser_id');
        return view('almawayeed.create',compact('id'));
    }
    public function Registerform()
    {
        $id = session('mawayeeduser_id');
        return view('almawayeed.register',compact('id'));
    }
    public function RegisterStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.MawayeedUser::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = MawayeedUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status'=>'pending'
        ]);
        return redirect(route('almawayeed.login', absolute: false))->with('status', 'تم تسجيلك بنجاح. .');;
    }

    public function almawayeedStore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'invitation_name' => 'required|string|max:255',
            'day' => 'required|string|max:255',
            'occasion' => 'required|string|in:marriage,honoring,events,national_occasions,launching',
            'time' => 'required|string|max:255',

        ]);

        // Initialize the image path as null
        $imagePath = null;

        // Check if the image file is uploaded
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName(); // Unique file name
            $destinationPath = public_path('uploads/images'); // Target directory
            // Ensure directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            // Move file to target directory
            $imageFile->move($destinationPath, $imageName);
            // Set the relative path for saving
            $imagePath = 'uploads/images/' . $imageName;
        }

        // Save data into the database
        $invitation = MawayeedProject::create([
            'employee_id' => $request->employee_id,
            'invitation_name' => $request->invitation_name,
            'day' => $request->day,
            'occasion' => $request->occasion,
            'time' => $request->time,
            'date' => $request->date,
            'city' => $request->city,
            'state' => $request->state,
            'address' => $request->address,
            'link' => $request->link,
            'image' => $imagePath, // Save relative path or null if no file
        ]);

        //  // Send email to admin
        //  $user = User::where('role','admin')->first();
        //   Mail::to($user->email)->send(new ProjectCreatedNotification($invitation->toArray()));
        return redirect()->route('almawayeed.dashboard')->with('success', 'Project created successfully.');
    }
    public function almawayeedSaveReason(Request $request)
    {
        // Validate the input
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // Find the project to update (you may need to pass a project ID as a hidden field in the form)
        $project = MawayeedProject::find($request->input('project_id')); // Adjust as needed
        if (!$project) {
            return back()->withErrors(['error' => 'Project not found']);
        }

        // Save the reason to the database
        $project->reason = $request->input('reason');
        $project->save();

        // Redirect back with a success message
        return back()->with('success', 'تم حفظ السبب بنجاح!');

    }
    public function AlmawayeedProjectDestroy($id)
    {
        $project = MawayeedProject::findOrFail($id);

        // Delete associated document
        if ($project->document && file_exists(public_path($project->document))) {
            unlink(public_path($project->document)); // Remove the file from the public directory
        }

        $project->delete();
        return back()->with('success', 'Project deleted successfully.');

        // return redirect()->route('dashboard')->with('success', 'Project deleted successfully.');
    }

    public function ViewAlmawayeedProjects($id)
    {
        $projects = MawayeedProject::where('employee_id', $id)->with('employee')
        ->orderBy('id', 'desc')
        ->paginate(8);
        return view('admin.almawayeed.details',compact('projects'));
    }
    public function AlmawayeedProjectCreate()
    {
        $users = MawayeedUser::get();
        return view('admin.almawayeed.create', compact('users'));
    }
    public function AlmawayeedProjectStore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'invitation_name' => 'required|string|max:255',
            'day' => 'required|string|max:255',
            'occasion' => 'required|string|in:marriage,honoring,events,national_occasions,launching',
            'time' => 'required|string|max:255',

        ]);

        // Initialize the image path as null
        $imagePath = null;

        // Check if the image file is uploaded
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName(); // Unique file name
            $destinationPath = public_path('uploads/images'); // Target directory
            // Ensure directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            // Move file to target directory
            $imageFile->move($destinationPath, $imageName);
            // Set the relative path for saving
            $imagePath = 'uploads/images/' . $imageName;
        }

        // Save data into the database
        $invitation = MawayeedProject::create([
            'employee_id' => $request->employee_id,
            'invitation_name' => $request->invitation_name,
            'day' => $request->day,
            'occasion' => $request->occasion,
            'time' => $request->time,
            'date' => $request->date,
            'city' => $request->city,
            'state' => $request->state,
            'address' => $request->address,
            'link' => $request->link,
            'image' => $imagePath, // Save relative path or null if no file
        ]);
        // $user = User::where('role','admin')->first();
        // Mail::to($user->email)->send(new ProjectCreatedNotification($project->toArray()));
        return redirect()->route('dashboard')->with('success', 'تم إنشاء المشروع بنجاح.');
    }
    public function Edit($id)
    {
        $project = MawayeedProject::findOrFail($id);
        $users = MawayeedUser::get();
        $emp_id = session('mawayeeduser_id');
        return view('almawayeed.edit', compact('project','users','emp_id'));
    }
    public function AlmawayeedProjectEdit($id)
    {
        $project = MawayeedProject::findOrFail($id);
        $users = MawayeedUser::get();
        return view('admin.almawayeed.edit', compact('project','users'));
    }
    public function AlmawayeedProjectUpdate(Request $request, $id)
    {
        // Find the project
        $project = MawayeedProject::findOrFail($id);

        // Validate the request data
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'invitation_name' => 'required|string|max:255',
            'day' => 'required|string|max:255',
            'occasion' => 'required|string|in:marriage,honoring,events,national_occasions,launching',
            'time' => 'required|string|max:255',

        ]);
        try {
            $imagePath = $project->image;
            // Handle file upload if a new document is provided
         // Check if a new image file is uploaded
            if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName(); // Unique file name
            $destinationPath = public_path('uploads/images'); // Target directory

            // Ensure directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move file to target directory
            $imageFile->move($destinationPath, $imageName);

            // Delete the old image if it exists
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            // Set the new relative path
            $imagePath = 'uploads/images/' . $imageName;
            }

      // Update the record in the database
            $project->update([
                'employee_id' => $request->employee_id,
                'invitation_name' => $request->invitation_name,
                'day' => $request->day,
                'occasion' => $request->occasion,
                'time' => $request->time,
                'date' => $request->date,
                'city' => $request->city,
                'state' => $request->state,
                'address' => $request->address,
                'link' => $request->link,
                'image' => $imagePath, // Save the updated path or retain the old one
            ]);

            return back()->with('success', 'تم تحديث المشروع بنجاح.');


        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error during project update: ' . $e->getMessage());

            return redirect()->route('dashboard')->with('error', 'فشل في تحديث المشروع.');
        }
    }
}
