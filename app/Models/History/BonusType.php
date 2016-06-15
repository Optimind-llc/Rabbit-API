<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class School
 * @package App\Models\History
 */
class BonusType extends Model
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

    public function bonuses()
    {
        return $this->hasMany('App\Models\History\Bonus');
    }
}
