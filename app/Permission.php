<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Permission extends Model
{
    use HasRoles;
    protected $guard_name = 'web';
    protected $guarded = [];
}
