<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class cont10 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a=Category::all();

        return view('categories.index',['res'=>$a]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
                'name'=>'required'
            ]);
            $a=new Category();
            $a->name=$request->input('name');
            $a->save();
        }
        session()->flash('succecc','category is added');
        return redirect(route('categories.index'));
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
        $r=Category::find($id);
        return view ('categories.update',['re'=>$r]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

            $a = Category::find($id);
            /*$a->update([
                'name'=>$request->name,
            ]);*/
            $a->name = $request->input('name');
            $a->save();
            session()->flash('succecc','category is updated');
            return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r=Category::find($id);
        $r->delete();
        session()->flash('succecc','category is Deleted');
        return redirect(route('categories.index'));

    }
}
