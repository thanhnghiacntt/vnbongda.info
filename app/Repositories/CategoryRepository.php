<?php

namespace App\Repositories;

use App\Entities\Category;

/**
 * Interface CategoryRepository.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepository extends MyBaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }
}
