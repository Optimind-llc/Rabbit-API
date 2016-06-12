<?php

namespace App\Models\Access\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
// Zizaco Entrust User Trait
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class Admin
 * @package App\Models\Access\Admin
 */
class Admin extends Authenticatable
{

    use SoftDeletes, EntrustUserTrait;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
}
