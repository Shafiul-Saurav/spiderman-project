<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    //Relationship with Permission
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
