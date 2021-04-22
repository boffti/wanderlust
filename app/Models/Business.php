<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $table = 'business';
    protected $primaryKey = 'business_id';

    public function category() {
        return $this->hasMany(Category::class, 'category_id', 'category');
    }

    public function city() {
        return $this->hasOne(City::class, 'city_id', 'city_id');
    }
}
