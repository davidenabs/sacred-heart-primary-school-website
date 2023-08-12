<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        // $home = auth()->user()->is_admin ? '/admin' : '/dashboard';
dd(auth()->user()->role);
        switch (auth()->user()->role) {
            case 'ADM':
                $home = '/admin';
                break;
            // case 'USR':
            //     $home = '/dashboard';
                // break;
            case 'WRT':
                $home = '/author';
                break;
            default:
                $home = '/login';
                break;
        }

        return $request->wantsJson()
        ? response()->json(['two_factor' => false])
        : redirect()->intended($home);

    }
}
