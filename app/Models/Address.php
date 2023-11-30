<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street_address', 'city', 'state','profile_id'

        

    ];
    public function profile()
    {
       
        return $this->belongsTo(Profile::class);
    }
    use HasFactory;
}
