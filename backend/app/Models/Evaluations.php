<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluations extends Model{
     
    protected $table = 'evaluations';

    protected $fillable = [
        'note',
        'comment'
    ]; 
    
    public static $rules = [  
        'note' => 'required',
        'comment' => 'required' 
    ];
    
}