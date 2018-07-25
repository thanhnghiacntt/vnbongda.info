<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoryPostRepository;
use App\Entities\CategoryPost;
use App\Validators\CategoryPostValidator;

/**
 * Class CategoryPostRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryPostRepositoryEloquent extends BaseRepository implements CategoryPostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryPost::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
