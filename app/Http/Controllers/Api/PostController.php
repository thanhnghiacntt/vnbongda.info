<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;

/**
 * Description of PostController
 *
 * @author Admin
 */
class PostController extends BaseController {
    private $postRepository;
    
    /**
     * Constructor
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        parent::__construct($postRepository);
        $this->postRepository = $postRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(Request $request){
        try {
            $response = $this->validateRequest($request, $this->ruleCreate(), $this->validationErrorMessages());
            if(!is_null($response)){
                return $response;
            }
            $credentials = $request->all();
            $attribute = $this->createdDetault($credentials);
            $entity = $this->postRepository->create($attribute);
            return $this->responseJsonSuccess(['post' => $entity]);
        } catch (ValidatorException $e){
            Log::error($e);
            return $this->responseJsonError('validate_exception', null);
        } catch (Exception $ex) {
            Log::error($ex);
            return $this->responseJsonError('exception', null);
        }
    }
    
    public function update(){
        
    }

    /**
     * Delete
     * @return JsonResponse
     */
    public function delete(){
        try {
            $id = Input::get('id');
            $entity = $this->repository->findWithoutFail($id);
            $entity->deleted_at = new DateTime();
            $attribute = $this->updatedDetault($entity);
            $attribute->save();
            return $this->responseJsonSuccess(['post' => $attribute]);
        } catch (Exception $ex) {
            Log::error($ex);
            return $this->responseJsonError('exception', null);
        }
    }
    
    public function listRecord(){
        
    }
    
    /**
     * Rule create
     * @return array
     */
    protected function ruleCreate(){
        return ['title' => 'required',
            'content' => 'required|min:6'
        ];
    }

        /**
     * Error message
     * @return array
     */
    protected function validationErrorMessages() {
        return [
            'title.required'         => 'title_empty',
            'content.required'         => 'content_empty',
        ];
    }
}
