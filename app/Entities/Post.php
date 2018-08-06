<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post.
 *
 * @package namespace App\Entities;
 */
class Post extends MyBaseModel implements Transformable
{
    protected $primaryKey = 'id';
    use TransformableTrait;
    
    use SoftDeletes;
    
    public $table = 'tbl_post';
    
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'id_image', 'created_by', 'updated_by', 'created_at' , 'updated_at'
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(){
        return $this->hasMany(CategoryPost::class, 'id_post', 'id')
            ->join('tbl_category','tbl_category.id','=','tbl_category_post.id_category')
            ->select();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image(){
        return $this->hasOne(Gallery::class,'id','id_image')
            ->select();
    }

}
