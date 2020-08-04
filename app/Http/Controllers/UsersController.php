<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;
use DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '!=', 'A')->get();
        return view('admin.users.indexx', compact('users'));

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
        $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'mobile' => 'unique:users',
          'password' => 'required|string|min:6',
        ]);

        $input = $request->all();

        User::create([
          'name' => $input['name'],
          'email' => $input['email'],
          'password' => bcrypt($input['password']),
          'mobile' => $input['mobile'],
          'address' => $input['address'],
          'city' => $input['city'],
          'role' => $input['role'],
        ]);

        return back()->with('added', 'User has been added');
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
        $user = User::findOrFail($id);

        $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email',
          'password' => 'required|string|min:6',
          'mobile' => 'unique:users',
        ]);

        $input = $request->all();

         // if(isset($request->changepass))
         //    {
         //       DB::table('users')->where('id', $user->id)->update(['password' => Hash::make($request->password)]);
         //    }
         //    else
         //    {
         //      $input['password'] = $user->password;
         //    }

        if (Auth::user()->role == 'A') {
          $user->update([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'mobile' => $input['mobile'],
            'address' => $input['address'],
            'city' => $input['city'],
            'role' => $input['role'],
          ]);
        } else if (Auth::user()->role == 'S') {
          $user->update([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'mobile' => $input['mobile'],
            'address' => $input['address'],
            'city' => $input['city'],
          ]);
        }

        return back()->with('updated', 'Kullanıcı Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('deleted', 'Kullanıcı Silindi');
    }

}
