<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable
{
    protected $primaryKey = 'id';
    use TransformableTrait;
    
    use SoftDeletes;

    public $table = 'tbl_user';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password' , 'first_name', 'last_name', 'phone', 'avatar', 'last_visited', 'created_by', 'updated_by', 'created_at' , 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'last_visited', 'deleted_at', 'created_by', 'updated_by', 'created_at' , 'updated_at'
    ];

    /**
     * Get avatar attribute
     * @param $value
     * @return string
     */
    public function getAvatarAttribute($value) {
        $it = get_image($value);
        if($it == null){
            return asset(config("common.path_avatar_default"));
        }
        return $it;
    }
}
