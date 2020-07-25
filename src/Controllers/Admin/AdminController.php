<?php

namespace Azuriom\Plugin\Newsletter\Controllers\Admin;

use Azuriom\Plugin\Newsletter\Mail\Newsletter;
use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the home admin page of the plugin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('newsletter::admin.index');
    }

    public function sender(Request $request)
    {
        $data = (object) [];
        $data->title = $request->title;
        $data->content = $request->content;
        Mail::bcc(User::all())
            ->queue(new Newsletter($data));
        return redirect('/admin')->with('success', "Email successfully sent !");
    }
}
