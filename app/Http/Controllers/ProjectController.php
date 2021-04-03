<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\ContactPerson;
use App\Models\Project;
use Illuminate\Http\Request;
use Mail;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-project');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $fields = $request -> except(['contact_name', 'contact_email']);
        $project = new Project($fields);
        $project -> save();

        $contacts = $request -> all(['contact_name', 'contact_email']);
        $count = is_countable($contacts['contact_name']) ? count($contacts['contact_name']) : 0;

        for ($i=0;$i<$count;$i++){
            $fields = [
                'name' => $contacts['contact_name'][$i],
                'email' => $contacts['contact_email'][$i],
                'project_id' => $project -> id,
            ];

            $contact = new ContactPerson($fields);
            $contact -> save();

        }

        return back()->with('success','Project created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('pages.edit-project', compact('project'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $fields = $request -> except('_token', '_method', 'contact_name', 'contact_email');
        $altered = $project -> compare($fields);
        $msg = [];

        if (count($altered)){
            $project -> update($altered);

            foreach ($altered as $key => $val){
                $msg[]=$key;
            }
        }

        $contacts = $project -> contactPerson;
        $contacts_new = $request -> all(['contact_name', 'contact_email']);
        $count = count($project -> contactPerson);
        $count_new = (is_countable($contacts_new['contact_name'])) ? count($contacts_new['contact_name']): 0;
        $fields = [];

        if ($count != $count_new){
            $msg[]='contacts';
        }

        for ($i=0;$i<$count_new;$i++){

            $fields[$i] = [
                'name' => $contacts_new['contact_name'][$i],
                'email' => $contacts_new['contact_email'][$i],
                'project_id' => $project -> id,
            ];

            if (($count > $i) && ($fields[$i]['name'] != $contacts[$i] -> name || $fields[$i]['email'] != $contacts[$i] -> email)){
                $msg[]='contacts';
            }
        }

        if (in_array('contacts', $msg)){
            $project -> contactPerson() -> delete();

            foreach ($fields as $field){
                $contact = new ContactPerson($field);
                $contact -> save();
            }
        }

        $msg = array_unique($msg);

        if (count($msg)){
            $msg = 'A user has changed: '.implode(', ', $msg);

            foreach ($project -> contactPerson as $contact){
//                Mail::raw([], function($message) use ($contact, $msg){
//                    $message->from('contact@company.com', 'Company name');
//                    $message->to($contact -> email);
//                    $message->subject('Project has been changed');
//                    $message->setBody( "<html><p>{{$msg}}</p></html>", 'text/html' );
//                });
            }

        }

        return back()->with('success','Project editet successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project -> delete();
        //
    }
}
