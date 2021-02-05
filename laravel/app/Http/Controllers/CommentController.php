<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;

// use Auth;

class CommentController extends Controller
{
    public function index(Topic $topic){

        return $topic->comments()->with('user')->latest()->get()->toJson(JSON_PRETTY_PRINT);;

    }

    public function store(Request $request, Topic $topic){

        // // TO DO -> validate body
        // $comment = $topic->comments()->create([
        //     'body' => $request->body,
        //     'user_id' => Auth::id()

        // ]);
        
        // $comment = Comment::where('id', $comment->id)->with('user')->first()>toJson(JSON_PRETTY_PRINT);

        // // retrun $comment;
        // return response($comment, 200);

    }
    public function getAllCommentsOfaNews($news_id){

        if (Comment::where('post_id', $news_id)->exists()) {

            $comments['comments'] = Comment::where('post_id', $news_id)->orderBy('id', 'desc')->get();

            // TO DO -> return user name
            // $userID = Comment::where('post_id', $news_id)->first('user_id');
            // $username = User::where('id', $userID['user_id'])->get('name');
            // $comments[$userID['user_id']]=  $username;

            // $response = [
            //     'comments' => $comments,
            //     'username' => $username
            // ];
            return response($comments, 200);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404); 
          }

    }
    // create comment
    public function createComment(Request $request){
        if($user = Auth::user()) {
            if (!empty($request->comment && !empty($request->user_id && !empty($request->topic_id)))){
                
                $comments = new Comment;
                $comments->body = $request->comment;
                $comments->user_id = $request->user_id;
                $comments->post_id = $request->topic_id;
                $comments->save();

                return response()->json([
                    "message" => "comment posted succsesfully"
                ], 201);
            }
        }else{
             return response()->json([
              "message" => "you dont have access to post comment"
            ], 404); 
        }
    }
}
