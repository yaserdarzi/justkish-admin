<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $table = Constants::PRODUCTS_DB;
    protected $fillable = [
        'type_app_id', 'category_id', 'title', 'image', 'small_description',
        'description', 'rule', 'recovery', 'terms_of_use', 'sort', 'is_happy',
        'is_best_sales', 'time_limitation', 'special_offer', 'today_buy',
        'star', 'price_adult', 'price_child', 'price_baby', 'cash_back'
    ];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->where('deleted_at', '=', null);
    }
}