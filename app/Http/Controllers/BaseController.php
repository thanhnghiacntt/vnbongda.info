<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use App\Repositories\MyBaseRepository;
use DateTime;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseController extends Controller
{
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
            $entity = $repository->create($attribute);
            return $this->responseJsonSuccess(['entity' => $entity]);
        } catch (Exception $ex) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }
    
    public function update(){
        
    }
    
    public function delete(Request $request){
        try {
            $id = Input::get('id');
            $entity = $this->$repository->findWithoutFail($id);
            $entity->deleted_at = new DateTime();
            $attribute = $this->updatedDetault($entity);
            $attribute->save();
            return $this->responseJsonSuccess(['entity' => $attribute]);
        } catch (Exception $ex) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }
    
    public function listRecord(){
        
    }
    
    /**
     * Created default
     * @param type $entity
     * @return DateTime
     */
    protected function createdDetault($entity){
        $auth = Auth::User();
        if($auth != null){
            $new = [
                'created_by' => $auth->id,
                'updated_by' => $auth->id,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ];
            array_push($entity, $new);
        }
        
        return $entity;
    }
    
    /**
     * Update default
     * @param type $entity
     * @return DateTime
     */
    protected function updatedDetault($entity){
        $auth = Auth::User();
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
}