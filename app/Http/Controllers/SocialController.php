<?php

namespace App\Http\Controllers;

use App\SocialIcons;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $social = SocialIcons::all();
        // return view('admin.moresettings.socialicons.index',compact('social'));
        return view('admin.socialicons.index',compact('social'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.moresettings.socialicons.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



      $social = new SocialIcons;

      $social->title = $request->title;
      $social->url = $request->url;
      
      if(isset($request->status)){
        $social->status = 1;
      }else{
        $social->status = 0;
      }

      if ($file2 = $request->file('icon')) {

          $name2 = $file2->getClientOriginalName();
          $file2->move('images/socialicons/', $name2);
          $social['icon'] = $name2;

      }

      $social->save();
      return back()->with('added', 'Ikon Eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SocialIcons  $socialIcons
     * @return \Illuminate\Http\Response
     */
    public function show(SocialIcons $socialIcons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialIcons  $socialIcons
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialIcons $socialIcons)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialIcons  $socialIcons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialIcons $socialIcons)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialIcons  $socialIcons
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $si = SocialIcons::findOrFail($id);
        if($si->icon!="")
        {
          unlink(public_path().'/images/socialicons/'.$si->icon);
        }
        $si->delete();
        return back()->with('deleted', 'Ikon Silindi !');
    }

    public function active($id)
    {
        $s = SocialIcons::findOrFail($id);
        $s->status=1;
        $s->save();
        return back()->with('updated', 'Ikon Durumu Aktif !');
    }

    public function deactive($id)
    {
        $s = SocialIcons::findOrFail($id);
        $s->status=0;
        $s->save();
        return back()->with('updated', 'Ikon Durumu Inaktif !');
    }
}
