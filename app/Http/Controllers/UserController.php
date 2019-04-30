<?php

namespace App\Http\Controllers;

use App\Level;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('get_level')->where('id_level','!=','1')->get();
        return view('pages.user.index', ['user'=> $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_level' => 'required|string|max:255',
        ]);

        User::create([
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_level' => $request->id_level
        ]);

        return redirect()->route('user')->with('success', 'Input Data Successfully!');
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
    public function edit(User $user)
    {
        $level = Level::all();
        return view('pages.user.edit', ['user'=>$user, 'level'=>$level]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'id_level' => 'required|string|max:255',
        ]);

        $user->update($request->except('_method', '_token'));

        return redirect()->route('user')->with('success', 'Update Data Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Delete Data Successfully');
    }

    public function change_password(User $user)
    {
        return view('pages.user.change_password', ['user'=>$user]);
    }

    public function update_password(Request $request,User $user)
    {
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update(['password'=>$request->password]);

        return redirect()->route('user')->with('success', 'Change Password Successfully!');
    }
}
