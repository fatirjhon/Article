<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment, App\Article;
use Session;

class CommentsController extends Controller

// { 	public function store(Request $request) {
//     $validate = Validator::make($request->all(), Comment::valid());
// 	if($validate->fails()) {
// 		return Redirect::to('articles/'. $request->article_id)
// 		->withErrors($validate)
// 		->withInput();
// 	} else {
// 		Comment::create($request->all());
// 		Session::flash('notice', 'Success add comment');
// 		return Redirect::to('articles/'. $request->article_id); }
// 	}
// }
 
{
	protected $rules =
    [
        'content' => 'required|min:2|max:32|regex:/^[a-z ,.\'-]+$/i',
        'user' => 'required|min:2|max:128|regex:/^[a-z ,.\'-]+$/i'
    ];
    public function store(Request $request)
	{
		$comment = new Comment();
		$comment->article_id = $request->article_id;
		$comment->content = $request->content;
		$comment->user = $request->user;
		$comment->save();
		return response()->json($comment);
	}
	public function index()
	{
		return view('welcome');
	}
	public function destroy($id)
    {
        $post = Comment::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }
}
