<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class School
 * @package App\Models\History
 */
class Bonus extends Model
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

    public function type()
    {
        return $this->belongsTo('App\Models\History\BonusType');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }
}
