<?php

namespace App\Repositories;

use App\Entities\User;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
class UserRepository extends MyBaseRepository
{
     /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
