<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model{
     
    protected $table = 'transactions';

    protected $fillable = [
        'id_client',
        'id_evaluation',
        'id_contributor',
        'id_store'
    ]; 
    
    public static $rules = [ 
        'id_client' => 'required|numeric',
        'id_evaluation' => 'required|numeric',
        'id_contributor' => 'required|numeric',
        'id_store' => 'required|numeric'        
    ];
    
}