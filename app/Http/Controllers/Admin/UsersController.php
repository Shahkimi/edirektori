<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Bahagian;
use App\Bahagian_user;
use App\Unit;
use DB;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function _construct(){
        $this->middleware['auth'];
    }


    public function index()
    {
        $users = User::all();
        $bahagian = Bahagian::all();
        $roles = Role::all();

        $users = DB::table('users')
                    ->select('users.*','tbahagian.bahagian','roles.name as role')
                    ->leftJoin('bahagian_user', 'bahagian_user.user_id', '=', 'users.id')
                    ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                    ->leftJoin('tbahagian', 'bahagian_user.bahagian_id', '=', 'tbahagian.id')
                    ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
                    ->get();

        return view('admin.users.index')->with([
            'users'=> $users,
            'bahagian'=> $bahagian,
            'roles'=> $roles,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }

        $roles = Role::all();

        $bahagians = Bahagian::all();

        //$bahagian_user = DB::table('bahagian_user')->where('user_id', $user->id)->firstOrFail();
        $bahagian_user = Bahagian_user::where('user_id', $user->id)->firstOrFail();

        //echo count($bahagian_user);

        //if (count($bahagian_user) < 1)  $bahagian_user->bahagian_id = "";

    // echo json_encode($bahagian_user);
      //  echo json_encode($user);

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'bahagians' => $bahagians,
            'bahagian_user' => $bahagian_user->bahagian_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;
        $new_password = $request->new_password;
        $confirm_new_password = $request->confirm_new_password;

        if ($new_password<>NULL) {
            if (strcmp($new_password, $confirm_new_password) <> 0) {
                return back()->with('error','Your new password does not match with confirm new password');
            }

            $user->password = bcrypt($new_password);
        }

        $user->save();

        $id = $user->id;
        $bahagian = $request->bahagian;
      
        //echo json_encode($id);

        if ($bahagian==NULL) $bahagian = "";     

        Bahagian_user::where('user_id', $id)->update(array(
            'bahagian_id' => $bahagian
        )); 

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function create()
    {

        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }

        $bahagian = Bahagian::all();
        $roles = Role::all();
        //echo json_encode($roles);
        return view('admin.users.create')->with([
            'bahagian' => $bahagian,
            'roles' => $roles,
        ]);
    }

    public function store(){

        //checking

        $roles = request('roles');
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);
        
        $bahagian = Bahagian::select('id')->where('id',request('bahagian'))->first();
        $user->roles()->attach($roles);
        $user->bahagian()->attach($bahagian);

        return redirect()->route('admin.users.index');
    }

public function search()
    {
        
        $name = request('name');
        $email = request('email');
        $idbahagian = request('bahagian');
        $idrole = request('role');

        if ($name==NULL) $name = '%';
        if ($email==NULL) $email = '%';

        $users = DB::table('users')
                    ->select('users.*','tbahagian.bahagian','roles.name as role')
                    ->leftJoin('bahagian_user', 'bahagian_user.user_id', '=', 'users.id')
                    ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                    ->leftJoin('tbahagian', 'bahagian_user.bahagian_id', '=', 'tbahagian.id')
                    ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
                    ->where('bahagian_user.bahagian_id','like', '%'.$idbahagian.'%')
                    ->where('users.name','like', '%'.$name.'%')
                    ->where('users.email','like', '%'.$email.'%')
                    ->where('role_user.role_id','like', '%'.$idrole.'%')
                    ->get();

        $bahagian = Bahagian::all();
        $roles = Role::all();

        return view('admin.users.index')->with([
            'users'=> $users,
            'bahagian'=> $bahagian,
            'roles'=> $roles,
        ]);
    }

    public function resetpassword()
    {

        $id = Auth::id();

        $user = User::findOrFail($id);

        $roles = Role::all();

        $bahagians = Bahagian::all();

        $bahagian_user = Bahagian_user::where('user_id', $user->id)->firstOrFail();

        return view('admin.users.reset')->with([
            'user' => $user,
            'roles' => $roles,
            'bahagians' => $bahagians,
            'bahagian_user' => $bahagian_user->bahagian_id,
        ]);
    }

    public function changePassword(Request $request)
    {

        if(!(Hash::check($request->get('current_password'),Auth::user()->password))) {
            return back()->with('error','Your current password does not match');
        }

        if (strcmp($request->get('current_password'), $request->get('new_password'))==0) {
            return back()->with('error','Your current password cannot same with your new password'.$request->get('new_password'));
        }

        if (strcmp($request->get('new_password'), $request->get('c_new_password'))<>0) {
            return back()->with('error','Your new password does not match with confirm new password');
        }

            $validator = Validator::make($request->all(), [
                            'current_password' => 'required',
                            'new_password' => 'required',
                            'c_new_password' => 'required',
                        ]);

           if (!$validator->fails())
           {
                $user = Auth::user();
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
                return back()->with('message','Password Change Successfully');
           } else {
                return back()->with([
                'error' => 'All field are required',
                ]);

           }

    }
}

