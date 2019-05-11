<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Features extends Model
{
    use SoftDeletes;
    protected $table = Constants::FEATURES_DB;
    protected $fillable = [
        'type_app_id', 'group_features_id', 'title', 'description'
    ];
    protected $dates = ['deleted_at'];
}
