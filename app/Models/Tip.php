<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory;
    protected $table = 'tips';
    protected $primaryKey = 'tip_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'city_id', 'city_id');
    }
}
