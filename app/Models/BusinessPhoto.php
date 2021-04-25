<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPhoto extends Model
{
    use HasFactory;

    protected $table = 'business_photos';

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
}
