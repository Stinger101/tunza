<?php

namespace App\Http\Controllers;

use App\Caregiver;
use Illuminate\Http\Request;
use App\Child;

class CaregiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($child_id)
    {
        //
        return Child::find($child_id)->caregivers()->get();
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
    public function store(Request $request,$child_id)
    {
        //
        // TODO: check if user is registered on system
        if(\App\User::where("email",$request->email_provided)->count()>0){
          return Caregiver::create([
            "is_active"=>true,
            "invited_on"=>\Carbon\Carbon::now(),
            "is_registered"=>true,
            "email_provided"=>$request->email_provided,
            "user_id"=>\App\User::where("email",$request->email_provided)->get()[0]["user_id"],
            "parent_id"=>\Auth::user()->id,
            "child_id"=>$child_id,
            "category_id"=>$request->category_id
          ]);
        }else{
          return Caregiver::create([
            "is_active"=>true,
            "invited_on"=>\Carbon\Carbon::now(),
            "is_registered"=>false,
            "email_provided"=>$request->email_provided,
            "parent_id"=>\Auth::user()->id,
            "child_id"=>$child_id,
            "category_id"=>$request->category_id
          ]);
        }
        // TODO: add email functionality and controller to handle invites
        // processing i.e. when they register on the system using the link or
        //in some other way they are updated as registered and user_id is set for all

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Caregiver  $caregiver
     * @return \Illuminate\Http\Response
     */
    public function show(Caregiver $caregiver_id)
    {
        //
        return $caregiver_id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Caregiver  $caregiver
     * @return \Illuminate\Http\Response
     */
    public function edit(Caregiver $caregiver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Caregiver  $caregiver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caregiver $caregiver_id)
    {
        //
        // TODO: find out how to use this method
        if(isset($request["is_active"])){
          $caregiver_id->is_active=$request->is_active;
        }
        if(isset($request["status_changed_on"])){
          $caregiver_id->status_changed_on=$request->status_changed_on;
        }
        if(isset($request["category_id"])){
          $caregiver_id->category_id=$request->category_id;
        }
          $caregiver_id->update();

          return $caregiver_id;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Caregiver  $caregiver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caregiver $caregiver_id)
    {
        //
        $caregiver_id->delete();
        return ["status"=>"deleted"];
    }
}
