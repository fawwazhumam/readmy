<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Report;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function upload(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:pdf|max:10240',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $file = $req->file('file');

        $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs('File', $uniqueFileName);
        $imagePath = null;
        if ($req->hasFile('img')) {
            $image = $req->file('img');
            $uniqueImageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Photo/cover'), $uniqueImageName);
            $imagePath = $uniqueImageName;
        }

        File::create([
            'Title' => $req->title,
            'Category' => $req->category,
            'Desc' => $req->desc,
            'Type' => $req->type,
            'File_Name' => $uniqueFileName,
            'user_id' => Auth::id(),
            'image_path' => $imagePath
        ]);

        return redirect('Dashboard')->with('success', 'File berhasil diupload!');
    }

    public function viewData()
    {
        // $files = File::all();
        $files = File::where('user_id', Auth::id())->get();
        return view('profile', compact('files'));
    }

    public function viewPublicFiles()
    {
        $files = File::where('Type', 'public')->with('user')->take(5)->get();
        $lastestFiles = File::where('Type', 'public')->with('user')->orderBy('created_at', 'desc')->take(5)->get();
        $popularFiles = File::where('Type', 'public')->with('user')->orderBy('likes', 'desc')->take(5)->get();
        $categories = [
            'All', 'Children', 'Adult', 'Sport', 'Game',
            'Politics', 'History', 'Comedy', 'Horror', 'Conspiracy', '...'
        ];
        return view('welcome', compact('files', 'popularFiles', 'lastestFiles', 'categories'));
    }

    public function Edit($id)
    {
        $file = File::findOrFail($id);
        return view('edit', compact('file'));
    }

    public function Update(Request $req, $id)
    {
        $file = File::findOrFail($id);

        if ($req->hasFile('file')) {
            $req->validate([
                'file' => 'required|mimes:pdf|max:10240'
            ]);

            if (!is_null($file->File_Name) && Storage::disk('File')->exists($file->File_Name)) {
                Storage::disk('File')->delete($file->File_Name);
            }

            $file->File_Name = uniqid() . '.' . $req->file('file')->getClientOriginalExtension();
            $req->file('file')->storeAs('File', $file->File_Name);
        }

        // Handle image upload
        if ($req->hasFile('photo')) {
            $req->validate([
                'photo' => 'required|image|max:10240'
            ]);

            // Check if the file exists in the database and if the file exists in the public directory
            if (!is_null($file->image_path) && file_exists(public_path('Photo/cover/' . $file->image_path))) {
                unlink(public_path('Photo/cover/' . $file->image_path));
            }

            // Store new image
            $file->image_path = uniqid() . '.' . $req->file('photo')->getClientOriginalExtension();
            $req->file('photo')->move(public_path('Photo/cover'), $file->image_path);
        }

        $file->Title = $req->title;
        $file->Category = $req->category;
        $file->Desc = $req->desc;
        $file->Type = $req->type;
        $file->save();

        return redirect('Dashboard')->with('success', 'File berhasil diperbarui!');
    }

    public function delete($id)
    {
        $file = File::findOrFail($id);
        Storage::disk('FileDisk')->delete($file->File_Name);
        $file->delete();
        return back()->with('success', 'File berhasil dihapus!');
    }

    public function viewFile($fileName)
    {
        $filePath = storage_path('app/File/' . $fileName);
        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }

    public function likeFile(Request $request, File $file)
    {
        $userId = Auth::id();

        if ($file->likes()->where('user_id', $userId)->exists()) {
            return back()->with('error', 'You have already liked this file.');
        }

        $file->likes()->create(['user_id' => $userId]);

        $file->increment('likes');

        return back()->with('success', 'File liked successfully.');
    }

    public function saveBook($id)
    {
        $file = File::findOrFail($id);
        $user = Auth::user();

        if ($user->savedBooks()->where('file_id', $id)->exists()) {
            return back()->with('error', 'Book already saved.');
        }

        $user->savedBooks()->attach($file);

        return back()->with('success', 'Book saved successfully.');
    }

    public function removeBook($id)
    {
        $file = File::findOrFail($id);
        $user = Auth::user();

        if ($user->savedBooks()->where('file_id', $id)->doesntExist()) {
            return back()->with('error', 'Book not found in saved list.');
        }

        $user->savedBooks()->detach($file);

        return back()->with('success', 'Book removed from saved list.');
    }

    public function viewSavedBooks()
    {
        $user = Auth::user();
        $savedBooks = $user->savedBooks()->get();

        return view('savedbooks', compact('savedBooks'));
    }

    public function filterByCategory($category)
    {
        if ($category === 'All') {
            $files = File::where('Type', 'Public')->with('user')->get();
        } else {
            $files = File::where('Category', $category)
                ->where('Type', 'Public')
                ->with('user')
                ->get();
        }

        return response()->json($files);
    }

    public function unlikeFile(Request $request, File $file)
    {
        $userId = Auth::id();

        $like = $file->likes()->where('user_id', $userId)->first();

        if (!$like) {
            return back()->with('error', 'You have not liked this file.');
        }

        $like->delete();

        $file->decrement('likes');

        return back()->with('success', 'Like removed successfully.');
    }


    public function reportFile(Request $request, $fileId)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]);

        $report = new Report();
        $report->file_id = $fileId;
        $report->user_id = auth()->id();
        $report->category = $validatedData['category'];
        $report->reason = $validatedData['reason'];
        $report->save();

        return redirect()->back()->with('success', 'Report submitted successfully.');
    }


    public function viewReports()
    {
        $reports = Report::with('user', 'file')->get();
        return view('reports.index', compact('reports'));
    }

    public function store(Request $request, $fileId)
    {
        $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|integer|exists:comments,id',
            'parent_author_first_name' => 'nullable|string',
        ]);

        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->user_id = auth()->id();
        $comment->file_id = $fileId;
        $comment->parent_id = $request->input('parent_id');
        $comment->parent_author_first_name = $request->input('parent_author_first_name'); // Store the author's first name
        $comment->save();

        return back()->with('success', 'Comment added successfully');
    }

    // Like a comment
    public function like($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (!$comment->likes()->where('user_id', Auth::id())->exists()) {
            CommentLike::create([
                'comment_id' => $commentId,
                'user_id' => Auth::id()
            ]);
        }

        return back()->with('success', 'Comment liked successfully.');
    }
}
