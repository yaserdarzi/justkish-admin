<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupFeatures extends Model
{
    use SoftDeletes;
    protected $table = Constants::GROUP_FEATURES_DB;
    protected $fillable = [
        'type_app_id', 'title', 'description'
    ];
    protected $dates = ['deleted_at'];
}