<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'model',
        'year',
        'price_per_day',
        'transmission',
        'fuel_type',
        'seats',
        'description',
        'image',
        'is_active',
    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
