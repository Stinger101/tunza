<?php

namespace App\Http\Controllers;

use App\Caregiver;
use Illuminate\Http\Request;
use App\Child;
use App\Mail\CaregiverInvite;
use Illuminate\Support\Facades\Mail;

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
          $user=\App\User::where("email",$request->email_provided)->get()[0];
          if($user->userrole==null){
            \App\UserRole::create(["user_id"=>$user->id,"role_id"=>2]);
          }else{
            if($user->userrole->role_id==1){
              $user->userrole->role_id=3;
              $user->userrole->update();
            }
          }
          $invite=Caregiver::create([
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
          $invite= Caregiver::create([
            "is_active"=>true,
            "invited_on"=>\Carbon\Carbon::now(),
            "is_registered"=>false,
            "email_provided"=>$request->email_provided,
            "parent_id"=>\Auth::user()->id,
            "child_id"=>$child_id,
            "category_id"=>$request->category_id
          ]);
        }

        dispatch(function () use($request,$invite) {
          Mail::to($request->email_provided)->send(new CaregiverInvite($invite,\Auth::user()));
        });

        return $invite;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Caregiver  $caregiver
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Child $child_id,Caregiver $caregiver_id)
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
    public function update(Request $request, \App\Child $child_id,Caregiver $caregiver_id)
    {
        //
        // TODO: find out how to use this method
        if(isset($request["is_active"])){
          $caregiver_id->is_active=$request->is_active;
        }
        if(isset($request["status"])){
          $caregiver_id->status=$request->status=="1"?1:$request->status=="0"?0:null;
          $caregiver_id->status_changed_on=\Carbon\Carbon::now();
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
    public function destroy(\App\Child $child_id,Caregiver $caregiver_id)
    {
        //
        $caregiver_id->delete();
        return ["status"=>"deleted"];
    }
}
