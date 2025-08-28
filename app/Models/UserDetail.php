<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    public function user()
    {
        // each user has one user_details / each user_details belongs to a single user
        return $this->belongsTo(User::class);
    }
}
