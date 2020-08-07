<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class tag10 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p=Tag::all();
        return view('tags.index',['tag'=>$p]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat=Tag::all();
        return view('tags.create',['tags' =>$cat]);

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
                'name' =>'required',
            ]);
            $po=new Tag();
            $po->name=$request->input('name');
            $po->save();
        }
        return redirect(route('tags.index'));


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
        $r=Tag::find($id);
        return view ('tags.update',['re'=>$r]);

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
        $a = Tag::find($id);
        /*$a->update([
            'name'=>$request->name,
        ]);*/
        $a->name = $request->input('name');
        $a->save();
        session()->flash('succecc','Tags is updated');
        return redirect('tags');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r=Tag::find($id);
        $r->delete();
        session()->flash('succecc','tag is Deleted');
        return redirect(route('tags.index'));

    }
}
