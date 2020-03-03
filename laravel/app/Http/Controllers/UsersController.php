<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(5);
        return view('users.users_gestion')->with('users',$users);
    }

    public function editPersonalData()
    {
        $selfData = DB::table('users')->select('*')->where('id','=',Auth::user()->id)->get();
        return view('users.account_management', compact('selfData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create_users');
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $users = new User;
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->status = $request->input('status');
        $users->fill([
            'password' => Hash::make($request->newPassword)
        ]);
        $users->save();
        return redirect('/users_gestion')->with('success', 'Votre utilisateur a été créé avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.edit_user')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('users.edit_user')->with('users',$users);

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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $users = User::find($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->status = $request->input('status');
        $users->fill([
            'password' => Hash::make($request->newPassword)
        ]);
        $users->save();
        return redirect('/users_gestion')->with('success', 'Votre utilisateur a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users_gestion')->with('success', 'l\'utilisateur '.$user->name.' à bien été supprimé');
    }
}
