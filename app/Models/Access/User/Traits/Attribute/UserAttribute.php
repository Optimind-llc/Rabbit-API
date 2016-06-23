<?php

namespace App\Models\Access\User\Traits\Attribute;

/**
 * Class UserAttribute
 * @package App\Models\Access\User\Traits\Attribute
 */
trait UserAttribute
{
    /**
     * @return mixed
     */
    public function canChangeEmail()
    {
        return config('access.users.change_email');
    }

    /**
     * @return bool
     */
    public function canChangePassword()
    {
        return ! app('session')->has(config('access.socialite_session_name'));
    }

    /**
     * @param bool $size
     * @return mixed
     */
    public function getPicture($size = false)
    {
        if (! $size) $size = config('gravatar.default.size');
        return gravatar()->get($this->email, ['size' => $size]);
    }

    /**
     * @param $provider
     * @return bool
     */
    public function hasProvider($provider)
    {
        foreach ($this->providers as $p) {
            if ($p->provider == $provider) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isActive() {
        return $this->status == 1;
    }

    /**
     * @return bool
     */
    public function isConfirmed() {
        return $this->confirmed == 1;
    }
}
