<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeaturesQuestionsAnswers extends Model
{
    use SoftDeletes;
    protected $table = Constants::FEATURES_QUESTIONS_ANSWERS_DB;
    protected $fillable = [
        'type_app_id', 'features_id', 'title', 'image'
    ];
    protected $dates = ['deleted_at'];
}
