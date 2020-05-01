<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Child;
use Illuminate\Http\Request;
use Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($child_id)
    {
        //// TODO: filter by visibility
        if(request("search")!=null){
          return Topic::where("child_id",$child_id)->get();
        }else{
          $search_key=request("search");
          return Topic::where("child_id",$child_id)->where("topic","like","%{$search_key}%")->get();
        }


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
        $topic=Topic::create([
          "topic"=>$request->topic,
          "child_id"=>$child_id->id,
          "editor_id"=>Auth::user()->id

        ]);
        if(isset($request->attachment)){
          $attachment_url=$request->file('attachment_url')->storeAs('communication/topics',$topic->id)
          $attachment_type=pathinfo("storage_path".$attachment_url,PATHINFO_EXTENSION);
          $topic->attachment_url=$attachment_url;
          $topic->attachment_type=$attachment_url;
          $topic->update();
        }
        return $topic;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Child $child_id, Topic $topic_id)
    {
        //
        return Topic::find($topic_id->id)->with("comments")->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Child $child, Topic $topic_id)
    {
        //
        if($child_id->parent_id==Auth::user()->id||$topic_id->editor_id==Auth::user()->id){
          if(isset($request->topic)){
            $topic_id->topic=$request->topic;
          }
          if(isset($request->attachment)){
            $attachment_url=$request->file('attachment_url')->storeAs('communication/topics',$topic_id->id);
            $attachment_type=pathinfo("storage_path".$attachment_url,PATHINFO_EXTENSION);
            $topic_id->attachment_url=$attachment_url;
            $topic_id->attachment_type=$attachment_url;

          }
          if(isset($request->status)){
            $topic_id->status=$request->status;
          }
          $topic_id->update();
          return $topic_id;
        }else{
          abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Child $child_id, Topic $topic_id)
    {
        //
        if($child_id->parent_id==Auth::user()->id||$topic_id->editor_id==Auth::user()->id){
        $topic_id->delete();
        return ["status"=>"deleted"];
        }else{
          abort(403, 'Unauthorized action.');
        }
    }
}
