<?php

namespace App\Http\Controllers\Api;

use App\Entities\User;
use Illuminate\Http\JsonResponse;
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
     * @var UserRepository
     */
    private $userRepository;


    /**
     * Constructor
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
        $this->userRepository = $userRepository;
    }
    
    /**
     * Create user
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
        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }
    
    /**
     * 
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
            $temp = $this->userRepository->findWithoutFail($credentials['id']);
            if(is_null($temp)){
                return $this->responseJsonError('id_incorrect', null);
            }
            $user = $this->setUser($temp, $credentials);
            $user->save();
            return $this->responseJsonSuccess(['user' => $user]);
        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }

    /**
     * Login which input user, pass, type from form.
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request){
        try {
            $response = $this->validateRequest($request, $this->rules(), $this->validationErrorMessages());
            if(!is_null($response)){
                return $response;
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
        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }

    /**
     * Change password user
     * @param Request $request
     * @return JsonResponse
     */
    public function changPassword(Request $request){
         try {
             $response = $this->validateRequest($request, $this->rulesChangePassword() , $this->validationErrorMessages());
            if(!is_null($response)){
                return $response;
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
    
    /**
     * 
     * @return array
     */
    protected function ruleCreate(){
        return ['username' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|email',
        ];
    }
    
    /**
     * 
     * @return array
     */
    protected function ruleUpdate(){
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
            'email.email'               => 'email_format',
            'id.required'               => 'id_empty'
        ];
    }
    
    /**
     * Update user
     * @param string $id
     */
    private function updateDateUser($id){
        $user = $this->userRepository->findWithoutFail($id);
        if(!is_null($user)){
            $user->last_visited = new DateTime();
            $user->save();
        }
    }
    
    /**
     * Set user
     * @param User $user
     * @param User $credentials
     * @return User
     */
    private function setUser($user, $credentials) {
        if(array_key_exists('first_name', $credentials)){
            $user->first_name = $credentials['first_name'];
        }
        if(array_key_exists('last_name', $credentials)){
            $user->last_name = $credentials['last_name'];
        }
        if(array_key_exists('phone', $credentials) && $credentials->phone != null){
            $user->phone = $credentials['phone'];
        }
        if(array_key_exists('avatar', $credentials) && $credentials->avatar != null){
            $user->avatar = $credentials['avatar'];
        }
        $user->last_visited = new DateTime();
        return $user;
    }
    
}