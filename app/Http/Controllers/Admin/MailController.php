<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function index()
    {
        $mails = Mail::latest()->get();
        return view('admin.pages.mail.index', compact('mails'));
    }

    public function compose()
    {
        return view('admin.pages.mail.compose');
    }

    public function show(Mail $mail)
    {
        $emailData = DB::table('email_process')->whereMailId($mail->id)->get();

        return view('admin.pages.mail.show', compact('mail', 'emailData'));
    }
}
