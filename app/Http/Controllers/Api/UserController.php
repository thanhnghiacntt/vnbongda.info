<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserController extends BaseController {
    
    /**
     * User repository
     * @var type 
     */
    private $userRepository;


    public function __construct(\App\Repositories\UserRepositoryEloquent $userRepository)
    {
        $this->$userRepository = $userRepository;
        dd($userRepository);
    }
    
    public function create(){
        return "Helloword";
    }
    
    /**
     * Login which input user, pass, type from form.
     * @return type User
     */
    public function login(Request $request){
        try {
            $reponse = $this->validateRequest($request, $this->rules(), $this->validationErrorMessages());
            if(!is_null($reponse)){
                return $reponse;
            }
            $credentials = Request::all();
            $token = JWTAuth::attempt($credentials);
            if (!$token) {
                return ResponseJsonApiController::responseJsonErrorCode('invalid_credentials', null);
            }
            // Get infomation of user
            $auth = Auth::User();
            if($auth->status == 2){
                return ResponseJsonApiController::responseJsonErrorCode('user_block', null);
            }
            if($auth->status == 0){
                return ResponseJsonApiController::responseJsonErrorCode('user_inactive', null);
            }
            $user = $this->userRepository->getProfile($auth->id);
            $user->token_firebase = $this->createTokenFirebase();
            $user->school_code = $this->settingRepository->getValueOfKey('code');
            $this->updateDateUser($auth->id);
            return ResponseJsonApiController::responseJson(0, '', ['user' => $user, 'token'=> $token]);
        } catch (JWTException $e) {
            return ResponseJsonApiController::responseJsonErrorCode('could_not_create_token', null);
        } catch (Exception $e) {
            return ResponseJsonApiController::responseJsonErrorCode('exception', null);
        }
    }
    
    /**
     * Change password of user
     * @param Request $request
     */
    public function changPassword(Request $request){
         try {
            $reponse = $this->validateRequest($request, $this->rulesChangePassword() , $this->validationErrorMessages());
            if(!is_null($reponse)){
                return $reponse;
            }
            // Get information from request
            $password = Input::get('old_password');
            $newPassword = Input::get('new_password');
            $confPassword = Input::get('confirm_password');
            if(strcmp($newPassword, $confPassword) != 0){
                return ResponseJsonApiController::responseJsonErrorCode('password_confirmation_does_not_match', null);
            }
            $user = JWTAuth::parseToken()->authenticate();
            $credentials = ['username'=>$user->username, 'password'=>$password];
            if (!JWTAuth::attempt($credentials)) {
                return ResponseJsonApiController::responseJsonErrorCode('old_password_invalid', null);
            }
            $user->password = bcrypt($newPassword);
            $user->save();
            $credentials['password'] = $newPassword;
            $token = JWTAuth::attempt($credentials);
            $user = $this->userRepository->getProfile($user->id);
            return ResponseJsonApiController::responseJson(0, '', ['user' => $user, 'token'=> $token]);
        } catch (JWTException $e) {
            return ResponseJsonApiController::responseJsonErrorCode('could_not_create_token', null);
        } catch (Exception $e) {
            return ResponseJsonApiController::responseJsonErrorCode('exception', null);
        }
    }
        
     /**
     * Rule validate
     */
    protected function rulesChangePassword() {
        return ['old_password' => 'required|min:6',
                'new_password' => 'required|min:6',
                'confirm_password'=>'required|min:6'
                ];
    }
    
    /**
     * Rule validate
     */
    protected function rules() {
        return ['user' => 'required',
            'pass' => 'required|min:6',];
    }
    
    /**
     * Error message
     * @return type
     */
    protected function validationErrorMessages() {
        return [
            'user.required'             => 'username_empty',
            'pass.required'             => 'password_empty',
            'pass.min'                  => 'password_min_6',
            'old_password.required'     => 'old_password_empty',
            'new_password.required'     => 'new_password_empty',
            'confirm_password.required' => 'confirm_password_empty',
            'old_password.min'          => 'old_password_min_6',
            'new_password.min'          => 'new_password_min_6',
            'confirm_password.min'      => 'confirm_password_min_6',
        ];
    }
    
    /**
     * Update user
     * @param type $id
     */
    private function updateDateUser($id){
        $user = $this->userRepository->findWithoutFail($id);
        if(!is_null($user)){
            $user->last_visited = new DateTime();
            $user->save();
        }
    }
    
}