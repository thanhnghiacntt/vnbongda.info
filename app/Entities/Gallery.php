<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Gallery.
 *
 * @package namespace App\Entities;
 */
class Gallery extends MyBaseModel implements Transformable
{
    protected $primaryKey = 'id';
    use TransformableTrait;
    
    use SoftDeletes;
    
    public $table = 'tbl_gallery';
    
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'title', 'created_by', 'updated_by'
    ];

}
