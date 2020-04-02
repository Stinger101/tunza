<?php

namespace App\Http\Controllers;

use App\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //// TODO: allow for caregivers to view children
        return Child::where("parent_id",\Auth::user()->id)->get();
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
        $child=Child::create([
          "name"=>$request["name"],
          "date_of_birth"=>$request["date_of_birth"],
          "parent_id"=>\Auth::user()->id
        ]);
        return $child;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Child  $child
     * @return \Illuminate\Http\Response
     */
    public function show(Child $child_id)
    {
        //@// TODO: add checks if the person getting info is authorised
        if(\Auth::user()->id==$child_id->parent_id || \App\Caregiver::where("user_id",\Auth::user()->id)->where("child_id",$child_id->id)->count()){
          return $child_id;
        }else{
          return ["error"=>"unauthorised"];
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Child  $child
     * @return \Illuminate\Http\Response
     */
    public function edit(Child $child)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Child  $child
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Child $child_id)
    {
        //
        $child_id->name=$request["name"];
        $child_id->date_of_birth=$request["date_of_birth"];
        $child=$child_id->update();
        return Child::find($child);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Child  $child
     * @return \Illuminate\Http\Response
     */
    public function destroy(Child $child_id)
    {
        //
        if($child_id->parent_id==\Auth::user()->id){
          $child_id->delete();
        }
        return ["status"=>"deleted"];
    }
}
