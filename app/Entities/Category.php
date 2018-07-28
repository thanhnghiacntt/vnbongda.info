<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category.
 *
 * @package namespace App\Entities;
 */
class Category extends MyBaseModel implements Transformable
{
    protected $primaryKey = 'id';
    use TransformableTrait;
    
    use SoftDeletes;
    
    public $table = 'tbl_category';
    
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug' , 'parent_id', 'created_by', 'updated_by'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_by', 'updated_by', 'created_at' , 'updated_at' , 'deleted_at'
    ];

}
