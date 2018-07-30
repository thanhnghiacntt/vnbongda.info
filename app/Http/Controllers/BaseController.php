<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use App\Repositories\MyBaseRepository;
use App\Notifications\ValidateMessage;
use DateTime;
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

    public function delete(Request $request){
        try {
            $reponse = $this->validateRequest($request, $this->ruleDelete() , $this->validationErrorMessages());
            if(!is_null($reponse)){
                return $reponse;
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
     * @param Request $request
     * @return type
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
     * @param type $entity
     * @return DateTime
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
     * @param type $entity
     * @return DateTime
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
     * @param type $code
     * @param type $message
     * @param type $data
     * @return type
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
     * @param type $code
     * @param type $data
     * @return type
     */
    protected function responseJsonError($code, $data = array()) {
        $message = trans("error_message." . $code);
        return $this->responseJson($code, $message, $data);
    }
    
    /**
     * Define description from error code.
     * @param type $errorDesc
     * @param type $data
     * @return type
     */
    protected function responseJsonSuccess($data = array()) {
        $code = "success";
        $message = trans("error_message." . $code);
        return $this->responseJson($code, $message, $data);
    }
    
    /**
     * 
     * @return type
     */
    protected function ruleList(){
        return [
            'page' => 'required',
            'per_page' => 'required'
        ];
    }
    
    /**
     * 
     * @return type
     */
    protected function ruleDelete(){
        return [
            'id' => 'required'
        ];
    }

    /**
     * Error message
     * @return type
     */
    protected function validationErrorMessages() {
        return [
            'page.required' => 'page_empty',
            'per_page.required' => 'per_page_empty',
            'id.required'    => 'id_empty'
        ];
    }
}