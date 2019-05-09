<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = Constants::CATEGORY_DB;
    protected $fillable = [
        'type_app_id', 'title', 'icon', 'desc',
        'sort', 'link'
    ];
    protected $dates = ['deleted_at'];
}
