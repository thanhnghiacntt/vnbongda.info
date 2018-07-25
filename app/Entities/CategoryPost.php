<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CategoryPost.
 *
 * @package namespace App\Entities;
 */
class CategoryPost extends BaseModel implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
