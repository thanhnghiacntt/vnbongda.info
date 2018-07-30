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
    
    public function checkExistSlug($slug) {
        return $this->count(['slug' => $slug]) > 0;
    }
    
    public function checkExistName($name) {
        return $this->count(['name' => $name]) > 0;
        ;
    }
}
