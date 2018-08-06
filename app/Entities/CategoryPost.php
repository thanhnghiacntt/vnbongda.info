<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CategoryPost.
 *
 * @package namespace App\Entities;
 */
class CategoryPost extends MyBaseModel implements Transformable
{
    protected $primaryKey = 'id';
    use TransformableTrait;
    
    use SoftDeletes;
    
    public $table = 'tbl_category_post';
    
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_category', 'id_post', 'created_by', 'updated_by', 'created_at' , 'updated_at'
    ];

}
