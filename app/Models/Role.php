<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
class Role extends Model
{
    use HasFactory;
    protected $table='roles';
    protected $fillable = [
        'name',


    ];

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
}
