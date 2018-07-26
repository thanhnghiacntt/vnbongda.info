<?php

namespace App\Http\Controllers;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseController extends Controller
{
    public function create(){
        
    }
    
    public function update(){
        
    }
    
    public function delete(){
        
    }
    
    public function listRecord(){
        
    }
    
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