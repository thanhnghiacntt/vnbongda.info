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
    
    /**
     * 
     * @param type $user_id
     * @return type
     */
    public function getProfile($user_id, $relation = null) {
        $columns = ['id', 'username', 'first_name', 'role', 'avatar', 'last_name', 'email', 'phone'];
        return $this->find($user_id, $columns);
    }
    
    /**
     * Check email exist
     * @param type $email
     * @return type
     */
    public function checkExistEmail($email){
        return $this->count(['email' => $email]) > 0;
    }
    
    /**
     * Check username exist
     * @param type $email
     * @return type
     */
    public function checkExistUsername($username){
        return $this->count(['username' => $username]) > 0;
    }
}
