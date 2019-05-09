<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = Constants::ADMIN_DB;
    protected $fillable = [
        'type_app_id', 'user_id'
    ];
    protected $dates = ['deleted_at'];
}
