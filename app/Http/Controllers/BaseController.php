<?php

namespace App\Http\Controllers;
use App\Entities\MyBaseModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use App\Repositories\MyBaseRepository;
use App\Notifications\ValidateMessage;
use DateTime;
use Exception;
use JWTAuth;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseController extends Controller
{
    use ValidateMessage;
    
    protected $repository;
    
    /**
     * Constructor
     * @param MyBaseRepository $repository
     */
    public function __construct(MyBaseRepository $repository) {
        $this->repository = $repository;
    }


    /**
     * Create
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request){
        try {
            $credentials = $request->all();
            $attribute = $this->createdDetault($credentials);
            $entity = $this->repository->create($attribute);
            return $this->responseJsonSuccess(['entity' => $entity]);
        } catch (Exception $ex) {
            Log::error($ex);
            return $this->responseJsonError('exception', null);
        }
    }

    /**
     * Delete
     * @param Request $request
     * @return \App\Notifications\type|JsonResponse
     */
    public function delete(Request $request){
        try {
            $response = $this->validateRequest($request, $this->ruleDelete() , $this->validationErrorMessages());
            if(!is_null($response)){
                return $response;
            }
            $id = Input::get('id');
            $entity = $this->repository->findWithoutFail($id);
            if($entity == null){
                return $this->responseJsonError('id_incorrect', null);
            }
            $entity->deleted_at = new DateTime();
            $attribute = $this->updatedDetault($entity);
            $attribute->save();
            return $this->responseJsonSuccess(['entity' => $attribute]);
        } catch (Exception $ex) {
            Log::error($ex);
            return $this->responseJsonError('exception', null);
        }
    }
    
    /**
     * List record
     * @return JsonResponse
     */
    public function listRecord(){
        try {
            $page = Input::get('page');
            $perPage = Input::get('per_page');
            $records = $this->repository->listRecord($page, $perPage);
            return $this->responseJsonSuccess($records);
        } catch (Exception $ex) {
            Log::error($ex);
            return $this->responseJsonError('exception', null);
        }
    }
    
    
    /**
     * Created default
     * @param MyBaseModel $entity
     * @return MyBaseModel
     */
    protected function createdDetault($entity){
        $auth = JWTAuth::parseToken()->authenticate();
        if($auth != null){
            $entity['created_by'] = $auth->id;
            $entity['updated_by'] = $auth->id;
            $entity['created_at'] = new DateTime();
            $entity['updated_at'] = new DateTime();
            $entity['id'] = null;
        }
        return $entity;
    }
    
    /**
     * Update default
     * @param MyBaseModel $entity
     * @return MyBaseModel
     */
    protected function updatedDetault($entity){
        $auth = JWTAuth::parseToken()->authenticate();
        if($auth != null){
            $new = [
                'updated_by' => $auth->id,
                'updated_at' => new DateTime()
            ];
            array_push($entity, $new);
        }
        return $entity;
    }

    /**
     * Return response json
     * @param string $code
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    protected function responseJson($code, $message = null, $data = array()) {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }
    
    /**
     * 
     * @param string $code
     * @param array $data
     * @return JsonResponse
     */
    protected function responseJsonError($code, $data = array()) {
        $message = trans("error_message." . $code);
        return $this->responseJson($code, $message, $data);
    }
    
    /**
     * Define description from error code.
     * @param array $data
     * @return JsonResponse
     */
    protected function responseJsonSuccess($data = array()) {
        $code = "success";
        $message = trans("error_message." . $code);
        return $this->responseJson($code, $message, $data);
    }
    
    /**
     * 
     * @return array
     */
    protected function ruleList(){
        return [
            'page' => 'required',
            'per_page' => 'required'
        ];
    }
    
    /**
     * 
     * @return array
     */
    protected function ruleDelete(){
        return [
            'id' => 'required'
        ];
    }

    /**
     * Error message
     * @return array
     */
    protected function validationErrorMessages() {
        return [
            'page.required' => 'page_empty',
            'per_page.required' => 'per_page_empty',
            'id.required'    => 'id_empty'
        ];
    }
}