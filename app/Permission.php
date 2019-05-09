<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['route_name','description', 'updated_at', 'created_at'];
    public $timestamps = false;
}