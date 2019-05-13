<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsSupplier extends Model
{
    use SoftDeletes;
    protected $table = Constants::PRODUCTS_SUPPLIER_DB;
    protected $fillable = [
        'type_app_id', 'products_id', 'supplier_id', 'type',
        'percent', 'price', 'income', 'award', 'price_adult',
        'price_child', 'price_baby', 'cash_back', 'title',
        'image', 'small_description', 'description', 'rule',
        'recovery', 'terms_of_use', 'sort', 'is_happy', 'is_best_sales',
        'time_limitation', 'special_offer', 'today_buy', 'star'
    ];
    protected $dates = ['deleted_at'];

}
