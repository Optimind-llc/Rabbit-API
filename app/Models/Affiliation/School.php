<?php

namespace App\Models\Affiliation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class School
 * @package App\Models\Affiliation
 */
class School extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function campuses()
    {
        return $this->hasMany('App\Models\Affiliation\Campus');
    }

    public function users()
    {
        return $this->hasMany('App\Models\Access\User\User');
    }
}
