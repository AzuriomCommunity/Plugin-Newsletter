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
    public function index(Request $request)
    {
        if($request->user()->hasPermission("allow_newsletter"))
            return view('newsletter::admin.index');
        else
            return redirect("/admin")->with('error', "You don't have access to this page.");
    }

    public function sender(Request $request)
    {
        if($request->user()->hasPermission("allow_newsletter")){
        $data = (object) [];
        $data->title = $request->title;
        $data->content = $request->content;
        Mail::bcc(User::all())
            ->queue(new Newsletter($data));
        return redirect('/admin')->with('success', "Email successfully sent !");
        }
        else
            return redirect("/admin")->with('error', "You don't have access to this route.");
    }
}
