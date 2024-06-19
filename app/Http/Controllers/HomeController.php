<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\File;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        return view('home');
    }

    public function Profile()
    {
        $user = auth()->user();
        $files = File::where('user_id', $user->id)->get(); 
        $totalLikes = $user->totalLikes();
        return view('profile', compact('user', 'files', 'totalLikes')); 
    }

    public function Dashboard()
    {
        $files = File::where('user_id', Auth::id())->get();
        return view('dashboard', compact('files'));
    }

    public function Upload()
    {
        return view('upload');
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('profiledit', compact('user'));
    }

    public function About()
    {
        return view('about');
    }

    public function Popular()
    {
        $files = File::where('Type', 'public')->with('user')->get();
        $popularFiles = File::where('Type', 'public')->with('user')->orderBy('likes', 'desc')->take(5)->get();
        return view('popular', compact('files', 'popularFiles'));
    }

    public function LatestUpdate()
    {
        $files = File::where('Type', 'public')->with('user')->get();
        $lastestFiles = File::where('Type', 'public')->with('user')->orderBy('created_at', 'desc')->take(5)->get();
        return view('lastestupdate', compact('files', 'lastestFiles'));
    }

    public function ReadBook($id)
    {
        $file = File::with('user')->findOrFail($id);
        return view('readbook', compact('file'));
    }

    public function updateProfile(Request $req)
    {
        $user = auth()->user();

        $validatedData = $req->validate([
            'First_Name' => 'required|string|max:255',
            'Last_Name' => 'required|string|max:255',
            'Date' => 'required|date',
            'Gender' => 'required|in:Male,Female,Not set',
            'Role' => 'required|in:Adult,Children,Student,Writer',
            'Bio' => 'required|string|max:255',
            'Address' => 'required|string|max:255',
            'File_Name' => 'mimes:jpeg,png,jpg,gif|max:10240',
            'Header_File_Name' => 'mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        if ($req->hasFile('File_Name')) {
            $file = $req->file('File_Name');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('Photo'), $fileName);
            $validatedData['File_Name'] = $fileName;

            if ($user->File_Name && $user->File_Name !== 'default.png' && file_exists(public_path('Photo/' . $user->File_Name))) {
                unlink(public_path('Photo/' . $user->File_Name));
            }
        }

        if ($req->hasFile('Header_File_Name')) {
            $heroFile = $req->file('Header_File_Name');
            $heroFileName = $heroFile->getClientOriginalName();
            $heroFile->move(public_path('Photo'), $heroFileName);
            $validatedData['Header_File_Name'] = $heroFileName;
    
            if ($user->Header_File_Name && $user->Header_File_Name !== 'header_profile.png' && file_exists(public_path('Photo/' . $user->Header_File_Name))) {
                unlink(public_path('Photo/' . $user->Header_File_Name));
            }
        }

        $user->update($validatedData);

        return redirect('Profile')->with('success', 'Profile updated successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        if ($query) {
            $fileResults = File::where('title', 'LIKE', "%{$query}%")->get();
            $userResults = User::where('First_Name', 'LIKE', "%{$query}%")
                                ->orWhere('Last_Name', 'LIKE', "%{$query}%")
                                ->get();
        } else {
            $fileResults = collect(); 
            $userResults = collect();
        }
    
        return view('search', compact('fileResults', 'userResults'));
    }

    public function followUser($id)
    {
        $follow = Follow::firstOrCreate([
            'follower_id' => Auth::id(),
            'followed_id' => $id
        ]);

        return back()->with('success', 'User followed successfully.');
    }

    public function unfollowUser($id)
    {
        $follow = Follow::where('follower_id', Auth::id())->where('followed_id', $id)->first();
        if ($follow) {
            $follow->delete();
        }

        return redirect()->back()->with('success', 'User unfollowed successfully.');
    }

    public function viewFollowers()
    {
        $user = Auth::user();
        $followers = $user->followers;
        $followingIds = $user->followings->pluck('id')->toArray();
    
        return view('followers', compact('user', 'followers', 'followingIds'));
    }
    
    public function viewFollowings()
    {
        $user = Auth::user();
        $followings = $user->followings;
        $followers = $user->followers;
    
        return view('followings', compact('user', 'followings', 'followers'));
    }
    
    public function followBack($id)
    {
        $user = Auth::user();
        $user->followings()->attach($id);
    
        return back()->with('success', 'You are now following this user.');
    }
    
    public function removeFollower($id)
    {
        $user = Auth::user();
        $user->followers()->detach($id);
    
        return back()->with('success', 'Follower removed.');
    }

    public function unfollow($id)
    {
        $user = Auth::user();
        $user->followings()->detach($id);

        return back()->with('success', 'You have unfollowed this user.');
    }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        $files = $user->files; 
        $totalLikes = $user->totalLikes();
        return view('lihatprofile', compact('user', 'files', 'totalLikes'));
    }
}
