<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralChat extends Model
{
    use HasFactory;

    protected $table = 'general_chat';
    protected $primaryKey = 'id';

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
