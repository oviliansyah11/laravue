<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductGallery extends Model
{
    use SoftDeletes;
    // use HasFactory;

    protected $fillable = [
        'products_id',
        'photo',
        'is_default'
    ];
    protected $hidden = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    public function getPhotoAttribute($value)
    {
        return url('storage/' . $value);
    }
}
