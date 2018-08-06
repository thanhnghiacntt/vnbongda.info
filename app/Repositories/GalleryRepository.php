<?php

namespace App\Repositories;

use App\Entities\Gallery;

/**
 * Interface GalleryRepository.
 *
 * @package namespace App\Repositories;
 */
class GalleryRepository extends MyBaseRepository
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

}
