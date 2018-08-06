<?php

namespace App\Repositories;


use App\Entities\CategoryPost;

/**
 * Interface CategoryPostRepository.
 *
 * @package namespace App\Repositories;
 */
class CategoryPostRepository extends MyBaseRepository
{
    public function model()
    {
        return CategoryPost::class;
    }
}
