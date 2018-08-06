<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Repositories\CategoryPostRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

/**
 * Description of PostController
 *
 * @author Admin
 */
class PostController extends BaseController {

    /**
     * Post repository
     * @var PostRepository
     */
    private $postRepository;

    /**
     * Category post repository
     * @var CategoryPostRepository
     */
    private $categoryPostRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository, CategoryPostRepository $categoryPostRepository)
    {
        parent::__construct($postRepository);
        $this->postRepository = $postRepository;
        $this->categoryPostRepository = $categoryPostRepository;
    }

    /**
     * Create
     * @param Request $request
     * @return JsonResponse
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
            if(array_key_exists('id_categories', $attribute)){
                $listCategory = $attribute['id_categories'];
                if(is_array($listCategory)){
                    foreach ($listCategory as $item){
                        $new = [
                            'id_category' => $item,
                            'id_post' => $entity->id
                        ];
                        $this->categoryPostRepository->create($new);
                    }
                }
            }
            $post = $this->postRepository->getPost($entity->id);
            return $this->responseJsonSuccess(['post' => $post]);
        } catch (Exception $ex) {
            Log::error($ex);
            return $this->responseJsonError('exception', null);
        }
    }

    /**
     * Update
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request){
        try {
            $response = $this->validateRequest($request, $this->ruleUpdate(), $this->validationErrorMessages());
            if(!is_null($response)){
                return $response;
            }
            $credentials = $request->all();
            $id = $credentials['id'];
            $post = $this->postRepository->findWithoutFail($id);
            if($post == null){
                return $this->responseJsonError('id_incorrect', null);
            }

            $attribute = $this->updatedDetault($post);
            $attribute->title = $credentials['title'];
            $attribute->content = $credentials['content'];
            $attribute->id_image = $credentials['id_image'];

            $this->categoryPostRepository->deleteWhere(['id_post' => $id]);
            if(array_key_exists('id_categories', $credentials)){
                $listCategory = $credentials['id_categories'];
                if(is_array($listCategory)){
                    foreach ($listCategory as $item){
                        $new = [
                            'id_category' => $item,
                            'id_post' => $id
                        ];
                        $this->categoryPostRepository->create($new);
                    }
                }
            }
            $attribute->save();
            $post = $this->postRepository->getPost($id);
            return $this->responseJsonSuccess(['post' => $post]);
        } catch (Exception $ex) {
            Log::error($ex);
            return $this->responseJsonError('exception', null);
        }
    }

    /**
     * Rule create
     * @return array
     */
    protected function ruleCreate(){
        return ['title' => 'required',
            'content' => 'required'
        ];
    }

    /**
     * Rule update
     * @return array
     */
    protected function ruleUpdate(){
        return ['title' => 'required',
            'id' => 'required',
            'content' => 'required'
        ];
    }

     /**
     * Error message
     * @return array
     */
    protected function validationErrorMessages() {
        return [
            'title.required' => 'title_empty',
            'id_required' => 'id_empty',
            'content.required' => 'content_empty',
        ];
    }
}
