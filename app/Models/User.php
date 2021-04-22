<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    public function posts() {
        return $this->hasMany(Post::class, 'user_id', 'user_id');
    }

    public function tips() {
        return $this->hasMany(Tip::class, 'user_id', 'user_id');
    }

    public function city() {
        return $this->hasOne(City::class, 'city_id', 'city');
    }

    public function roles() {
        return $this->hasMany(UserRoles::class, 'user_id', 'user_id');
    }

    public function photos() {
        return $this->hasMany(UserPhoto::class, 'user_id', 'user_id');
    }

    public function videos() {
        return $this->hasMany(UserVideo::class, 'user_id', 'user_id');
    }

}
