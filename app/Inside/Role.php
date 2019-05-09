<?php

namespace App\Inside;


use Illuminate\Support\Facades\DB;

class Role
{
    private $permissions;

    /**
     * Role constructor.
     * @internal param $permissions
     */
    public function __construct()
    {
        $this->permissions = [];
    }

    public static function getPermissions($roleId)
    {
        $role = new Role();

        $permissions = DB::table('role_permissions as rp')
            ->join('permissions as p', 'p.id', '=', 'rp.permission_id')
            ->where('rp.role_id', '=', $roleId)
            ->select('rp.role_id', 'rp.permission_id', 'p.route_name', 'p.description')->get();

        foreach ($permissions as $item) {
            $role->permissions[$item->route_name] = [true, $item->description];
        }
        return $role;
    }

    public static function getPermissionsArray($roleId)
    {
        $role = array();

        $permissions = DB::table('role_permissions as rp')
            ->join('permissions as p', 'p.id', '=', 'rp.permission_id')
            ->where('rp.role_id', '=', $roleId)
            ->select('rp.role_id', 'rp.permission_id', 'p.route_name', 'p.description')->get();

        foreach ($permissions as $key=> $item) {
            $role[$key] = $item->route_name;
        }
        return $role;
    }

    public function hasPermission($routeName)
    {
        return isset($this->permissions[$routeName]);
    }


}