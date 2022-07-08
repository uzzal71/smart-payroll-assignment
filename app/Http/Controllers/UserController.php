<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $users = User::orderBy('id', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $users = $users->where('name', 'like', '%'.$sort_search.'%');
        }
        $users = $users->paginate(100);
        return view('systems.users.index', compact('users', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sort_search = null;
        $employee = [];

        if ($request->has('search'))
        {
            $sort_search = $request->search;
            $employee = Employee::where('employee_punch_card', $sort_search)->first();
            
            if (empty($employee)) {
                flash('Employee not found!')->success();
            }
        }
        return view('systems.users.create', compact('employee', 'sort_search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->employee_id = $request->employee_id;
        $user->username = $request->username;
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->user_type  = $request->user_type;
        $user->password  = Hash::make($request->password);

        $user->save();

        flash('User has been inserted successfully')->success();
        return redirect()->route('users.index');
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
        $user = User::findOrFail($id);

        return view('systems.users.edit', compact('user'));
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

        $user->employee_id = $request->employee_id;
        $user->username = $request->username;
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->user_type  = $request->user_type;
        $user->password  = Hash::make($request->password);

        $user->save();

        flash('User has been updated successfully')->success();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        flash('User has been deleted successfully')->success();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_profile($id)
    {
        $user = User::findOrFail($id);

        return view('systems.users.profile', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->employee_id = $request->employee_id;
        $user->username = $request->username;
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->user_type  = $request->user_type;

        if ($request->new_password != $request->confirm_password) {
            flash('password confirmation does not match')->success();
            return redirect()->route('user.profile', $id);
        }

        $user->password  = Hash::make($request->new_password);
        $user->save();

        flash('User profile has been updated successfully')->success();
        return redirect()->route('home');
    }

    
}
