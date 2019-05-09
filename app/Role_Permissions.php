<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_Permissions extends Model
{
    protected $table = 'role_permissions';
    protected $fillable = ['role_id', 'permission_id'];
    public $timestamps = false;
}