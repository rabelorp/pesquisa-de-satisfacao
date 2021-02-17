<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributors extends Model{
     
    protected $table = 'contributors';

    protected $fillable = [
        'name'
    ]; 
    
    public static $rules = [
        'name' => 'required'
    ];
    
}