<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'image', 'title', 'description', 'created_by', 'updated_by', 'created_at' , 'updated_at'
    ];


    /**
     * Get image
     * @param $value
     * @return string
     */
    public function getImageAttribute($value) {
        $it = get_image($value);
        if($it == null){
            return asset(config("common.path_image_default"));
        }
        return $it;
    }

}
