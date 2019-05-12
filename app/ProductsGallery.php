<?php

namespace App;

use App\Inside\Constants;
use Illuminate\Database\Eloquent\Model;

class ProductsGallery extends Model
{
    protected $table = Constants::PRODUCTS_GALLERY_DB;
    protected $fillable = [
        'type_app_id', 'products_id', 'path', 'mime_type', 'created_at'
    ];
    public $timestamps = false;
}
