<?php

namespace App\Inside;

use App\User;
use DB;

class PrivilegedAdmin
{
    private $roles;

    /**
     * Privilegedadmin constructor.
     */
    public function __construct()
    {
    }

    public static function getByAdminId($id)
    {
        $admin = User::find($id);
        if (is_null($admin))
            throw new \Exception('کاربر یافت نشد.');
        $privilege = new PrivilegedAdmin();
        $privilege->$id = $admin->id;
        $privilege->initRoles($id);
        return $privilege;
    }

    private function initRoles($id)
    {
        $this->roles = [];

        $result = DB::table('role_admin as ru')
            ->join('roles as r', 'r.id', '=', 'ru.role_id')
            ->select('ru.role_id', 'r.role_name')
            ->where('ru.admin_id', $id)->get();

        foreach ($result as $item) {
            $this->roles[$item->role_name] = Role::getPermissions($item->role_id);
        }
    }

    public function hasPrivileged($routeName)
    {
        foreach ($this->roles as $role) {
            if ($role->hasPermission($routeName))
                return true;
        }
        return false;
    }

    public function getRolesName($admin_id)
    {
        $result = DB::table('role_admin as ru')
            ->join('roles as r', 'r.id', '=', 'ru.role_id')
            ->select('ru.role_id', 'r.role_name')
            ->where('ru.admin_id', $admin_id)->first();
        return $result->role_name;
    }

    private function initGetRoles($id)
    {
        $this->roles = [];

        $result = DB::table('role_admin as ru')
            ->join('roles as r', 'r.id', '=', 'ru.role_id')
            ->select('ru.role_id', 'r.role_name')
            ->where('ru.admin_id', $id)->get();

        foreach ($result as $key => $item) {
            $this->roles = Role::getPermissionsArray($item->role_id);
        }
    }

    public function getRoles($admin_id)
    {
        $this->initGetRoles($admin_id);
        return $this->roles;
    }


}
