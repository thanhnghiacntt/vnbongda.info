<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('page_url')) {
    /**
     * @return string
     */
    function page_url() {
        $data = Request::all();
        return base_url($data);
    }

}

if (!function_exists('base_url')) {

    /**
     * @param array $base_url
     * @return string
     */
    function base_url($base_url = array()) {
        $url = Request::url() . '?';
        foreach ($base_url as $key => $value) {
            $url .= $key . "=" . $value . "&";
        }
        return rtrim($url, "&");
    }
}

if(!function_exists('start_with')){
    /**
     * @param $str
     * @param $start
     * @return bool
     */
    function start_with($str, $start)
    {
        $length = strlen($str);
        return (substr($str, 0, $length) === $start);
    }
}

if(!function_exists('get_image')){
    /**
     * Get image
     * @param $value
     * @return string
     */
    function get_image($value){
        if($value != ""){
            if(start_with($value, "http")){
                return $value;
            }
            return asset(config("common.image") . $value);
        }
         return null;
    }
}

if (!function_exists('home_url')) {

    /**
     * @return mixed
     */
    function home_url() {
        return url()->previous();
    }

}

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