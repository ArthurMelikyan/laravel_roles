<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRoles =  Role::all();
        $user = Auth::user();
        // dd(User::find(5));
        // dd($user);
        // $user->assignRole('manager');
        // dd($allRoles);
        // Role::create(['name'=>'developer']);

        // $permission = Permission::create(['name'=>'delete']);
        // $role = Role::findById(1);
        // $permission = Permission::findById(1);
        // $role->givePermissionTo($permission);
        return view('home', compact('allRoles'));
    }


    public function createMember(Request $request ){
        $user = new User();
        // dd($request->all());

        $user->remember_token = $request->_token;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        // if ($user->save()) {
            $user->save();
            Log::debug( Auth::user());
            Auth::loginUsingId($user->id);
            $authUser = Auth::user();
            $authUser->assignRole($request->role);
            Log::debug('.............................');
            Log::debug( Auth::user());
            Log::debug('............AUTH::USER FIND..........');
            Log::debug(Auth::loginUsingId($user->id));


            return redirect('/');
        // }
    }
}
