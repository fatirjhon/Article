<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;    //wajib diload
use App\Http\Requests\ArticleRequest;
use Session;
use File;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct() {
    // $this->middleware('sentinel');
    // $this->middleware('sentinel.role');
    // }

    public function index()
    {
        $articles = Article::latest()->get();
        return view('articles.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        $data['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $data['image']);
        Article::create($data);
        Session::flash("notice", "Article success created");
        return redirect()->route("articles.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $comments = Article::find($id)->comments->sortBy('Comment.created_at');
        return view('articles.show')
        ->with('article', $article)
        ->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit')->with('article', $article);
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
        $result = Article::find($id);
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        $data['image'] = $result->image;
        if ($request->image !=null) {
            $request->image->move(public_path('images'), $data['image']);
        }
        Article::find($id)->update($request->all());
        Session::flash("notice", "Article success updated");
        return redirect()->route("articles.show", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Article::find($id);
        if(\File::exists(public_path('images/'.$result->image))){
              \File::delete(public_path('images/'.$result->image));
            }
        Article::destroy($id);
        Session::flash("notice", "Article success deleted");
        return redirect()->route("articles.index");
        $resultcomment = Article::find($id);
        if (Article::destroy($id)) {
            Comment::destroy($article_id);
        }
    }

    // public function __construct() {
    // $this->middleware('sentinel');
    // }
}
