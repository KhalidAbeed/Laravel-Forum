<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;

class post10 extends Controller
{

    public function __construct()
    {
        $this->middleware('check')->only('create');


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p=Post::all();
        return view('posts.index',['post'=>$p]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat=Category::all();
        return view('posts.create',['categories' =>$cat])->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->isMethod('post'))
        {
            $request->validate([
                'title' =>'required|unique:posts',
                'description' =>'required',
                'content' =>'required',
                'image' =>'required|image',
            ]);
            $po=new Post();
            $po->title=$request->input('title');
            $po->description=$request->input('description');
            $po->content=$request->input('content');
            $po->image=$request->image->store('images','public');
            $po->category_id=$request->input('category_id');
            $po->save();
            if($request->tags)
            {
                $po->tags()->attach($request->tags);
            }

        }

        return redirect(route('posts.index'));

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $r=Post::find($id);
        return view ('posts.update',['re'=>$r]);
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

        $a = Post::find($id);
        /*$a->update([
            'name'=>$request->name,
        ]);*/
        $a->name = $request->input('name');
        $a->save();
        session()->flash('succecc','posts is updated');
        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $po=Post::withTrashed()->where('id',$id)->first();
        if($po->trashed())
        {
            $po->forceDelete();
        }
        else
            $po->delete();

        return redirect(route('trashed.index'));
    }

    public function trashed()
    {
        $trash=Post::onlyTrashed()->get();
        return view('posts.index',['post'=>$trash]);
    }
}
