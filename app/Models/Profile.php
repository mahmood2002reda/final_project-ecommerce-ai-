<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_profile', 'mobile_number1', 'mobile_number2','user_id'

        

    ];
    public function addresses()
    {
        return $this->hasMany('App\Models\Address', 'profile_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');    }

}
