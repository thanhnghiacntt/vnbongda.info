<?php

namespace App\Repositories;

use App\Entities\Post;

/**
 * Interface PostRepository.
 *
 * @package namespace App\Repositories;
 */
class PostRepository extends MyBaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    public function getPost($id){
        $value = parent::with(['categories', 'image'])->find($id);
        return $value;
    }
}
