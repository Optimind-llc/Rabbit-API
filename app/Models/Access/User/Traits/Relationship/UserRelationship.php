<?php

namespace App\Models\Access\User\Traits\Relationship;

use App\Models\Access\User\SocialLogin;

/**
 * Class UserRelationship
 * @package App\Models\Access\User\Traits\Relationship
 */
trait UserRelationship
{
    public function school()
    {
        return $this->belongsTo('App\Models\Affiliation\School');
    }

    public function rabbits()
    {
        return $this->belongsTo('App\Models\History\Rabbit');
    }

    
}