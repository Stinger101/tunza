<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caregiver;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Caregiver::where("email_provided",\Auth::user()->email)->where("status",null)->with(["parent:id,name","child:id,name"])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($invite_id)
    {
        //
        if(Caregiver::find($invite_id)->user_id==\Auth::user()->id){
          return Caregiver::where("id",$invite_id)->with(["parent:id,name","child:id,name"])->get()[0];
        }else{
          abort(403, 'Unauthorized action.');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caregiver $invite_id)
    {
        //
        if($invite_id->email_provided==\Auth::user()->email){
          if(isset($request["status"])){
            $invite_id->status=$request->status;
            $invite_id->status_changed_on=\Carbon\Carbon::now();
          }
          $invite_id->update();

          return $invite_id;
        }else{
          abort(403, 'Unauthorized action.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
