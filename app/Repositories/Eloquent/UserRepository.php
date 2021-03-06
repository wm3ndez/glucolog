<?php

namespace App\Repositories\Eloquent;

use App\Models\Board;
use App\Models\User;
use App\Repositories\Contracts\UserInterface;
use Auth;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface
{
    public function index()
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('Super Admin')) {
            $users = User::paginate(5);
        } else {
            $users = User::where('board_id', '=', Auth::user()->board_id)->paginate(5);
        }

        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('Super Admin')) {
            $boards = Board::all();
            $roles = Role::get();
        } else {
            $boards = Board::where('id', '=', Auth::user()->board_id)->get();
            $roles = Role::where('id', '=', Auth::user()->board_id)->where('name', '!=', 'Super Admin')->get(); //Get all roles
        }
        return view('users.create', compact('roles', 'boards'));
    }

    public function store($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'birthday' => $request->birthday,
            'detection_date' => $request->detection_date,
            'diabetes' => $request->diabetes,
            'board_id' => Auth::user()->board_id,
        ]);

        $roles = $request->roles; //retrieving the roles field

        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();

                if ($role_r->id == '1') {
                    $user->assignRole($role_r);
                    break;
                }

                $user->assignRole($role_r); //Assigning role to user
            }
        }
        //create a new token to be sent to the user.
        $token = app('auth.password.broker')->createToken($user);

        //$user->notify(new Welcome($token));
        //Redirect to the users.index view and display message
        flash('Usuario creado exitosamente.')->success();

        return redirect()->route('users.index');
    }

    public function update($request, $user)
    {
        $roles = $request->roles;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->detection_date = $request->detection_date;
        $user->diabetes = $request->diabetes;
        if ($request->new_password !== null) {
            $user->password = bcrypt($request->new_password);
        }
        $user->update();

        if (isset($roles)) {
            if (collect($roles)->contains(1)) {
                $user->roles()->detach();
                $user->roles()->attach(1);
            } else {
                $user->roles()->sync($roles); //If one or more role is selected associate user to roles
            }
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        flash('Usuario actualizado exitosamente.')->success();
        return redirect()->route('users.index');
    }

    public function edit($user)
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('Super Admin')) {
            $boards = Board::all();
            $roles = Role::get();
        } else {
            $boards = Board::where('id', '=', Auth::user()->board_id)->get();
            $roles = Role::where('id', '=', Auth::user()->board_id)->where('name', '!=', 'Super Admin')->get(); //Get all roles
        }

        return view('users.edit', compact('user', 'roles', 'boards'));
    }

    public function destroy($user)
    {
        $user->delete();
        flash('Usuario eliminado exitosamente.')->success();
        return redirect()->route('users.index');
    }

    public function edit_profile($request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->detection_date = $request->detection_date;
        $user->diabetes = $request->diabetes;
        $user->sex = $request->sex;
        if ($request->password !== null) {
            $user->password = bcrypt($request->password);
        }
        $user->update();

        flash('Usuario actualizado exitosamente.')->success();
        return redirect()->back();
    }
}
