<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function division()
    {
        return $this->hasOne(Division::class);
    }

    public function district()
    {
        return $this->hasOne(District::class);
    }

    public function upazila()
    {
        return $this->hasOne(Upazila::class);
    }
}
