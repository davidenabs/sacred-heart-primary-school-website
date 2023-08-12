<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest;
use App\Models\Management;
// use File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managements = Management::latest()->get();
        return view('admin.pages.users.management.index', compact('managements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.users.management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManagementRequest $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpsg,png,jpg,gif|max:2048',
        ]);

        // rename the avatar
        $avatarName = Str::slug($request->name) .
            '-' . time() .
            '.' . $request->image->extension();

        // move image to folder
        $request->image->move(public_path('shs_images/staffs'), $avatarName);

        $path = 'shs_images/staffs/' . $avatarName;

        Management::create([
            'name' => $request->name,
            'role' => $request->role,
            'bio' => $request->bio,
            'avatar' => $path,
            'social_fb' => $request->social_fb,
            'social_tw' => $request->social_tw,
            'social_ig' => $request->social_ig,
            // 'social_ln' => $request->social_ln,
        ]);

        return redirect()->route('admin.managements.create')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Management $management)
    {
        return view('admin.pages.users.management.show', compact('management'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Management $management)
    {
        return view('admin.pages.users.management.create', compact('management'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ManagementRequest $request, Management $management)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpsg,png,jpg,gif|max:2048',
        ]);

        $path = $management->avatar;

        if ($request->hasFile('image')) {
            // rename the avatar
            $avatarName = Str::slug($request->name) .
                '-' . time() .
                '.' . $request->image->extension();

            // move image to folder
            $request->image->move(public_path('shs_images/staffs'), $avatarName);

            // remove the old file if there's new one
            File::delete(public_path('shs_images/staffs/' . $management->avatar));

            $path = 'shs_images/staffs/' . $avatarName;
        }

        $management->update([
            'name' => $request->name,
            'role' => $request->role,
            'bio' => $request->bio,
            'avatar' => $path,
            'social_fb' => $request->social_fb,
            'social_tw' => $request->social_tw,
            'social_ig' => $request->social_ig,
        ]);

        return redirect()->route('admin.managements.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Management $management)
    {
        $management->delete();

        return redirect()->route('admin.pages.users.management.index')->with('success', 'Post deleted successfully.');
    }
}
