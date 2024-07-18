<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\File;
use App\Models\User;
use App\Mail\AccountDeleted;
use Illuminate\Support\Facades\Mail;
use App\Models\DeletedEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $reports = Report::with(['user', 'file'])->get();
        return view('/admin/dashboardadmin', compact('reports'));
    }

    public function viewReports()
    {
        $reports = Report::with(['user', 'file'])->get();
        return view('/admin/dashboardadmin', compact('reports'));
    }

    public function deleteFile($id)
    {
        $file = File::findOrFail($id);
        $user = $file->user;
        $user->Post_Deleted +=1;
        Storage::disk('FileDisk')->delete($file->File_Name);
        $user->save();
        $file->delete();

        return redirect()->route('admin.reports')->with('success', 'File successfully deleted!');
    }

    public function approveReport($id)
    {
        $report = Report::findOrFail($id);
        $file = $report->file;
        $file->report_approved += 1;
        $file->save();
        $report->delete();

        return redirect()->route('admin.reports')->with('success', 'Report successfully approved!');
    }

    public function deleteReport($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('admin.reports')->with('success', 'Report successfully deleted!');
    }

    public function viewFiles(){
        $files = File::with('user')->orderBy('report_approved', 'desc')->get();
        return view('/admin/dashboardadminfiles', compact('files'));
    }

    public function viewUsers(){
        $users = User::orderBy('Post_Deleted', 'desc')->get();
        return view('admin.dashboardadminaccount', compact('users'));
    }

    public function deleteUser($id)
    {
        $users = User::findOrFail($id);
        Mail::to($users->email)->send(new AccountDeleted($users));
        DeletedEmail::create(['email' => $users->email]);
        $users->delete();

        return redirect()->route('admin.viewUsers')->with('success', 'Report successfully deleted!');
    }

    public function addAccount()
    {
        return view('/admin/dashboardaddminplusadmin');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return redirect()->route('admin.reports')->with('success', 'Admin registered successfully!');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'First_Name' => ['required', 'string', 'max:255'],
            'Last_Name' => ['required', 'string', 'max:255'],
            'Date' => ['required', 'date'],
            'Gender' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',
                function ($attribute, $value, $fail) {
                    if (DeletedEmail::where('email', $value)->exists()) {
                        $fail('This email has been banned and cannot be used for registration.');
                    }
                }
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'First_Name' => $data['First_Name'],
            'Last_Name' => $data['Last_Name'],
            'Date' => $data['Date'],
            'Gender' => $data['Gender'],
            'File_Name' => 'default.png',
            'Header_File_Name' => 'header_profile.png',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'usertype' => 'admin'
        ]);

        $user->sendEmailVerificationNotification();

        return $user;
    }
}