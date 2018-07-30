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
     * Created category
     */
    public function create(Request $request){
        try {
            $reponse = $this->validateRequest($request, $this->ruleCreate() , $this->validationErrorMessages());
            if(!is_null($reponse)){
                return $reponse;
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
    
    public function update(Request $request){
        try {
            
        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }
    
    /**
     * Role create
     */
    protected function ruleCreate(){
        return ['slug' => 'required',
            'name' => 'required'
        ];
    }
    
    /**
     * Error message
     * @return type
     */
    protected function validationErrorMessages() {
        return [
            'slug.required'         => 'slug_empty',
            'name.required'         => 'name_empty',
        ];
    }
}
