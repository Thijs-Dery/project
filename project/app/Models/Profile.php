<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'email', 'birthday', 'about_me', 'avatar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
