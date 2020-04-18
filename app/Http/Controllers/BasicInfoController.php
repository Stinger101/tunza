<?php

namespace App\Http\Controllers;

use App\BasicInfo;
use App\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BasicInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($child_id)
    {
        //
        return Child::find($child_id)->basicInfo()->get();
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
    public function store(Request $request,Child $child_id)
    {
        //
        if(\Auth::user()->id == $child_id->parent_id){
          $basicInfo = BasicInfo::create({
            "child_id"=>$child_id->id,
            "editor_id"=>\Auth::user()->id,
            "topic"=>$request->topic,
            "content"=>$request->content,
            "visibility"=>$request->visibility
          });
          if(isset($request->attachment)){
            $basicInfo->attachment=$request->file('attachment')->storeAs('attachments/basicInfo',$basicInfo->id);
            $basicInfo->update();
          }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BasicInfo  $basicInfo
     * @return \Illuminate\Http\Response
     */
    public function show(Child $child_id,BasicInfo $basicinfo_id)
    {
        //
        return $basicinfo_id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BasicInfo  $basicInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(BasicInfo $basicinfo_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BasicInfo  $basicInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Child $child_id, BasicInfo $basicinfo_id)
    {
        //
        if(isset($request->visibility)){
          $basicinfo_id->visibility=$request->visibility;
        }
        if(isset($request->topic)){
          $basicinfo_id->topic=$request->topic;
        }
        if(isset($request->content)){
          $basicinfo_id->content=$request->content;
        }
        if(isset($request->attachment)){
          if(Storage::exists($basicInfo->attachment)){
            Storage::delete($basicInfo->attachment);
          }
          $basicInfo->attachment=$request->file('attachment')->storeAs('attachments/basicInfo',$basicInfo->id);
        }
        $basicinfo_id->update();
        return $basicinfo_id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BasicInfo  $basicInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Child $child_id, BasicInfo $basicinfo_id)
    {
        //
        $basicinfo_id->delete();
        return ["status"=>"deleted"];
    }
}
