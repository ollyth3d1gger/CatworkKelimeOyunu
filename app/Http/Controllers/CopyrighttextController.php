<?php

namespace App\Http\Controllers;

use App\copyrighttext;
use Illuminate\Http\Request;

class CopyrighttextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $ct = copyrighttext::all();
        return view('admin.copyright.index',compact('ct'));
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
    public function store(Request $request,$id)

    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\copyrighttext  $copyrighttext
     * @return \Illuminate\Http\Response
     */
    public function show(copyrighttext $copyrighttext)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\copyrighttext  $copyrighttext
     * @return \Illuminate\Http\Response
     */
    public function edit(copyrighttext $copyrighttext)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\copyrighttext  $copyrighttext
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

      $this -> validate($request,[
            'name'=>'required',
            ]);

        $ct = copyrighttext::findorfail($id);
        $ct->name = $request->name;
        $ct->save();
        return back()->with('success','Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\copyrighttext  $copyrighttext
     * @return \Illuminate\Http\Response
     */
    public function destroy(copyrighttext $copyrighttext)
    {
        //
    }
}
