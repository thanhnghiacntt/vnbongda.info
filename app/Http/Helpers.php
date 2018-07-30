<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('dateIsValid')) {

    function dateIsValid($str) {
        if ($str == "") {
            return false;
        }
        $array = explode('/', $str);
        if (count($array) < 3) {
            return false;
        }
        $day = $array[0];
        $month = $array[1];
        $year = $array[2];

        $isDateValid = checkdate($month, $day, $year);
        return $isDateValid;
    }

}

if(!function_exists('responseJson')){
    function responseJson($code, $message = null, $data = array()){
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }    
}

if(!function_exists('responseJsonError')){
    function responseJsonError($code){
        $message = trans('error_message.'.$code);
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }    
}