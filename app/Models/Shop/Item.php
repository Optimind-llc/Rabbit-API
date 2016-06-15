<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class School
 * @package App\Models\History
 */
class Order extends Model
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

    public function orders()
    {
        return $this->hasMany('App\Models\History\Order');
    }

    public function shops()
    {
        return $this->belongsToMany('App\Models\Shop\Shop');
    }
}
