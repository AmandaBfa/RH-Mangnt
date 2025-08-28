<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public function detail()
    {
        // each user has one user_details
        return $this->hasOne(UserDetail::class);
    }

    public function department()
    {
        // this user belongs to a department
        return $this->belongsTo(Department::class);
    }
}
