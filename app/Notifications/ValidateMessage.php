<?php

namespace App\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

trait ValidateMessage
{
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
        ];
    }
    
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'email.required' => 'email_empty',
            'email.email' => 'email_format_invalid',
            'password.required' => 'password_empty',
            'password.confirmed' => 'password_confirmation_does_not_match',
            'password.min' => 'password_min_6',
            'id.required' => 'id_required',
        ];
    }
    
    /**
     * Validate request
     * @param Request $request
     * @return type
     */
    public function validateRequest(Request $request, $rule = null, $errorMessage = null){
        if(is_null($rule)){
            $rule = $this->rules();
        }
        if(is_null($errorMessage)){
            $errorMessage = $this->validationErrorMessages();
        }
        //check validator
        $data = $request->all();
        $validator = Validator::make($data, $rule, $errorMessage);
        return $this->validateError($validator);
    }
    
    /**
     * Validate request
     * @param Request $request
     * @return type
     */
    public function validateValues($data, $rule = null, $errorMessage = null){
        if(is_null($rule)){
            $rule = $this->rules();
        }
        if(is_null($errorMessage)){
            $errorMessage = $this->validationErrorMessages();
        }
        //check validator
        $validator = Validator::make($data, $rule, $errorMessage);
        return $this->validateError($validator);
    }
    
    /**
     * 
     * @param type $validator
     * @param type $rule
     * @param type $errorMessage
     * @return type
     */
    public function validateError($validator){
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $error) {
                return response()->json([
                    'code'          => $error, 
                    'message'       => trans("error_message." . $error),
                    'data'          => null
                ]);
            }
        }
        return null;
    }
}

