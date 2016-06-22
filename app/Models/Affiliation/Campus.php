<?php

namespace App\Models\Affiliation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Campus
 * @package App\Models\Affiliation
 */
class Campus extends Model
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

    public function school()
    {
        return $this->belongsTo('App\Models\Affiliation\School');
    }

    public function inside($lat, $lon)
    {
        $isInside = false;

        $latArray = explode(',', $this->geo_lat);
        $lonArray = explode(',', $this->geo_lon);
        $polySides = count($latArray);
        $j = $polySides-1;
        
        for ($i=0; $i<$polySides; $i++) {
            if ($latArray[$i]<$lat && $latArray[$j]>=$lat
            ||  $latArray[$j]<$lat && $latArray[$i]>=$lat) {
                if ($lonArray[$i]+($lat-$latArray[$i])/($latArray[$j]-$latArray[$i])*($lonArray[$j]-$lonArray[$i])<$lon)
                    $isInside=!$isInside;
            }
            $j=$i;
        }

        return $isInside;
    }
}
