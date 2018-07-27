<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Exception;
use DateTime;
use App\Http\Controllers\BaseController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Notifications\ValidateMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserController extends BaseController {
    
    use ValidateMessage;
    /**
     * User repository
     * @var type 
     */
    private $userRepository;


    /**
     * Constructor
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
        $this->userRepository = $userRepository;
    }
    
    /**
     * Create user
     * @param Request $request
     * @return type
     */
    public function create(Request $request){
        try {
            $reponse = $this->validateRequest($request, $this->ruleCreate(), $this->validationErrorMessages());
            if(!is_null($reponse)){
                return $reponse;
            }
            $credentials = $request->all();
            if($this->userRepository->checkExistEmail($credentials['email'])){
                return $this->responseJsonError('email_exist', null);
            }
            if($this->userRepository->checkExistUsername($credentials['username'])){
                return $this->responseJsonError('username_exist', null);
            }
            $attribute = $this->createdDetault($credentials);
            $attribute['password'] = bcrypt($credentials['password']);
            $user = $this->userRepository->create($attribute);
            return $this->responseJsonSuccess(['user' => $user]);
        } catch (JWTException $e) {
            Log::error($e);
            return $this->responseJsonError('could_not_create_token', null);
        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
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
            $credentials = $request->all();
            $token = JWTAuth::attempt($credentials);
            if (!$token) {
                return $this->responseJsonError('invalid_credentials', null);
            }
            // Get infomation of user
            $auth = Auth::User();
            $user = $this->userRepository->getProfile($auth->id);
            $this->updateDateUser($auth->id);
            return $this->responseJsonSuccess(['user' => $user, 'token'=> $token]);
        } catch (JWTException $e) {
            Log::error($e);
            return $this->responseJsonError('could_not_create_token', null);
        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
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
                return $this->responseJsonError('password_confirmation_does_not_match', null);
            }
            $user = JWTAuth::parseToken()->authenticate();
            $credentials = ['username'=>$user->username, 'password'=>$password];
            if (!JWTAuth::attempt($credentials)) {
                return $this->responseJsonError('old_password_invalid', null);
            }
            $user->password = bcrypt($newPassword);
            $user->save();
            $credentials['password'] = $newPassword;
            $token = JWTAuth::attempt($credentials);
            $rs = $this->userRepository->getProfile($user->id);
            return $this->responseJsonSuccess(['user' => $rs, 'token'=> $token]);
        } catch (JWTException $e) {
            Log::error($e);
            return $this->responseJsonError('could_not_create_token', null);
        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
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
        return ['username' => 'required',
            'password' => 'required|min:6',];
    }
    
    protected function ruleCreate(){
        return ['username' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|email',
        ];
    }

        /**
     * Error message
     * @return type
     */
    protected function validationErrorMessages() {
        return [
            'username.required'         => 'username_empty',
            'password.required'         => 'password_empty',
            'password.min'              => 'password_min_6',
            'old_password.required'     => 'old_password_empty',
            'new_password.required'     => 'new_password_empty',
            'confirm_password.required' => 'confirm_password_empty',
            'old_password.min'          => 'old_password_min_6',
            'new_password.min'          => 'new_password_min_6',
            'confirm_password.min'      => 'confirm_password_min_6',
            'email.required'            => 'email_empty',
            'email.email'               => 'email_format'
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