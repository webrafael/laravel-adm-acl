<?php namespace App\Http\Controllers\Admin\Acl;

use App\Http\Requests\StoreUpdateRolesRequest;
use App\Models\Role;
use App\Models\Component;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.role-list', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'role' => null,
            'components' => Component::all(),
            'permissions' => []
        ];
        return view('admin.roles.role-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRolesRequest $request)
    {
        DB::beginTransaction();

        $permissionsId = [];
        $inputs = $request->all();
        $createRole = (new Role)->create($inputs['role']);

        foreach ($inputs['permissions'] ?? [] as $permission) {
            if ($createPermission = (new Permission)->create($permission)) {
                $permissionsId[] = $createPermission->id;
            }
        }

        $createRole->permissions()->sync($permissionsId);

        DB::commit();

        return redirect()->route('roles.index');

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
        $role = [
            'role' => Role::where(['uuid' => $uuid])->first(),
            'components' => Component::all(),
            'permissions' => Role::with('permissions')->where('uuid', '=', $uuid)->first()?->permissions->toArray() ?? []
        ];

        if (is_null($role['role'])) {
            return redirect()->route('roles.index');
        }

        return view('admin.roles.role-edit', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateRolesRequest  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRolesRequest $request, $uuid)
    {
        DB::beginTransaction();

        $permissionsId = [];
        $inputs = $request->all();
        $updateRole = Role::updateOrCreate(['uuid' => $uuid], $inputs['role']);

        foreach ($inputs['permissions'] ?? [] as $key => $permission) {
            $permissionsId[] = Permission::updateOrCreate(['id' => $permission['id']], $permission)->id;
        }

        $updateRole->permissions()->sync($permissionsId);

        DB::commit();

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
    }
}
