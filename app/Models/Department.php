<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function users()
    {
        // each department can be filled with multiple users
        return $this->belongsToMany(User::class);
    }
}
