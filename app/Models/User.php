<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// o authenticatable esta relacioando a autenticação com o login do usuario
class User extends Authenticatable
{
    // esta relacionado ao envio do email
    use Notifiable;

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
