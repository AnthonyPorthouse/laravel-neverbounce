<?php

namespace Groundsix\Neverbounce;

use Log;
use NeverBounce\API\NB_Single;
use NeverBounce\API\NB_Exception;

class NeverBounce
{
    public function __construct(NB_Single $single)
    {
        $this->app = $single;
    }

    /**
     * Validates an email address against neverbounce.com.
     *
     * @param string $email The email in question
     *
     * @return bool
     */
    public function valid($email)
    {
        try {
            $valid = $this->app->verify($email)->is(config('neverbounce.valid_results', 'valid'));
        } catch (NB_Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e]);
            $valid = false;
        }

        return $valid;
    }
}
