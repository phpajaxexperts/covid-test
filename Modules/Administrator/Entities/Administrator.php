<?php

namespace Modules\Administrator\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Administrator  extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    protected $table = 'administrators';

    protected $fillable = [
        'id','name', 'email', 'password',
    ];

}
