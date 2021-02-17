<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model{
     
    protected $table = 'stores';

    protected $fillable = [
        'name'
    ]; 
    
    public static $rules = [
        'name' => 'required'
    ];
    
}