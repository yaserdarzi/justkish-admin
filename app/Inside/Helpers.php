<?php


namespace App\Inside;

Use Auth;

class Helpers
{
    protected $privileged;

    public function __construct()
    {
        $this->privileged = new PrivilegedAdmin();
    }

    public function checkPermission($admin_id, $roleName)
    {
        $privileged = $this->privileged->getByAdminId($admin_id);
        $this->getMenuInfo($admin_id);
        if (!$privileged->hasPrivileged($roleName))
            Auth::logout();
    }

    public function getRoles($admin_id)
    {
        return $this->privileged->getRolesName($admin_id);
    }

    public function getMenuInfo($admin_id)
    {
        view()->share('roleInfo', $this->privileged->getRoles($admin_id));
    }

    ////////////////private function///////////////

    private function normalizePhoneNumber($phone)
    {
        $newNumbers = range(0, 9);
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $string = str_replace($arabic, $newNumbers, $phone);
        $string = str_replace($persian, $newNumbers, $string);
        $string = str_replace(' ', '', $string);
        return $string;
    }

}
