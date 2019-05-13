<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    protected $table = Constants::SUPPLIER_DB;
    protected $fillable = [
        'type_app_id', 'name', 'image', 'info', 'income'
    ];
    protected $dates = ['deleted_at'];
}
