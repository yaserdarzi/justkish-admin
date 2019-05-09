<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $table = Constants::PROJECT_DB;
    protected $casts = [
        'info' => 'object',
    ];
    protected $fillable = [
        'category_id', 'category_plan_id', 'category_timing_id',
        'title', 'desc', 'desc_more', 'colors', 'fonts'
    ];
    protected $dates = ['deleted_at'];
}
