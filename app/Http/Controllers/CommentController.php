<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Child;
use App\Topic;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Child $child_id,Topic $topic_id)
    {
        //
        return Comment::where("topic_id",$topic_id->id)->with(["editor:id,name"])->get();
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
    public function store(Request $request,Child $child_id,Topic $topic_id)
    {
        //
        $comment=Comment::create([
          "comment"=>$request->comment,
          "topic_id"=>$topic_id->id,
          "editor_id"=>Auth::user()->id

        ]);
        if(isset($request->attachment)){
          $attachment_url=$request->file('attachment_url')->storeAs('communication/comments',$comment->id);
          $attachment_type=pathinfo("storage_path".$attachment_url,PATHINFO_EXTENSION);
          $comment->attachment_url=$attachment_url;
          $comment->attachment_type=$attachment_url;
          $comment->update();
        }
        if(isset($request->is_answer)){
          $comment->is_answer=$request->is_answer;
        }
        return $comment;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Child $child_id,Topic $topic_id,Comment $comment_id)
    {
        //
        return $comment_id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Child $child_id,Topic $topic_id,Comment $comment_id)
    {
        //
        if(isset($request->comment)){
          $comment_id->comment=$request->comment;
        }

        if(isset($request->attachment)){
          $attachment_url=$request->file('attachment_url')->storeAs('communication/comments',$comment_id->id);
          $attachment_type=pathinfo("storage_path".$attachment_url,PATHINFO_EXTENSION);
          $comment_id->attachment_url=$attachment_url;
          $comment_id->attachment_type=$attachment_url;
          $comment_id->update();
        }
        if(isset($request->is_answer)){
          $comment_id->is_answer=$request->is_answer;
        }
        return $comment_id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Child $child_id,Topic $topic_id,Comment $comment_id)
    {
        //
        if($topic_id->editor_id==Auth::user()->id){
          $comment_id->delete();
          return ["status"=>"deleted"];
        }else{
          abort(403, 'Unauthorized action.');
        }
    }
}
