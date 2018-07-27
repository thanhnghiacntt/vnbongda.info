<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

/**
 * Description of CategoryController
 *
 * @author Admin
 */

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

class CategoryController extends BaseController {
    
    use ValidateMessage;
    
    /**
     * Category repository
     * @var type 
     */
    private $categoryRepository;

    public function __construct(UserRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
        $this->$categoryRepository = $categoryRepository;
    }
    
    public function create(){
        
    }
}
