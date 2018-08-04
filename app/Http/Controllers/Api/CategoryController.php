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
use DateTime;
use App\Http\Controllers\BaseController;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Notifications\ValidateMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class CategoryController extends BaseController {
    
    use ValidateMessage;
    
    /**
     * Category repository
     * @var type 
     */
    private $categoryRepository;

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
            $category = $this->categoryRepository->create($attribute);
            return $this->responseJsonSuccess(['category' => $category]);
        } catch (Exception $e) {
            Log::error($e);
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
