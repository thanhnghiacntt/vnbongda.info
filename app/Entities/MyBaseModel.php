<?php
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MyBaseModel extends Model {
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $primaryKey = 'id';
}