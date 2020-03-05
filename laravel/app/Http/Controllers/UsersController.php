<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\Solde;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // Get trait money account
    use Solde;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Get all users
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(5);
        return view('users.users_gestion',compact('users'));
    }
    // Get personal data
    public function editPersonalData()
    {
        // Get money account
        $moneyAccount = $this->moneyAccount();
        // Get self data from database
        $selfData = DB::table('users')->select('*')->where('id','=',Auth::user()->id)->get();
        return view('users.account_management', compact('selfData','moneyAccount'));
    }
    // Show personal data
    public function showPersonalData()
    {
        // Get money account
        $moneyAccount = $this->moneyAccount();
        // Get user auth id
        $user = User::find(Auth::user()->id);
        return view('users.account_management_edit', compact('user','moneyAccount'));
    }
    // Update account
    public function updateAccount(Request $request)
    {
        // Store personal data
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);
        $users = User::find(Auth::user()->id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        if ($request->input('password') !== null) {
            $users->fill([
                'password' => Hash::make($request->input('password'))
            ]);
        }
        $users->save();
        return redirect('/account_management')->with('success', 'Votre compte a été mis à jour avec succès');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Get form new user
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
    // store user data
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $users = new User;
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->status = $request->input('status');
        $users->fill([
            'password' => Hash::make($request->input('password'))
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
    // Show form edit user data
    public function show($id)
    {
        // Get user from id
        $user = User::find($id);
        return view('users.edit_user')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Update user data
    public function update(Request $request, $id)
    {
        // Store user data
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $users = User::find($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->status = $request->input('status');
        $users->save();
        return redirect('/users_gestion')->with('success', 'Votre utilisateur a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Destroy user
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users_gestion')->with('success', 'l\'utilisateur '.$user->name.' à bien été supprimé');
    }
}
