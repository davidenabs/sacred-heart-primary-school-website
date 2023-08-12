<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\User\AccountBlockedNotification;
use App\Notifications\User\AccountRestoredNotification;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $user)
    {
        if ($user == 'admin') {
            $users = User::admin()->latest()->get();
            $trashUser = User::admin()->onlyTrashed()->latest()->get();
        } elseif ($user == 'writer') {
            $users = User::writer()->latest()->get();
            $trashUser = User::writer()->onlyTrashed()->latest()->get();
        } elseif ($user == 'user') {
            $users = User::user()->latest()->get();
            $trashUser = User::user()->onlyTrashed()->latest()->get();
        } else {
            abort(404);
        }

        $data = [
            'users' => $users,
            'trashUser' => $trashUser,
            'type' => $user
        ];
        return view('admin.pages.users.all_users.index', $data);
    }

    public function indexTrash(string $type)
    {
        if ($type == 'admin') {
            $users = User::admin()->onlyTrashed()->latest()->get();
        } elseif ($type == 'writer') {
            $users = User::writer()->onlyTrashed()->latest()->get();
        } elseif ($type == 'user') {
            $users = User::user()->onlyTrashed()->latest()->get();
        } else {
            abort(404);
        }

        $data = [
            'users' => $users,
            'trashUser' => $users,
            'type' => $type,
            'is_trash' => true
        ];
        return view('admin.pages.users.all_users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $user)
    {
        if ($user == 'admin') {
        } elseif ($user == 'writer') {
        } elseif ($user == 'user') {
        } else {
            abort(404);
        }

        $data = [
            'users' => '',
            'type' => $user
        ];

        return view('admin.pages.users.all_users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type, $user)
    {
        if ($type !== 'admin' && $type !== 'writer' && $type !== 'user') abort(404);

        $user = User::withTrashed()->whereId($user)->firstOrFail();

        $data = [
            'user' => $user,
            'type' => $type
        ];

        return view('admin.pages.users.all_users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $type, User $user)
    {
        $this->verifyRoute($type, $user);

        $data = [
            'user' => $user,
            'type' => $type
        ];

        return view('admin.pages.users.all_users.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function blockUser(Request $request, $type, $user)
    {
        $user = User::withTrashed()->whereId($user)->firstOrFail();

        $this->verifyRoute($type, $user);

        $user->delete();

        // send mail
        $user->notify(new AccountBlockedNotification($user));

        if ($request->wantsJson()) {
            return response()->json('User blocked successfully!');
        } else {
            return redirect()->back()->with('success', 'User blocked successfully!');
        }
    }

    public function forceDestroy(Request $request, $type, $user)
    {
        $user = User::withTrashed()->whereId($user)->firstOrFail();

        $this->verifyRoute($type, $user);

        $user->posts()->forceDelete();
        $user->writerInfo()->delete();
        $user->forceDelete();

        if ($request->wantsJson()) {
            return response()->json('User deleted successfully!');
        } else {
            return redirect()->route('admin.users.index', $type)->with('success', 'User deleted successfully!');
        }
    }

    public function restore(string $type, $user)
    {
        // $this->verifyRoute($type, $user);

        $user = User::withTrashed()->whereId($user)->firstOrFail();
        $user->restore();

        session()->flash('success', 'User restored successfully!');

        // send mail
        $user->notify(new AccountRestoredNotification($user));

        return redirect()->back();
    }

    protected function verifyRoute(string $type, User $user)
    {
        if ($user->id == '1' || $user->email == 'sacredheartprimaryschool2023@gmail.com') abort(401);

        if ($type !== 'admin' && $type !== 'writer' && $type !== 'user') abort(404);
    }
}
