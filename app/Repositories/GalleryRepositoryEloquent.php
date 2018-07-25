<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GalleryRepository;
use App\Entities\Gallery;
use App\Validators\GalleryValidator;

/**
 * Class GalleryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GalleryRepositoryEloquent extends BaseRepository implements GalleryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Gallery::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
