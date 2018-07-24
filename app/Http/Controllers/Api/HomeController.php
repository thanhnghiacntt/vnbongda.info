<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HomeController extends BaseController {
    
    public function __construct()
    {
    }
    
    public function getInfo(){
        return "Helloword";
    }
}