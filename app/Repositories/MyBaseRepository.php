<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MyBaseRepository extends BaseRepository implements RepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return [];
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    /**
     * Find without fail
     * @param type $id
     * @param type $columns
     * @return type
     */
    public function findWithoutFail($id, $columns = null){
        try{
            return $this->find($id, $columns);
        } catch (Exception $ex) {
            return null;
        }
    }
    
    
    /**
     * Count
     * @param type $condition
     * @return type
     */
    public function count($condition){
        return $this->model->where($condition)->count();
    }
    
    /**
     * List record page
     * @param int $page
     * @param type $perPage
     * @return type
     */
    public function listRecord($page = 1, $perPage = 10){
        if($perPage == null){
            $perPage = 10;
        }
        if($perPage > 200){
            $perPage = 200;
        }
        if($page == null){
            $page = 1;
        }
        return $this->paginate($perPage)->appends($page);
    }
}
