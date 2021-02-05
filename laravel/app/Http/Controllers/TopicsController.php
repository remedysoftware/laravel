<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use Auth;
use Validator;
class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $topics = Topic::orderBy('id', 'desc')->get()->toJson(JSON_PRETTY_PRINT);
        return response($topics, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // OLD FUNCTION
    // NEW METHODS IS createTopic -> check for user AUTH and if user is admin
    // please proceed to method @ createTopic
    public function store(Request $request)
    {
        //
        // Createa new topic
        $topic = new Topic;
        $topic->topic_name = $request->topic_name;
        $topic->topic_body = $request->topic_body;
        $topic->topic_tags = $request->topic_tags;
        $topic->topic_image = $request->topic_image;

        $topic->save();
    
        return response()->json([
            "message" => "topic created successfully"
        ], 201);
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
        if (Topic::where('id', $id)->exists()) {
            $topic = Topic::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($topic, 200);
          } else {
            return response()->json([
              "message" => "No such news found"
            ], 404);
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
    public function update(Request $request, $id)
    {
        //
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

    // custom news tag search

    public function tagSearch(Request $request){

        if ( isset($request->hashtag) ){
            $hashtag = $request->hashtag;
            if (Topic::where('topic_tags','like', '%'.$hashtag.'%')->exists()) {
                $topicsWithTags = Topic::where('topic_tags','like', '%'.$hashtag.'%')->get()->toJson(JSON_PRETTY_PRINT);
                return response($topicsWithTags, 200);
              } else {
                return response()->json([
                  "message" => "No such news with this tags"
                ], 200);
              }
        }else{
            return response()->json([
                "message" => "Hashtag not found"
            ],200);
        }

    }

    // custom show news by categorie
    public function showNewsByCategory(Request $request){

        if ( isset($request->categoryId) ){
            $categoryId = $request->categoryId;
            if (Topic::where('topic_categories', $categoryId)->exists()) {
                $returnNews = Topic::where('topic_categories', $categoryId)->get()->toJson(JSON_PRETTY_PRINT);
                return response($returnNews, 200);
              } else {
                return response()->json([
                  "message" => "No such news with this tags"
                ], 200);
              }
        }else{
            return response()->json([
                "message" => "No news in this category"
            ],200);
        }

    }

    // ADMIN CRUD TOPICS


    function createTopic(Request $request){
        if($user = Auth::user()) {
            // check if user is admin
            $is_admin = Auth::user()->is_admin;
    
            if ( $is_admin == 1 ){
                $topic = new Topic;
                $topic->topic_name = $request->topic_name;
                $topic->topic_body = $request->topic_body;
                $topic->topic_tags = $request->topic_tags;
                $topic->topic_categories = $request->topic_categories;
                $topic->topic_full_body_text = $request->topic_full_body_text;
                $topic->topic_image = $request->topic_image;
                $topic->admin_id = Auth::user()->id;
                $topic->save();
                return response()->json([
                    "message" => "topic created successfully"
                ], 201);

            }else{
                return response()->json([
                    "message" => "you dont have permissions"
                ], 400);
            }
        }else{
            return response()->json([
                "message" => "you dont have permissions"
            ], 400);
        }
    }

    // custom, its post not delete, but i have problem with ICN server, and server blocks me when try to make PUT/DELETE REQUEST
    public function deleteTopic(Request $request){
        if($user = Auth::user()) {
            // check if user is admin
            $is_admin = Auth::user()->is_admin;
    
            if ( $is_admin == 1 ){

                if ( $request->topic_id != 0){

                    $topicID = $request->topic_id;
                    if(Topic::where('id', $topicID)->exists()) {
                        $topic = Topic::find($topicID);
                        $topic->delete();
                
                        return response()->json([
                        "message" => "topic deleted"
                        ], 202);
                    } else {
                        return response()->json([
                        "message" => "Topic not found"
                        ], 404);
                    }

                    }
            }else{
                return response()->json([
                    "message" => "you dont have permissions"
                ], 400);
            }
        }else{
            return response()->json([
                "message" => "you dont have permissions"
            ], 400);
        }
    }

        // custom, its post not delete, but i have problem with ICN server, and server blocks me when try to make PUT/DELETE REQUEST
        public function editTopic(Request $request){
            if($user = Auth::user()) {
                // check if user is admin
                $is_admin = Auth::user()->is_admin;
        
                if ( $is_admin == 1 ){
    
                    if ( $request->topic_id != 0){
                        $topic_id = $request->topic_id;
                        // echo $topic_id;
                        if (Topic::where('id', $topic_id )->exists()) {
                            $topic = Topic::find($topic_id);
                            $topic->topic_name = is_null($request->topic_name) ? $topic->topic_name : $request->topic_name;
                            $topic->topic_body = is_null($request->topic_body) ? $topic->topic_body : $request->topic_body;
                            $topic->topic_tags = is_null($request->topic_tags) ? $topic->topic_tags : $request->topic_tags;
                            $topic->topic_categories = is_null($request->topic_categories) ? $topic->topic_categories : $request->topic_categories;
                            $topic->topic_full_body_text = is_null($request->topic_full_body_text) ? $topic->topic_full_body_text : $request->topic_full_body_text;
                            $topic->topic_image = is_null($request->topic_image) ? $topic->topic_image : $request->topic_image;

                            $topic->save();
                    
                                return response()->json([
                                    "message" => "records updated successfully"
                                ], 200);
                            } else {
                                return response()->json([
                                    "message" => "topic not found"
                                ], 404);
                            
                          }
    
                    }
                }else{
                    return response()->json([
                        "message" => "you dont have permissions"
                    ], 400);
                }
            }else{
                return response()->json([
                    "message" => "you dont have permissions"
                ], 400);
            }
        }
}
