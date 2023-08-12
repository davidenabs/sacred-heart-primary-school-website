<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Models\WriterInfo;
use App\Notifications\User\PasswordChangedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'user' => User::whereId(Auth::id())->firstOrFail(),
        ];

        return view('writer.profile', $data);
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = Auth::user();

        try {
            // Update the user data
            $user->update([
                'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);

            // Check if the user has a related WriterInfo record
            $writerInfo = $user->writerInfo;

            // If there's no WriterInfo record, create a new one and associate it with the user
            if (!$writerInfo) {

                $writerInfo = new WriterInfo([
                    'bio' => $request->input('bio'),
                    'facebook' => $request->input('facebook'),
                    'twitter' => $request->input('twitter'),
                    'subscriber' => true,
                ]);
                $user->writerInfo()->save($writerInfo);
            } else {
                // If there's an existing WriterInfo record, update its data
                $writerInfo->update([
                    'bio' => $request->input('bio'),
                    'facebook' => $request->input('facebook'),
                    'twitter' => $request->input('twitter'),
                    'subscriber' => true,
                ]);
            }

            // Upload and update the profile photo if provided
            if ($request->hasFile('profile')) {

                if (file_exists($writerInfo->profile)) {
                    unlink($writerInfo->profile);
                }

                $file = $request->file('profile');

                $imageName = Str::uuid() . '.' . $file->extension();

                $imagePath = $file->storeAs('shs_images/profile', $imageName, 'real_public');

                $imagePath = $this->optimizeImage($imagePath, 500, 500);

                $writerInfo->update(['profile' => $imagePath]);
            }

            session()->flash('success', 'Profile updated successfully.');

            return redirect()->route('writer.profile', 'tab='.$request->tab);
        } catch (\Throwable $th) {
            // dd($th);
            session()->flash('success', 'Something went wrong while updating your profile.');
            return redirect()->route('writer.profile', 'tab='.$request->tab);
        }
    }

    function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ]);

        auth()->user()->update([
            'password' => Hash::make($request['password']),
        ]);

        // send mail
        auth()->user()->notify(new PasswordChangedNotification());

        session()->flash('success', 'Password changed successfully!');

        return redirect()->route('writer.profile', 'tab='.$request->tab);
    }
}
