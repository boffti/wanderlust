<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $table = 'business';
    protected $primaryKey = 'business_id';

    public function city() {
        return $this->hasOne(City::class, 'city_id', 'city_id');
    }

    public function category() {
        return $this->hasMany(Category::class, 'category_id', 'category');
    }

    public function photos() {
        return $this->hasMany(BusinessPhoto::class, 'business_id', 'business_id');
    }

    public function reviews() {
        return $this->hasMany(BusinessReview::class, 'business_id', 'business_id');
    }

    public function tips() {
        return $this->hasMany(BusinessTip::class, 'business_id', 'business_id');
    }
}
