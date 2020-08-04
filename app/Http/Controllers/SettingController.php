<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings', compact('settings'));
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
    public function store(Request $request)
    {
        //
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
        $setting = Setting::findOrFail($id);
        

        $request->validate([
          'logo' => 'image|mimes:jpeg,png,jpg',
          'favicon' => 'mimes:ico',
          'userquiz' => 'int',
          'w_email' => 'required|email',
          'currency_code'=>'required',
          'currency_symbol'=>'required'

        ]);

        $input = $request->all();

        if ($file = $request->file('logo')) {

          $name = 'logo_'.time().$file->getClientOriginalName();
          unlink(public_path().'/images/logo/'.$setting->logo);
          $file->move('images/logo/', $name);
          $input['logo'] = $name;

        }

        if ($file2 = $request->file('favicon')) {

            $name2 = $file2->getClientOriginalName();
            unlink(public_path().'/images/logo/'.$setting->favicon.'.ico');
            $file2->move('images/logo/', $name2);
            $input['favicon'] = $name2;

        }

        if(isset($request->rightclick)){
            
            $setting->right_setting = 1;

        }else{

            $setting->right_setting = 0;

        }

        if(isset($request->inspect)){
            $setting->element_setting = 1;
        }else{
            $setting->element_setting = 0;
        }

        $setting->update($input);
        return back()->with('updated', 'Ayarlar Kaydedildi !');

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
}
