<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'max:255', 'regex:/(0)[0-9]/', 'not_regex:/[a-z]/'],
            'message' => ['required', 'string'],
        ]);

        $msg = new Contact();
        $msg->first_name = $request->first_name;
        $msg->last_name = $request->last_name;
        $msg->email = $request->email;
        $msg->phone = $request->phone;
        $msg->star =  '0';
        $msg->message = $request->message;
        $msg->status = '0';
        $msg->save();

        return response()->json($msg);

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Contact $contact)
    {
        $contacts = DB::table('contacts')->orderBy('id', 'DESC')->get();

        $show = view('backend.admin.contacts.show')->with('contacts',$contacts);
        return view('backend.admin.layouts.master')->with('content',$show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
