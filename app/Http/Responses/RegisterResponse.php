<?php

// namespace App\Http\Responses;

// use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

// class RegisterResponse implements RegisterResponseContract
// {
//     /**
//      * @param  $request
//      * @return mixed
//      */
//     public function toResponse($request)
//     {
//         // $home = auth()->user()->is_admin ? '/admin' : '/dashboard';

//         switch (auth()->user()->role) {
//             case 'ADM':
//                 $home = '/admin';
//                 break;
//             case 'AGN':
//                 $home = '/dashboard';
//                 break;
//             case 'USR':
//                 $home = '/dashboard';
//                 break;
//             case 'WRT':
//                 $home = '/writer/dashboard';
//                 break;
//             default:
//                 $home = '/login';
//                 break;
//         }

//         return redirect()->intended($home);
//     }
// }
