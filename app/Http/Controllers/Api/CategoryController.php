<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

/**
 * Description of CategoryController
 *
 * @author Admin
 */

use JWTAuth;
use Exception;
use App\Http\Controllers\BaseController;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Notifications\ValidateMessage;
use Illuminate\Support\Facades\Log;

class CategoryController extends BaseController {
    
    use ValidateMessage;
    
    /**
     * Category repository
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Create category
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        try {
            $response = $this->validateRequest($request, $this->ruleCreate() , $this->validationErrorMessages());
            if(!is_null($response)){
                return $response;
            }
            $in = $request->all();
            if ($this->categoryRepository->checkExistSlug($in['slug'])) {
                return $this->responseJsonError('slug_exist');
            }
            if ($this->categoryRepository->checkExistName($in['name'])) {
                return $this->responseJsonError('name_exist');
            }
            $attribute = $this->createdDetault($in);
            $category = $this->categoryRepository->create($attribute);
            return $this->responseJsonSuccess(['category' => $category]);
        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function children(Request $request){
        try {
            $id = $request->get('id');
            $cat = $this->categoryRepository->findWhere(['parent_id' => $id]);
            return $this->responseJsonSuccess(['category' => $cat]);
        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }


    /**
     * Update
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){
        try {
            $response = $this->validateRequest($request, $this->ruleUpdate() , $this->validationErrorMessages());
            if(!is_null($response)){
                return $response;
            }
            $in = $request->all();
            $cat = $this->categoryRepository->findWithoutFail($in['id']);
            if($cat == null){
                $this->responseJsonError('id_incorrect', null);
            }
            $attribute = $this->createdDetault($in);
            if(strcmp($cat->slug, $attribute['slug']) != 0){
                if ($this->categoryRepository->checkExistSlug($attribute['slug'])) {
                    return $this->responseJsonError('slug_exist');
                }
                $cat->slug = $attribute['slug'];
            }
            if(strcmp($cat->name, $attribute['name']) != 0){
                if ($this->categoryRepository->checkExistSlug($attribute['name'])) {
                    return $this->responseJsonError('name_exist');
                }
                $cat->name = $attribute['name'];
            }
            $cat->description = $attribute['description'];
            $cat->save();
            return $this->responseJsonSuccess(['category' => $cat]);
        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }
    
    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getByParentId(int $parentId){
        try {
            $list = $this->categoryRepository->listCondition(['parent_id' => $parentId], null);
            return $this->responseJsonSuccess($list);
        } catch (Exception $ex) {
            Log::error($ex);
            return $this->responseJsonError('exception', null);
        }
    }
    
    /**
     * Rule create
     */
    protected function ruleCreate(){
        return ['slug' => 'required',
            'name' => 'required'
        ];
    }
    
    /**
     * Rule update
     */
    protected function ruleUpdate(){
        return [
            'id' => 'required',
            'slug' => 'required',
            'name' => 'required'
        ];
    }
    
    /**
     * Error message
     * @return array
     */
    protected function validationErrorMessages() {
        return [
            'slug.required'         => 'slug_empty',
            'name.required'         => 'name_empty',
            'id.required'           => 'id_empty'
        ];
    }
}
