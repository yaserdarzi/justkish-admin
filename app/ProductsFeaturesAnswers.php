<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\Model;

class ProductsFeaturesAnswers extends Model
{
    protected $table = Constants::PRODUCTS_FEATURES_ANSWERS_DB;
    protected $fillable = [
        'type_app_id', 'products_id', 'features_id',
        'features_questions_answers_id', 'created_at'
    ];
    public $timestamps = false;
}
