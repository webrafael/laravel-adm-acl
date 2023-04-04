<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\Role;
use App\Models\AclUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(private AclUser $user)
    {  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->with('roles')->get();

        return view('admin.users.user-list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'roles'  => Role::all(),
            'user' => null
        ];

        return view('admin.users.user-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserRequest $request)
    {
        $inputs = $request->all();
        DB::beginTransaction();

        $create_user = $this->user->create([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'password' => Hash::make($inputs['password']),
        ]);

        $create_user->roles()->sync($inputs['roles'] ?? []);

        DB::commit();
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $data = [
            'user' => $this->user->where(['uuid' => $uuid])->first(),
            'roles' => Role::all()
        ];

        return view('admin.users.user-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUserRequest  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUserRequest $request, $uuid)
    {
        $inputs = $request->except(['password', 'username', 'password_confirmation', '_token']);

        DB::beginTransaction();

        $update_user = $this->user->updateOrCreate(['uuid' => $uuid], $inputs);
        $update_user->roles()->sync($inputs['roles'] ?? []);

        DB::commit();

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
    }
}
